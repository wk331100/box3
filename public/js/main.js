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
    var params = '';

    console.log(url);
    console.log(name);

    switch(name) {
        case "RandChar" :
            params =  RandChar();
    }
    if (params !== false){
        sendCreate(url, params)
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
            }
        },
        //请求失败，包含具体的错误信息
        error : function(e){
            alertObj.html("解析失败，原因：" + e.responseText);
            removeClass(alertObj);
            alertObj.addClass('alert-warning');
        }
    });
}

function sendCreate(url, params) {
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
                alertObj.html("生成完成");
                removeClass(alertObj);
                alertObj.addClass('alert-success');
            }
        },
        //请求失败，包含具体的错误信息
        error : function(e){
            alertObj.html("生成失败，原因：" + e.responseText);
            removeClass(alertObj);
            alertObj.addClass('alert-warning');
        }
    });
}

function removeClass(obj) {
    obj.removeClass('alert-info');
    obj.removeClass('alert-success');
    obj.removeClass('alert-danger');
    obj.removeClass('alert-warning')
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