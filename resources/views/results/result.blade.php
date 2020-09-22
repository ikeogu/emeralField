@extends('layouts.studentboard')

@section('title', 'Student Result')

@section('sboard')

<div class="container-fluid">

    <table class="table table-bordered">
        <div class="row">
            <div class="col-2">
                <img src="/img/logo.jpg" height="170" width="auto">
            </div>
            <div class="col-10 row">
                <div class="green col-6">
                    <h2>EmeraldField Schools</h2>
                    <h6>2 Ekorinim Road, Off Murtala Mohammed Highway,<br> Ekorinim, Calabar, Cross River State. </h6>
                    <h6>+234(0) 809 909 9434  +234 (0) 812 247 6390</h6>
                    <p>Website: www.emeraldfieldschool.com Email:info@efs.com</p>
                </div>
                <div class="yellow col-6">
                    <h4>YEAR CLASSES</h4>
                    <h4>REPORT CARD</h4>
                    <h5>TERM </h5>
                </div>
            </div>
            
        </div>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
</div>

@endsection
