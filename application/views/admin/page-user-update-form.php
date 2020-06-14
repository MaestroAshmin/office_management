<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>Update User</h2>       
            </div>

       <div class="card-body">
        <form name="userform" action="<?php echo site_url();?>admin/user/edit/<?php echo $record['id'];?>" class="user_edit_form" method="post">

           <div class="form-group">
            <label for="full_name">Name</label>
            <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" autocomplete="off" value="<?php echo $record['name'];?>">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off" value="<?php echo $record['email'];?>" readonly >
          </div>

          <div class="form-group">
            <label for="pwd">Password</label>
            <div class="input-group">
              <input type="password" readonly class="form-control" id="pwd" placeholder="Enter password" name="password" value="<?php echo $record['actual_password'];?>">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" onClick="generate();">Generate Password</button>
                <button class="btn btn-danger reveal" type="button"><i class="fas fa-fw fa-eye"></i></button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" placeholder="Enter position" name="position" autocomplete="off" value="<?php echo $record['position'];?>"> 
          </div>

           <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
              <option value="">Select</option>
              <option value="1"<?php if($record['status'] == '1'){ ?> selected="selected" <?php } ?>>
                Active
              </option>
              <option value="0"<?php if($record['status'] == '0'){ ?> selected="selected" <?php } ?>>
                Inactive
              </option>
            </select>
          </div>
          
          <input type="hidden" name="old_password" id="old_password" class="form-control" value="<?php echo $record['actual_password'];?>">
          <input type="hidden" name="originalemail" id="originalemail" value="<?php echo $record['email'];?>">
          <input type="hidden" name="id" class="form-control" value="<?php echo $record['id'];?>">
          <input type="hidden" name="password_changed" id="isPasswordchanged" value="0">
          <button type="submit" class="btn btn-primary" name="save_user">Update</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->