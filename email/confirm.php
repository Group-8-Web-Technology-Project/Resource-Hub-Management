<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require 'encryption.php';



function createMailInstance(){
    $mail = new PHPMailer(true);
    try {
        //Server settings                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'resourcehub.connect@gmail.com';                     //SMTP username
        $mail->Password   = 'bgnjgzlukcgbucfg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('resourcehub.connect@gmail.com', 'ResourceHub');
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);   
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }  
    return $mail;
}


function acceptEmail($email,$username,$event,$start,$end,$date,$resource){
    $mail = createMailInstance();

    $html = " 
   
    <!DOCTYPE html>
<html>
<head>

  <meta charset='utf-8'>
  <meta http-equiv='x-ua-compatible' content='ie=edge'>
  <title>Email Confirmation</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <style type='text/css'>
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: \"Source Sans Pro\";
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: \"Source Sans Pro\";
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: #46d9a9 !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*='margin: 16px 0;'] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
    color: #46d9a9 !important;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  p{
    color: #666;
  }
  h1{
    color: #393939;
  }
  </style>

</head>
<body style='background-color: #e9ecef;'>

  <!-- start preheader -->
  <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
    your request has been approved
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <!-- start logo -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' valign='top' style='padding: 36px 10px 10px 10px;'>
              <div >
                <center>
                <a  target='_blank' style='display: inline-block;'>
                    <img src='https://github.com/SankalpaFernando/fileHosting/blob/c6a0986fe3ad4cd9cbaf322f7c96a30868e3027d/logo-no-background.png?raw=true' alt='Logo' border='0' width='70' style='display: block; width: 70px; max-width: 70px; min-width: 70px;'>
                  </a>
                </center>
                </div>
                <p style='margin:1rem;font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif;font-size: 2.3rem;color: #303030;'>ResourceHub</p>

            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;'>
              <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Your Request Has Been Approved</h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>Your Request for $resource has been approved. Following are the details for the approval.</p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align='left' bgcolor='#ffffff'>
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
               <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
                    <table border='0' cellpadding='5'  cellspacing='5'>
                      <tr style='padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight:600;color: #393939 !important;'>Resource Name</td>
                        <td>$resource</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>Start Time</td>
                        <td>$start:00 a.m</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>End Time</td>
                        <td>$end:00 a.m</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>Event Name</td>
                        <td>$event</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>Date</td>
                        <td>$date</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>Look for the request page in ResourceHub for the QR code to provide to the officials</p>
             
            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
              <p style='margin: 0;'>Cheers,<br> ResourceHub Team</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start permission -->
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'>You received this email because we received a request for a resource allocation. If you didn't request you can safely delete this email.</p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->
          
          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>
    ";


    $mail->addAddress($email, $username); 
    $mail->Subject = "Your Request Has Been Approved";

    $mail->Body = $html;

    $mail->send();

}



function confirmEmail($email,$username,$token){
    $mail = createMailInstance();

    $code = $email;


    $html = "
    
    <!DOCTYPE html>
<html>
<head>

  <meta charset='utf-8'>
  <meta http-equiv='x-ua-compatible' content='ie=edge'>
  <title>Email Confirmation</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <style type='text/css'>
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: \"Source Sans Pro\";
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: \"Source Sans Pro\";
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: #46d9a9 !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*='margin: 16px 0;'] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
    color: #46d9a9 !important;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  p{
    color: #666;
  }
  h1{
    color: #393939;
  }
  </style>

</head>
<body style='background-color: #e9ecef;'>

  <!-- start preheader -->
  <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
    verify your email address for ResourceHub account
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <!-- start logo -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' valign='top' style='padding: 36px 10px 10px 10px;'>
              <div >
                <center>
                <a  target='_blank' style='display: inline-block;'>
                    <img src='https://github.com/SankalpaFernando/fileHosting/blob/c6a0986fe3ad4cd9cbaf322f7c96a30868e3027d/logo-no-background.png?raw=true' alt='Logo' border='0' width='70' style='display: block; width: 70px; max-width: 70px; min-width: 70px;'>
                  </a>
                </center>
                </div>
                <p style='margin:1rem;font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif;font-size: 2.3rem;color: #303030;'>ResourceHub</p>

            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;'>
              <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Confirm Your Email Address</h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>Tap the button below to confirm your email address. If you didn't create an account with <a href='https://blogdesire.com'>ResourceHub</a>, you can safely delete this email.</p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align='left' bgcolor='#ffffff'>
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td align='center' bgcolor='#46d9a9' style='border-radius: 6px;'>
                          <a href='https://cheerless-torpedoes.000webhostapp.com/controllers/login/verify.php?code=$code' target='_blank' style='display: inline-block; padding: 16px 36px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;color: white !important;'>Yes, It's Me. Confirm the Email</a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>

            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
              <p style='margin: 0;'>Cheers,<br> ResourceHub Team</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start permission -->
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'>You received this email because we received a request for creating a new account from this email. If you didn't request you can safely delete this email.</p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->
          
          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>
    ";


    $mail->addAddress($email, $username); 
    $mail->Subject = "$username, verify your email";

    $mail->Body = $html;

    $mail->send();

}




