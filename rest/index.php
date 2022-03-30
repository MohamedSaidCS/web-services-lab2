<?php

require_once("vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    "driver" => _DRIVER_,
    "host" => _HOST_,
    "database" => _DATABASE_,
    "username" => _USERNAME_,
    "password" => _PASSWORD_,
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

$params =  explode('/', substr($_SERVER['PATH_INFO'], 1));

if($params[0] === 'items') {
    header('Content-Type: application/json');
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if(!isset($params[1]) || $params[1] === '') {
                echo json_encode($capsule->table('items')->get());
            } else {
                echo json_encode($capsule->table('items')->find($params[1]));
            }
            break;
        case 'POST':
            if(!isset($params[1]) || $params[1] === '') {
                $body = json_decode(file_get_contents('php://input'), true);
                $capsule->table('items')->insert([
                    'id' => $body['id'],
                    'product_name' => $body['product_name'],
                ]);
                echo json_encode(['message' => 'Item created successfully.']);
            }
            break;
        case 'PUT':
            if(isset($params[1]) || $params[1] !== '') {
                $body = json_decode(file_get_contents('php://input'), true);
                $capsule->table('items')->where('id', $params[1])->update([
                    'product_name' => $body['product_name'],
                ]);
                echo json_encode(['message' => 'Item updated successfully.']);
            }
            break;
        case 'DELETE':
            if(isset($params[1]) || $params[1] !== '') {
                $capsule->table('items')->where('id', $params[1])->delete();
                echo json_encode(['message' => 'Item deleted successfully.']);
            }
    }
}