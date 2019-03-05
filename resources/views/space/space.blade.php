@extends('layouts.main')
@section('content')
@section('title','好友动态')

	<!-- 主体 -->
	<div class="container clearfix">
		<div class="left">
			<div class="art-list">
				<h2>好友动态</h2>
				<ul class="friends-act">
					@foreach($blogs as $b)
						<li><a href="#" class="people">{{ $b->user->username}}</a> 在 <strong>{{ $b->created_at}}</strong> 发表了: <a href="">{{ $b->title}}</a></li>
					@endforeach
				</ul>
				<ul class="page clearfix">
					<li><a href="">1</a></li>
					<li>...</li>
					<li><a href="">8</a></li>
					<li><a href="">9</a></li>
					<li class="active">10</li>
					<li><a href="">11</a></li>
					<li><a href="">12</a></li>
					<li>...</li>
					<li><a href="">36</a></li>
				</ul>
			</div>
		</div>
		<div class="right">
			<div class="side user-info">
				<img src="/images/face.jpg" alt="">
				<p>xxx</p>
				<div id="btn_gx"></div>
			</div>
			<div class="side">
				<h3>我的好友（100人）</h3>
				<ul class="user-act clearfix">
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
				</ul>
			</div>
			<div class="side">
				<h3>我的关注（100人）</h3>
				<ul class="user-act clearfix">
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
				</ul>
			</div>
			<div class="side">
				<h3>我的粉丝（100人）</h3>
				<ul class="user-act clearfix">
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
					<li><a href="个人主页.html"><img src="/images/face.jpg" alt=""><br>12345678</a></li>
				</ul>
			</div>
		</div>
	</div>

	<script src="/ueditor/third-party/jquery.min.js"></script>
	<script>
		function btn_gx(gx){
			var html='';
			if(gx=='no'){
				html=" <a id='btn-gz' href='#'>关注</a>";
			}
			else if(gx=='gz'){
				html="已关注 <a id='btn-qxgz' href='#'>取消关注</a>";
			}
			else if(gx=='fs'){
				html="粉丝 <a id='btn-tjhy' href='#'>加为好友</a>";
			}
			else if(gx=='hy'){
				html="好友 <a id='btn-schy' href='#'>删除好友</a>";
			}
			else if(gx=='me'){
				html="我的空间";
			}

			$("#btn_gx").html(html);
		}
		btn_gx("{{ $gx }}");
		
		
		$('#btn-gz').click(function(){
			$.ajax({
				type:"GET",
				url:"/gz/{{$user}}",
				dataType:'json',
				success:function(data){
					if(data.error==0){
						alert("操作成功");
						btn_gx(data.gx);
					}
					else
					{
						if(data.error==1001)
						{
							location.href="/login";
						}
					}
				}
			});
		});

		$('#btn-qxgz').click(function(){
			$.ajax({
				type:"GET",
				url:"/qxgz/{{$user}}",
				dataType:'json',
				success:function(data){
					if(data.error==0){
						alert("操作成功");
						btn_gx(data.gx);
					}
					else
					{
						if(data.error==1001)
						{
							location.href="/login";
						}
					}
				}
			});
		});

		$('#btn-tjhy').click(function(){
			$.ajax({
				type:"GET",
				url:"/tjhy/{{$user}}",
				dataType:'json',
				success:function(data){
					if(data.error==0){
						btn_gx(data.gx);
					}
					else
					{
						if(data.error==1001)
						{
							location.href="/login";
						}
					}
				}
			});
		});

		$('#btn-schy').click(function(){
			$.ajax({
				type:"GET",
				url:"/schy/{{$user}}",
				dataType:'json',
				success:function(data){
					if(data.error==0){
						btn_gx(data.gx);
					}
					else
					{
						if(data.error==1001)
						{
							location.href="/login";
						}
					}
				}
			});
		});

	</script>
@endsection