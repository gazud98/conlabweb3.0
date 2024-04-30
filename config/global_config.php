<?php   
        //Constantes Globales del sistema definidas para 
        
        //timezone default
        date_default_timezone_set('America/Bogota');
        //UTF8 enabled or disable
        define('UTF8_ENABLED', TRUE);

        //base url : falta automatizar proceso
        define('base_url','/cw3/conlabweb3.0/');// define('base_url',.$_SERVER['SERVER_NAME'].'/cw3/conlabweb3.0/index.php');
        define('base_url_qr','/cw3/conlabweb3.0/appsdata/qr/');// define('base_url',.$_SERVER['SERVER_NAME'].'/cw3/conlabweb3.0/index.php');
        define('base_url_images','/cw3/conlabweb3.0/appsdata/images/');// define('base_url',.$_SERVER['SERVER_NAME'].'/cw3/conlabweb3.0/index.php');
        define('base_url_video','/cw3/conlabweb3.0/appsdata/video/');// define('base_url',.$_SERVER['SERVER_NAME'].'/cw3/conlabweb3.0/index.php');
        define('base_url_pdf','/cw3/conlabweb3.0/appsdata/pdf/');// define('base_url',.$_SERVER['SERVER_NAME'].'/cw3/conlabweb3.0/index.php');

            //dbmaster
        define('cw3ctrlsrv',"u116753122_cw3completa"); //prefijo de bd
        define('hostname','localhost');//"localhost";//;			//myserver
        define('bbserver1',"u116753122_cw3completa");		//Change to your current database name
        define('db_login',"root");//"root"; //		//MySQL user name
        define('db_pass',"");//"Q2w3e4r5t6y7u8"; // ;				//MySQL user password

        define('cw3ctrlclt',"u116753122_cw3completa"); //prefijo de bd

        define('limitinpantalla','15');       //15 es el limite en pantalla ese esxcribe en el index.php jcial





        //clave publica por defecto "conlabweb32022"
        define('CONTROLADOR_DEFECTO', 'App');
        define('ACCION_DEFECTO', 'index');
        define('PREFIX_DEFAULT', 'cw3');
        define('KEY_PUBLIC_DEFAULT','efe4669becb1e6f3ca8bd44b3ee6f9c5');
        //pasteur defauld 7a2ce0073728f13046b38a77a534429d
        define('PASSWORD_DEFAULT_EMPLEADOS', '$2y$10$kH8jPkmYydI6cONc0E3maudhcvZ7Zh4NUZjkGVWvQlL0f/ZN2DeFW'); //PW = passteur2023
   
        define('CONEXIONDBCW', array( "driver"    =>"mysql",
                                      "host"      =>"localhost",
                                      "user"      =>"root",
                                      "pass"      =>"",
                                      "database"  =>"u116753122_cw3completa",
                                      "charset"   =>"utf8" ));
        /*
        |--------------------------------------------------------------------------
        | Website details
        |
        | These details are used in emails sent by authentication library.
        |--------------------------------------------------------------------------
        */
        define('website_name', 'Conlab3');
        define('webmaster_email','contacto@globalconsultor.com');

        /*
        |--------------------------------------------------------------------------
        | Security settings
        |
        | The library uses PasswordHash library for operating with hashed passwords.
        | 'phpass_hash_portable' = Can passwords be dumped and exported to another server. If set to FALSE then you won't be able to use this database on another server.
        | 'phpass_hash_strength' = Password hash strength.
        |--------------------------------------------------------------------------
        */
         define('phpass_hash_portable',TRUE);
         define('phpass_hash_strength',8);

        /*
        |--------------------------------------------------------------------------
        | Registration settings
        |
        | 'allow_registration' = Registration is enabled or not
        | 'captcha_registration' = Registration uses CAPTCHA
        | 'email_activation' = Requires user to activate their account using email after registration.
        | 'email_activation_expire' = Time before users who don't activate their account getting deleted from database. Default is 48 hours (60*60*24*2).
        | 'email_account_details' = Email with account details is sent after registration (only when 'email_activation' is FALSE).
        | 'use_username' = Username is required or not.
        |
        | 'username_min_length' = Min length of user's username.
        | 'username_max_length' = Max length of user's username.
        | 'password_min_length' = Min length of user's password.
        | 'password_max_length' = Max length of user's password.
        |--------------------------------------------------------------------------
        */
         define('allow_registration',FALSE);
         define('captcha_registration',FALSE);
         define('email_activation',TRUE);
         define('email_activation_expire',60*60*24*2);
         define('email_account_details',TRUE);
         define('use_username',TRUE);

         define('username_min_length',4);
         define('username_max_length',20);
         define('password_min_length',4);
         define('password_max_length',20);

        /*
        |--------------------------------------------------------------------------
        | Login settings
        |
        | 'login_by_username' = Username can be used to login.
        | 'login_by_email' = Email can be used to login.
        | You have to set at least one of 2 settings above to TRUE.
        | 'login_by_username' makes sense only when 'use_username' is TRUE.
        |
        | 'login_record_ip' = Save in database user IP address on user login.
        | 'login_record_time' = Save in database current time on user login.
        |
        | 'login_count_attempts' = Count failed login attempts.
        | 'login_max_attempts' = Number of failed login attempts before CAPTCHA will be shown.
        | 'login_attempt_expire' = Time to live for every attempt to login. Default is 24 hours (60*60*24).
        |--------------------------------------------------------------------------
        */
         define('login_by_username',TRUE);
         define('login_by_email',TRUE);
         define('login_record_ip',TRUE);
         define('login_record_time',TRUE);
         define('login_count_attempts',TRUE);
         define('login_max_attempts',3);
         define('login_attempt_expire',60*60*24);

        /*
        |--------------------------------------------------------------------------
        | Auto login settings
        |
        | 'autologin_cookie_name' = Auto login cookie name.
        | 'autologin_cookie_life' = Auto login cookie life before expired. Default is 2 months (60*60*24*31*2).
        |--------------------------------------------------------------------------
        */
         define('autologin_cookie_name','autologin');
         define('autologin_cookie_life',60*60*24*31*2);

        /*
        |--------------------------------------------------------------------------
        | Forgot password settings
        |
        | 'forgot_password_expire' = Time before forgot password key become invalid. Default is 15 minutes (60*15).
        |--------------------------------------------------------------------------
        */
         define('forgot_password_expire',60*15);

        /*
        |--------------------------------------------------------------------------
        | reCAPTCHA
        |
        |'use_recaptcha' = Use reCAPTCHA instead of common captcha
        | You can get reCAPTCHA keys by registering at http://recaptcha.net
        |--------------------------------------------------------------------------
        */
         define('use_recaptcha', FALSE);
         define('recaptcha_public_key','');
         define('recaptcha_private_key','');

        /*
        |--------------------------------------------------------------------------
        | Database settings
        |
        | 'db_table_prefix' = Table prefix that will be prepended to every table name used by the library
        | (except 'ci_sessions' table).
        |--------------------------------------------------------------------------
        */
         define('db_table_prefix','');
         //Constantes por reubicar
         define('sess_cookie_name','conlab3');
         define('ip_address',$_SERVER['REMOTE_ADDR']);
         define('user_agent',$_SERVER['HTTP_USER_AGENT']);

         define('csrf_protection', FALSE);
         define('csrf_token_name', 'csrf_test_name');
         define('csrf_cookie_name', 'csrf_cookie_name');
         define('csrf_expire', 7200);
         define('csrf_regenerate', TRUE);
         define('csrf_exclude_uris', array());

         define('charset','UTF-8');
         define('cookie_prefix',' ');
         define('cookie_domain',' ');
         define('cookie_path','/');
         define('cookie_secure',FALSE);
         define('cookie_httponly', FALSE);
         define('proxy_ips', '');

         #El sistema JAAR esta preparado para ser multilenguaje

         /* 
           Form validation lang select
           spanish => ES
           english => ENG
         */ 

        define('lang_validation','ES');
         

?>
