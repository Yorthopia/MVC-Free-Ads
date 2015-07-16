<?php 
/**
* Index Controller for Free_ads
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
/**
* Index Controller for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
class IndexController extends Controller
{
    /**
    * ShowIndex
    *
    * @return display view
    */
    public function showIndex()
    {
        return view('index');
    }

    /**
    * Signin
    *
    * @return display view
    */
    public function signin()
    {
        return view('signin');
    }
}