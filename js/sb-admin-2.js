(function($) {
  "use strict"; // Start of use strict
  let site_url = $('.footer').attr('data-siteurl');

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
if($('#join_date').length > 0){
  $('#join_date').datepicker({
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
    var url = window.location.origin;
    var button = $(event.relatedTarget); 
    var recipient = button.data('whatever'); 
    console.log(recipient);
    var modal = $(this);
    modal.find('.modal-content img').attr('src',url+'/acc/images/'+recipient);
  });
  // $('.targetModal').on('show.bs.modal', function (event) {
  //   var link = window.location.origin;
  //   var button = $(event.relatedTarget); 
  //   var target_id = button.data('whatever'); 
  //   console.log(target_id);
  //   $.ajax({
  //     url: link + '/acc/user/get_each_target',
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
    var user_type = $(this).children("option:selected").val();
    if(user_type==3){
      $(".department").show();
    
      var val = $('option:selected', '.department').attr('value');
      $.ajax({
        url: "get_designations",
        data:{
          'id': val
        },
        type: "post",
        success: function(data){
          let objects = JSON.parse(data);
          $(".designation").show();
          $.each( objects, function( key, value ){
            $('#designation').append("<option value ="+value.id+">"+ value.designation +"</option>");
          });
        }
      });

    }
    else{
      $(".department").hide();
      $(".designation").hide();
    }
  });

  $("#department").change(function(){
    var val = $('option:selected', this).attr('value');
    
    $('#designation').empty();

    $.ajax({
      url: "get_designations",
      data:{
        'id': val
      },
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        $(".designation").show();
        $.each( objects, function( key, value ){
          $('#designation').append("<option value ="+value.id+">"+ value.designation +"</option>");
        });
      }
    });
  });

  $("#user_type-edit").change(function(){
    var user_type = $(this).children("option:selected").val();
    if(user_type==3){
      $(".department-edit").show();
      
    base_url = window.location.origin;
    var val = $('option:selected', '#department-edit').attr('value');
      $('#designation-edit').empty();
      $.ajax({
        url: base_url + "/acc/user/get_designations",
        data:{
          'id': val
        },
        type: "post",
        success: function(data){
          let objects = JSON.parse(data);
          $(".designation-edit").show();
  
          var des_user = $("#des_user").val();
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
      $(".department-edit").hide();
      $(".designation-edit").hide();
    }
  });

  $("#department-edit").change(function(){
    base_url = window.location.origin;
    var val = $('option:selected', this).attr('value');
    $('#designation-edit').empty();
    $.ajax({
      url: base_url + "/acc/user/get_designations",
      data:{
        'id': val
      },
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        $(".designation-edit").show();

        var des_user = $("#des_user").val();
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
var val = $("#user_type-edit").children("option:selected").val();
if(val != 3){
  $(".department").hide();
  $(".designation").hide();
  $(".department-edit").hide();
  $(".designation-edit").hide();
}
else{
  $(".department-edit").show();
  var dept = $("#department-edit").children("option:selected").val();
  base_url = window.location.origin;
    var val = $('option:selected', this).attr('value');
    $.ajax({
      url: base_url + "/acc/user/get_designations",
      data:{
        'id': dept
      },
      type: "post",
      success: function(data){
        let objects = JSON.parse(data);
        $(".designation-edit").show();
        var des_user = $("#des_user").val();
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

  //add user type form validation
    
  base_url = window.location.origin;
  $('.add_role_form').validate({
    rules:{
        user_type : {
            required :  true,
            remote: {
              url: base_url+"/acc/user/check_role",
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
                              url: base_url+"/acc/user/check_user_phone",
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
                                url: base_url+"/acc/user/check_user_email",
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
        password          : {
                                required  : true,
                                minlength : 8
                            },
        join_date         : "required",
        user_type         : "required",
        department        : "required",
        designation       : "required",
        allow             : "required",
        allow_approve     : "required",
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
        join_date         : "Please provide your join date",
        user_type         : "Please Select User Type",
        department        : "Please Select Department",
        designation       : "Please Select Designation",
        allow             : "Please Select Allow Option",
        allow_approve     : "Please Select Allow Approve Option"
    },
    errorPlacement: function(error, element) {
      if(element.parent('.form-control')) {
          error.insertAfter(element.parent());
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
                  url: base_url+"/acc/user/check_user_phone",
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
                    url: base_url+"/acc/user/check_user_email",
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
      join_date         : "required",
      user_type         : "required",
      department        : "required",
      designation       : "required",
      allow             : "required",
      allow_approve     : "required"
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
      join_date         : "Please provide your join date",
      user_type         : "Please Select User Type",
      department        : "Please Select Department",
      designation       : "Please Select Designation",
      allow             : "Please Select Allow Option",
      allow_approve     : "Please Select Allow Approve Option"
  },
  errorPlacement: function(error, element) {
    if(element.parent('.form-control')) {
        error.insertAfter(element.parent());
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
  $('.add_target2_form').validate({
    rules:{
        assigned_to : 'required',
        title       : 'required'
    },
    messages:{
        assigned_to : 'Please Select Person',
        title       : 'Please Enter the Title'
    },
    errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
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
        image                 : 'required',
        excel_file            : 'required'
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
        image                 : 'Please Upload Image',
        excel_file            : 'Please Upload Excel File'
    },
    errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
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
    },
    errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
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
        image                 : 'required',
        excel_file            : 'required'
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
        image                 : 'Please Upload Image',
        excel_file            : 'Please Upload Excel File'
    },
    errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
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
    },
    errorPlacement: function(error, element) {
          error.insertAfter(element.parent());
    }
  });
  
  // if($(".add_target_form #assigned_to").length >= 1){
  //   base_url = window.location.origin;
  //   $.ajax({
  //     url: base_url + "/acc/user/get_all_management_role",
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

var slider = document.querySelector('.drag-scroll');
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
      const walk = (x - startX) * 3; //scroll-fast
      slider.scrollLeft = scrollLeft - walk;    
  });
}

});
