<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studentrequest extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'student_id', 'project_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The student(author) that this request belongs to.
     *
     * @return Response
     */
     public function user()
     {
         return $this->belongsTo('App\User');
     }

     /**
      * The project that this request belongs to.
      *
      * @return Response
      */
      public function project()
      {
          return $this->belongsTo('App\Project');
      }
}
