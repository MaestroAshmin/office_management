<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body style="margin: 0;padding: 0;font-family: 'Roboto', sans-serif;">

<table style="width: 675px; margin:auto;">
    <tr style="background-color:#F0F0F0; margin: auto;">
        <td colspan="2" style="width:14%; height:40px; padding:6px; overflow:hidden; position: relative;">
            <img src="<?php echo site_url();?>img/logo_12.png" style=" width:10%;">
        </td>
    </tr>
    
    <tr>
        <td style="margin: auto;min-height: 10%;
        text-align: left;">
            <h4 style="font-weight: 500;font-size: 20px;color: #991b1e; margin-top:5px;margin-bottom: 3px;">
                A new fuel request has been received
            </h4>
        </td>
    </tr>
    
    <tr>
        <td style="margin: auto; padding: 5px; text-align: left;">
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 2px;">
                Dear <strong>Admin</strong>,
            </p>
            <br/>
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
            A new fuel request has been received. Please find the details below.
            </p>

            <br/>
            
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Name : </strong> <?php echo $full_name;?>
            </p>
            
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Request Date :</strong> <?php echo $request_date;?>
            </p>

            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Ticket Number :</strong> <?php echo $ticket_number;?>
            </p>

            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Start Reading :</strong> <?php echo $start;?>
            </p>

            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>End Reading :</strong> <?php echo $end;?>
            </p>

             <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>From Address :</strong> <?php echo $from;?>
            </p>
        
             <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>To Address :</strong> <?php echo $to;?>
            </p>
            
             <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Purpose of visit :</strong> <?php echo $purpose;?>
            </p>   
            
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Client's Username :</strong> <?php echo $client_username;?>
            </p>    

            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Total Distance :</strong> <?php echo $total_distance;?>
            </p>    

            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Status :</strong> <?php echo ucfirst($status);?>
            </p>    

        </td>
    </tr>
    
    <tr>
        <td style="margin: auto; padding: 5px; text-align: left;">
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">Thanks,</p>
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">Unified Communication Pvt. Ltd</p>
        </td>
    </tr>
    <tr style="background-color: #991b1e !important;text-align: center;padding: 3px 0;border-top: 1px solid #fff;">
        <td>
            <p style="font-size: 14px;padding-left: 10px; color:#fff;">This email is auto-generated from 
                <a href="http://unicom.net.np" target="_blank" style="color: #fff;text-decoration: none; ">Unified Communications Pvt. Ltd</a>
                <br>
                Please do not reply this email
            </p>
            
        </td>
    </tr>
    
</table>

</body>
</html>