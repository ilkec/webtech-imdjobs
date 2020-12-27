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

    //application belongs to 1 specific company
    public function companies()
    {
        return $this->belongsTo('\App\Models\Companies');
    }
    //application belongs to 1 specific user only
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
    //application belongs to 1 specific internship only
    public function internship()
    {
        return $this->belongsTo('\App\Models\Internships');
    }

    protected $fillable = [
        'user_id',
        'internships_id',
        'companies_id',
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
