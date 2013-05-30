<?php


namespace Equity\Library\SuperForm\Element {
    
    class Named extends \Equity\Library\SuperForm\Element {
        
        public
            $name;                    
        
        public function __construct ($data = array()) {
            
            parent::__construct($data);
            
            if (!isset($this->name)) {
                $this->name = $this->id;
                $this['name'] = $this->name;
            }
            
        }
        
        public function __toString () {                                               
            if (!isset($this->name)) {
                $this->name = $this->id;
            }
            return parent::__toString();
        }
        
    }
    
}