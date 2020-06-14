<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>Admin Settings</h2>       
         </div>

       <div class="card-body">

         <?php if($this->session->flashdata('success')) { ?>
              <div style="width:800px margin: 0 auto;" class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success');?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <?php } ?>


        <form action="<?php echo site_url();?>admin/settings" class="admin_settings_form" method="post">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off" value="<?php echo isset($record['email']) ? $record['email'] : '';?>">
        </div>

        <div class="form-group">
            <label for="admin_password">Password</label>
            <input type="password" class="form-control" id="admin_password" placeholder="Enter password" name="password" autocomplete="off" value="">
        </div>

        <div class="form-group">
            <label for="admin_confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="admin_confirm_password" placeholder="Enter confirm password" name="confirm_password" autocomplete="off">
        </div>

        <input type="hidden" name="id" value="<?php echo $record['id'];?>">
        <input type="hidden" name="ispasswordChanged" id="ispasswordChanged" value="0">
         
          <button type="submit" class="btn btn-primary" name="update_admin_details">Update</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->