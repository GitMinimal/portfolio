$(".header-button-container").click(function() {
  $("#nav-open").css('left', '0');
  $(".shadow").css('visibility', 'visible');
});

$(".nav-close-button-wrapper").click(function() {
  $("#nav-open").css('left', '-300px');
  $(".shadow").css('visibility', 'hidden');
});

 $('.shadow').click(function() {
   $("#nav-open").css('left', '-300px');
   $(".shadow").css('visibility', 'hidden');
});

$(".nav-links ul li").mouseover(function () {
    $(".nav-slider").stop();
    var left = $(this).css('padding-left', '40px');
    var top = $(this).position().top;
    $(".nav-slider").animate({
        left: left,
        top: top,
    }, 250);
});
