<?php
$GLOBALS['config'] = array(
    'app' => array(
        'name' => 'SupportBotArticles',
        'version' => "1.0",
        'designer' => "junior",
        "development" => true,
    ),
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'support_articles'
    )
);

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';    //requires a class only when needed
}
);
require_once 'functions/sanitize.php'; //includes the function file