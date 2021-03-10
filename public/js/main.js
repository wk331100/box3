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
    var params = "text=" + text
    send(url, params, text.length)
});


function send(url, params, len) {
    console.log(url);
    console.log(JSON.stringify(params));
    $.ajax({
        //请求方式
        type : "POST",
        dataType: "json",//预期服务器返回的数据类型
        url : url,
        data : params,
        //请求成功
        success : function(result) {
            console.log(result);
            if (result.code == 200) {
                $("#result").val(result.data);
                $("#alert").html("解析完成，原文本字节数: " + len + ",  编码后字节数：" + result.data.length);
                removeClass($("#alert"))
                $("#alert").addClass('alert-success');
            }
        },
        //请求失败，包含具体的错误信息
        error : function(e){
            console.log(e.status);
            console.log(e.responseText);
            $("#alert").html("解析失败，原因：" + e.responseText);
            removeClass($("#alert"))
            $("#alert").addClass('alert-warning');
        }
    });
}

function removeClass(obj) {
    obj.removeClass('alert-info')
    obj.removeClass('alert-success')
    obj.removeClass('alert-danger')
    obj.removeClass('alert-warning')
}


$(document).keypress(function(e) {
    if (e.ctrlKey && e.which == 13 || e.which == 10) {
        $("#encode").click()
    }
})