<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Mail\ConfirmationShopping;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['shopping_cart_id', 'total', 'email', 'name', 'address_line_1',
        'address_line_2', 'admin_area_2', 'admin_area_1', 'country_code', 'postal_code'
    ];

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    public function isFromStripe()
    {
        return $this->name == null ? true : false;
    }

    protected static function booted()
    {
        static::saving(function($order) {
            (app(CartManager::class))->deleteSession();
            if (!$order->isFromStripe()) {
                Mail::to($order->email)->send(new ConfirmationShopping($order));
            }
        });

        static::created(function($order) {
            if ($order->isFromStripe()) {
                $url = URL::signedRoute('order.complete', ['order' => $order->id]);
                Mail::to($order->email)->send(new ConfirmationShopping($order, $url));
            }
        });
    }

    public static function createFromResponse($response)
    {
        $email = $response->result->payer->email_address;
        $shipping = $response->result->purchase_units[0];
        $amount = $shipping->payments->captures[0]->amount->value;

        $params = (array) $shipping->shipping->address;
        $params['name'] = $shipping->shipping->name->full_name;
        $params['total'] = $amount;
        $params['email'] = $email;
        $params['shopping_cart_id'] = $response->shopping_cart_id;

        return Order::create($params);
    }
}
