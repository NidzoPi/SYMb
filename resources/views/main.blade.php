<!DOCTYPE html>

<html>

<head>

@include('partials._head')

</head>

<body>



@include('partials._nav')

<!--  -->

<div class="container">

		@include('partials._messages')

		@yield('content')



</div>

<hr>

<div class="footer">

	@if(Auth::check())

	<div class="footer1">

		<img class = "kaciga" src = "/images/dodaci/kaciga.png"/>

	</div>

	<div class="footer2">

		<p id="usersinfooter2"> = 	{{ Auth::user()->count() }} 	 </p>

	</div>

	@else

	@endif



		<a id="nikola" href = "https://www.facebook.com/nikola.plilipovic" target="_blank">

			<p id="nidzo" class="text-center"> © NPilipovic </p>

		</a>

		<p class="version-center"> Version 1.0 </p>

</div>

</body>

</html>

