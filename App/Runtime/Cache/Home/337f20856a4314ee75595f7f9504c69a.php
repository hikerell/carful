<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE HTML>
 <html lang="en-US">
 <head>
 	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />	
	<link rel="stylesheet" href="/carful/Public/css/bootstrap.css">	
	<script type="text/javascript" src="/carful/Public/js/jquery.min.js"></script>
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

	$("#uploadFile").change(function(){		
		var fd = new FormData();
        fd.append("uploadFile", document.getElementById('uploadFile').files[0]);
		var xhr = new XMLHttpRequest();
		/* event listners */
		file=this.files[0];		
		xhr.upload.addEventListener("progress", uploadProgress, false);
		xhr.addEventListener("loadstart", uploadStart, false); //开始
		xhr.addEventListener("load", uploadComplete, false);
		//console.log(xhr);
		/* Be sure to change the url below to the url of your upload server side script */
		xhr.open("POST", "/carful/index.php/Home/Index/ajaxUpload");
		xhr.send(fd);
		console.log('对象：',xhr);
	});

 
		function uploadStart(evt){
			//alert(3);
			$('.on').css('display','none');
			var reader = new FileReader(); 
			reader.readAsDataURL(file); 				
			reader.onload = function(e){ 
				base = this.result; 
				if(base.substring(5,10) != "image"){
					var arr = base.split("base64,");	
					var arr1 =file.name.split(".");
					if(arr1[1] == "jpg"){
						arr1[1] = "jpeg";
					}
					arr[0] = arr[0] +"image/"+ arr1[1]+";base64";		
					base= arr.join();
				}
			$("<img id=\"pic"+count+"\" src=\""+base+"\" style=\"width:60px;height:60px;opacity:0.2\"/>").appendTo("#PicLi");			
			//alert(1);
			}					
		}
		//进度条
		function uploadProgress(evt) {
			if (evt.lengthComputable) {
			var percentComplete = Math.round(evt.loaded/ evt.total);
			//$("img#pic"+count).css('opacity',percentComplete.toString());
			}
		}
		//上传完成
		function uploadComplete(evt) {
		//alert(2);
		/* This event is raised when the server send back a response */
		var json = evt.target.responseText;
		var data = eval('(' + json + ')');	
		$("img#pic"+count).css('opacity','1');
		$('.on').css('display','block');
				count++;
		imgArray[count] = "/carful/uploads"+data.savepath+data.savename;
				//alert(data.savename);
		if(count==3){
				$('.on').css('display','none');
			}
		}
		
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
			<div id="PicLi">
				<div class="on" id="addPic">
					<input type="file" class="on needsclick" style="z-index:200;opacity:0;filter:alpha(opacity=0);-ms-filter:'alpha(opacity=0)';" id="uploadFile" name="uploadFile" accept="image/*" single="">
				</div>
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