@extends('layouts.dashboard')

@section('title', '{{$tudent->name}}')

@section('content')




    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">

            <div class="col-4">
                <h2 class="h4 mb-2  text-success text-capitalize">{{$term->name}}</h2>
                <h2 class="h4 mb-2 text-success text-success">{{$term->session}}</h2>
            </div>
            <div class="col-4 justify-content-left flaot" >
                <h5 class=" mb-2  text-success">CLASS: {{$class_T->name}} </h5>
                <h5 class=" mb-2  text-success">NAME: {{$class_T->description}} </h5>
            </div>
            <div class="col-4 justify-content-left flaot" >
                <h5 class=" mb-2 text-success ">School: {{$student->level}} </h5>
            </div>
        </div>
        <div class="row">

            <div class="col-4 justify-content-center">
                <h2 class="h4 mb-2 text-white btn btn-success">{{$student->surname}} {{$student->name}} </h2>
            </div>
            
        </div>
       
        

    <student-record :studs_data ="{{$data}}" :s_details ="{{$student}}" :term="{{$term}}" :class_T="{{$class_T}}"></student-record>

    </div>

@endsection
<style>
    .float{float:right;}
</style>