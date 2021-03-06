(function($) {
  "use strict"; // Start of use strict
  let site_url = $('.footer').attr('data-siteurl')+'/acc';

  $('.delete').on("click", function (e) {
    e.preventDefault();
    let choice = confirm($(this).attr('data-confirm'));
    if (choice) 
    {
        window.location.href = $(this).attr('href');
    }
  }); 

  $('.estimates_form_create').validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.form-control').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.form-control.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules:{
      quotation_number:"required",
      company_name:"required",
      quotation_date:"required",
      quotation_valid_date:"required",
      quotation_subject:"required",
      quotation_body:"required",
      client:"required"
    },
    messages:{
      quotation_number:"Please enter quotation number",
      company_name:"Please select company",
      quotation_date:"Please enter quotation date",
      quotation_valid_date:"Please enter quotation valid date",
      quotation_subject:"Please enter quotation subject",
      quotation_body:"Please enter quotation text",
      client:"Please select client"
    }
  });

 

  $("#admin_password").on("change paste keyup", function() {
     $('#ispasswordChanged').val('1');
  });

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  if ($(window).width() < 768) {
    $("body").addClass("sidebar-toggled");
    $(".sidebar").addClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
        $('.sidebar .collapse').collapse('hide');
      };
  }

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');

    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      let e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    let scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    let $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });


$(".user_add_form").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        full_name: {
            required: true,
        },
        email: {
            required: true,
            email: true,
            remote: {
               url: site_url+'admin/user/check_email_exists',
               type: "post",
               data: {
                   email: function () {
                       return $("#email").val();
                   }
               }
          }
        },
        password: {
            required: true,
            minlength: 10,  
        },
        position:{
          required : true,
        },
        status: {
          required: true
        }
    },
    messages: {
        full_name: {
            required: "Please enter full name"
        },
        email:{
          required:"Please enter email address",
          email:"Please enter valid email",
          remote: "{0} address already in use. Please use another email address"
        },
        password: {
          required: "Please enter password",
          minlength: "Please enter minimum 10 chars",
        },
        position:{
          required : "Please enter position"
        },
        status: {
          required: "Please select status"
        }
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});


$(".user_edit_form").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        full_name: {
            required: true,
        },
        email: {
            required: {
              depends: function(element) {
                return ($(element).val() !== $('#originalemail').val());
              }
            },
            email: true,
            remote: {
               url: site_url+'admin/user/check_email_exists',
               type: "post",
               data: {
                   email: function () {
                       return $("#email").val();
                   }
               },
               depends: function(element){
                  return ($(element).val() !== $('#originalemail').val());
               }
          },
        },
        password: {
            required: {
              depends: function(element) {
                if($(element).val() !== $('#old_password').val()){
                  $('#isPasswordchanged').val('1');
                }
                return ($(element).val() !== $('#old_password').val());
              },
            },
            minlength: 10,  

        },
        position:{
          required : true,
        },
        status: {
          required: true
        }
    },
    messages: {
        full_name: {
            required: "Please enter full name"
        },
        email:{
          required:"Please enter email address",
          email:"Please enter valid email",
          remote: "{0} address already in use. Please use another email address"
        },
        password: {
          required: "Please enter password",
          minlength: "Please enter minimum 10 chars",
        },
        position:{
          required : "Please enter position"
        },
        status: {
          required: "Please select status"
        }
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});

$(".admin_settings_form").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: {
              depends:function(element){
                  if($('#ispasswordChanged').val() == '1'){
                    return true;
                  }
              }
            },
            minlength: {
              depends:function(element){
                if($('#ispasswordChanged').val() == '1'){
                    return 5;
                }
              }
            }
        },

        confirm_password: {
         required: {
              depends:function(element){
                  if($('#ispasswordChanged').val() == '1'){
                    return true;
                  }
              }
            },
            minlength: {
              depends:function(element){
                if($('#ispasswordChanged').val() == '1'){
                    return 5;
                }
              }
            },
          equalTo: "#admin_password"
        },
    },
    messages: {
        email:{
          required:"Please enter email address",
          email:"Please enter valid email",
        },
        password: {
          required: "Please enter password",
          minlength: "Please enter minimum 5 chars",
        },
        confirm_password: {
                required: "Please provide a confirm password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
        },
        
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});


$(".company_form_create").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        company_name: {
            required: true,
        },
        company_email: {
            required: true,
            email: true,
        },
        company_address: {
            required: true,   
        },
        company_website:{
          required : true,
          url:true
        },
        company_contact:{
          required : true,
        },
        company_vat:{
          required:true,
          number:true
        },
        userfile:{
          required: true,
          extension: "jpg|png|gif"
        },
        status: {
          required: true
        },

    },
    messages: {
        company_name: {
            required: "Please enter name"
        },
        company_email:{
          required:"Please enter email address",
          email:"Please enter valid email",
        },
        company_address: {
          required: "Please enter address",
        },
        company_website:{
          required : "Please enter website url",
          url:"Please enter valid url"
        },
        company_vat:{
          required:"Please enter company VAT Number",
          number:"Please enter number only"
        },
        userfile:{
          required: "Please select image to upload",
          extension: "Please upload image with extension jpg,png,gif"
        },
        company_contact:{
          required : "Please enter contact number",
        },
        status: {
          required: "Please select status"
        }
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});

$(".company_form_update").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        company_name: {
            required: true,
        },
        company_email: {
            required: true,
            email: true,
        },
        company_address: {
            required: true,   
        },
        company_website:{
          required : true,
          url:true
        },
        company_vat:{
          required:true,
          number:true
        },
        company_contact:{
          required : true,
        },
        userfile:{
          depends:function(element){
            if($('#old_company_logo').val() == ''){
              return true;
            }
          }
        },
        status: {
          required: true
        }
    },
    messages: {
        company_name: {
            required: "Please enter name"
        },
        company_email:{
          required:"Please enter email address",
          email:"Please enter valid email",
        },
        company_address: {
          required: "Please enter address",
        },
        company_website:{
          required : "Please enter website url",
          url:"Please enter valid url"
        },
        userfile:{
          required: "Please select image to upload",
          extension: "Please upload image with extension jpg,png,gif"
        },
        company_contact:{
          required : "Please enter contact number",
        },
        company_vat:{
          required:"Please enter company VAT Number",
          number:"Please enter number only"
        },
        status: {
          required: "Please select status"
        }
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});

$(".client_from_create").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        client_name: {
            required: true,
        },
        client_address: {
            required: true,
        },
        client_email: {
            //required: true,
            email: true,
        },
        client_website: {
           // required: true,
            url: true,  
        },
        client_contact:{
          //required: true
        }
    },
    messages: {
        client_name: {
            required: "Please enter name"
        },
        client_address:{
          required :"Please enter address"
        },
        client_email:{
          //required:"Please enter email address",
          email:"Please enter valid email",
        },
        client_website: {
          //required: "Please enter website",
          minlength: "Please enter valid website",
        },
        client_contact:{
          required : "Please enter contact details"
        },
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});

$(".client_from_update").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        client_name: {
            required: true,
        },
        client_address: {
            required: true,
        },
        client_email: {
            //required: true,
            email: true,
        },
        client_website: {
           // required: true,
            url: true,  
        },
        client_contact:{
          //required: true
        }
    },
    messages: {
        client_name: {
            required: "Please enter name"
        },
        client_address:{
          required :"Please enter address"
        },
        client_email:{
          //required:"Please enter email address",
          email:"Please enter valid email",
        },
        client_website: {
          //required: "Please enter website",
          minlength: "Please enter valid website",
        },
        client_contact:{
          required : "Please enter contact details"
        },
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});

