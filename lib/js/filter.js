$('.button__filter').on('click', function () {
    var filterName= $(this).attr('id');
    $("#picDiv").addClass("preview");
    $("div img").removeClass("preview");
    $('figure').addClass(filterName);
});


