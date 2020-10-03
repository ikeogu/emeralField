@extends('layouts.dashboard')

@section('title', 'Total Continuous AssessMent')

@section('content')


<div class="container-fluid" > 
   <div class="card">
        <div class="card-header bg-success text-white">Total Continuous Assessment {{$class_->name}}|  {{$class_->description}}  |  {{$term->name}} ||  {{$term->session}}</div>
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
                        
                        <td>{{$key + 1}}</td>
                        <td>{{$student->name}}</td>                    
                        @foreach ($student->subjectMark as  $keys => $item)
                             @if($item->term_id === $term->id && $item->s5_class_id === $class_->id)                 
                            <td>{{$item->TCA}}</td>
                            @php
                                $total += $item->TCA;
                            @endphp 
                            @endif 
                        @endforeach
                        
                        <td>{{$total}}</td>

                        <td>{{App\Student::average($total,$student->subjectMark->count())}}</td>
                        @php
                            $sum_total += $total;
                            
                            $avg = App\Student::average($total,$student->subjectMark->count());
                            $avgPer = App\Student::averPer($avg,$TCA_score);
                            $total = 0;
                            $min_t +=$avg; 
                            $min_t_per +=$avgPer; 
                        @endphp
                        <td>{{App\Student::averPer($avg,$TCA_score)}} </td>
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
                        <td>{{App\Student::subject_total_TCA($item->id,$class_->id,$term->id)}} </td>
                        @endforeach
                        <td>{{$sum_total}}</td>
                        <td>{{$min_t}}</td>
                        <td>{{$min_t_per}}</td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <th>Max Score</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::max_score_TCA($item->id,$class_->id,$term->id)}}</td>
                        @endforeach
                        
                    </tr>
                    <tr>
                        <td></td>
                        <th>Min Score</th>
                        @foreach ($subject as $item)
                             <td>{{App\Student::min_score_TCA($item->id,$class_->id,$term->id)}}</td>
                        @endforeach
                        
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Subject Average</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::average(App\Student::subject_total_TCA($item->id,$class_->id,$term->id),$students->count())}}</td>
                        @endforeach
                        
                       
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Subject Average (%)</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::average_per(App\Student::subject_total_TCA($item->id,$class_->id,$term->id),($TCA_score * $students->count()))}}</td>
                        @endforeach
                        
                       
                        
                    </tr> 
                    <tr>
                        <td></td>
                        <th>Remarks</th>
                        @foreach ($subject as $item)
                        <td>{{App\Student::grade(App\Student::average_per(App\Student::subject_total_TCA($item->id,$class_->id,$term->id),($TCA_score * $students->count())),$grades)}}</td>
                        @endforeach
                        
                        
                    </tr>   
                    
                </tbody>
                
                </table>
            </div>
        </div>
    </div> 
{{-- <summative-test :students="{{$students}}" :subject="{{$subject}}" :grades="{{$grades}}" :SMT_score="{{$SMT_score}}"></summative-test> --}}

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
              line-height: 120px;
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