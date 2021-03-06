<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="renderer" content="webkit">
<title><?php echo C("WEB_TITLE");?></title>
<link rel="shortcut icon" href="favicon.ico">
<link href="/Public/Front/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/Front/css/font-awesome.min.css" rel="stylesheet">
<link href="/Public/Front/css/animate.css" rel="stylesheet">
<link href="/Public/Front/css/style.css" rel="stylesheet">
<link href="/Public/Front/js/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
<style>
.layui-form-label {width:110px;padding:4px}
</style>
<body>
    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-sm-12">
				<p class="text-danger" style="padding: 15px;">注：费率为百分位，例如：百分之三则填 3</p>
			<form class="layui-form" action="" id="rate">
				<input type="hidden" name="userid" value="<?php echo ($_GET['uid']); ?>">
				<!--产品列表-->
				<table class="layui-table" lay-even="" lay-skin="line">
				<thead>
				<tr>
				  <th>接口名称</th>
				  <th>运营费率</th>
				  <th>封顶费率</th>
				</tr> 
				</thead>
				<tbody>
				<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($p["name"]); ?></td>
					<td>
						<div class="layui-input-inline" style="width: 100px;">
						<input type="text" name="u[<?php echo ($p["id"]); ?>][feilv]" placeholder="" autocomplete="off" class="layui-input" value="<?php echo ($p["feilv"]); ?>">
						</div>
					</td>
					<td>
						<div class="layui-input-inline" style="width: 100px;">
						<input type="text" name="u[<?php echo ($p["id"]); ?>][fengding]" placeholder="" autocomplete="off" class="layui-input" value="<?php echo ($p["fengding"]); ?>">
						</div>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				</tbody>
				</table>
				<!--产品列表-->
				<div class="layui-form-item">
					<div class="layui-input-block">
					  <button class="layui-btn" lay-submit="submit" lay-filter="save">提交保存</button>
					</div>
				</div>
			</form>
            </div>
        </div>
    </div>

    <script src="/Public/Front/js/jquery.min.js"></script>
    <script src="/Public/Front/js/bootstrap.min.js"></script>
    <script src="/Public/Front/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/Public/Front/js/content.js"></script>
	<script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>

<script>
layui.use(['layer', 'form','laydate'], function(){
  var form = layui.form
  ,laydate = layui.laydate
  ,layer = layui.layer;
  
  //监听提交
  form.on('submit(save)', function(data){
    $.ajax({
		url:"<?php echo U('User/saveUserRate');?>",
		type:"post",
		data:$('#rate').serialize(),
		success:function(res){
			if(res.status){
			layer.alert("编辑成功", {icon: 6},function () {
				parent.location.reload();
				var index = parent.layer.getFrameIndex(window.name);
				parent.layer.close(index);
			});
			}
		}
	});
    return false;
  });
});
</script>
<!--统计代码，可删除-->
</body>
</html>