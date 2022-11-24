<?php
function random_str () {
    $poems = "primary|success|info|warning|danger|purple|cyan|brown";
    $poems = explode("|",$poems);
    return $poems[rand(0,count($poems)-1)];
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <title>QB查询中心</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
    <style>
        .site-content {
            margin: 0 20%;
            width: 60%;
        }
        .logo-header > img {
            margin: 100px 0;
            width: 210px;
            height: 36px;
        }
        @media (max-width: 769px) {
            .site-content {
                margin: 0;
                width: 100%;
            }
            .logo-header > img {
                margin: 20px 0;
            }
        }
    </style>
</head>
<body>
<div class="logo-header text-center"><img src="https://guanjia.qq.com/assets/images/v15/logo.png"></div>
    <div class="container-fluid p-t-15 site-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <header class="card-header"><div class="card-title">查询中心</div></header>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>查询项目：</label>
                            <select class="form-control" name="api">
                                <option value="">请选择查询项目</option>
                                <option value="1" selected>【1】QQ号查询绑定手机（输入QQ）</option>
                                <option value="2">【2】手机号查询绑定QQ（输入手机）</option>
                                <option value="3">【3】LOL查询接口（输入QQ）</option>
                                <option value="4">【4】LOL反查接口（输入昵称）</option>
                                <option value="5">【5】微博通过ID查手机号（输入ID）</option>
                                <option value="6">【6】通过手机号查微博ID（输入手机）</option>
                                <option value="7">【7】QQ号查询老密（输入QQ）</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>查询账号：</label>
                            <input type="text" class="form-control" name="data" placeholder="请输入您的查询账号" >
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" id="query" class="btn btn-label btn-<?php echo random_str();?> btn-block"><label><i class="mdi mdi-checkbox-marked-circle-outline"></i></label> 立即查询</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="layer/jquery.min.js"></script>
<script type="text/javascript" src="layer/layer.min.js"></script>
<script>
    $('#query').click(function () {
        var api = $("select[name='api']").val();
        var data = $("input[name='data']").val();
        if(data.length < 1 || api.length < 1){
            layer.msg('请确保必填项不为空');
            return false;
        }
        var load = layer.load('2', { shade: 0.2 });
        $.ajax({
            type:'POST',
            url:'Ajax.php',
            data:{
                data:data,
                api:api,
            },
            dataType:'json',
            success:function (data){
                layer.close(load)
                if(data.code == 1){
                    layer.alert(data.msg, {skin: 'lyear-skin-success'});
                }else{
                    layer.alert(data.msg, {skin: 'lyear-skin-danger'});
                }
            }
        });
        return false;
    });
</script>
</body>
</html>
