@extends('layouts.studentboard')

@section('title', 'Student Result sUMMATIVE TEST')

@section('sboard')


<div class="container-fluid">
    <div class="card">
        <div class="card-header">GRAND TOTAL BROADSHEET</div>
        <div class="card-body">
            <div class="col-12 table-responsive">
                <table  class="table table-striped table-bordered m-0  text-default" style="width:100%">
                <thead class="header">
                    <th class="rotate">S/No</th>
                    <th >Name</th>
                    @php
                    $total = 0;
                    
                    @endphp
                    @foreach ($subject as  $key => $item)
                        <th class="rotate word" scope="col">{{$item->name}}</th>
                          
                    @endforeach
                
                
                    
                    <th class="rotate">Total</th>
                    <th class="rotate">Average</th>  
                    <th class="rotate">Average(%)</th> 
                    <th class="rotate">Remarks</th> 
                </thead>
                 @php
                        $total = 0;
                    @endphp                       
                    @foreach ($students as $key =>$student)
                    
                    <tr>
                        
                        <td>{{$key}}</td>
                        <td>{{$student->name}}</td>                    
                        @foreach ($student->subjectMark as  $key => $item)
                                              
                            <td>{{$item->GT}}</td>
                            @php
                                $total += $item->GT;
                            @endphp  
                        @endforeach
                        <td>{{$total}}</td>
                        <td>{{App\Student::average($total,$student->subjectMark->count())}}</td>
                        @php
                            $avg = App\Student::average($total,$student->subjectMark->count());
                            $avgPer = App\Student::averPer($avg,$GT_score);
                            $total = 0;
                        @endphp
                        <td>{{App\Student::averPer($avg,$GT_score)}} </td>
                        <td>{{App\Student::grade($avgPer,$grades)}}  </td>
                       
                        
                    </tr>
                    
                    @endforeach
                    <tr>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <th>Total</th>
                        <td>Number In</td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <th>Max Score</th>
                        <td>Number In</td>
                    </tr>
                    <tr>
                        <td></td>
                        <th>Min Score</th>
                        <td>Number In</td>
                    </tr>
                    <tr>
                        <td></td>
                        <th>Subject Average</th>
                        <td>Number In</td>
                    </tr>
                    <tr>
                        <td></td>
                        <th>Subject Average (%)</th>
                        <td>Number In</td>
                    </tr>  
                    
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    .rotate {
  transform: rotate(-90deg);

  /* Legacy vendor prefixes that you probably don't need... */
  /* Safari */
  -webkit-transform: rotate(-90deg);
  /* Firefox */
  -moz-transform: rotate(-90deg);
  /* IE */
  -ms-transform: rotate(-90deg);
  /* Opera */
  -o-transform: rotate(-90deg);
  /* Internet Explorer */
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}
.table { font-size: 1rem; }

@media (min-width: 576px) {
    .table { font-size: 1.25rem; }
}
/* @media (min-width: 768px) {
    .table { font-size: 1.5rem; }
}
@media (min-width: 992px) {
    .table { font-size: 1.75rem; }
}
@media (min-width: 1200px) {
    .table { font-size: 2rem; }
} */ 
.header th {
              line-height: 90px;
    }

.word th{
    word-break: break-word;
}
</style>
<script>


//Trim and re-trim only when necessary (prevent re-trim when string is shorted than maxLength, it causes last word cut) 
function shorten(text,max) {
    return text && text.length > max ? text.slice(0,max).split('/ (.*)/').slice(0, -1).join(' ') : text
}
    
</script>