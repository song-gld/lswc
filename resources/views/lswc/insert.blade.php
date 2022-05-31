@extends('layouts.app')

@section('title', '-数据录入')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/insert.css') }}">
@endsection

@section('content')
<div class="container">
    @include('common.path', ['url' => 'insert', 'name' => '数据录入'])
    <div class="row row-top">
        <div class="top">
            <form method="post" action="{{ route('lswc.insertdata') }}" id="form-data">
                @csrf
                <table class="table-top">
                    <tbody>
                        <tr>
                            <th>姓名</th>
                            <th>公/私事</th>
                            <th>具体事由</th>
                            <th>备注</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <input id="name" name="name" type="text" placeholder="请输入姓名" class="form-control">
                            </td>
                            <td>
                                <select name="gs" id="" class="form-control">
                                    <option value="私事">私事</option>                                    
                                    <option value="公事">公事</option>
                                    <option value="无">临时请假</option>
                                </select>
                            </td>
                            <td>
                                <input name="sy" id="sy" type="text" placeholder="请输入具体事由" class="form-control">
                            </td>
                            <td>
                                <input name="bz" type="text" placeholder="请输入备注" class="form-control">
                            </td>
                            <td>
                                <button id="btn" type="button" class="btn btn-primary">提交</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input id="grade" name="nj" type="text" placeholder="年级" class="form-control">                                
                            </td>
                            <td>
                                <input id="course" name="km" type="text" placeholder="科目" class="form-control">
                            </td>
                            <td>
                                <input name="date" id="date" type="date" class="form-control" >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div> 
    <div class="row row-bottom">        
        <table class="table table-bordered table-hover">
            <tbody id="bottom-date">
                <tr>
                    <th>姓名</th>    
                    <th>年级</th>    
                    <th>科目</th>    
                    <th>公/私事</th>    
                    <th>具体事由</th>    
                    <th>备注</th>    
                    <th>操作</th>    
                </tr>                   
                @foreach($lswcs as $lswc)
                <tr class="text-center lswc-item">
                    <td>{{ $lswc->name }}</td>    
                    <td>{{ $lswc->grade }}</td>    
                    <td>{{ $lswc->course }}</td>    
                    <td>{{ $lswc->gs }}</td>    
                    <td>{{ $lswc->sy }}</td>    
                    <td>{{ $lswc->bz }}</td>    
                    <td><a class="label label-info edit" >修改</a>
                        <a href="javascript:;" class="label label-danger delete" data-url="{{ route('lswc.delete', $lswc) }}">删除</a>
                    </td>
                </tr> 
                @endforeach
            </tbody>
        </table>           
    </div>    
</div>
@endsection

@section('script')
    <script>
        $(function() {
            var form = $('#form-data')
            // 初始化日期input
            var date = new Date();
            var month = (date.getMonth() + 1).length === 1 ? '0' + date.getMonth() + 1 : date.getMonth() + 1
            var dateString = date.getFullYear() + "-" + "0" + month + "-" + date.getDate();
            console.log(dateString);
            document.getElementById('date').value = dateString
            // $('#date').attr('value', dateString)            
            $('#name').blur(function() {                
                // 获取input中name的value并在teacher模型中查找是否存在此用户
                $.ajax({
                    url: '{{ route('store') }}',
                    type: 'get',
                    data: {name: this.value},
                    dataType: 'json',
                    success: function(res) {
                        // 判断输入的姓名教师库中是否存在
                        if(res !== -1) {
                            $('#grade').attr('value', res.grade)
                            $('#course').attr('value', res.course)
                        } else {
                            $('#grade').attr('value', '')
                            $('#course').attr('value', '')
                            $('#name').focus()
                            $('#name').attr('value', '')
                            document.getElementById('name').value = ""                            
                            $('#name').attr('placeholder', '姓名有误请重新输入')                            
                        }
                    }                
                })
            })
            // 向数据库插入数据
            $('#btn').click(function() {
                $.ajax({
                    url: '{{ route('lswc.insertdata') }}',
                    type: 'post',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(res) {
                        var bz
                        var sy
                        if (res.bz === null) {
                            bz = ""
                        } else {
                            bz = res.bz
                        }
                        if (res.sy === null) {
                            sy = ""
                        } else {
                            sy = res.sy
                        }
                        $('#bottom-date').append(`
                        <tr class="text-center lswc-item">
                            <td>${res.name}</td>    
                            <td>${res.nj}</td>    
                            <td>${res.km}</td>    
                            <td>${res.gs}</td>    
                            <td>${sy}</td>    
                            <td>${bz}</td>    
                            <td><a class="label label-info edit" >修改</a>
                                <a href="javascript:;" class="label label-danger delete" data-url="{{ route('lswc.delete', $lswc) }}">删除</a>
                            </td>
                        </tr> 
                        `)
                        $('#grade').attr('value', '')
                        $('#course').attr('value', '')
                        document.getElementById('sy').value = ""                       
                        $('#name').focus()                        
                        document.getElementById('name').value = ""                            
                        $('#name').attr('placeholder', '请输入姓名') 
                        Toast.fire({
                            type: 'success',
                            title: '插入数据成功'
                        }) 
                    }
                })
            })
            $('.delete').click(function() {
                console.log($(this).data('url'))
                var that = this
                $.ajax({
                    url: $(that).data('url'),
                    type: 'delete',
                    dataType: 'json',
                    success: function($res) {
                        console.log($res);
                        $(that).parents('.lswc-item').remove();
                        Toast.fire({
                            title: '删除成功'
                        })
                    } 
                })
            })
        })
    </script>
@endsection