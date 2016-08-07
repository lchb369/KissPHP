<?php


/**
 * 加载smarty模块
 */
include LIB_DIR."/Smarty/Smarty.class.php";


/**
 * 加载配置文件
 */
include CONFIG_DIR."/Constant.php";

/**
 * 加载Common公共函数类
 */
include LIB_DIR."/Common.php";

/**
 * 加载DOM函数类
 */
include LIB_DIR."/DOM.php";


/**
 * 加载请求封装类
 */
include CORE_DIR."/Request.php";


/**
 * 加载响应类
 */
include CORE_DIR."/Response.php";


/**
 * 加载控制器类
 */
include  CORE_DIR."/Controller.php";


/**
 *autoload 
 */
spl_autoload_register( 'loadClass' );

/**
 * 加载路由
*/
include CORE_DIR."/Router.php";


/**
 * 自动加载类文件
 * @param string $classname
 */
function loadClass( $classname ) 
{

	$classname = str_replace( '_' , '/' , $classname );
			
	//在模块文件夹搜索
	if( file_exists( LIB_DIR . "/{$classname}.php" ) )
	{
		include_once( LIB_DIR . "/{$classname}.php" );
		return ;
	}
	

	
	//在模块文件夹搜索
	if( file_exists( MOD_DIR . "/{$classname}.php" ) )
	{
		include_once( MOD_DIR . "/{$classname}.php" );
		return ;
	}
	

	//在控制器文件夹搜索
	if( file_exists( CON_DIR . "/{$classname}.php" ) )
	{
		include_once( CON_DIR . "/{$classname}.php" );
		return ;
	}
	
	
	//在模块文件夹搜索
	if( file_exists( ROOT_DIR . "/{$classname}.php" ) )
	{
		include_once( ROOT_DIR . "/{$classname}.php" );
		return ;
	}
}




?>