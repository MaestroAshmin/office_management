<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Salary Sheet</h1>
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
            <div>
                <div class = "form-group col-sm-4">
                    <label>Employee Name</label>
                    <select id="employee">
                        <option value="">---Select Employee---</option>
                        <?php foreach($employees as $employee){?>
                            <option value="<?php echo $employee['id']?>"><?php echo $employee['name']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

        