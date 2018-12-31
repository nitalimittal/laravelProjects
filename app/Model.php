<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
   // protected $fillable = ['title','body']; // mention fields which can be accepted massively
   protected $guarded = ['id',]; //reverse of fillable
   
}
