<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'type', 'date_validated', 'zip_filename', 'filename_pdf', 'owner_id', 'admin_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The user(author) that this project belongs to.
     *
     * @return Response
     */
     public function user()
     {
         return $this->belongsTo('App\User');
     }

     /**
      * The comments under this project.
      *
      * @return Response
      */
      public function comments()
      {
          return $this->hasMany('App\Comment');
      }
}
