$("document").ready(function(){  
	$("#queryCet").submit(function(){
		//正则验证提交表单
		
		//验证姓名
		var names=$("#name").val();
		var nameReg=/^[\u2E80-\u9FFF]{1,6}$/;
		if(names.length==0)
		{
			$.toptip('姓名不可为空', 'error');
			return false;
		}
		else if(!nameReg.test(names))
		{
			$.toptip('请输入正确的姓名', 'error');
			return false;
		}
		else
		{
			
		}

		//验证准考证号
		var password=$("#cetId").val();
		var passwordReg=/^[0-9]{15,20}/;
		if(password.length==0)
		{
			$.toptip('准考证号不可为空', 'error');
			return false;
		}
		else if(!passwordReg.test(password))
		{
			$.toptip('请输入正确的准考证号', 'error');
			return false;
		}
		else
		{
			$.showLoading();
			setTimeout(function() {
        		$.hideLoading();
			}, 3000)
		}
	});
	
	//判断是否勾选同意条款，同意才可提交表单
	var regBtn = $("#sub");
	$("#clauseAgree").change(function(){
			var that = $(this);
			that.prop("checked",that.prop("checked"));
			if(that.prop("checked")){
					$("#sub").removeClass("weui-btn weui-btn_disabled weui-btn_primary").addClass("weui-btn weui-btn_primary");									
					regBtn.prop("disabled",false)
			}else{
					$("#sub").removeClass("weui-btn weui-btn_primary").addClass("weui-btn weui-btn_disabled weui-btn_primary");				
					regBtn.prop("disabled",true)
			}
	});

	//各种点击事件绑定
	$(".returnBefore").click(function(){//返回
		history.go(-1);
	});

	$(".closeAll").click(function(){//关闭网页
		var userAgent = navigator.userAgent;
		if (userAgent.indexOf("Firefox") != -1 || userAgent.indexOf("Chrome") !=-1) {
			window.location.href="about:blank";
		} 
		else {
			WeixinJSBridge.call('closeWindow');//微信内置api关闭微信内置浏览器，
			window.opener = null;
			window.open("", "_self");
			window.close();
		};
	});	

});
