$(function(){
    
    function onSuccess(){
        $("#cp_photo_capa").parent("a").find("span").html("Escolher outra Foto");
        
        var img = $("#cp_target_capa").find("#crop_image_capa");
        var imgn = $("#cp_target_capa").find("#cp_name_img_capa");
        
        if(img.length === 1){            
            $("#cp_img_capa_path").val(imgn.attr("value"));
            //console.log(imgn);
            img.cropper({
                        aspectRatio: 16/9,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        zoomable: false,
                        crop: function(data) {
                            $("#capa_x").val(data.x);
                            $("#capa_y").val(data.y);
                            $("#capa_h").val(data.height);
                            $("#capa_w").val(data.width);
                        }
                        
            });
            
            $("#cp_capa_accept").prop("disabled",false).removeClass("disabled");
            
            $("#cp_capa_accept").on("click",function(){                
                $("#user_image").html('<img src="../../assets/images/loaders/default.gif"/>');
                $("#modal_change_photo").modal("hide");
                $("#cp_crop_capa").ajaxForm({target: '#cp_target_capa'}).submit();
                $("#cp_target_capa").html("Use o formulário abaixo para carregar o arquivo. Somente arquivos .jpg .");
                $("#cp_photo_capa").val("").parent("a").find("span").html("Select file");
                $("#cp_capa_accept").prop("disabled",true).addClass("disabled");            
                $("#cp_img_capa_path").val("");
                $('#cp_crop_capa').resetForm();
            });           
        }
    }
    
    $("#cp_photo_capa").on("change",function(){
        
        if($("#cp_photo_capa").val() == '') return false;
        
        $("#cp_target_capa").html('<img src="../../assets/images/loaders/default.gif"/>');        
        $("#cp_upload_capa").ajaxForm({target: '#cp_target_capa',success: onSuccess}).submit();        
    });
    
    
});      