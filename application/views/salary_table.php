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
                    <label>Employee Name</label>
                    <select id="employee" name="employee" class="form-control">
                        <option value="">---Select Employee---</option>
                        <?php foreach($employees as $employee){?>
                            <option value="<?php echo $employee['id']?>"><?php echo $employee['name']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group col-sm">
                    <label>Select Fiscal Year</label><br>
                    <select id="fiscal_year" class ="form-control" name="fiscal_year">
                        <option value ="">---Select Fiscal Year---</option>
                    </select>
                </div>
                <div class = "form-group col-sm">
                    <label>Select Month</label>
                    <select class="form-control" id="month" name="month">
                        <option value="Shrawan" selected>Shrawan</option>
                        <option value="Bhadra">Bhadra</option>
                        <option value="Ashok">Ashok</option>
                        <option value="Kartik">Kartik</option>
                        <option value="Mangsir">Mangsir</option>
                        <option value="Poush">Poush</option>
                        <option value="Magh">Magh</option>
                        <option value="Falgun">Falgun</option>
                        <option value="Chaitra">Chaitra</option>
                        <option value="Baishak">Baisakh</option>
                        <option value="Jestha">Jestha</option>
                        <option value="Asar">Asar</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class = "form-group col-sm pan-no">
                </div>
                <div class = "form-group col-sm emp-code">
                </div>
                <div class = "form-group col-sm marital-status">
                </div>
            </div>
            <div class = "row salary-breakup">
                <div class ="row col-12 annual-deduction">
                    <h3  class ="col-12">Monthly Deductions</h3>
                    <input type = "hidden" class ="form-control annual_taxable" name = "annual_taxable"></label><br>
    
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Working Days<input type = "number" class ="form-control wd" name = "wd" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Unpaid Leaves<input type = "number" class ="form-control ul" name = "ul" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Previous Advance<input type = "number" class ="form-control pa" name = "pa" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Total Months<input type = "number" class ="form-control total_months" name = "total_months" value = "12"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Insurance<input type = "number" class ="form-control insurance" name="insurance" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Citizen Investment Trust<input type = "number" class ="form-control cit" name = "cit" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Providend Fund<input type = "number" class ="form-control pf" name = "pf" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Social Security<input type = "number" class ="form-control ss" name ="ss" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Total Exemption<input type = "number" class ="form-control te" value = "0" name="te" readonly></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Taxable For Month<input type = "number" class ="form-control taxable_for_month" name ="taxable_for_month" readonly></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Deductions<input type = "number" class ="form-control deductions" name ="deductions" value = "0" readonly></label><br>
                    </div>
                    <div class = "form-group col-md-3">
                        <label class = "control-label" >Total Payable<input type = "number" class ="form-control total_payable" name ="total_payable" value="" readonly></label><br>
                    </div>
                </div>
                <div class ="row col-12 salary-breakup1">
                </div>
            </div>
            <div class="form-group">    
                    <button class="btn btn-primary " style="margin-left:10px;">Calculate</button>    
            </div>   
        </form>
    </div>
</div>
        