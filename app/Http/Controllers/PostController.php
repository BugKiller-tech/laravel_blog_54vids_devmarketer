<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Category;
use App\Tag;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();

        $tags = Tag::all();
        return view('posts.create', compact('categories'))->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'title'     =>'required|max:255',
            'body'      =>'required',
            'slug'      =>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'=>'required|integer',
            'featured_image'=>'sometimes|image'
        ]);

        $post = new Post();
        $post->title  =$request->title;
        $post->body = Purifier::clean($request->body);
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;

        
        if($request->hasFile('featured_image')){

            $image = $request->file('featured_image');

            $fileName = time().".".$image->getClientOriginalExtension();
            $location = public_path('images/'.$fileName);
            Image::make($image)->resize(800,400)->save($location);

            $post->featured_image = $fileName;


        }

        $post->save();
        
        if(isset($request->tags))
            $post->tags()->sync($request->tags, false);

        

        Session::flash('success','The blog post was successfully save!');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        $categories = Category::all();
        $cats =array();

        foreach($categories as $category){
            $cats[$category->id]=$category->name;
        }


        $tags = Tag::all();
        $tags2 = array();
        foreach($tags as $tag){
            $tags2[$tag->id] = $tag->name;
        }


        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $post = Post::find($id);


        $this->validate($request, [
            'title'=>'required|max:255',
            'body'=>'required',
            'slug'=>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id'=>'required|integer',
            'featured_image'=>'sometimes|image'
        ]);

        
        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->slug = $request->slug;
        $post->category_id  =$request->category_id;



        if($request->hasFile('featured_image')){

            $image = $request->file('featured_image');

            $fileName = time().".".$image->getClientOriginalExtension();
            $location = public_path('images/'.$fileName);
            $oldImage = $post->featured_image;

            Storage::delete($oldImage);
            Image::make($image)->resize(800,400)->save($location);
            $post->featured_image = $fileName;

        }


        $post->update();

        if(isset($request->tags))
            $post->tags()->sync($request->tags);
        else
            $post->tags()->sync(array());

        Session::flash('success','The Post successfully updated!');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);

        Storage::delete($post->featured_image);

        $post->tags()->detach();

        $post->delete();

        Session::flash('success','The Post successfully removed');
        return redirect()->route('posts.index');

    }
}
