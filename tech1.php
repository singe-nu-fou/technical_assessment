<?php 
    class Webpage{ 
        private $myUrl;
        private $requestedUrl;
        
        public function __construct($myUrl){
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])){
                $this->myUrl = $_POST['myUrl'];
            }
            else{
                $this->myUrl = $_SERVER['HTTP_REFERER'];
            }
            
            $this->requestedUrl = $_POST['requestedUrl'];
        }
        
        public function showHighlight(){
            $myUrl = explode('/',$this->myUrl);
            $requestedUrl = explode('/',$this->requestedUrl);
            
            if(count($myUrl) !== count($requestedUrl) && ($requestedUrl[(count($requestedUrl) - 1)] !== $myUrl[(count($myUrl) - 2)])){
                return false;
            }
            
            foreach($myUrl AS $key=>$value){
                if($requestedUrl[$key] !== $value){
                    return false;
                }
            }
            
            return true;
        }
    }
?>