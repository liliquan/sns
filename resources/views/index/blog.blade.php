@extends('layouts.main')
@section('content')
@section('title','日志内容')
	<style>
		#ding {
			color: #333;
			background-color: #eee;
			padding: 0px 12px;
			font-size: 14px;
			line-height: 1.42857143;
			border: 1px solid transparent;
			border-radius: 4px;
			cursor: pointer;
			font-family: inherit;
		}
		.loading{
			width:160px;
			height:100px;
			margin:0 auto;
		}
		.loading_div{
			background:#fff;
			text-align: center;
		}
		
	</style>
	<!-- 主体 -->
	<div class="container clearfix">
		<div class="left">
			<div class="art-con">
				<div class="head">
					<h1 class="title">{{ $blog->title }}</h1>
					<p class="author">时间：{{ $blog->created_at }} &nbsp;&nbsp; 作者：{{ $blog->user->username }}</p>
				</div>
				<div class="con">
					{{ $blog->content}}
				</div>
				<p class="btns">（评论：0）（阅读：{{ $blog->display }}）（<input type="button" id="ding" value="顶">：<span id="dingnum">{{ $blog->zhan }}</span>）</p>
			</div>
			<!-- 评论 -->
			<div class="comment">
				<p class="people-count">参与评论人数：<span>20038</span></p>

				<form class="comment-form">
					{{ csrf_field() }}
					<input type="hidden" name="blog_id" value="{{ $blog->id }}">
					<div class="form-div"><textarea name="content" id="" cols="30" rows="10"></textarea></div>
					<div class="form-div"><input id="btn-comment" type="button" value="发表评论"></div>
				</form>
				
				<div class="comment-list">
					
				</div>
				
			</div>
		</div>
		<div class="right">
			<div class="side">
				<h3>日志排行榜</h3>
				<ul>
					@foreach($top as $t)
						<li><a target="_blank" href="">{{$t->title}}</a><p>{{$t->created_at}}</p></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<script src="/ueditor/third-party/jquery.min.js"></script>
	<script>
		// 点赞
		$("#ding").click(function(){

			$.ajax({
				type:"GET",
				url:"/ding/{{$blog->id}}",
				dataType:"json",
				success:function(data){
					if(data.error!=0)
					{
						if(data.error==3){
							$("#ding").attr("disabled",true);
						}
						alert(data.errmsg);
					}
					else
					{
						$('#dingnum').html( 1*$('#dingnum').html()+1 )
					}
				}
			});
		});

		// 评论

		$('#btn-comment').click(function(){
			var content = $.trim($("textarea[name=content]").val());
			var blog_id = $("input[name=blog_id]").val();
			var _token = $('input[name=_token]').val();

			console.log(content,blog_id,_token);

			if(content==""){
				alert("评论不能为空");
				return ;
			}
			if(content.length<10){
				alert("评论不得小于十个字符!");
				return ;
			}

			$.ajax({
				type:"POST",
				url:"/comment",
				data:{content:content,blog_id:blog_id,_token:_token},
				dataType:"json",
				success:function(data){
					$("textarea[name=content]").val(' ');
					alert("评论成功");
				}
			});
		});
		
		var disallow_load = false;
		var ajax_comment_url = "{{ route('comment.index',['blog_id'=>$blog->id]) }}";
		
		$(window).on('scroll',function(){
			
			if(disallow_load) return;

			var st = $(window).scrollTop();
			var wh = $(window).height();
			var dh = $(document).height();
			// console.log(st,wh,dh);
			if(st+wh>=dh-1){
								
				comment_load_data();
			}
		});

		function comment_load_data(){
			disallow_load = true;
			var img=$("<div class='loading_div'><img src='/images/loading.gif' class='loading'></div>");
			$('.comment-list').append(img);
				
			setTimeout(function(){
				$.ajax({
					type:"GET",
					url:ajax_comment_url,
					dataType:"json",
					success:function(data){
						if(data.next_page_url==null){
							$(window).off('scroll');
						}
						else
						{
							ajax_comment_url = data.next_page_url;
						}
						var html="";
						
						$(data.data).each(function(k,v){
							
							html+='<div class="comment-item clearfix"><div class="left"><img src="http://localhost:9999/uploads/'+ v.user.face +'" height="100px"><br>'+v.user.username+'</div>\<div class="right"><p class="date">'+v.created_at+' 发表：</p><p class="con">'+v.content+'</p></div></div>';
						});

						$(".comment-list").append(html);

						disallow_load = false;
						img.remove();
					}
				});
			},500);
		}
		
		comment_load_data();
	</script>
@endsection