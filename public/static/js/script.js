// 重新生成验证码
function reloadImg(){
    // alert($('#img').attr('src'));
   $('#img').attr('src','/captcha?id='+Math.random());
    // alert($(obj).attr('src'));
}
//左侧菜单点击右侧iframe切换
// 菜单点击
function menuC(obj){
    // 获取url
    var src = $(obj).attr('src');
    // 设置iframe的src
    $('iframe').attr('src',src);
}
//头部搜索添加src属性

$("#mobile_a").blur(function(){
    var src = '/index/user/index.html?mobile_a='+$('#mobile_a').val();
    $('#mobile-btn').attr('src',src);
});




//添加
function nw(url,title) {
    //alert(url)
    layer.open({
        type: 2,
        title: title,
        shadeClose: true,
        shade: false,
        maxmin: false, //开启最大化最小化按钮
        area: ['420px', '400px'],
        content: url,
    });
}
//添加会员管理员
function user_add() {
    //
    var mobile = $("#mobile").val();
    var card = $("#card").val();
    var car = $("#car").val();
    if (mobile == '') {
        layer.alert('手机号不能为空',{icon:2});
        return;
    }
    if (card == '') {
        layer.alert('卡号不能为空',{icon:2});
        return;
    }
    if (car == '') {
        layer.alert('车牌号不能为空',{icon:2});
        return;
    }
    $.post('/index.php/index/user/save',{'mobile':mobile,'car':car,'card':card},function (res) {
        if (res.code >0){
            layer.alert(res.message,{icon:2})
        } else {
            layer.msg(res.message);
            setTimeout(function(){parent.window.location.reload();},1000);
        }
    },'json');

}
//搜索会员
$('#c_search').click(function () {
    // 获取url
   if ($('#search').val()=='') {
       layer.alert('手机号不能为空',{icon:2});
       return false;
   }

    // 设置iframe的src
   // $('iframe').attr('src',src);
});
//分页排序乱掉
$(".pagination li").click(function () {
   // alert($("#sex option:selected").attr('data-value'));
    var src= $(this).children().attr('href')+"&order="+$("#sex option:selected").attr('data-value')+"&id="+$("#id").val();
    $(this).children().removeAttr('href');
    $(this).children().attr('href',src);
    //alert($(this).children().attr('href'));
});
//删除方法
function del(id,url,tip) {
    var tip= arguments[2] ?arguments[2]:'您确定要删除吗？';
    layer.confirm(tip, {
        btn: ['确定','取消'] //按钮
    }, function(){
      $.post(url,{id},function (res) {
            if (res.code > 0){
                layer.alert(res.message,{icon:2})
            }else {
                layer.msg(res.message);
                setTimeout(function(){parent.window.location.reload();},1000);
            }
      },'json')
    }
    );


}

//排序select选中问题
$("#sex option").each(function () {
    // console.log( $(this).attr("data-value"));
    // console.log( $(this).val())
    if ($(this).attr("data-value") == $(this).val()){

        $(this).attr("selected",true);

       $('#select .layui-unselect').val($(this).text())
    }
});
$("#search option").each(function () {
    // console.log( $(this).attr("data-value"));
    // console.log( $(this).val())
    if ($(this).attr("data-value") == $(this).val()){

        $(this).attr("selected",true);

        $('#search-f .layui-unselect').val($(this).text())
    }
});
//添加消费项目
function add_i() {
    //
    var name = $.trim($("#item_name").val());
    if (name == '') {
        layer.alert('类目名称不能为空',{icon:2});
        return;
    }

    $.post('/index.php/index/item/save',{'name':name},function (res) {
        if (res.code >0){
            layer.alert(res.message,{icon:2})
        } else {
            layer.msg(res.message);
            setTimeout(function(){parent.window.location.reload();},1000);
        }
    },'json');

}
//积分兑换
//添加消费项目
function add_integral() {
    //
    var name = $.trim($("#integral_name").val());
    var price = $.trim($("#integral_price").val());
    if (name == '') {
        layer.alert('类目名称不能为空',{icon:2});
        return;
    }
    if (price == '') {
        layer.alert('积分不能为空',{icon:2});
        return;
    }

    $.post('/index.php/index/integral/save',{'name':name,'price':price},function (res) {
        if (res.code >0){
            layer.alert(res.message,{icon:2})
        } else {
            layer.msg(res.message);
            setTimeout(function(){parent.window.location.reload();},1000);
        }
    },'json');

}
//修改类目
function edit_item() {
    var name = $.trim($("#item_name").val());
    var id = $.trim($("#id").val());
    var order = $.trim($("#order").val());
    if (name == '') {
        layer.alert('类目名称不能为空',{icon:2});
        return;
    }
    $.post('/index.php/index/item/edit',{'name':name,'id':id,'order':order},function (res) {
        if (res.code >0){
            layer.alert(res.message,{icon:2})
        } else {
            layer.msg(res.message);
            setTimeout(function(){parent.window.location.reload();},1000);
        }
    },'json');
}
//修改积分类目
function edit_integral() {
    var name = $.trim($("#integral_name").val());
    var price = $.trim($("#integral_price").val());
    var id = $.trim($("#id").val());
    var order = $.trim($("#order").val());
    if (name == '') {
        layer.alert('类目名称不能为空',{icon:2});
        return;
    }
    if (price == '') {
        layer.alert('积分不能为空',{icon:2});
        return;
    }
    $.post('/index.php/index/integral/edit',{'name':name,'id':id,'order':order,'price':price},function (res) {
        if (res.code >0){
            layer.alert(res.message,{icon:2})
        } else {
            layer.msg(res.message);
            setTimeout(function(){parent.window.location.reload();},1000);
        }
    },'json');
}
// 扣款操作

   $('.layui-anim').children().click(function () {
       $('#balance').val($(this).attr('lay-value'));
   });

//回车登录
function on_h() {
    if (window.event.keyCode == 13){
        if (document.all('login')!= null) {
            document.all('login').click();

        }
    }
}
//修改密码
function edit_pwd() {
    var username = $.trim($('#username').val());
    var password = $.trim($('#password').val());
    $.post('/index.php/index/account/edit_pwd',{'username':username,'password':password},function (res) {
        if (res.code >0){
            layer.alert(res.message,{icon:2})
        } else {
            layer.msg(res.message);
            setTimeout(function(){parent.window.location.reload();},1000);
        }
    },'json');
}


