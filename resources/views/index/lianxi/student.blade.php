<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('student/insert')}}" method="POST" enctype="multipart/form-data">
        <table>
            @csrf
            <tr>
                <td>姓名</td>
                <td><input type="text" name="s_name">
                <b style="color: red;">{{$errors->first('s_name')}}</b>
            </td>
            </tr>
            <tr>
                <td>班级</td>
                <td>
                    <select name="s_id" id="">
                        <option value="">请选择</option>
                        @foreach($res as $k=>$v)
                        <option value="{{$v['c_id']}}">{{$v['c_name']}}</option>
                        @endforeach
                    </select>
            </td>
            </tr>
            <tr>
                <td>性别</td>
                <td>
                    <input type="radio" name="s_sex" value="1" checked>男
                    <input type="radio" name="s_sex" value="2">女
                </td>
            </tr>
            <tr>
            <tr>
                <td>头像</td>
                <td><input type="file" name="s_img"></td>
            </tr>
                <td><input type="submit" value="添加"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>