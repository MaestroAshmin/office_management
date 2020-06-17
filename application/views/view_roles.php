<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View User</h1>
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
            <div class="container table-responsive drag-scroll">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role Type</th>
                            <th scope="col" width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($roles as $role){ ?>
                        <tr>
                            <td><?php echo $role['name']?></td>
                            <td><?php echo $role['email']?></td>
                            <td><?php echo $role['user_type']?> <?php echo $role['Designation'] ? ' - '.$role['Designation'] : '' ?></td>
                            <td style="display: inline-block; width: 150px;">
                                <a href="<?php echo site_url('user/update_user/'.$role['id']) ?>" class="btn btn-primary" style="display: inline-block"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo site_url('user/delete_user/'.$role['id']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?" style="display:inline-block"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php } ?>    
                    </tbody>
                </table>       
            </div>
        </div>
          <!-- Content Row -->
        </div>