<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Targets</h1>
          </div>

            <style>
            thead input {
                    width: 100%;
                }
                </style>
          <!-- Content Row -->
        <div class="row">
            <div class="swipe-loader"></div>
            <div class="container table-responsive drag-scroll">
                <table class="table table-bordered" id="transaction">
                    <thead class="thead-dark">
                        <tr>
                        <th>S.N</th>
                        <th style="width:500px;">Title</th>
                        <th style="width:250px;">Assigned To</th>
                        <th>For month</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i=1;
                    foreach($targets as $target){?>
                        <tr>
                        <td><?php echo $i ?> </td>
                            <td><?php echo $target['title']?></td>
                            <td><?php echo $target['name']?></td>
                            <td><?php echo $target['for_month']?></td>
                            <td>
                                <a href="<?php echo site_url('user/get_each_target/'.$target['t_id'])?>" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                    $i++;
                    }?>
                    </tbody>
                </table>       
            </div>
        </div>
          <!-- Content Row -->
        </div>

        