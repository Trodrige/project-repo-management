<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invalidproject extends Model
{
    
    use SoftDeletes;

    protected $fillable = [
       
        'project_id', 
    ];

    public function projects()
     {
         return $this->belongsToMany('App\Project');
     }
}
