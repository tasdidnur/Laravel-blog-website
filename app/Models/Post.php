<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    use HasFactory;


    protected $primaryKey='post_id';

    public function creator_info(){
      return $this->belongsTo('App\Models\User','post_creator','id');
    }

    public function editor_info(){
      return $this->belongsTo('App\Models\User','post_editor','id');
    }

    public function postCategory(){
      return $this->belongsTo('App\Models\Category','cat_id','cat_id');
    }

    public function tags(){
      return $this->belongsToMany('App\Models\Tag','post_tag','post_id','tag_id');
    }
}
