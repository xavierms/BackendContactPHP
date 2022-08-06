<?php 

        class Contact{
            private $name;
            private $lastName;
            private $email;
            private $phone;

            public function __construct($name, $lastName, $email, $phone){
                $this->name = $name;
                $this->lastname = $lastName;
                $this->email = $email;
                $this->phone = $phone;
            }

            public function saveContact(){
                
                //variables are represented with "$" at the beginning
                $contentFile = file_get_contents("../data/contacts.json");
                //file_get_contents, get data from a file and convert it to string
                $contacts = json_decode($contentFile, true);
                //json_decode, convert string to json
                $contacts[] = array(
                   "name"=> $this-> name, 
                   "lastname"=> $this-> lastname, 
                   "email"=> $this-> email, 
                   "phone"=> $this-> phone, 
                );
                $file = fopen("../data/contacts.json", "w");
                /*'w'	Open for writing only; place the file 
                pointer at the beginning of the file and truncate 
                the file to zero length. If the file does not exist,
                 attempt to create it.*/
                fwrite($file,json_encode($contacts));
                fclose($file);
            }
            public static function getContact(){
                $contentFile = file_get_contents("../data/contacts.json");
                
                echo $contentFile;
            }
            public static function getContactId($id){
                $contentFile = file_get_contents("../data/contacts.json");
                $contacts = json_decode($contentFile, true);
                if (!isset($contacts[$id])) {
                    echo "This id don't exist";
                }
                else{

                    echo json_encode($contacts[$id]);
                }
            }
            public function putContact($id){
                $contentFile = file_get_contents("../data/contacts.json");
                $contacts = json_decode($contentFile, true);
                // $contacts = $contacts[$id];
                $contact = array(
                    'name'=> $this->name, 
                    'lastname'=> $this->lastname, 
                    'email'=> $this->email, 
                    'phone'=> $this->phone 
                );
                $contacts[$id] = $contact;
                $file = fopen('../data/contacts.json','w');
                fwrite($file, json_encode($contacts));
                fclose($file);
            }
            public static function deleteContact($id){
                $contentFile = file_get_contents("../data/contacts.json");
                $contacts = json_decode($contentFile, true);
                array_splice($contacts, $id, 1);
                $file = fopen('../data/contacts.json','w');
                fwrite($file, json_encode($contacts));
                fclose($file);
            }
        }
?>