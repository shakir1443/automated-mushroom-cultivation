<?php
   include("session.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
	  $salt = "faka&kapa#xyz";
	 $pass = crypt($mypassword,$salt);
      
      $sql = "SELECT id FROM login WHERE username = '$myusername' and password = '$pass'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		/////////////////

// Hashing the password with its hash as the salt returns the same hash


      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: index.php");
      }else {
		 header("location: login.php");
        // echo "Your Login Name or Password is invalid";
      }

   }
?>