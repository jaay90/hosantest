$("ul li:has(ul)").addClass("has-submenu");
$("ul li ul").addClass("sub-menu");

$(".nav-toggle").on("click", function() {
  $("#gnb").toggleClass("active");
  $(this).toggleClass("active");
});

$(".has-submenu > a").on("click", function(e) {
  e.preventDefault();
  $(this).toggleClass("active").next("ul").toggleClass("active");
});

//2depth
$(".gnb > ul > li").on("mouseenter click", function(e) {
  if ($(window).width() > "768" && e.type == "mouseenter") {
    $(".gnb > ul > li > ul").hide();
    $(this).children().next().show(500);
  } else if ($(window).width() <= "768" && e.type == "click") {
  }
});

$(".gnb > ul > li").on("mouseleave click", function(e) {
  if ($(window).width() > "768" && e.type == "mouseleave") {
    $(".gnb > ul > li > ul").hide();
  } else if ($(window).width() <= "768" && e.type == "click") {
    $(".gnb > ul > li > ul").hide();
    $(this).children().next().show();
  }
});

$(".gnb > ul > li > a").on("focusin click",function(e) {
  if ($(window).width() > "768" && e.type == "focusin") {
    $(".gnb > ul > li > ul").hide();
    $(this).next().show();
  } else if ($(window).width() <= "768" && e.type == "click") {
  }
});

//3depth
$(".gnb > ul > li > ul > li").on("mouseenter click", function(e) {
  if ($(window).width() > "768" && e.type == "mouseenter") {
    $(".gnb > ul > li > ul > li > ul").hide();
    $(this).children().next().show();
  } else if ($(window).width() <= "768" && e.type == "click") {
   }
});

$(".gnb > ul > li > ul > li").on("mouseleave click", function(e) {
  if ($(window).width() > "768" && e.type == "mouseleave") {
    $(".gnb > ul > li > ul > li > ul").hide();
  } else if ($(window).width() <= "768" && e.type == "click") {
     $(".gnb > ul > li > ul > li > ul").hide();
    $(this).children().next().show();
  }
});

$(".gnb > ul > li >  ul > li > a").on("focusin click",function(e) {
  if ($(window).width() > "768" && e.type == "focusin") {
    $(".gnb > ul > li > ul > li > ul").hide();
    $(this).next().show();
  } else if ($(window).width() <= "768" && e.type == "click") {
  }
});

$(window).resize(function() {
  if ($(window).width() > "768") {
       $(".gnb > ul > li > ul > li > ul").hide();
       $(".gnb > ul > li > ul").hide();
       $(".has-submenu > ul").removeClass("active");
       $("#gnb").removeClass("active");
       $(".has-submenu > a").removeClass("active");
       $(".nav-toggle").removeClass("active");
     } else if ($(window).width() <= "768") {
      
  }
});
