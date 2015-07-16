<?php 
/**
* Annonce model for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
namespace freeads;

use freeads\Utilisateur;
use Illuminate\Database\Eloquent\Model;
/**
* Annonce model for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
class Annonce extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Annonces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'describe', 'key_pix', 'price', 'utilisateur_id', 'name'];

    /**
     * Utilisateur
     *
     * @return response
     */
    public function utilisateur()
    {
        return $this->belongsTo('freeads\Utilisateur');
    }

    /**
     * Image
     *
     * @return response
     */
    public function image()
    {
        return $this->hasMany('freeads\Image');
    }
}
