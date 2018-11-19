<br>
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
	<strong> Success: </strong> {{Session::get('success')}}
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger" role="alert">
	<strong> Errors: </strong>
	<uL>
	@foreach($errors->all() as $error)
	<li> $error </li>
	@endforeach
	<!-- <p> Tips: </p>
	<ul>
		<li> Try to change Slug, maybe someone else using same.  </li>
		<li> Add more characters!  </li>
		<li> Your Email/Password is incorrect! </li>
		<li> You don't have an account! </li>
		<li> You didn't fill the Rate field! </li>
		<li> You have to rate on a scale of 1-10! </li>

	</ul>
	</uL> !-->
</div>
@endif