<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Cart;

class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $products;

    public function __construct()
    {
        $cart = new Cart();
        $this->products = $cart->getCartProducts();
    }

}