$(".items_form_create").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        item_name: {
            required: true,
        },
        item_specification: {
            required: true,
        },
        item_price:{
          required : true,
          currency:["$", false] // dollar sign optional
        },
        userfile:{
          extension: "jpg|png|gif"
        },
        item_status: {
          required: true
        },
        item_type:{
          required: true
        },
        item_brand: {
          required: {
            depends: function(element) {
                return $('#item_type').val() == 'product';
            }
          }
        },
        item_model: {
          required: {
            depends: function(element) {
                return $('#item_type').val() == 'product';
            }
          }
        },
    },
    messages: {
        item_name: {
            required: "Please enter name"
        },
        item_specification: {
          required: "Please enter specification",
        },
        item_price:{
          required : "Please enter price",
          currency:"Please enter valid amount"
        },
        userfile:{
          extension: "Please upload image with extension jpg,png,gif"
        },
        item_status: {
          required: "Please select status"
        },
        item_brand: {
          required: "Please enter item brand"
        },
        item_model: {
          required: "Please enter item model"
        },
        item_type:{
          required: "Please select item type"
        }
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});

$(".item_from_update").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        item_name: {
            required: true,
        },
        item_specification: {
            required: true,
        },
        item_price:{
          required : true,
          currency:["$", false] // dollar sign optional
        },
        userfile:{
          extension: "jpg|png|gif"
        },
        item_status: {
          required: true
        },
        item_type:{
          required: true
        },
        item_brand: {
          required: {
            depends: function(element) {
                return $('#item_type').val() == 'product';
            }
          }
        },
        item_model: {
          required: {
            depends: function(element) {
                return $('#item_type').val() == 'product';
            }
          }
        },
    },
    messages: {
        item_name: {
            required: "Please enter name"
        },
        item_specification: {
          required: "Please enter specification",
        },
        item_price:{
          required : "Please enter price",
          currency:"Please enter valid amount"
        },
        userfile:{
          extension: "Please upload image with extension jpg,png,gif"
        },
        item_status: {
          required: "Please select status"
        },
        item_brand: {
          required: "Please enter item brand"
        },
        item_model: {
          required: "Please enter item model"
        },
        item_type:{
          required: "Please select item type"
        }
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});

$(".reveal").on('click',function() {
    let $pwd = $("#pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});

if($('#date').length > 0){
  let today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
  let yesterday = new Date(today);
  yesterday.setDate(today.getDate() - 1); 

  $('#date').datepicker({
    uiLibrary: 'bootstrap4',
    minDate: yesterday,
    maxDate: today,
    format: 'yyyy-mm-dd', 
    showOtherMonths: false
  });  
}

if($('#from_date').length > 0){
  $('#from_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd', 
    showOtherMonths: true,
    showOnFocus: true, 
    showRightIcon: false,
    // maxDate: function () {
    //   return $('#to_date').val();
    // }
  });  
}
// if($('#join_date').length > 0){
//   $('#join_date').datepicker({
//     uiLibrary: 'bootstrap4',
//     format: 'yyyy-mm-dd', 
//     showOtherMonths: true,
//     showOnFocus: true, 
//     showRightIcon: false,
//   });    
// }

if($('#date_of_birth').length > 0){
  $('#date_of_birth').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd', 
    showOtherMonths: true,
    showOnFocus: true, 
    showRightIcon: false,
  });
}

if($('#to_date').length > 0){
  $('#to_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd', 
    showOtherMonths: true,
    showOnFocus: true, 
    showRightIcon: false,
    // minDate: function () {
    //   return $('#from_date').val();
    // }
  });  
}

if($('#quotation_date').length > 0){
  $('#quotation_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd', 
    showOtherMonths: true,
    showOnFocus: true, 
    showRightIcon: false,
  });
}

if($('#quotation_valid_date').length > 0){
  $('#quotation_valid_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd', 
    showOtherMonths: true,
    showOnFocus: true, 
    showRightIcon: false,
  });
}


$(".user_request_form").validate({
    errorClass: "error-class",
    validClass: "valid-class",
    errorElement: "div",
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    },
    onError : function(){
        $('.input-group.error-class').find('.help-block.form-error').each(function() {
          $(this).closest('.form-group').addClass('error-class').append($(this));
        });
    },
    rules: {
        date:{
          required:true,
          date:true
        },
        ticket_number:"required",
        start_reading:{
          required:true,
          number: true
        },
        end_reading:{
          required:true,
          number: true
        },
        from_address:"required",
        to_address:"required",
        purpose_of_visit:"required",
        client_username:"required",
        total_distance:{
          required:true,
        },
        status: {
          required: true
        }
    },
    messages: {
        date:{
          required:"Please enter date",
          date:"Please enter valid date"
        },
        ticket_number:"Please enter ticket number",
        start_reading:{
          required:"Please enter start reading",
          number: "Please enter number only"
        },
        end_reading:{
          required:"Please enter end reading",
          number: "Please enter number only"
        },
        from_address:"Please enter from address",
        to_address:"Please enter to address",
        purpose_of_visit:"Please enter purpose of visit",
        client_username:"Please enter client's username",
        total_distance:{
          required:"Please enter total total distance",
        },
        status: {
          required: "Please select status"
        }
    },
    highlight: function(element, errorClass) {
        $(element).removeClass(errorClass);
    }
});


$('.view_info').click(function(e){
  e.preventDefault();
  let target_url = $(this).attr('href');

  $.get(target_url, function(data, status){
    if(status == 'success'){
      $('.request-info').html(data);
    }
  });
});


//group add limit
let maxGroup = 30;
//add more fields group
$(".addMore").click(function(){
    if($('body').find('.qtyform').length < maxGroup){
        let fieldHTML = '<div class="form-group row qtyform">'+$(".qtyformCopy").html()+'</div>';
        $('body').find('.qtyform:last').after(fieldHTML);
        let l = $('.item:visible').length;
        $('.item:visible:last').attr('id', 'item-'+l);
        $('.item_desc:visible:last').attr('id', 'item_desc-'+l);
        $('.item_price:visible:last').attr('id', 'item_price-'+l);

        callAutocomplete(l);

        $('.qty').on('keyup', function() {
          update_amounts();
        });

        $('.item_price').on('keyup', function() {
            update_amounts();
        });

        $('.discount').on('keyup', function() {
            update_amounts();
        });

    }else{
        alert('Maximum '+maxGroup+' groups are allowed.');
    }
});



//remove fields group
$("body").on("click",".remove",function(){ 
    $(this).parents(".qtyform").remove();
     update_amounts();
});

callAutocomplete(1);

 update_amounts();

  $('.qty').on('keyup', function() {
      update_amounts();
  });

  $('.item_price').on('keyup', function() {
      update_amounts();
  });

  $('.discount').on('keyup', function() {
      update_amounts();
  });

})(jQuery); // End of use strict

function randomPassword(length) {
    let chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
    let pass = "";
    for (let x = 0; x < length; x++) {
        let i = Math.floor(Math.random() * chars.length);
        pass += chars.charAt(i);
    }
    return pass;
}

function generate() {
    userform.password.value = randomPassword(10);
}

function update_amounts(){
  // alert('here');return false;
    let sum = 0.0;
    let discount = 0.0;
    $('.qtyform').each(function() {
        let qty = $(this).find('.qty').val();
        let price = $(this).find('.item_price').val();
        let amount = (qty*price);
        sum+=amount;
        $(this).find('.item_total').val(''+amount);
    });
    //just update the total to sum  
    $('.sub-total').val(sum);
    discount = $('.discount').val();
    if(discount == '' || discount == 0){
      $('.grand_total').val(sum);
    }
    else{
      discount = sum * (discount / 100);
      $('.grand_total').val(sum - discount);
    }
}

