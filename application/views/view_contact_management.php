<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Contacts</h1>
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
                <table class="table table-bordered" id="transaction">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">S.N</th>

                            <th scope="col">Name</th>
                            <th scope="col">Company</th>
                            <th scope="col">Mobile Number</th></th>
                            <th scope="col">Landline Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $i = 1;
                    foreach($contacts as $contact){?>
                    <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $contact['Name']?></td>
                            <td><?php echo $contact['Company']?></td>
                            <td><?php echo $contact['mobile_number']?></td></th>
                            <td><?php echo $contact['landline_number']?></td>
                            <td><?php echo $contact['Email']?></</td>
                            <td>
                                <a href="<?php echo site_url('user/get_each_contact/'.$contact['id'])?>" class="btn btn-primary">
                                        View Detail
                                </a>
                            </td>
                        </tr>
                    <?php
                    $i++;
                  }
                    ?>
                    </tbody>
                </table>       
            </div>
        </div>
          <!-- Content Row -->
        </div>