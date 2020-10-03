@extends('layouts.dashboard')

@section('title', 'Student in Class List')

@section('content')




    <div class="container-fluid">

        <div class="row">

            <div class="col-6">
                <h2 class="h4 mb-2  text-success text-capitalize">{{$t->name}}</h2>
                <h2 class="h4 mb-2 text-success text-success">{{$t->session}}</h2>
            </div>
            <div class="col-6 " >
                <h5 class=" mb-2  text-success">CLASS: {{$class_T->name}} </h5>
                <h5 class=" mb-2  text-success">NAME: {{$class_T->description}} </h5>
            </div>
            
        </div>
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="{{route('summative',[$t->id,$class_T->id])}}"  class="btn btn-success">Summative BroadSheet</a>
            </div>
            <div class="col-md-3">
                <a href="{{route('tca',[$t->id,$class_T->id])}}"  class="btn btn-success">TCA BroadSheet</a>
            </div>
            <div class=" col-md-3 py-3">
                <a href="{{route('exam',[$t->id,$class_T->id])}}"  class="btn btn-success">Exam BroadSheet</a>
            </div>
            <div class="col-md-3">
                <a href="{{route('gt',[$t->id,$class_T->id])}}"  class="btn btn-success">Grand Total BroadSheet</a>
            </div>
        </div>

    <student-class :terms="{{$terms}}" :t="{{$t}}" :m="{{$class_T}}"></student-class>

    </div>

@endsection
