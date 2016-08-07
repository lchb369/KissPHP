<?php

/**
 * news数据层
 * @author bona
 *
 */
class Data_News_Model 
{
    
    protected $db = null;
    
    
    protected static  $instance = null;
    
    
    /**
     * 构造函数
     */
    protected function __construct()
    {
        $this->db = Common::getDB();
        $this->db->setTable( 'news' );
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
     * 获取列表
     */
    public function get()
    {
        $cond = array(
            'limit' => 10,
            'order' => ' id desc '
        );
        
        $where = array(
            'id' => 1,
        );
        $ret = $this->db->select( "*" , $where , $cond );
    }
    
    
    /**
     * 新增数据
     * @param unknown $data
     */
    public  function add( $data )
    {
        //$this->update($data);
        $this->db->add(  $data );
    }
    
    
    /**
     * 更新数据
     * @param unknown $data
     * @param unknown $where
     */
    public function update( $data , $where )
    {
        $ret = $this->db->update(  $data , $where );
    }
    
    
    /**
     * 删除记录
     * @param unknown $where
     */
    public function delete( $where )
    {
        $ret = $this->db->delete(  $where );
    }
    
}