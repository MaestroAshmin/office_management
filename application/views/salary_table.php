<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Salary Table</h1>
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
            <div class="form-group">
                <label>Salary Table</label><br>

            </div>  
            <div>
                <table class="table table-bordered">
                        <thead class="thead-dark">
                        </thead>
                        <tbody>   
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        