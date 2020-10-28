<?php 
/* Model for applications sent by student
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'internship_id',
        'company_id',
        'status',
        'message',
        'feedback'
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
  /*  protected $casts = [
        'sendt_at' => 'datetime',
    ];*/
}
?>