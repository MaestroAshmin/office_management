<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-md-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Update Contact</h1>
          </div>

          <?php
            if($this->session->flashdata("error"))
            {
                foreach($this->session->flashdata("error") as $error){
                    echo '<p class="error">*'.$error.'</p>';
                }
            }
          ?>
<div class="form-group">
                        <div class="row">
                            <div class="col-md">
                                <label> Name : </label> <?php echo $contact['Name']?>
                            </div>
                            <div class="col-md">
                                <label>Designation : </label> <?php echo $contact['Designation']?>  
                            </div>
                            <div class="col-md">
                                <label>Company : </label> <?php echo $contact['Company']?>  
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-md">
                                <label>Address : </label> <?php echo $contact['Address']?> 
                            </div>
                            <div class="col-md">
                                <label> Email : </label> <?php echo $contact['Email']?>
                            </div>
                            <div class="col-md">
                                <label>Purpose : </label> <?php echo $contact['Purpose']?>  
                            </div>
                        </div>  
                        <div class="row">
                        <div class="col-md">
                                <label>Mobile : </label> <?php echo $contact['mobile_number']?>  
                            </div>
                            <div class="col-md">
                                <label>Landline : </label> <?php echo $contact['landline_number']?> 
                            </div>
                            <div class="col-md">
                                <label>Bus Name : </label> <?php echo $contact['name_of_bus']?>  
                            </div>
                        </div>
                        <div class= "row">
                            <div class="col-md">
                                <label>Number of Bus : </label> <?php echo $contact['number_of_bus']?> 
                            </div>
                            <div class="col-md">
                                <label>Purpose : </label> <?php echo $contact['Purpose']?> 
                            </div>
                    </div>
                        </div>
                           
            <form class="col-md-12 add_contact_form" action="<?php echo site_url();?>contactmanagement/edit_status" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="uploaded_by" class="form-control" value="<?php echo $user_id?>">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $contact['id']?>">
                   
                    <div class="form-group">
                        <label>New Contact?</label>
                        <select name="new_contact">
                          <option value="YES" <?php echo ($contact['new_contact'] == 'YES') ? 'selected' : '' ?>>Yes</option>
                          <option value="NO" <?php echo ($contact['new_contact'] == 'NO') ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="Status">
                          <option value="LEAD" <?php echo ($contact['Status'] == 'LEAD') ? 'selected' : '' ?>>LEAD</option>    
                          <option value="NEGOTIATION" <?php echo ($contact['Status'] == 'NEGOTIATION') ? 'selected' : '' ?>>Negotiation</option>   
                          <option value="CONTRACT SIGNED" <?php echo ($contact['Status'] == 'CONTRACT SIGNED') ? 'selected' : '' ?>>Contract Signed</option>
                          <option value="LIVE" <?php echo ($contact['Status'] == 'LIVE') ? 'selected' : '' ?>>Live</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Number of Bus/es</label>
                        <input type="number" name="number_of_bus" class="form-control" value = "<?php echo $contact['number_of_bus']?>">
                    </div>
                    <div class="form-group">
                        <label>Number of Seats</label>
                        <input type="number" name="number_of_seat" class="form-control" value = "<?php echo $contact['number_of_seat']?>">
                    </div>
                    <div class="form-group">
                        <label>Live Seats</label>
                        <input type="number" name="live_seat" class="form-control"value = "<?php echo $contact['live_seat']?>">
                    </div>
                    <div class = "form-group">
                        <label>Follow Up</label><br>
                        <label>Follow Up Round</label>
                        <input type="number" name="follow_up_round" class="form-control"><br>
                        <label>Follow Up Date</label>
                        <input type ="text" name = "date" id = "nepali-datepicker" class= "form-control">
                    </div>
                    <div class = "form-group">
                    <table class="table table-follow-up table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Follow Up Round</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($follow_ups as $follow_up) {?>
                                        <tr>
                                            <td><?php echo $follow_up['follow_up_round']?></td>
                                            <td><?php echo $follow_up['date']?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Update</button>
                    </div>
            </form>
        </div>
        
            