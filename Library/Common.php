<?php

class Common
{

    /**
     * 获取配置文件
     * @param unknown $name
     * @param string $configType
     * @return Ambigous <>|Ambigous <multitype:, multitype:NULL >
     */
    public static function & getConfig( $key = ''  )
    {
        static $config = array();
        if( !$config )
        {
            $sysConfig = self::getSysConfig();
            	
            if( $sysConfig )
            {
                $config = self::getConfigFile( $sysConfig );
            }
            $config = array_merge_recursive( $config , self::getConfigFile( "Server" ) );
        }

        if( !isset( $config[$key] ) )
        {
            $config[$key] = self::getConfigFile( $key , $config['gameConfigPath'] );
        }


        if( $key )
            return $config[$key];

        return $config;
    }

    /**
     * 获取系统配置文件
     * @return string
     */
    protected static function getSysConfig()
    {
        $sysConfig = "DefaultConfig";
        return $sysConfig;
    }

    
    public static function loadConfig( $file )
    {
        if( file_exists( CONFIG_DIR . "/{$file}.php" ) )
        {
            require( CONFIG_DIR . "/{$file}.php" );
        }
       
    }
    
    
    public static function getFileConfig(  $file , $key = ''  )
    {
        if( file_exists( CONFIG_DIR . "/{$file}.php" ) )
        {
            $config = require( CONFIG_DIR . "/{$file}.php" );
        }
  
        if( $key )
        {
            return $config[$key];
        }
        return $config;
    }
    
    /**
     * 加载配置文件
     * @param unknown $configKey
     * @return multitype:
     */
    protected static function & getConfigFile( $configKey , $path = '' )
    {
        $config = array();
        if( $path )
        {
            if( file_exists( $path . "/{$configKey}.php" ) )
            {
                $config = require( $path . "/{$configKey}.php" );
            }
            return $config;
        }

        if( file_exists( CONFIG_DIR . "/{$configKey}.php" ) )
        {
            $config = require( CONFIG_DIR . "/{$configKey}.php" );
        }


        return $config;
    }

    /**
     * 获取缓存对象
     */
    public static function & getCache( $key = null )
    {
        static $cache = null;
        if( $cache == null )
        {
            $config = Common::getConfig( $config['cacheType'] );

            if( $config['cacheType'] == 'memcache' )
            {
                $cache = new Cache_Memcache(  $config  );
            }
            else if( $config['cacheType'] == 'redis' )
            {
                $cache = new Cache_Redis( $config );
            }
        }
        return $cache;
    }

    /**
     * @param int $unId 唯一ID/用户ID
     * @param string $key 按业务分库，
     * 不同的业务可能用到的是不用的存储库
     * 比如游戏数据用mysql gamedb , 用户库用userdb
     * 统计库用mongo
     */
    public static function & getDB(  $unId = 0 , $key = null )
    {
            return DB_PDO::getInstance();
    }
}

	

?>