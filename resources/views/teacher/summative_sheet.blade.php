@extends('layouts.tdashboard')

@section('title', 'Student Result SUMMATIVE TEST')

@section('style')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/sumative.css')}}">

@endsection  
@section('tboard')




        
    <!-- details table -->
        <section class="container my-5">
            <div class="d-flex justify-content-center py-4 mb-2"><img src="{{asset('img/logo2.png')}}" height="90" width="auto"></div>
            <strong class="d-flex justify-content-center">EMERALD FIELD SCHOOLS</strong>
            <strong class="d-flex justify-content-center ">SUMMATIVE TEST RESULT</strong>
           
            <div class="col-12 col-md-8 p-0 table-responsive">
                <table class="details-table table-sm ">
                    <tr>
                        <th>SESSION:</th>
                        <td>
                            <ul>
                            <li>{{$term->session}}</li>
                                <li>Term:</li>
                            <li>{{$term->name}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>NAME:</th>
                        <td>
                            <ul>
                            <li>{{$student->name}} {{$student->surname}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>CLASS:</th>
                        <td>
                            <ul>
                            <li>{{$class_->name}} {{$class_->description}}</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- main result table -->
            <div class="col-12 col-md-12 my-4 mx-auto p-0">
                <div class="table-responsive">
                    <table class="table-sm table table-bordered table-hover main-result-table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">SUBJECT</th>
                                <th scope="col">SCORE ({{$SMT_score}})</th>
                                <th scope="col">SUBJECT MAX SCORE ({{$SMT_score}})</th>
                                <th scope="col">SUBJECT AVERAGE SCORE ({{$SMT_score}})</th>
                            </tr>
                        </thead>
                        @php
                        $total = 0;
                        $sum_total = 0;
                        
                        
                        
                    @endphp  
                        <tbody>
                            @foreach ($scores as $key=> $item)
                            <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->subname}}</td>
                            
                            <td>{{$item->summative_test}}</td>
                            @php
                                $total += $item->summative_test;
                            @endphp 
                            
                             <td>{{App\Student::max_score($item->subject_id,$class_->id,$term->id)}}</td>
                            <td>{{App\Student::average(App\Student::subject_total($item->subject_id,$class_->id,$term->id),$users->count())}}</td>
                            </tr> 
                            @endforeach
                            <tr class="average">
                                <td></td>
                                <td>Total</td>
                                <td>{{$total}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                           
                            <tr class="average">
                                <td></td>
                                <td>average (100%)</td>
                                <td>{{App\Student::averPer(App\Student::average($total,$scores->count()),$SMT_score)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="remarks">
                                <td></td>

                                <td>remarks</td>
                                <td>{{App\Student::grade(App\Student::averPer(App\Student::average($total,$scores->count()),$SMT_score),$grades)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="key">
                                <td></td>
                                <td class="text-left">key</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left"><span>a+ (95 - 100%)</span> <span class="pl-3">a (90 - 94%)</span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left">a+ <span>(95 - 100%)</span> <span class="pl-3">a (90 - 94%)</span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left"><span>c+ (75 - 79%)</span> <span class="pl-3">c (61 - 74%)</span></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left">d (50 - 60%)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-left">needs improvement (49% & below) </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection