<?php

class Request
{
    /**
     * GET方式
     * @param string $key
     */
    public  static function get( $key = '' )
    {
        if( $key )return $_GET[$key];
        return $_GET;
    }
    
    /**
     * POST方式
     * @param string $key
     */
    public  static function post( $key = '' )
    {
        if( $key )return $_POST[$key];
        return $_POST;
    }
    
    
    /**
     * INPUT方式
     * @param string $key
     */
    public  static function input( $key = '' )
    {
        if( $key )return $_POST[$key];
        return $_POST;
    }
    
    
    
    public static function getParams( $key = '' )
    {
        if( $key )return $_REQUEST[$key];
        return $_REQUEST;
    }
    
    
    
    
    
    
}