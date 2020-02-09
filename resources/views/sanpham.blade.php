@foreach($sp as $value)
	{{$value->name}}
	&nbsp;|&nbsp;
	{{$value->soluong}}
	<br>
@endforeach
{!! $sp->links() !!}