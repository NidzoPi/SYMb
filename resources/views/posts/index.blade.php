@extends('main')

@section('content')
 <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}

                        </div>
                    @endif
                    <br>

<div class="row">
	<div class="col-md-10">
		<h1> All Posts: </h1>

	</div>
	<div class="col-md-2">
		<a href="{{route('posts.create')}}" class="btn btn-primary btn-block btn-margin-s" id="hideonfive">Create New Post</a>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<th> # </th>
				<th> Title </th>
				<th> Body </th>
				<th> Created At </th>
				<th> </th>
			</thead>

			<tbody>
				<?php $br = 1; $k = 1; $kolikoihima = 0; $brr = 1; ?>
      @if(Auth::user()->admin == 0)
				@foreach($posts as $post)
				<tr>
				@if (Auth::user()->id == $post->user_id)
				 <?php $br = $br + 1; ?>
				 <th> {{ $post->id }} </th>
				 <td> {{ $post->title }} </td>
				 <td> {{ substr($post->body, 0, 50)}} {{strlen($post->body) > 50 ? "..." : ""}} </td>
				 <td> {{ date('j.M.Y', strtotime($post->created_at)) }} </td>
				 <td> <a href="{{route('posts.edit', $post->id)}}" class="btn btn-basic"> Edit </a> <a href="{{route('posts.show', $post->id)}}" class="btn btn-basic"> View </a> </td>
         <?php $kolikoihima = $kolikoihima + 1; ?>
				 @else
				 @endif
				</tr>
				@endforeach
      @else
      	@foreach($posts as $post)
         <tr>
         	<?php $brr = $brr + 1; ?>
         <th> {{ $post->id }} </th>
 				 <td> {{ $post->title }} </td>
 				 <td> {{ substr($post->body, 0, 50)}} {{strlen($post->body) > 50 ? "..." : ""}} </td>
 				 <td> {{ date('j.M.Y', strtotime($post->created_at)) }} </td>
 				 <td> <a href="{{route('posts.edit', $post->id)}}" class="btn btn-basic"> Edit </a> <a href="{{route('posts.show', $post->id)}}" class="btn btn-basic"> View </a> </td>
         </tr>
        @endforeach
      @endif
        <script type="text/javascript">
        var php_var = "<?php echo $kolikoihima; ?>";
        if (php_var >= 5){
          //  document.getElementById('hideonfive').style.display = 'none';
          var element, name, arr;
          element = document.getElementById("hideonfive");
          name = "btn btn-primary disabled";
          arr = element.className.split(" ");
          if (arr.indexOf(name) == -1) {
            element.className += " " + name;
          }
        }
        </script>
			</tbody>
		</table>

		 <?php
		 $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		 $url = Request::url();
		 ?>

		 @if ($actual_link == $url)
		 	@if ($br >= 5 || $brr >= 5)
		 		{!! $posts->links() !!}
		 	@else
			@endif
		@else
		<?php if (isset($_GET['page'])) { $currentpage = $_GET['page']; } else { $currentpage = 1; } ?>
			@if($currentpage > 1 || $br >= 5 || $brr >= 5)
			 {!! $posts->links() !!}
			@else
			@endif
		@endif

	</div>
</div>


@stop
