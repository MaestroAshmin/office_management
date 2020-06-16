<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Contact</h1>
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
            <form class="add_user_form" action="<?php echo site_url();?>user/add_contact" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" name="company" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="number" name="designation" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="number" name="mobile_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Landline Number</label>
                        <input type="number" name="landline" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Purpose</label>
                        <div>
                            <select id="purpose" name="purpose">
                                <option value ="Bus Provider">Bus Provider</option>
                                <option value ="Seat Seller">Seat Seller</option>
                                <option value ="Merchant">Merchant</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name of Bus</label>
                        <input type="text" name="bus_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Number of Bus</label>
                        <input type="number" name="number_of_bus" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Number of Seats</label>
                        <input type="number" name="number_of_seats" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Change Status</label>
                        <div>
                            <select id="status" name="status">
                                <option value ="Contract Signed">Contract Signed</option>
                                <option value ="Live">Live</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Follow up Round</label>
                        <div>
                            <select id="status" name="status">
                                <option value ="Contract Signed">Contract Signed</option>
                                <option value ="Live">Live</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
          <!-- Content Row -->
        </div>