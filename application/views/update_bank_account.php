<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Bank Account</h1>
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
    <div class="row container">
        <form class="col-sm-12 update_bank_account_form" action="<?php echo site_url('bankAccount/bank_account_update/'.$account['ID']) ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="hidden" name="id" class="form-control" value ="<?php echo $account['ID']?>">
                    <input type="hidden" name="old_account_no" id="old_account_no" class="form-control" value ="<?php echo $account['account_no']?>">
                </div>
                <div class="form-group">
                    <label>Bank Name</label>
                    <input type="text" name="bank_name" class="form-control" value ="<?php echo $account['bank_name']?>">
                </div>

                <div class="form-group">
                    <label>Account Type</label>
                    <input type="text" name="account_type" class="form-control" value ="<?php echo $account['account_type']?>">
                </div>
                <div class="form-group">
                    <label>Account Number</label>
                    <input type="number" name="account_no" id="account_no" class="form-control" value ="<?php echo $account['account_no']?>">
                </div>
                <div class="form-group">
                    <label>Closing Balance</label>
                    <input type="number" name="closing_balance" class="form-control" value ="<?php echo $account['closing_balance']?>">
                </div>
                <div class="form-group float-right">
                    <button class="btn btn-primary float-left">Edit</button>
                </div>
        </form>
    </>
        <!-- Content Row -->
</div>