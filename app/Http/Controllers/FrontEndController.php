<?php

namespace App\Http\Controllers;

use App\Basket;
use App\BasketDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    public function tarif_de_livraison()
    {
        $list_delivery_type = DB::table('delivery_type')->get();
        return view('front_end.tarifs_livraison', compact('list_delivery_type'));
    }
    public function options_de_livraison()
    {
        $basket =  Basket::get_basket_by_ip(request()->getClientIp());
        $id_basket = $basket->id;
        $list_in_basket = DB::table('basket_delivery')
            ->select('basket_delivery.id', 'delivery_type.nom_delivery_type', 'basket_delivery.n_commande', 'delivery_type.prix_ttc_delivery', 'basket_delivery.is_etage', 'basket_delivery.is_piece_chose', 'delivery_type.prix_ttc_delivery', 'delivery_type.prix_ttc_delivery_etage', 'delivery_type.prix_ttc_delivery_choix_piece')
            ->join('delivery_type', 'basket_delivery.id_delivery_type', '=', 'delivery_type.id')
            ->where('id_basket', $id_basket)
            ->get();
        $somme_total = self::get_total_basket($id_basket);
       // dd($list_in_basket);
        return view('front_end.options_livraison', compact('list_in_basket', 'id_basket', 'somme_total'));
    }
    public function commander_livraison(Request $request)
    {
        try {
            //check if have basket else create
            $have_basket = Basket::have_basket_by_ip(request()->getClientIp());
            $new_basket = new Basket();
            if (!$have_basket) {
                $new_basket = Basket::save_basket();
            } else {
                $new_basket =  Basket::get_basket_by_ip(request()->getClientIp());
            }
            // dd([$have_basket, $new_basket, request()->getClientIp()]);
            //get all data
            $list_delivery_type = DB::table('delivery_type')->get();
            foreach ($list_delivery_type as $item) {
                $id_delivery_type =  $item->id;
                if (!is_null($request->get('nbr-' . $item->id))) {
                    $nbr_id_delivery_type =  $request->get('nbr-' . $item->id);
                    // var_dump($request->get('nbr-' . $item->id));
                    //create vente delivery
                    for ($i = 0; $i < $nbr_id_delivery_type; $i++) {
                        BasketDelivery::save_basket_delivery(
                            $id_delivery_type,
                            $new_basket->id,
                            false,
                            false
                        );
                    }
                }
            }
            return redirect('/options-de-livraison')->with('success', 'Ajouter dans le pannier');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete_order_basket($n_commande)
    {
        try {
            DB::table('basket_delivery')
                ->where('n_commande', $n_commande)
                ->delete();
            return redirect('/options-de-livraison');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function save_is_etage($id_basket_delivery, $state)
    {
        try {
            DB::table('basket_delivery')
                ->where('id', $id_basket_delivery)
                ->update(['is_etage' => $state]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function save_is_piece($id_basket_delivery, $state)
    {
        try {
            DB::table('basket_delivery')
                ->where('id', $id_basket_delivery)
                ->update(['is_piece_chose' => $state]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function get_total_basket($id_basket)
    {
        $somme_total = 0;
        try {
            $list_commande = DB::table('basket_delivery')
                ->join('delivery_type', 'basket_delivery.id_delivery_type', '=', 'delivery_type.id')
                ->where('id_basket', $id_basket)
                ->get();
            //dd($list_commande);
            foreach ($list_commande as $commande) {
                $prix_commande = $commande->prix_ttc_delivery;
                $prix_etage = $commande->prix_ttc_delivery_etage;
                $prix_choice_piece = $commande->prix_ttc_delivery_choix_piece;
                if ($commande->is_etage) {
                    $somme_total += $prix_etage;
                }
                if ($commande->is_piece_chose) {
                    $somme_total += $prix_choice_piece;
                }
                $somme_total += $prix_commande;
            }
            return $somme_total;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
