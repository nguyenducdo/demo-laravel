<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Course</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
</head>
<body>
	@include('layouts/header')
	<div id="content">
		<h1>Course</h1>
		@yield('Content')
	</div>
	@include('layouts/footer')
</body>
</html>