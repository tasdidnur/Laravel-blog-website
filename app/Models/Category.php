<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     protected $primaryKey='cat_id';

     public function creator_info(){
       return $this->belongsTo('App\Models\User','cat_creator','id');
     }

     public function editor_info(){
       return $this->belongsTo('App\Models\User','cat_editor','id');
     }
}
