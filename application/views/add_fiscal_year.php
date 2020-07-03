i<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">View/Add Fiscal Year</h1>
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
    <div class="row">       
         <div class="col-sm-12 col-md-5">
            <form class="add_fiscal_year_form" action="<?php echo site_url();?>tax/add_fiscal_year" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Fiscal Year</label><br>
                    <input type="text" id="fiscal_year" name="fiscal_year" placeholder = "Ex: 2066/067" class="form-control col-sm-7 float-left user_type"><br>
                </div>
                <div class="form-group">
                    <label>Current Fiscal Year?</label></br>
                    <input type="radio" name="current_fy" value="1">
                    <label for="yes">Yes</label><br>
                    <input type="radio" name="current_fy" value="0">
                    <label for="no">No</label>
                </div>
                <div class="form-group">    
                    <button class="btn btn-primary">Add Fiscal Year</button>    
                </div>        
            </form>
         <table class="table" id="table">
                <thead>  
                    <tr>
                        <th scope="col">Fiscal Year</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($fiscal_years as $fy){ ?>
                    <tr>
                        <td><?php echo $fy['fiscal_year']?></td>
                        <td><?php echo $fy['current_fy']==1 ?   '<i class = "fas fa-check"></i>' :'Inactive' ?></td>
                        <td>
                        <a href="<?php echo site_url('tax/edit_fiscal_year/'.$fy['id']) ?>" class="btn btn-primary" style="display: inline-block"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo site_url('tax/delete_fiscal_year/'.$fy['id']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this Fiscal Year? Deleting this Fiscal Year also deletes the tax structure for this year" style="display:inline-block"><i class="fa fa-trash"></i></a>
                        </td>

                    </tr>
                <?php }?>    
                </tbody>
            </table>
        </div>
    </div>
</div>
        