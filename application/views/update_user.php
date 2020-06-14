<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add</h1>
          </div>

          <!-- Content Row -->
        <div class="row">
            <form action="<?php echo site_url();?>user/update_user/<?php echo $user_data['id']?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" class="form-control" value ="<?php echo $user_data['id']?>">
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value ="<?php echo $user_data['name']?>">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value ="<?php echo $user_data['email']?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value ="">
                    </div>
                    <div class="form-group">
                        <label>User Type</label>
                        <select id="user_type" name="user_type">
                        <?php foreach ($roles as $role) {?>
                            <option value ="<?php echo $role['role_id']?>" <?php echo ($role['role_id'] == $user_data['role']) ? 'selected' : ''; ?>><?php echo $role['user_type']?></option>
                        <?php }?>
                        </select>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
        </>
          <!-- Content Row -->
        </div>