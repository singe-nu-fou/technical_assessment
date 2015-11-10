<style>
    ol{
        list-style-type:none;
        float:left;
    }
    li{
        display:inline;
    }
    a{
        text-decoration:none;
        color:black;
    }
</style>
<?php
    class Template{
        protected $breadcrumbs = array();

        protected function getBreadcrumbNavigation(){
            $breadcrumbs = array('<ol>');
            
            foreach($this->myUrl AS $value){
                $breadcrumbs[] = ($value === $this->anchorText) ? '<li>&nbsp;/&nbsp;<a href="/'.implode('/',$this->myUrl).'">'.$value.'</a></li>' : '<li>&nbsp;/&nbsp;'.$value.'</li>';
            }
            
            $breadcrumbs[] = '</ol>';
            
            $this->breadcrumbs = implode('',$breadcrumbs);
        }
        
        public function getBreadcrumbs(){
            return $this->breadcrumbs;
        }
    }

    class Webpage extends Template{
        public $anchorText;
        public $myUrl;

        public function __construct(){
            $this->myUrl = explode('/',ltrim($_SERVER['REQUEST_URI'],'/'));
            
            if(strlen(trim($this->myUrl[(count($this->myUrl) - 1)])) === 0){
                $this->anchorText = $this->myUrl[(count($this->myUrl) - 2)];
                unset($this->myUrl[(count($this->myUrl) - 1)]);
            }
            
            else{
                $this->anchorText = $this->myUrl[(count($this->myUrl) - 1)];
            }
            
            $this->getBreadcrumbNavigation();
        }
    }
    
    print_r('<pre>');
    
    $webpage = new Webpage;
    
    echo $webpage->getBreadcrumbs();
    exit;
?>