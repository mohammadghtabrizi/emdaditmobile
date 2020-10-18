<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    
    public $table = 'blog_category';

    public function posts()
    {
    	return $this->hasMany(BlogPost::class,'BP_CATID','id');
    }

}
