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
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Address *</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date of Birth *</label>
                        <input type="text" id="date_of_birth" name="date_of_birth" autocomplete="off" class="form-control" style="width:100%;">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Contact No. (Personal) *</label>
                        <input type="number" name="contact_person" id="contact_person" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Contact No. (Office) *</label>
                        <input type="text" name="contact_office" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email (Personal) *</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email (Office) *</label>
                        <input type="email" name="email_office" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Gender *</label></br>
                        <select id="gender" name="gender" class="form-control">>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>User Type *</label>
                        <div>
                            <select id="user_type" name="user_type" class="form-control">>
                            <?php foreach ($roles as $role) {?>
                                <option value ="<?php echo $role['role_id']?>"><?php echo $role['user_type']?></option>
                            <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Is the user allowed to approve Financial Inserts?  *</label></br>
                        <input type="radio" id="allow_approve" name="allow_approve" value="1">
                        <label for="allow_approve">Yes</label><br>
                        <input type="radio" id="dont_allow_approve" name="allow_approve" value="0">
                        <label for="dont_allow_approve">No</label>
                    </div>


                    <div class="row employee-section col-12">
                        <div class="form-group col-12 emloyee-section-title text-white text-center">
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
                                <input type="text" name="municipality" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Ward Number *</label>
                            <div>
                                <input type="number" name="ward_number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tole</label>
                            <div>
                                <input type="text" name="tole" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>House Number</label>
                            <div>
                                <input type="number" name="house_number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Street Name</label>
                            <div>
                                <input type="text" name="street_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>District *</label>
                            <div>
                                <input type="text" name="district" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Province *</label>
                            <div>
                                <select name="province" class="form-control">
                                    <option value=''>Select Province</option>
                                    <option value='1'>Province 1</option>
                                    <option value='2'>Province 2</option>
                                    <option value='3'>Bagmati</option>
                                    <option value='4'>Gandaki</option>
                                    <option value='5'>Province 5</option>
                                    <option value='6'>Karnali</option>
                                    <option value='7'>Sudurpaschim</option>
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group col-12">
                            <h6>Address (Temporary)</h6>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Municipality</label>
                            <div>
                                <input type="text" name="municipality_temp" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Ward Number</label>
                            <div>
                                <input type="number" name="ward_number_temp" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tole</label>
                            <div>
                                <input type="text" name="tole_temp" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-2">
                            <label>House Number</label>
                            <div>
                                <input type="number" name="house_number_temp" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Street Name</label>
                            <div>
                                <input type="text" name="street_name_temp" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>District</label>
                            <div>
                                <input type="text" name="district_temp" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Province</label>
                            <div>
                                <select name="province_temp" class="form-control">
                                    <option>Select Province</option>
                                    <option value='1'>Pradesh 1</option>
                                    <option value='2'>Pradesh 2</option>
                                    <option value='3'>Bagmati Pradesh</option>
                                    <option value='4'>Pradesh 4</option>
                                    <option value='5'>Pradesh 5</option>
                                    <option value='6'>Pradesh 6</option>
                                    <option value='7'>Pradesh 7</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-12 text-center">
                            <h5>Guardians Details</h5>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Father's Name *</label>
                            <div>
                                <input type="text" name="father_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Grand Father's Name *</label>
                            <div>
                                <input type="text" name="grand_father_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Mother's Name *</label>
                            <div>
                                <input type="text" name="mother_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Married Status *</label>
                            <div>
                                <select name="married_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0">Unmarried</option>
                                    <option value="1">Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Spouse's Name</label>
                            <div>
                                <input type="text" name="spouse_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Childrens's Name</label>
                            <div>
                                <input type="text" name="children_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Local Guardians</label>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Name *</label>
                                    <div>
                                        <input type="text" name="guardian_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Gender</label>
                                    <div>
                                        <select name="guardian_gender" class="form-control">
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Relation *</label>
                                    <div>
                                        <input type="text" name="guardian_relation" class="form-control">
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
                                <input type="text" name="last_degree" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Institution *</label>
                            <div>
                                <input type="text" name="institution" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Year *</label>
                            <div>
                                <input type="number" name="edu_year" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Experience in Similar Field</label>
                            <div>
                                <textarea name="exp_field" class="form-control" row="5"></textarea>
                            </div>
                        </div>
                       
              
                        <div class="form-group col-12 text-center">
                            <h5>Office Purpose</h5>
                        </div>
                        <div class="form-group col-md-6 department">
                            <label>Department *</label>
                            <div>
                                <select id="department" name="department" class="form-control">
                                <?php foreach ($departments as $department) {?>
                                    <option value ="<?php echo $department['id']?>"><?php echo $department['Name']?></option>
                                <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6 designation">
                            <label>Designation *</label>
                            <div>
                                <select id="designation" name="designation" class="form-control">>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Employee Code *</label>
                            <input type="text" name="emp_code" id="emp_code" autocomplete="off" class="form-control" style="width:100%;">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Join *</label>
                            <input type="text" name="join_date" id="join_date" autocomplete="off" class="form-control" style="width:100%;">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Citizenship Number *</label>
                            <input type="text" name="citizenship_no" autocomplete="off" class="form-control" style="width:100%;">
                        </div>
                        <div class="form-group col-md-6">
                            <label>PAN Number *</label>
                            <input type="text" name="pan_no" autocomplete="off" class="form-control" style="width:100%;">
                        </div>

                        <div class="form-group col-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Select Profile Image</div>
                                <div class="panel-body">
                                    <input type="file" name="upload_image" id="upload_image" accept="image/*" />
                                    <br />
                                <div id="uploaded_image"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
                </div>
            </form>
          <!-- Content Row -->

        <div id="uploadimageModal" class="modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload & Crop Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 text-center">
                                <div id="image_demo" style="width:350px; margin-top:30px"></div>
                            </div>
                            <div class="col-md-4" style="padding-top:30px;">
                                <br />
                                <br />
                                <br/>
                                <button class="btn btn-success crop_image">Crop & Upload Image</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
