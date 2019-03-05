@extends('layouts.main')
@section('content')
@section('title','我的消息')

	<!-- 主体 -->
	<div class="container">
		<h1>我的消息
			<a href="发消息.html">发消息</a>
			<a href="">删除选中消息</a>
		</h1>
		<table class="data-list">
			<tr>
				<th width="30"><input type="checkbox"></th>
				<th>标题</th>
				<th width="140">发送时间</th>
				<th width="140">发送人</th>
				<th width="50">操作</th>
			</tr>
			<tr>
				<td><input type="checkbox"></td>
				<td><a target="_blank" href="消息内容.html" class="unread">系统消息：您有一个新好友申请。</a></td>
				<td>2017-10-10 10:10</td>
				<td>12345678</td>
				<td class="btn">
					<a href="">删除</a>
				</td>
			</tr>
			<tr>
				<td><input type="checkbox"></td>
				<td><a target="_blank" href="消息内容.html" class="unread">系统消息：您有一个新好友申请。</a></td>
				<td>2017-10-10 10:10</td>
				<td>12345678</td>
				<td class="btn">
					<a href="">删除</a>
				</td>
			</tr>
			<tr>
				<td><input type="checkbox"></td>
				<td><a target="_blank" href="消息内容.html" class="unread">系统消息：您有一个新好友申请。</a></td>
				<td>2017-10-10 10:10</td>
				<td>12345678</td>
				<td class="btn">
					<a href="">删除</a>
				</td>
			</tr>
		</table>
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
@endsection