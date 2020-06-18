<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Activity</h1>
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
            <div class="container col-lg-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Entry Date</th>
                            <th scope="col">Task Undertaken</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Added By</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($activity as $act){ ?>
                        <tr>
                            <td scope="col"><?php echo $act['entry_date']?></td>
                            <td scope="col"><?php echo $act['task_undertaken']?></td>
                            <td scope="col"><?php echo $act['progress']?></td>
                            <td scope="col"><?php echo $act['remarks']?></td>
                            <td scope="col"><?php echo $act['name']?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>       
            </div>
        </div>
          <!-- Content Row -->
        </div>