<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
  use SoftDeletes;
  public function user()
  {
      return $this->belongsToMany('App\Users','group_user', 'group_id', 'user_id');
  }
  public function ticket()
  {
      return $this->hasMany('App\Ticket');
  }
  public function location()
  {
      return $this->hasMany('App\Location');
  }
}
