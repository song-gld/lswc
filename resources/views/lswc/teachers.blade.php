@extends('layouts.app')

@section('title', '-教师名单管理')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/teachers.css') }}">
@endsection

@section('content')
<div class="container">
    @include('common.path', ['url' => 'teachers', 'name' => '教师管理'])
    {{-- 添加教师 --}}
    <div class="row row-top">
        <div class="top">
            <form method="post" action="{{ route('teachers') }}" id="form-data">
                @csrf
                <table class="table-top">
                    <tbody>
                        <tr>
                            <th>姓名</th>
                            <th>年级</th>
                            <th>科目</th>
                            <th>身份证号</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td id="td-name">
                                <input id="name" name="name" type="text" placeholder="请输入姓名" class="form-control">
                                {{-- @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror --}}
                            </td>
                            <td>
                                <select name="grade" id="" class="form-control">
                                    <option value="">请选择年级/科室</option>                                    
                                    <option value="高一">高一</option>                                    
                                    <option value="高二">高二</option>
                                    <option value="高三">高三</option>
                                    <option value="综合">综合</option>
                                    <option value="总务处">总务处</option>
                                    <option value="教育处">教育处</option>
                                    <option value="教务处">教务处</option>
                                    <option value="教研处">教研处</option>
                                    <option value="团委">团委</option>
                                    <option value="信息">信息</option>
                                </select>
                            </td>
                            <td>
                                <select name="course" id="" class="form-control">
                                    <option value="">请选择科目</option>                                    
                                    <option value="数学">数学</option>                                    
                                    <option value="语文">语文</option>
                                    <option value="英语">英语</option>
                                    <option value="物理">物理</option>
                                    <option value="历史">历史</option>
                                    <option value="政治">政治</option>
                                    <option value="地理">地理</option>
                                    <option value="化学">化学</option>
                                    <option value="生物">生物</option>
                                    <option value="音乐">音乐</option>
                                    <option value="美术">美术</option>
                                    <option value="体育">体育</option>
                                    <option value="通用">通用</option>
                                    <option value="信息">信息</option>
                                    <option value="心理">心理</option>
                                    <option value="其它">其它</option>
                                </select>
                            </td>  
                            <td>
                                <input id="" name="identity" type="text" placeholder="请输入身份证号" class="form-control">           
                            </td>                        
                            <td>
                                <button id="btn-add" type="button" class="btn btn-primary">添加</button>
                                <button id="btn-search" type="submit" class="btn btn-primary">查找</button>
                            </td>
                        </tr>                        
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    {{-- 教师列表 --}}
    <div class="row">
        <table class="table table-bordered table-hover">
            <tbody id="bottom-date">
                <tr class="text-center">
                    <th>姓名</th>    
                    <th>年级</th>    
                    <th>科目</th>    
                    <th>身份证号</th>                                         
                    <th>操作</th>    
                </tr>                   
                @foreach($teachers as $teacher)
                <tr class="text-center lswc-item">
                    <td>{{ $teacher->name }}</td>    
                    <td>{{ $teacher->grade }}</td>    
                    <td>{{ $teacher->course }}</td>    
                    <td>{{ $teacher->identity }}</td>                       
                    <td><a class="label label-info edit" >修改</a>
                        <a href="javascript:;" class="label label-danger delete">删除</a>
                    </td>
                </tr> 
                @endforeach                
            </tbody>
        </table>         
    </div>
    <div class="row text-center">
        {{ $teachers->links() }}
    </div>    
</div>
@endsection
@section('script')
    <script>
        $(function() {
            var form = $('#form-data')
            // 执行添加操作
            $('#btn-add').click(function() {   
                console.log('date:' + form.serialize());             
                $.ajax({
                    url: '{{ route('teachers.add') }}',
                    type: 'post',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        var identity                        
                        if (res.identity === null) {
                            identity = ""
                        } else {
                            identity = res.identity
                        }
                        $('#td-name').attr('class', '') 
                        $('#bottom-date').append(`
                        <tr class="text-center lswc-item">
                            <td>${ res.name }</td>    
                            <td>${ res.grade }</td>    
                            <td>${ res.course }</td>    
                            <td>${identity}</td>                       
                            <td><a class="label label-info edit" >修改</a>
                                <a href="javascript:;" class="label label-danger delete">删除</a>
                            </td>
                        </tr> 
                        `)
                        Toast.fire({
                            icon: 'success',
                            title: '添加教师成功'
                        })
                    },
                    error: function() {
                        $('#name').focus()
                        document.getElementById('name').value = ''
                        $('#td-name').attr('class', 'has-error') 
                        $('#name').attr('placeholder', '姓名重复') 
                        Toast.fire({
                            icon: 'error',
                            title: '姓名重复，无法添加。'
                        })
                    }
                })                
            })            
        })
    </script>
@endsection