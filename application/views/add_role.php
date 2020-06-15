<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">View User Type</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
         <div class="col-sm-12 col-md-5">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <td colspan="2">
                            <form action="<?php echo site_url();?>user/add_role" method="post" enctype="multipart/form-data">
                                <input type="text" name="user_type" class="form-control col-sm-7 float-left">                              
                                    <button class="btn btn-primary" style="margin-left:10px;">Add</button>            
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
                            <a href="<?php echo site_url('user/delete_role/'.$role['role_id']) ?>" class="delete btn btn-danger" data-confirm="Are you sure to delete this item?" style="display:inline-block">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>       
        </div>
    </div>
</div>
        