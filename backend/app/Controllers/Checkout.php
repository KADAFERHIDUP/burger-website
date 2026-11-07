<?php

namespace App\Controllers;

use App\Libraries\Cart as CartLib;
use App\Models\OrderItemModel;
use App\Models\OrderModel;

class Checkout extends BaseController
{
    public function index()
    {
        $cart = (new CartLib())->contents();

        if ($cart['items'] === []) {
            return redirect()->to(base_url('#menu'))->with('error', 'Keranjang masih kosong. Pilih menu dulu, ya.');
        }

        return view('shop/checkout', [
            'title' => 'Checkout',
            'cart'  => $cart,
        ]);
    }

    public function store()
    {
        $cartLib = new CartLib();
        $cart    = $cartLib->contents();

        if ($cart['items'] === []) {
            return redirect()->to(base_url('#menu'))->with('error', 'Keranjang masih kosong.');
        }

        $rules = [
            'customer_name' => ['label' => 'Nama', 'rules' => 'required|max_length[100]'],
            'phone'         => ['label' => 'Nomor HP', 'rules' => 'required|regex_match[/^[0-9+\-\s]{8,20}$/]'],
            'address'       => ['label' => 'Alamat', 'rules' => 'required|max_length[500]'],
            'note'          => ['label' => 'Catatan', 'rules' => 'permit_empty|max_length[500]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $orders = new OrderModel();
        $items  = new OrderItemModel();
        $db     = db_connect();
        $code   = $orders->generateCode();

        $db->transStart();

        $orderId = $orders->insert([
            'code'          => $code,
            'customer_name' => trim((string) $this->request->getPost('customer_name')),
            'phone'         => trim((string) $this->request->getPost('phone')),
            'address'       => trim((string) $this->request->getPost('address')),
            'note'          => trim((string) $this->request->getPost('note')) ?: null,
            'total'         => $cart['total'],
            'status'        => 'baru',
        ]);

        foreach ($cart['items'] as $item) {
            $items->insert([
                'order_id'  => $orderId,
                'menu_id'   => $item['menu_id'],
                'menu_name' => $item['name'],
                'price'     => $item['price'],
                'qty'       => $item['qty'],
                'subtotal'  => $item['subtotal'],
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Pesanan gagal disimpan. Coba lagi sebentar.');
        }

        $cartLib->clear();

        return redirect()->to(site_url('pesanan/' . $code));
    }

    public function success(string $code)
    {
        $order = (new OrderModel())->where('code', $code)->first();

        if ($order === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }

        $items = (new OrderItemModel())->where('order_id', $order['id'])->findAll();

        $lines = ["Halo, saya {$order['customer_name']}.", "Saya baru pesan dengan kode *{$order['code']}*:"];
        foreach ($items as $item) {
            $lines[] = "- {$item['qty']}x {$item['menu_name']} (" . rupiah($item['subtotal']) . ')';
        }
        $lines[] = 'Total: ' . rupiah($order['total']);
        $lines[] = 'Alamat: ' . $order['address'];

        return view('shop/success', [
            'title' => 'Pesanan ' . $order['code'],
            'order' => $order,
            'items' => $items,
            'waUrl' => wa_url(implode("\n", $lines)),
        ]);
    }
}
