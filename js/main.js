// A $( document ).ready() block.
$( document ).ready(function() {

//Add a class to menu
$( "a.nav-link").click(function() {
    $('a.nav-link').removeClass("active");
    $('button.nav-link-1').removeClass("active");
    $(this).addClass("active");
});
$( "button.nav-link-1").click(function() {
    $('button.nav-link-1').removeClass("active");
    $('a.nav-link').removeClass("active");
    $(this).addClass("active");
});
//Click on image and add class to menu
$( ".navbar-brand" ).click(function() {
    $('a.nav-link').removeClass("active");
    var ul=$('.navbar-nav');
    $(ul).children().children(":first").addClass("active");

});

// Active for the second menu
    //Add a class to menu
$( ".menu-item-responsive" ).click(function() {
$('.menu-item-responsive').removeClass("active");
$(this).addClass("active");
});

    });
