<?php 
/**
* Utilisateurs Controller for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
namespace freeads\Http\Controllers;

use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;
use freeads\Utilisateur;
use Illuminate\Http\Request;
use Input;
use Hash;
use Validator;
use Session;
use Mail;
use Redirect;
use Auth;
/**
* Utilisateurs Controller for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
class UtilisateursController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $i = 0;
        $key = "";
        $tmp = "";
        $rules = [
            'username' => 'required|min:4|unique:utilisateurs',
            'password' => 'required|min:4',
            'mail'     => 'required|email|unique:utilisateurs',
            'name'     => 'required',
            'lastname' => 'required',
            'birthdate'=> 'required|date'
        ];

        $input = Input::only(
            'username',
            'password',
            'mail',
            'name',
            'lastname',
            'birthdate'
        );

        $validate = Validator::make($input, $rules);

        if ($validate->fails()) {
            return Redirect::back()->withInput()->withErrors($validate);
        }

        while ($i < 5) {
            $key .= rand(0, 15);
            $tmp = str_shuffle("abcdefghijklmnopqrstuvwxyz");
            $key .= $tmp[rand(0, 10)];
            $i++;
        }
        $temp = array($key);
        /*var_dump($param);
        exit();*/
        $utilisateur = new Utilisateur();
        $utilisateur->username = Input::get('username');
        $utilisateur->password = Hash::make(Input::get('password'));
        $utilisateur->mail = Input::get('mail');
        $utilisateur->name = Input::get('name');
        $utilisateur->lastname = Input::get('lastname');
        $utilisateur->birthdate = Input::get('birthdate');
        $utilisateur->key = $key;
        $utilisateur->save();

        Mail::send(
            'emails.tamplate',
            ['key' => $temp], 
            function($message) {
                $message->to(Input::get('mail'), Input::get('username'))
                    ->subject('Verify your email address');
                $message->from('noreply@freeads.com', 'Laravel');
            }
        );
        Session::flash('flash_message', 'Votre compte à correctement été enregistré. Veuillez verifier votre boite mail.');
        return redirect('/');
    }

    /**
    * Activate
    *
    * @param string $key activation key
    *
    * @return activation
    */
    public function activate($key)
    {
        $utilisateur = Utilisateur::where('key', '=', $key)->first();
        if (! $utilisateur) {
            Session::flash('flash_danger', 'Action impossible.');
            return redirect('/');
        }
        $utilisateur->activate = 1;
        $utilisateur->key = null;
        $utilisateur->save();
        Session::flash('flash_message', 'Votre compte est à present actif.');
        return $this->authUser($utilisateur->id);
    }

    /**
    * AuthUser
    *
    * @param string $param parameters
    *
    * @return activation
    */
    public function authUser ($param)
    {
        if (!empty($param) && is_int($param) || is_array($param)) {
            if (is_int($param)) {
                if (Auth::loginUsingId($param)) {
                    return redirect()->intended('home');
                } else {
                    Session::flash('flash_danger', "Login ou mot de passe incorrecte.");
                    return redirect('/');
                }
            }

            if (is_array($param)) {
                if (Auth::attempt(array('username' => $param[0], 'password' => $param[1], 'activate' => 1))) {
                    return redirect()->intended('home');
                } else {
                    Session::flash('flash_danger', "Login ou mot de passe incorrecte.");
                    return redirect('/');
                }
            }
        } else {
            Session::flash('flash_danger', 'Action impossible.');
            return redirect('/');
        }
    }

    /**
    * Authenticate
    *
    * @return authenticate users
    */
    public function authenticate()
    {
        $input = Input::all();
        return $this->authUser(array($input['username'], $input['password']));
    }

    /**
    * Logout
    *
    * @return logout user
    */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        $infos = Utilisateur::find(Auth::user()->id)->annonce();
        return view('account', compact('infos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        $user = Utilisateur::find(Auth::user()->id)->first();
        $input = Input::all();
        if (!empty($input['password'])) {
            $user->password = Hash::make($input['password']);
        }

        if (!empty($input['mail'])) {
            $user->mail = $input['mail'];
        }

        if (!empty($input['username'])) {
            $user->username = $input['username'];
        }
        $user->save();
        Session::put('flash_message', 'Modification réussi.');
        return redirect('account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        $user = Utilisateur::find(Auth::user()->id)->first();
        $user->forceDelete();
        Auth::logout();
        Session::put('flash_message', 'Votre compte est désormais supprimé.');
        return redirect('/');
    }

    public function allusers()
    {
        $users = Utilisateur::all();
        return view('allusers', compact('users'));
    }

}