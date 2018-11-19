<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\User;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Croppa;

class BlogController extends Controller
{
	public function getIndex() {
		$posts = Post::orderBy('created_at', 'desc')->paginate(7);

		return view('blog.index')->withPosts($posts);
	}

	public function getForsale() {
		$posts = Post::orderBy('created_at', 'desc')->where('sale', 'like', '1')->paginate(7);

		return view('blog.index')->withPosts($posts);
	}

    public function getSingle($slug) {
    	$post = Post::where('slug', '=', $slug)->first();
			if ($post){
			$helpuser = $post->user_id;
			$user = User::where('id', '=', $helpuser)->first();
			$post->addPageViewThatExpiresAt(Carbon::now()->addHours(2));
    	return view('blog.single')->withPost($post)->withUser($user);
			}
			else{
				return redirect()->back();
			}
    }

		public function search(Request $request){

			$request->validate([
				'search' => 'required|min:3|max:30',
			]);
			$query =  request()->input('search');
			$posts = Post::where('title', 'like', "%$query%")->paginate(7);
			return view ('blog.search-results')->withPosts($posts);
		} 
}
