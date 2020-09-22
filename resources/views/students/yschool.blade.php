@extends('layouts.dashboard')

@section('title', 'Year school Student List')

@section('content')

    <div class="container-fluid">
  
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success"> {{$h->count()}} Students Record</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  
                    <th>Roll#</th>
                    <th>First Name</th>
                    <th>Surame</th>
                    <th>Email</th>
                    <th>Parent Email</th>
                    <th>Gender</th>
                    <th>Contact</th>
                   
                  
                  </thead>
                  <tbody>
                    @foreach ($h as $item)
                    <tr>
                    <th scope="row">{{ $item->roll_no }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->surname}}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->p_email }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->contact }}</td>
                    
                    </tr>
                    @endforeach
                   
                  </tbody>
                
                </table>
             
              </div>
            </div>
          </div>
         
    </div>
@endsection
  