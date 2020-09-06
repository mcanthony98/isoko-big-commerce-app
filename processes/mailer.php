<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require '../vendor/autoload.php';
	
	$mail = new PHPMailer(true);                             
				    try {
				        //Server settings
				        $mail->isSMTP();                                     
				        $mail->Host = 'smtp.gmail.com';                      
				        $mail->SMTPAuth = true;                               
				        $mail->Username = 'iagro.online2019@gmail.com';     
				        $mail->Password = 'iagro2019';                    
				        $mail->SMTPOptions = array(
				            'ssl' => array(
				            'verify_peer' => false,
				            'verify_peer_name' => false,
				            'allow_self_signed' => true
				            )
				        );                         
				        $mail->SMTPSecure = 'ssl';                           
				        $mail->Port = 465;                                   

				        $mail->setFrom('iagro.online2019@gmail.com');
				        
				        //Recipients
				        $mail->addAddress($recipient);              
				        $mail->addReplyTo('iagro.online2019@gmail.com');
				       
				        //Content
				        $mail->isHTML(true);                                  
				        $mail->Subject = $subject ;
				        $mail->Body    = $body;

				        $mail->send();

				        $_SESSION['success'] = 'Email was sent';
				    } 
				    catch (Exception $e) {
				        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
				    }


	
?>