@extends('layouts.main')
@section('content')
@section('title','我的日志')
	<!-- 导航 -->
	@section('myblog_css')
	<style>
		.pagination{display:-webkit-box;display:-ms-flexbox;display:flex;padding-left:0;list-style:none;border-radius:.25rem}.page-link{position:relative;display:block;padding:.5rem .75rem;margin-left:-1px;line-height:1.25;color:#007bff;background-color:#fff;border:1px solid #dee2e6}.page-link:hover{color:#0056b3;text-decoration:none;background-color:#e9ecef;border-color:#dee2e6}.page-link:focus{z-index:2;outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25)}.page-link:not(:disabled):not(.disabled){cursor:pointer}.page-item:first-child .page-link{margin-left:0;border-top-left-radius:.25rem;border-bottom-left-radius:.25rem}.page-item:last-child .page-link{border-top-right-radius:.25rem;border-bottom-right-radius:.25rem}.page-item.active .page-link{z-index:1;color:#fff;background-color:#007bff;border-color:#007bff}.page-item.disabled .page-link{color:#6c757d;pointer-events:none;cursor:auto;background-color:#fff;border-color:#dee2e6}.pagination-lg .page-link{padding:.75rem 1.5rem;font-size:1.25rem;line-height:1.5}.pagination-lg .page-item:first-child .page-link{border-top-left-radius:.3rem;border-bottom-left-radius:.3rem}.pagination-lg .page-item:last-child .page-link{border-top-right-radius:.3rem;border-bottom-right-radius:.3rem}.pagination-sm .page-link{padding:.25rem .5rem;font-size:.875rem;line-height:1.5}.pagination-sm .page-item:first-child .page-link{border-top-left-radius:.2rem;border-bottom-left-radius:.2rem}.pagination-sm .page-item:last-child .page-link{border-top-right-radius:.2rem;border-bottom-right-radius:.2rem}
		input[type=text], input[type=password] {
			width: 13%;
		}
	</style>
	@endsection

	<!-- 主体 -->
	<div class="container">
		<h1>我的日志
			<a href="{{ route('write') }}">写日志</a>
			<a href="">删除选中日志</a>
		</h1>

		<form style="margin-top: 15px;">
			关键字 : <input type="text" name="keyword" value="{{$req->keyword}}">
			开始时间 : <input type="text" name="from" value="{{$req->from}}">
			结束时间 : <input type="text" name="to" value="{{$req->to}}">
			访问权限 : <input type="radio" name="acc" value="public" @if($req->acc=='public') checked @endif>公开
					  <input type="radio" name="acc" value="protected" @if($req->acc=='protected') checked @endif>仅好友可见
					  <input type="radio" name="acc" value="private" @if($req->acc=='private') checked @endif>私有
			<input type="submit" value="搜索">
		</form>

		<table class="data-list">
			<tr>
				<th width="30"><input type="checkbox"></th>
				<th>ID</th>
				<th>图片</th>
				<th>标题</th>
				<th width="140">发表时间
				@if($req->od=="asc")
				<a href="{{  route('myblog', array_merge($req->all(),['od'=>'desc']) ) }}">﹀</a>
				@else
				<a href="{{  route('myblog', array_merge($req->all(),['od'=>'asc']) ) }}">︿</a>
				</th>
				@endif
				<th width="80">权限</th>
				<th width="90">操作</th>
			</tr>
			@foreach($data as $v)
			<tr>
				<td><input type="checkbox"></td>
				<td>{{$v->id}}</td>
				<td><img src="{{ Storage::url( $v->image ) }}" width="120px"></td>
				<td>{{$v->title}}</td>
				<td>{{$v->created_at}}</td>
				<td>
				@if($v->accessable=="public") 所有人可见
				@elseif($v->accessable=="protected") 仅好友可见
				@else 仅自己可见
				@endif
				</td>
				<td class="btn">
					<a href="{{ route('blog.edit', ['id'=>$v->id]) }}">编辑</a>
					<a onclick="return `confirm('确定要删除吗?');" href="{{ route('blog.delete', ['id'=>$v->id]) }}">删除</a>
				</td>
			</tr>
			
			@endforeach
			<tr>
				<td colspan="7">{{ $data->appends($req->all())->links() }}</td>
			</tr>
		</table>
		<!-- 分页 start -->

		<!-- end -->
	</div>
@endsection