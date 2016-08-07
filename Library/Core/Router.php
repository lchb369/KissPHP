<?php

/**
 * 路由器
 * @author bona
 */
class Router
{
        /**
         * 模块名
         * @var unknown
         */
        private  $_mod;
        
        /**
         * 方法名
         * @var unknown
         */
        private  $_action;
    
    
        
        public function __construct()
        {
           
        }   
    
        
        public function getCtrFloder()
        {
            return FRONT_CONTROLLER_FLODER;
        }
        
        
        /**
         * 路由分发
         */
        public function dispacher()
        {
            $this->_mod = $_GET['mod'] ? $_GET['mod']  : 'index';
            $this->_action = $_GET['act'] ?  $_GET['act']  : 'index';
            $controller = ucfirst( strtolower( $this->_mod ) ) . 'Controller';
            $action = $this->_action;
            $ctrFloder = $this->getCtrFloder();
            $ctrPath = CON_DIR ."/".$ctrFloder. "/{$controller}.php";
            
            if( file_exists( $ctrPath ) )
            {
                include_once( $ctrPath  );
                $object = new $controller;
                if( method_exists( $object , $action ) )
                {
                    try
                        {
                        $data = $object->$action();
                        DOM::save();
                    }
                    catch ( Exception $e )
                    {
                        $data = new stdClass();
                        $code = $e->getCode();
                        $msg = $e->getMessage();
                    }
                }
            }
            else
              {
                echo json_encode( array( 'code' => 3 , 'msg' => 'method not exist' ) );exit;
            }
        }
        
}

$router = new Router();
$router->dispacher();