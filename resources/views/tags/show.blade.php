@extends('main')

@section('title', "| $tag->name Tag")

@section('content')

<div class="row">
	<div class="col-md-8">
		<h2> {{ $tag->name }} Tag <small> {{ $tag->posts()->count() }} Posts </small></h2> 
	</div>
	<div class="col-md-2">
		<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-lg"> Edit </a>
	</div>
	<div class="col-md-2">
		{{ Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) }}
			{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-lg']) }}

		{{ Form::close() }}
	</div>
</div>
<br>
<div class="row" style="margin-top: 50px;">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th> ID </th>
					<th> Post </th>
					<th> Tags </th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tag->posts as $post)
				<tr>
					<th> {{ $post->id }} </th>
					<td> {{ $post->title }} </td>
					<td>
					@foreach ($post->tags as $tag)
					 <button class="btn btn-default btn-sm"> {{ $tag->name }}</button> 
					@endforeach
					</td>
					<td> <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm"> View </a> </td>
				</tr>
				@endforeach
			</tbody>		
		</table>
	</div>
</div>

@endsection