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

<div class="row container">
            <form class="col-sm-12 add_contact_form" action="<?php echo site_url();?>contactmanagement/add_contact" method="post"  enctype="multipart/form-data">
            <input type="hidden" name="uploaded_by" class="form-control" value="<?php echo $user_id?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="Name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" name="Company" class="form-control" value= "">
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" name="Designation" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="number" name="mobile_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Landline Number</label>
                        <input type="number" name="landline_number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="Address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Purpose</label>
                        <select name="Purpose">
                          <option value="BUS COMPANY">Bus Company</option>
                          <option value="SEAT SELLER">Seat Seller</option>
                          <option value="MERCHANT">Merchant</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>New Contact?</label>
                        <select name="new_contact">
                          <option value="YES">Yes</option>
                          <option value="NO">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="Status">
                          <option value="LEAD">Lead</option>
                          <option value="NEGOTIATION">Negotiation</option>
                          <option value="CONTRACT SIGNED">Contract Signed</option>
                          <option value="LIVE">Live</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Name of Bus</label>
                        <input type="text" name="name_of_bus" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Number of Bus/es</label>
                        <input type="number" name="number_of_bus" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Number of Seats</label>
                        <input type="number" name="number_of_seat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Live Seats</label>
                        <input type="number" name="live_seat" class="form-control">
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
            <form class="" action="<?php echo site_url();?>spreadsheet/import" method="post" enctype="multipart/form-data">   
                      <td><input type="file" size="40px" name="upload_file" /></td>
                      <input type="submit" value="Import Contact"/></td>
            </form>
        </div>
        
            
        </div>