@extends('layouts.main')
@section('content')
@section('title','发消息')

	<!-- 主体 -->
	<div class="container">
		<h1>发消息</h1>
		<form action="">
			<div class="form-div"><input style="width: 100%;" type="text" name="to" placeholder="输入收件人，多个用逗号隔开。"></div>
			<div class="form-div"><textarea name="content" style="width: 100%;height: 200px;border-radius: 5px;"></textarea></div>
			<div class="form-div"><input type="checkbox" name="tofriend"> 发给我的好友</div>
			<div class="form-div"><input type="checkbox" name="tofollower"> 发给我的粉丝</div>
			<div class="form-div">
				<img src="images/captcha.png" alt="">
				<br>
				<input type="text" name="captcha" placeholder="验证码">
			</div>
			<div class="form-div"><input type="submit" value="发表"></div>
		</form>
	</div>
@endsection