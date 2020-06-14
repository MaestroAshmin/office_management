

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Fuel Requests</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <?php /* <div class="card-header py-3">
              <a href="<?php echo site_url();?>admin/user/add" class="btn btn-primary">Create Request</a>
            </div> */?>

            <?php if($this->session->flashdata('success')) { ?>
                  <div style="width:800px margin: 0 auto;" class="alert alert-warning alert-dismissible fade show" role="alert">
                      
                    <?php echo $this->session->flashdata('success');?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <?php } ?>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Request Date</th>
                      <th>Request By</th>
                      <th>Position</th>
                      <th>Ticket Number</th>
                      <th>Request Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(!empty($records) && is_array($records)){
                          foreach($records as $record){
                    ?>
                    <tr>
                      <td><?php echo $record['request_date'];?></td>
                      <td><?php echo $record['name'];?></td>
                      <td><?php echo $record['position'];?></td>
                      <td><?php echo $record['ticket_number'];?></td>
                      <td><?php echo ucfirst($record['request_status']);?></td>
                      <td>
                        <a href="<?php echo site_url();?>admin/request/view/<?php echo $record['id'];?>" class="btn btn-info btn-circle view_info" title="View Info"  data-toggle="modal" data-target="#myModal">
                          <i class="fas fa-info-circle"></i>
                        </a>
                      </td>
                    </tr>
                  <?php 
                        } 
                      }else{ 
                  ?>
                      <tr>
                        <td colspan="4"> No records Found</td>
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

