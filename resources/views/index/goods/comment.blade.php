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
<form action="{{url('goods/commentinsert')}}" method="post">
    @csrf
    <table>
        <input type="hidden" name="goods_id" value="{{$res['goods_id']}}">
        <tr>
            <td>商品描述</td>
            <td><textarea  cols="30" rows="10" name="c_content"></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" value="提交"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>
