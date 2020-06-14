<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>Edit Client</h2>       
            </div>

       <div class="card-body">

         <?php if($this->session->flashdata('error')) { ?>
              <div style="width:800px margin: 0 auto;" class="alert alert-warning alert-dismissible fade show" role="alert">
                  
                <?php echo $this->session->flashdata('error');?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        <?php } ?>

        <form name="client_from_update" action="<?php echo site_url();?>admin/clients/update/<?php echo $record['id'];?>" class="client_from_update" method="post" enctype="multipart/form-data">

           <div class="form-group">
            <label for="client_name">Client Name</label>
            <input type="text" class="form-control" id="client_name" placeholder="Enter Client Name" name="client_name" autocomplete="off" value="<?php echo isset($record['client_name']) ? $record['client_name'] : '';?>">
          </div>

          <div class="form-group">
            <label for="client_address">Client Address</label>
            <input type="text" class="form-control" id="client_address" placeholder="Enter Client Address" name="client_address" autocomplete="off" value="<?php echo isset($record['client_address']) ? $record['client_address'] : '';?>">
          </div>

          <div class="form-group">
            <label for="client_email">Client Email</label>
            <input type="text" class="form-control" id="client_email" placeholder="Enter Client Email" name="client_email" autocomplete="off" value="<?php echo isset($record['client_email']) ? $record['client_email'] : '';?>">
          </div>

          <div class="form-group">
            <label for="client_website">Client Website</label>
            <input type="text" class="form-control" id="client_website" placeholder="Enter Client Website" name="client_website" autocomplete="off" value="<?php echo isset($record['client_website']) ? $record['client_website'] : '';?>">
          </div>


           <div class="form-group">
            <label for="client_contact">Client Contact Number</label>
            <input type="text" class="form-control" id="client_contact" placeholder="Enter Client Contact Number" name="client_contact" autocomplete="off" value="<?php echo isset($record['client_contact']) ? $record['client_contact'] : '';?>">
          </div>

          <input type="hidden" name="id" value="<?php echo $record['id'];?>" class="form-control">

          <button type="submit" class="btn btn-primary" name="update_client">Update Client</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->