<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>Edit Client</h2>       
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

        <form name="item_from_update" action="<?php echo site_url();?>admin/items/update/<?php echo $record['item_id'];?>" class="item_from_update" method="post" enctype="multipart/form-data">

          
            <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" id="item_name" placeholder="Enter Item Name" name="item_name" autocomplete="off" value="<?php echo $record['item_name'];?>">
          </div>

          <div class="form-group item_specification">
            <label for="item_specification">Item Specification</label>
            <textarea name="item_specification" id="item_specification" class="form-control item_specification" placeholder="Enter Item Specification"><?php echo $record['item_specs'];?></textarea>
          </div>

          <div class="form-group">
            <label for="item_type">Item Type</label>
            <select class="form-control" name="item_type" id="item_type">
              <option value="">Select</option>
              <option value="product" <?php if($record['item_type'] == 'product'){?> selected="selected"<?php } ?>>
                Product
              </option>
              <option value="service" <?php if($record['item_type'] == 'service'){?> selected="selected"<?php } ?>>
                Service
              </option>
            </select>
          </div>

          <div class="form-group">
            <label for="item_brand">Item Brand</label>
            <input type="text" name="item_brand" id="item_brand" class="form-control item_brand" placeholder="Enter Item Brand" value="<?php echo $record['item_brand'];?>">
          </div>

          <div class="form-group">
            <label for="item_model">Item Model</label>
            <input type="text" name="item_model" id="item_model" class="form-control item_model" placeholder="Enter Item Model" value="<?php echo $record['item_model'];?>">
          </div>


           <div class="form-group">
            <label for="item_price">Price</label>
             <input type="text" class="form-control" id="item_price" placeholder="Enter Item Price" name="item_price" autocomplete="off" value="<?php echo $record['item_price'];?>">
          </div>

          <div class="form-group">
            <?php 
              if($record['item_image'] != ''){
                $img_url = site_url().'img/items/'.$record['item_image'];
              }else{
                $img_url = site_url('img/image-not-found.png');
              }
            ?>
            <img src="<?php echo $img_url;?>" width="150px" height="120px">
          </div>

          <div class="form-group">
            <label for="item_image">Image</label>
            <input type="file" name="userfile" class="form-control" id="item_image">
            (Note: Please upload the image of 150 * 120 px)
          </div>


           <div class="form-group">
            <label for="item_status">Status</label>
            <select class="form-control" name="item_status">
              <option value="">Select</option>
              <option value="1" <?php if($record['item_status'] == "1"){?> selected="selected" <?php } ?>>Active</option>
              <option value="0" <?php if($record['item_status'] == "0"){?> selected="selected" <?php } ?>>Inactive</option>
            </select>
          </div>

          <input type="hidden" name="id" value="<?php echo $record['item_id'];?>" class="form-control">
          <input type="hidden" name="old_item_image" value="<?php echo $record['item_image'];?>" class="form-control">

          <button type="submit" class="btn btn-primary" name="udpate_item">Update Item</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->