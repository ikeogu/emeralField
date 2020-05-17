@extends('layouts.dashboard')

@section('title', 'Class List')

@section('content')



<div class="container-fluid">

<termclasses :term = "{{$classes}}" :sess="{{$term}}"></termclasses>

</div>

@endsection
