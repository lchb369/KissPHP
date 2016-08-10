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
        
        $this->export();exit;
        
        $test = "world xxxx";
        
        $this->assign( "test" , $test );
 
        $this->view( "index.html" );
    }
    
    
    
    public function export()
    {
        
        include LIB_DIR."/PHPExcel.php";
        

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $data = array(
            array( "a" => 111, "b" => 333, "c" => "444" ),
            array( "a" => 3333, "b" => 1111, "c" => "xxx" ),
            array( "a" => "ffff", "b" => "xxx", "c" => "444" ),
            array( "a" => 111, "b" => 333, "c" => "444" ),
        );
        
        $excelData = array(
            "test",
            array( "aaa" , "bbb" , "ccc"),
            array( "a" , "b" , "c" ),
            $data,
        );
        
        $objPHPExcel->exportArray(   $excelData );
        exit;
        
    }
    
    
    
}