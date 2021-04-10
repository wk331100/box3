$("#clear").click(function () {
    $("#text").val("");
    $("#result").val("");
});


$("#exchange").click(function () {
    var text =  $("#text").val();
    var result =  $("#result").val();
    $("#text").val(result);
    $("#result").val(text);
});

$("#encode").click(function () {
    var url = $("#target").val() + "&type=encode";
    var text = $("#text").val();
    var params = "text=" + text
    send(url, params, text.length)
});

$("#decode").click(function () {
    var url = $("#target").val() + "&type=decode";
    var text = $("#text").val();
    var params = "text=" + text;
    send(url, params, text.length)
});

$('input[type=radio][name=len]').change(function () {
    console.log($(this).val());
    if ($(this).val() == 'x') {
        console.log("show");
        $("#lenx-value").show();
    } else {
        $("#lenx-value").hide();
        $("#lenx-value").val("");
    }
});


$("#create").click(function () {
    var url = $("#target").val() + "&type=create";
    var name = $("#name").val();
    var type = 'json';
    var params = '';

    console.log(url);
    console.log(name);

    switch(name) {
        case "RandChar" :
            params =  RandChar();
            break;
        case "Md5" :
            params =  "text=" + $("#text").val();
            break;
        case "QRcode" :
            var text = $("#text").val()
            var alertObj = $("#alert");
            console.log(text.length)
            if (text.length <= 0){
                alertObj.html("生成失败，内容错误！");
                removeClass(alertObj);
                alertObj.addClass('alert-warning');
            } else {
                $("#result").html("<img src='/qrcodeImg?text="+text+"' height='250' width='250'>");
                alertObj.html("生成完成");
                removeClass(alertObj);
                alertObj.addClass('alert-success');
            }
            return
    }
    if (params !== false){
        sendCreate(url, params, type);
        $('#create').attr("disabled", true);
    }
});




function send(url, params, len) {
    var alertObj = $("#alert");
    $.ajax({
        //请求方式
        type : "POST",
        dataType: "json",//预期服务器返回的数据类型
        url : url,
        data : params,
        //请求成功
        success : function(result) {
            console.log(result);
            if (result.code === 200) {
                $("#result").val(result.data);
                alertObj.html("解析完成，原文本字节数: " + len + ",  编码后字节数：" + result.data.length);
                removeClass(alertObj);
                alertObj.addClass('alert-success');
            } else if (result.code === 101){
                fake('encode', result.msg);
            } else {
                alertObj.html("解析失败，原因：" + result.msg);
                removeClass(alertObj);
                alertObj.addClass('alert-warning');
                $('#create').attr("disabled",false);
            }
        },
        //请求失败，包含具体的错误信息
        error : function(e){
            alertObj.html("解析失败，原因：" + e.responseText);
            removeClass(alertObj);
            alertObj.addClass('alert-warning');
            $('#encode').attr("disabled",false);
        }
    });
}

function sendCreate(url, params, type) {
    var alertObj = $("#alert");
    $.ajax({
        //请求方式
        type : "POST",
        dataType: type,//预期服务器返回的数据类型
        url : url,
        data : params,
        //请求成功
        success : function(result, resType, xhr ) {
            if (result.code === 200) {
                $("#result").val(result.data);
                alertObj.html("生成完成");
                removeClass(alertObj);
                alertObj.addClass('alert-success');
                $('#create').attr("disabled",false);
            } else if (result.code === 101){
                fake('create', result.msg);

            } else {
                alertObj.html("生成失败，原因：" + result.msg);
                removeClass(alertObj);
                alertObj.addClass('alert-warning');
                $('#create').attr("disabled",false);
            }
        },
        //请求失败，包含具体的错误信息
        error : function(e){
            alertObj.html("生成失败，原因：" + e.responseText);
            removeClass(alertObj);
            alertObj.addClass('alert-warning');
            $('#create').attr("disabled",false);
        }
    });
}

function removeClass(obj) {
    obj.removeClass('alert-info');
    obj.removeClass('alert-success');
    obj.removeClass('alert-danger');
    obj.removeClass('alert-warning')
}

function fake(op, msg) {
    alertObj = $("#alert");
    removeClass(alertObj);
    if (op === 'create') {
        $('#create').attr("disabled",true);
    } else if (op === 'encode'){
        $('#encode').attr("disabled",true);
        $('#decode').attr("disabled",true);
    }

    alertObj.addClass('alert-danger');
    var i = 60;
    $t1 = setInterval(function(){
        if (i <= 0) {
            removeClass(alertObj);
            alertObj.addClass('alert-primary');
            alertObj.html("请求锁定已解除");
            clearInterval($t1);
            if (op === 'create') {
                $('#create').attr("disabled",false);
            } else if (op === 'encode'){
                $('#encode').attr("disabled",false);
                $('#decode').attr("disabled",false);
            }
        } else {
            alertObj.html(msg + " 请求锁定剩余 ：" + i);
            i--;
        }
    }, 1000)

}


function RandChar(){
    var char = '';
    var len = '';
    $('input[name="char"]:checked').each(function(){
        char += $(this).val() + "|"
    });
    len = $("input[name='len']:checked").val();
    if(len === 'x') {
        len = $("#lenx-value").val();
    }
    if (len === '' || isNaN(len)) {
        var obj = $("#alert");
        obj.html("自定义长度 只能是数字且不能为空");
        removeClass(obj);
        obj.addClass('alert-danger');
        return false;
    }
    char = char.substring(0,char.length - 1);
    return "char=" + char + "&len=" + len
}





$(document).keypress(function(e) {
    if (e.ctrlKey && e.which == 13 || e.which == 10) {
        $("#encode").click();
        $("#create").click();
    }
});