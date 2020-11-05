<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Admin\User;

class User extends Authenticatable
{
  use SoftDeletes;
  protected $table = 'users';
  public $timestamps = false;
  
  protected $fillable= [
    'id', 
    'name', 
    'username',
    'email', 
    'password',
    'phone', 
    'level',
    'img',
    'last_login',
    'remember_token'
 ];

  protected $hidden = [
    'password', 'remember_token', 'id'
  ];
  protected $dates = ['last_login', 'deleted_at'];



  
  //MIDDLEWARE CEK POIN BOSS
  public function UserAdmin(){
    if($this->level == 1 ) return TRUE;
    return FALSE;
  }

  public function UserMarketing(){
      if($this->level == 2) return TRUE;
      return FALSE;
  }

//   public function UserFO(){
//       if($this->level == 3) return TRUE;
//       return FALSE;
//   }
  
}
