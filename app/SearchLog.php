<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model {

	//
    protected $fillable = array('id','user_id','key_word','type','timestamp');
    public $timestamps = false;

}
