<?php   
      require_once './core/sessions/SessionFactory.php'; 

      define('CONFIGSESSION', array(
                                        'driver'                => Session::FILES_DRIVER,
                                        'cookie_name'           => sess_cookie_name,
                                        'save_path'             => __DIR__. DIRECTORY_SEPARATOR.'sessions',//'sessions',//
                                        'expiration'            => 7200,
                                        'regenerate_time'       => 300,
                                        'match_ip'              => true,
                                        'destroy_on_regenerate' => true
                                  ));
      
?>          