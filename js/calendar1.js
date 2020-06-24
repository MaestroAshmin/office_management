$(document).ready(function(){
        if($(".eng_date").length >= 1){
                // let eng_date = $(".eng_date").datepicker().datepicker("getDate");
                var d = new Date();
                var month = d.getMonth()+1;
                var day = d.getDate();
                var date = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
                // let ad = output.split("/");
                // var date= ad[]+'-'+ad[0]+'-'+ad[1]
                $('.eng_date').val(date);
                $('.nepali_date').nepaliDatePicker();
                $('.nepali_date').val(AD2BS(date));
                $('.eng_date').attr('value',date);
                $('.nepali_date').attr('value',AD2BS(date));
        }
        $('#nepali-datepicker').nepaliDatePicker();
})
