<?php

/**
 * 首页
 * @author bona
 *
 */

class IndexController extends Controller
{
   
    /**
     * 默认请求
     */
    public function index()
    {
        $news = News_Module::getInstance()->addNews( "xxx" );
        
        $test = "xxxxxxxxxxxxxx";
        
        $this->assign( "test" , $test );
        
        $this->display( "index.html" );
    }
    
   
    
    
    
    
}