<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="/css/common.css">
    
	@yield('write_css')
	@yield('myblog_css')
</head>
<body>
	<!-- 导航 --> 
	<style>
		#face {
			width: 40px;
			height: 40px;
			border-radius: 20px;
		}
	</style>
	<div class="header">
		<div class="container">
			<img id="face" src="{{ Storage::url(session('smface')) }}" alt="">
			<span id="username">{{ session('username') }}</span>
			<a href="{{ route('space',['userId'=>1]) }}">个人主页</a>
			<a href="{{ route('modifypwd') }}">修改密码</a>
			<a href="{{ route('face') }}">设置头像</a>
			<a href="{{ route('myblog') }}">我的日志</a>
			<a href="{{ route('mymessage') }}">我的消息 <span class="num-tip">20</span></a>
			
			<div class="fr">
				@if(session('id'))
				
				<a class="active" href="{{ route('logout') }}">退出</a>
				@else
				<a class="active" href="{{ route('login') }}">登录</a>
				<a class="active" href="{{ route('register') }}">注册</a>
				@endif
				<a class="active" href="{{ route('index') }}">广场</a>
			</div>
		</div>
	</div>
    @yield('content')
    
</body>
</html>
    @yield('content2')