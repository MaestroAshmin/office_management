<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add User</h1>
          </div>

          <?php
            if($this->session->flashdata("error"))
            {
                foreach($this->session->flashdata("error") as $error){
                    echo '<p class="error">*'.$error.'</p>';
                }
            }
          ?>

          <!-- Content Row -->
            <form class="add_user_form" action="<?php echo site_url();?>user/add_user" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contact No. (Personal)</label>
                        <input type="number" name="contact_person" id="contact_person" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contact No. (Office)</label>
                        <input type="text" name="contact_office" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email (Personal)</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email (Office)</label>
                        <input type="email" name="email_office" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Gender</label></br>
                        <input type="radio" id="gender" name="gender" value="male">
                        <label for="male">Male</label><br>
                        <input type="radio" id="gender" name="gender" value="female">
                        <label for="female">Female</label><br>
                        <input type="radio" id="gender" name="gender" value="other">
                        <label for="other">Other</label>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Date of Join</label>
                        <input type="text" id="join_date" name="join_date" class="form-control" style="width:100%;">
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <div>
                            <select id="user_type" name="user_type" class="form-control">>
                            <?php foreach ($roles as $role) {?>
                                <option value ="<?php echo $role['role_id']?>"><?php echo $role['user_type']?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group department">
                        <label>Department</label>
                        <div>
                            <select id="department" name="department" class="form-control">
                            <?php foreach ($departments as $department) {?>
                                <option value ="<?php echo $department['id']?>"><?php echo $department['Name']?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group designation">
                        <label>Designation</label>
                        <div>
                            <select id="designation" name="designation" class="form-control">>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Allow User Creation </label></br>
                        <input type="radio" id="allow" name="allow" value="1">
                        <label for="allow">Yes</label><br>
                        <input type="radio" id="dont_allow" name="allow" value="0">
                        <label for="dont_allow">No</label><br>
                    </div>
                    <div class="form-group">
                        <label>Is the user allowed to approve Financial Inserts?  </label></br>
                        <input type="radio" id="allow_approve" name="allow_approve" value="1">
                        <label for="allow">Yes</label><br>
                        <input type="radio" id="dont_allow_approve" name="allow_approve" value="0">
                        <label for="dont_allow">No</label><br>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
          <!-- Content Row -->
        </div>