@extends('main')

@section('title', '| Search results')

@section('content')
  <div class="search-container container">
  <h1> Search results </h1>
  <p> {{ $posts->count() }} result(s) for '{{ request()->input('search') }}' </p>
  <div class="row">
  	<div class="col-md-12 offset-md-2">

  	</div>
  </div><br>
  <hr>
  @foreach($posts as $post)
  <div class="row">
  	<div class="col-md-8 offset-md-2">
  		<h2> {{ $post->title }} </h2>
  		<p> Published: {{ date('j.M.Y', strtotime ($post->created_at)) }} </p>
  			<?php $br = 0 ?>
  		@foreach($post->images as $image)
  			@if ($br < 1)
  			<a href="{{ route('blog.single', $post->slug)}}">
  			<img src="{{asset('images/'. $image->name)}}" width="400" height="auto" />
  			@else
  			@endif
  			<?php $br = $br + 1; ?>
  			</a>


  		@endforeach
  		<p id="trebapaddinga" class="dont-break-out"> {{ substr($post->body, 0, 250) }} {{ strlen($post->body) > 250 ? '...' : ''}} </p>

  		<a href="{{ route('blog.single', $post->slug)}}"> Read More </a>
  		<hr>
  	</div>
  </div>
  @endforeach

  <div class="row">
  	<div class="col-md-12">
  		<div class="text-center">
        {{ $posts->appends(request()->input())->links() }}
  		</div>
  	</div>
  </div>
  </div>
@endsection
