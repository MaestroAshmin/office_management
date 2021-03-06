

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Company Manager</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <a href="<?php echo site_url();?>admin/company/create" class="btn btn-primary">Create New Company</a>
            </div>

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
                      <th>Company Name</th>
                      <th>Image</th>
                      <th>Address</th>
                       <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(!empty($records) && is_array($records)){
                          foreach($records as $record){
                    ?>
                    <tr>
                      <td><?php echo $record['company_name'];?></td>
                      <td>
                        <img src="<?php echo site_url();?>img/company_logo/<?php echo $record['company_logo'];?>" alt="<?pho echo $record['company_name'];?>">   
                      </td>
                      <td><?php echo $record['company_address'];?></td>
                      <td><?php echo ($record['status'] == 1) ? 'Active' : 'Inactive';?></td>
                      <td>
                        <a class="btn btn-primary" href="<?php echo site_url();?>admin/company/update/<?php echo $record['company_id'];?>">
                          <i class="fas fa-edit"></i>
                        </a>
                        
                        <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?');" href="<?php echo site_url();?>admin/company/delete/<?php echo $record['company_id'];?>">    
                          <i class="fas fa-trash"></i>
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

