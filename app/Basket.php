<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public $table = "bakset";
    protected $fillable = ['id', 'ip_adress'];

    public static function have_basket_by_ip($ip)
    {
        return count(self::where('ip_adress', $ip)->get()) > 0 ? true : false;
    }
    public static function get_basket_by_ip($ip)
    {
        try {
            return self::where('ip_adress', $ip)->first();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function save_basket()
    {
        try {
            $new_basket = new Basket();
            $new_basket->ip_address = request()->getClientIp();
            $new_basket->save();
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }
}
