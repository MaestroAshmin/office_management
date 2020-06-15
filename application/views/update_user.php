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
            <form class="" action="<?php echo site_url();?>user/update_user/<?php echo $user_data['id']?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" class="form-control" value ="<?php echo $user_data['id']?>">
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value ="<?php echo $user_data['name']?>">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value ="<?php echo $user_data['address']?>">
                    </div>
                    <div class="form-group">
                        <label>Contact No. (Personal)</label>
                        <input type="number" name="contact_person" class="form-control"  value ="<?php echo $user_data['personal_no']?>">
                    </div>
                    <div class="form-group">
                        <label>Contact No. (Office)</label>
                        <input type="text" name="contact_office" class="form-control"  value ="<?php echo $user_data['office_no']?>">
                    </div>

                    <div class="form-group">
                        <label>Email (Person)</label>
                        <input type="email" name="email" class="form-control" value ="<?php echo $user_data['email']?>">
                    </div>
                    <div class="form-group">
                        <label>Email (Office)</label>
                        <input type="email" name="email_office" class="form-control" value ="<?php echo $user_data['email_office']?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value ="">
                    </div>
                    <div class="form-group">
                        <label>Gender</label></br>
                        <input type="radio" id="gender" name="gender" value="male" <?php echo ($user_data['Gender']== 'male') ? 'checked' : '';?>>
                        <label for="male">Male</label><br>
                        <input type="radio" id="gender" name="gender" value="female" <?php  echo ($user_data['Gender']== 'female') ? 'checked' : '';?>>
                        <label for="female">Female</label><br>
                        <input type="radio" id="gender" name="gender" value="other">
                        <label for="other">Other</label>
                    </div>
                    <div class="form-group">
                        <label>Date of Join</label>
                        <input type="text" id="join_date" name="join_date" class="form-control" value="<?php echo $user_data['join_date']?>">
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <div>
                            <select id="user_type-edit" name="user_type">
                                <?php foreach ($roles as $role) {?>
                                    <option value ="<?php echo $role['role_id']?>" <?php echo ($role['role_id'] == $user_data['role']) ? 'selected' : ''; ?>><?php echo $role['user_type']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                        <div class="form-group department-edit">
                            <label>Department</label>
                            <div>
                                <select id="department-edit" name="department">
                                    <?php foreach ($departments as $department) {?>
                                        <option value ="<?php echo $department['id']?>"  <?php echo ($department['id'] == $user_data['dept_id']) ? 'selected' : ''; ?>><?php echo $department['Name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
        
                        <div class="form-group designation-edit">
                            <label>Designation</label>
                            <input type="hidden" id="des_user" value="<?php echo $user_data['des_id']; ?>">
                            <div>
                                <select id="designation-edit" name="designation">
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <label>Allow User Creation </label></br>
                        <input type="radio" id="allow" name="allow" value="1" <?php echo ($user_data['allow_user_creation']==1) ? 'checked' : ''; ?>>
                        <label for="allow">Yes</label><br>
                        <input type="radio" id="dont_allow" name="allow" value="0" <?php echo ($user_data['allow_user_creation']==0) ? 'checked' : ''; ?>>
                        <label for="dont_allow">No</label><br>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
        
          <!-- Content Row -->
        </div>