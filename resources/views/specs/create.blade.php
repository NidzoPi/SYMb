@extends('main')



@section('title', '| Create Post')



@section('scriptsandlinks')

{!! Html::style('css/parsley.css') !!}

{!! Html::script('js/parsley.min.js') !!}

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>







<script type="text/javascript">

	$(document).ready(function() {

    $('.js-example-basic-multiple').select2();

	});

</script>

<script>

$(function(){

	$('#form1').submit(function(event){

		var verified = grecaptcha.getResponse();

		if (verified.length === 0){

			document.getElementById('redara').innerHTML = 'Are you really a robot?';

			event.preventDefault();

		}

	});

});

</script>







@endsection



@section('content')

<div class="row">



	<div class="col-md-10 col-md-offset-2">

		<h1> Create Bike Specs: </h1>

		<hr>



		{!! Form::open(['route' => 'specs.store', 'data-parsly-validate' => '', 'files' => true, 'id' => 'form1']) !!}



		{{ Form::label ('title', 'Model:') }}

		{{ Form::text ('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
	</div>

	<div class="col-md-10 col-md-offset-2">

		{{ Form::label('category_id', 'Category: ') }}

		<select class="form-control" name="category_id">

			@foreach ($categories as $category)

				<option value="{{ $category->id }}"> {{ $category->name }} </option>

			@endforeach

		</select>
	</div>
	<div class="col-md-10 col-md-offset-2">
		{{ Form::label('tags', 'Tags: ') }}

		<select class="form-control js-example-basic-multiple" name="tags[]" multiple="multiple">

			@foreach ($tags as $tag)

				<option value="{{ $tag->id }}"> {{ $tag->name }} </option>

			@endforeach

		</select>
	</div>
</div>
<br>
<div class="row">
		<div class="col-md-2">

		{{ Form::label('ccm', 'ccm:')}}

		<input type="number" name="ccm" min="49" max="1500" class="form-control" placeholder="49-1500">

	</div>


	<div class="col-md-2">

		{{ Form::label('hp', 'Horse Power: ')}}

		<input type="number" name="hp" min="1" max="1000"  class="form-control" placeholder="1-1000" step=".01">

	</div>

	<div class="col-md-2">

		{{ Form::label('year', 'Year: ')}}

		<input type="year" name="year" min="1910" max="<?php echo date("Y"); ?>"  class="form-control" placeholder="1910-<?php echo date("Y"); ?>" step=".01">

	</div>
	<div class="col-md-2">
		{{ Form::label('engine', 'Engine: ')}}
	</div>
	<div class="col-md-2">
		{{ Form::label('price', 'Price: ')}}
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		{{ Form::label('torque', 'Torque: ')}}
	</div>
	<div class="col-md-2">
		{{ Form::label('compression', 'Compression ration: ')}}
	</div>
	<div class="col-md-2">
		{{ Form::label('cooling', 'Cooling system: ')}}
	</div>
	<div class="col-md-2">
		{{ Form::label('ignition', 'Ignition: ')}}
	</div>
	<div class="col-md-2">
		{{ Form::label('fuelsystem', 'Fuel system: ')}}
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		{{ Form::label('greasing', 'Greasing: ')}}
	</div>
	<div class="col-md-2">
		{{ Form::label('compression', 'Compression ration: ')}}
	</div>
	<div class="col-md-2">
		{{ Form::label('cooling', 'Cooling system: ')}}
	</div>
</div>

		<br>
			<div  style="padding-bottom: 20px;" class="g-recaptcha col-md-10 col-md-offset-2" data-sitekey="6Ld961kUAAAAAIGxahqCq0fT5uBMm65uzeFh6xCe"></div>

			<p id="redara"></p>

   		{{ Form::submit('Create Post', ['class' => 'btn btn-success btn-block button1']) }}



		{!! Form::close() !!}







	</div>



</div>



@endsection

