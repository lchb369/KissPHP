<?php

/**
 * 控制器基类
 * @author bona
 *
 */ 
class Controller
{
    
    public $smarty = null;
    
    
    public $params = array();
    
    /**
     * 构造函数
     */
    public function __construct()
    {
           $this->smarty = new Smarty();
           $this->smarty->debugging = SMARTY_DEBUGGING;
           $this->smarty->caching = SMARTY_CACHING;
           $this->smarty->cache_lifetime = SMARTY_CACHE_LIFTTIME;
           $this->smarty->left_delimiter = SMARTY_LEFT_DELIMITER;
           $this->smarty->right_delimiter = SMARTY_RIGHT_DELIMITER;
           $this->smarty->compile_dir= SMARTY_COMPILE_DIR;
    }
    
    
    /**
     * 获取输入参数
     * @param string $key
     */
    public function get( $key = '' )
    {
        return Request::get( $key );
    }
    
    
    /**
     * 获取输入参数
     * @param string $key
     */
    public function input( $key = '' )
    {
        return Request::input( $key );
    }
    
    
    /**
     * 获取输入参数
     * @param string $key
     */
    public function params( $key = '' )
    {
        return Request::input( $key );
    }
    
    /**
     * 向视图注册键值对
     * @param unknown $key
     * @param unknown $val
     */
    public function assign( $key , $val )
    {
        $this->smarty->assign( $key , $val );
    }
    
    
    /**
     * 显示视图
     * @param unknown $tpl
     */
    public function view( $tpl )
    {
        $tpl = VIEW_DIR."/Front/".$tpl;
        $this->smarty->display(  $tpl );
    }
    
    
    /**
     * 显示视图
     * @param unknown $tpl
     */
    public function display( $tpl )
    {
        $this->view($tpl);
    }
    
    /**
     * 显示视图
     * @param unknown $tpl
     */
    public function show( $tpl )
    {
        $this->view($tpl);
    }
    
    
    /**
     * 输出
     * @param unknown $data
     */
    public  function out( $data )
    {
        echo $data;exit;
    }
}