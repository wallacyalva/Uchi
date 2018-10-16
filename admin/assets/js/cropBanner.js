$(function(){
    
    function onSuccess(){
        $("#cp_photo_banner").parent("a").find("span").html("Escolher outra Foto");
        
        var img = $("#cp_target_banner").find("#crop_image_banner");
        var imgn = $("#cp_target_banner").find("#cp_name_img_banner");
        
        if(img.length === 1){            
            $("#cp_img_banner_path").val(imgn.attr("value"));
            //console.log(imgn);
            img.cropper({
                        aspectRatio: 16/9,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        zoomable: false,
                        crop: function(data) {
                            $("#icb_x").val(data.x);
                            $("#icb_y").val(data.y);
                            $("#icb_h").val(data.height);
                            $("#icb_w").val(data.width);
                        }
                        
            });
            
            $("#cp_banner_accept").prop("disabled",false).removeClass("disabled");
            
            $("#cp_banner_accept").on("click",function(){                
                //$("#user_image").html('<img src="../assets/images/loaders/default.gif"/>');
                $("#modal_change_photo").modal("hide");
                $("#cp_crop_banner").ajaxForm({target: '#cp_target_banner'}).submit();
                $("#cp_target_banner").html("Use o formulário abaixo para carregar o arquivo. Somente arquivos .jpg .");
                $("#cp_photo_banner").val("").parent("a").find("span").html("Select file");
                $("#cp_banner_accept").prop("disabled",true).addClass("disabled");
                $('#cidades').html('<option value="">-- Escolha um estado --</option>');                
                $('#estado').html('<option value="">-- Escolha um estado --</option>');                
                $("#cp_img_banner_path").val("");
                $('#cp_crop_banner').resetForm();
            });           
        }
    }
    
    $("#cp_photo_banner").on("change",function(){
        
        if($("#cp_photo_banner").val() == '') return false;
        
        $("#cp_target_banner").html('<img src="../assets/images/loaders/default.gif"/>');        
        $("#cp_upload_banner").ajaxForm({target: '#cp_target_banner',success: onSuccess}).submit();        
    });
    
    
});      