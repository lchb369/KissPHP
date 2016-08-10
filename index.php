<?php

/**
 * 唯一入口文件
 */

header( "Content-type:text/html;charset=utf-8" );

/**
 * 设配置调试模式
 * @var unknown
 */
define( 'DEBUG' , true );

/**
 * 初始化根目录绝对路径
 * @var unknown
 */
define( "ROOT_DIR" , dirname(  __FILE__  ) );

/**
 * 控制器目录
 * @var unknown
 */
define( "CON_DIR" , ROOT_DIR ."/Controller" );


/**
 * module目录
 * @var unknown
 */
define( "MOD_DIR" , ROOT_DIR ."/Module" );


/**
 * module目录
 * @var unknown
 */
define( "DATA_DIR" , ROOT_DIR ."/Data" );


/**
 * View目录
 * @var unknown
 */
define( "VIEW_DIR" , ROOT_DIR ."/View" );


/**
 * 核心库目录
 * @var unknown
 */
define( "LIB_DIR" , ROOT_DIR ."/Library" );


/**
 * 核心库目录
 * @var unknown
 */
define( "CORE_DIR" , LIB_DIR ."/Core" );



/**
 * 配置文件目录
 * @var unknown
 */
define( "CONFIG_DIR" , ROOT_DIR . "/Config" );



/**
 * 设置调试模式
 */
if( DEBUG  )
{
    ini_set( 'display_errors' , 'On' );
    error_reporting( E_ALL ^ E_NOTICE );
}
else
{
    ini_set( 'display_errors' , 'Off' );
    error_reporting( 0 );
}


/**
 * 加载核心类
 */
include LIB_DIR."/Core/Core.php";


?>
