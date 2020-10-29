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
<form action="cinema/add" method="post">
    <table>

       @csrf
        @foreach($seatInfo as $k=>$v)
            @if($k % 5 ==0)
            <tr></tr>
            @endif
            <td>
                {{$v['seat_num']}}
                @if(!in_array($v['seat_num'],$seat_num))
                    <input type="checkbox" name="seat_num[]" value="{{$v['seat_num']}}">
                    @else
                    ×
                    @endif
            </td>
            @endforeach
        <input type="button" id="btn" value="购买">
    </table>
</form>
<script src="/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','#btn',function(){
            //alert(1234);
            var film_count=$(":checkbox");
            film_count.each(function () {
                var _this = $(this);
                if(_this.prop('checked') == true){
                    console.log(_this.val());
                }
            })
        })
    })
</script>
</body>
</html>