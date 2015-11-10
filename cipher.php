<?php
    class cipher{
        protected $message;
        protected $decode = false;
        
        private $alphabet;
        private $atbash;
        private $atbashA1Z26;
        private $A1Z26;
        private $caesar;
        private $caesarA1Z26;
        
        public function __construct($message = 'DEFAULT'){
            $this->message = $message;
            $this->alphabet = range('A','Z');
            $this->atbash = array_reverse($this->alphabet);
            $this->atbashA1Z26 = array_flip($this->atbash);
            $this->A1Z26 = array_flip($this->alphabet);
            $this->caesar = array_merge(range('X','Z'),range('A','W'));
            $this->caesarA1Z26 = array_flip($this->caesar);
        }
        
        public function chrord(){
            foreach((($this->decode === true) ? explode('%',$this->message) : str_split($this->message)) AS $code){
                $array[] = ($this->decode === true) ?  chr($code) : ord($code);
            }
            
            $this->message = implode((($this->decode === true) ? '' : '%'),$array);
            
            return $this;
        }
        
        public function A1Z26(){
            foreach((($this->decode === true) ? explode('-',$this->message) : str_split($this->message)) AS $code){
                if(array_key_exists(strtoupper($code),$this->alphabet) && $this->decode === true){
                    $array[] = $this->alphabet[$code];
                }
                elseif(array_key_exists(strtoupper($code),$this->A1Z26)){
                    $array[] = $this->A1Z26[strtoupper($code)];
                }
                else{
                    $array[] = $code;
                }
            }
            
            $this->message = implode((($this->decode === true) ? '' : '-'),$array);
            
            return $this;
        }
        
        public function base64(){
            $this->message = ($this->decode === true) ? base64_decode($this->message) : base64_encode($this->message);
            
            return $this;
        }
        
        public function caesar(){
            foreach(str_split($this->message) AS $code){
                if(array_key_exists(strtoupper($code),$this->caesarA1Z26) && $this->decode === true){
                    $array[] = (ctype_upper($code) === true) ? $this->alphabet[$this->caesarA1Z26[strtoupper($code)]] : strtolower($this->alphabet[$this->caesarA1Z26[strtoupper($code)]]);
                }
                
                elseif(array_key_exists(strtoupper($code),$this->A1Z26)){
                    $array[] = (ctype_upper($code) === true) ? $this->caesar[$this->A1Z26[strtoupper($code)]] : strtolower($this->caesar[$this->A1Z26[strtoupper($code)]]);
                }
                
                else{
                    $array[] = $code;
                }
            }
            
            $this->message = implode('',$array);
            
            return $this;
        }
        
        public function caesarA1Z26(){
            foreach(str_split($this->message) AS $code){
                if(array_key_exists(strtoupper($code),$this->caesarA1Z26) && $this->decode === true){
                    $array[] = (ctype_upper($code) === true) ? $this->alphabet[$this->caesarA1Z26[strtoupper($code)]] : strtolower($this->alphabet[$this->caesarA1Z26[strtoupper($code)]]);
                }
                
                elseif(array_key_exists(strtoupper($code),$this->A1Z26)){
                    $array[] = (ctype_upper($code) === true) ? $this->caesar[$this->A1Z26[strtoupper($code)]] : strtolower($this->caesar[$this->A1Z26[strtoupper($code)]]);
                }
                
                else{
                    $array[] = $code;
                }
            }
            
            $this->message = implode('',$array);
            
            return $this;
        }
        
        public function getMessage(){
            return $this->message;
        }
        
        public function toggleDecode(){
            $this->decode = ($this->decode === true) ? false : true;
            
            return $this;
        }
    }
    
    $cipher = new cipher('I\'m really bored...');
    echo $cipher->A1Z26()->getMessage();
    echo '<br>';
    echo $cipher->toggleDecode()->A1Z26()->getMessage();