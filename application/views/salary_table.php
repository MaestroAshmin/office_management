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
    <div class="container">       
        <form class="salary-sheet" action="calculate_tax" method="post"  enctype="multipart/form-data">
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
                    <select id= "fiscal_years" class = "form-control" name= "fiscal_year">
                        <option value ="">---Select Fiscal Year---</option>
                        <?php foreach($fiscal_years as $fy){?>   
                            <option value="<?php echo $fy['id']?>">Fiscal Year - <?php echo $fy['fiscal_year']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class = "form-group col-sm">
                    <label class = "control-label" >No. of Months<input type = "number" class ="form-control no_of_months" value = "0"></label><br>
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
                <div class ="form-group col-sm annual-deduction">
                    <h3>Annual Deductions</h3>
                    <div class = "form-group col-sm">
                        <label class = "control-label" >Insurance<input type = "number" class ="form-control insurance" name="insurance" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-sm">
                        <label class = "control-label" >Citizen Investment Trust<input type = "number" class ="form-control cit" name = "cit" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-sm">
                        <label class = "control-label" >Providend Fund<input type = "number" class ="form-control pf" name = "pf" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-sm">
                        <label class = "control-label" >Social Security<input type = "number" class ="form-control ss" name ="ss" value = "0"></label><br>
                    </div>
                    <div class = "form-group col-sm">
                        <label class = "control-label" >Total Exemption<input type = "number" class ="form-control te" value = "0" name="te" readonly></label><br>
                    </div>
                    <div class = "form-group col-sm">
                        <label class = "control-label" >Annual Tax Exemption<input type = "number" class ="form-control annual_tax_exemption" name ="annual_tax_exemption" readonly></label><br>
                    </div>
                </div>
            </div>
            <div class="form-group">    
                    <button class="btn btn-primary " style="margin-left:10px;">Calculate</button>    
            </div>   
        </form>
    </div>
</div>

        