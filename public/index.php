<?php
require("../vendor/autoload.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $router = new \Router\Router();

    $router->add('/', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/index.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/");  
        }
    });

    $router->add('/auth/login', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/auth/login.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/auth/login");  
        }
        
    });

    $router->add('/auth/register', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/auth/register.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/auth/register");  
        }
        
    });

    $router->add('/auth/logout', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/auth/logout.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/auth/logout");  
        }
    });

    $router->add('/i', function() {
        require("../index.php");
        require("../view/image/imageEmbed.php");
    });

    $router->add('/dashboard', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/images.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/dashboard");  
        }
        
    });

    $router->add('/config', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/embedConfig.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/config");  
        }
        
    });

    $router->add("/api/config", function() {
        require("../index.php");
        require("../api/sharex.php");
    });

    $router->add("/api/upload", function() {
        require("../index.php");
        require("../api/upload.php");
    });

    $router->add("/domains", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/domainList.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/domains");  
        }
    });

    $router->add("/maintenance", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/ui/maintenance.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/maintenance");  
        }
    });

    $router->add("/domain/add",function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/addDomain.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/domain/add");  
        }
    });

    $router->add("/admin",function() {
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/mainPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin");  
        }
    });

    $router->add("/admin/settings",function(){
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/settingsPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/settings");  
        }
    });
    

    $router->add("/admin/settings/advanced",function(){
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/advancedsettingsPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/settings/advanced");  
        }
    });


    $router->add("/admin/settings/mail",function(){
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/emailPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/settings/mail");  
        }
    });

    $router->add("/admin/api",function(){
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/apiPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/api");  
        }
    });

    $router->add("/admin/api/new", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/api/create.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/api/new");  
        }
        
    });

    $router->add("/admin/users", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/usersPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/users");  
        }
        
    });

    $router->add("/admin/domains", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/doaminsPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/domains");  
        }
        
    });

    $router->add("/admin/nodes", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            echo '<font color="red">This thing is not done yet do not try to bypass or enable this function yet!!</font>';
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/nodes");  
        }
        
    });

    $router->add("/api/delete", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../api/delete.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/api/delete");  
        }
    });

    $router->add("/api/report", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../api/report.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/api/report");  
        }
        
    });

    $router->add("/(.*)", function() {
        require("../index.php");
        require("../view/errors/404.php");
    });

    $router->route();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
