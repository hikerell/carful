<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="robots" content="all" />
    <meta name="author" content="Tencent" />
    <meta name="Copyright" content="Tencent" />
    <meta name="Description" content="微社区" />
    <meta name="Keywords" content="微社区、微生活" />
    <title>微社区后台</title>
    <link rel="stylesheet" href="/carful/Public/css/style.css">
	<script type="text/javascript" src="/carful/Public/js/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="headerCon">
            <a href="javascript:;" class="logo db fl ht" title="微社区">微社区</a>
            <ul class="navMenu fl">
                <li><a href="#" class="spr on" >首页</a></li>
                <li><a href="#">管理中心</a></li>
            </ul>
        </div>
    </div>

    <div class="wp mtm nvt title pr" id="topbar">
    </div>
    <div class="container">
        <div id="mainContainer" class="main">
		<div class="topicBox">
			<div class="topicList">
			<ul id="topicItems">    
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li id="<?php echo ($vo1["id"]); ?>"> 
					<div class="editBtn fl">
					<a href="javascript:;" title="" class="delBtn db spr ht" tid="<?php echo ($vo1["id"]); ?>">删除帖子</a>
					<a href="javascript:;" title="" class="pass" tid="<?php echo ($vo1["id"]); ?>">通过审核</a>
					</div> 
					<div class="topicCon fr pr"> 
						<a href="javascript:;" class="avatar"><img src="<?php echo ($vo1["pic1"]); ?>" class="personImg" width="80" height="80" alt="图片1"></a> 
						<a href="javascript:;" class="avatar"><img src="<?php echo ($vo1["pic2"]); ?>" class="personImg" width="80" height="80" alt="图片2"></a> 
						<a href="javascript:;" class="avatar"><img src="<?php echo ($vo1["pic3"]); ?>" class="personImg" width="80" height="80" alt="图片3"></a> 
						<p class="titDate"> 
						<span class="db fl author">
						<strong>姓名：<?php echo ($vo1["name"]); ?></strong>
						</span> 
						<p class="htmlEdit"><a href="javascript:;" title="">电话：<?php echo ($vo1["tel"]); ?></a></p>  
						<p class="htmlEdit"><a href="javascript:;" title="">宣言：<?php echo ($vo1["content"]); ?></a></p>  
	
					</div> 
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<?php echo ($page); ?>
			</div>
		</div>
		</div>
        <div class="appl">
			<li><dd class="on">帖子管理</dd></li>
		</div>
    </div>
    <div class="footer">微策划公司 版权所有</div>
</div>
<script type="text/javascript">
$('.delBtn').live('click',function(){
	var id = $(this).attr('tid');
	if(confirm("确定删除此宝贝？")){
		$.post('/carful/index.php/Home/Admin/del',
			{
			id:id,
			},
			function(e){
				if(e == 1){
					alert('删除成功');
					window.location.reload();
				}
				if(e == 2){
					alert('删除失败');
				}
			});
	}
});

$('.pass').live('click',function(){
	var id = $(this).attr('tid');
	if(confirm("确定审核通过此宝贝？")){
		$.post('/carful/index.php/Home/Admin/pass',
			{
			id:id,
			},
			function(e){
				if(e == 1){
					alert('审核成功');
					window.location.reload();
				}
				if(e == 2){
					alert('审核失败');
				}
			});
	}
});
</script>
</body>
</html>