<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Employee Record</h1>
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
    <div class="row">       
        <form class="update_employee_record col-sm-12" action="#" method="post" enctype="multipart/form-data">  
            <input type="hidden" name="id" id="record_id" class="form-control" value="<?php echo $emp_record['id']; ?>">
            <input type="hidden" id="emp_code" class="form-control" value="<?php echo $emp_code; ?>">
            <input type="hidden" id="old_fy_id" class="form-control" value="<?php echo $emp_record['fy_id']; ?>">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Fiscal Year *</label>
                    <div>
                        <select class="form-control" name="fy_id" id="fy_id">
                            <?php foreach($fiscal_years as $fy){?>   
                                <option value="<?php echo $fy['id']?>" <?php echo $fy['id']==$emp_record['fy_id'] ? 'selected' : '' ?>>Fiscal Year - <?php echo $fy['fiscal_year']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>    
                <div class="form-group col-md-6">
                    <label>Total Montly Salary</label>
                    <div>
                        <input type="hidden" name="total_monthly" id="total_monthly" value="<?php echo $emp_record['total_monthly']; ?>">
                        <input type="number" name="total_monthly" id="total_monthly_disabled" class="form-control" value="<?php echo $emp_record['total_monthly']; ?>" disabled>
                    </div>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Allowances</h5>
                </div>  
                <div class="form-group col-md-2">
                    <label>Basic Salary *</label>
                    <div>
                        <input type="number" id="basic_salary" name="basic_salary" value="<?php echo $emp_record['basic_salary']; ?>" class="form-control">
                    </div>
                </div>     
                <div class="form-group col-md-3">
                    <label>House Rent Allowance *</label>
                    <div>
                        <input type="number" id="house_rent" name="house_rent" value="<?php echo $emp_record['house_rent']; ?>" class="form-control">
                    </div>
                </div> 
                <div class="form-group col-md-2">
                    <label>Food Allowance *</label>
                    <div>
                        <input type="number" id="food" name="food" value="<?php echo $emp_record['food']; ?>" class="form-control">
                    </div>
                </div> 
                <div class="form-group col-md-3">
                    <label>Conveyance Allowance *</label>
                    <div>
                        <input type="number" id="conveyance" name="conveyance" value="<?php echo $emp_record['conveyance']; ?>" class="form-control">
                    </div>
                </div> 
                <div class="form-group col-md-2">
                    <label>Other Allowance *</label>
                    <div>
                        <input type="number" id="other" name="other" value="<?php echo $emp_record['other']; ?>" class="form-control">
                    </div>
                </div> 

                <div class="form-group col-12 text-center">
                    <h5>Leave/Holidays</h5>
                </div>  
                <div class="form-group col-md-4">
                    <label>Annual Leave Permitted *</label>
                    <div>
                        <input type="number" name="annual_leave_permitted" value="<?php echo $emp_record['annual_leave_permitted']; ?>" class="form-control">
                    </div>
                </div>     
                <div class="form-group col-md-4">
                    <label>Annual Company Leave *</label>
                    <div>
                        <input type="number" name="annual_company_leave" value="<?php echo $emp_record['annual_company_leave']; ?>" class="form-control">
                    </div>
                </div>     
                <div class="form-group col-md-4">
                    <label>Holidays *</label>
                    <div>
                        <input type="number" name="holidays" value="<?php echo $emp_record['holidays']; ?>" class="form-control">
                    </div>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Increment Details</h5>
                </div>  
                <div class="form-group col-12">
                    <textarea class="form-control" name="increment_details" rows="3"><?php echo $emp_record['increment_details']; ?></textarea>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Promotion Details</h5>
                </div>  
                <div class="form-group col-12">
                    <textarea class="form-control" name="promotion_details" rows="3"><?php echo $emp_record['promotion_details']; ?></textarea>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Resignation/Termination</h5>
                </div>  
                <div class="form-group col-md-6">
                    <label>Resigned on</label>
                    <div>
                        <input type="text" id="resigned_on" name="resigned_on" class="form-control nepali_date" value="<?php echo $emp_record['resigned_on']; ?>">
                    </div>
                </div>     
                <div class="form-group col-md-6">
                    <label>Terminated on</label>
                    <div>
                        <input type="text" id="terminated_on" name="terminated_on" class="form-control nepali_date" value="<?php echo $emp_record['terminated_on']; ?>">
                    </div>
                </div>     

                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>  
            </div>
        </form>
    </div>
</div>

        