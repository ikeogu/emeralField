@extends('layouts.dashboard')

@section('title', '{{$tudent->name}}')

@section('content')




    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">

            <div class="col-9">
                <h2 class="h3 mb-2 text-gray-800">Record of {{$student->surname}} {{$student->name}} </h2>
            </div>
            <div class="col-3" style="float:right;">
                <h5 class=" mb-2 text-gray-800 ">Level: {{$student->level}} </h5>
            </div>
        </div>
       
        

    <student-record :studs_data ="{{$data}}" :s_details ="{{$student}}" :term = "{{$term}}"></student-record>

    </div>

@endsection
