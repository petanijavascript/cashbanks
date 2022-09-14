<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bank Operational Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/> 
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 <a class="btn glyphicon glyphicon-arrow-left" href="{{url('/bankoperational')}}">&nbspBack</a>
 <a class="btn glyphicon glyphicon-print" onClick="window.print()">&nbspPrint</a>
    
<div class="container">
  <h2>Bank Operational Report</h2>
    <div class="row">
        <div class="col-md-3"><strong>Project : {{$projectName}}</strong></div>
        <div class="col-md-9"><strong>Year : {{$yearSelect}}</strong></div> 
    </div>
    <div class="row">
        <div class="col-md-3"><strong>Month : {{date('F', mktime(0, 0, 0, $monthSelect, 10))}}</strong></div>
        <div class="col-md-9"><strong>Week : {{$startWeek}} - {{$endWeek}}</strong></div> 
    </div>    
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="text-align:center">Bank Account</th> 
        <th style="text-align:right">Opening Balance</th>
        <th style="text-align:right">In</th>
        <th style="text-align:right">Out</th>
        <th style="text-align:right">Closing Balance</th> 
      </tr>
    </thead>
    <tbody>
        @foreach($transaction as $c)
			@if($c->opening_balance != 0 || $c->closing_balance != 0)
            <tr>
                <td>{{$c->bank_account}}</td> 
                <td style="text-align:right">{{$c->opening_balance}}</td>
                <td style="text-align:right">{{$c->in_}}</td>
                <td style="text-align:right">{{$c->out_}}</td>
                <td style="text-align:right">{{$c->closing_balance}}</td> 
            </tr> 
			@endif
        @endforeach 
    </tbody>
    <tfoot>
        <tr>
            <td>TOTAL : </td> 
            <td style="text-align:right">{{$totalOpeningBalance}}</td>
            <td style="text-align:right">{{$totalIn}}</td>
            <td style="text-align:right">{{$totalOut}}</td>
            <td style="text-align:right">{{$totalClosingBalance}}</td> 
        </tr>   
    </tfoot>
  </table>
    
    <div class="row">
        <div class="col-md-12"><strong>Generated At : {{gmdate("Y/M/d")}}&nbsp{{gmdate("h:i:sa")}}</strong></div> 
    </div> 
</div>

</body>
</html> 