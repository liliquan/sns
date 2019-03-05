@extends('layouts.main')
@section('content')
@section('title','忘记密码')
	<!-- 导航 -->
	<div class="header">
		<div class="container">
			<a href="用户注册.html">注册</a>
			<a href="用户登录.html">登录</a>
			<div class="fr">
				<a href="{{ route('index') }}">广场</a>
			</div>
		</div>
	</div>
	<!-- 主体 -->
	<div class="container">
		<h1>忘记密码</h1>
		<div class="info">已向您的手机或者邮箱发送了链接，请查收！</div>
		<form action="">
			<div class="form-div"><input type="text" name="username" placeholder="输入手机号或者邮箱"></div>
			<div class="form-div"><input type="submit" value="确认"></div>
		</form>
	</div>
@endsection