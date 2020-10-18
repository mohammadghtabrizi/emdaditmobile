<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogPost extends Model
{
	use HasFactory;
	
	public $table = 'blog_post';

	public function files(){
	
		return $this->hasMany(BlogFile::class,'bf_idpost','id');
		
	}
	

}