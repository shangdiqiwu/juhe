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
<link rel="stylesheet" href="/Public/Front/js/plugins/layui/css/layui.css">
<style>
.layui-form-label {width:110px;padding:4px}
</style>
<body>
    <div class="wrapper wrapper-content animated">
        <div class="row">
            <div class="col-sm-12">
            <form class="layui-form" action="" id="editRate">
            <input type="hidden" name="aid" value="<?php echo ($aid); ?>">
            <div class="layui-form-item">
              <label class="layui-form-label">费率模式：</label>
              <div class="layui-input-block">
                <input lay-filter="custom_rate" type="radio" name="pa[custom_rate]" <?php if( $pa["custom_rate"] == 0): ?>checked="checked"<?php endif; ?> value="0" title="继承通道"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>继承通道</span></div>
                <input lay-filter="custom_rate" type="radio" name="pa[custom_rate]" <?php if($pa["custom_rate"] == 1): ?>checked="checked"<?php endif; ?> value="1" title="自定义"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>自定义</span></div>
              </div>
            </div>

            <div id='custom_rate_group' <?php if($pa["custom_rate"] == 0): ?>style="display:none"<?php endif; ?>>
             <div class="layui-form-item">
                  <label class="layui-form-label">运营费率</label>
                  <div class="layui-input-block">
                    <input type="text" name="pa[defaultrate]" placeholder="运营费率" autocomplete="off" value="<?php echo ($pa["defaultrate"]); ?>" class="layui-input">
                  </div>
                 <div class="layui-form-small layui-word-aux">单位：%，例如：百分之三填 3</div>
             </div>
             <div class="layui-form-item">
                  <label class="layui-form-label">封顶手续费</label>
                  <div class="layui-input-block">
                    <input type="text" name="pa[fengding]" placeholder="封顶手续费" autocomplete="off" value="<?php echo ($pa["fengding"]); ?>" class="layui-input">
                  </div>
                 <div class="layui-form-small layui-word-aux">单位：%，例如：百分之三填 3</div>
             </div>
             <div class="layui-form-item">
                  <label class="layui-form-label">成本费率</label>
                  <div class="layui-input-block">
                    <input type="text" name="pa[rate]" placeholder="成本费率" autocomplete="off" value="<?php echo ($pa["rate"]); ?>" class="layui-input">
                  </div>
                 <div class="layui-form-small layui-word-aux">单位：%，例如：百分之三填 3</div>
             </div>
             </div>            
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" lay-submit="submit" lay-filter="edit">提交保存</button>
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
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['layer', 'form'], function(){
  var form = layui.form
  ,layer = layui.layer;
  
  //监听提交
  form.on('submit(edit)', function(data){
    $.ajax({
        url:"<?php echo U('Channel/editAccountRate');?>",
        type:"post",
        data:$('#editRate').serialize(),
        success:function(res){
            if(res.status){
                layer.alert("编辑成功", {icon: 6},function () {
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                    parent.$('#custom_rate' + res.data.aid).text(res.data.custom_rate == 1 ? '自定义' : '继承通道');
                });
            }else{
                layer.msg("操作失败!", {icon: 5},function () {
                    var index = parent.layer.getFrameIndex(window.name);
                    parent.layer.close(index);
                });
                return false;
            }
        }
    });
    return false;
  });

  form.on('radio(custom_rate)', function(data) {
    if (data.value == 1) {
      $('#custom_rate_group').show()
    } else {
      $('#custom_rate_group').hide()
    }
  })
});
</script>
    <!--统计代码，可删除-->
</body>
</html>