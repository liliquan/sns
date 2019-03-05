@extends('layouts.main')
@section('content')
@section('title','操作失败')


	<!-- 主体 -->
	<div class="container">
		<h1>操作失败！</h1>
		<div class="error">
			<ul>
				<li>验证码已发送到您手机或者邮箱中，请查收。</li>
				<li>验证码已发送到您手机或者邮箱中，请查收。</li>
				<li>验证码已发送到您手机或者邮箱中，请查收。</li>
			</ul>
			<br>
			<p><strong id="sec"></strong> 秒后跳转，<a href="" id="ahref">点击立即跳转</a></p>
		</div>
	</div>
@endsection
@section('content2')
<script>
	
var url = ''; // 跳转地址

var secnum = 3;
var sec = document.getElementById('sec');
var ahref = document.getElementById('ahref');

ahref.href = url;
sec.innerHTML = secnum;

var si = setInterval(function(){
	secnum--;
	if(secnum < 0)
		location.href = url;
	else
	{
		sec.innerHTML = secnum;
	}
}, 1000);

</script>
@endsection