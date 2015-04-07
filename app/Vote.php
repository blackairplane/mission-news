<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

    protected $fillable = ['user_id', 'link_id'];

	public function link(){
        return $this->belongsTo('App\Link');
    }

}
