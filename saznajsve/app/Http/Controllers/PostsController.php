<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Tag;
use App\Category;
use Image;
use Auth;
use Storage;
use App\FuckImg;
use App\User;
use GuzzleHttp\Client;
use File;
use Illuminate\Filesystem\Filesystem;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function uploadImages ($id, Request $request)
    {

        $post=Post::find($id);
        $image=$request->file('file');
        $imgg = $request->file('file');

         if ($image){

            $name = time() . '-' . $image->getClientOriginalName();
            $destinationPath = 'images/';
            $namee = time() . '-t' . $imgg->getClientOriginalName();

           /* $image->move($destinationPath, $name);
            $imagee = $post->images()->create(['image_path' => $destinationPath, 'name' => $name]);*/

            $img = Image::make($imgg)->widen(800);
            $img->save($destinationPath.$namee);
            $imggg = $post->images()->create(['image_path' => $destinationPath, 'name' => $namee]);

         }
         
         return $imggg;

    }

    public function deleteImage($post_id,$id)
    {
        $image = FuckImg::find($id);
        File::Delete('images/'.$image->name);
        $image -> delete();
        $post = Post::find($post_id);
        Session::flash('success', 'Image deleted');
        return redirect()->route('posts.show', $post->id);
    }
    public function index()
    {

        $posts = Post::orderBy('id', 'desc')->paginate(7);
        $users = User::all();
        return view ('posts.index')->withPosts($posts)->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::all();
        $br = 0;
        foreach($posts as $post){
          if (Auth::user()->id == $post->user_id ){
              $br = $br + 1;
          }
        }
        if ($br <  5){
        return view ('posts.create')->withCategories($categories)->withTags($tags);
        }
        else {
          return "No no no you are bad boy, you can create just 5 post for free!";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
      $token = $request->input('g-recaptcha-response');
      $date =  date('Y');

        // Validate
        $this->validate ($request, array(
            'title'         => 'required|max:255',
            'category_id'   => 'required|integer',
            'body'          => 'required|min:100',
            'featured_image'=> 'sometimes|image',
            'ccm'           => 'numeric|min:49|max:1500',
            'hp'            => 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/|numeric|min:1|max:1000',
            'year'          => 'numeric|min:1910|max:2018'
        ));
      if ($token){
          $client = new Client();
          $response = $client->post('https://www.google.com/recaptcha/api/siteverify',[
            'form_params' => array (
              'secret' => '6Ld961kUAAAAABgkodeR_G00Fy99sSYS7A7OkR9z',
              'response' => $token
            )
          ]);
          $results = json_decode($response->getBody()->getContents());
          if ($results->success){
        // Store
          $post = new Post;

          $post->title = $request->title;
          $post->sale = $request->sale;
          $post->hp = $request->hp;
          $post->category_id = $request->category_id;
          $post->ccm = $request->ccm;
          $post->year = $request->year;
          $post->phone_number = $request->phone_number;
          $post->body = $request->body;
          $post->user_id = Auth::user()->id;

          $post->save();

          $newPost = $post->replicate();

          $post->tags()->sync($request->tags, false);

          Session::flash('success', 'This post is created successfully');

          return redirect()->route('posts.show', $post->id);
          }
          else{
            Session::flash('error', 'Are you realy a robot?');
            return redirect()->route('posts.create');
          }
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
        $adminpost = Post::find($id);
        $post = Post::find($id);
        $image = FuckImg::find($id);
        if ($post){
          if (Auth::user()->id == $post->user_id || Auth::user()->admin == 1){
          return view ('posts.show')->withPost($post)->withImage($image);
          }
          else {
            return redirect()->back();
          }
        }
        else{
          return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $categories = Category::all();
        $cats = array();
        $ccm = $post->ccm;
        $hp = $post->hp;
        $phone_number = $post->phone_number;
        $year = $post->year;
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();

        foreach($tags as $tag)
        {
            $tags2[$tag->id] = $tag->name;
        }


        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2)->withCcm($ccm)->withHp($hp)->withYear($year)->withPhone_number('phone_number');
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
        $post = Post::find($id);
        $this->validate($request, array (
            'title' => 'required|max:255',
            'category_id'   => 'required|integer',
            'body' => 'required|min:100|max:1000',
            'featured_image' => 'image',
            'ccm'           => 'numeric|min:49|max:1500',
            'year'        => 'numeric|min:1910|max:2018'
        ));



        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->sale = $request->input('sale');
        $post->category_id = $request->input('category_id');
        $post->ccm = $request->input('ccm');
        $post->year = $request->input('year');
        $post->phone_number = $request->input('phone_number');
        $post->body = $request->input('body');

        if ($request->hasFile('featured_image')){
            // add the new photo
            $image = $request->file('featured_image');
            $filename = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(480, 300)->save($location);
            $oldfile = $post->image;
            // update the database
            $post->image = $filename;
            // Delete the old photo
            Storage::delete($oldfile);
        }

        $post->save();

        if (isset($request->tags)){
        $post->tags()->sync($request->tags);
        }else{
            $post->tags()->sync(array());
        }

        Session::flash('success', 'This post was updated successfully');
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
        $post = Post::find($id);
        $post->tags()->detach();
        $post->reviews()->delete();
       // Storage::delete($post->image);
         foreach($post->images as $image){
            $deletefile = $image->name;
            File::Delete('images/'.$deletefile);
        }

        $post->images()->delete();

        $post->delete();

        Session::flash('success', 'This post was deleted successfully');

        return redirect()->route('posts.index');
    }

}
