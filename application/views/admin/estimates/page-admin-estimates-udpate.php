<!-- Begin Page Content -->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card-header py-3">
            <h2>Create Estimate</h2>
         </div>
         <div class="card-body">
            <?php if($this->session->flashdata('error')) { ?>
            <div style="width:800px margin: 0 auto;" class="alert alert-warning alert-dismissible fade show" role="alert">
               <?php echo $this->session->flashdata('error');?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <?php } ?>
            <form  action="<?php echo site_url();?>admin/estimates/update/<?php echo $record['quotation_id'];?>"  method="post" enctype="multipart/form-data">
               <div class="container">
                  <div class="col-md-12">
                     <h5>General Details</h5>
                     <hr>

                     <div class="form-group row">
                       <label for="company" class="col-sm-2 col-form-label">Company</label>
                        <select class="form-control col-sm-10 company_list" name="company_name" id="company" required>
                           <option value="">Select Company</option>
                            <?php 
                              if(!empty($companies) && is_array($companies)){
                                foreach($companies as $company){
                            ?>
                              <option <?php if($record['company_id'] == $company['company_id']){ ?> selected="selected" <?php } ?> value="<?php echo $company['company_id'];?>">
                                <?php echo $company['company_name'];?>  
                              </option>
                            <?php 
                                }
                              } 
                            ?>
                        </select>
                     </div>
                     
                     <div class="form-group row">
                        <label for="quotation_number_edit" class="col-sm-2 col-form-label">Quotation Number</label>
                        <input required type="text" class="form-control col-sm-10" id="quotation_number" placeholder="Enter Quotation Number" name="quotation_number" autocomplete="off" value="<?php echo $record['quotation_no'];?>" readonly>
                     </div>

                     <div class="form-group row">
                       <label for="client" class="col-sm-2 col-form-label">Client</label>
                        <select class="form-control col-sm-10" name="client" id="client" required>
                           <option value="">Select Client</option>
                            <?php 
                              if(!empty($clients) && is_array($clients)){
                                foreach($clients as $client){
                            ?>
                              <option <?php if($record['client_id'] == $client['id']){ ?> selected="selected" <?php } ?> value="<?php echo $client['id'];?>">
                                <?php echo $client['client_name'];?>
                              </option>
                            <?php 
                                }
                              } 
                            ?>
                        </select>
                     </div>

                      <div class="form-group row">
                        <label for="quotation_date" class="col-sm-2 col-form-label">Quotation Date</label>
                        <input type="text" class="form-control col-md-10" id="quotation_date" placeholder="Enter Quotation Date" name="quotation_date" autocomplete="off" value="<?php echo $record['quotation_date'];?>" required>
                     </div>

                     <div class="form-group row">
                       <label for="quotation_valid_date" class="col-sm-2 col-form-label">Quotation Valid Date</label>

                        <input type="text" class="form-control col-md-10" id="quotation_valid_date" placeholder="Enter Quotation Date" name="quotation_valid_date" autocomplete="off" value="<?php echo $record['quotation_valid_date'];?>" required>
                     </div>

                     <div class="form-group row">
                        <label for="quotation_subject" class="col-sm-2 col-form-label">Quotation Subject</label>
                        <input type="text" class="form-control col-md-10" id="quotation_subject" placeholder="Enter Quotation Subject" name="quotation_subject" autocomplete="off" value="<?php echo $record['quotation_subject'];?>" required>
                     </div>

                     <div class="form-group row">
                        <label for="quotation_body" class="col-sm-2 col-form-label">Quotation Text</label>
                        <textarea id="quotation_body" name="quotation_body" class="form-control col-md-10" placeholder="Enter Quotation Text" ><?php echo $record['quotation_text'];?></textarea>
                     </div>

                  </div>
               </div>
               <div class="container">
                  <div class="col-md-12">
                     <h5>Items Details</h5>
                     <hr>
                     <?php 
                      $items_name_arr   = stringToArray($record['items_name']);
                      $items_specs_arr  = stringToArray($record['items_specs']);
                      $items_qty_arr    = stringToArray($record['items_qty']);
                      $items_price_arr  = stringToArray($record['items_price']);
                      $items_total_arr  = stringToArray($record['items_total']);
                      $items_id_arr     = stringToArray($record['item_ids']);

                          if(!empty($items_name_arr) && is_array($items_name_arr)){
                            foreach($items_name_arr as $key => $row){
                              if($items_name_arr[$key] != ''){
                    ?>
                      <div class="form-group row qtyform <?php echo ($key == 0) ? 'first-field' : '';?>">
                          <input required type="text" id="item-<?php echo $key+1;?>" class="form-control col-md-2 ml-1 item" name="item_name[]" placeholder="Enter Item Name" value="<?php echo $items_name_arr[$key];?>">

                          <textarea required id="item_desc-<?php echo $key+1;?>" name="item_desc[]" class="form-control item_desc col-md-4 ml-1" placeholder="Item Description"><?php echo $items_specs_arr[$key];?></textarea>

                          <input required type="number" class="form-control col-md-1 ml-1 qty"  placeholder="Qty" name="item_qty[]" autocomplete="off" value="<?php echo $items_qty_arr[$key];?>">

                          <input required type="number" id="item_price-<?php echo $key+1;?>" class="form-control col-md-2 ml-1 item_price"  placeholder="Unit Price" name="unit_price[]" autocomplete="off" value="<?php echo $items_price_arr[$key];?>">

                           <input type="text" class="form-control col-md-1 ml-1 item_total"  placeholder="Total Price" name="item_total[]" autocomplete="off" value="0" readonly value="<?php echo $items_total_arr[$key];?>">

                          <input type="hidden" id="item_id-<?php echo $key+1;?>" class="form-control col-md-3 ml-1 item_id" name="item_id[]" value="<?php echo $items_id_arr[$key];?>">

                          <?php if($key == 0){ ?>
                          <a href="javascript:void(0)" class="col-md-1 ml-1 addMore">
                             <i class="fas fa-plus"></i>
                          </a>
                        <?php }else { ?>
                          <a class="col-md-1 ml-1 remove" href="javascript:void(0)">    
                              <i class="fas fa-times"></i>
                          </a>
                        <?php } ?>
                      </div>
                    <?php
                          }
                        } 
                      } 
                    ?>

                  </div>
               </div>

                <div class="container">
                  <div class="col-md-12">
                        <div class="form-group row">
                          <div class="form-group col-md-9" style="float: right;">
                          </div>
                          <input type="text" class="form-control col-md-2 sub-total" style="float: right;"  placeholder="Sub-Total" name="sub_total" autocomplete="off" value="<?php echo $record['sub_total'];?>" readonly>
                          <div class="form-group col-md-1"></div>
                        </div>

                        <div class="form-group row">
                          <div class="form-group col-md-9"></div>
                          <input type="number" class="form-control col-md-2 discount" style="float: right;"  placeholder="Discount in %" name="discount" autocomplete="off" value="<?php echo $record['discount_percent'];?>">
                          <div class="form-group col-md-1"></div>
                        </div>

                         <div class="form-group row">
                          <div class="form-group col-md-9"></div>
                          <input type="text" class="form-control col-md-2 grand_total" style="float: right;"  placeholder="Total" name="grand_total" autocomplete="off" readonly value="<?php echo $record['total'];?>">
                          <div class="form-group col-md-1"></div>
                        </div>

                  </div>
               </div>

               <input type="hidden" class="form-control" name="id" value="<?php echo $record['quotation_id'];?>">

                <button type="submit" class="btn btn-primary" name="update_quote">Update Quote</button>

            </form>


            <div class="form-group row qtyformCopy" style="display: none;">
            
               <input type="text"  class="form-control col-md-2 ml-1 item" name="item_name[]" placeholder="Enter Item Name">

              <textarea name="item_desc[]" class="form-control col-md-4 ml-1 item_desc" placeholder="Item Description"></textarea>

              <input type="number" class="form-control col-md-1 ml-1 qty"  placeholder="Qty" name="item_qty[]" autocomplete="off" value="1">

              <input type="number" class="form-control col-md-2 ml-1 item_price"  placeholder="Unit Price" name="unit_price[]" autocomplete="off">

               <input type="text" class="form-control col-md-1 ml-1 item_total"  placeholder="Total Price" name="item_total[]" autocomplete="off"  readonly>

               <input type="hidden" class="form-control col-md-3 ml-1 item_id" name="item_id[]">
               
              <a class="col-md-1 ml-1 remove" href="javascript:void(0)">    
                 <i class="fas fa-times"></i>
              </a>
            </div>
             
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
