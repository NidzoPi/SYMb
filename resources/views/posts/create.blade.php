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

		<h1> Create Post </h1>

		<hr>



		{!! Form::open(['route' => 'posts.store', 'data-parsly-validate' => '', 'files' => true, 'id' => 'form1']) !!}



		{{ Form::label ('title', 'Model:') }}

		{{ Form::text ('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}



		{{ Form::label('sale', 'For sale:') }}

		<select class="form-control" name="sale" onchange="showDiv(this)">

			<option value="0"> NO </option>

			<option value="1"> YES </option>

		</select>

		<div id="phone_number" style="display: none;"> Phone number : <input name="phone_number" type = "textarea">

		 </div>

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

		{{ Form::label('category_id', 'Category: ') }}

		<select class="form-control" name="category_id">

			@foreach ($categories as $category)

				<option value="{{ $category->id }}"> {{ $category->name }} </option>

			@endforeach

		</select>



		{{ Form::label('tags', 'Tags: ') }}

		<select class="form-control js-example-basic-multiple" name="tags[]" multiple="multiple">

			@foreach ($tags as $tag)

				<option value="{{ $tag->id }}"> {{ $tag->name }} </option>

			@endforeach

		</select>





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





   		{{ Form::label ('body', 'About you and your motorcycle:') }}

   		{{ Form::textarea('body', null, array ('class' => 'form-control', 'id' =>'editor', 'minlength' => '150', 'required' => '', 'oninvalid' => 'alert("Add more characters!")')) }}
   		<p id="charactersRemaining"></p>
   		<div id="hiddenimage">
   		<img src="/images/dodaci/favicon.png"/>
   		<p id="ajdesno"> Nice text, thank you! </p>
   		</div>
   		<br>

			<div style="padding-bottom: 20px;" class="g-recaptcha" data-sitekey="6Ld961kUAAAAAIGxahqCq0fT5uBMm65uzeFh6xCe"></div>

			<p id="redara"></p>

   		{{ Form::submit('Create Post', ['class' => 'btn btn-success btn-block button1', ]) }}



		{!! Form::close() !!}







	</div>



</div>

<script type="text/javascript">
var el;
                                             

function countCharacters(e) {                                    
  var textEntered, countRemaining, counter;          
  textEntered = document.getElementById('editor').value;
  var tlength = textEntered.replace(/\s/g, "").length;  
  counter = (150 - (tlength));
  countRemaining = document.getElementById('charactersRemaining'); 
  countRemaining.textContent = counter;
  localStorage.setItem("counterStorage",tlength);
  if (counter <= 0) {
	  $('#hiddenimage').show();
	  $('#charactersRemaining').hide();
	  document.removeEventListener('invalid', countCharacters);
  }
  else
  {
	  $('#hiddenimage').hide();
	  $('#charactersRemaining').show();
  }


}

el = document.getElementById('editor');                   
el.addEventListener('keyup', countCharacters, false);

</script>



@endsection

