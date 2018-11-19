@extends('main')

@section('title', '| Edit Blog Post')

@section('scriptsandlinks')

{!! Html::style('css/select2.min.css') !!}
{!! Html::script('js/select2.min.js') !!}

<script>
 function showDiv(elem){
		if(elem.value == 1){
		 document.getElementById('phone_number').style.display = "block";
		}
		else{
			document.getElementById('phone_number').style.display = "none";
		}
}
</script>

<script type="text/javascript">
	$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
	});
</script>

@endsection

@section('content')

<div class="row">
@if (Auth::user()->id == $post->user_id || Auth::user()->admin == 1)
	<div class="col-md-8">

	{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}

	{{ Form::label('title', 'Title:') }}
	{{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

	{{ Form::label('sale', " For sale:") }}

	<select class="form-control" name="sale" id="sale" onchange="showDiv(this)">
		<option value="0" <?php if ($post->sale == 0) echo 'selected'; ?> > NO </option>
		<option value="1" <?php if ($post->sale == 1) echo 'selected'; ?>> YES </option>
	</select>

	<br>
	<div id="phone_number"> Phone number :
		{{ Form::text('phone_number', null) }}
	 </div>
	 @if ($post->sale == 1 )
	 	<script>
	 		document.getElementById('phone_number').style.display = "block";
	 	</script>
	 @else
	 @endif

<div class="col-md-2">
		{{ Form::label('ccm', " ccm:") }}
		{{ Form::number('ccm', null, ['class' => 'form-control'])}}
</div>
<div class="col-md-2">
		{{ Form::label('hp', " Horse power:") }}
		{{ Form::number('hp', null, ['class' => 'form-control'])}}
</div>
<div class="col-md-2">
		{{ Form::label('year', " Year:") }}
		{{ Form::text('year', null, ['class' => 'form-control'])}}
</div>
<br>
	{{ Form::label('category_id', "Category:") }}
	{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

	{{ Form::label('tags', 'Tags: ') }}
	{{ Form::select('tags[]', $tags, null, ['class' => 'form-control js-example-basic-multiple', 'multiple' => 'multiple'] )}}

	{{ Form::label('body', 'Body:') }}
	{{ Form::textarea('body', null, ['class' => 'form-control', 'maxlength' => '850']) }}

	</div>

	<div class="col-md-4">
		<div class="well well-sm">
			<dl class="dl-horizontal">
				<dt> Created At: </dt>
				<dd> {{ date ('j.M.Y , H:i', strtotime ($post->created_at))}} </dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>  Last Updated At:  </dt>
				<dd> {{ date ('j.M.Y , H:i', strtotime ($post->updated_at))}} </dd>
			</dl>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute ('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}

				</div>
				<div class="col-sm-6">
					{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
@else
 <div class="col-md-12">
 	<h1> This is not your post! </h1>
 </div>
@endif
</div>


@stop
