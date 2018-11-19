<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use Session;
use Auth;

class CommentsController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post_id, Request $request)
    {

      $comments = Comment::all();
      $br = 0;
      $post = Post::find($post_id);

      foreach ($comments as $comment){
        if ($post->id == $comment->post_id){
          if (Auth::user()->id == $comment->user_id){
              $br = $br + 1;
          }
        }
      }
      if ($br < 3){
          $this->validate($request, array(
              'comment' => 'required|min:5|max:2000'
          ));


         // $user = User::find($user_id);

          $comment = new Comment();
          $comment->comment = $request->comment;
          $comment->approved = true;
          $comment->post()->associate($post);
          $comment->user_id = Auth::user()->id;
          //$comment->user()->associate($user);

          $comment->save();

          Session::flash('success', 'Comment was added');
          return redirect()->route('blog.single', [$post->slug]);
        }

      else {
        return 'Hoho dude, you are SPAM SPAM SPAM';
      }
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
    }
    public function delete($id)
    {
        $comment = Comment::find($id);
        return view ('comments.delete')->withComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $blog_slug = $comment->post->slug;
        $comment -> delete();

        Session::flash('success', 'Comment deleted');
        return redirect()->route('blog.single', $blog_slug);
     }
}
