@extends('layouts.dashboard')

@section('title', "Class's Students")

@section('content')




    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="float-left col-md-6">
            <h3 class="h3 mb-2 text-gray-800">{{$t->name}} {{$t->session}}</h3>
            </div>
            <div class="float-right col-md-6">
            <h3 class="h3 mb-2 text-gray-800">{{$class_->name}} {{$class_->description}}</h3>
            </div>
        </div>
        <div class="row mt-5">
            <div class="float-left col-md-4">
                <a href="{{route('summative',[$t->id])}}"  class="btn btn-success">Summative BroadSheet</a><br>
            </div>
            <div class=" col-md-4 py-3">
                <a href="{{route('exam',[$t->id])}}"  class="btn btn-success">Exam BroadSheet</a>
            </div>
            <div class="float-right col-md-4">
                <a href="{{route('gt',[$t->id])}}"  class="btn btn-success">Grand Total BroadSheet</a>
            </div>
        </div>

    <class-student :students="{{$students}}" :t="{{$t}}" ></class-student>

    </div>

@endsection
