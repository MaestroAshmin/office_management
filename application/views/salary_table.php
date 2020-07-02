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
                    <select id= "fiscal_year" class = "form-control" name= "fiscal_year">
                        <option value ="">---Select Fiscal Year---</option>
                        <?php foreach($fiscal_years as $fy){?>   
                            <option value="<?php echo $fy['id']?>">Fiscal Year - <?php echo $fy['fiscal_year']?></option>
                        <?php }?>
                    </select>
                </div>
                <div class = "form-group col-sm">
                    <label>Select Month</label>
                    <select class="form-control" id="month" name="month">
                        <option value="01" selected>Baisakh</option>
                        <option value="02">Jestha</option>
                        <option value="03">Asar</option>
                        <option value="04">Shrawan</option>
                        <option value="05">Bhadra</option>
                        <option value="06">Ashoj</option>
                        <option value="07">Kartik</option>
                        <option value="08">Mangsir</option>
                        <option value="09">Poush</option>
                        <option value="10">Magh</option>
                        <option value="11">Falgun</option>
                        <option value="12">Chaitra</option>
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
                    <!-- <div class = "form-group col-md-3">
                        <label class = "control-label" >Taxable For Selected Month<input type = "number" class ="form-control annual_tax_exemption" name ="annual_tax_exemption" readonly></label><br>
                    </div> -->
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
            </div>
            <div class="form-group">    
                    <button class="btn btn-primary " style="margin-left:10px;">Calculate</button>    
            </div>   
        </form>
    </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tax Sheet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tax-data form-row">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->
        