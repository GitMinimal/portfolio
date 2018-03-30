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


$('#logout').click (function (e) {
   e.preventDefault();
   setTimeout(function () {
       window.location.href = "../pages/logout.inc.php";
    }, 5000);
    $(".logout-background").css('visibility', 'visible');
    $(".logout_timer_page").css('visibility', 'visible');

    var count=5;

      var counter=setInterval(timer, 1000);

      function timer() {
        count=count-1;

        if (count <= 0) {
          clearInterval(counter);
          return;
}
document.getElementById("timer").innerHTML=count;
}
});
