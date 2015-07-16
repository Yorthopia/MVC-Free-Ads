<?php 
/**
* Messages Controller for Free_ads
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
use Illuminate\Http\Request;
use freeads\Message;
use freeads\Image;
use freeads\Utilisateur;
use Auth;
use Session;
use Input;
use Validator;
use Redirect;
/**
* Messages Controller for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id id
     *
     * @return Response
     */
    public function index($id = null)
    {
        $received = Message::where("utilisateur_receiver_id", "=", Auth::user()->id)->groupBy('utilisateur_sender_id')->paginate(15);
        $received->setPath('message');
        if ($id) {
            $param = $id;
            if (Input::get('content')) {
                $msg = new Message();
                $msg->utilisateur_sender_id = Auth::user()->id;
                $msg->utilisateur_receiver_id = $id;
                $msg->content = Input::get('content');
                $msg->save();
            }
            $result = Message::whereRaw("(utilisateur_sender_id = ".$id." AND utilisateur_receiver_id = ".Auth::user()->id.") OR (utilisateur_sender_id = ".Auth::user()->id." AND utilisateur_receiver_id = ".$id.")")->orderBy('created_at', 'desc')->get();
            return view('messagebox', compact('received', 'result', 'param'));
        }
        return view('messagebox', compact('received'));
    }

    /**
     * Create
     *
     * @param int $id id
     *
     * @return Response
     */
    public function create($id = null)
    {
        if ($id !== null) {
            $users = Utilisateur::find($id);
            $select[$users->id] = $users->username;
            return view('conv', compact('select'));
        }
        $users = Utilisateur::all();
        foreach ($users as $user) {
            if ($user->id != Auth::user()->id) {
                $select[$user->id] = $user->username;
            }
        }
        return view('conv', compact('select'));
    }

    /**
     * Store in batabase
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $msg = new Message();
        $msg->utilisateur_sender_id = Auth::user()->id;
        $msg->utilisateur_receiver_id = $input['selec'];
        $msg->content = $input['content'];
        $msg->save();
        Session::flash('flash_message', 'Votre message est enregistré.');
        return redirect('home');
    }
}
