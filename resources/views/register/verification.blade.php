@extends('layouts.main')
@section('content')
@section('title','注册验证')
	<!-- 主体 -->
	<div class="container">
		<h1>注册验证</h1>
		<div class="info">验证码已发送到您手机或者邮箱中，请查收。</div>
		<form action="">
			<div class="form-div">
				<input type="text" name="username" placeholder="请输入验证码">
				<input type="submit" value="重新发送（60s）">
			</div>
			<div class="form-div">
				<input type="submit" value="确认">
			</div>
		</form>
	</div>
@endsection