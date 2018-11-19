<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>

    {!! Html::style('css/styles.css') !!}

    {!! Html::style('css/fornavstyles.css') !!}

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'SYMb') }}</title>



    <!-- Styles -->



</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbarfixed">

  <a class="navbar-brand" href="#">SYMb</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>



  <div class="collapse navbar-collapse divina" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">

      <li class="nav-item  {{Request::is('/') ? "active" : ""}}">

        <a class="nav-link" href="/" >Home <span class="sr-only">(current)</span></a>

      </li>

      <li class="nav-item {{Request::is('blog') ? "active" : ""}}">

        <a class="nav-link" href="/bikes">Bikes</a>

      </li>

      <li class="nav-item {{Request::is('forsale') ? "active" : ""}}">

        <a class="nav-link" href="/forsale">For sale</a>

      </li>

     <li class="nav-item {{Request::is('contact') ? "active" : ""}}">

        <a class="nav-link" href="/contact">Contact Us</a>

      </li>

    </ul>





    <ul class="navbar-nav ml-auto menug">

      <form method="GET" action="{{ route('search') }}">

        <input autocomplete="off" minlength="3" maxlength="29" type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search..">

      </form>



                        @guest

                            <li class="linav"><a id="anav" href="{{ route('login') }}">Login</a></li>

                            <li class="linav"><a id="anav" href="{{ route('register') }}">Register</a></li>

                        @else

                            <li class="dropdown show userludi dropdownn">

                                <a id="anav" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">

                                    {{ Auth::user()->name }} <span class="caret"></span>

                                </a>





                                <ul class="dropdown-menu dropdown-menu-right menud  bg-dark">



                                     <li id="menu" class="dropdown-item">

                                       <a id="sve" href="/posts"> <div id="stopo"> Posts </div> </a>

                                    </li>

                                    @if (Auth::user()->admin != 0)

                                     <li id="menu" class="dropdown-item">

                                       <a href="{{ route('categories.index') }}"> Categories </a>

                                    </li>

                                      <li class="dropdown-item">

                                       <a href="{{ route('tags.index') }}"> Tags </a>

                                    </li>

                                  @else

                                  @endif

                                    <div class="dropdown-divider"></div>

                                    <li  class="dropdown-item">

                                        <a href="{{ route('logout') }}"

                                            onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();">

                                            Logout

                                        </a>



                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                            {{ csrf_field() }}

                                        </form>

                                    </li>



                                </ul>

                            </li>

                        @endguest

    </ul>

  </div>

</nav>

</body>

</html>

