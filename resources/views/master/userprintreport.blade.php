<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/> 
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 <a class="btn glyphicon glyphicon-arrow-left" href="{{url('/user')}}">&nbspBack</a>
 <a class="btn glyphicon glyphicon-print" onClick="window.print()">&nbspPrint</a>    
<div class="container">
  <h2>User Report</h2>    
  <table class="table table-striped">
    <thead>
      <tr>
        <th style="text-align:center">User ID</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th style="text-align:center">User Group</th> 
      </tr>
    </thead>
    <tbody>
        @foreach($listUser as $c)
            <tr> 
                <td style="text-align:center">{{$c->user_id}}</td>
                <td style="text-align:left">{{$c->username}}</td>
                <td style="text-align:left">{{$c->first_name}}</td>
                <td style="text-align:left">{{$c->last_name}}</td>
                <td style="text-align:left">{{$c->email}}</td>
                <td style="text-align:center">{{$c->group_detail}}</td>
            </tr> 
        @endforeach 
    </tbody> 
  </table>
    
    <div class="row">
        <div class="col-md-12"><strong>Generated At : {{gmdate("Y/M/d")}}&nbsp{{gmdate("h:i:sa")}}</strong></div> 
    </div> 
</div>

</body>
</html> 