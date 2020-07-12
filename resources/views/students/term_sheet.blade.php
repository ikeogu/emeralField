@extends('layouts.studentboard')

@section('title', 'My term sheet')

@section('sboard')

<div class="container-fluid">
    

        <!-- Page Heading -->
        <div class="row">

            <div class="col-9">
                <h2 class="h3 mb-2 text-gray-800"> Session: {{$term->session}} {{$term->name}} </h2>
            </div>
            <div class="col-3" style="float:right;">
                <h5 class=" mb-2 text-gray-800 ">Class: {{$myclass->name}} </h5>
            </div>
        </div>
            <term-sheet :s_details ="{{$student}}" :term = "{{$term}}"></term-sheet>

</div>

@endsection