function declineEmail($email,$username,$event,$start,$end,$date,$resource,$reason){
    $mail = createMailInstance();

        $html = " 
   
    <!DOCTYPE html>
<html>
<head>

  <meta charset='utf-8'>
  <meta http-equiv='x-ua-compatible' content='ie=edge'>
  <title>Email Confirmation</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <style type='text/css'>
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: \"Source Sans Pro\";
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: \"Source Sans Pro\";
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: #46d9a9 !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*='margin: 16px 0;'] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
    color: #46d9a9 !important;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  p{
    color: #666;
  }
  h1{
    color: #393939;
  }
  </style>

</head>
<body style='background-color: #e9ecef;'>

  <!-- start preheader -->
  <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
    your request has been declined
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <!-- start logo -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' valign='top' style='padding: 36px 10px 10px 10px;'>
              <div >
                <center>
                <a  target='_blank' style='display: inline-block;'>
                    <img src='https://github.com/SankalpaFernando/fileHosting/blob/c6a0986fe3ad4cd9cbaf322f7c96a30868e3027d/logo-no-background.png?raw=true' alt='Logo' border='0' width='70' style='display: block; width: 70px; max-width: 70px; min-width: 70px;'>
                  </a>
                </center>
                </div>
                <p style='margin:1rem;font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif;font-size: 2.3rem;color: #303030;'>ResourceHub</p>

            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;'>
              <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Your Request Has Been Approved</h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>Your Request for $resource has been declined. Following are the details for the approval.</p>
            </td>
          </tr>
          <!-- end copy -->

          <!-- start button -->
          <tr>
            <td align='left' bgcolor='#ffffff'>
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
               <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
                    <table border='0' cellpadding='5'  cellspacing='5'>
                      <tr style='padding: 24px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight:600;color: #393939 !important;'>Resource Name</td>
                        <td>$resource</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>Start Time</td>
                        <td>$start:00 a.m</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>End Time</td>
                        <td>$end:00 a.m</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>Event Name</td>
                        <td>$event</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>Date</td>
                        <td>$date</td>
                      </tr>
                      <tr style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
                        <td style='font-weight: 600;color: #393939 !important;'>Reason</td>
                        <td>$reason</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              </table>
            </td>
          </tr>
          <!-- end button -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>If you think this is a mistake.You can rerequest or inform adminstration.</p>
             
            </td>
          </tr>
          <!-- end copy -->

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
              <p style='margin: 0;'>Cheers,<br> ResourceHub Team</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start permission -->
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'>You received this email because we received a request for a resource allocation. If you didn't request you can safely delete this email.</p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->
          
          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>
    ";

    $mail->addAddress($email, $username); 
    $mail->Subject = "Resource Request Declined";

    $mail->Body = $html;

    $mail->send();

}




