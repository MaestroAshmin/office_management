<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>Add New User</h2>       
            </div>

       <div class="card-body">
        <form name="userform" action="<?php echo site_url();?>admin/user/add" class="user_add_form" method="post">

           <div class="form-group">
            <label for="full_name">Name</label>
            <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="pwd">Password</label>
            <div class="input-group">
              <input type="password" readonly class="form-control" id="pwd" placeholder="Enter password" name="password">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button" onClick="generate();">Generate Password</button>
                <button class="btn btn-danger reveal" type="button"><i class="fas fa-fw fa-eye"></i></button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" placeholder="Enter position" name="position" autocomplete="off"> 
          </div>

           <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status">
              <option value="">Select</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          
         
          <button type="submit" class="btn btn-primary" name="save_user">Save</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->