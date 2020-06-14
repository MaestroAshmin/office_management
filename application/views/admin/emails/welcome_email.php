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
                Account created on Unified Communications
            </h4>
        </td>
    </tr>
    
    <tr>
        <td style="margin: auto; padding: 5px; text-align: left;">
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 2px;">
                Dear <strong><?php echo $name;?></strong>,
            </p>
            <br/>
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
            Your account has been created in fuel request portal. Please find the details below.
            </p>

            <br/>
            
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Email:</strong> <?php echo $email;?>
            </p>
            
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Password:</strong> <?php echo $actual_password;?> <small>(Note: We recommend you to change the password after first login)</small>
            </p>
            
            <p style="font-size: 16px;font-family: 'open', sans-serif;margin-bottom: 2px;margin-top: 0px;">
                <strong>Link:</strong> <a target="_blank" href="<?php echo site_url();?>"><?php echo site_url();?></a>
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