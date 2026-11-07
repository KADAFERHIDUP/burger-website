<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MessageModel;

class Messages extends BaseController
{
    public function index()
    {
        $model = new MessageModel();

        return view('admin/messages/index', [
            'title'    => 'Pesan Masuk',
            'messages' => $model->orderBy('created_at', 'DESC')->paginate(20),
            'pager'    => $model->pager,
        ]);
    }

    public function markRead(int $id)
    {
        (new MessageModel())->update($id, ['is_read' => 1]);

        return redirect()->to(site_url('admin/pesan'))->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function delete(int $id)
    {
        (new MessageModel())->delete($id);

        return redirect()->to(site_url('admin/pesan'))->with('success', 'Pesan dihapus.');
    }
}
