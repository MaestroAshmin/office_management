<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Equity</h1>
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
        <form class="col-sm-12 update_equity_form" action="<?php echo site_url('equity/equity_update/'.$transaction['ID']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" class="form-control" value ="<?php echo $transaction['ID']?>">      
            <div class="row">
                <div class="form-group col-md-6">
                    <label>English Date</label>
                    <input type="text" id="datepicker" class="form-control"  value ="<?php echo $transaction['english_date']?>"  disabled read-only>
                </div>
                <div class="form-group col-md-6">
                    <label>Nepali Date</label>
                    <input type="text" id="nepali-datepicker" class="form-control"  value ="<?php echo $transaction['nepali_date']?>" disabled read-only>
                </div>
                <div class="form-group col-md-6">
                    <label>Depositor</label>
                    <input type="text" name="depositor" class="form-control" value ="<?php echo $transaction['Depositor']?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Status</label>
                    <input type="text" name="status" class="form-control" value ="<?php echo $transaction['Status']?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Amount</label>
                    <input type="number" name="amount" class="form-control" value ="<?php echo $transaction['Amount']?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Remarks</label>
                    <input type="text" name="remarks" class="form-control" value ="<?php echo $transaction['Remarks']?>">
                </div>
                <div class="form-group col-md-12 float-right">
                    <button class="btn btn-primary float-left">Edit</button>
                </div>
            </div>
        </form>
    </>
        <!-- Content Row -->
</div>