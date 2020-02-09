@extends('layouts/master')
@section('Content')
<h3>Laravel course</h3>
<?php 
$course1 = '<b>'.$course.'</b>';
echo $course1 . ' - localhost';
?>
<br>
{{$course1 .  '  - Cach 1'}}
<br>
{!!$course1 . '  - Cach 2'!!}
{{--comment--}}
<br>
@if(!empty($course))
@if($course == 'laravel')
{{'Course is laravel'}}
@elseif($course == 'php')
{{'Course is php'}}
@else
{{'Other course'}}
@endif
@else
{{'course empty'}}
@endif

@endsection

@section('Other')
<h3>Other course</h3>
@endsection

<!-- <h3>Footer</h3> -->