
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>登录</title>
<link rel="stylesheet" type="text/css" href="/logins/normalize.css" />
<link rel="stylesheet" type="text/css" href="/logins/demo.css" />

<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/logins/component.css" />
<!-- // --><link rel="stylesheet" type="text/css" href="/logins/demo-1-bg.jpg" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- 表单提示错误信息 手册第321页-322页-->
		<!--  -->
		<div class="alert alert-danger"></div>
<div class="container demo-1">
	<div class="content">
		<div id="large-header" class="large-header">
			<canvas id="demo-canvas"></canvas>
			<div class="logo_box">
				<h3>微信后台登陆</h3>
				<form action="http://admin.1912.com/login/store" name="f" method="post">
					<input type="hidden" name="_token" value="mseqeQpBTsmT57a70lgVWEuVxgBgAsnGgG8psbvl">					<div class="input_outer">
						<span class="u_user"></span>
						<input name="wetch_user" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
					</div>
					<div class="input_outer">
						<span class="us_uer"></span>
						<input name="wetch_pwd" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
					</div>
					<input name="rember" value="1" type="checkbox" />
    					<span>七天免登录</span>
				    <center>
					     <p><font color="red" id="b"></font></p>
					     <button class="act-but submit" type="button" id="button" style="color: #FFFFFF">登录</button>
					</center>
				</form>
			</div>
		</div>
	</div>
</div><!-- /container -->
		<script src="/logins/TweenLite.min.js"></script>
		<script src="/logins/EasePack.min.js"></script>
		<script src="/logins/rAF.js"></script>
		<script src="/logins/demo-1.js"></script>
	</body>
</html>
<script>
$(document).on("click","#button",function(){

  var wetch_user = $("input[name='wetch_user']").val();
  var wetch_pwd = $("input[name='wetch_pwd']").val();
  var rember = $("input[name='rember']:checked").val();
  if(wetch_user==''){
        $("input[name='wetch_user']").prop("placeholder","账号不能为空!");return;
  }
   if(wetch_pwd==''){
        $("input[name='wetch_pwd']").prop("placeholder","密码不能为空!");return;
  }
  $.ajax({
	    url:"{{url('/login')}}",
        type:'post',
		dataType:'json',
		data:{wetch_user:wetch_user,wetch_pwd:wetch_pwd,rember:rember},
		async:true,
		success:function(res){
			if(res.error_no=='0'){
				alert(res.error_msg);
			    location.href="{{url('/list')}}";
			}else if(res.error_no=='1'){
			   $("#b").text(res.error_msg);
		   }
		}
  });
});
</script>