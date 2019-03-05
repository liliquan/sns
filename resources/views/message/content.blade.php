@extends('layouts.main')
@section('content')
@section('title','消息内容')

	<!-- 主体 -->
	<div class="container">
		<h1>消息内容</h1>
		<table class="data-list">
			<tr>
				<th>内容</th>
				<th width="140">发送时间</th>
				<th width="140">发送人</th>
			</tr>
			<tr>
				<td>
					<strong>系统消息：您有一个新好友申请。</strong>
					<p>系统消息：您有一个新好友申请。</p>
				</td>
				<td>2017-10-10 10:10</td>
				<td>12345678</td>
			</tr>
		</table>
	</div>
@endsection