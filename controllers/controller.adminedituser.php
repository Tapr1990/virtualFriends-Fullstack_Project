<?php
    require("models/model.users.php");
    
    $modelUsers = new Users();

    $URI = urldecode($_SERVER['REQUEST_URI']);
    $url = explode ("/", $URI);
    

    if(!empty($url[2]) && isset($_POST["edit"])) {

        $user_id = $url[2];
 
        $user = $modelUsers->getUser($user_id);
        //print_r($user);
        if($user["user_id"] == $user_id) {

            if(
                
                filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
                $_POST["password"] === $_POST["password2"] &&
                mb_strlen($_POST["first_name"]) >= 3 &&
                mb_strlen($_POST["first_name"]) <= 50 &&
                mb_strlen($_POST["last_name"]) >= 3 &&
                mb_strlen($_POST["last_name"]) <= 50 &&
                mb_strlen($_POST["password"]) >= 8 &&
                mb_strlen($_POST["password"]) <= 1000 &&
                !is_numeric($_POST["first_name"]) &&
                !is_numeric($_POST["last_name"]) && 
                !empty($_POST["email"]) &&
                !empty($_POST["first_name"]) &&
                !empty($_POST["last_name"]) &&
                !empty($_POST["password"]) 

            
            
            ) {
              

                $result = $modelUsers->editUser($_POST, $user["user_id"]);
                    
                header("Location: /adminusers");
                
                

              

            }
            else {
                $message = "erro";
            }
            
    
                                
    
            
        }
    
                
    }

               
    $title= "Admin Page - Virtual Friends";     


    require("views/admin/adminedituser.php");
?>