function approveEmail($email,$username){
    $mail = createMailInstance();

    $html = " 
    <!DOCTYPE html>
<html>
<head>

  <meta charset='utf-8'>
  <meta http-equiv='x-ua-compatible' content='ie=edge'>
  <title>Email Confirmation</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <style type='text/css'>
  /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
  @media screen {
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 400;
      src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
    }
    @font-face {
      font-family: 'Source Sans Pro';
      font-style: normal;
      font-weight: 700;
      src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
    }
  }
  /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
  body,
  table,
  td,
  a {
    -ms-text-size-adjust: 100%; /* 1 */
    -webkit-text-size-adjust: 100%; /* 2 */
  }
  /**
   * Remove extra space added to tables and cells in Outlook.
   */
  table,
  td {
    mso-table-rspace: 0pt;
    mso-table-lspace: 0pt;
  }
  /**
   * Better fluid images in Internet Explorer.
   */
  img {
    -ms-interpolation-mode: bicubic;
  }
  /**
   * Remove blue links for iOS devices.
   */
  a[x-apple-data-detectors] {
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    color: #46d9a9 !important;
    text-decoration: none !important;
  }
  /**
   * Fix centering issues in Android 4.4.
   */
  div[style*='margin: 16px 0;'] {
    margin: 0 !important;
  }
  body {
    width: 100% !important;
    height: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /**
   * Collapse table borders to avoid space between cells.
   */
  table {
    border-collapse: collapse !important;
  }
  a {
    color: #1a82e2;
    color: #46d9a9 !important;
  }
  img {
    height: auto;
    line-height: 100%;
    text-decoration: none;
    border: 0;
    outline: none;
  }
  p{
    color: #666;
  }
  h1{
    color: #393939;
  }
  </style>

</head>
<body style='background-color: #e9ecef;'>

  <!-- start preheader -->
  <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
    Your account has been approved.
  </div>
  <!-- end preheader -->

  <!-- start body -->
  <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <!-- start logo -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' valign='top' style='padding: 36px 10px 10px 10px;'>
              <div >
                <center>
                <a href='https://www.blogdesire.com' target='_blank' style='display: inline-block;'>
                    <img src='https://github.com/SankalpaFernando/fileHosting/blob/c6a0986fe3ad4cd9cbaf322f7c96a30868e3027d/logo-no-background.png?raw=true' alt='Logo' border='0' width='70' style='display: block; width: 70px; max-width: 70px; min-width: 70px;'>
                  </a>
                </center>
                </div>
                <p style='margin:1rem;font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif;font-size: 2.3rem;color: #303030;'>ResourceHub</p>

            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;'>
              <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;text-align: center;'>Your Account Has Been Approved</h1>
            </td>
          </tr>
        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
      <td align='center' bgcolor='#e9ecef'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start copy -->
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>ResourceHub administration has approved your account. Now you can access your ResourceHub account.</p>
            </td>
          </tr>
          <!-- end copy -->

         

         

          <!-- start copy -->
          <br>
          <br>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
              <p style='margin: 0;'>Cheers,<br> ResourceHub Team</p>
            </td>
          </tr>
          <!-- end copy -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end copy block -->

    <!-- start footer -->
    <tr>
      <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
        <!--[if (gte mso 9)|(IE)]>
        <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
        <tr>
        <td align='center' valign='top' width='600'>
        <![endif]-->
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <!-- start permission -->
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'>You received this email because we received a request for creating a new account from your email. If you didn't request you can safely delete this email.</p>
            </td>
          </tr>
          <!-- end permission -->

          <!-- start unsubscribe -->
          
          <!-- end unsubscribe -->

        </table>
        <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
      </td>
    </tr>
    <!-- end footer -->

  </table>
  <!-- end body -->

</body>
</html>
    
    ";

    $mail->addAddress($email, $username); 
    $mail->Subject = "Account Has Been Approved";

    $mail->Body = $html;

    $mail->send();

}



