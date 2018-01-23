<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
class BlogController extends Controller
{
    //
    public function getIndex(){
    	$posts = Post::orderBy('created_at','desc')->paginate(10);
    	return view('blog.index')->withPosts($posts);
    }
    public function getSingle($slug){
    	$post = Post::where('slug','=',$slug)->first();
    	return view('blog.single')->withPost($post);
    }


    public function getPostsinCategory($id){
    	$posts = Post::where('category_id','=',$id)->paginate(10);
    	$category_name = Category::find($id)->name;

    	return view('blog.category_posts')->withPosts($posts)->withCategory_name($category_name);
    }
}
