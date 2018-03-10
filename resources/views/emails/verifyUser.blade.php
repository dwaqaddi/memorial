<!DOCTYPE html>
<html>
<head>
    <title>Verify Account - Manila Memorial Park </title>
</head>
 
<body>
<h2>Welcome to the Manila Memorial Park (Dasmariñas, Cavite) {{$user['userFName']}}</h2>
<br/>
Your registered email-id is {{$user['userEmail']}} , Please click on the below link to verify your email account.
<br/>
<a href="{{url('user/verify', $user->userId)}}">Verify Email</a>
</body>
 
</html>