window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.position = "fixed";
    document.getElementById("navbar").style.top = "0px";
    document.getElementById("navbar").style.backgroundColor = "#4699b79e";
    document.getElementById("navbar").style.height = "75px";
    document.getElementById("navbar").style.zIndex = "999";
    document.getElementById("fady").style.height = "100px";
  } else {
    document.getElementById("navbar").style.position = "relative";
    document.getElementById("navbar").style.top = "0px";
    document.getElementById("navbar").style.backgroundColor = "#4699B7";
    document.getElementById("navbar").style.height = "123px";
    document.getElementById("fady").style.height = "0px";

  }
}
$('.owl1').owlCarousel({
  loop:false,
  margin:10,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
  responsive:{
      0:{
          items:1
      },
      600:{
          items:3
      },
      1000:{
          items:4
      }
  }
});

$(document).ready(function () {
    $('#editaccount').on('click', function () {
        $('.questime').addClass('questimenone');
    });
    $('.editaccount2').on('click', function () {
        $('.questime').removeClass('questimenone');
    });
    $('.editaccount3').on('click', function () {
        $('.questime').removeClass('questimenone');
    });
    $('.editaccount4').on('click', function () {
        $('.questime').removeClass('questimenone');
    });
});
/*********** doba code **************/
var base_url = $('#base_url').val();
$('.sub').click(function() {
    var token = $(this).data('token');
    var id = $(this).attr('ad');
    var comment = document.getElementById("comment_body").value;
    $.ajax({
        url: base_url + '/comment',
        type: 'post',
        data: '_token=' + token + '&comment=' + comment + '&adID=' + id,
        dataType: 'json',
        success:function(){
            Swal.fire({
                icon: 'success',
                title: 'تم التعليق بنجاح',
                timer: 2500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false
            });
            document.getElementById('comment_body').value='';
        },
        error:function(){
            Swal.fire({
                icon: 'error',
                title: 'حدث خطأ....',
                timer: 2500,
                timerProgressBar: true,
                showCancelButton: false,
                showConfirmButton: false
            });
        },
    });
});
/************** end doba *****************/
$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();
        $('#products .item').addClass('list-group-item');
        $('#products .item .group1').removeClass('list-group-item-heading2');
        $('#products .item .group2').removeClass('list-group-item2');
        $('#products .item img').addClass('imglist');
        $('#products .item .thumbnail').addClass('card2');
    });
    $('#grid').click(function(event){event.preventDefault();
        $('#products .item').removeClass('list-group-item');
        $('#products .item').addClass('grid-group-item');
        $('#products .item .group1').addClass('list-group-item-heading2');
        $('#products .item .group2').addClass('list-group-item2');
        $('#products .item img').removeClass('imglist');
        $('#products .item .thumbnail').removeClass('card2');
    });
    
});
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  var arr = document.querySelector('.arrowrote');
  arr.addEventListener('click', function(event) {
    event.target.classList.toggle('down');
  });
  
  
  var arr = document.querySelector('.arrowrote2');
  arr.addEventListener('click', function(event) {
    event.target.classList.toggle('down');
  });
  
  var arr = document.querySelector('.arrowrote3');
  arr.addEventListener('click', function(event) {
    event.target.classList.toggle('down');
  });
  
  var arr = document.querySelector('.arrowrote4');
  arr.addEventListener('click', function(event) {
    event.target.classList.toggle('down');
  });
//  doba js

  



  



