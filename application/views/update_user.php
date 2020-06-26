<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update</h1>
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
            <form class="update_user_form" action="<?php echo site_url();?>user/update_user/<?php echo $user_data['id']?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" class="form-control" value ="<?php echo $user_data['id']?>">
                    <input type="hidden" name="old_contact_person" id="old_contact_person" class="form-control"  value ="<?php echo $user_data['personal_no']?>">
                    <input type="hidden" name="old_email" id="old_email" class="form-control" value ="<?php echo $user_data['email']?>">

                <div class="row">    
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value ="<?php echo $user_data['name']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value ="<?php echo $user_data['address']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Contact No. (Personal)</label>
                        <input type="number" name="contact_person" id="contact_person" class="form-control"  value ="<?php echo $user_data['personal_no']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Contact No. (Office)</label>
                        <input type="text" name="contact_office" class="form-control"  value ="<?php echo $user_data['office_no']?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Email (Personal)</label>
                        <input type="email" name="email" id="email" class="form-control" value ="<?php echo $user_data['email']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email (Office)</label>
                        <input type="email" name="email_office" class="form-control" value ="<?php echo $user_data['email_office']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Gender</label></br>
                        <select id="gender" name="gender" class="form-control">>
                            <option value="male" <?php echo ($user_data['Gender']== 'male') ? 'selected' : '';?>>Male</option>
                            <option value="female" <?php echo ($user_data['Gender']== 'female') ? 'selected' : '';?>>Female</option>
                            <option value="other" <?php echo ($user_data['Gender']== 'other') ? 'selected' : '';?>>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date of Join</label>
                        <input type="text" id="join_date" name="join_date" class="form-control"  style="width:100%;" value="<?php echo $user_data['join_date']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>User Type</label>
                        <div>
                            <select id="user_type-edit" name="user_type" class="form-control">
                                <?php foreach ($roles as $role) {?>
                                    <option value ="<?php echo $role['role_id']?>" <?php echo ($role['role_id'] == $user_data['role']) ? 'selected' : ''; ?>><?php echo $role['user_type']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                        <div class="form-group col-md-6 department-edit">
                            <label>Department</label>
                            <div>
                                <select id="department-edit" name="department" class="form-control">
                                    <?php foreach ($departments as $department) {?>
                                        <option value ="<?php echo $department['id']?>"  <?php echo ($department['id'] == $user_data['dept_id']) ? 'selected' : ''; ?>><?php echo $department['Name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
        
                        <div class="form-group col-md-6 designation-edit">
                            <label>Designation</label>
                            <input type="hidden" id="des_user" value="<?php echo $user_data['des_id']; ?>">
                            <div>
                                <select id="designation-edit" name="designation" class="form-control">
                                </select>
                            </div>
                        </div>
                    <div class="form-group col-md-6">
                        <label>Allow User Creation</label></br>
                        <input type="radio" id="allow" name="allow" value="1" <?php echo ($user_data['allow_user_creation']==1) ? 'checked' : ''; ?>>
                        <label for="allow">Yes</label><br>
                        <input type="radio" id="dont_allow" name="allow" value="0" <?php echo ($user_data['allow_user_creation']==0) ? 'checked' : ''; ?>>
                        <label for="dont_allow">No</label><br>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Is the user allowed to approve Financial Inserts?  </label></br>
                        <input type="radio" id="allow_approve" name="allow_approve" value="1"  <?php echo ($user_data['is_allowed_to_approve']==1) ? 'checked' : ''; ?>>
                        <label for="allow">Yes</label><br>
                        <input type="radio" id="dont_allow_approve" name="allow_approve" value="0"  <?php echo ($user_data['is_allowed_to_approve']==0) ? 'checked' : ''; ?>>
                        <label for="dont_allow">No</label><br>
                    </div>
                    <div class="form-group col-md-12 float-right">
                        <button class="btn btn-primary float-left">Update</button>
                    </div>
                </div>
            </form>
        
          <!-- Content Row -->
        </div>