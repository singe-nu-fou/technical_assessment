<?php
    class mailer{
        protected $name;
        protected $address1;
        protected $address2;
        protected $city;
        protected $state;
        protected $zip;
        protected $phone;
        protected $budget;
        protected $option;
        protected $desc;
        
        private $headers = array();
        private $to = 'nobody@example.com';
        private $subject;
        private $message;
        
        public function __construct(){
            if(!isset($_POST['dataObj'])){
                die('There was an error in processing your request.');
            }
            foreach(json_decode($_POST['dataObj']) AS $data){
                switch($data->name){
                    case 'firstName':
                    case 'lastName':
                        $this->name[] = $data->value;
                        break;
                    case 'PRE':
                    case 'N1':
                    case 'N2':
                        $this->phone[] = $data->value;
                        break;
                    case 'desc':
                        if($this->option !== 'Other'){
                            unset($this->desc);
                        }
                        else{
                            $this->{$data->name} = $data->value;
                        }
                        break;
                    default:
                        $this->{$data->name} = $data->value;
                        break;
                }
            }
            $this->name = implode(' ',$this->name);
            $this->phone = implode('-',$this->phone);
        }
        
        public function sendMail(){
            $this->setSubject();
            $this->setHeaders();
            $this->setMessage();
            
            /*if(mail($this->to, $this->subject, $this->message, implode('\r\n',$this->headers))){
                die('Successfully submitted your request!');
            }*/
            
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
            print_r($this);
            die('There was an error in processing your request. Please contact us at XXX-XXX-XXXX for further assistance.');
        }
        
        protected function setHeaders(){
            $headers[] = "Content-type: text/plain; charset=iso-8859-1";
            $headers[] = "From: webmaster@example.com";
            $headers[] = "Reply-To: webmaster@example.com";
            $headers[] = "Subject: {$this->subject}";
            $headers[] = "X-Mailer: PHP/".phpversion();
            
            $this->headers = implode('\r\n',$headers);
        }
        
        protected function setSubject(){
            $this->subject = $this->name.' is interested in purchasing property!';
        }
        
        protected function setMessage(){
            $this->message = $this->name.' heard about us recently from ('.$this->option.')
                                        and would like to look into our services to purchase
                                        a home! They have a budget of $'.$this->budget.' 
                                        and can be contacted at the following:
                                        '.$this->address1.' 
                                        '.$this->address2.' 
                                        '.$this->city.', '.$this->state.' '.$this->zip;
        }
    }
    
    $mailer = new mailer;
    $mailer->sendMail();