@extends('layouts.default')

@section('title', '成为我们的爸爸吧！')

@section('content')

<div class="col-md-offset-2 col-md-8">
    <div  class="panel panel-default">
        <div class="panel-heading">
            <h4>快成为本站的爸爸吧！</h4>
        </div>
        <div class="panel-body">
            @include('shared._errors')
            <form action="{{ route('users.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">昵称：</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                </div>

                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" />
                </div>

                <div class="form-group">
                    <label for="password">密码：</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation">确认密码：</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" />
                </div>
                <button type="submit" class="btn btn-primary">注册</button>
            </form>
        </div>
    </div>
</div>
@stop