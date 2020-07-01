<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Employee Record (<?php echo $emp_code?>)</h1>
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
        <div class="row">
            <div class="col-md-12" style="margin-bottom:10px;">
                <label>Fiscal Year *</label>
                <div>
                    <input type="hidden" id="emp_code" value="<?php echo $emp_code?>"/>
                    <input type="hidden" id="emp_id" value="<?php echo $emp_id?>"/>
                    <select class="form-control" id="fy_id_view">
                        <?php foreach($fiscal_years as $fy){?>   
                            <option value="<?php echo $fy['id']?>">Fiscal Year - <?php echo $fy['fiscal_year']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>    
            <div class="col-md-4">
                <div class="col-12 text-center">
                    <h3>Allowances</h3>
                </div>
                <div>
                    <label class="font-weight-bold">Total Montly Salary : </label><label class="float-right" id="total_monthly"></label>
                </div>
                <div>
                    <label class="font-weight-bold">Basic Salary : </label><label class="float-right" id="basic_salary"></label>
                </div>
                <div>
                    <label class="font-weight-bold">House Rent Allowance : </label><label class="float-right" id="house_rent"></label>
                </div>
                <div>
                    <label class="font-weight-bold">Food Allowance : </label><label class="float-right" id="food"></label>
                </div>
                <div>
                    <label class="font-weight-bold">Conveyance Allowance : </label><label class="float-right" id="conveyance"></label>
                </div>
                <div>
                    <label class="font-weight-bold">Other Allowance : </label><label class="float-right" id="other"></label>
                </div>                    
            </div>     
            <div class="col-md-4" style="border: 1px solid #d6d6d6;border-top:none;border-bottom:none;">
                <div class="col-12 text-center">
                    <h3>Leave Holidays</h3>
                </div>
                <div>
                    <label class="font-weight-bold">Annual Leave Permitted : </label><label class="float-right" id="leave_permitted"></label>
                </div>
                <div>
                    <label class="font-weight-bold">Annual Company Leave : </label><label class="float-right" id="company_leave"></label>
                </div>
                <div>
                    <label class="font-weight-bold">Holidays : </label><label class="float-right" id="holidays"></label>
                </div>          
            </div>   
            <div class="col-md-4">
                <div class="col-12 text-center">
                    <h3>Resignation/Termination</h3>
                </div>
                <div>
                    <label class="font-weight-bold">Resigned On : </label><label id="resigned_on" class="float-right"></label>
                </div>
                <div>
                    <label class="font-weight-bold">Terminated On : </label><label id="terminated_on" class="float-right"></label>
                </div>      
            </div>   
         
            <div class="form-group col-12 text-center">
                <h5>Increment Details</h5>
            </div>  
            <div class="form-group col-12">
                <textarea class="form-control" id="increment_details" rows="3" disabled></textarea>
            </div>     

            <div class="form-group col-12 text-center">
                <h5>Promotion Details</h5>
            </div>  
            <div class="form-group col-12">
                <textarea class="form-control" id="promotion_details" rows="3" disabled></textarea>
            </div>      

            <div class="form-group col-12">
                <a href="#" id="edit_employee_record" class="btn btn-primary">EDIT</a>                
                <a href="#" id="delete_employee_record" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?">DELETE</a>                
                <a href="<?php echo site_url().'user/add_employee_record/'.$emp_id ?>" class="btn btn-success">ADD</a>
            </div>  
    </div>
</div>

        