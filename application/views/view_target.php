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
            <div class="container col-lg-12">
                <table class="table table-bordered" id="target" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Assigned To</th>
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
                                        View Detail
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

        