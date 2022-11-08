<!DOCTYPE html>
<html>
<head>
    <title>smartpancardservices.com</title>
    <style>
        button{
            background: linear-gradient(to right, #da8cff, #9a55ff) !important;
            color: #fff !important;
            width: 150px;
            height: 45px;
            border: none;
        }
    </style>
</head>
<body>
   
    <h4>User Name:- <strong>{{ $data['name'] }}</strong></h4>

     
    <button class="btn btn-success btn-sm">
       <a href="{{ route('emailverify',$data['token']) }}" style='color: #fff;text-decoration: none;' class="">Go to Website</a>
    </button><br><br>
  
    <br><br>
    <p>Thank you</p><br>
    <p>Please don't reply..</p>

</body>
</html>