<?php

class News_Module
{
    
    
    protected static $instance = null;
    
    /**
     * 构造函数，设为protected，防止直接new
     */
    protected function __construct()
    {
       
    }
    
    /**
     * 单例模式
     */
    public static function  getInstance()
    {
        if( self::$instance == null )
        {
            self::$instance = new self();
        }
        return   self::$instance;
    }
    
    
    /**
     * 添加一条新闻
     */
    public function addNews()
    {
        $data = array(
            'title' => "title ".rand( 1 , 10000 ),
            'content' => "content...".rand( 1, 100000 ),
        );
        Data_News_Model::getInstance()->add( $data );
    }
    
    
    
    
    
}