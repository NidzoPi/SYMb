@extends('main')

@section('content')

<div class="row">

@if (Auth::user()->id == $post->user_id || Auth::user()->admin == 1)

	<div class="col-md-8 haha">
		<div id = "fuckimgs">
			<h1> {{ $post->title }} </h1>
			<?php $br = 0;  ?>

			@foreach($post->images as $image)

				@if ($post->id == $image->post_id)
				<a data-fancybox="group" class="lightbox" href="{{asset('images/'. $image->name)}}">
				<img src="{{asset('images/'. $image->name)}}" width="300" vspace="20" />
				</a>
				<?php $br = $br + 1; ?>
				<form name = "delete-image" action="/posts/{{ $post->id }}/delete-image/{{$image->id}}" method="DELETE">
					{{ csrf_field() }}
					<input type="submit" value="Delete" class="btn btn-danger btn-sm">
				</form>
				@else
				@endif
			@endforeach
		</div>


		<?php $globalbr = $br; ?>
		<p id="finitekst" class="lead dont-break-out"> {{ $post->body }} </p>
		<hr>

	</div>

	<div class="col-md-4">
		<div class="well well-sm">

			<dl class="dl-horizontal">
				<dt> Slug: </dt>
				<dd> <a href="{{ url('bike/'.$post->slug) }}"> {{ url('bike/'.$post->slug) }} </a> </dd>
			</dl>

			<dl class="dl-horizontal">
				<dt> Category: </dt>
				<dd> {{ $post->category->name }} </dd>
			</dl>

			<dl class="dl-horizontal">
				<dt> Created At: </dt>
				<dd> {{ date ('j.M.Y , H:i', strtotime ($post->created_at))}} </dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>  Last Updated At:  </dt>
				<dd> {{ date ('j.M.Y , H:i', strtotime ($post->updated_at))}} </dd>
			</dl>
			<dl class="dl-horizontal">
			{!! Html::linkRoute ('posts.index', '< Show All', array(), array('class' => 'btn btn-default btn-block')) !!}
			</dl>


			<hr>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute ('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-info btn-block')) !!}

				</div>
				<div class="col-sm-6">
					{!! Form::open (['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
					{{ Form::submit('Destroy', ['class' => 'btn btn-danger btn-block']) }}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>



	@else
	<div class="col-md-12">
		<h1> This is not your post! </h1>
	</div>
	@endif
</div>

	@if ($globalbr > 4)
	<p class="pNoComment"> You can upload just 5 images! </p>
	@else
	<h3> Add Images: </h3>
	<form name="file" action="/posts/image-upload/{{$post->id}}"
      class="dropzone"
      id="my-dropzone" method="POST">
      	{{ csrf_field() }}
      </form>
     @endif

<script type="text/javascript">
		$(document).ready(function(){
			$('.lightbox').fancybox();
		});

</script>
<script>

	Dropzone.options.myDropzone = {

		maxFilesize: 10,
		<?php $maxfiles = 5; ?>
		maxFiles: {{ $maxfiles - $globalbr }},
		acceptedFiles: "image/*",


		init: function() {
          console.log('init');
          this.on("maxfilesexceeded", function(file){
                alert("No more files please!");
                this.removeFile(file);
          });
		},

		success: function (file, response){
			if (file.status == 'success'){
				handleDropzoneFileUpload.handleSuccess(response);
			}
			else{
				handleDropzoneFileUpload.handleError(response);
			}
		}
	};
		var handleDropzoneFileUpload = {
		handleError: function(response){
			console.log(response);
		},
		handleSuccess: function(response){
			var baseUrl = "{{ asset('/') }}";
			var imageSrc =  baseUrl + 'images/' + response.name;
			//var selector = document.getElementById('fuckimgs');
			//selector.innerHTML = '<h1>string of html content</h1>';
			$('#fuckimgs').append('<a data-fancybox="group" class="lightbox" href="'+ imageSrc +'"><img vspace="20" src="'+ imageSrc +'" width="300"></a> ');
			var deleteSrc = baseUrl + 'posts/' + response.post_id + '/delete-image/' + response.id;
			$('#fuckimgs').append('<form name="delete-image" action="'+ deleteSrc +'" method="DELETE">  <input type="submit" value="Delete" class="btn btn-danger btn-sm"> </form> ');
		}
	};
	</script>










@endsection
