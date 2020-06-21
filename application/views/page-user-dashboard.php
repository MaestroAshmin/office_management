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
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header">Rs. <?php echo $current_year_income_expense["income"]; ?></h5>
                        <span class="description-text">TOTAL INCOME</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header">Rs. <?php echo $current_year_income_expense["expense"]; ?></h5>
                        <span class="description-text">TOTAL EXPENSE</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">TOTAL EQUITY</span>
                      </div>
                      <!-- /.description-block -->
                    </div>  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- Content Row -->
        </div>