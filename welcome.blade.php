@extends('main')

@section('title', '| Welcome')
@section('scriptsandlinks')
	<meta property="og:image" content="http://www.pngall.com/wp-content/uploads/2016/05/Motorcycle-Helmet-High-Quality-PNG.png" />
@endsection
@section('content')
</div>

<div class="container-full">
	 <div class="row">
		<div class="col-md-12">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="/images/pic/moto1.jpg" alt="First slide" width="100%">
			<div class="carousel-caption">
					<p>Emo Philips</p>
		 </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="/images/pic/moto2.jpg" alt="Second slide" width="100%">
			<div class="carousel-caption">
					<p>Anonymous</p>
		 </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="/images/pic/moto3.jpg" alt="Third slide" width="100%">
			<div class="carousel-caption">
					<p>Anonymous</p>
		 </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
		</div>
	</div>
</div>
<div class="container welcomedrugi">
	<h3 class="BlogTitle"> New Bikes Posted: </h3>
	<br>
	<div class="row">
		<div class="card-deck">
			<?php $bla = 0; ?>
		@foreach($posts as $post)
			<?php $bla = $bla + 1; ?>
				<?php $br = 0; ?>
		@if ($post->images->count() != 0)
				@foreach($post->images as $image)
						@if ($br < 1)
					<div class="card" style="width: 18rem;">
						<a href="{{ route('blog.single', $post->slug)}}">
						<img class="card-img-top" src="{{asset('images/'. $image->name)}}" height="300" />
						</a>
						<div class="card-body">
							 <h5 class="card-title">{{ $post->title }}</h5>
							 <p class="card-text">{{ substr($post->body, 0, 100)  }} {{ strlen($post->body) > 100 ? "..." : ""}}</p>
							 <a href="{{url('bike/'. $post->slug)}}" class="btn btn-primary"> Read More </a> <p id="views"> Views: {{ $post->getPageViews() }} </p>
						</div>
					</div>
						@else
						@endif
					<?php $br = $br + 1; ?>
				@endforeach
			@else
				@if ($br < 1)
			<div class="card" style="width: 18rem;">
				<a href="{{ route('blog.single', $post->slug)}}">
				<img class="card-img-top" src="{{ url ('images/dodaci/noimage.gif')}}" height="300" />
				</a>
				<div class="card-body">
					 <h5 class="card-title">{{ $post->title }}</h5>
					 <p class="card-text">{{ substr($post->body, 0, 100)  }} {{ strlen($post->body) > 100 ? "..." : ""}}</p>
					 <a href="{{url('bike/'. $post->slug)}}" class="btn btn-primary"> Read More </a> <p id="views"> Views: {{ $post->getPageViews() }} </p>
				</div>
			</div>
				@else
				@endif
			<?php $br = $br + 1; ?>
			@endif
		@endforeach

 		</div>
	</div>
</div>

<div class="container welcomedrugi">
	<h3 class="BlogTitle">Most viewed Bikes: </h3>
	<br>
<div class="row">
	<div class="card-deck">
		@foreach($vposts as $vpost)
				<?php $br = 0; $brr = 0; ?>
				@if ($vpost->images->count() != 0)
				@foreach($vpost->images as $image)
				@if ($br < 1)
				<div class="card" style="width: 18rem;">
						<a href="{{ route('blog.single', $vpost->slug)}}">
						<img class="card-img-top" src="{{asset('images/'. $image->name)}}" height="300" />
						</a>
						<div class="card-body">
							 <h5 class="card-title">{{ $vpost->title }}</h5>
							 <p class="card-text">{{ substr($vpost->body, 0, 100)  }} {{ strlen($vpost->body) > 100 ? "..." : ""}}</p>
							 <a href="{{url('bike/'. $vpost->slug)}}" class="btn btn-primary"> Read More </a> <p id="views"> Views: {{ $vpost->getPageViews() }} </p>
					 </div>
				</div>
				@else
				@endif
					<?php $br = $br + 1; ?>
				@endforeach
				@else
				@if ($br < 1)
			<div class="card" style="width: 18rem;">
					<a href="{{ route('blog.single', $vpost->slug)}}">
					<img class="card-img-top" src="{{url('images/dodaci/noimage.gif')}}" height="300" />
					</a>
					<div class="card-body">
						 <h5 class="card-title">{{ $vpost->title }}</h5>
						 <p class="card-text">{{ substr($vpost->body, 0, 100)  }} {{ strlen($vpost->body) > 100 ? "..." : ""}}</p>
						 <a href="{{url('bike/'. $vpost->slug)}}" class="btn btn-primary"> Read More </a> <p id="views"> Views: {{ $vpost->getPageViews() }} </p>
					</div>
				</div>
				@else
				@endif
				<?php $br = $br + 1; ?>
			@endif
		@endforeach

 		</div>
	</div>
</div>

<div class="container welcomedrugi">
	<h3 class="BlogTitle">Most popular Bikes: </h3>
	<br>
	<div class="row">
			<div class="card-deck">
				<?php $aha = 0; ?>
		@foreach($rposts as $rpost)
			<?php $aha = $aha + 1; ?>
			@foreach ($pomocposts as $pomocpost)
				<?php $br = 0; $brr = 0; ?>
				@if ($rpost->id == $pomocpost->id)
					@if ($pomocpost->images->count() != 0 )
					@foreach($pomocpost->images as $image)
						@if ($br < 1)

						<div class="card" style="width: 18rem;">
							<a href="{{ route('blog.single', $pomocpost->slug)}}">
							<img class="card-img-top" src="{{asset('images/'. $image->name)}}" height="300" />
							</a>
							<div class="card-body">
								 <h5 class="card-title">{{ $pomocpost->title }}</h5>
								 <p class="card-text">{{ substr($pomocpost->body, 0, 100)  }} {{ strlen($pomocpost->body) > 100 ? "..." : ""}}</p>
								 <a href="{{url('bike/'. $pomocpost->slug)}}" class="btn btn-primary"> Read More </a> <p id="views"> Views: {{ $pomocpost->getPageViews() }} </p>
							</div>
						</div>
						@else
						@endif
						<?php $br = $br + 1; ?>
					@endforeach
				@else
					@if ($br < 1)

					<div class="card" style="width: 18rem;">
						<a href="{{ route('blog.single', $pomocpost->slug)}}">
						<img class="card-img-top" src="{{url('images/dodaci/noimage.gif')}}" height="300" />
						</a>
						<div class="card-body">
							 <h5 class="card-title">{{ $pomocpost->title }}</h5>
							 <p class="card-text">{{ substr($pomocpost->body, 0, 100)  }} {{ strlen($pomocpost->body) > 100 ? "..." : ""}}</p>
							 <a href="{{url('bike/'. $pomocpost->slug)}}" class="btn btn-primary"> Read More </a> <p id="views"> Views: {{ $pomocpost->getPageViews() }} </p>
						</div>
					</div>
					@else
					@endif
					<?php $br = $br + 1; ?>
				@endif
				@else
				@endif
			@endforeach
			@if ($aha == 4)
				@break
			@else
			@endif
		@endforeach
		</div>
	</div>
</div>


@endsection
