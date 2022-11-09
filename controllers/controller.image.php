<?php
  
   
  require("models/model.users.php");

  $modelImages = new Users();
   
 

    //* Profile Image
    if(isset($_POST["send"]) && isset($_FILES["image1"])) {
       
      
      if($_FILES["image1"]["type"] == "image/jpeg") {

        
          $size = (1024 * 1024) * 3;// 3 megabytes
         
          if($_FILES["image1"]["size"] < $size) {

            $filename = "uploads/" . $_FILES["image1"]["name"];

            $path = pathinfo($filename, PATHINFO_EXTENSION);

            $path = strtolower($path);

            $newFileName = uniqid( time() ) . "." . $path;
            
            $file = "uploads/" . $newFileName;

            move_uploaded_file($_FILES["image1"]["tmp_name"], $file );

     
            if(file_exists($file)) {

          
              $user_id = $_SESSION["user_id"];
     
     
              $profileImages = $modelImages->insertProfileImage($file, $user_id);
     
     
     
              header("Location: /profile");
             
            }

          }
          else {
            $message = "Error! Add a valid image size!";
            http_response_code(400);
          }
      } 
      else {
          $message = "Error! Add a valid image type!";
          http_response_code(400);
      }

    }
   



    //* Background-Image
    if(isset($_POST["send"]) && isset($_FILES["image2"])) {
       

      if($_FILES["image2"]["type"] == "image/jpeg") {

          $size = (1024 * 1024) * 3;
          if($_FILES["image2"]["size"] < $size) {

            $filename = "uploads/" . $_FILES["image2"]["name"];

            $path = pathinfo($filename, PATHINFO_EXTENSION);

            $path = strtolower($path);

            $newFileName = uniqid( time() ) . "." . $path;
            
            $file = "uploads/" . $newFileName;

            move_uploaded_file($_FILES["image2"]["tmp_name"], $file );
     
            if(file_exists($file)) {
     
     
              $user_id = $_SESSION["user_id"];
     
     
              $backgroundImages = $modelImages->insertBackgroundImage($file, $user_id);
     
              header("Location: /profile");
              
            }

          }
          else {
            $message = "Error! Add a valid image size!";
            http_response_code(400);
          }
      } 
      else {
          $message = "Error! Add a valid image type!";
          http_response_code(400);
      }

    }
   
  

    $userid = $_SESSION["user_id"];
      

    $user = $modelImages->getUser($userid);

    
    $profile_image = "";
    
    if($user["profile_image"] == "") {

        $profile_image = "images/person-placeholder.jpg";
        
    }
    else {
        $profile_image = $user["profile_image"];
       
    }
           
            




     
       

    $title = "VirtualFriends";

    require("views/view.image.php");

   

 


   

?>

