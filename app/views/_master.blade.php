<!doctype html>
<html>
<head>

	<title>@yield('title',"ShmoTime")</title>

	<link rel= "icon" type = "image/ico" href="images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/css/styles.css" >
	<link href='http://fonts.googleapis.com/css?family=Raleway|Lato|Lobster' rel='stylesheet' type='text/css'>
	
@yield('head')

</head>


<body>
	 
	@if(Session::get('flash_message'))
        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
    @endif
    
	<header >
		
		<div  id= 'logolink'><a href="/" alt="schedule"><h1>ShmoTime <img src="<?php echo URL::asset('images/clock.png'); ?>" alt="logo" id="logo"></h1></a></div><br>
		
		<div class="nav">
		<!-- check if user is logged in -->
		@if(Auth::check())
		    <div id = 'logout'><a href='/logout' alt="logout">Log out {{ Auth::user()->email; }}</a></div>
		@endif
		</div>
		
	</header>
	
	
@yield('content')

	<footer>
		<a href="/about" alt="About">About</a> |
		<a href="/contact" alt="Contact">Contact</a><br><br>
        © 2014  Elisa J Chuang
    </footer>

</body>

</html>