@extends('layouts.tdashboard')

@section('title', 'Teacher Dashboard')

@section('tboard')



<div class="container-fluid table-responsive">

    <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Term</th>
            <th scope="col">Class</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($classt as $key => $item)
            <tr>
                <th scope="row">{{$key}}</th>
                <td>{{$item->term}}</td>
                <td>{{$item->myclass}}</td>
                <td>
                <a type="button" href="https://emerald-field-school.herokuapp.com/api/students_in_term2/{{$item->term_id}}/class/{{$item->s5_class_id}}" class="btn btn-success btn-block">View</a>
                </td>
            </tr>
            @endforeach
          
          
        </tbody>
      </table>

</div>

@endsection
