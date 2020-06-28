i<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Fiscal Year</h1>
    </div>
    <?php
            if($this->session->flashdata("error"))
            {
                    echo '<p class="error">*'.$this->session->flashdata("error").'</p>';
            }
    ?>
    <!-- Content Row -->
    <div class="row">       
         <div class="col-sm-12 col-md-5">
            <form class="add_role_form" action="<?php echo site_url();?>tax/edit_fiscal_year" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Fiscal Year</label><br>
                    <input type="text" id="fiscal_year" name="fiscal_year" value="<?php echo $fy['fiscal_year']?>" class="form-control col-sm-7 float-left user_type"><br>
                </div>
                <div class="form-group">
                    <label>Current Fiscal Year?</label></br>
                    <input type="radio" name="current_fy" value="1" <?php echo $fy['current_fy'] == 1 ? 'checked' : '' ?>>
                    <label for="yes">Yes</label><br>
                    <input type="radio" name="current_fy" value="0" <?php echo $fy['current_fy'] == 0 ? 'checked' : '' ?>>
                    <label for="no">No</label><br>
                </div>
                <div class="form-group">    
                    <button class="btn btn-primary" style="margin-left:10px;">Edit Fiscal Year</button>    
                </div>        
            </form>
        </div>
    </div>
</div>
        