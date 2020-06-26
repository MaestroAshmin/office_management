<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">View/Add</h1>
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
    <div class="row">       
         <div class="col-sm-12 col-md-5">
               
        </div>
    </div>
</div>
        