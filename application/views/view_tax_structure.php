<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View/Edit Structure</h1>
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
            <form class="edit_tax_form" action="<?php echo site_url();?>tax/edit_tax_structure" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Select Fiscal Year</label><br>
                    <select id= "fiscal_years" name= "fiscal_year">
                        <option value ="">---Select Fiscal Year---</option>
                        <?php foreach($fiscal_years as $fy){?>   
                            <option value="<?php echo $fy['id']?>">Fiscal Year - <?php echo $fy['fiscal_year']?></option>
                        <?php }?>
                    </select>
                </div>  
                <div>
                    <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope ="col">Tax %</th>
                                    <th scope ="col">Marital Status</th>
                                    <th scope ="col">Amount</th>
                                    <th scope ="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>   
                            </tbody>
                    </table>
                </div>
                <div class="form-group">    
                    <button class="btn btn-primary" style="margin-left:10px;">Edit</button>    
                </div>        
            </form>
        </div>
    </div>
</div>

        