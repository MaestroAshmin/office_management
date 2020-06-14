<form action="<?php echo site_url();?>admin/process/request" method="post" class="process_request">
  <table class="table">
    <tr>
      <td><b>Request Date:</b></td>
      <td><?php echo $request_date;?></td>
    </tr>
    <tr>
      <td><b>Request By:</b></td>
      <td><?php echo $name;?></td>
    </tr>
    <tr>
      <td><b>Ticket Number:</b></td>
      <td><?php echo $ticket_number;?></td>
    </tr>
    <tr>
      <td><b>Start Reading:</b></td>
      <td><?php echo $start;?></td>
    </tr>
    <tr>
      <td><b>End Reading:</b></td>
      <td><?php echo $end;?></td>
    </tr>
    <tr>
      <td><b>From Address:</b></td>
      <td><?php echo $from;?></td>
    </tr>
    <tr>
      <td><b>To Address:</b></td>
      <td><?php echo $to;?></td>
    </tr>
    <tr>
      <td><b>Purpose of Visit:</b></td>
      <td><?php echo $purpose;?></td>
    </tr>
    <tr>
      <td><b>Client's Username:</b></td>
      <td><?php echo $client_username;?></td>
    </tr>
    <tr>
      <td><b>Total Distance Covered:</b></td>
      <td><?php echo $total_distance;?></td>
    </tr>
    <tr>
      <td><b>Problem Status:</b></td>
      <td><?php echo ucfirst($status);?></td>
    </tr>
    <tr>
      <td><b>Approved Status:</b></td>
      <td><?php echo $request_status;?></td>
    </tr>
    <tr>
      <td><b>Approved Distance:</b></td>
      <td>
        <?php 
          echo ($approved_distance== 0) ? 'N/a' : $approved_distance;
        ?>    
      </td>
    </tr> 

     <tr>
      <td><b>Remarks:</b></td>
      <td>
        <?php 
          echo ($remarks == '') ? 'N/a' : $remarks;
        ?>    
      </td>
    </tr>    
     
    <?php 
       if($request_status == 'Under Review'){
    ?> 
    <tr>
      <td><b>Request Status</b></td>
      <td>
        <select name="request_status" class="from-control request_status" required>
          <option value="">Select</option>
          <option value="Approve">Approve</option>
          <option value="Decline">Decline</option>
        </select>
      </td>
    </tr>

    <tr style="display: none" class="approved_distance">
      <td><b>Approve Distance:</b></td>
      <td><input type="number" required id="approved_distance" name="approved_distance" class="from-control" placeholder="Enter Approved Distance" min="0.1" max="<?php echo $total_distance;?>" step=any>
      </td>
    </tr>
    <tr>
      <td><b>Remarks:</b></td>
      <td><input type="text" name="remarks" class="from-control" placeholder="Enter Remarks"></td>
    </tr>  
    <input type="hidden" name="request_distance" value="<?php echo $total_distance;?>">
    <input type="hidden" name="user_name" value="<?php echo $name;?>">
    <input type="hidden" name="user_email" value="<?php echo $email;?>">
    <input type="hidden" name="id" value="<?php echo $id;?>">
</table>

<input type="submit" name="approve" value="Update Request" class="btn btn-primary approve">

<?php 
   } 
?>
</form>

<script type="text/javascript">
(function($) {
  "use strict"; // Start of use strict
  $('.request_status').on('change', function(){
    var selected_options = $(".request_status option:selected").val();
    if(selected_options == 'Approve'){
      $('.approved_distance').show();
    }else{
      $('#approved_distance').prop('required', false);
      $('.approved_distance').css('display', 'none'); 
      $('#approved_distance').val(''); 
    }
  });
})(jQuery); // End of use strict

</script>
