<?php 
/**
* Annonces Controller for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
namespace freeads\Http\Controllers;

use freeads\Annonce;
use freeads\Image;
use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Input;
use Validator;
use Redirect;
use DB;

/**
* Annonces Controller for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ads = Annonce::orderBy('created_at', 'DESC')->paginate(15);
        $ads->setPath('allads');
        return view('adslist', compact('ads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function search()
    {
        $input = Input::all();
        $request = "";
        $requestControle = false;
        if (isset($input['searchtool']) && !empty($input['searchtool'])) {
            $request .= "`describe` LIKE '%".$input['searchtool']."%' OR `title` LIKE '%".$input['searchtool']."%'";
            $requestControle = true;
        }

        if (isset($input['pricefirst']) && !empty($input['pricefirst'])) {
            $requestControle = true;
            if (!$input['searchtool']) {
                $request .= " annonces.price >= ".$input['pricefirst'];
            } else {
                $request .= " AND annonces.price >= ".$input['pricefirst'];
            }
        }

        if (isset($input['priceend']) && !empty($input['priceend'])) {
            $requestControle = true;
            if (!$input['searchtool']) {
                if (!$input['pricefirst']) {
                    $request .= " annonces.price <= ".$input['priceend'];
                } else {
                    $request .= " AND annonces.price <= ".$input['priceend'];
                }
            } else {
                if (!$input['pricefirst']) {
                    $request .= " AND annonces.price <= ".$input['priceend'];
                } else {
                    $request .= " AND annonces.price <= ".$input['priceend'];
                }
            }
        }

        if ($requestControle === true) {
            $seek = Annonce::whereRaw($request)->get();
            return view('adslist', compact('seek'));
        } else {
            Session::flash('flash_danger', 'Vous devez remplire au moins un des champs pour effectuer une recherche.');
            return redirect('allads');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('newads');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $i = 0;
        $key = "";
        $rules = [
            'title'    => 'required|min:4',
            'describe' => 'required|min:10',
            'price'    => 'required',
            'file'     => 'required',
        ];

        $validate = Validator::make($input, $rules);

        if ($validate->fails()) {
            return Redirect::back()->withInput()->withErrors($validate);
        }
        $add = new Annonce();
        $add->title = $input['title'];
        $add->describe = $input['describe'];
        $add->utilisateur_id = Auth::user()->id;
        $add->price = $input['price'];
        $add->save();
        if ($input['file']) {
            foreach ($input['file'] as $file) {
                while ($i < 8) {
                    $key .= rand(0, 60);
                    $i++;
                }
                $pix = new Image();
                $key .= ".".$file->getClientOriginalExtension();
                $pix->name = $file->getClientOriginalName();
                $pix->key_pix = $key;
                $pix->annonce_id = $add->id;
                $pix->save();
                $file->move('files/storage/', $key);
                $i = 0;
                $key = "";
            }
        }
        Session::flash('flash_message', 'Votre annonce est enregistré.');
        return redirect('account');
    }

    /**
     * Show the specified ressource.
     *
     * @param int $id id
     *
     * @return Response
     */
    public function show($id)
    {
        if ($id) {
            $ad = Annonce::find($id);
            return view('selectad', compact('ad'));
        } else {
            Session::flash('flash_danger', 'Action impossible');
            return Redirect::back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id
     *
     * @return Response
     */
    public function edit($id)
    {
        if ($id) {
            $infos = Annonce::find($id);
            return view('editAds', compact('infos'));
        } else {
            Session::flash('flash_danger', 'Action impossible.');
            return redirect('account');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id id
     *
     * @return Response
     */
    public function update($id)
    {
        $ads = Annonce::find($id);
        if ($ads->utilisateur_id == Auth::user()->id) {
            $input = Input::all();
            if (isset($input['select']) && !empty($input['select'])) {
                $sizeSelect = count($input['select']);
            }
            $sizeFile = count($input['file']);
            $key = "";
            $y = 0;
            $i = 0;
            if ($input['title']) {
                $ads->title = $input['title'];
            }

            if ($input['describe']) {
                $ads->describe = $input['describe'];
            }

            if ($input['price']) {
                $ads->price = $input['price'];
            }

            if (isset($input['select']) && !empty($input['select'])) {
                if ($input['file'][0] === null) {
                    foreach ($input['select'] as $select) {
                        $img = Image::find($select);
                        unlink('files/storage/'.$img->key_pix);
                        $img->forceDelete();
                    }
                }
            }

            if (isset($input['file']) && !empty($input['file']) && $input['file'][0] !== null) {
                if (isset($input['select']) && !empty($input['select'])) {
                    foreach ($input['file'] as $file) {
                        while ($i < 8) {
                            $key .= rand(0, 60);
                            $i++;
                        }
                        $key .= ".".$file->getClientOriginalExtension();
                        if ($y <= $sizeSelect) {
                            $img = Image::find($input['select'][$y]);
                            unlink('files/storage/'.$img->key_pix);
                            $img->name = $file->getClientOriginalName();
                            $img->key_pix = $key;
                            $file->move('files/storage/', $key);
                            $img->save();
                        } else {
                            $img = new Image();
                            $img->name = $file->getClientOriginalName();
                            $img->annonce_id = $ads->id;
                            $img->key_pix = $key;
                            $img->save();
                            $file->move('files/storage/', $key);
                        }
                        $key = "";
                        $i = 0;
                        $y++;
                    }
                } else {
                    foreach ($input['file'] as $file) {
                        while ($i < 8) {
                            $key .= rand(0, 60);
                            $i++;
                        }
                        $key .= ".".$file->getClientOriginalExtension();
                        $img = new Image();
                        $img->name = $file->getClientOriginalName();
                        $img->annonce_id = $id;
                        $img->key_pix = $key;
                        $img->save();
                        $file->move('files/storage/', $key);
                        $key = "";
                        $i = 0;
                    }
                }
            }
            $ads->save();
            Session::flash('flash_message', 'Modifications réussi.');
            return redirect('account');
        } else {
            Session::flash('flash_danger', 'Action impossible.');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ads = Annonce::find($id);
        if ($ads->utilisateur_id == Auth::user()->id) {
            if ($ads->image) {
                foreach ($ads->image as $pix) {
                    unlink('files/storage/'.$pix->key_pix);
                }
                $img = Image::where('annonce_id', '=', $id);
                $img->forceDelete();
            }
            $ads->forceDelete();
            Session::flash('flash_message', 'Votre annonce à bien été supprimé.');
            return redirect('account');
        } else {
            Session::flash('flash_danger', 'Action impossible.');
            return Redirect::back();    
        }
    }

}
