<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>Update Company</h2>       
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

        <form name="company_form_update" action="<?php echo site_url();?>admin/company/update/<?php echo $record['company_id'];?>" class="company_form_update" method="post" enctype="multipart/form-data">

           <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" placeholder="Enter Company Name" name="company_name" autocomplete="off" value="<?php echo isset($record['company_name']) ? $record['company_name'] : '';?>">
          </div>


          <div class="form-group">
            <label for="company_address">Company Address</label>
            <input type="text" class="form-control" id="company_address" placeholder="Enter Company Address" name="company_address" autocomplete="off" value="<?php echo isset($record['company_address']) ? $record['company_address'] : '';?>"> 
          </div>

          <div class="form-group">
            <label for="company_vat_no">Company VAT Number</label>
            <input type="text" class="form-control" id="company_vat_no" placeholder="Enter Company VAT Number" name="company_vat" autocomplete="off" value="<?php echo isset($record['company_vat']) ? $record['company_vat'] : '';?>"> 
          </div>

          <div class="form-group">
            <label for="company_email">Company Email</label>
            <input type="email" class="form-control" id="company_email" placeholder="Enter Company Email" name="company_email" autocomplete="off" value="<?php echo isset($record['company_email']) ? $record['company_email'] : '';?>">
          </div>

           <div class="form-group">
            <label for="company_website">Company Website</label>
            <input type="text" class="form-control" id="company_website" placeholder="Enter Company Website" name="company_website" autocomplete="off" value="<?php echo isset($record['company_website']) ? $record['company_website'] : '';?>">
          </div>

          <div class="form-group">
            <label for="company_contact">Company Contact</label>
            <input type="text" class="form-control" id="company_contact" placeholder="Enter Company Contact" name="company_contact" autocomplete="off" value="<?php echo isset($record['company_contact']) ? $record['company_contact'] : '';?>">
          </div>

          <div class="form-group">
            <img src="<?php echo site_url();?>img/company_logo/<?php echo $record['company_logo'];?>">
          </div>

          <div class="form-group">
            <label for="company_logo">Company Logo</label>
            <input type="file" name="userfile" class="form-control" id="company_logo">
          </div>

        
           <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
              <option value="">Select</option>
              <option value="1" <?php if($record['status'] == 1){?> selected="selected" <?php } ?> >Active</option>
              <option value="0" <?php if($record['status'] == 0){?> selected="selected" <?php } ?> >Inactive</option>
            </select>
          </div>

          <input type="hidden" name="old_company_logo" id="old_company_logo" class="form-control" value="<?php echo $record['company_logo'];?>">
          
          <input type="hidden" name="company_id" class="form-control" value="<?php echo $record['company_id'];?>">

          <button type="submit" class="btn btn-primary" name="update_company">Update Company</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->