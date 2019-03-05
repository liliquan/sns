@extends('layouts.main')
@section('content')
@section('title','用户注册')
	<!-- 导航 -->
	<style>
		.error {
			padding: 10px 30px;
		}
		#btn-send{
			color: #333;
			background-color: #fff;
			padding: 6px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			border: 1px solid transparent;
			border-radius: 4px;
			cursor: pointer;
			font-family: inherit;
		}
	</style>

	<!-- 主体 -->
	<div class="container">
		<h1>用户注册</h1>
		<form action="{{ route('doregister') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-div"><input type="text" name="username" placeholder="用户名" value="{{ old('username') }}"></div>
			@if($errors->has('username'))
				<p class="error">
					{{ $errors->first('username') }}
				</p>
			@endif
			<div class="form-div"><input type="file" name="face"></div>
			@if($errors->has('face'))
				<p class="error">
					{{ $errors->first('face') }}
				</p>
			@endif
			<div class="form-div"><input type="password" name="password" placeholder="密码（不少于6位）"></div>
			@if($errors->has('password'))
				<p class="error">
					{{ $errors->first('password') }}
				</p>
			@endif
			<div class="form-div"><input type="password" name="password_confirmation" placeholder="再次输入密码"></div>
			@if($errors->has('password_confirmation'))
				<p class="error">
					{{ $errors->first('password_confirmation') }}
				</p>
			@endif
			<div class="form-div"><input type="text" name="mobile" placeholder="手机号" value="{{ old('mobile') }}"></div>
			@if($errors->has('mobile'))
				<p class="error">
					{{ $errors->first('mobile') }}
				</p>
			@endif
			<div class="form-div"><input type="text" name="mobile_code" placeholder="输入短信验证码" value="{{ old('mobile_code') }}"></div>
			@if($errors->has('mobile_code'))
				<p class="error">
					{{ $errors->first('mobile_code') }}
				</p>
			@endif
			<div class="form-div"><input type="button" id="btn-send" value="发送验证码"></div>
			
			<div class="form-div"><input type="checkbox" name="agree"> 《同意注册协议》</div>
			@if($errors->has('agree'))
				<p class="error">
					{{ $errors->first('agree') }}
				</p>
			@endif
			<div class="form-div"><input type="submit" value="注册"></div>
		</form>
	</div>
	<script src="/ueditor/third-party/jquery.min.js"></script>
	<script>
		var seconds = 60;
		var si;
		$("#btn-send").click(function(){
			var mobile = $("input[name=mobile]").val();
			$.ajax({
				type:"GET",
				url:"{{ route('ajax-mobile-code') }}",
				data:{mobile:mobile},
				success:function(data){
					alert(data);
					$("#btn-send").attr('disabled',true);
					si = setInterval(function(){
						seconds--;
						if(seconds==0)
						{
							$("#btn-send").attr('disabled',false);
							seconds=60;
							$("#btn-send").val("发送验证码");
							clearInterval(si);
						}
						else
						{
							$("#btn-send").val("没收到验证码?"+(seconds)+"秒后可重新发送!");
						}
					},1000);
				}
			});
		});
	</script>
@endsection