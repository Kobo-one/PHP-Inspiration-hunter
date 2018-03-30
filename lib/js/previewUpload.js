function filePreview(input){
    console.log('test');
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (e){
            $('#no_image').remove();
            $('#first_input').before('<img src="'+e.target.result+'" class="preview"/>');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
