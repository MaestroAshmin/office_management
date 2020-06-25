<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View</h1>
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <label> Name : </label> <?php echo $contact['Name']?>
                            </div>
                            <div class="col-sm">
                                <label>Designation : </label> <?php echo $contact['Designation']?>  
                            </div>
                            <div class="col-sm">
                                <label>Company : </label> <?php echo $contact['Company']?>  
                            </div>
                            <div class="col-sm">
                                <label>Address : </label> <?php echo $contact['Address']?> 
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-sm">
                                <label> Email : </label> <?php echo $contact['Email']?>
                            </div>
                            <div class="col-sm">
                                <label>Purpose : </label> <?php echo $contact['Purpose']?>  
                            </div>
                            <div class="col-sm">
                                <label>Mobile : </label> <?php echo $contact['mobile_number']?>  
                            </div>
                            <div class="col-sm">
                                <label>Landline : </label> <?php echo $contact['landline_number']?> 
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-sm">
                                <label> New Contact : </label> <?php echo $contact['new_contact']?>
                            </div>
                            <div class="col-sm">
                                <label>Status : </label> <?php echo $contact['Status']?>  
                            </div>
                            <div class="col-sm">
                                <label>Bus Name : </label> <?php echo $contact['name_of_bus']?>  
                            </div>
                            <div class="col-sm">
                                <label>Number of Bus : </label> <?php echo $contact['number_of_bus']?> 
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-sm">
                                <label> Number of Seat : </label> <?php echo $contact['number_of_seat']?>
                            </div>
                            <div class="col-sm">
                                <label>Uploaded by : </label> <?php echo $contact['name']?>  
                            </div>
                        </div> 
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
          <!-- Content Row -->
</div>