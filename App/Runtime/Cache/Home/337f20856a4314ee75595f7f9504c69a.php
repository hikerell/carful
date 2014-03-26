<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE HTML>
 <html lang="en-US">
 <head>
 	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />	
	<link rel="stylesheet" href="/carful/Public/css/bootstrap.css">	
	<script type="text/javascript" src="/carful/Public/js/jquery.min.js"></script>
	<script type="text/javascript" src="/carful/Public/js/uploadfive/jquery.uploadifive.min.js"></script>
	<link rel="stylesheet" href="/carful/Public/js/uploadfive/uploadifive.css">	
 	<title></title>
	<style type="text/css">
      .head {
        position:relative;
        height:44px;
        line-height:44px;
        text-align:right;
        color: #fff;
        font-family: "微软雅黑";
        background-color: #e4393c;
        margin-bottom: 5px;
      }
      .thumbnail > img,.thumbnail a > img {
        max-width: 100%;
        height: 350px;
      }
      .thumbnail h3 {
        font-family: "微软雅黑";
        font-size: 14px;
        text-align: center;
      }
      .thumbnail .caption {
        padding: 0px;
      }
      .thumbnail a {
        color: #3d3c41;
      }

      .footer{
        color:#999;
        text-align:center;
        padding:30px 0;
        margin-top:30px;
        border-top:1px solid #e5e5e5;
        background-color:#f5f5f5;
        text-shadow: 0px 1px 0px #FFF;
      }
      .more {
        border: 1px solid #eee;
        font-size: 15px;
        height: 35px;
        line-height: 35px;
        text-align: center;
      }
      .more a {
        color: #a2a2a2;
      }
      .help-block span {
        color: #e4393c;
        padding: 0px 4px;

      }
	  input{
	  }
	  .on{
		background: #d9d9d9 url(/carful/Public/addBtn.png) no-repeat 50% 50%;
		margin-right: 0;
		cursor: pointer;
		width: 60px;
		height: 60px;
		float: left;
		display:block;
	  }
	  #PicLi{
	  height:60px;
	  }
    </style>
 </head>
 <body>
<script type="text/javascript">
//$("<img id=\"pic"+count+"\" src=\""+base+"\" style=\"width:60px;height:60px;\"/>").appendTo("#PicLi");
	var imgArray = new Array();
	var count = 0;
	var file;
	var base;
$(document).ready(function(){

	
		
	$("#submit").live('click',function(){
		if($("#tel").val().length != 11)
		{
			alert('手机号输入不正确');
		}else if($("#name").val() ==""){
			alert('姓名输入不正确');
		}else if(count == 0){
			alert('最少上传一张照片');
		}else if($("#content").val() ==""){
			alert('参赛宣言输入不正确');
		}
		else{
			var Data = {
				name:$("#name").val(),
				tel:$("#tel").val(),
				content:$("#content").val(),
				pic:imgArray
			};
			console.log(Data)
			$.post('/carful/index.php/Home/Index/AddPublish', Data,
			function(e) {		
				//alert(e);
				alert('提交成功');
				window.location.href="/carful/index.php/Home/Index/index";
			})
		}
	});
});
</script>
   <header>  
      <div class="head">
        <div class="fl" style="width:100%;text-align:center">
          <span>家福来宝贝信息提交</span>
          <div class="head-btn">
          </div>
        </div>
      </div>
   </header>
    <div class="container">
    
    <div class="row">
      
          <div class="thumbnail">
            <img src="" />
            <div class="caption">
            </div>
          </div>
		  
		  <div class="thumbnail">
			<p>参赛编号：<input type="" value="家福来宝贝<?php echo ($count); ?>号" readonly="readonly" style="border:0;"/></p>
			<p>姓　　名：<input type="" id="name" value="" /></p>
			<p>手　　机：<input type="" id="tel" value="" /></p>
			<p>参赛宣言：<input type="" id="content" value="" /></p>
			<div id="queue" style="dispaly:block"></div>
			<div id="PicLi">
				<div class="on" id="addPic">
					<input type="file" id="uploadFile" name="uploadFile" accept="image/*" single="">
				</div>
			<script type="text/javascript">
				$(function() {
					$('#uploadFile').uploadifive({
						'auto'             : true,
						'queueID'          : 'queue',
						'uploadScript'     : '/carful/index.php/Home/Index/ajaxUpload',
						'onUploadComplete' : function(file, data) { 
								var data = eval('(' + data + ')');
								count++;
								imgArray[count] = "/carful/uploads"+data.savepath+data.savename;
								
								$("<img id=\"pic"+count+"\" src=\""+imgArray[count]+"\" style=\"width:60px;height:60px;\"/>").appendTo("#PicLi");		
								//alert(data.savename);
								if(count==3){
									$('.on').css('display','none');
								}
								$("#uploadifive-uploadFile-file-"+(count-1)).css('display','none');
							}
					});
				});
			</script>
			</div>	
		
			<button id="submit" style="margin-top:4px;width:80%;margin-left:10%;">提交</button>
          </div>
		  
		  <div class="thumbnail">
            <span class="help-block">活动内容XXXXXXXXXXXXXXXXXX</span>
          </div>


    </div>
    </div>
     <div class="footer">
      <address>
        Copyright © 微策划科技 版权所有<br>
        <abbr title="Phone">联系电话:</abbr> (0816) 2171030
      </address>
    </div>
 </html>