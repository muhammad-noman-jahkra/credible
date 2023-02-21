<!DOCTYPE html>
<html>
<head>
    <title>You New password</title>
</head>
<body>
  
<p>Hi, {{$mailData['to_name']}}</p>
<p>The following employee forgot to mark off their attendance.</p>

<ol>
    @foreach($mailData['employee_list'] as $emp)
    <li>{{$emp->name}}</li>
    @endforeach
</ol>

</body>
</html>