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
            <form class="add_user_form" action="<?php echo site_url();?>user/add_target" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Assigned To</label>
                        <div>
                            <select class="form-control" id="assigned_to" name="assigned_to">
                                <option selected value> -- Select Person -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>For Month</label>
                        <div>
                            <select class="form-control" id="for_month" name="for_month">
                                <option selected value> -- Select Month -- </option>
                                <option value="Baisakh">Baisakh</option>
                                <option value="Jestha">Jestha</option>
                                <option value="Asar">Asar</option>
                                <option value="Shrawan">Shrawan</option>
                                <option value="Bhadra">Bhadra</option>
                                <option value="Ashoj">Ashoj</option>
                                <option value="Kartik">Kartik</option>
                                <option value="Mangsir">Mangsir</option>
                                <option value="Poush">Poush</option>
                                <option value="Magh">Magh</option>
                                <option value="Falgun">Falgun</option>
                                <option value="Chaitra">Chaitra</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
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

                    <div class="form-group">
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

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <label>Meetings</label>
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

                    <div class="form-group">
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
                                <label>Bus Company</label>
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

                    <div class="form-group d-flex justify-content-center">
                        <button class="btn btn-primary float-left">Add</button>
                    </div>
            </form>
          <!-- Content Row -->
        </div>