function resetEmail($email,$username,$token){
  $mail = createMailInstance();

  $code = encrypt($email);


  $html = "
  
  <!DOCTYPE html>
<html>
<head>

<meta charset='utf-8'>
<meta http-equiv='x-ua-compatible' content='ie=edge'>
<title>Email Confirmation</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<style type='text/css'>
/**
 * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
 */
@media screen {
  @font-face {
    font-family: \"Source Sans Pro\";
    font-style: normal;
    font-weight: 400;
    src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
  }
  @font-face {
    font-family: \"Source Sans Pro\";
    font-style: normal;
    font-weight: 700;
    src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
  }
}
/**
 * Avoid browser level font resizing.
 * 1. Windows Mobile
 * 2. iOS / OSX
 */
body,
table,
td,
a {
  -ms-text-size-adjust: 100%; /* 1 */
  -webkit-text-size-adjust: 100%; /* 2 */
}
/**
 * Remove extra space added to tables and cells in Outlook.
 */
table,
td {
  mso-table-rspace: 0pt;
  mso-table-lspace: 0pt;
}
/**
 * Better fluid images in Internet Explorer.
 */
img {
  -ms-interpolation-mode: bicubic;
}
/**
 * Remove blue links for iOS devices.
 */
a[x-apple-data-detectors] {
  font-family: inherit !important;
  font-size: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
  color: #46d9a9 !important;
  text-decoration: none !important;
}
/**
 * Fix centering issues in Android 4.4.
 */
div[style*='margin: 16px 0;'] {
  margin: 0 !important;
}
body {
  width: 100% !important;
  height: 100% !important;
  padding: 0 !important;
  margin: 0 !important;
}
/**
 * Collapse table borders to avoid space between cells.
 */
table {
  border-collapse: collapse !important;
}
a {
  color: #1a82e2;
  color: #46d9a9 !important;
}
img {
  height: auto;
  line-height: 100%;
  text-decoration: none;
  border: 0;
  outline: none;
}
p{
  color: #666;
}
h1{
  color: #393939;
}
</style>

</head>
<body style='background-color: #e9ecef;'>

<!-- start preheader -->
<div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
  reset your password
</div>
<!-- end preheader -->

<!-- start body -->
<table border='0' cellpadding='0' cellspacing='0' width='100%'>

  <!-- start logo -->
  <tr>
    <td align='center' bgcolor='#e9ecef'>
      <!--[if (gte mso 9)|(IE)]>
      <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
      <tr>
      <td align='center' valign='top' width='600'>
      <![endif]-->
      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
        <tr>
          <td align='center' valign='top' style='padding: 36px 10px 10px 10px;'>
            <div >
              <center>
              <a href='https://www.blogdesire.com' target='_blank' style='display: inline-block;'>
                  <img src='https://github.com/SankalpaFernando/fileHosting/blob/c6a0986fe3ad4cd9cbaf322f7c96a30868e3027d/logo-no-background.png?raw=true' alt='Logo' border='0' width='70' style='display: block; width: 70px; max-width: 70px; min-width: 70px;'>
                </a>
              </center>
              </div>
              <p style='margin:1rem;font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif;font-size: 2.3rem;color: #303030;'>ResourceHub</p>

          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
  </tr>
  <!-- end logo -->

  <!-- start hero -->
  <tr>
    <td align='center' bgcolor='#e9ecef'>
      <!--[if (gte mso 9)|(IE)]>
      <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
      <tr>
      <td align='center' valign='top' width='600'>
      <![endif]-->
      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
        <tr>
          <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;'>
            <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Reset Your Password</h1>
          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
  </tr>
  <!-- end hero -->

  <!-- start copy block -->
  <tr>
    <td align='center' bgcolor='#e9ecef'>
      <!--[if (gte mso 9)|(IE)]>
      <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
      <tr>
      <td align='center' valign='top' width='600'>
      <![endif]-->
      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

        <!-- start copy -->
        <tr>
          <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
            <p style='margin: 0;'>Tap the button below to reset your password. If you didn't request for password reset, you can safely delete this email.</p>
          </td>
        </tr>
        <!-- end copy -->

        <!-- start button -->
        <tr>
          <td align='left' bgcolor='#ffffff'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
              <tr>
                <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
                  <table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td align='center' bgcolor='#46d9a9' style='border-radius: 6px;'>
                        <a href='https://cheerless-torpedoes.000webhostapp.com/views/reset/reset.php?token=$token' target='_blank' style='display: inline-block; padding: 16px 36px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;color: white !important;'>Reset Password</a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <!-- end button -->

        <!-- start copy -->
        <tr>
          <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
            
          </td>
        </tr>
        <!-- end copy -->

        <!-- start copy -->
        <tr>
          <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
            <p style='margin: 0;'>Cheers,<br> ResourceHub Team</p>
          </td>
        </tr>
        <!-- end copy -->

      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
  </tr>
  <!-- end copy block -->

  <!-- start footer -->
  <tr>
    <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
      <!--[if (gte mso 9)|(IE)]>
      <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
      <tr>
      <td align='center' valign='top' width='600'>
      <![endif]-->
      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

        <!-- start permission -->
        <tr>
          <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: \"Source Sans Pro\", Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
            <p style='margin: 0;'>You received this email because we received a request for resetting account password from this email. If you didn't request you can safely delete this email.</p>
          </td>
        </tr>
        <!-- end permission -->

        <!-- start unsubscribe -->
        
        <!-- end unsubscribe -->

      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
  </tr>
  <!-- end footer -->

</table>
<!-- end body -->

</body>
</html>
  ";


  $mail->addAddress($email, $username); 
  $mail->Subject = "$username, reset your password";

  $mail->Body = $html;

  $mail->send();

}
















?>