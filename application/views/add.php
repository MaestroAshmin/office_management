<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add</h1>
          </div>
          <!-- Content Row -->
        <!-- <div class="row"> -->
            <form action="<?php echo site_url();?>user/store" method="post" class="user_add_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>English Date</label>
                        <input type="text" id="from_date" name="eng_date" class="form-control eng_date" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nepali Date</label>
                        <input type="text" id="nepali-datepicker" name="nepali_date" class="form-control nepali_date" value= "" readonly>
                    </div>
                    <div class="form-group">
                        <label>Heading</label>
                        <input type="text" name="heading" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Bill/Invoice number</label>
                        <input type="text" name="bill_invoice_no" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Responsible person</label>
                        <input type="text" name="responsible_person" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <input type="text" name="to" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Details</label>
                        <input type="text" name="details" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Image of Invoice/Bill</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <div class="form-group">
                        <label>Upload Excel File</label>
                        <input type="file" name="excel_file" class="form-control" id="excel">
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
        <!-- </div> -->
          <!-- Content Row -->
</div>