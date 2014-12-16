<?php 
	

	$pageName="Contact us"; 
	$section="contact";
	include('../inc/config.php');
	include(ROOT_PATH.'/inc/header.php'); 
	
	if($_SERVER["REQUEST_METHOD"]=="POST"){
	
		$name    =  trim($_POST["name"]);
		$email   =  trim($_POST["email"]);
		$message =  trim($_POST["message"]);
		
		if($name== "" OR $email=="" OR $message==""){
			$error_message =  "you must enter name, email, and message.";
		}

		if(!isset($error_message)){
			foreach( $_POST as $value ){
		        if( stripos($value,'Content-Type:') !== FALSE ){
		            $error_message = "There was a problem with the information you entered.";    
		            
		        }
	   		}
   		}

   		if(!isset($error_message)){
   			require_once(ROOT_PATH."inc/phpmailer/class.phpmailer.php");
   			$mail = new PHPMailer();
	   		if($_POST["address"]!=""){

	  	    	$error_message = "POT";
	  	    }

			if(!$mail->ValidateAddress($email)){


				$error_message =  "Not valid email";
				
			}

		


			
			
			$email_body= "A message sent from: ".$name." his email is: ".$email." and the message is: </br>".$message;
	  	    $mail->SetFrom($email, $name);
	  	    $address = "anasmouradb2a@gmail.com";
	  	    $mail->AddAddress($address, "Shirts 4 Mike");
	  	    $mail->Subject ="Shirts 4 mke". $name;
	  	    $mail->MsgHTML($email_body);

	  	    
	  	    if($mail->Send()){
	  	    	header("Location: ".URL_BASE."contact/?status=success");
				exit;
	  	    }else{

	  	    	//$error_message = "There were a problem while sending the email";
	  	    }



	  	    


			
			
	}

	}   
		if(isset($error_message)){
			//echo $error_message;
		}
	?>
	
	


	<div class="section page">
		<div class="wrapper">
			<?php if( isset($_GET["status"]) AND $_GET["status"]=="success"){ ?>
			
				<p>Thank's for you email, You'll be contacted shortly.</p>
				
			<?php }
				
				else{?>
			
				<h1>Contact Mike!</h1>
				<p> I'd love to hear from you! Complete form to send me an email. </p>
				<?php 

					if(isset($error_message)){
						echo '<p class="message">'. $error_message .'</p>';
					}

				?>
				<form method="POST" action="">
					<table>
						<tr>
							<th>
								<label for="name">Name</label>
							</th>
							<td>
								<input type="text" name="name" id="name" value="<?php if( isset($name) ){ echo htmlspecialchars($name); }  ?>">
							</td>
						</tr>
						
						<tr>
							<th>
								<label for="email">Email</label>
							</th>
							<td>
								<input type="text" name="email" id="email" value="<?php if( isset($email) ){ echo htmlspecialchars($email); }  ?>">
							</td>
						</tr>
						
						<tr>
							<th>
								<label for="message">Message</label>
							</th>
							<td>
								<textarea name="message" id="message" rows="5"> <?php if( isset($message) ){ echo htmlspecialchars($message); }  ?> </textarea>
							</td>
						</tr>

						<tr style="display: none;">
							<th>
								<label for="address">Address</label>
							</th>
							<td>
								<textarea name="address" id="address" rows="5"></textarea>
							</td>
						</tr>
						
						
					</table>
					<input type="submit" value="Send">
				</form>
			<?php }?>
		</div>
	</div>
<?php include(ROOT_PATH.'inc/footer.php'); ?>