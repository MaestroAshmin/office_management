<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">View/Add Role</h1>
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
            <table class="table" id="table-role">   
                <thead>
                    <tr>
                        <td colspan="2">
                            <form class="add_role_form" action="<?php echo site_url();?>user/add_role" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" id="user_type" name="user_type" class="form-control col-sm-7 float-left user_type">                              
                                    <button class="btn btn-primary" style="margin-left:10px;">Add</button>    
                                </div>        
                            </form>
                        </td>
                    </tr> 
                    <tr>
                        <th scope="col">User Type</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($roles as $role){ ?>
                    <tr>
                        <td><?php echo $role['user_type']?></td>
                        <td class="text-center">
                        <?php 
                            if($role["role_id"]==2 || $role["role_id"]==3){
                        ?>
                                <button class="btn btn-danger" disabled>Delete</button>
                        <?php
                            }
                            else{
                        ?>
                                <a href="<?php echo site_url('user/delete_role/'.$role['role_id']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?" style="display:inline-block">Delete</a>
                        <?php
                            }
                        ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>       
        </div>
    </div>
</div>
        