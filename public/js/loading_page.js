// Loading Page Style 1
$('.page-wrapper').hide();
$(window).on('load', function() { 
    $(".loading").fadeOut(500);
    $('.page-wrapper').fadeIn(500);
});
// End Loading Page Style 1

// Loading Page Style 2
/* $('.page-wrapper').hide();
$(window).on('load', function() { 
    // $("#loading-container").fadeOut(1000);
    // $('.page-wrapper').fadeIn(1000);
}); */
// End Loading Page Style 2