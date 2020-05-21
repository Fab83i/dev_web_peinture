$(document).ready(function () {



    $('#btn1-out').hide();
    $('#btn2-out').hide();
    $('#btn3-out').hide();
    $('#btn4-out').hide();
    $('#btn5-out').hide();
    $('#btn6-out').hide();
  //  $('#overlay').hide();
    
    
    $('#bienvenue').hide();
    $('#accueil-part1').hide();
    $('#accueil-part2').hide();
    $('#accueil-part3').hide();
    $('#accueil-part4').hide();
    
    
    


    $('#btn1').mouseenter(function () {
        $('#btn1-in').hide();
        $('#btn1-out').show();
    });
    $('#btn1').mouseleave(function () {
        $('#btn1-in').show();
        $('#btn1-out').hide();
    });

    $('#btn2').mouseenter(function () {
        $('#btn2-in').hide();
        $('#btn2-out').show();
    });
    $('#btn2').mouseleave(function () {
        $('#btn2-in').show();
        $('#btn2-out').hide();
    });

    $('#btn3').mouseenter(function () {
        $('#btn3-in').hide();
        $('#btn3-out').show();
    });
    $('#btn3').mouseleave(function () {
        $('#btn3-in').show();
        $('#btn3-out').hide();
    });

    $('#btn4').mouseenter(function () {
        $('#btn4-in').hide();
        $('#btn4-out').show();
    });
    $('#btn4').mouseleave(function () {
        $('#btn4-in').show();
        $('#btn4-out').hide();
    });

    $('#btn5').mouseenter(function () {
        $('#btn5-in').hide();
        $('#btn5-out').show();
    });
    $('#btn5').mouseleave(function () {
        $('#btn5-in').show();
        $('#btn5-out').hide();
    });

    $('#btn6').mouseenter(function () {
        $('#btn6-in').hide();
        $('#btn6-out').show();
    });
    $('#btn6').mouseleave(function () {
        $('#btn6-in').show();
        $('#btn6-out').hide();
    });

 
    init = function () {

        $('#overlay').animate({backgroundPositionX:"+=750px"},3000, function () {
            $('#bienvenue').show(1000, function () {
                $('#accueil-part1').show(500, function () {
                    $('#accueil-part2').show(500, function () {
                        $('#accueil-part3').show(500, function () {
                            $('#accueil-part4').show(500);
                        });
                    });
                });
            });
        });




    };
    
   init();


    if(window.innerWidth < 768){
        $('#accueil').hide();
        $('#overlay').hide();
       
       }
    else if(window.innerWidth > 768){
        $('#accueil-smart').hide();
        $('#overlay-smart').hide();
    };

    let mainNav = document.getElementById("js-menu");
    let navBarToggle = document.getElementById("js-navbar-toggle");

    navBarToggle.addEventListener("click", function () {
        mainNav.classList.toggle("active");
    });

 $('[data-toggle="tooltip"]').tooltip();
    

});
