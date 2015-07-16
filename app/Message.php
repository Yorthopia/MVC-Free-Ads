<?php 
/**
* Message model for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
namespace freeads;

use Illuminate\Database\Eloquent\Model;
use freeads\Utilisateur;
use freeads\Image;
/**
* Message model for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
class Message extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['utilisateur_sender_id', 'utilisateur_receiver_id', 'subject', 'content'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Destinataire
     *
     * @return Response
     */
    public function destinataire()
    {
        return $this->belongsTo('freeads\Utilisateur', 'utilisateur_receiver_id');
    }

    /**
     * Auteur
     *
     * @return Response
     */
    public function auteur()
    {
        return $this->belongsTo('freeads\Utilisateur', 'utilisateur_sender_id');
    }

    /**
     * Image
     *
     * @return Response
     */
    public function image()
    {
        return $this->hasMany('freeads\Image');
    }
}
