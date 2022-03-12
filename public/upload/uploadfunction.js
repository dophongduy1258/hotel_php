// var domain = window.location.protocol + "//" + window.location.host +'/cafe/';


function checkTypeIMG(str_name){

	var stemp = str_name.split('/');
	var str = stemp[1];
	if(str=="jpg"||str=="gif"||str=="png"||str=="jpeg"||str=="JPG"||str=="GIF"||str=="PNG"||str=="JPEG"){
		return true;
	}else{
		alert('Chỉ cho phép định dạng png,jpeg,gif,jpg');
		return false;
	}
}

function checkTypeExcel(str_name){

	var stemp = str_name.split('.');
	var len = stemp.length;
	var str = stemp[(len-1)];
	
	if(str=='xlsx'||str=='xls'){
		return true;
	}else{
		alert('Chỉ cho phép định dạng Excel');
		return false;
	}
}

function checkSizeIMG(sizeIMG){

	if(sizeIMG < 8500000){
		return true;
	}else{
		alert('Dung lượng tối đa cho phép là 8MB');
		return false;
	}
}
function uploadFile( input_img, loading ){
	var barId =  loading.split("#");
	barId = barId['1']+"process";
	var pro_bar = "#"+barId+" .progress-bar";
	
	$(input_img).fileupload({
				add: function(e, data) {
					if(checkSizeIMG(data.originalFiles[0]['size']) && checkTypeIMG(data.originalFiles[0]['type']) ){
						$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
						data.submit();
					}else{
						return false;
					}
				},
				url: domain+'/ajax/uploadfile.php',
				dataType: 'json',
				autoUpload: true,
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
				disableImageResize: /Android(?!.*Chrome)|Opera/
					.test(window.navigator.userAgent),
				previewMaxWidth: 60,
				previewMaxHeight: 60,
				previewCrop: true,
				global:false,
				done: function (e, data) {
					
					$.each(data.result.files, function (index, file) {
						$(loading).html(`<img src="${domain}/public/images/plus-sign.png" style="opacity:0.3;cursor:pointer;" class="img-responsive">`);
						$("#hold_img_show").after(`<a class="col-md-2 img"><img src="${file.name}" class="img-responsive img"><i class="delete">x</i></a>`);
					});

					$(input_img).val('');
				
				},
				fail: function(e, data) {
				  var linkimg = domain;
					$.each(data.result.files, function (index, file) {
						$(loading).html('<a target="_blank" href="'+file.name+'"><img src="'+file.name+'" name="" class=""/></a><i title="update" onclick="return click_update_url();" class="glyphicon glyphicon-edit edit_url_update"></i>');						
					});
				},
				progressall: function (e, data) {
					var progress = parseInt(data.loaded / data.total * 100, 10);
					var percent = "div ";
					$(pro_bar).css(
						'width',
						progress + '%'
					);
					$(pro_bar).html(progress+'%');
				}
	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

}

// function uploadLogoShop(input_img,output_img,loading){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
	
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.formData = {shop_id: $("#bill_shop_id").val(),upload_logo: '1'};
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 				},
// 				url: domain+'/phpjquery/uploadfile.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				global:false,
// 				done: function (e, data) {
// 					/*
// 					kq= data.split("##");
// 					if(kq.length==2){
// 						var obj = $.parseJSON(kq['1']);
// 						$(loading).html('<img id="clicktoup" src="'+domain+'/'+ obj['name'] +'" name="" class=""/>');
// 					}else{
// 						return false;
// 					}
// 					*/
					
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html('<a target="_blank" href="'+file.name+'"><img src="'+file.name+'" name="" class=""/></a><i title="update" onclick="return click_update_url();" class="glyphicon glyphicon-edit edit_url_update"></i>');
// 						$("#frame_bill").attr("src", domain+ '/print.php?m=print&act=all&type=review&shop_id=' + $("#bill_shop_id").val() + '&time=' + Math.random() );
// 					});
				
// 				},
// 				fail: function(e, data) {
// 				  var linkimg = domain;
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html('<a target="_blank" href="'+file.name+'"><img src="'+file.name+'" name="" class=""/></a><i title="update" onclick="return click_update_url();" class="glyphicon glyphicon-edit edit_url_update"></i>');						
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }

// function uploadFileExcel(input_img,output_img,loading){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process"; 
// 	var pro_bar = "#"+barId+" .progress-bar";
	
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								if(checkTypeExcel(data.originalFiles[0]['name'])){
// 									$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 									data.formData = {import_code: $("#import_code").val(),wh_id: $("#import_wh_id").val()};
// 									data.submit();
// 								}else{
// 									return false;
// 								}
// 							}else{
// 								return false;
// 							}
// 				},
// 				url: domain+'/phpjquery/uploadfileexcel.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					var link ='';
// 					$.each(data.result.files, function (index, file) {
// 						link = file.name;
						
// 					});
// 					get_importfile(link);
// 				},
// 				fail: function(e, data) {
// 					var link ='';
// 					$.each(data.result.files, function (index, file) {
// 						link = file.name;
// 					});
// 					get_importfile(link);
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }
// function uploadIMG_product(input_img,output_img,loading){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/upload.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					// var linkimg = domain + '/';
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html("<img  src='"+file.name+"' />");
// 						$(output_img).val(file.name);
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }
// function uploadIMG_product2(input_img,output_img,loading){
	
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/upload.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					// var linkimg = domain + '/';
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html("<img  src='"+file.name+"' />");
// 						$(output_img).val(file.name);
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
	
