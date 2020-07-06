<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Equity</h1>
          </div>
          <?php
            if($this->session->flashdata("error"))
            {
                foreach($this->session->flashdata("error") as $error){
                    echo '<p class="error">*'.$error.'</p>';
                }
            }
          ?>
          <!-- Content -->
        <div class="row col-12 container">
            <form class="col-sm-12 add_equity_form" action="<?php echo site_url();?>equity/equity_store" method="post">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>English Date</label>
                        <input type="text" id="from_date" name="eng_date" class="form-control eng_date" value="" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nepali Date</label>
                        <input type="text" id="nepali-datepicker" name="nepali_date" class="form-control nepali_date" value= "" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Depositor</label>
                        <input type="text" name="depositor" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <input type="text" name="status" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control">
                    </div>
                    <div class="form-group col-md-12 float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
                </div>
            </form>
        </div>
          <!-- Content -->
</div>