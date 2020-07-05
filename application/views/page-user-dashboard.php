<div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      </div>

      <!-- Content Row -->
      <div class="col-12 container">
        <div class="row">
          <?php if($role==1 || $role == 2 || $dept == 1) { ?>
            <div class="col-sm-12" id="account_dashboard">
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
                        <h5 class="description-header" id="total_income"></h5>
                        <span class="description-text">TOTAL INCOME</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header" id="total_expense"></h5>
                        <span class="description-text">TOTAL EXPENSE</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header" id="total_equity"></h5>
                        <span class="description-text">TOTAL EQUITY</span>
                      </div>
                      <!-- /.description-block -->
                    </div>  
                </div>
              </div>
              <!-- /.card -->
            </div>              
          <?php } ?>
          <?php if($role==1 || $dept == 2) { ?>
          <div class="col-sm-12" style="margin-top:15px;">
              <!-- BAR CHART -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title float-left">Performance Indicator</h3>
                  <div class="form-group float-right" style="margin:0;">
                    <select class="form-control" id="employee_chart" name="employee_chart" style="margin:0;">
                        <?php foreach($users as $user){ ?>
                          <option value = "<?php echo $user['id']?>"><?php echo $user['name']?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-6 col-6">
                      <div class="description-block border-right d-flex">
                        <span class="description-text">Achievement</span>
                        <h5 class="description-header ml-auto" id="total_achievement"></h5>
                      </div>
                    </div>
                    <!-- /.description-block -->
                    <div class="col-sm-6 col-6">
                      <div class="description-block border-right d-flex">
                        <span class="description-text" id="achievement_comment">Achievement</span>
                      </div>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <!-- Content Row -->
  
      