<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use Mail;
use App\Category;
class PagesController extends Controller
{
    //
    public function getIndex(){

        $posts = Post::with('category')->orderBy('created_at', 'desc')->limit(7)->get();

        $categories = Category::orderBy('name','desc')->get();
    	return view('pages.welcome')->withPosts($posts)->withCategories($categories);
    }

    public function getAbout(){
		return view('pages.about');
    }

    public function getContact(){
		return view('pages.contact');
    }

    public function postContact(Request $request){
        $this->validate($request, [
            'title'=>'required|min:5',
            'email'=>'required|email',
            'content'=>'requried|min:10'
        ]);


        $data = array(
            'title'=>$request->title,
            'email'=>$request->email,
            'subject'=>$request->subject
        );


        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('hkg328@outlook.com');
            $message->subject($data['subject']);
        });



        Session::flash('success','Email was sent to admin successfully');

        return redirect('/');

    }
}
