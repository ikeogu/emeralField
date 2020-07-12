@extends('layouts.dashboard')

@section('title', 'Student in Class List')

@section('content')




    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{$t->name}} Terms</h1>
      

    <student-class :terms="{{$terms}}" :t="{{$t}}"></student-class>

    </div>

@endsection
