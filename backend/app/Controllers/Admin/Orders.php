<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderItemModel;
use App\Models\OrderModel;

class Orders extends BaseController
{
    public function index()
    {
        $status = (string) $this->request->getGet('status');
        $model  = new OrderModel();

        if (array_key_exists($status, order_statuses())) {
            $model->where('status', $status);
        } else {
            $status = '';
        }

        return view('admin/orders/index', [
            'title'  => 'Pesanan',
            'orders' => $model->orderBy('created_at', 'DESC')->paginate(15),
            'pager'  => $model->pager,
            'status' => $status,
        ]);
    }

    public function show(int $id)
    {
        $order = (new OrderModel())->find($id);

        if ($order === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }

        return view('admin/orders/show', [
            'title' => 'Pesanan ' . $order['code'],
            'order' => $order,
            'items' => (new OrderItemModel())->where('order_id', $id)->findAll(),
        ]);
    }

    public function updateStatus(int $id)
    {
        $model = new OrderModel();
        $order = $model->find($id);

        if ($order === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan.');
        }

        $status = (string) $this->request->getPost('status');

        if (! array_key_exists($status, order_statuses())) {
            return redirect()->back()->with('error', 'Status tidak dikenal.');
        }

        $model->update($id, ['status' => $status]);

        return redirect()->to(site_url('admin/pesanan/' . $id))
            ->with('success', 'Status pesanan ' . esc($order['code']) . ' diubah menjadi ' . status_label($status) . '.');
    }
}
