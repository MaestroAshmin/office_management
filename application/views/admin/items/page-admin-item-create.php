<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      

       <div class="card-header py-3">
          <h2>Create New Item</h2>       
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

        <form name="items_form_create" action="<?php echo site_url();?>admin/items/create" class="items_form_create" method="post" enctype="multipart/form-data">

           <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" id="item_name" placeholder="Enter Item Name" name="item_name" autocomplete="off">
          </div>

          <div class="form-group">
            <label for="item_specification">Item Specification</label>
            <textarea name="item_specification" id="item_specification" class="form-control item_specification" placeholder="Enter Item Specification"></textarea>
          </div>

          <div class="form-group">
            <label for="item_type">Item Type</label>
            <select class="form-control" name="item_type" id="item_type">
              <option value="">Select</option>
              <option value="product">Product</option>
              <option value="service">Service</option>
            </select>
          </div>

          <div class="form-group">
            <label for="item_brand">Item Brand</label>
            <input type="text" name="item_brand" id="item_brand" class="form-control item_brand" placeholder="Enter Item Brand">
          </div>

          <div class="form-group">
            <label for="item_model">Item Model</label>
            <input type="text" name="item_model" id="item_model" class="form-control item_model" placeholder="Enter Item Model">
          </div>

           <div class="form-group">
            <label for="item_price">Price</label>
             <input type="text" class="form-control" id="item_price" placeholder="Enter Item Price" name="item_price" autocomplete="off">
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
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          
         
          <button type="submit" class="btn btn-primary" name="create_item">Create Item</button>
        </form>
    </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->