@extends('layouts.main')
@section('content')
@section('title','设置新密码')
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
		<h1>设置新密码</h1>
		<form action="">
			<div class="form-div"><input type="text" name="password" placeholder="密码（不少于6位）"></div>
			<div class="form-div"><input type="text" name="password_confirm" placeholder="再次输入密码"></div>
			<div class="form-div"><input type="submit" value="确认"></div>
		</form>
	</div>
@endsection