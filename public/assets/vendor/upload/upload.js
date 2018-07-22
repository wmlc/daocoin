function setImagePreview(doc,imgobj,fontobj) {
	    var docObj = document.getElementsByClassName(doc)[0];
	    var imgObjPreview = document.getElementsByClassName(imgobj)[0];
	    if (docObj.files && docObj.files[0]) {
	//火狐下，直接设img属性  
	        imgObjPreview.style.display = 'block';
	        imgObjPreview.style.width = '100%';
	        imgObjPreview.style.height = '100%';
	        imgObjPreview.style.zIndex = "0";
//	        $(fontobj).css({"color":"#fff"})
	        //imgObjPreview.src = docObj.files[0].getAsDataURL();  
	
	        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式    
	        imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
	    } else {
	//IE下，使用滤镜
	        docObj.select();
	        var imgSrc = document.selection.createRange().text;
	        var localImagId = document.getElementById("localImag");
	        //必须设置初始大小  
	        localImagId.style.width = "100%";
	        localImagId.style.height = "100%";
	        //图片异常的捕捉，防止用户修改后缀来伪造图片  
	        try {
	            localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
	            localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
	        } catch (e) {
	            alert("您上传的图片格式不正确，请重新选择!");
	            return false;
	        }
	        imgObjPreview.style.display = 'none';
	        document.selection.empty();
	    }
	    return true;
	}