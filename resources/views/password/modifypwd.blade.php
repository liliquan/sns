@extends('layouts.main')
@section('content')
@section('title','修改密码')

	<!-- 主体 -->
	<div class="container">
		<h1>修改密码</h1>
		<form action="">
			<div class="form-div"><input type="text" name="password_old" placeholder="输入原密码"></div>
			<div class="form-div"><input type="text" name="password" placeholder="输入新密码（不少于6位）"></div>
			<div class="form-div"><input type="text" name="password_confirm" placeholder="再次输入密码"></div>
			<div class="form-div"><input type="submit" value="确认"></div>
		</form>
	</div>
@endsection