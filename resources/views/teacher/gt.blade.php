@extends('layouts.tdashboard')

@section('title', 'GRAND TOTAL BROADSHEET')

@section('tboard')


<div class="container-fluid">
    <div class="card">
    <div class="card-header bg-success text-capitalize text-white">GRAND TOTAL BROADSHEET {{$class_->name}}|   {{$class_->description}}  | {{$term->name}}|  {{$term->session}}</div>
        <div class="card-body">
            <div class="col-12 table-responsive">
                <table  class="table table-striped table-bordered m-0  text-default" style="width:100%">
                <thead class="header">
                    <th class="rotate">S/No</th>
                    <th >Name</th>
                    @php
                    $total = 0;
                     $sum_total = 0;
                     $min_t = 0;
                     $min_t_per = 0;
                     $cl_av = 0;
                    @endphp     
                    @foreach ($subject as  $key => $item)
                        <th class="rotate word text-lowercase" scope="col">{{\Illuminate\Support\Str::limit($item->name, 12, $end='...')}}</th>
                          
                    @endforeach
                
                
                    
                    <th class="rotate">Total</th>
                    <th class="rotate">Average</th>  
                    <th class="rotate">Average(%)</th> 
                    <th class="rotate">Remarks</th> 
                </thead>
                                     
                    @foreach ($students as $key =>$student)
                    
                    <tr>
                        
                        <td>{{$key + 1}}</td>
                        <td>{{$student->surname}} {{$student->name}}  {{$student->oname}}</td>                   
                        @foreach ($student->subjectMark as  $key => $item)
                        @if($item->term_id === $term->id && $item->s5_class_id === $class_->id)                 
                            <td>{{$item->GT}}</td>
                            @php
                                $total += $item->GT;
                            @endphp  
                        @endif
                        @endforeach
                        <td>{{$total}}</td>
                        <td>{{App\Student::average($total,$subject->count())}}</td>
                        @php
                            $sum_total += $total;
                            $avg = App\Student::average($total,$subject->count());
                            $avgPer = App\Student::averPer($avg,$GT_score);
                            $total = 0;
                        @endphp
                        <td>{{App\Student::averPer($avg,$GT_score)}} </td>
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
                        <td>{{App\Student::subject_total_GT($item->id,$class_->id,$term->id)}} </td>
                        @endforeach
                        <td>{{$sum_total}}</td>
                        <td>{{$min_t}}</td>
                        <td>{{$min_t_per}}</td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <th>Max Score</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::max_score_GT($item->id,$class_->id,$term->id)}}</td>
                        @endforeach
                        
                    </tr>
                    <tr>
                        <td></td>
                        <th>Min Score</th>
                        @foreach ($subject as $item)
                             <td>{{App\Student::min_score_GT($item->id,$class_->id,$term->id)}}</td>
                        @endforeach
                        
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Class Average</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::average(App\Student::subject_total_GT($item->id,$class_->id,$term->id),$students->count())}}</td>
                        @endforeach
                        
                       
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Class Performance (%)</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::average_per(App\Student::subject_total_GT($item->id,$class_->id,$term->id),($GT_score * $students->count()))}}</td>
                        @php
                            $cl_av += App\Student::average_per(App\Student::subject_total_GT($item->id,$class_->id,$term->id),($GT_score * $students->count()));
                        @endphp
                        @endforeach
                        <td>{{App\Student::average($cl_av,$subject->count())}}</td>
                        <td>Class Average</td>
                       
                        
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Remarks</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::grade(App\Student::average_per(App\Student::subject_total_GT($item->id,$class_->id,$term->id),($GT_score * $students->count())),$grades)}}</td>
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
    th, td{
    font-size: 12px;
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