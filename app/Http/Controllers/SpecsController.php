<?php

namespace App\Http\Controllers;

use App\Specs;
use Illuminate\Http\Request;
use App\Tag;
use App\Category;
use Image;
use Auth;
use Storage;
use App\FuckImg;

class SpecsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $categories = Category::all();
        $tags = Tag::all();
        
        
        return view ('specs.create')->withCategories($categories)->withTags($tags);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specs  $specs
     * @return \Illuminate\Http\Response
     */
    public function show(Specs $specs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specs  $specs
     * @return \Illuminate\Http\Response
     */
    public function edit(Specs $specs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specs  $specs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specs $specs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specs  $specs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specs $specs)
    {
        //
    }
}
