@extends('layouts.tdashboard')

@section('title', 'Teacher Dashboard')

@section('tboard')



<div class="container-fluid">

<tboard :t_login="{{$teacher}}" :subjects="{{$subjects}}"></tboard>


</div>

@endsection
