<?php
namespace Controller;
use Slim\Views\PhpRenderer;
use Interop\Container\ContainerInterface;

class TestController {
    public $interface;
    public function __construct(ContainerInterface $c) {
        $this->interface = $c;
    }
    public function getIndex($request, $response, $args) {
        return $this->interface->renderer->render($response, 'test.php', ['id' => $args['id']]);
    }
}

