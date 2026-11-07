<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\MessageModel;
use App\Models\OrderModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $orders = new OrderModel();

        $revenue = (new OrderModel())
            ->selectSum('total')
            ->whereIn('status', ['diproses', 'diantar', 'selesai'])
            ->first();

        return view('admin/dashboard', [
            'title'       => 'Dashboard',
            'totalOrders' => (new OrderModel())->countAllResults(),
            'newOrders'   => (new OrderModel())->where('status', 'baru')->countAllResults(),
            'revenue'     => (int) ($revenue['total'] ?? 0),
            'menuCount'   => (new MenuModel())->countAllResults(),
            'unread'      => (new MessageModel())->where('is_read', 0)->countAllResults(),
            'latest'      => $orders->orderBy('created_at', 'DESC')->findAll(5),
        ]);
    }
}
