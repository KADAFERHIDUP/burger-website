<?php

namespace App\Controllers;

use App\Libraries\Cart as CartLib;
use App\Models\MenuModel;

class Cart extends BaseController
{
    private CartLib $cart;

    public function __construct()
    {
        $this->cart = new CartLib();
    }

    public function index()
    {
        return view('shop/cart', [
            'title' => 'Keranjang',
            'cart'  => $this->cart->contents(),
        ]);
    }

    public function add()
    {
        $menuId = (int) $this->request->getPost('menu_id');
        $qty    = (int) ($this->request->getPost('qty') ?: 1);
        $menu   = (new MenuModel())->where('is_available', 1)->find($menuId);

        if ($menu === null) {
            return redirect()->to(base_url('#menu'))->with('error', 'Menu tidak ditemukan atau sedang habis.');
        }

        $this->cart->add($menuId, $qty);

        return redirect()->to(base_url('#menu'))
            ->with('success', esc($menu['name']) . ' masuk ke keranjang. <a href="' . site_url('keranjang') . '">Lihat keranjang</a>');
    }

    public function update()
    {
        $quantities = (array) $this->request->getPost('qty');

        foreach ($quantities as $menuId => $qty) {
            $this->cart->set((int) $menuId, (int) $qty);
        }

        return redirect()->to(site_url('keranjang'))->with('success', 'Keranjang diperbarui.');
    }

    public function remove(int $menuId)
    {
        $this->cart->remove($menuId);

        return redirect()->to(site_url('keranjang'))->with('success', 'Menu dihapus dari keranjang.');
    }
}
