<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>User Settings</h2>       
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


        <form action="<?php echo site_url();?>user/settings" class="user_settings_form" method="post">
        <div class="form-group">
            <label for="admin_password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" autocomplete="off" value="">
        </div>

        <div class="form-group">
            <label for="admin_confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" name="confirm_password" autocomplete="off">
        </div>

        <input type="hidden" name="id" value="<?php echo $record['id'];?>">
         
          <button type="submit" class="btn btn-primary" name="update_user_details">Update</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->