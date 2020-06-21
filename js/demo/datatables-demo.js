// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#transaction thead tr').clone(true).appendTo( '#transaction thead' );
      $('#transaction thead tr:eq(1) th').each( function (i) {
          $(this).html( '<input type="text" placeholder="" />' );
  
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      });
  
      var table = $('#transaction').DataTable({ 
        "searching": false,
        orderCellsTop: true,
        "pageLength": 100,
        "columnDefs": [
          { 
            "searchable": false,
            "targets": [0,10,11],
            }
        ],
        "pagingType": "full_numbers",
        "scrollY": true,
        "scrollX": true
      });
        // $.fn.DataTable.ext.pager.numbers_length = 100;

      $('#transaction tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
      });
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    });
    $('#from_date, #to_date').on('keyup change', function() {
        table.draw();
    } );
    $('#target thead tr').clone(true).appendTo( '#target thead' );
      $('#target thead tr:eq(1) th').each( function (i) {
          $(this).html( '<input type="text" placeholder="" />' );
  
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      });
  
      var table = $('#target').DataTable({ 
        "searching": true,
        orderCellsTop: true,
        "pageLength": 100,
        "columnDefs": [
          { 
            "searchable": false,
            "targets": [0,4],
            }
        ],
        "pagingType": "full_numbers",
        "scrollY": true,
        "scrollX": true
      });
        // $.fn.DataTable.ext.pager.numbers_length = 100;

      $('#target tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
      });
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    });

 $('#target thead tr').clone(true).appendTo( '#target thead' );
      $('#target thead tr:eq(1) th').each( function (i) {
          $(this).html( '<input type="text" placeholder="" />' );
  
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      });
  
      var table = $('#target').DataTable({ 
        "searching": true,
        orderCellsTop: true,
        "pageLength": 100,
        "columnDefs": [
          { 
            "searchable": false,
            "targets": [0,4],
            }
        ],
        "pagingType": "full_numbers",
        "scrollY": true,
        "scrollX": true
      });
        // $.fn.DataTable.ext.pager.numbers_length = 100;

      $('#target tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
      });
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    });
    
    $('#activity thead tr').clone(true).appendTo( '#activity thead' );
      $('#activity thead tr:eq(1) th').each( function (i) {
          $(this).html( '<input type="text" placeholder="" />' );
  
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      });
  
      var table = $('#activity').DataTable({ 
        "searching": true,
        orderCellsTop: true,
        "pageLength": 100,
        "columnDefs": [
          { 
            "searchable": false,
            "targets": [0],
            }
        ],
        "pagingType": "full_numbers",
        "scrollY": true,
        "scrollX": true
      });

      $('#activity tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
      });
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    });

    $('#contact thead tr').clone(true).appendTo( '#contact thead' );
    $('#contact thead tr:eq(1) th').each( function (i) {
        $(this).html( '<input type="text" placeholder="" />' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    });

    var table = $('#contact').DataTable({ 
      "searching": true,
      orderCellsTop: true,
      "pageLength": 100,
      "columnDefs": [
        { 
          "searchable": false,
          "targets": [0,6],
          }
      ],
      "pagingType": "full_numbers",
      "scrollY": true,
      "scrollX": true
    });
      // $.fn.DataTable.ext.pager.numbers_length = 100;

    $('#contact tbody').on( 'click', 'tr', function () {
      $(this).toggleClass('selected');
    });

  $('#button').click( function () {
      alert( table.rows('.selected').data().length +' row(s) selected' );
  });
    
});

minDateFilter = "";
maxDateFilter = "";
$(function () {
$('.reset_btn1').click(function () {
    $("#from_date").val('');
    $("#to_date").val('');
    minDateFilter = '';
    maxDateFilter = '';

    $('.radio_date_filter1 input:radio').attr('checked',false);

    $('#transaction').DataTable().column('1').search(
        minDateFilter,maxDateFilter
    ).draw();
    $('#activity').DataTable().column('1').search(
        minDateFilter,maxDateFilter
    ).draw();
});

$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var min = $("#from_date").val();
        var minDateFilter = new Date(min+' 00:00:00');
        var max = $("#to_date").val();
        var maxDateFilter = new Date(max+' 23:59:59');
    
        var get_date = new Date( data[2] ) || 0; 

        if ( ( isNaN( minDateFilter ) && isNaN( maxDateFilter ) ) ||
            ( isNaN( minDateFilter ) && get_date <=maxDateFilter ) ||
            ( minDateFilter <= get_date   && isNaN( maxDateFilter ) ) ||
            ( minDateFilter <= get_date   && get_date <= maxDateFilter ) )
        {
            return true;
        }
        return false;
    }
);

$("#from_date").datepicker({
    dateFormat: 'yy-mm-dd',
    "onSelect" : function(){
        $('.radio_date_filter1 input:radio').attr('checked',false);
        $('#transaction').DataTable().draw();
    }
});

$("#to_date").datepicker({
    dateFormat: 'yy-mm-dd',
    "onSelect" : function(){    
        $('.radio_date_filter1 input:radio').attr('checked',false);
        $('#transaction').DataTable().draw();
    }
});


$(".radio_date_filter1 input:radio").click(function () {
    var currentDate = new Date();
    if ($(this).val() == 'day') {
        var todayDate = new Date();
        minDateFilter = formatDate(todayDate);
    } else if ($(this).val() == 'year') {
        var firstDayOfY = new Date();
        firstDayOfY.setMonth('00');
        firstDayOfY.setDate('01');
        minDateFilter = formatDate(firstDayOfY).substr(0,4);
    } else {
        var firstDayOfMonth = new Date();
        firstDayOfMonth.setDate('01');
        minDateFilter = formatDate(firstDayOfMonth).substr(0,7);
    }

    $('#transaction').DataTable().column('1').search(
        minDateFilter,
    ).draw();
    $('#activity').DataTable().column('1').search(
        minDateFilter,
    ).draw();


});
function formatDate(date) {
  var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

  if (month.length < 2) 
      month = '0' + month;
  if (day.length < 2) 
      day = '0' + day;

  return [year, month, day].join('-');
}
});

