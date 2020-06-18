<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Daily Task</h1>
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
            <form class="add_activity_form" action="<?php echo site_url();?>user/add_daily_task" method="post" enctype="multipart/form-data">
            <input type ="hidden" name ="user_id" id="user_id" value="<?php echo $user_id?>">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" name="entry_date" id="join_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Task Undertaken</label>
                        <textarea name="task_undertaken" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Progress</label>
                        <textarea name="progress" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea name="remarks" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
          <!-- Content Row -->
        </div>