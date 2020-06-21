<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="container account_dashboard">
            <div class="row">
              <div class="col-sm-12">
              <!-- LINE CHART -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title float-left" id="chart-title">Income Vs Expense (Monthly)</h3>
                  <div class="form-group float-right" style="margin:0;">
                    <select class="form-control" id="line-chart-type" style="margin:0;">
                      <option>Monthly</option>
                      <option>Yearly</option>
                    </select>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="lineChart" style="max-height: 300px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- Content Row -->
        </div>


    <script src="<?php echo site_url();?>vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        var lineChartDataMonthly = {
          <?php 
            if (count($monthly_expense) > count($monthly_income))
            {
          ?>
          labels  : [<?php foreach($monthly_expense as $e) echo "'".$e["month"]."',"; ?>],
          <?php
            }else{
          ?>
          labels  : [<?php foreach($monthly_income as $e) echo "'".$e["month"]."',"; ?>],
          <?php
            }
          ?>
          datasets: [
            {
              label               : 'Income',
              backgroundColor     : 'rgba(60,141,188,0.9)',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : [<?php foreach($monthly_income as $e) echo $e["amount"].','; ?>]
            },
            {
              label               : 'Expense',
              backgroundColor     : 'rgba(210, 214, 222, 1)',
              borderColor         : 'rgba(210, 214, 222, 1)',
              pointDotRadius      :  1,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : [<?php foreach($monthly_expense as $e) echo $e["amount"].','; ?>]
            },
          ]
        }

        var lineChartDataYearly = {
          labels  : [<?php foreach($yearly_income_expense["year"] as $e) echo "'".$e."',"; ?>],
          datasets: [
            {
              label               : 'Income',
              backgroundColor     : 'rgba(60,141,188,0.9)',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : [<?php foreach($yearly_income_expense["yearly_income"] as $e) echo $e.','; ?>]
            },
            {
              label               : 'Expense',
              backgroundColor     : 'rgba(210, 214, 222, 1)',
              borderColor         : 'rgba(210, 214, 222, 1)',
              pointDotRadius      :  1,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : [<?php foreach($yearly_income_expense["yearly_expense"] as $e) echo $e.','; ?>]
            },
          ]
        }

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
            //-------------
          //- LINE CHART -
          //--------------
          var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
          var lineChartOptions = $.extend(true, {}, lineChartOptions);
          var lineChartData = $.extend(true, {}, lineChartDataMonthly);
          lineChartData.datasets[0].fill = false;
          lineChartData.datasets[1].fill = false;
          lineChartOptions.datasetFill = false;

          var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
          });

          $('#line-chart-type').on('change', function() {
            if(this.value=="Monthly"){
              $('#chart-title').html("Income Vs Expense (Monthly)");
              lineChartData = $.extend(true, {}, lineChartDataMonthly);
              lineChartData.datasets[0].fill = false;
              lineChartData.datasets[1].fill = false;
              lineChartOptions.datasetFill = false;
              
              lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: lineChartData,
                    options: lineChartOptions
              });
            }
            else if(this.value=="Yearly"){
              $('#chart-title').html("Income Vs Expense (Yearly)");              
              lineChartData = $.extend(true, {}, lineChartDataYearly);
              lineChartData.datasets[0].fill = false;
              lineChartData.datasets[1].fill = false;
              lineChartOptions.datasetFill = false;

              lineChart = new Chart(lineChartCanvas, {
                    type: 'line',
                    data: lineChartData,
                    options: lineChartOptions
              });
            }
          });
    </script>