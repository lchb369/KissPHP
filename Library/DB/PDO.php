<?php
/**
 * 
 * 数据库连接池
 * @author liuchangbin
 * 
 */
class DB_PDO
{

	//pdo对象
	private $_pdo = null;
	
    private $_table;
    
	//用于存放实例化的对象
	static private $_instance = null;
	
	//公共静态方法获取实例化的对象
	static public function getInstance() 
	{
	    if ( self::$_instance == null )
	    {
	        self::$_instance = new self();
	    }
	    return self::$_instance;
	}
	
	//私有克隆
	private function __clone() 
	{
	    
	}
	
	//私有构造
	private function __construct()
	{
	    try {
	        
	        $mysql = Common::getFileConfig( 'Mysql' );
	        $config = $mysql['default'];
	        
	        $db_host = $config['hostname'];
	        $db_name =  $config['database'];
	        $dsn = "mysql:host=$db_host;dbname=$db_name";
	        
	        $attr = array( PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES '.$config['char_set'] );
	        $this->_pdo  = new PDO($dsn, $config['username'], $config['password'] , $attr );
	        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    }
	    catch (PDOException $e) 
	    {
	        exit($e->getMessage());
	    }
	}
	
	/**
	 * 设置表
	 * @param unknown $table
	 */
	public function setTable( $table )
	{
	    $this->_table = $table;
	}
	
	
	/**
	 * 新增数据
	 * @param unknown $data
	 * @return number
	 */
	public function add( $params )
	{
	    if( empty( $params ))return 0;
	    
	    $fieldStr = implode(',', array_keys( $params ));
	    $fieldVals = array_values( $params );
	    $values = '';
	    $values =  str_pad( $values, count( $fieldVals)*2 - 1 ,"?," );
	    $sql = "INSERT INTO {$this->_table} ( $fieldStr ) VALUES ( $values ) ";
	    
	    return $this->execute( $sql , $fieldVals );
	}
	
    /**
     * 更新数据
     * @param unknown $_tables
     * @param array $_param
     * @param array $_updateData
     */
	public function update( $updateData ,  $conditions )
	{
	    $where = $set = array();
	    foreach ( $updateData as $key=> $value )
	    {
	            $set[]= "$key=?";
	            $values[] = $value;
	    }
	    
	    foreach ( $conditions as $key=> $value)
	    {
	           $where[] = "$key=?";
	           $values[] = $value;
	    }
	    
	    $setStr = implode( ",", $set );
	    $whereStr = implode( ",", $where );
	    if(  $whereStr ) $whereStr = " WHERE ".$whereStr;
	    $sql = "UPDATE {$this->_table} SET {$setStr} {$whereStr} ";
	    return $this->execute($sql,$values)->rowCount();
	}
	

	/**
	 * 删除
	 * @param unknown $condition
	 */
	protected function delete( $condition )
	{
	    $where = '';
	    foreach ( $condition as $key=>$value)
	    {
	        $where .= $value.' AND ';
	    }
	    $where = 'WHERE '.$where;
	    $sql = "DELETE FROM {$this->_table} $where ";
	    return $this->execute( $sql )->rowCount();
	}
	
	
	
	public function findWhere( $where )
	{
	    
	    
	}
	
	
	public function findWhereLike( $where , $like )
	{
	    
	}
	
	/**
	 * 查询操作
	 * @param string $filelds
	 * @param unknown $where
	 * @param unknown $condtions
	 */
	public function select( $filelds = "*" ,  $where = array() ,   $condtions = array() )
	{
	    $limit = $order = $like = '';
	    $whereArr = $valArr =  array();
	    
	    if ( is_array( $where ))
	    {
	        if ( $where )
	        {
	            foreach ( $where as $key=> $value)
	            {
	                $whereArr[] = " AND $key = ? ";
	                $valArr[] = $value;
	            }
	        }

	        $whereStr = " WHERE 1 ".implode( " ",  $whereArr );
	        $limit = isset($condtions['limit']) ? 'LIMIT '.$condtions['limit'] : '';
	        $order = isset($condtions['order']) ? 'ORDER BY '.$condtions['order'] : '';
	    }
	   
	    $table = $this->_table;
	    $sql = "SELECT $filelds FROM $table $whereStr $like $order $limit";
	   
	    $stmt = $this->execute( $sql , $valArr  );
	    $result = array();
	   
	    while ( $objs = $stmt->fetch( PDO::FETCH_ASSOC ))
	    {
	        $result[] = $objs;
	    }
	    return $result;
	}
	
	
	
	//总记录
	protected function total($_tables, Array $_param = array()) {
	    $_where = '';
	    if (isset($_param['where'])) {
	        foreach ($_param['where'] as $_key=>$_value) {
	            $_where .= $_value.' AND ';
	        }
	        $_where = 'WHERE '.substr($_where, 0, -4);
	    }
	    $_sql = "SELECT COUNT(*) as count FROM $_tables[0] $_where";
	    $_stmt = $this->execute($_sql);
	    return $_stmt->fetchObject()->count;
	}
	
	//得到下一个ID
	protected function nextId($_tables) {
	    $_sql = "SHOW TABLE STATUS LIKE '$_tables[0]'";
	    $_stmt = $this->execute($_sql);
	    return $_stmt->fetchObject()->Auto_increment;
	}
	
	
	//执行SQL
	private function execute($sql , $values )
	{
	    try {
	        $stmt = $this->_pdo->prepare($sql);
	        $stmt->execute( $values );
	    }
	    catch (PDOException  $e)
	    {
	        exit('SQL语句：'.$sql.'<br />错误信息：'.$e->getMessage());
	    }
	    return $stmt;
	}
	
		
	
}
