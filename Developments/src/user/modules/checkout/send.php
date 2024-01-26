<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../lib/mail/sendmail.php");

$user_id = (int) $_SESSION['user_login']['id'];
$fullname = $_POST['fullname'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customer WHERE id =$user_id"));

$email = $user['email'];

$address = $_POST['address'];
$phone = $_POST['phone'];
$note = $_POST['note'];
$payment_method = $_POST['payment_method'];
$order_status = "Pending";

$checkoutList = $_SESSION['cart'];

$dd = date("d");
$hh = date("h");
$mm = date("i");
$ss = date("s");
$yy = date("y");
$time = $dd . $hh . $mm . $ss;

$no = $time;
$date = date("Y-m-d H:i:s");
var_dump($checkoutList);

$query = "INSERT INTO `ordermaster` 
(`order_id`, `order_date`, `cus_id`, `shipping_name`, `shipping_address`, `shipping_phone`,
 `payment_method`, `order_note`, `last_modify_at`, `order_status`) 
VALUES ('{$no}', '{$date}', '{$user_id}', '{$fullname}', '{$address}', '{$phone}',
 '{$payment_method}', '{$note}', '{$date}', '{$order_status}')";
mysqli_query($conn, $query);

$total =0;
foreach ($checkoutList as $item):
$total += $item['book_price']*$item['qty'];

   
    $book_id = $item['book_id'];
    $qty = $item['qty'];
    $book_price = $item['book_price'];

   
    $query = "INSERT INTO `orderdetail` (`order_id`, `book_id`, `quantity`, `book_price`) VALUES ('{$no}', '{$book_id}', '{$qty}', '{$book_price}')";
    mysqli_query($conn, $query);
endforeach;

$mailBody = "<body style='margin: 0 !important; padding: 0 !important; background-color: #eeeeee;' bgcolor='#eeeeee'>


<div
    style='display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: Open Sans, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'>
    For what reason would it be advisable for me to think about business content? That might be little bit risky to
    have crew member like them.
</div>

<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td align='center' style='background-color: #eeeeee;' bgcolor='#eeeeee'>

            <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:600px;'>
                <tr>
                    <td align='center' valign='top' style='font-size:0; padding: 35px;' bgcolor='#2c60bf'>

                        <div
                            style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;'>
                            <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'
                                style='max-width:300px;'>
                                <tr>
                                    <td align='left' valign='top'
                                        style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 800; line-height: 48px;'
                                        class='mobile-center'>
                                        <h1 style='font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;'>
                                            OnBookStore</h1>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align='center' style='padding: 35px 35px 20px 35px; background-color: #ffffff;'
                        bgcolor='#ffffff'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'
                            style='max-width:600px;'>
                            <tr>
                                <td align='center'
                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>
                                    <img src='https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png'
                                        width='125' height='120' style='display: block; border: 0px;' /><br>
                                    <h2
                                        style='font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;'>
                                        Thank You For Your Order!
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td align='center'
                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>
                                    <h3
                                        style='font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;'>
                                        ORDER #$no
                                    </h3>
                                    <h4>$date</h4>
                                </td>
                            </tr>
                            <tr>
                                <td align='left'
                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;'>
                                    <p
                                        style='font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;'>
                                        Hi $fullname, Thank you for your recent order. We are pleased to confirm that we have
                                        received your order and it is currently being processed.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align='left' style='padding-top: 20px;'>
                                    <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                        <tr>
                                            <td width='75%' align='left' bgcolor='#eeeeee'
                                                style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'>
                                                Order Detail
                                            </td>
                                            <td width='25%' align='left' bgcolor='#eeeeee'
                                                style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'>

                                            </td>
                                        </tr>"; 
                                    foreach ($checkoutList as $item) {                                       
                                     $mailBody .= "<tr>
                                            <td width='75%' align='left'
                                                style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; border-bottom: 3px solid #eeeeee; padding: 15px 10px 5px 10px;'>
                                                <p>" . $item['book_name'] . "</p>
                                                <p>Price: " . $item['book_price'] . "</p>
                                                <p>Quantity: " . $item['qty'] . "</p>
                                            </td>
                                            <td width='25%' align='left'
                                                style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; border-bottom: 3px solid #eeeeee; padding: 15px 10px 5px 10px;'>
                                                $" . $item['qty'] * $item['book_price'] . "
                                            </td>
                                        </tr>";
                                    }





                    $mailBody .= " </table>
                                </td>
                            </tr>
                            <tr>
                                <td align='left' style='padding-top: 20px;'>
                                    <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                        <tr>
                                            <td width='75%' align='left'
                                                style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-bottom: 3px solid #eeeeee;'>
                                                TOTAL
                                            </td>
                                            <td width='25%' align='left'
                                                style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-bottom: 3px solid #eeeeee;'>
                                                $$total
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td align='center' height='100%' valign='top' width='100%'
                        style='padding: 0 35px 35px 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'
                            style='max-width:660px;'>
                            <tr>
                                <td align='center' valign='top' style='font-size:0;'>
                                    <div
                                        style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>

                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'
                                            style='max-width:300px;'>
                                            <tr>
                                                <td align='left' valign='top'
                                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                    <p style='font-weight: 800;'>Shipping Information</p>
                                                    <p>$fullname<br>$phone<br>$address
                                                        </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div
                                        style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'
                                            style='max-width:300px;'>
                                            <tr>
                                                <td align='left' valign='top'
                                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                    <p style='font-weight: 800;'>Estimated Delivery Date</p>
                                                    <p>3-5 business days</p>
                                                </td>
                                            </tr>             
                                        </table>
                                    </div>
                                </td>
                            </tr>";


                            if($payment_method=="COD"){
                                $mailBody.= "                    <tr>
                                <td align='center' valign='top' style='font-size:0;'>
                                    <div style='display:inline-block; max-width:100%; min-width:240px; vertical-align:top; width:100%;'>
        
                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                            <tr>
                                                <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                    <p style='font-weight: 800;'>Payment Method</p>
                                                    <p>Cash On Delivery</p>
        
                                                </td>
                                            </tr>
                                        </table>
                                    </div>                        
                                </td>
                            </tr>";
                            } else
                            {
                                $mailBody .= "                    <tr>
                                <td align='center' valign='top' style='font-size:0;'>
                                    <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
        
                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                            <tr>
                                                <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                    <p style='font-weight: 800;'>Payment Method</p>
                                                    <p>Bank Transfer</p>
        
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div style='display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;'>
                                        <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                            <tr>
                                                <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                    <p style='font-weight: 800;'>Payment Information</p>
                                                    <p>Bank Name: TECHCOMBANK</p>                                           
                                                    <p>Account Name: Pham Quoc Chien</p>
                                                    <p>Account Number: 0123456688</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>";
                            }









                    $mailBody .=    "</table>
                    </td>
                </tr>
                <tr>
                    <td align='center' style=' padding: 35px; background-color: #5c99e5;' bgcolor='#1b9ba3'>
                        <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'
                            style='max-width:600px;'>
                            <tr>
                                <td align='center'
                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;'>
                                    <h2
                                        style='font-size: 16px; font-weight: 300; line-height: 30px; color: #ffffff; margin: 0;'>
                                        We will send you a shipping confirmation email as soon as your order has been dispatched from our warehouse.
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td align='center' style='padding: 25px 0 15px 0;'>
                                    <table border='0' cellspacing='0' cellpadding='0'>
                                        <tr>
                                            <td align='center' style='border-radius: 5px;' bgcolor='#66b3b7'>
                                                <a href='?mod=home&act=main' target='_blank'
                                                    style='font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #2c60bf; padding: 15px 30px; border: 1px solid #2c60bf; display: block;'>TRACK YOUR ORDER</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>


                <tr style='border-collapse:collapse'>
                <td style='Margin:0;padding-left:20px;padding-right:20px;padding-top:25px;padding-bottom:30px;background-color:#F8F8F8' bgcolor='#f8f8f8' align='left'><!--[if mso]><table style='width:560px' cellpadding='0' cellspacing='0'><tr><td style='width:270px' valign='top'><![endif]-->
                 <table class='es-left' cellspacing='0' cellpadding='0' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left'>
                   <tbody><tr style='border-collapse:collapse'>
                    <td class='es-m-p20b' align='left' style='padding:0;Margin:0;width:270px'>
                     <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                       <tbody><tr style='border-collapse:collapse'>
                        <td align='center' style='padding:0;Margin:0;padding-bottom:10px'><h3 style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#242424'>We're here to help</h3></td>
                       </tr>
                       <tr style='border-collapse:collapse'>
                        <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Arial, sans-serif;line-height:21px;color:#242424'>Call 123456789 <br>or contact us via social media.</p></td>
                       </tr>
                     </tbody></table></td>
                   </tr>
                 </tbody></table>
                 <table class='es-right' cellspacing='0' cellpadding='0' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right'>
                   <tbody><tr style='border-collapse:collapse'>
                    <td align='left' style='padding:0;Margin:0;width:270px'>
                     <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                       <tbody><tr style='border-collapse:collapse'>
                        <td align='center' style='padding:0;Margin:0;padding-bottom:10px'><h3 style='Margin:0;line-height:24px;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:20px;font-style:normal;font-weight:bold;color:#242424'>Our guarantee</h3></td>
                       </tr>
                       <tr style='border-collapse:collapse'>
                        <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Arial, sans-serif;line-height:21px;color:#242424'>Your satisfaction is 100% guaranteed.</p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Arial, sans-serif;line-height:21px;color:#242424'>See our <a target='_blank' href='#' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:14px;text-decoration:none;color:#3CA7F1'>Returns and Exchanges policy.</a></p></td>
                       </tr>
                     </tbody></table></td>
                   </tr>
                 </tbody></table></td>
               </tr>


            </table>
        </td>
    </tr>


    <tr style='border-collapse:collapse'>
    <td align='center' style='padding:0;Margin:0'>
     <table class='es-footer-body' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#2c60bf;width:600px'>
       <tbody><tr style='border-collapse:collapse'>
        <td align='left' style='padding:20px;Margin:0'>
         <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
           <tbody><tr style='border-collapse:collapse'>
            <td valign='top' align='center' style='padding:0;Margin:0;width:560px'>
             <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
               <tbody><tr style='border-collapse:collapse'>
                <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:20px;font-size:0'>
                 <table class='es-table-not-adapt es-social' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'>
                   <tbody><tr style='border-collapse:collapse'>
                    <td valign='top' align='center' style='padding:0;Margin:0;padding-right:15px'><img title='Twitter' src='https://tlr.stripocdn.email/content/assets/img/social-icons/circle-gray/twitter-circle-gray.png' alt='Tw' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td>
                    <td valign='top' align='center' style='padding:0;Margin:0;padding-right:15px'><img title='Facebook' src='https://tlr.stripocdn.email/content/assets/img/social-icons/circle-gray/facebook-circle-gray.png' alt='Fb' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td>
                    <td valign='top' align='center' style='padding:0;Margin:0;padding-right:15px'><img title='Youtube' src='https://tlr.stripocdn.email/content/assets/img/social-icons/circle-gray/youtube-circle-gray.png' alt='Yt' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td>
                    <td valign='top' align='center' style='padding:0;Margin:0'><img title='Linkedin' src='https://tlr.stripocdn.email/content/assets/img/social-icons/circle-gray/linkedin-circle-gray.png' alt='In' width='32' height='32' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic'></td>
                   </tr>
                 </tbody></table></td>
               </tr>
               <tr style='border-collapse:collapse'>
                <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:Arial, sans-serif;line-height:20px;color:#fff'><strong><a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:13px;text-decoration:none;color:#fff;line-height:20px' href='#'>Browse all products</a>&nbsp;</strong> - <strong><a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:13px;text-decoration:none;color:#fff;line-height:20px' href='https://goo.gl/maps/g6NNdDnwJixvgnvWA'>Locate store</a></strong></p></td>
               </tr>
               <tr style='border-collapse:collapse'>
                <td align='center' style='padding:0;Margin:0;padding-top:20px;padding-bottom:20px'><h3 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:Arial, sans-serif;line-height:16px;color:#fff; padding-top:10px;padding-bottom:10px'>OnBookStore, Inc.</h3><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:Arial, sans-serif;line-height:16px;color:#fff'>275 Nguyen Van Dau, Ward 11, Binh Thanh District<br>Ho Chi Minh City</p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:Arial, sans-serif;line-height:16px;color:#fff'><a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:13px;text-decoration:none;color:#fff;line-height:16px' href='tel:123456789'>123456789</a></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:Arial, sans-serif;line-height:16px;color:#fff'><a target='_blank' href='mailto:your@mail.com' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:13px;text-decoration:none;color:#fff;line-height:16px'>onbookstore@gmail.com</a></p></td>
               </tr>
               <tr style='border-collapse:collapse'>
                <td align='center' style='padding:0;Margin:0'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:Arial, sans-serif;line-height:20px;color:#fff'><strong><a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:13px;text-decoration:none;color:#fff;line-height:20px' class='unsubscribe' href='#'>Unsubscribe</a> - <a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Arial, sans-serif;font-size:13px;text-decoration:none;color:#fff;line-height:20px' href='#'>Customer Support</a></strong></p></td>
               </tr>
               <tr style='border-collapse:collapse'>
                <td align='center' style='padding:0;Margin:0;padding-top:10px;padding-bottom:10px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:13px;font-family:Arial, sans-serif;line-height:20px;color:#fff'><em><span style='font-size:11px;line-height:17px'>You are receiving this email because you have visited our site or asked us about regular newsletter</span></em></p></td>
               </tr>
             </tbody></table></td>
           </tr>
         </tbody></table></td>
       </tr>
     </tbody></table></td>
   </tr>




</table>

</body>";






$mailSubject = "[Order Confirm] # $no - OnBookStore";
sendmail($email, $mailSubject, $mailBody);
unset($_SESSION['cart']);
header("Location: success.php?order_id=$no");

            