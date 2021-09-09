<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Activity extends Model
{
  protected $connection = 'mysql_sec';
	public $timestamps = true;
  
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'user_id','user_role'
    ];

  public function getUserActivity($userid=''){
      return Activity::where('user_id','=',$userid)->get();
  }
}
