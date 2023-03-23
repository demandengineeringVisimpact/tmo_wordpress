
var ajaxurl ='https://sturdy-chimneysweep.localsite.io/wp-admin/admin-ajax.php';
$(document).ready(function() {

  $(window).scroll(function(){
    if ($(window).scrollTop() >= 100) {
        $('.site-header').addClass('fixed-header');
    }
    else {
        $('.site-header').removeClass('fixed-header');
    }
  });

  $('.testimonial-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    // autoplay: true,
    infinite: true,
    autoplaySpeed: 2000,
    arrows:false,
    dots:false,
    fade:true
  });

  $('body').on("click", "#submit", function(e){
    var fname = $('#firstName1').val();
    var lname = $('#lastName1').val();
    var company_name = $('#companyName1').val();
    var email = $('#emailId1').val();
    var phone = $('#phoneNumber1').val();
    jQuery.ajax({
      type: "post",
      url: ajaxurl,
      data: {'firstname':fname,'lastname':lname,'email':email,'phone':phone,'company_name':company_name,'action':'demo_schedule'},
      success: function(msg){
          const myObj = JSON.parse(msg);
          if(myObj.errortype == 'firstname'){
            $("#firstName").append("<span style='color:red;'>" + myObj.message + "</span>");return false;
          }
          if(myObj.errortype == 'lastname'){
            $("#lastName").append("<span style='color:red;'>" + myObj.message + "</span>");return false;
          }
          if(myObj.errortype == 'email'){
            $("#emailId").append("<span style='color:red;'>" + myObj.message + "</span>");return false;
          }
          if(myObj.errortype == 'success'){
            $("#success").append("<span style='color:green;'>" + myObj.message + "</span>");return false;
          }
      }
    });
  });

});










