

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Generate Report</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <?php if($this->session->flashdata('success')) { ?>
                  <div style="width:800px margin: 0 auto;" class="alert alert-warning alert-dismissible fade show" role="alert">
                      
                    <?php echo $this->session->flashdata('success');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php } ?>

            <?php if($this->session->flashdata('error')) { ?>
                  <div style="width:800px margin: 0 auto;" class="alert alert-warning alert-dismissible fade show" role="alert">
                      
                    <?php echo $this->session->flashdata('error');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php } ?>


            <div class="ml-5 mt-5">
              <form class="form-inline report-form" method="get" action="<?php echo site_url();?>admin/report/generate">
                <input type="text" class="form-control mb-2 mr-sm-2" id="from_date" name="from_date" placeholder="From Date" autocomplete="off" required="true">
                <input type="text" class="form-control mb-2 mr-sm-2" id="to_date" name="to_date" placeholder="To Date" autocomplete="off" required="true">

                <select class="form-control mb-2 mr-sm-2" name="user" required="true">
                  <option value="all">All users</option>
                  <?php 
                    if(!empty($users) && is_array($users)){
                      foreach($users as $user){
                  ?>
                    <option value="<?php echo $user['id'];?>">
                      <?php echo $user['name'];?>
                    </option>
                  <?php 
                      } 
                    }
                  ?>
                </select>

                <select class="form-control mb-2 mr-sm-2" name="type" required="true">
                  <option value="">--Select--</option>
                  <option value="Approved" selected="selected">Approved</option>
                  <option value="Declined">Declined</option>
                  <option value="Under Review">Under Review</option>
                </select>

                <input type="submit" name="generate_report" class="btn btn-primary mb-2" value="Submit">
              </form>
          </div>

            <div class="card-body">

              <h3>Approved Fuel Request <small>Last 7 days</small></h3>
              
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Approved Kilometers</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(!empty($records) && is_array($records)){
                          foreach($records as $record){
                    ?>
                    <tr>
                      
                      <td><?php echo $record['name'];?></td>
                      <td><?php echo $record['position'];?></td>
                      <td><?php echo number_format($record['km'], 2);?></td>
                      
                    </tr>
                  <?php 
                        } 
                      }else{ 
                  ?>
                      <tr>
                        <td colspan="3"> No records Found</td>
                      </tr>
                  <?php }  ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Request Info</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body request-info">
          
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

