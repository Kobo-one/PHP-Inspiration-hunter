function filePreview(input){
    
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (e){

            if($('#no_image').length){
            $('#no_image').remove();
            $('#first_input').before('<div class="" id="picDiv"><figure class=""><img src="'+e.target.result+'" class="preview"/></filter></div>');
            }
            else if($('.preview').length){
                $('.preview').attr('src',e.target.result);
            }

            if($('.edit_avatar').length){
                $('.edit_avatar').attr('src',e.target.result);
            }
                
        }
        reader.readAsDataURL(input.files[0]);
    }
}