function callAutocomplete(field_id){
  let site_url = $('.footer').attr('data-siteurl');
  //   $('#item-'+field_id).autocomplete({
  //     source : function(request, response) {
  //       $.ajax({
  //         //type: "GET",
  //         url : site_url+"admin/items/getItems",
  //         dataType : "json",
  //         cache: false,
  //         data : {
  //           q : request.term
  //         },
  //         success : function(data) {
  //          response(data)
  //         },
  //         error: function(jqXHR, textStatus, errorThrown) {
  //           console.log(textStatus+" "+errorThrown);
  //         }    
  //       });
  //     },
  //     minLength : 1
  // });

  $('#item-'+field_id).on( "autocompleteselect", function( event, ui ) {
    let item_id = ui.item.id;

    $('#item_id-'+field_id).val(item_id);

    $.ajax({
      type: "post",
      data:"item_id="+item_id,
      url:site_url+"admin/items/getItemDetails",
      success:function(data){
         let obj = jQuery.parseJSON(data);
         $('#item_desc-'+field_id).val(obj[0].item_desc);
         $('#item_price-'+field_id).val(obj[0].item_price);
          update_amounts();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus+" "+errorThrown);
      }
    })
  });
  $('.exampleModal').on('show.bs.modal', function (event) {
    let url = window.location.origin;
    let button = $(event.relatedTarget); 
    let recipient = button.data('whatever'); 
    console.log(recipient);
    let modal = $(this);
    modal.find('.modal-content img').attr('src',url+'/images/'+recipient);
  });
  // $('.targetModal').on('show.bs.modal', function (event) {
  //   let link = window.location.origin;
  //   let button = $(event.relatedTarget); 
  //   let target_id = button.data('whatever'); 
  //   console.log(target_id);
  //   $.ajax({
  //     url: link + '/user/get_each_target',
  //     type: 'post',
  //     data: {
  //       'id': target_id
  //     },
  //     success: function(response){
  //       let obj = JSON.parse(response);
  //       console.log(obj);
  //       $('.modal-body').append();
  //     }
  //   });
  // });

  $("#user_type").change(function(){
    let user_type = $(this).children("option:selected").val();
    if(user_type==3){
      $(".employee-section").show();
    
      let val = $('option:selected', '.department').attr('value');
      $.ajax({
        url: "get_designations",
        data:{
          'id': val
        },
        type: "post",
        success: function(data){
          let objects = JSON.parse(data);
          $.each( objects, function( key, value ){
            $('#designation').append("<option value="+value.id+">"+ value.designation +"</option>");
          });
        }
      });

    }
    else{
      $(".employee-section").hide();
    }
  });

  $("#department").change(function(){
    let val = $('option:selected', this).attr('value');
    
    $('#designation').empty();

    $.ajax({
      url: "get_designations",
      data:{
        'id': val
      },
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        $.each( objects, function( key, value ){
          $('#designation').append("<option value ="+value.id+">"+ value.designation +"</option>");
        });
      }
    });
  });

  $("#user_type-edit").change(function(){
    let user_type = $(this).children("option:selected").val();
    if(user_type==3){
      $(".employee-section").show();
      base_url = window.location.origin;
      let val = $('option:selected', '#department-edit').attr('value');
      $('#designation-edit').empty();
      $.ajax({
        url: site_url + "/user/get_designations",
        data:{
          'id': val
        },
        type: "post",
        success: function(data){
          let objects = JSON.parse(data);
          $(".designation-edit").show();
  
          let des_user = $("#des_user").val();
          $.each( objects, function( key, value ){
            if(des_user==value.id){
              $('#designation-edit').append("<option value ="+value.id+" selected>"+ value.designation +"</option>");
            }else{
              $('#designation-edit').append("<option value ="+value.id+">"+ value.designation +"</option>");            
            }
          });
        }
      });
    }
    else{
      $(".employee-section").hide();
    }
  });

  $("#department-edit").change(function(){
    base_url = window.location.origin;
    let val = $('option:selected', this).attr('value');
    $('#designation-edit').empty();
    $.ajax({
      url: site_url + "/user/get_designations",
      data:{
        'id': val
      },
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        let des_user = $("#des_user").val();
        $.each( objects, function( key, value ){
          if(des_user==value.id){
            $('#designation-edit').append("<option value ="+value.id+" selected>"+ value.designation +"</option>");
          }else{
            $('#designation-edit').append("<option value ="+value.id+">"+ value.designation +"</option>");            
          }
        });
      }
    });
  });
}

$(document).ready(function(){
  $(".other-form").hide();
  $(".sales-form").hide();
  let site_url = $('.footer').attr('data-siteurl');
  let user_type = $('#user_type').children("option:selected").val();

  if(user_type==3){
    $(".employee-section").show();
  }else{
    $(".employee-section").hide();
  }

  let user_type_edit = $("#user_type-edit").children("option:selected").val();
  if(user_type_edit==3){
    $(".employee-section").show();
    
    let dept = $("#department-edit").children("option:selected").val();
    let val = $('option:selected', this).attr('value');
    $.ajax({
      url: site_url + "/user/get_designations",
      data:{
        'id': dept
      },
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        $(".designation-edit").show();
        let des_user = $("#des_user").val();
        $.each( objects, function( key, value ){
          if(des_user==value.id){
            $('#designation-edit').append("<option value ="+value.id+" selected>"+ value.designation +"</option>");
          }else{
            $('#designation-edit').append("<option value ="+value.id+">"+ value.designation +"</option>");            
          }
        });
      }
    });
  }else{
    $(".employee-section").hide();
  }

  

  //add user type form validation
    
  base_url = window.location.origin;
  $('.add_role_form').validate({
    rules:{
        user_type : {
            required :  true,
            remote: {
              url: site_url+"/user/check_role",
              type: "post",
              data: {
                  user_type : function () {
                      return $("#user_type").val();
                  }
              }
            }
        }
    },
    messages:{
        user_type : {
          required : "Please Enter Role",
          remote   : "Role Already Exits"
        }
    },
    errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
    }
  });


  //add user form validation
  
  $('.add_user_form').validate({
    rules:{
        name              : "required",
        address           : "required",
        contact_person    : {
                            required :  true,
                            remote: {
                              url: site_url+"/user/check_user_phone",
                              type: "post",
                              data: {
                                  contact_person : function () {
                                      return $(".add_user_form #contact_person").val();
                                  }
                              }
                            }
        },
        contact_office    : "required",
        email             :  {
                              required :  true,
                              remote: {
                                url: site_url+"/user/check_user_email",
                                type: "post",
                                data: {
                                    email : function () {
                                        return $(".add_user_form #email").val();
                                    }
                                }
                              }
        },
        email_office      : "required",
        gender            : "required",
        date_of_birth     : "required",
        join_date         : "required",
        user_type         : "required",
        department        : "required",
        designation       : "required",
        allow_approve     : "required",
        municipality      : "required",
        ward_number       : "required",
        district          : "required",
        province          : "required",
        father_name       : "required",
        grand_father_name : "required",
        mother_name       : "required",
        married_status    : "required",
        guardian_name     : "required",
        guardian_relation : "required",
        last_degree       : "required",
        institution       : "required",
        edu_year          : "required",
        emp_code          : {
              required :  true,
              remote: {
                url: site_url+"/user/check_emp_code",
                type: "post",
                data: {
                    emp_code : function () {
                        return $(".add_user_form #emp_code").val();
                    }
                }
              }
        },
        citizenship_no    : "required",
        pan_no            : "required"
    },
    messages:{
        name              : "Please Enter Name",
        address           : "Please Enter Address",
        contact_person    :  {
          required : "Please provide your contact",
          remote   : "Personal Contact already exits"
        },
        contact_office    : "Please provide your office contact",
        email             : {
          required : "Please provide your email",
          remote   : "Personal email already exits"
        },
        email_office      : "Please Enter Office Email",
        date_of_birth     : "Please Enter Date of Birth",
        gender            : "Please select Your Gender",
        join_date         : "Please provide your join date",
        user_type         : "Please Select User Type",
        department        : "Please Select Department",
        designation       : "Please Select Designation",
        allow_approve     : "Please Select Allow Approve Option",
        municipality      : "Please Enter Municipality",
        ward_number       : "Please Enter Ward Number",
        district          : "Please Enter the District",
        province          : "Please Select Province Option",
        father_name       : "Please Enter Father's Name",
        grand_father_name : "Please Enter Grand Father's Name",
        mother_name       : "Please Enter Mother's Name",
        married_status    : "Please Select Married Status",
        guardian_name     : "Please Enter Guardian Name",
        guardian_relation : "Please Enter Relationship with Guardian",
        last_degree       : "Please Enter the last degree you achieved",
        institution       : "Please Enter the institution attended at last",
        edu_year          : "Please Enter the last year of education",
        emp_code          : {
                required  : "Please Enter Emp Code",
                remote    : "Emp Code Exists Already"
        },
        citizenship_no    : "Please Enter Citizenship Number",
        pan_no            : "Please Enter Pan Number"
    },
    errorPlacement: function(error, element) {
      if(element.attr("name") == "allow_approve") {
            error.insertAfter(element.siblings('label:first-child'));
      } else {
          error.insertAfter(element);
      }
    },
});


