$( document ).ready(function() {
    //removes html tags from description
    $('.card-text').each(function () {
        var doc = new DOMParser().parseFromString($(this).text(), 'text/html');
         $(this).text(doc.body.textContent || "");
    });
});
