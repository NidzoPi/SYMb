<?php

namespace App\Http\Controllers;

use App\PostReview;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Post;
use App\User;

class PostReviewController extends Controller
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
    public function store(Request $request)
    {
       $this->validate($request, array(
        'rating' => 'required|integer|between:1,12',

   ));
        $review = new PostReview;
        $review->rating = $request->rating;
        $review->approved = true;
        $review->headline = $request->headline;
        $review->post_id  = $request->post_id;
        $review->user_id = Auth::user()->id;
        $review->save();



        Session::flash('success', 'Thanks for voting!');
          return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PostReview  $postReview
     * @return \Illuminate\Http\Response
     */
    public function show(PostReview $postReview, $post_id)
    {
        $review = PostReview::find($id);
        $reviews = PostReview::all();
        $post = Post::find($post_id);

        return view ('blog.single', [$post->slug])->withReviews($reviews)->withReview($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PostReview  $postReview
     * @return \Illuminate\Http\Response
     */
    public function edit(PostReview $postReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PostReview  $postReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostReview $postReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PostReview  $postReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostReview $postReview)
    {
        //
    }
}
