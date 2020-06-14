

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Estimates</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">

            <div class="card-header py-3">
              <a href="<?php echo site_url();?>admin/estimates/create" class="btn btn-primary">Create New Estimate</a>
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
                      <th>Quotation Number</th>
                      <th>Quotation From</th>
                      <th>Client</th>
                      <th>Quotation Date</th>
                      <th>Quotation Valid Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if(!empty($records) && is_array($records)){
                          foreach($records as $record){
                    ?>
                    <tr>
                      <td><?php echo $record['quotation_no'];?></td>
                      <td><?php echo getCompanyData('company_name', $record['company_id']);?></td>
                      <td><?php echo getClientData('client_name', $record['client_id']);?></td>
                      <td><?php echo $record['quotation_date'];?></td>
                      <td><?php echo $record['quotation_valid_date'];?></td>
                      <td>
                        <a title="Edit" href="<?php echo site_url();?>admin/estimates/update/<?php echo $record['quotation_id'];?>">
                          <i class="fas fa-edit"></i>
                        </a>
                        | 
                        <a title="Delete" onclick="return confirm('Are you sure to delete this record?');" href="<?php echo site_url();?>admin/estimates/delete/<?php echo $record['quotation_id'];?>">    
                          <i class="fas fa-trash"></i>
                        </a>
                        |
                        <a title="View" target="_blank" href="<?php echo site_url();?>admin/estimates/views/<?php echo $record['quotation_id'];?>">    
                          <i class="fas fa-eye"></i>
                        </a>
                        |
                        <a title="Export as pdf" href="<?php echo site_url();?>admin/estimates/export/<?php echo $record['quotation_id'];?>">    
                          <i class="fas fa-file-pdf"></i>
                        </a>
                        |

                        <a title="Duplicate Quotation" href="<?php echo site_url();?>admin/estimates/clone/<?php echo $record['quotation_id'];?>" onclick="return confirm('Are your sure to clone this quotation?');">
                          <i class="fa fa-clone"></i>
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

