<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Bank Account</h1>
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
            <form class="row col-sm-12 add_bank_account_form" action="<?php echo site_url();?>bankAccount/account_store" method="post">
                    <div class="form-group col-md-6">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Account Type</label>
                        <input type="text" name="account_type" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Account Number</label>
                        <input type="number" name="account_no" id="account_no" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Closing Balance</label>
                        <input type="text" name="closing_balance" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
        </div>
          <!-- Content -->
</div>