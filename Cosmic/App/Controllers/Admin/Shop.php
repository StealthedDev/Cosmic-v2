<?php
namespace App\Controllers\Admin;

use App\Config;

use App\Models\Admin;
use App\Models\Log;
use App\Models\Player;
use App\Models\Core;
use App\Models\Shop as Shops;

use Core\View;

use Library\HotelApi;
use Library\Json;

class Shop
{
  
    public function remove()
    {
        $faq = Admin::removeOffer(input('post'));
        Log::addStaffLog(input('post'), 'Offer removed: ' . intval(input()->post('post')->value), request()->player->id, 'offer');
        response()->json(["status" => "success", "message" => "Offer removed successfully!"]);
    }
  
    public function editcreate()
    {
        $validate = request()->validator->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'json'  => 'required'
        ]);
      
        if(!$validate->isSuccess()) {
            return;
        }
      
        $data = [
            "title" => input('title'),
            "price" => input('price'),
            "image" => input('image'),
            "data"  => trim(input('json')),
            "description" => input('description')
        ];
      
        if (!empty(input('shopId'))) {
            $id = input('shopId');
        }

        Admin::offerEdit($data, $id ?? null);
        Log::addStaffLog($id ?? null, 'Shop item ' . isset($id) ? "modafied" : "created" . '{' . "{$data}" . '}', request()->player->id, 'shop');
        response()->json(["status" => "success", "message" => "Offer " . empty($id) ? "modafied" : "created"]);
    }
  
    public function getOfferById()
    {
       $validate = request()->validator->validate([
            'post' => 'required'
        ]);

        if (!$validate->isSuccess()) {
            return;
        }
      
        $offer = Shops::getOfferById(input('post'));
        response()->json(["data" => $offer]);
    }

    public function getOffers()
    {
        $offers = Admin::getOffers();
        Json::filter($offers, 'desc', 'id');
    }

    public function view()
    {
        View::renderTemplate('Admin/Management/shop.html', ['permission' => 'housekeeping_shop_control', 'offers' => Admin::getOffers()]);
    }
}