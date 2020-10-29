<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>抽奖</title>
</head>
<body>
    <h1>抽奖</h1>
    <input type="button" id="pirve" value="抽奖">

    <script src="/jquery.js"></script>
    <script>
        $(document).on("click","#pirve",function(){

           $.ajax({
               url:"{{url('pirve/add')}}",
               success:function(res){

                   if(d.errno==400003)
                   {
                       window.location.href = '/user/login'
                   }
                   alert(d.data.msg);

               }
           })
        })
    </script>

</body>
</html>
