@extends('main')
@section('scriptsandlinks')
  <script>
  $(function(){
  	$('#reused_form').submit(function(event){
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
  <form role="form" method="post" id="reused_form" action="{{ route('contact.store') }}">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="name"> Your Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="col-sm-6 form-group">
            <label for="email"> Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 form-group">
            <label for="message"> Message:</label>
            <textarea class="form-control" type="textarea" name="message" id="message" maxlength="6000" rows="7"></textarea>
        </div>
    </div>
	<div style="padding-bottom: 20px;" class="g-recaptcha" data-sitekey="6Ld961kUAAAAAIGxahqCq0fT5uBMm65uzeFh6xCe"></div>
  <p id="redara"></p>
    <div class="row">
        <div class="col-sm-12 form-group">
            <button type="submit" class="btn btn-lg btn-default pull-right" >Send &rarr;</button>
        </div>
    </div>

   </form>
@endsection