//update user form validation
  
$('.update_user_form').validate({
  rules:{
      name              : "required",
      address           : "required",
      contact_person    : {
              required :  true,
              remote   : {
                param: {
                  url: site_url+"/user/check_user_phone",
                  type: "post",
                  data: {
                      contact_person : function () {
                          return $(".update_user_form #contact_person").val();
                      }
                  }
                },
                depends: function(element){
                    return ($(element).val() !== $('.update_user_form #old_contact_person').val());
                }
              }
      },
      contact_office    : "required",
      email             :  {
                required :  true,
                remote   : {
                  param: {
                    url: site_url+"/user/check_user_email",
                    type: "post",
                    data: {
                        email : function () {
                            return $(".update_user_form #email").val();
                        }
                    }
                  },
                  depends: function(element){
                      return ($(element).val() !== $('.update_user_form #old_email').val());
                  }
                }
      },
      email_office      : "required",
      gender            : "required",
      password          : {
                              required  : true,
                              minlength : 8
                          },
      date_of_birth     : "required",
      user_type         : "required",
      department        : "required",
      designation       : "required",
      allow_approve     : "required", 
      municipality      : "required",
      ward_number       : "required",
      district          : "required",
      province          : "required",
      father_name       : "required",
      grand_father_name : "required",
      mother_name       : "required",
      married_status    : "required",
      guardian_name     : "required",
      guardian_relation : "required",
      last_degree       : "required",
      institution       : "required",
      edu_year          : "required",
      emp_code          : {
            required :  true,
            remote: {
              param : {
                url: site_url+"/user/check_emp_code",
                type: "post",
                data: {
                    emp_code : function () {
                        return $(".update_user_form #emp_code").val();
                    }
                }  
              },
              depends: function(element){
                  return ($(element).val() !== $('.update_user_form #old_emp_code').val());
              }
            }
      },
      citizenship_no    : "required",
      pan_no            : "required"
  },
  messages:{
      name              : "Please Enter Name",
      address           : "Please Enter Address",
      contact_person    :  {
        required : "Please provide your contact",
        remote   : "Personal Contact already exits"
      },
      contact_office    : "Please provide your office contact",
      email             : {
        required : "Please provide your email",
        remote   : "Personal email already exits"
      },
      email_office      : "Please Enter Office Email",
      gender            : "Please select Your Gender",
      password:{
          required: "Please enter password",
          minlength: "Password must contain at least 8 characters"
      },
      date_of_birth     : "Please provide your date of birth",
      user_type         : "Please Select User Type",
      department        : "Please Select Department",
      designation       : "Please Select Designation",
      allow_approve     : "Please Select Allow Approve Option",
      municipality      : "Please Enter Municipality",
      ward_number       : "Please Enter Ward Number",
      district          : "Please Enter the District",
      province          : "Please Select Province Option",
      father_name       : "Please Enter Father's Name",
      grand_father_name : "Please Enter Grand Father's Name",
      mother_name       : "Please Enter Mother's Name",
      married_status    : "Please Select Married Status",
      guardian_name     : "Please Enter Guardian Name",
      guardian_relation : "Please Enter Relationship with Guardian",
      last_degree       : "Please Enter the last degree you achieved",
      institution       : "Please Enter the institution attended at last",
      edu_year          : "Please Enter the last year of education",
      emp_code          : {
              required  : "Please Enter Emp Code",
              remote    : "Emp Code Exists Already"
      },
      citizenship_no    : "Please Enter Citizenship Number",
      pan_no            : "Please Enter Pan Number"
  },
  errorPlacement: function(error, element) {
    if(element.attr("name") == "allow_approve") {
      error.insertAfter(element.siblings('label:first-child'));
    } else {
        error.insertAfter(element);
    }
  },
});

  //add activity form validation
    
  $('.add_activity_form').validate({
    rules:{
        entry_date : "required",
        task_undertaken : "required",
        progress : "required",
        remarks  : "required"
    },
    messages:{
        entry_date : "Please choose Entry Date",
        task_undertaken : "Please Enter Task UnderTaken",
        progress : "Please Enter Progress",
        remarks  : "Please Enter Remarks"
    },
    errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
    }
  });

  //add target form validation
  $('.add_target_form').validate({
    rules:{
        assigned_to : 'required',
        title       : 'required'
    },
    messages:{
        assigned_to : 'Please Select Person',
        title       : 'Please Enter the Title'
    }
  });

  //add expenses form validation  
  $('.add_expenses_form').validate({
    rules:{
        eng_date              : 'required',
        nepali_date           : 'required',
        heading               : 'required',
        bill_invoice_no       : 'required',
        responsible_person    : 'required',
        to                    : 'required',
        amount                : 'required',
        remarks               : 'required',
        details               : 'required',
        image                 : 'required'
    },
    messages:{
        eng_date              : 'Please Select English Date',
        nepali_date           : 'Please Select Nepali Date',
        heading               : 'Please Enter Heading',
        bill_invoice_no       : 'Please Enter Bill Invoice Number',
        responsible_person    : 'Please Assign Responsible Person',
        to                    : 'Please Assign To Field',
        amount                : 'Please Enter Amount',
        remarks               : 'Please Enter Remarks',
        details               : 'Please Enter Details',
        image                 : 'Please Upload Image'
    }
  });
  
  //update expenses form validation  
  $('.update_expenses_form').validate({
    rules:{
        heading               : 'required',
        bill_invoice_no       : 'required',
        responsible_person    : 'required',
        to                    : 'required',
        amount                : 'required',
        remarks               : 'required',
        details               : 'required'
    },
    messages:{
        heading               : 'Please Enter Heading',
        bill_invoice_no       : 'Please Enter Bill Invoice Number',
        responsible_person    : 'Please Assign Responsible Person',
        to                    : 'Please Assign To Field',
        amount                : 'Please Enter Amount',
        remarks               : 'Please Enter Remarks',
        details               : 'Please Enter Details'
    }
  });
  
  
  //add income form validation  
  $('.add_income_form').validate({
    rules:{
        eng_date              : 'required',
        nepali_date           : 'required',
        heading               : 'required',
        bill_invoice_no       : 'required',
        responsible_person    : 'required',
        from                  : 'required',
        amount                : 'required',
        remarks               : 'required',
        details               : 'required',
        image                 : 'required'
    },
    messages:{
        eng_date              : 'Please Select English Date',
        nepali_date           : 'Please Select Nepali Date',
        heading               : 'Please Enter Heading',
        bill_invoice_no       : 'Please Enter Bill Invoice Number',
        responsible_person    : 'Please Assign Responsible Person',
        from                  : 'Please Assign From Field',
        amount                : 'Please Enter Amount',
        remarks               : 'Please Enter Remarks',
        details               : 'Please Enter Details',
        image                 : 'Please Upload Image'
    }
  });
  
  //update income form validation  
  $('.update_income_form').validate({
    rules:{
        heading               : 'required',
        bill_invoice_no       : 'required',
        responsible_person    : 'required',
        from                  : 'required',
        amount                : 'required',
        remarks               : 'required',
        details               : 'required'
    },
    messages:{
        heading               : 'Please Enter Heading',
        bill_invoice_no       : 'Please Enter Bill Invoice Number',
        responsible_person    : 'Please Assign Responsible Person',
        from                  : 'Please Assign From Field',
        amount                : 'Please Enter Amount',
        remarks               : 'Please Enter Remarks',
        details               : 'Please Enter Details'
    }
  });
  
  //add equity form validation  
  $('.add_equity_form').validate({
    rules:{
        eng_date              : 'required',
        nepali_date           : 'required',
        depositor             : 'required',
        status                : 'required',
        amount                : 'required',
        remarks               : 'required'
    },
    messages:{
        eng_date              : 'Please Select English Date',
        nepali_date           : 'Please Select Nepali Date',
        depositor             : 'Please Enter Heading',
        status                : 'Please Enter Bill Invoice Number',
        amount                : 'Please Enter Amount',
        remarks               : 'Please Enter Remarks'
    }
  });
  
  //update equity form validation  
  $('.update_equity_form').validate({
    rules:{
      depositor             : 'required',
      status                : 'required',
      amount                : 'required',
      remarks               : 'required'
    },
    messages:{
      depositor             : 'Please Enter Heading',
      status                : 'Please Enter Bill Invoice Number',
      amount                : 'Please Enter Amount',
      remarks               : 'Please Enter Remarks'
    }
  });

  //add bank account form validation  
  $('.add_bank_account_form').validate({
    rules:{
        bank_name             : 'required',
        account_type          : 'required',
        account_no            :  {
          required :  true,
          remote: {
            url: site_url+"/bankAccount/check_account_no",
            type: "post",
            data: {
                email : function () {
                    return $(".add_bank_account_form #account_no").val();
                }
            }
          }
        },
        closing_balance       : 'required'
    },
    messages:{
        bank_name              : 'Please Enter Bank Name',
        account_type           : 'Please Enter Account Type',
        account_no             :  {
          required  :  "Please Enter Account Number",
          remote    :  "Account Number Already Exists"
        },
        closing_balance        : 'Please Enter Closing Balance'
    }
  });
  
  //update equity form validation  
  $('.update_bank_account_form').validate({
    rules:{
      bank_name             : 'required',
      account_type          : 'required',
      account_no    : {
        required :  true,
        remote   : {
          param: {
            url: site_url+"/bankAccount/check_account_no",
            type: "post",
            data: {
                contact_person : function () {
                    return $(".update_bank_account_form #account_no").val();
                }
            }
          },
          depends: function(element){
              return ($(element).val() !== $('.update_bank_account_form #old_account_no').val());
          }
        }
    },
      closing_balance       : 'required'
    },
    messages:{
      bank_name              : 'Please Enter Bank Name',
      account_type           : 'Please Enter Account Type',
      account_no             :  {
        required  :  "Please Enter Account Number",
        remote    :  "Account Number Already Exists"
      },
      closing_balance        : 'Please Enter Closing Balance'
    }
  });
  
   //add contact form validation  
   $('.add_contact_form').validate({
    rules:{
        Name              : 'required',
        Company           : 'required',
        Designation       : 'required',
        Email             : 'required',
        mobile_number     : 'required',
        landline_number   : 'required',
        Address           : 'required',
        Purpose           : 'required',
        new_contact       : 'required',
        Status            : 'required',
        name_of_bus       : 'required',
        number_of_bus     : 'required',
        number_of_seat     : 'required',
        live_seat         : 'required'
    },
    messages:{
        Name              : 'Please Enter Name',
        Company           : 'Please Enter Company',
        Designation       : 'Please Enter Designation',
        Email             : 'Please Enter Email',
        mobile_number     : 'Please Enter Mobile Number',
        landline_number   : 'Please Enter LandLine Number',
        Address           : 'Please Enter Address',
        Purpose           : 'Please Select Purpose',
        new_contact       : 'Please Select New Contact Options',
        Status            : 'Please Select Status',
        name_of_bus       : 'Please Enter Name of Bus',
        number_of_bus     : 'Please Enter Number of Bus',
        number_of_seat    : 'Please Enter Number of Seats',
        live_seat         : 'Please Enter Live Seats'
    }
  });
 
    
   //update contact form validation  
   $('.update_contact_form').validate({
    rules:{
        new_contact       : 'required',
        Status            : 'required',
        number_of_bus     : 'required',
        number_of_seat    : 'required',
        live_seat         : 'required'
    },
    messages:{
        new_contact       : 'Please Select New Contact Options',
        Status            : 'Please Select Status',
        number_of_bus     : 'Please Enter Number of Bus',
        number_of_seat    : 'Please Enter Number of Seats',
        live_seat         : 'Please Enter Live Seats'
    }
  });

  //add fiscal year form validation  
  $('.add_fiscal_year_form').validate({
  rules:{
      fiscal_year       : 'required',
      current_fy        : 'required'
  },
  messages:{
      fiscal_year       : 'Please Enter Fiscal Year',
      current_fy        : 'Please Select Current Fiscal Year Options'
  },
  errorPlacement: function(error,element){
    if(element.attr("name")=='current_fy'){
      error.insertAfter(element.parent());
    }else{
      error.insertAfter(element);
    }
  }
});

