<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Employee Record</h1>
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
        <form class="add_employee_record col-sm-12" action="#" method="post" enctype="multipart/form-data">  
            <input type="hidden" id="emp_code" name="emp_code" value="<?php echo $emp_code?>">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Fiscal Year *</label>
                    <div>
                        <select class="form-control" id="fy_id" name="fy_id">
                            <option value ="">---Select Fiscal Year---</option>
                            <?php foreach($fiscal_years as $fy){?>   
                                <option value="<?php echo $fy['id']?>">Fiscal Year - <?php echo $fy['fiscal_year']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>    
                <div class="form-group col-md-6">
                    <label>Total Montly Salary</label>
                    <div>
                        <input type="hidden" name="total_monthly" id="total_monthly">
                        <input type="number" name="total_monthly" id="total_monthly_disabled" class="form-control" disabled>
                    </div>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Allowances</h5>
                </div>  
                <div class="form-group col-md-2">
                    <label>Basic Salary *</label>
                    <div>
                        <input type="number" id="basic_salary" name="basic_salary" value="0" class="form-control">
                    </div>
                </div>     
                <div class="form-group col-md-3">
                    <label>House Rent Allowance *</label>
                    <div>
                        <input type="number" id="house_rent" name="house_rent" value="0" class="form-control">
                    </div>
                </div> 
                <div class="form-group col-md-2">
                    <label>Food Allowance *</label>
                    <div>
                        <input type="number" id="food" name="food" value="0" class="form-control">
                    </div>
                </div> 
                <div class="form-group col-md-3">
                    <label>Conveyance Allowance *</label>
                    <div>
                        <input type="number" id="conveyance" name="conveyance" value="0" class="form-control">
                    </div>
                </div> 
                <div class="form-group col-md-2">
                    <label>Other Allowance *</label>
                    <div>
                        <input type="number" id="other" name="other" value="0" class="form-control">
                    </div>
                </div> 

                <div class="form-group col-12 text-center">
                    <h5>Leave/Holidays</h5>
                </div>  
                <div class="form-group col-md-4">
                    <label>Annual Leave Permitted *</label>
                    <div>
                        <input type="number" name="annual_leave_permitted" value="0" class="form-control">
                    </div>
                </div>     
                <div class="form-group col-md-4">
                    <label>Annual Company Leave *</label>
                    <div>
                        <input type="number" name="annual_company_leave" value="0" class="form-control">
                    </div>
                </div>     
                <div class="form-group col-md-4">
                    <label>Holidays *</label>
                    <div>
                        <input type="number" name="holidays" value="0" class="form-control">
                    </div>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Increment Details</h5>
                </div>  
                <div class="form-group col-12">
                    <textarea class="form-control" name="increment_details" rows="3"></textarea>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Promotion Details</h5>
                </div>  
                <div class="form-group col-12">
                    <textarea class="form-control" name="promotion_details" rows="3"></textarea>
                </div>     

                <div class="form-group col-12 text-center">
                    <h5>Resignation/Termination</h5>
                </div>  
                <div class="form-group col-md-6">
                    <label>Resigned on</label>
                    <div>
                        <input type="text" id="resigned_on" name="resigned_on" class="form-control nepali_date">
                    </div>
                </div>     
                <div class="form-group col-md-6">
                    <label>Terminated on</label>
                    <div>
                        <input type="text" id="terminated_on" name="terminated_on" class="form-control nepali_date">
                    </div>
                </div>     

                <div class="form-group">
                    <button class="btn btn-primary">ADD</button>
                </div>  
            </div>
        </form>
    </div>
</div>

        