<?php
namespace Library;

use App\Config;
use App\Models\Core;

use Library\Json;

class HotelApi
{ 
    public static function flatten($array, $prefix = '')
    {
        $result = array();
        foreach($array as $key=>$value) {
            if(is_array($value)) {
                $result = $result + self::flatten($value);
            }
            else {
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }
    
    public static function execute($param, $data = null, $merge = false)
    {
        if(!Config::apiEnabled) {
            return Json::encode(["status" => "error", "message" => "Socket API has been disabled"]);
        }
      
        if (!function_exists('socket_create')){
            return Json::encode(["status" => "error", "message" => "Please enable sockets in your php.ini!"]);
        }
      
        $data = json_encode(array('key' => $param, 'data' => ($merge == true) ? self::flatten($data) : $data));
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
      
        if ($socket === false) {
            return Json::encode(["status" => "error", "message" => "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . ""]);
        }
      
        $apiSettings = Core::settings();

        $result = socket_connect($socket, $apiSettings->rcon_api_host, $apiSettings->rcon_api_port);
        if ($result === false) {
            return false;
        }

        if(socket_write($socket, $data, strlen($data)) === false){
            return Json::encode(["status" => "error", "message" => socket_strerror(socket_last_error($socket))]);
        }

        return socket_read($socket, 2048);
    }
}
