<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button id="btn_coupon_type1">领劵</button>
    <button id="btn_coupon_type2">领劵</button>
    <script src="/jquery.js"></script>
    <script>
        $('#btn_coupon_type1').on('click',function(){
           $.ajax({
               url:'coupon/add?type=1',
               type:'get',
               dataType:'json',
               success:function (res) {
                   conlose,log(res);
               }
           })
        })
    </script>
</body>
</html>