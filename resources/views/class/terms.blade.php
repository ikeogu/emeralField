@extends('layouts.dashboard')

@section('title', 'Student in Class List')

@section('content')




    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{$class->name}} Terms</h1>
      

    <terms :terms="{{$terms}}"></terms>

    </div>

@endsection
