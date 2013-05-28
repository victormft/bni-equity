<?php


namespace Equity\Core {

    class View extends \ArrayObject implements Resource, Resource\MIME {
        
        private 
            $file;
                        
        public function __construct ($file, $vars = null) {
            
            if (!is_file($file)) {                
                throw new View\Exception("La vista no exists: `{$file}`");            
            }
            
            $this->file = $file;
            
            if (isset($vars)) {
                $this->set($vars);
            }
            
        }
        
        public function set ($var) {
            
            if (is_array($var) || is_object($var)) {
                foreach ($var as $name => $value) {
                    $this[$name] = $value;
                }
            } else if (is_string($var) && func_num_args() >= 2) {
                $this[$var] = func_get_arg(1);
            } else {
                throw new View\Exception;
            }
            
        }
        
        public function getMIME () {
            
            // @todo Adivinar por la extensión
            return 'text/html';
        }
        
        public function __toString () {
            
            ob_start();
            
            include $this->file;
            
            return ob_get_clean();
            
        }
        
        
    }    
}