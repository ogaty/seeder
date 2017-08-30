<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;
use Controller;

require '../vendor/autoload.php';
require '../config/settings.php';
require '../config/database.php';

session_start();

$app = new \Slim\App;
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer($config['template_path']);

//$app->get($config['prefix'] . '/test/{id}', '\Controller\TestController:getIndex');

$app->get($config['prefix'] . '/', function (Request $request, Response $response, $args) {

    $users = ORM::for_table('users')
        ->where('target', 1)
        ->find_many();

    $msg = $_SESSION['msg'];
    $_SESSION['msg'] = '';
    return $this->renderer->render($response, '/index.php', [
        'users' => $users
        'msg' => $msg
    ]);
});

$app->post($config['prefix'] . '/point', function (Request $request, Response $response, $args) {
        $faker = Faker\Factory::create();

        $targets = ORM::for_table('users')
            ->where('target', 1)
            ->find_many();

        foreach ($targets as $target) {
            $content = ORM::for_table('users')
                ->where_equal('id', $target->id)
                ->find_result_set()
                ->set('point', $faker->randomNumber(4))
                ->save();
        }

        $_SESSION['msg'] = 'pointを入れ替えました。';
        return $response->withRedirect('/seeder/');
});

$app->run();
