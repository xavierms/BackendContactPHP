<?php 
    header("Content-Type: application/json/");
    //  function modelContact(){
    //     $model =[
    //     $_POST["name"],
    //     $_POST["lastName"], 
    //     $_POST["email"], 
    //     $_POST["phone"]
    //     ];
    //     return $model;
    //  }
            
        
    include_once("../Classes/class-contact.php");
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':

                
            $_POST =json_decode(file_get_contents('php://input'), true);
            // $contact = new Contact(modelContact() );
            $contact = new Contact(
                $_POST["name"],
                $_POST["lastName"], 
                $_POST["email"], 
                $_POST["phone"] 
            );
            if (empty($_POST["name"])){
                echo"The field name is required";
            }
            else{

                $contact->saveContact();
                $result["message"] = "Save user, info:".json_encode($_POST);
                echo json_encode($result);
            }
        break;
        case 'GET':
           //isset() return true if the variable exist
            if (isset($_GET['id'])){
                Contact::getContactId($_GET['id']);
            }else{
                // "::"  operador de resolucion de ambito
                Contact::getContact();
                // $result["message"] =  "Return all users";
                // echo json_encode($result);
            }
        break;
        case 'PUT':
            $_PUT = json_decode(file_get_contents('php://input'), true);
            $contact = new Contact (
                $_PUT["name"],
                $_PUT["lastName"], 
                $_PUT["email"], 
                $_PUT["phone"] 
            );
            $contact-> putContact($_GET['id']);
            $result["message"] =  "Update a user with the id:" .$_GET['id']
            . ", information to update: ".json_encode($_PUT);
            echo json_encode($result);
            
        break;
        case 'DELETE':
            Contact::deleteContact($_GET['id']);
            $result["message"] =  "Delete a user with the id: " .$_GET['id'];
            echo json_encode($result);

        break;
    }

?>