@extends('layouts.default')

@section('title', '登录')

@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>登录</h4>
        </div>
        <div class="panel-body">
            @include('shared._errors')
            <form action="{{ route('login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">密码（<a onclick="heihei()">忘记密码?</a>）：</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" name="remember">记住爸爸</label>
                </div>

                <button type="submit" class="btn btn-primary">登录</button>
            </form>
            <hr>

            <p>
                还没有账号？<a href="{{ route('signup') }}">立即注册，成为本站的爸爸！</a>
            </p>
        </div>
    </div>
</div>

    <script>
        function heihei() {
            alert('那我也没办法');
        }
    </script>
@stop