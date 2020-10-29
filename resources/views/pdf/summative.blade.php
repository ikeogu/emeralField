<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://emerald-field-school.herokuapp.com/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://emerald-field-school.herokuapp.com/css/font-awesome.css">
    <title>Summative Test</title>
    <style>
            @import url("https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;600;800&display=swap");

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: 'Nunito sans', sans-serif;
        }

        header{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        header p{
            line-height: 0.4;
            font-size: 0.9em;
            font-weight: 600;
        }

        .details-table{
            width: 100%;
        }

        .details-table th{
            width: 60px;  
        }

        .details-table ul{
            border: 1px solid #ccc;
            height: 40px;
            display: flex;
            justify-content: space-between;
            margin: 0;
        }

        .details-table ul li{
            list-style: none;
            line-height: 2.5;
            padding: 0 10px;
            text-transform: uppercase;
        }

        .details-table ul li:nth-child(2){
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            /* padding: 0 20px; */
            text-align: center;
        }

        .main-result-table th{
            text-transform: uppercase;
            font-size: 0.9em;
        }
        .main-result-table td{
            text-transform: uppercase;
            width: 100%;
        }

        .main-result-table td:nth-child(1){
            width: 40%;
            text-align: center;
        }

        .main-result-table td:nth-child(3){
            text-align: center;
        }

        .main-result-table td:nth-child(4){
            text-align: center;
        }

        .main-result-table td:nth-child(5){
            text-align: center;
        }

        .average td:nth-child(1){
            text-align: left;
        }

        .average td:nth-child(2){
            text-align: center;
        }

        .remarks td:nth-child(1){
            text-align: left;
        }

        .remarks td:nth-child(2){
            text-align: center;
        }
    </style>
</head>
<body>
    
        
        <section class="container-fluid">
            <div class="d-flex justify-content-center py-4 mb-2"><img src="https://emerald-field-school.herokuapp.com/img/logo2.png" height="90" width="auto"></div>
            <strong class="d-flex justify-content-center">EMERALD FIELD SCHOOLS</strong>
            <strong class="d-flex justify-content-center ">SUMMATIVE TEST RESULT</strong>
        
            <div class="col-12 col-md-8 p-0 table-responsive">
                <table class="details-table table-sm ">
                    <tr>
                        <th>SESSION:</th>
                        <td>
                            <ul>
                            <li>{{$data['term']->session}}</li>
                                <li>Term:</li>
                            <li>{{$data['term']->name}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>NAME:</th>
                        <td>
                            <ul>
                            <li>{{$data['student']->name}} {{$data['student']->surname}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>CLASS:</th>
                        <td>
                            <ul>
                            <li>{{$data['class_']->name}} {{$data['class_']->description}}</li>
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
                                <th scope="col">SCORE (20)</th>
                                <th scope="col">SUBJECT MAX SCORE (20)</th>
                                <th scope="col">SUBJECT AVERAGE SCORE (20)</th>
                            </tr>
                        </thead>
                        @php
                        $total = 0;
                        $sum_total = 0;
                        $SMT_score = 20;
                        
                        
                    @endphp  
                        <tbody>
                            @foreach ($$data['scores'] as $key=> $item)
                            <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->subname}}</td>
                            
                            <td>{{$item->summative_test}}</td>
                            @php
                                $total += $item->summative_test;
                            @endphp 
                            
                             <td>{{App\Student::max_score($item->subject_id,$data['class_']->id,$data['term']->id)}}</td>
                            <td>{{App\Student::average(App\Student::subject_total($item->subject_id,$data['class_']->id,$data['term']->id),$users->count())}}</td>
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
                                <td>{{App\Student::averPer(App\Student::average($total,$data['scores']->count()),$SMT_score)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="remarks">
                                <td></td>

                                <td>remarks</td>
                                <td>{{App\Student::grade(App\Student::averPer(App\Student::average($total,$scores->count()),$SMT_score),$data['grades'])}}</td>
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
   
</body>
</html>