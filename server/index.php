<?php
    require 'vendor/autoload.php';
    require 'db.php';
    require 'survey.php';

    date_default_timezone_set('Asia/Jakarta');

    $app = new \Slim\App;

    $app->get('/', function($req, $res, $arg) {
        $res->withStatus(302);
    });

    $app->get('/p/{period}', function($req, $res, $arg) {
        include 'site.php';
    });

    $app->post('/installation/{id}', function($req, $res, $arg) {
        Survey::save($arg['id'], $req->getParsedBody());
    });

    $app->run();
?>
