<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Validproject extends Model
{
    use SoftDeletes;
    protected $fillable = [
       
        'project_id', 
    ];

    public function projects()
     {
         return $this->belongsTo('App\Project');
     }
     
    
}
