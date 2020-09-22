@extends('layouts.dashboard')

@section('title', 'Student Result Exam ')

@section('content')


<div class="container-fluid">
    <div class="card">
        <div class="card-header">EXAM BROADSHEET</div>
        <div class="card-body">
            <div class="col-12 table-responsive">
                <table  class="table table-striped table-bordered  text-default">
                <thead class="header">
                    <th class="rotate">S/No</th>
                    <th >Name</th>
                    
                    @foreach ($subject as  $key => $item)
                        <th class="rotate word" scope="col">{{$item->name}}</th>
                          
                    @endforeach
                
                
                    
                    <th class="rotate">Total</th>
                    <th class="rotate">Average</th>  
                    <th class="rotate">Average(%)</th> 
                    <th class="rotate">Remarks</th> 
                </thead>
                <tbody>  
                     @php
                        $total = 0;
                        $sum_total = 0;
                        $min_t = 0;
                        $min_t_per = 0;
                    @endphp                       
                    @foreach ($students as $key =>$student)
                    
                    <tr>
                        
                        <td>{{$key}}</td>
                        <td>{{$student->name}}</td>                    
                        @foreach ($student->subjectMark as  $keys => $item)
                                              
                            <td>{{$item->Exam}}</td>
                            @php
                                $total += $item->Exam;
                            @endphp  
                        @endforeach
                        <td>{{$total}}</td>

                        <td>{{App\Student::average($total,$student->subjectMark->count())}}</td>
                        @php
                            $sum_total += $total;
                            
                            $avg = App\Student::average($total,$student->subjectMark->count());
                            $avgPer = App\Student::averPer($avg,$EXAM_score);
                            $total = 0;
                            $min_t +=$avg; 
                            $min_t_per +=$avgPer; 
                        @endphp
                        <td>{{App\Student::averPer($avg,$EXAM_score)}} </td>
                        <td>{{App\Student::grade($avgPer,$grades)}}  </td>
                       
                        
                    </tr>
                    
                    @endforeach
                    
                     <tr>
                        <th></th>
                    </tr> 
                   
                     <tr>
                        <td></td>
                        <th>Total</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::subject_total_E($item->id)}} </td>
                        @endforeach
                        <td>{{$sum_total}}</td>
                        <td>{{$min_t}}</td>
                        <td>{{$min_t_per}}</td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <th>Max Score</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::max_score_E($item->id)}}</td>
                        @endforeach
                        
                    </tr>
                    <tr>
                        <td></td>
                        <th>Min Score</th>
                        @foreach ($subject as $item)
                             <td>{{App\Student::min_score_E($item->id)}}</td>
                        @endforeach
                        
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Subject Average</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::average(App\Student::subject_total_E($item->id),$students->count())}}</td>
                        @endforeach
                        
                       
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Subject Average (%)</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::average_per(App\Student::subject_total_E($item->id),($EXAM_score * $students->count()))}}</td>
                        @endforeach
                        
                       
                        
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Remarks</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::grade(App\Student::average_per(App\Student::subject_total_E($item->id),($EXAM_score * $students->count())),$grades)}}</td>
                        @endforeach
                        
                        
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