@extends('layouts.studentboard')

@section('title', 'My term sheet')

@section('sboard')

<div class="container-fluid">
    

        <!-- Page Heading -->
        <div class="row">

            <div class="col-9">
                <h2 class=" mb-2 text-gray-800"> Session: {{$term->session}} {{$term->name}} </h2>
            </div>
            <div class="col-3" style="float:right;">
                <h5 class=" mb-2 text-gray-800 ">Class: {{$myclass->name}} </h5>
            </div>
            
        </div>
        <div class="row">
            
        </div>
        @if ($class_T->status === 'High School')
        <div class="row">
            <div class="col-4 d-flex ">
            <a href="{{route('cat1',[$student->id,$term->id,$class_T->id])}}" class="col-4 col-sm-4 btn btn-block btn-success">C.A.T 1</a>
            </div>
            <div class="col-4 d-flex justify-content-between">
            <a href="{{route('cat2',[$student->id,$term->id,$class_T->id])}}" class="col-4 btn  col-sm-4 btn-block btn-success">C.A.T 2</a>
            </div>
            <div class="col-4 d-flex justify-content-end">
            <a href="{{route('result',[$student->id,$term->id,$class_T->id])}}" class="col-4 btn col-sm-4 btn-block btn-success ">Result </a>
            </div>
          </div> 
        @else
        <div class="row">
            <a href="{{route('sum',[$student->id,$term->id,$class_T->id])}}" class="col-6 col-sm-6 btn btn-block btn-success">Summative </a>
            <div class="col-6 d-flex justify-content-end">
            <a href="{{route('result',[$student->id,$term->id,$class_T->id])}}" class="col-6  col-sm-6 btn btn-block btn-success ">Result </a>
            </div>
          </div> 
        @endif
       
            <term-sheet :s_details ="{{$student}}" :term="{{$term}}" :class_T="{{$class_T}}"></term-sheet>

</div>

@endsection