//add employee record form validation  
$('.add_employee_record').validate({
  rules:{
      fy_id                  :  {
              required :  true,
              remote: {
                url: site_url+"/user/check_fiscal_year",
                type: "post",
                data: {
                    id : function () {
                        return $(".add_employee_record #fy_id").val();
                    },
                    emp_code : function(){
                      return $(".add_employee_record #emp_code").val();
                    }
                }
              }
      },
      total_monthly          : 'required',
      basic_salary           : 'required',
      food                   : 'required',
      house_rent             : 'required',
      conveyance             : 'required',
      other                  : 'required',
      annual_leave_permitted : 'required',
      annual_company_leave   : 'required',
      holidays               : 'required'
  },
  messages:{
      fy_id                  : {
                required  : "Please Select Fiscal Year",
                remote    : "Fiscal year Exists Already"
      },
      total_monthly          : 'Please Enter Total Monthly Salary',
      basic_salary           : 'Please Enter Basic Salary',
      food                   : 'Please Enter Food Allowance',
      house_rent             : 'Please Enter House Rent Allowance',
      conveyance             : 'Please Enter Conveyance Allowance',
      other                  : 'Please Enter Other Allowance',
      annual_leave_permitted : 'Please Enter Annual leave Permitted',
      annual_company_leave   : 'Please Enter Company leave',
      holidays               : 'Please Enter Holidays'
  }
});


//update employee record form validation  
$('.update_employee_record').validate({
  rules:{
      fy_id                  :  {
              required :  true,
              remote: {
                param: {
                  url: site_url+"/user/check_fiscal_year",
                  type: "post",
                  data: {
                      id : function () {
                          return $(".update_employee_record #fy_id").val();
                      },
                      emp_code : function(){
                        return $(".update_employee_record #emp_code").val();
                      }
                  }
                },
                depends : function(element){
                  return ($(element).val() !== $('.update_employee_record #old_fy_id').val());
                }
              }
      },
      total_monthly          : 'required',
      basic_salary           : 'required',
      food                   : 'required',
      house_rent             : 'required',
      conveyance             : 'required',
      other                  : 'required',
      annual_leave_permitted : 'required',
      annual_company_leave   : 'required',
      holidays               : 'required'
  },
  messages:{
      fy_id                  : {
                required  : "Please Select Fiscal Year",
                remote    : "Fiscal year Exists Already"
      },
      total_monthly          : 'Please Enter Total Monthly Salary',
      basic_salary           : 'Please Enter Basic Salary',
      food                   : 'Please Enter Food Allowance',
      house_rent             : 'Please Enter House Rent Allowance',
      conveyance             : 'Please Enter Conveyance Allowance',
      other                  : 'Please Enter Other Allowance',
      annual_leave_permitted : 'Please Enter Annual leave Permitted',
      annual_company_leave   : 'Please Enter Company leave',
      holidays               : 'Please Enter Holidays'
  }
});



  // if($(".add_target_form #assigned_to").length >= 1){
  //   site_url = window.location.origin;
  //   $.ajax({
  //     url: site_url + "/user/get_all_management_role",
  //     type: 'post',
  //     success: function(response){
  //       let objects = JSON.parse(response);
  //       console.log(objects);
  //       $.each(objects, function( key, value ){
  //           $('#assigned_to').append("<option value ="+value.id+">"+ value.name +"</option>");
  //       });
  //     }
  //   });
  // }

