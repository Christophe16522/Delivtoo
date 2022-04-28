<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BasketDelivery extends Model
{
    public $table = "basket_delivery";
    protected $fillable = [
        'id',
        'n_commande',
        'id_delivery_type',
        'id_basket',
        'is_etage',
        'is_piece_chose',
    ];
    public static function save_basket_delivery(
        $id_delivery_type,
        $id_basket,
        $is_etage,
        $is_piece_chose
    ) {
        try {
            $new_basket_delivery = new BasketDelivery();
            $new_basket_delivery->n_commande = Str::uuid()->toString();
            $new_basket_delivery->id_delivery_type = $id_delivery_type;
            $new_basket_delivery->id_basket = $id_basket;
            $new_basket_delivery->is_etage = $is_etage;
            $new_basket_delivery->is_piece_chose = $is_piece_chose;
            $new_basket_delivery->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
