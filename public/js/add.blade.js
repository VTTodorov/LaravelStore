(function ($) {

})(jQuery);
$( document ).ready(function() {
    function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();



        reader.onload = function (e) {

            $('#image-preview').attr('src', e.target.result);
            $('#image-preview').parent().addClass('panel-image');

        }

        reader.readAsDataURL(input.files[0]);

    }

}
console.log($('#image').width());
$("#image").on('change',function(){
    console.log('test');
    readURL(this);

});
});
