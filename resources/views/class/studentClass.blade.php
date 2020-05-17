@extends('layouts.dashboard')

@section('title', 'Student in Class List')

@section('content')




    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Students in {{$class->name}} </h1>
        
        <!-- DataTales Example -->
        {{-- <div class="card shadow mb-4">
          <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"> {{count($students)}} Students </h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  
                    <th>Surname</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Age</th>
                   
                  
                </thead>
                <tbody>
                    @for($i = 0; $i < count($students); $i++)
                        @foreach($students[$i] as $s)
                        <tr>
                            <td>{{$s->surname}}</td>
                            <td>{{$s->name}}</td>
                            <td>{{$s->email}}</td> 
                            <td>{{$s->dob}}</td>
                            <td>{{$s->gender}}</td>
                            <td>{{floor((time() - strtotime($s->dob))/31556926)}}</td>
                        </tr>
                        @endforeach
                    @endfor
                </tbody>
                
              </table>
            </div>
           </div>
          </div>
  
        </div> --}}

    <student-class :studs="{{$students}}"></student-class>

    </div>

@endsection
