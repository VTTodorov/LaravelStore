$( document ).ready(function() {


    function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function (e) {

            $('#image-preview').attr('src', e.target.result);
            $('#image-preview').parent().addClass('panel-image img-thumbnail');

        }

        reader.readAsDataURL(input.files[0]);

    }

    }

    $("#image").on('change',function(){
        readURL(this);
    });

    // CKEDITOR.replace('ckbody');
});