// }
// function uploadIMG_register(input_img,output_img,loading){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/upload.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					// var linkimg = domain+"/uploads/temp/";
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html("<img  src='"+file.name+"' />");
// 						$(output_img).val(file.name);
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }
// function uploadIMG_support_post(input_img,output_img,loading){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/upload_support_post.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					// var linkimg = domain+"/uploads/tmp_support_post/";
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html("<img  src='"+file.name+"' />");
// 						$(output_img).val(file.name);
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }
// function uploadIMG_Quick(input_img,output_img,loading,show,out_link){
// 	/*
// 	@ input_img is input tag change event
// 	@outupt_img is input tag content kq
// 	@loading is loading bar
// 	@show is where to show img
// 	@out_link is input tag hold link
// 	*/
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/uploadimg_quick.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					//var linkimg = domain+"/uploads/temp/";
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html("");
// 						$(show).html("<img  src='"+file.name+"' />");
// 						$(out_link).val(file.name);
// 						$(output_img).val(file.name);
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }
// function uploadIMG_Transfer(input_img,output_img,loading){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/index.php?act=uploadimg_transfer',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					// var linkimg = domain+"/";
// 					$.each(data.result.files, function (index, file) {
// 						if(file.name!=''){
// 							$(loading).html("<img  src='"+file.name+"' />");
// 							$(output_img).val(file.name);
// 						}else{
// 							$(loading).html("B?n kh�ng du?c ph�p c?p nh?t h�a don.");
// 						}
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }


// function uploadIMGFunction(input_img,output_img,loading){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
	
// 	var text_input =  input_img.split("#");
// 	text_input = text_input['1'];
	
// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/upload.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					// var linkimg = domain + '/';
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html("<img onclick=\"review_img('"+file.name+"')\"  src='"+file.name+"' />\
// 								 		<span onclick=\"click_file('"+text_input+"')\" class=\" img_func icon-cate icon-other-edit\"></span>\
// 			      	  					<span onclick=\"delete_file('"+text_input+"')\" class=\" img_func icon-cate icon-other-x\"></span>");
// 						$(output_img).val(file.name);
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }

// function uploadIMGReview(input_img,output_img,loading,review_images){
// 	var barId =  loading.split("#");
// 	barId = barId['1']+"process";
// 	var pro_bar = "#"+barId+" .progress-bar";
	
// 	var text_input =  input_img.split("#");
// 	text_input = text_input['1'];

// 	var text_out =  output_img.split("#");
// 	text_out = text_out['1'];

// 	$(input_img).fileupload({
// 				add: function(e, data) {
// 						if(checkTypeIMG(data.originalFiles[0]['type'])){
// 							if(checkSizeIMG(data.originalFiles[0]['size'])){
// 								$(loading).html('<div class="progress" id="'+barId+'"> <div class="progress-bar progress-bar-success">0%</div> </div>');
// 								data.submit();
// 							}else{
// 								return false;
// 							}
// 						}else{
// 							return false;
// 						}
// 				},
// 				url: domain+'/phpjquery/upload.php',
// 				dataType: 'json',
// 				autoUpload: true,
// 				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,				
// 				disableImageResize: /Android(?!.*Chrome)|Opera/
// 					.test(window.navigator.userAgent),
// 				previewMaxWidth: 60,
// 				previewMaxHeight: 60,
// 				previewCrop: true,
// 				done: function (e, data) {
// 					// var linkimg = domain + '/';
// 					$.each(data.result.files, function (index, file) {
// 						$(loading).html("<img onclick=\"review_img(\'"+review_images+"\', \'"+file.name+"')\"  src='"+linkimg+file.name+"' />\
// 								 		<span onclick=\"click_file('"+text_input+"')\" class=\" img_func btn_edit_icon\"></span>\
// 			      	  					<span onclick=\"delete_file('"+text_out+"')\" class=\" img_func btn_delete_icon\"></span>");
// 						$(output_img).val(file.name);
// 					});
// 				},
// 				progressall: function (e, data) {
// 					var progress = parseInt(data.loaded / data.total * 100, 10);
// 					var percent = "div ";
// 					$(pro_bar).css(
// 						'width',
// 						progress + '%'
// 					);
// 					$(pro_bar).html(progress+'%');
// 				}
// 	}).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

// }

// // function click_file(id){
// // 	$("#"+id).click();
// // }

// // function review_img(id,url){
// // 	$('#'+id).attr('src', url);
// // }
