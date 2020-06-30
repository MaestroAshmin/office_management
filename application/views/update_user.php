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
                    <input type="hidden"  id="des_user" class="form-control" value ="<?php echo $user_data['des_id']?>">

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
                        <label>Date of birth</label>
                        <input type="text" id="date_of_birth" name="date_of_birth" class="form-control"  style="width:100%;" value="<?php echo $user_data['date_of_birth']?>">
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
                    <div class="form-group col-md-6">
                        <label>Is the user allowed to approve Financial Inserts?  </label></br>
                        <input type="radio" id="allow_approve" name="allow_approve" value="1"  <?php echo ($user_data['is_allowed_to_approve']==1) ? 'checked' : ''; ?>>
                        <label for="allow">Yes</label><br>
                        <input type="radio" id="dont_allow_approve" name="allow_approve" value="0"  <?php echo ($user_data['is_allowed_to_approve']==0) ? 'checked' : ''; ?>>
                        <label for="dont_allow">No</label><br>
                    </div>
                    <?php
                        if(isset($emp_data)){
                            $address_per    = $emp_data['address_permanent'];
                            $address_temp   = $emp_data['address_temporary'];
                            $guardian       = $emp_data['guardian_details'];
                            $education      = $emp_data['education_details'];       
                        }else{
                            $address_per        = array('municipality','ward_number','tole','house_number','street_name','district','province');
                            $address_temp       = array('municipality_temp','ward_number_temp','tole_temp','house_number_temp','street_name_temp','district_temp','province_temp');
                            $guardian           = array('father_name','grand_father_name','mother_name','spouse_name','children_name','guardian_name','guardian_gender','guardian_relation');
                            $education          = array('last_degree','institution','edu_year','exp_field');       
                            $emp_data           = array('emp_code','citizenship_no','pan_no','join_date','dept_id','des_id');  
                            $address_per        = array_fill_keys($address_per, '');      
                            $address_temp       = array_fill_keys($address_temp, '');      
                            $guardian           = array_fill_keys($guardian, '');      
                            $education          = array_fill_keys($education, '');      
                            $emp_data           = array_fill_keys($emp_data, '');      
                        }
                    ?>
                    <div class="row employee-section col-12">
                        <div class="form-group col-12 bg-gradient-primary text-white text-center">
                            <h4>Employee Details</h4>
                        </div>

                        <div class="form-group col-12 text-center">
                            <h5>Personal Details</h5>
                        </div>

                        <div class="form-group col-12">
                            <h6>Address (Permanent)</h6>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Municipality *</label>
                            <div>
                                <input type="text" name="municipality" class="form-control"  value="<?php echo $address_per['municipality']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Ward Number *</label>
                            <div>
                                <input type="number" name="ward_number" class="form-control" value="<?php echo $address_per['ward_number']?>"> 
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tole</label>
                            <div>
                                <input type="text" name="tole" class="form-control"  value="<?php echo $address_per['tole']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>House Number</label>
                            <div>
                                <input type="number" name="house_number" class="form-control" value="<?php echo $address_per['house_number']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Street Name</label>
                            <div>
                                <input type="text" name="street_name" class="form-control"  value="<?php echo $address_per['street_name']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>District *</label>
                            <div>
                                <input type="text" name="district" class="form-control"  value="<?php echo $address_per['district']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Province *</label>
                            <div>
                                <select name="province" class="form-control">
                                    <option value=''>Select Province</option>
                                    <option value='1' <?php echo $address_per['province']=='1' ? 'selected' : '' ?>>Pradesh 1</option>
                                    <option value='2' <?php echo $address_per['province']=='2' ? 'selected' : '' ?>>Pradesh 2</option>
                                    <option value='3' <?php echo $address_per['province']=='3' ? 'selected' : '' ?>>Bagmati Pradesh</option>
                                    <option value='4' <?php echo $address_per['province']=='4' ? 'selected' : '' ?>>Pradesh 4</option>
                                    <option value='5' <?php echo $address_per['province']=='5' ? 'selected' : '' ?>>Pradesh 5</option>
                                    <option value='6' <?php echo $address_per['province']=='6' ? 'selected' : '' ?>>Pradesh 6</option>
                                    <option value='7' <?php echo $address_per['province']=='7' ? 'selected' : '' ?>>Pradesh 7</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group col-12">
                            <h6>Address (Temporary)</h6>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Municipality</label>
                            <div>
                                <input type="text" name="municipality_temp" class="form-control" value="<?php echo $address_temp['municipality_temp']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Ward Number</label>
                            <div>
                                <input type="number" name="ward_number_temp" class="form-control" value="<?php echo $address_temp['ward_number_temp']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tole</label>
                            <div>
                                <input type="text" name="tole_temp" class="form-control" value="<?php echo $address_temp['tole_temp']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>House Number</label>
                            <div>
                                <input type="number" name="house_number_temp" class="form-control" value="<?php echo $address_temp['house_number_temp']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Street Name</label>
                            <div>
                                <input type="text" name="street_name_temp" class="form-control" value="<?php echo $address_temp['street_name_temp']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>District</label>
                            <div>
                                <input type="text" name="district_temp" class="form-control" value="<?php echo $address_temp['district_temp']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Province</label>
                            <div>
                                <select name="province_temp" class="form-control">
                                    <option>Select Province</option>
                                    <option value='1' <?php echo $address_temp['province']=='1' ? 'selected' : '' ?>>Pradesh 1</option>
                                    <option value='2' <?php echo $address_temp['province']=='2' ? 'selected' : '' ?>>Pradesh 2</option>
                                    <option value='3' <?php echo $address_temp['province']=='3' ? 'selected' : '' ?>>Bagmati Pradesh</option>
                                    <option value='4' <?php echo $address_temp['province']=='4' ? 'selected' : '' ?>>Pradesh 4</option>
                                    <option value='5' <?php echo $address_temp['province']=='5' ? 'selected' : '' ?>>Pradesh 5</option>
                                    <option value='6' <?php echo $address_temp['province']=='6' ? 'selected' : '' ?>>Pradesh 6</option>
                                    <option value='7' <?php echo $address_temp['province']=='7' ? 'selected' : '' ?>>Pradesh 7</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12 text-center">
                            <h5>Guardians Details</h5>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Father's Name *</label>
                            <div>
                                <input type="text" name="father_name" class="form-control" value="<?php echo $guardian['father_name']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Grand Father's Name *</label>
                            <div>
                                <input type="text" name="grand_father_name" class="form-control" value="<?php echo $guardian['grand_father_name']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mother's Name *</label>
                            <div>
                                <input type="text" name="mother_name" class="form-control" value="<?php echo $guardian['mother_name']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Married Status *</label>
                            <div>
                                <select name="married_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0" <?php echo $emp_data['married_status']=='0' ? 'selected' : '' ?>>Unmarried</option>
                                    <option value="1" <?php echo $emp_data['married_status']=='1' ? 'selected' : '' ?>>Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Spouse's Name</label>
                            <div>
                                <input type="text" name="spouse_name" class="form-control" value="<?php echo $guardian['spouse_name']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Childrens's Name</label>
                            <div>
                                <input type="text" name="children_name" class="form-control" value="<?php echo $guardian['children_name']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Local Guardians</label>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Name *</label>
                                    <div>
                                        <input type="text" name="guardian_name" class="form-control" value="<?php echo $guardian['guardian_name']?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Gender</label>
                                    <div>
                                        <select name="guardian_gender" class="form-control">
                                            <option <?php echo $guardian['guardian_gender']=='Male' ? 'selected' : '' ?>>Male</option>
                                            <option <?php echo $guardian['guardian_gender']=='Female' ? 'selected' : '' ?>>Female</option>
                                            <option <?php echo $guardian['guardian_gender']=='other' ? 'selected' : '' ?>>other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Relation *</label>
                                    <div>
                                        <input type="text" name="guardian_relation" class="form-control" value="<?php echo $guardian['guardian_relation']?>">
                                    </div>
                                </div>
                            </div>
                        </div>
              
              
                        <div class="form-group col-12 text-center">
                            <h5>Education Details</h5>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Last Degree *</label>
                            <div>
                                <input type="text" name="last_degree" class="form-control" value="<?php echo $education['last_degree']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Institution *</label>
                            <div>
                                <input type="text" name="institution" class="form-control" value="<?php echo $education['institution']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Year *</label>
                            <div>
                                <input type="number" name="edu_year" class="form-control" value="<?php echo $education['edu_year']?>">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Experience in Similar Field</label>
                            <div>
                                <textarea name="exp_field" class="form-control" row="5"><?php echo $education['exp_field']?></textarea>
                            </div>
                        </div>
                       
              
                        <div class="form-group col-12 text-center">
                            <h5>Office Purpose</h5>
                        </div>
                        <div class="form-group col-md-6 department">
                            <label>Department *</label>
                            <div>
                                <select id="department-edit" name="department" class="form-control">
                                <?php foreach ($departments as $department) {?>
                                    <option value ="<?php echo $department['id']?>" <?php echo $department["id"]==$user_data['dept_id'] ? 'selected' : '' ?>><?php echo $department['Name']?></option>
                                <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 designation">
                            <label>Designation *</label>
                            <div>
                                <select id="designation-edit" name="designation" class="form-control">>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Employee Code *</label>
                            <input type="hidden" name="old_emp_code" id="old_emp_code" value="<?php echo $emp_data['emp_code']?>">
                            <input type="text" name="emp_code" id="emp_code" autocomplete="off" class="form-control" style="width:100%;" value="<?php echo $emp_data['emp_code']?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Join *</label>
                            <input type="text" name="join_date" id="join_date" autocomplete="off" class="form-control" style="width:100%;" value="<?php echo $emp_data['join_date']?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Citizenship Number *</label>
                            <input type="text" name="citizenship_no" autocomplete="off" class="form-control" style="width:100%;" value="<?php echo $emp_data['citizenship_no']?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>PAN Number *</label>
                            <input type="text" name="pan_no" autocomplete="off" class="form-control" style="width:100%;" value="<?php echo $emp_data['pan_no']?>">
                        </div>
                    </div>
                    <div class="form-group col-md-12 float-right">
                        <button class="btn btn-primary float-left">Update</button>
                    </div>
                </div>
            </form>
        
          <!-- Content Row -->
        </div>