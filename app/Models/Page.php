<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public function editor_info(){
      return $this->belongsTo('App\Models\User','page_editor','id');
    }
}
