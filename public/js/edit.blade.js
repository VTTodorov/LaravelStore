$( document ).ready(function() {
    function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();



            reader.onload = function (e) {

                $('img[id=image-preview]').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);

        }

    }

    $("#image").on('change',function(){
        readURL(this);
    });

    let editor = CKEDITOR.replace('ckbody');

    $(".delete-picture").on('click','i',function (e) {
        let id = $(this).attr('id');
        $(this).next().val(id);
        $('#carousel-adv-images').carousel(0);
        $("[id="+ id +"]").css('display','none');
    });

});
