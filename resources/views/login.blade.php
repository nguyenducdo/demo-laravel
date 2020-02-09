<form action="{{route('login1')}}" method="post">
	{{csrf_field()}}

	@if(!Auth::check())
		<div style="color: orange">Please login</div>
	@endif
	<br>
	<input type="text" name="username" placeholder="username">
	<input type="password" name="password" placeholder="password">
	<input type="submit">
	<br>
	@if(isset($mess))
		<div style="color: red">{{$mess}}</div>
		<br>
	@endif
	@if(isset($user))
		username: {{$user->username}}
		<br>
		email: {{$user->email}}
		<br>
		<a href="{{url('/logout')}}">Logout</a>
	@endif
	
</form>