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
                <label><h5>Assigned by: </h5> </label> <?php echo $assigned_by['name']?>
                </div>
                <div class = "row">
                <label><h5>Assigned to:</h5> </label> <?php echo $target['name']?>
                </div>
                <div class = "row">
                <label><h5>Assigned at:</h5> </label> <?php echo $target['date']?>
                </div>
                <div class = "row">
                <label><h5>Title:</h5> </label> <?php echo $target['title']?>
                </div>
                <div class = "row">
                <label><h5>Task Details:</h5> </label> <?php echo $target['task_details']?>
                </div>
                <div class = "row">
                <label><h5>Remarks:</h5> </label> <?php echo $target['remarks']?>
                </div>
            </div>
          <!-- Content Row -->
        </div>