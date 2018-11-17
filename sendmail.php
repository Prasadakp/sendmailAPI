<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

	$customerMail = $_POST["email"];
	$subject = $_POST["subject"];
	$from = 'no-reply@tecgro.biz';
	$customerName= $_POST["name"];
	$customerPhone=$_POST["phone"];
	$customerMessage=$_POST["message"];

        $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$from."\r\n".
	    'Reply-To: '.$from."\r\n" .
	    'X-Mailer: PHP/' . phpversion();
	
	$message .= '<html>
			<head>
			<style>
			    .email-background{
			        background:white;
			       
			    }
			    .pre-header, .footer-junk, .email-container{
			        width: 100%;
			        background: white;
			        font-family: sans-serif;
			        font-size: 10px;
			        margin: 0 auto;
			        overflow: hidden;
			        border-radius: 5px;
			
			    }
			    p{
			        margin: 20px;
			        font-size: 20px;
			        font-weight: 300;
			        text-align: left;
			        color: #666;
			        
			    }
			    .kp{
			        display: inline-block;
			        float: right;
			        font-size:7px;
			        color: black;
			        
			    }
			</style>
			
			<body>
			<div class="email-background">
			    <div class="pre-header">
			        <a href="http://www.tecgro.biz">
			            <img src="http://www.tecgro.biz/images/logo.png" alt="Card image cap" width="100%" hight="300">
			            
			        </a>
			    <div>
			    <div class="email-container">
			        <p>
			        Dear '.$customerName.'<br/><br/>Thank you for your email. We take our customers’ problems seriously and are glad to hear from you
			        asvhdfkklidnvghgs
			        snfaydyijrfnvhgsad
			        </p>
			    </div>
			    <div class="footer-junk" >
			       <div>
			            <img src="http://www.tecgro.biz/images/footer.png" alt="Card image cap" width="200" hight="200">
			            <div class="kp">
			                    <h1>
			                    	Address: Tecgro Company<br/>
			                        Email: tecgro@tecgro.biz<br/>
			                        Phone: 8277358296<br/>
			                        Website:<a href="www.tecgro.biz">tecgro.biz</a>
			                        
			                    </h1>
			               </div>
			        </div> 
			      
			    </div>
			</div>
			</body>
			</html>';
	
	
	$servername = "localhost";
	$username = "tecgro_db_manage";
	$password = "Tecgro@786";
	$dbname = "tecgro";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
                 
         } 
         
         $sql = "INSERT INTO contact_request (name, email, phone, message) VALUES ('$customerName', '$customerMail', '$customerPhone', '$customerMessage')";

	if ($conn->query($sql) === TRUE) 
        {
	    if(mail($customerMail, $subject, $message, $headers))
              {
		$response=array("success"=>true, "message"=>"Mail sent successfully");
		echo json_encode($response);
	      }
            else
              {
		$response=array("success"=>false, "message"=>"Mail not sent");
		echo json_encode($response);
	      }
	}
        else
        {
	   $response=array("success"=>false, "message"=>"Internal Server Error");
		echo json_encode($response);
	}
	
?>
