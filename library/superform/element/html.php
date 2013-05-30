<?php

namespace Equity\Library\SuperForm\Element {
    
    class HTML extends \Equity\Library\SuperForm\Element {
        
        public 
            $view = false,
            $html = '';
        
         public function getInnerHTML () {             
             return $this->html;
        }                
        
    }
    
}