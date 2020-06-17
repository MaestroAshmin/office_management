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
            <form class="add_user_form" action="#" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Assigned To : </label> <?php echo $target['name']?>
                    </div>
                    <div class="form-group">
                        <label>For Month : </label> <?php echo $target['for_month']?>
            
                    </div>
                    <div class="form-group">
                        <label>Title : </label> <?php echo $target['title']?>    
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
                                <?php echo $target['nc_seat_seller_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nc_seat_seller_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nc_seat_seller_monthly'] ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Bus Company</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['nc_bus_company_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nc_bus_company_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nc_bus_company_monthly'] ?> 
                            </div>
                        </div><div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['nc_merchant_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nc_merchant_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nc_merchant_monthly'] ?>   
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
                                <?php echo $target['fu_seat_seller_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['fu_seat_seller_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['fu_seat_seller_monthly'] ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Bus Company</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['fu_bus_company_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['fu_bus_company_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['fu_bus_company_monthly'] ?> 
                            </div>
                        </div><div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['fu_merchant_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['fu_merchant_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['fu_merchant_monthly'] ?>   
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm">
                                <label>Meeting</label>
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
                                <?php echo $target['m_seat_seller_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['m_seat_seller_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['m_seat_seller_monthly'] ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Bus Company</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['m_bus_company_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['m_bus_company_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['m_bus_company_monthly'] ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['m_merchant_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['m_merchant_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['m_merchant_monthly'] ?>   
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
                                <?php echo $target['nl_seat_seller_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nl_seat_seller_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nl_seat_seller_monthly'] ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Number of Seats</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['nl_no_of_seats_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nl_no_of_seats_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nl_no_of_seats_monthly'] ?> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label>Merchant</label>
                            </div>
                            <div class="col-sm">
                                <?php echo $target['nl_merchant_daily'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nl_merchant_weekly'] ?> 
                            </div>
                            <div class="col-sm">
                            <?php echo $target['nl_merchant_monthly'] ?>   
                            </div>
                        </div>
                    </div>
            </form>
          <!-- Content Row -->
        </div>