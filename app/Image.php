<?php
/**
* Image model for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/ 
namespace freeads;

use Illuminate\Database\Eloquent\Model;
use freeads\Annonce;
use freeads\Message;
/**
* Image model for Free_ads
*
* @category Class
* @package  PAS.DUTOUT
* @author   Aupet Christophe <christophe.aupet@gmail.com>
* @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
* @link     http://jaipas.com
*/
class Image extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'key_pix', 'annonce_id', 'message_id'];

    /**
     * Annonce
     *
     * @return response
     */
    public function annonce()
    {
        return $this->belongsTo('freeads\Annonce');
    }

    /**
     * Message
     *
     * @return response
     */
    public function message()
    {
        return $this->belongsTo('freeads\Message');
    }

}
