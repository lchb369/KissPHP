<?php
return array(
		
		//游戏配置路径
		'gameConfigPath' => '/home/www/wwwroot/app/config/20130201',
		
		//redis,memcache可选
		'cacheType' => 'memcache',
		
		//memcache配置
		'memcache' => array(
				array(	"host" => "127.0.0.1" , "port" => 11211 ) ,
				array(	"host" => "127.0.0.1" , "port" => 11212 ) ,
		),
		
		//redis配置
		'redis' => array(
                'pconnect'=>true,
                'host'=>'127.0.0.1',
                'port'=> 6379,
                'timeout'=> 5
		),
		 
		//mysql连接池配置
		'pdo' => array(
			'data' => array( 'host' => '127.0.0.1' , 'port' => '3306' , 'user' => 'root' , 'passwd' => 'root' , 'name' => 'xproject' ) ,
		),
);