let slider = document.querySelector('.drag-scroll');
let isDown = false;
let startX;
let scrollLeft;

if(slider!=null){
    slider.addEventListener('mousedown', (e) => {
      isDown = true;
      startX = e.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => {
      isDown = false;
    });
    slider.addEventListener('mouseup', () => {
      isDown = false;
    });
    slider.addEventListener('mousemove', (e) => {
      if(!isDown) return;
      e.preventDefault();
      const x = e.pageX - slider.offsetLeft;
      const walk = (x - startX) * 1; //scroll-fast
      slider.scrollLeft = scrollLeft - walk;    
  });
}

if($('.drag-scroll').length>0){
  var dragScroll_distance = $('.drag-scroll').offset().top-50,
  $window = $(window);
  
  $window.scroll(function() {
      if ( $window.scrollTop() >= dragScroll_distance && $(window).width() < 768 && sessionStorage.getItem("swipe_loader_status")!="true") {
          $('.swipe-loader').css('display','block');
          sessionStorage.setItem("swipe_loader_status", "true");
          setInterval(function() { 
            $('.swipe-loader').css('display','none');
          }, 2000);
      }
  });
}


    //-------------
  //- LINE CHART -
  //--------------

  if($('#lineChart').length){
        
    var lineChartOptions = {
      maintainAspectRatio : true,
      responsive : true,
      legend: {
        display: true,
        labels: {
            fontSize: 20,
        }
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          },
          scaleLabel: {
            display: false,
            labelString: 'Time'
          },
        }],
        yAxes: [{
          gridLines : {
            display : true,
          },
          scaleLabel: {
            display: false,
            labelString: 'Amount'
          }
        }]
      }
    }

    
    var lineChartData = {
      datasets: [
        {
          label               : 'Income',
          backgroundColor     : 'rgba(60,100,255,0.9)',
          borderColor         : 'rgba(60,100,255,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)'
        },
        {
          label               : 'Expense',
          backgroundColor     : 'rgba(255, 0, 0, 0.9)',
          borderColor         : 'rgba(255, 0, 0, 0.8)',
          pointDotRadius      :  1,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)'
        },
      ]
    }

    var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
    lineChartOptions = $.extend(true, {}, lineChartOptions);
    lineChartData = $.extend(true, {}, lineChartData);
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false;
    var total_income_current_year = '';
    var total_expense_current_year = '';
    var total_equity_current_year = '';
    var total_income_total_year = '';
    var total_expense_total_year = '';
    var total_equity_total_year = '';
    var labels_monthly = [];
    var labels_yearly = [];
    var income_data_monthly = [];
    var income_data_yearly = [];
    var expense_data_monthly = [];
    var expense_data_yearly = [];

    var formatter = new Intl.NumberFormat('en-IN', { 
      minimumFractionDigits: 2
    }); 

    //get current year income expense equity
    $.ajax({
      url: "get_current_year_income_expense_equity",
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        total_income_current_year   = formatter.format(objects.income);
        total_expense_current_year  = formatter.format(objects.expense);
        total_equity_current_year   = formatter.format(objects.equity);
        
        $('#total_income').html('Rs. '+total_income_current_year);
        $('#total_expense').html('Rs. '+total_expense_current_year);
        $('#total_equity').html('Rs. '+total_equity_current_year);
      }
    });

    //get total year income equity
    $.ajax({
      url: "get_total_year_income_expense_equity",
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        total_income_total_year   =  formatter.format(objects.income);
        total_expense_total_year  =  formatter.format(objects.expense);
        total_equity_total_year   =  formatter.format(objects.equity);
      }
    });


    //get data for monthly line chart
    $.ajax({
      url: "get_monthly_income_expense_combined",
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        let count_income = Object.keys(objects['income']).length;
        let count_expense = Object.keys(objects['expense']).length;

        if(count_income > count_expense){
          for(x in objects["income"]){
            labels_monthly.push(objects["income"][x].month);
          }
        }else{
          for(x in objects["expense"]){
            labels_monthly.push(objects["expense"][x].month);
          }
        }

        for(x in objects["income"]){
          income_data_monthly.push(objects["income"][x].amount);
        }

        for(x in objects["expense"]){
          expense_data_monthly.push(objects["expense"][x].amount);
        }

        lineChartData.labels = labels_monthly;
        lineChartData.datasets[0].data = income_data_monthly;
        lineChartData.datasets[1].data = expense_data_monthly;

        let lineChart = new Chart(lineChartCanvas, {
          type: 'line',
          data: lineChartData,
          options: lineChartOptions
        });
      }
    });

    // get data for yearly line chart
    $.ajax({
      url: "get_yearly_income_expense_combined",
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);

        for(x in objects["year"]){
          labels_yearly.push(objects["year"][x]);
        }

        for(x in objects["yearly_income"]){
          income_data_yearly.push(objects["yearly_income"][x]);
        }

        for(x in objects["yearly_expense"]){
          expense_data_yearly.push(objects["yearly_expense"][x]);
        }
      }
    });
  }
  
  $('#line-chart-type').on('change', function() {
    if(this.value=="Monthly"){
      $('#chart-title').html("Income Vs Expense (Monthly)");
      lineChartData.labels = labels_monthly;
      lineChartData.datasets[0].data = income_data_monthly;
      lineChartData.datasets[1].data = expense_data_monthly;

      let lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      });
      
      $('#total_income').html('Rs. '+total_income_current_year);
      $('#total_expense').html('Rs. '+total_expense_current_year);
      $('#total_equity').html('Rs. '+total_equity_current_year);
    }
    else if(this.value=="Yearly"){
      $('#chart-title').html("Income Vs Expense (Yearly)");              
      lineChartData.labels = labels_yearly;
      lineChartData.datasets[0].data = income_data_yearly;
      lineChartData.datasets[1].data = expense_data_yearly;

      let lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      });
      
      $('#total_income').html('Rs. '+total_income_total_year);
      $('#total_expense').html('Rs. '+total_expense_total_year);
      $('#total_equity').html('Rs. '+total_equity_total_year);
    }
  });

  
  if($('#barChart').length){
    //-------------
    //- BAR CHART -
    //-------------
    let barChartData = {
      datasets: [
        {
          label               : 'Target',
          backgroundColor     : '#0C9F5F',
          borderColor         : '#0C9F5F',
          pointRadius         :  false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)'
        },
        {
          label               : 'Performance',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         :  false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)'
        },
      ]
    }
    
    let barChartCanvas = $('#barChart').get(0).getContext('2d')
    barChartData = $.extend(true, {}, barChartData)
    let bar_labels = [];
    let bar_performance = [];
    let bar_target = [];

    let barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    performance_barChart();

    $('#employee_chart').on('change', function() { 
       performance_barChart();
    });
    
    function performance_barChart(){
      $.ajax({
        url: 'calculate_performance',
        type: 'post',
        data:{
          'user_id' : $('#employee_chart').val()
        },
        success: function(response){
          let obj = JSON.parse(response);
          if(obj != false){
            for(x in obj['performance']){
              let label = x;
              //change underscore to space
              label = label.replace('_',' ');

              //change to sentence case
              let sentence = label.toLowerCase().split(" ");

              for(let i = 0; i< sentence.length; i++){
                sentence[i] = sentence[i][0].toUpperCase() + sentence[i].slice(1);
              }

              label = sentence.join(" ");
              if(x=="new_contact"){
                bar_labels[0] = label;
              }else if(x=="follow_up"){
                bar_labels[1] = label;
              }else if(x=="contract_signed"){
                bar_labels[2] = label;
              }else if(x == "live"){
                bar_labels[3] = label;
              }
          }

          for(x in obj['performance']){
            if(x=="new_contact"){
              bar_performance[0] = obj['performance'][x];
            }else if(x=="follow_up"){
              bar_performance[1] = obj['performance'][x];
            }else if(x=="contract_signed"){
              bar_performance[2] = obj['performance'][x];
            }else if(x=="live"){
              bar_performance[3] = obj['performance'][x];
            }
          }

          for(x in obj['target']){
            if(x=="new_contact_target"){
              bar_target[0] = obj['target'][x];
            }else if(x=="follow_up_target"){
              bar_target[1] = obj['target'][x];
            }else if(x=="new_contract_target"){
              bar_target[2] = obj['target'][x];
            }else if(x=="new_live_target"){
              bar_target[3] = obj['target'][x];
            }
          }

          barChartData.labels = bar_labels;
          barChartData.datasets[0].data = bar_target;
          barChartData.datasets[1].data = bar_performance;

          let total_achievement = obj['total']
          let comment = '';
          let color = '';
          $('#total_achievement').html(total_achievement.toFixed(2)+' %');

          if(total_achievement < 50){
            comment = 'You have Failed';
            color = 'red';
          }else if(total_achievement<=60){
            comment = 'Performance : Under Par';
            color = 'brown';
          }else if(total_achievement<=75){
            comment = 'Performance : Average';
            color = 'orange';
          }else if(total_achievement<=85){
            comment = 'Performance : Moderate';
            color = 'blue';
          }else if(total_achievement<=90){
            comment = 'Performance : Good';
            color = 'lightgreen';
          }else if(total_achievement<=100){
            comment = 'Performance : Excellent';
            color = 'green';
          }else{
            comment = 'Undefined';
            color = 'grey';
          }

          $('#achievement_comment').html(comment);
          $('#achievement_comment').css({'color': color, 'font-size': '20px','font-weight':'bold'});

          }
          else{
           
            barChartData.labels = bar_labels;
            barChartData.datasets[0].data = 0;
            barChartData.datasets[1].data = 0;
            $('#total_achievement').html('0 %');
            comment = 'Target Not Assigned';
            $('#achievement_comment').html(comment);
            $('#achievement_comment').css({'color': color, 'font-size': '20px','font-weight':'bold'});
          }
          
          let barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
          })
        }
      });  
    }
  }
    $(document).on("click", "a.add" , function(e) {
      e.preventDefault();
      tableBody = $("table tbody"); 
      tableBody.append('<tr><td><input type="number"  name="tax[]"></td>'+
      '<td><select name="marital_status[]">'+
      '<option value="1">Married</option>'+
      '<option value="0">Unmarried</option>'+
      '</select></td>'+
      '<td><input type="number"  name="amount[]"></td>'+
      '<td>'+
          '<a href="javascript:void(0);" class="add"><i class="fa fa-plus"></i></a>'+
          '<a href="javascript:void(0);" class="remove" data-confirm="Are you sure to delete this item?" style="display:inline-block"><i class="fa fa-times"></i></a>'+
      '</td>'+
      '</tr>');
      //add input box
    });
    
    $(document).on("click", "a.remove" , function(e) { //user click on remove text
      e.preventDefault();
        $(this).closest('tr').remove();
    });
    
    $('#basic_salary ,#house_rent, #food, #conveyance,#other').keyup(function(e){
        let basic_salary = parseInt($('#basic_salary').val());
        let house_rent   = parseInt($('#house_rent').val());
        let food         = parseInt($('#food').val());
        let conveyance   = parseInt($('#conveyance').val());
        let other        = parseInt($('#other').val());
        let total        = basic_salary+house_rent+food+conveyance+other;

        $('#total_monthly, #total_monthly_disabled').val(total);
    });

    $('#annual_company_leave,#holidays').keyup(function(e){
      let annual_company_leave = parseInt($('#annual_company_leave').val());
      let holidays             = parseInt($('#holidays').val());
      let total                = annual_company_leave+holidays;

      $('#annual_leave_permitted,#annual_leave_permitted_disabled').val(total);
    });

    if($('#fy_id_view').length>0){
      change_emp_record();
      function change_emp_record(){
        $.ajax({
          url: site_url+'user/get_employee_record',
          type: 'post',
          data: {
            'emp_code' :  $('#emp_code').val(),
            'fy_id'    :  $('#fy_id_view').val()
          },
          success : function(response){
            let obj = JSON.parse(response);
            $('#total_monthly').html(obj[0].total_monthly);
            $('#basic_salary').html(obj[0].basic_salary);
            $('#house_rent').html(obj[0].house_rent);
            $('#food').html(obj[0].food);
            $('#conveyance').html(obj[0].conveyance);
            $('#other').html(obj[0].other);
            $('#leave_permitted').html(obj[0].annual_leave_permitted);
            $('#company_leave').html(obj[0].annual_company_leave);
            $('#holidays').html(obj[0].holidays);
            $('#resigned_on').html(obj[0].resigned_on);
            $('#terminated_on').html(obj[0].terminated_on);
            $('#increment_details').html(obj[0].increment_details);
            $('#promotion_details').html(obj[0].promotion_details);
            $('#edit_employee_record').attr('href',site_url+'user/edit_employee_record/'+$('#emp_id').val()+'/'+obj[0].id);
            $('#delete_employee_record').attr('href',site_url+'user/delete_employee_record/'+$('#emp_id').val()+'/'+obj[0].id);
          }
        });
      }
      $('#fy_id_view').change(function(){
        change_emp_record();
      });
    }

    $('#fiscal_years').change(function(){
      $('table tbody').empty();
      let val = $('option:selected', this).attr('value');
      $.ajax({
        type: 'post',
        data: {
          'id' : val
        },
        url : 'get_tax_structure',
        success : function(response){
          let obj = JSON.parse(response);
          let unmarried = '';
          let married = '';
          tableBody = $("table tbody");
          for(x in obj){
            if(obj[x]['marital_status'] == 0)
            {
              unmarried = "selected='selected'";
              married ='';  
            }
            else if(obj[x]['marital_status'] == 1)
            {
              married = "selected='selected'";
              unmarried = '';
            }
            tableBody.append('<tr><td><input type ="number" name=tax[] value ='+ obj[x]['tax_percent']  +'></td>'+ 
            '<td><select name="marital_status[]">'+
            '<option value="1" '+ married +'>Married</option>'+
            '<option value="0" '+ unmarried +' >Unmarried</option>'+
            '</select></td>'+
            '<td><input type ="number" name=amount[] value ='+ obj[x]['amount'] +'></td>'+
            '<td>'+
                '<a href="javascript:void(0);" class="add"><i class="fa fa-plus"></i></a>'+
                '<a href="javascript:void(0);" class="remove delete" data-confirm="Are you sure to delete this item?" style="display:inline-block"><i class="fa fa-times"></i></a>'+
            '</td>'+
            '</tr>');
          }   
        }
      });
    });

    if($('.salary-sheet').length>0){
      var employee_data = [];
      function employee_change(){
        $('.pan-no').empty();
        $('.emp-code').empty();
        $('.marital-status').empty();
        $('.salary-breakup1').empty();
        $.ajax({
          url: 'get_employee_info',
          type: 'post',
          data: {
            'id' :  $('#employee option:selected').attr('value')
          },
          success : function(response){
            let obj = JSON.parse(response);
            employee_data = obj;
            if(obj[0]['marital_status'] == 0)
              {
                marital_status = 'Unmarried';
              }
              else if(obj[0]['marital_status'] == 1)
              {
               marital_status = 'Married'
              }
            if(obj.length > 0){
              $('.salary-sheet #fiscal_year').empty();
              $.each( obj, function( key, value ){
                $('.salary-sheet #fiscal_year').append("<option value="+obj[key]['fiscal_id']+">"+ obj[key]['fiscal_year'] +"</option>");
              });
              $('.pan-no').append(
                '<label>Pan Number</label>'+
                '<input type="text" name="pan_no" class ="form-control" value ='+obj[0]['pan_no']+' readonly>'+
                '</input>'
              );
              $('.emp-code').append(
                '<label>Employee Code</label>'+
                '<input type="text" name="emp_code" class ="form-control" value ='+obj[0]['emp_code']+' readonly >'+
                '</input>'
              );
              $('.marital-status').append(
                '<label>Marital Status</label>'+
                '<input type="text" name="marital_status" id="marital_status" class ="form-control" value ='+marital_status+' readonly>'+
                '</input>'
                );
                $('.salary-breakup1').append(
                  '<div class="form-group col-sm-12 d-inline-block">'+
                      '<h3>Salary Breakup</h3><br>'+
                      '<label>Basic Salary</label><input type = "number" class ="basic_salary form-control" name="basic_salary" id="basic_salary" value ='+obj[0]['basic_salary']+' readonly>'+
                      '<label>House Rent</label><input type = "number" class ="house_rent form-control" name="house_rent" id="house_rent" value ='+ obj[0]['house_rent']+' readonly>'+
                      '<label>Food Allowance</label><input type = "number" class ="food form-control" name ="food" id="food" value ='+obj[0]['food']+' readonly><br>'+
                      '<label>Conveyance Allowance</label><input type = "number" class ="conveyance form-control" name="conveyance" id="conveyance" value ='+obj[0]['conveyance']+' readonly>'+
                      '<label>Other Allowance</label><input type = "number" class ="other form-control" name="other" id="other" value ='+obj[0]['other']+' readonly>'+
                      '<label>Monthly Total</label><input type = "number" class ="total_monthly form-control" name ="monthly_total" id="monthly_total" value ='+obj[0]['total_monthly']+' readonly>'+
                  '</div>'
                );
                $('.taxable_for_month').attr('value',obj[0]['total_monthly']);
                $.ajax({
                  url: 'get_comparison_for_tax',
                  data:{
                    'id' :  $('.salary-sheet #fiscal_year option:selected').attr('value'),
                    'marital_status': obj[0]['marital_status']
                  },
                  type: 'post',
                  success: function (response){
                    let object = JSON.parse(response);
                    $('.salary-breakup1').append(
      
                          '<input type = "hidden" class =" form-control" name ="tax_compare" id="tax_compare" value ='+object['amount']+' readonly>'
                    );
                  }
                });
            }      
          }
        });
      }
      $('#employee').change(employee_change);
  
      $('#fiscal_year').change(function(){
        let fy = this.value;
        $.each(employee_data, function( key, value ){
            if(value.fiscal_id==fy){
              $(".total_monthly").val(value.total_monthly);
              $(".basic_salary").val(value.basic_salary);
              $(".house_rent").val(value.house_rent);
              $(".food").val(value.food);
              $(".conveyance").val(value.conveyance);
              $(".other").val(value.other);
              $(".monthly_total").val(value.total_monthly);
            }
        });
        $.ajax({
          url: 'get_comparison_for_tax',
          data:{
            'id' :  fy,
            'marital_status':  $("#marital_status").val()
          },
          type: 'post',
          success: function (response){
            let object = JSON.parse(response);
            $('.salary-breakup1').append(

                  '<input type = "hidden" class =" form-control" name ="tax_compare" id="tax_compare" value ='+object['amount']+' readonly>'
            );
          }
        });
        calculate_tax_salary();
      });
  
      $(".annual-deduction input").keyup(calculate_tax_salary);
      $(".annual-deduction-edit input").keyup(calculate_tax_salary);
      function calculate_tax_salary(){
        var monthly_salary = $(".total_monthly").val();
        var tax_compare = parseInt($("#tax_compare"). val());

        if($("#fiscal_year").val()!=''){
          $.fn.calculate = function () {
            let insurance = $(".insurance"). val();
            let pf = $(".pf").val();
            let cit = $(".cit").val();
            let ss  = $(".ss"). val();
            let pa = $('.pa').val();
            let wd = $('.wd').val();
            let ul = $('.ul').val();
            let total_months = $(".total_months").val();
            let gross_monthly = parseInt(total_months)*parseInt(monthly_salary);
            var deductions = (parseInt(monthly_salary)/parseInt(wd))*(parseInt(ul)) + parseInt(pa);
            $('.deductions').attr('value',deductions);
            if(gross_monthly > tax_compare){
              var total =  parseInt(insurance) +  parseInt(pf) +  parseInt(cit) +  parseInt(ss); 
              taxable_for_month = parseInt(monthly_salary)-parseInt(total);
              var annual_taxable = parseInt(gross_monthly)- parseInt(total)*12;
            }
            else{
              $('.te').attr('value',0);
              taxable_for_month = parseInt(monthly_salary);
              var annual_taxable = parseInt(gross_monthly);
            }
            
            $('.annual_taxable').attr('value',annual_taxable);
            $('.te').attr('value',total);
            $('.taxable_for_month').attr('value',taxable_for_month);
          };
          
          $.fn.calculate();
          $.ajax({
            url: site_url +'salary/get_tax_amount_yearly',
            type: 'post',
            data : $('.salary-sheet').serialize(),
            success: function(response){
              let obj = JSON.parse(response);
              let deduction = $('.deductions').val();
              let total_payable = parseInt(monthly_salary) - parseInt(deduction) - obj;
              $('.total_payable').attr('value',total_payable);
            }
          });
        }   
      }
    }
  

    if($('#print_salary').length>0){
      $('#print_salary').on('click',function(){
        let to_be_printed = [];
        $('input[name="print"]:checked').each(function() {
          to_be_printed.push(this.value);
        });
       
        if(to_be_printed.length>0){
          location.href = site_url+'salary/get_salary_details_by_id?id='+to_be_printed;
        }
      });
    }

    $("#sales-marketing").on('click',function(){
      $(".sales-form").show();
      $(".other-form").hide();
    });
    $("#other").on('click',function(){
      $(".sales-form").hide();
      $(".other-form").show();
    });
    
    $image_crop = $('#image_demo').croppie({
          enableExif: true,
          viewport: {
          width:200,
          height:200,
          type:'square' //circle
          },
          boundary:{
          width:300,
          height:300
          }
      });

      $('#upload_image').on('change', function(){
          var reader = new FileReader();
          reader.onload = function (event) {
          $image_crop.croppie('bind', {
              url: event.target.result
          }).then(function(){
              console.log('jQuery bind complete');
          });
          }
          reader.readAsDataURL(this.files[0]);
          $('#uploadimageModal').modal('show');
      });

      $('.crop_image').click(function(event){
          $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
          }).then(function(response){
              $.ajax({
                  url: site_url+"user/upload_profile_pic",
                  type: "POST",
                  data:{"image": response},
                  success:function(data)
                  {
                    $('#uploadimageModal').modal('hide');
                    let html = "<img src='"+response+"'>";
                    $('#uploaded_image').html(html); 
                    $('#profile_pic').val(data);
                  }
              });
          });
      });

      if($('#profile_pic').val() != ''){
        let html = "<img src='"+site_url+"images/profile_pic/"+$('#profile_pic').val()+"'>";
        $('#uploaded_image').html(html); 
      }

      if($('#total_income').length > 0){
        $('.income_table tbody').on( 'click', 'tr', function () {
          let amount = 0;
          $('.income_table tbody tr.selected td:nth-child(8)').each(function(i,obj){
            amount += parseFloat($(this).html());
          });
          $('#total_income').html(amount);
        });
      }

      if($('#total_expense').length > 0){
        $('.expense_table tbody').on( 'click', 'tr', function () {
          let amount = 0;
          $('.expense_table tbody tr.selected td:nth-child(8)').each(function(i,obj){
            amount += parseFloat($(this).html());
          });
          $('#total_expense').html(amount);
        });
      }
});
