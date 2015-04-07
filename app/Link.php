<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    protected $fillable = ['title', 'url', 'user_id'];

	public function votes(){
        return $this->hasMany('App\Vote');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}