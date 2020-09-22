@extends('layouts.dashboard')

@section('title', '{{$tudent->name}}')

@section('content')




    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">

            <div class="col-8">
                <h2 class="h4 mb-2 text-gray-800">Record of {{$student->surname}} {{$student->name}} </h2>
            </div>
            <div class="col-4 justify-content-left flaot" >
                <h5 class=" mb-2 text-gray-800 ">Level: {{$student->level}} </h5>
            </div>
        </div>
       
        

    <student-record :studs_data ="{{$data}}" :s_details ="{{$student}}" :term = "{{$term}}"></student-record>

    </div>

@endsection
<style>
    .float{float:right;}
</style>