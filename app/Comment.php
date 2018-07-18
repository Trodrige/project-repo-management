<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The user(author) that this comments belongs to.
     *
     * @return Response
     */
     public function user()
     {
         return $this->belongsTo('App\User');
     }

     /**
      * The project that this comment belongs to.
      *
      * @return Response
      */
      public function comment()
      {
          return $this->belongsTo('App\Comment');
      }
}
