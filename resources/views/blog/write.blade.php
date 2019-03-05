@extends('layouts.main')
@section('content')
@section('title','写日志')
	<!-- 导航 -->
	@section('write_css')
	<link href="/ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
	@endsection
	<style>
		.error {
			padding: 10px 30px;
		}
	</style>

	<!-- 主体 -->
	<div class="container">
		<h1>写日志</h1>
		<form action="{{ route('dowrite') }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-div"><input @if($errors->has('title')) class="error2" @endif style="width: 100%;" type="text" name="title" value="{{ old('title') }}" placeholder="输入标题"></div>
			@if($errors->has('title'))
				<p class="error">
					{{ $errors->first('title') }}
				</p>
			@endif
			<div>上传图片 : <input type="file" name="logo"></div>
			@if($errors->has('logo'))
				<p class="error">
					{{ $errors->first('logo') }}
				</p>
			@endif
			<div class="form-div">内容 : <textarea id="content" name="content">{{ old('content') }}</textarea></div>
			@if($errors->has('content'))
				<p class="error">
					{{ $errors->first('content') }}
				</p>
			@endif
			<div class="form-div"><input type="radio" name="accessable" value="public" checked> 公开</div>
			<div class="form-div"><input type="radio" name="accessable" value="protected"> 好友可见</div>
			<div class="form-div"><input type="radio" name="accessable" value="private"> 私有</div>
			<div class="form-div"><input type="submit" value="发表"></div>
		</form>
	</div>
@endsection
@section('content2')
<script type="text/javascript" src="/ueditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/umeditor.min.js"></script>
<script type="text/javascript" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
UM.getEditor('content', {
	initialFrameWidth:"100%",
	initialFrameHeight:"500"
});
</script>
@endsection