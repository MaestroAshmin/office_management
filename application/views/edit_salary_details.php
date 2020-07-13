<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Salary Sheet</h1>
    </div>
    <?php
            if($this->session->flashdata("error"))
            {
                if(is_array($this->session->flashdata("error"))){
                    foreach($this->session->flashdata("error") as $error){
                        echo '<p class="error">*'.$error.'</p>';
                    }
                }
                else{
                    echo '<p class="error">*'.$this->session->flashdata("error").'</p>';

                }
            }
    ?>
    <!-- Content Row -->
    <div class="col-12 container">       
        <form class="salary-sheet" action ="calculate_tax" method="post"  enctype="multipart/form-data">
        <div class="row">
                <div class = "form-group col-sm">
                <input type="hidden" value="<?php echo $salary_data['id']?>" name="id">
                    <label>Employee Name</label>
                    <select id="employee" name="employee" class="form-control">
                    
                        <!-- <?php foreach($employees as $employee){
                            if($employee['id'] == $salary_data['user_id']){?> -->
                            <option value="<?php echo $salary_data['user_id']?>" selected><?php echo $salary_data['name']?></option>
                        <!-- <?php }else{?>
                            <option value="<?php echo $employee['id']?>"><?php echo $employee['name']?></option>
                        <?php }
                    }?> -->
                    </select>
                </div>
                <div class="form-group col-sm">
                    <label>Select Fiscal Year</label><br>
                    <select id="fiscal_year" class ="form-control" name="fiscal_year">
                        <option value="<?php echo $salary_data['fiscal_year_id']?>"><?php echo $salary_data['fiscal_year']?></option>
                    </select>
                </div>
                <div class = "form-group col-sm">
                    <label>Select Month</label>
                    <select class="form-control" id="month" name="month">
                    <?php if($salary_data['month']=='Shrawan'){?>
                        <option value="Shrawan" selected>Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>    
                    <?php if($salary_data['month']=='Bhadra'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra" selected>Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>    
                    <?php if($salary_data['month']=='Ashoj'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj" selected>Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Kartik'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik" selected>Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Mangsir'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir" selected>Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Poush'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush" selected>Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Magh'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh" selected>Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Falgun'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun" selected>Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Chaitra'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra" selected>Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Baishak'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak" selected>Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Jestha'){?>
                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha" selected>Jestha</option>
                        <option value="Asar">Asar</option>
                    <?php } ?>  
                    <?php if($salary_data['month']=='Asar'){?>

                        <option value="Shrawan">Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashoj">Ashoj</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar" selected>Asar</option>
                    <?php } ?>  
                    </select>
                </div>
            </div>
            <div class="row">
            <div class="row">
                <div class = "form-group col-sm pan-no">
                <label>Pan number</label>
                    <input type="text" name="pan_no" class ="form-control" value ="<?php echo $salary_data['pan_no']?>" readonly >
                    </input>
                </div>
                <div class = "form-group col-sm emp-code">
                <label>Employee Code</label>
                    <input type="text" name="emp_code" class ="form-control" value ="<?php echo $salary_data['emp_code']?>" readonly >
                    </input>
                </div>
                <div class = "form-group col-sm marital-status">
                    <label>Marital Status</label>
                    <input type="text" name="marital_status" class ="form-control" value ="<?php echo $salary_data['marital_status']==1? 'Married':'Unmarried'?>" readonly >
                    </input>
                </div>
            </div>
            </div>
            <div class = "row salary-breakup">
                <div class ="row col-12 annual-deduction-edit">
                    <h3  class ="col-12">Monthly Deductions</h3>
                    <input type = "hidden" class ="form-control annual_taxable" name = "annual_taxable" value = "<?php echo $salary_data['annual_taxable']?>"></label><br>
    
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Working Days<input type = "number" class ="form-control wd" name = "wd" value = "<?php echo $salary_data['working_days']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Unpaid Leaves<input type = "number" class ="form-control ul" name = "ul" value = "<?php echo $salary_data['unpaid_leaves']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Previous Advance<input type = "number" class ="form-control pa" name = "pa" value = "<?php echo $salary_data['previous_advance']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Total Months<input type = "number" class ="form-control total_months" name = "total_months" value = "<?php echo $salary_data['total_months']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Insurance<input type = "number" class ="form-control insurance" name="insurance" value = "<?php echo $salary_data['insurance']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Citizen Investment Trust<input type = "number" class ="form-control cit" name = "cit" value = "<?php echo $salary_data['cit']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Providend Fund<input type = "number" class ="form-control pf" name = "pf" value = "<?php echo $salary_data['pf']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Social Security<input type = "number" class ="form-control ss" name ="ss" value = "<?php echo $salary_data['ss']?>"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Total Exemption<input type = "number" class ="form-control te" value = "<?php echo $salary_data['total_exemption']?>" name="te" readonly></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Taxable For Month<input type = "number" class ="form-control taxable_for_month" name ="taxable_for_month" value = "<?php echo $salary_data['taxable_for_month']?>" readonly></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Deductions<input type = "number" class ="form-control deductions" name ="deductions" value = "<?php echo $salary_data['deductions']?>" readonly></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Total Payable<input type = "number" class ="form-control total_payable" name ="total_payable" value="<?php echo $salary_data['total_payable']?>" readonly></label><br>
                    </div>
                </div>
                <div class ="row col-12 salary-breakup1">
                <div class="form-group col-sm-12 d-inline-block">
                      <h3>Salary Breakup</h3><br>
                      <input type = "hidden" class =" form-control" name ="tax_compare" id="tax_compare" value ="<?php echo $salary_data['tax_compare']?>" readonly>
                      <label>Basic Salary</label><input type = "number" class ="basic_salary form-control" name="basic_salary" id="basic_salary" value ="<?php echo $salary_data['basic_salary']?>" readonly>
                      <label>House Rent</label><input type = "number" class ="house_rent form-control" name="house_rent" id="house_rent" value ="<?php echo $salary_data['house_rent']?>"  readonly>
                      <label>Food Allowance</label><input type = "number" class ="food form-control" name ="food" id="food" value ="<?php echo $salary_data['food']?>" readonly>
                      <label>Conveyance Allowance</label><input type = "number" class ="conveyance form-control" name="conveyance" id="conveyance" value ="<?php echo $salary_data['conveyance']?>" readonly>
                      <label>Other Allowance</label><input type = "number" class ="other form-control" name="other" id="other" value ="<?php echo $salary_data['other']?>" readonly>
                    <label>Monthly Total</label><input type = "number" class ="total_monthly form-control" name ="monthly_total" id="monthly_total" value = "<?php echo $salary_data['monthly_total']?>" readonly>
                  </div>
                </div>
            </div>
            <div class="form-group">    
                    <button class="btn btn-primary " style="margin-left:10px;">Calculate</button>    
            </div>   
        </form>
    </div>
</div>
        