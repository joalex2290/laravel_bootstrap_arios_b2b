<?php

namespace App\Providers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Session;
use App\Office;
use App\Catalog;
use App\Category;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot() {
        View::composer('*', function ($view) {
            /** @var \Illuminate\Contracts\View\View $view */
            $order_status = ['-- Estado del pedido --', 'Solicitado', 'Autorizado oficina', 'Autorizado empresa', 'Rechazado', 'En proceso', 'En transito', 'Entregado', 'Devuelto'];
            $categories = Category::All();
            if (Session::has('catalog')) {
                $cart_qty = Cart::instance(Session::get('catalog'))->content()->count();
                $current_office = Office::find(Session::get('office'));
                $current_catalog = Catalog::find(Session::get('catalog'));
                $view->with([
                    'cart_qty' => $cart_qty,
                    'current_office' => $current_office,
                    'current_catalog' => $current_catalog,
                    'order_status' => $order_status,
                    'categories' => $categories,
                    ]);

            } else {
                $cart_qty = Cart::instance('default')->count();
                $view->with([
                    'cart_qty' => $cart_qty,
                    'order_status' => $order_status,
                    'categories' => $categories,
                    ]);
            }
        });
    }

}
