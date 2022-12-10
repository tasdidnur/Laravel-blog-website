<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey='tag_id';

    public function creator_info(){
      return $this->belongsTo('App\Models\User','tag_creator','id');
    }

    public function editor_info(){
      return $this->belongsTo('App\Models\User','tag_editor','id');
    }

    public function posts(){
      return $this->belongsToMany('App\Models\Post','post_tag','tag_id','post_id');
    }
}
