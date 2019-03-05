@extends('layouts.main')
@section('content')
@section('title','广场')
	<style>
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
			<div class="side">
				<h3>活跃用户</h3>
				<ul class="user-act clearfix">
					@foreach($acUsers as $a)
					<li><a href="个人主页.html"><img src="images/face.jpg" alt=""><br>{{$a->user->username}}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<script src="/ueditor/third-party/jquery.min.js"></script>
	<script>
		var disallow_load = false;
		var ajax_blog_url = "{{ route('ajax.newblogs') }}";

		$(window).on('scroll',function(){

			if(disallow_load) return;

			var st = $(window).scrollTop();
			var wh = $(window).height();
			var dh = $(document).height();
			// console.log(st,wh,dh);
			if(st+wh>=dh-1){
				disallow_load = true;
				
				load_data();
			}
		});

		function load_data(){
			var img=$("<div class='loading_div'><img src='/images/loading.gif' class='loading'></div>");
			$('.left').append(img);
			setTimeout(function(){
				$.ajax({
					type:"GET",
					url:ajax_blog_url,
					dataType:"json",
					success:function(data){
						if(data.next_page_url==null){
							$(window).off('scroll');
						}
						else
						{
							ajax_blog_url = data.next_page_url;
						}
						var html="";
						
						$(data.data).each(function(k,v){
							var id=v.id;
							html+='<div class="art-list"><a href="/blog/'+v.id+'"><p class="title">'+ v.title +'</p><p class="img"><img src="http://localhost:9999/uploads/'+ v.image +'" height="150px"></p></a><p class="btns">'+ v.created_at +'（赞：'+ v.zhan +'）（作者：'+ v.user.username +'）</p></div>';
						});
						

						$(".left").append(html);
						disallow_load = false;
						img.remove();
					}
				});
			},500);
			
		}

		load_data();
	</script>
@endsection