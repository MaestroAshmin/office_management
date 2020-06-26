<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Income</h1>
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
            <form class="col-sm-12 update_income_form" action="<?php echo site_url('income/income_update/'.$transaction['ID']) ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" class="form-control" value ="<?php echo $transaction['ID']?>">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>English Date</label>
                        <input type="text" id="datepicker" class="form-control"  value ="<?php echo $transaction['english_date']?>" disabled read-only>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nepali Date</label>
                        <input type="text" id="nepali-datepicker" class="form-control"  value ="<?php echo $transaction['nepali_date']?>" disabled read-only>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Heading</label>
                        <input type="text" name="heading" class="form-control" value ="<?php echo $transaction['Heading']?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Bill/Invoice number</label>
                        <input type="text" name="bill_invoice_no" class="form-control" value ="<?php echo $transaction['bill_invoice_no']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Responsible person</label>
                        <input type="text" name="responsible_person" class="form-control" value ="<?php echo $transaction['responsible_person']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>From</label>
                        <input type="text" name="from" class="form-control" value ="<?php echo $transaction['from_person']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control" value ="<?php echo $transaction['Amount']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" value ="<?php echo $transaction['Remarks']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Details</label>
                        <input type="text" name="details" class="form-control" value ="<?php echo $transaction['Details']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Image of Invoice/Bill</label>
                        <input type="file" name="image" class="form-control" id="image" value = "<?php echo $transaction['Image']?>">
                        <img src="<?php echo site_url();?>images/<?php echo $transaction['Image']?>" alt="" title="<?php echo $transaction['Image'] ?>" width="150" height="100" class="img-responsive" />
                    </div>
                    <div class="form-group float-left col-md-12">
                        <button class="btn btn-primary float-left">Edit</button>
                    </div>
                </div>
            </form>
        </>
          <!-- Content Row -->
        </div>