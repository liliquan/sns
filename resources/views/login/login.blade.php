@extends('layouts.main')
@section('content')
@section('title','用户登录')
	<style>
		.error {
			padding: 10px 30px;
		}
		input[class=captcha]{
			width: 15%;
		}
		.img{
			position:absolute;
			left:245px;
		}
	</style>
	<!-- 主体 -->
	<div class="container">
		<h1>用户登录</h1>
		<form action="{{ route('dologin') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-div"><input type="text" name="mobile" placeholder="手机号" value="{{ old('mobile') }}"></div>
			@if($errors->has('mobile'))
				<p class="error">
					{{ $errors->first('mobile') }}
				</p>
			@endif
			<div class="form-div"><input type="password" name="password" placeholder="密码" value="{{ old('password') }}"></div>
			@if($errors->has('password'))
				<p class="error">
					{{ $errors->first('password') }}
				</p>
			@endif
			<div class="form-div" style="position:relative;">
			验证码 : <input type="text" name="captcha" class="captcha">
				<img onclick="this.src='{{ route('captcha') }}?'+Math.random()" src="{{ route('captcha') }}" alt="" class="img" >
			</div>
			@if($errors->has('captcha'))
				<p class="error">
					{{ $errors->first('captcha') }}
				</p>
			@endif
			<div class="form-div"><input type="submit" value="登录"></div>
		</form>
	</div>
@endsection