@extends('main')



@section('title', "| $post->title")



@section('scriptsandlinks')

<?php foreach ($post->images as $image) { ?>

<meta property="og:image" content="http://showyourmotorbike.com/images/{{$image->name}}" />

<?php } ?>

<meta property="og:image:width" content="400" />

<meta property="og:image:height" content="300" />

<meta property="og:title" content="{{ $post->title }}" />

<meta property="og:description" content="{{ $post->body }}" />

@endsection

@section('content')



<div class="row">

	<div class="col-md-8 col-md-offset-2">

		<h2 class="BlogTitle"> {{ $post->title }} </h2>

		<?php $br = 0; ?>

		@foreach($post->images as $image)

			@if ($br < 1)

			<a data-fancybox="group" class="lightbox" href="{{asset('images/'. $image->name)}}">

			<img class="img-fluid"  alt="Responsive image" id="trebapaddinga" src="{{asset('images/'. $image->name)}}" width="400" height="auto" />

			</a>

			@else

			<a data-fancybox="group" class="lightbox" href="{{asset('images/'. $image->name)}}">

			<img class="img-fluid"  alt="Responsive image" style="display: none;" src="{{asset('images/'. $image->name)}}" width="500" />

			</a>

			@endif

		<?php $br = $br + 1; ?>

		@endforeach

		<div class="zakubike"> {{ $post->ccm }} ccm </div>

		<div class="zakonje"> {{ $post->hp }} HP </div>

		<div class="zagodine"> {{ $post->year }} year </div>

		<p id="trebapaddinga" class="dont-break-out"> {{ $post->body }}  </p>

		<hr>

		<div class="tags">

			@foreach($post->tags as $tag)

			<button type="button" class="btn btn-info btn-sm">

				{{ $tag->name }}

			</button>

			@endforeach

		</div>

		<br>

		<strong> <p> Posted In: {{ $post->category->name }} </p> </strong>

		<strong> <p> Owner: {{ $user->name }} </p> </strong>



		@if ($post->sale == 0)

			<h4 id="notforsale"> Not For Sale </h4>

		@elseif ($post->sale == 1)

			<div id = "forsale">

			<h4> For Sale </h4>

			<p> {{ $post->phone_number }} </p>

		</div>

		@else

			<h4> Hahah </h4>

		@endif



	</div>



	<div class="col-md-2">

		@if (Auth::check())

		<?php $help = 0; ?>

		@foreach($post->reviews as $review)

			@if (Auth::user()->id == $review->user_id)

			<?php $help = $help + 1; ?>

			@else

			@endif

		@endforeach

		@if ($help < 1)

			<div class="well">

				{!! Form::open(['route' => 'review.store', 'method' => 'POST']) !!}

				{{ Form::label ('rating', 'Rate:') }}

				{{ Form::select('rating', [

				   '1' => '1',

				   '2' => '2',

				   '3' => '3',

				   '4' => '4',

				   '5' => '5',

				   '6' => '6',

				   '7' => '7',

				   '8' => '8',

				   '9' => '9',

				   '10' => '10',

					 '11' => '11',

					 '12' => '12'

				], null, ['class' => 'form-control']

				) }}

				{{ Form::label ('headline', 'Why?') }}

				{{ Form::text('headline', null, ['class' => 'form-control'])}}

				<br>

				<input type="hidden" name="post_id" value="{{ $post->id }}"/>

				{{ Form::submit('Vote', ['class' => 'btn btn-danger btn-block'])}}

				{!! Form::close() !!}

			</div>

			@else

			<p class="pNoComment"> You have already voted for this bike! </p>

			@endif

			@else

			@endif

			<div class="well">



				<?php $varreviewcount =  $post->reviews()->count(); $br = 0; ?>

				<p class="pageViewsandVotes pNoComment"> Votes: {{ $varreviewcount }} </p>

				@foreach($post->reviews as $review)

				 	@if ($post->id == $review->post_id)

				 	<?php $br = $br + $review->rating; ?>



				 	@else

				 	<? $br = 0; $varreviewcount = 0; ?>

				 	@endif

				@endforeach

				<?php if ($varreviewcount > 0) {$arsredina = $br / $varreviewcount;} else {$arsredina = 0;} ?>

				<?php for ($i = 0; $i < $arsredina; $i++) { ?>

					<img width="20px" height="20px" src="/images/dodaci/star.png"/>

				<?php } ?>

				<p class="pageViewsandVotes pNoComment"> Views: 	{{ $post->getPageViews() }} </p>



			</div>
			
			<div style="">
				<div id="jooj" style="padding-left: 120px;">
					
				</div>

			
		
			</div>
	</div>

</div>

<div class="row">

	<div class="col-md-6">

@guest

<p class="pNoComment"> You aren't allowed to comment, because you aren't logged in! </p>

@else

 {{ Form::open (['route' => ['comments.store', $post->id], 'method' => 'POST']) }}

 	<div class="row">

 		<div class="col-md-2">

 			<a href="#">

            {{ Auth::user()->name }}

        	</a>

 		</div>

 		<div class="col-md-10">

 			<strong> {{ Form::label ('comment', 'Leave a comment:')}} </strong>

 			{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5', 'minlength' => '5', 'maxlength' => '255']) }}

 			{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top: 10px;']) }}

 		</div>

 	</div>

 {{ Form::close() }}

@endguest

	</div>

</div>

<div class="col-md-8 md-offset-2" style="padding-top: 40px;">
<a href="https://www.facebook.com/pilipovicmed/"> <img src="/images/dodaci/pcela.gif"> </a>
</div>


<div class="row udalji">

	<div class="col-md-8 md-offset-2">

		<h3 class="comments-title"> <img src="/images/dodaci/comment.png" class="img-comment"/> </span>{{ $post->comments()->count() }} Comments: </h3>

	@foreach($post->comments as $comment)

		<div class="comment">



			<div class="author-info">

				<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->user->email))) . "?d=mm"  }}" class="author-image">

				<div class="author-name">

				<h4>	{{ $comment->user->name}} </h4>

				<p class="author-time">{{ date('j.M.Y',strtotime($comment->created_at)) }}</p>

				</div>

			</div>



			<div class="comment-content">

				{{ $comment->comment }}



					<div class="deletebutton">

						@guest

		   	 				<p>  </p>

		   	 			@else

		   	 			@if (Auth::user()->id == $comment->user->id)

		   	 				{!! Form::open (['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}



							{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block btn-sm']) }}



							{!! Form::close() !!}

		   	 			@else

		   	 				<p> </p>

		   	 			@endif

		   	 			@endguest

		   			</div>

		   </div>



		</div>

	@endforeach

	</div>

</div>

<script type="text/javascript">



		$(document).ready(function(){



			$('.lightbox').fancybox();





		});







</script>

@endsection

