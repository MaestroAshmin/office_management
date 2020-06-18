<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Contact</h1>
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
            <form class="add_user_form" action="<?php echo site_url();?>spreadsheet/import" method="post" enctype="multipart/form-data">
            <table align="center" cellpadding = "5">
            <tr>
            <td>File :</td>
            <td><input type="file" size="40px" name="upload_file" /></td>
            <td colspan="5" align="center">
            <input type="submit" value="Import Users"/></td>
            </tr>
                    
            </form>
          <!-- Content Row -->
        </div>