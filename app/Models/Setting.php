<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $primaryKey='setting_id';

    public function editor_info(){
        return $this->belongsTo('App\Models\User','editor','id');
    }
}
