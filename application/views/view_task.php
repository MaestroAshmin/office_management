<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View</h1>
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
            <div class = "d-flex flex-column">
                <div class = "row">
                <label><h5>Added By:</h5> </label> <?php echo $target['name']?>
                </div>
                <div class = "row">
                <label><h5>Entry Date:</h5> </label> <?php echo $target['entry_date']?>
                </div>
                <div class = "row">
                <label><h5>Task Undertaken:</h5> </label> <?php echo $target['task_undertaken']?>
                </div>
                <div class = "row">
                <label><h5>Progress:</h5> </label> <?php echo $target['progress']?>
                </div>
                <div class = "row">
                <label><h5>Remarks:</h5> </label> <?php echo $target['remarks']?>
                </div>
            </div>
          <!-- Content Row -->
        </div>