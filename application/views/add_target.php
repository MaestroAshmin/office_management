<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Target</h1>
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
            <form class="add_target_form" action="<?php echo site_url();?>user/add_target" method="post" enctype="multipart/form-data">
            <input type="radio" id="sales-marketing" name="employee" value="sales">
            <label for="sales&marketing">Sales & Marketing</label><br>
            <input type="radio" id="other" name="employee" value ="other">
            <label for="other">Other</label><br>
                <div class="row sales-form">
                    <div class="form-group col-md-6">
                    <input type="hidden"    name="assigned_by" value="<?php echo $user_id?>">
                        <label>Assigned To</label>
                        
                        <div>
                            <select class="form-control" id="assigned_to" name="assigned_to">
                                <option value="">--- Select Person ---</option>
                                <?php
                                    foreach($management_role as $m){
                                ?>
                                    <option value="<?php echo $m['id'] ?>"><?php echo $m['name'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>For Month</label>
                        <div>
                            <select class="form-control" id="for_month" name="for_month">
                                <option value="01">Baisakh</option>
                                <option value="02">Jestha</option>
                                <option value="03">Asar</option>
                                <option value="04">Shrawan</option>
                                <option value="05">Bhadra</option>
                                <option value="06">Ashoj</option>
                                <option value="07">Kartik</option>
                                <option value="08">Mangsir</option>
                                <option value="09">Poush</option>
                                <option value="10">Magh</option>
                                <option value="11">Falgun</option>
                                <option value="12">Chaitra</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="col-sm">
                                <label>New Contact</label>
                            </div>
                            <div class="col-sm">
                                Daily   
                            </div>
                            <div class="col-sm">
                                Weekly
                            </div>
                            <div class="col-sm">
                                Monthly
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-sm">
                                <label>Seat Seller</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_seat_seller_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_seat_seller_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_seat_seller_monthly" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Bus Company</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_bus_company_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_bus_company_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_bus_company_monthly" class="form-control">
                            </div>
                        </div><div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_merchant_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_merchant_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nc_merchant_monthly" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="col-sm">
                                <label>Follow Up</label>
                            </div>
                            <div class="col-sm">
                                Daily   
                            </div>
                            <div class="col-sm">
                                Weekly
                            </div>
                            <div class="col-sm">
                                Monthly
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-sm">
                                <label>Seat Seller</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_seat_seller_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_seat_seller_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_seat_seller_monthly" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Bus Company</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_bus_company_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_bus_company_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_bus_company_monthly" class="form-control">
                            </div>
                        </div><div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_merchant_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_merchant_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="fu_merchant_monthly" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="col-sm">
                                <label>New contract</label>
                            </div>
                            <div class="col-sm">
                                Daily   
                            </div>
                            <div class="col-sm">
                                Weekly
                            </div>
                            <div class="col-sm">
                                Monthly
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-sm">
                                <label>Seat Seller</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_seat_seller_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_seat_seller_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_seat_seller_monthly" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Bus Company</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_bus_company_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_bus_company_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_bus_company_monthly" class="form-control">
                            </div>
                        </div><div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_merchant_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_merchant_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="m_merchant_monthly" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="col-sm">
                                <label>New Live</label>
                            </div>
                            <div class="col-sm">
                                Daily   
                            </div>
                            <div class="col-sm">
                                Weekly
                            </div>
                            <div class="col-sm">
                                Monthly
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-sm">
                                <label>Seat Seller</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_seat_seller_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_seat_seller_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_seat_seller_monthly" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Number of Seats</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_no_of_seats_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_no_of_seats_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_no_of_seats_monthly" class="form-control">
                            </div>
                        </div><div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_merchant_daily" class="form-control">   
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_merchant_weekly" class="form-control">
                            </div>
                            <div class="col-sm">
                                <input type="number" name="nl_merchant_monthly" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 d-flex justify-content-center">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
                </div>
                <div class ="col other-form">
                    <div class="form-group">
                    <input type="hidden"    name="assigned_by" value="<?php echo $user_id?>">
                        <label>Assigned To</label>
                        
                        <div>
                            <select class="form-control" id="assigned_to_other" name="assigned_to_other">
                                <option value="">--- Select Person ---</option>
                                <?php
                                    foreach($other as $o){
                                ?>
                                    <option value="<?php echo $o['id'] ?>"><?php echo $o['name'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <label for ="date">Date</label>
                            <input type="text"   autocomplete="off" class ="form-control date" name ="date" id="nepali-datepicker">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>For Month</label>
                        <div>
                            <select class="form-control" id="for_month2" name="for_month2">
                                <option value="01">Baisakh</option>
                                <option value="02">Jestha</option>
                                <option value="03">Asar</option>
                                <option value="04">Shrawan</option>
                                <option value="05">Bhadra</option>
                                <option value="06">Ashoj</option>
                                <option value="07">Kartik</option>
                                <option value="08">Mangsir</option>
                                <option value="09">Poush</option>
                                <option value="10">Magh</option>
                                <option value="11">Falgun</option>
                                <option value="12">Chaitra</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Task Details</label>
                        <textarea name="task_details" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea name="remarks" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group float-right">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
                </div>
            </form>
          <!-- Content Row -->
        </div>