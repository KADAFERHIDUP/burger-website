<?php

namespace App\Controllers;

use App\Models\MessageModel;

class Contact extends BaseController
{
    public function send()
    {
        $rules = [
            'name'    => ['label' => 'Nama', 'rules' => 'required|max_length[100]'],
            'email'   => ['label' => 'Email', 'rules' => 'permit_empty|valid_email|max_length[150]'],
            'phone'   => ['label' => 'Nomor HP', 'rules' => 'permit_empty|regex_match[/^[0-9+\-\s]{8,20}$/]'],
            'message' => ['label' => 'Pesan', 'rules' => 'required|max_length[2000]'],
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(base_url('#contact'))->withInput()->with('errors', $this->validator->getErrors());
        }

        (new MessageModel())->insert([
            'name'    => trim((string) $this->request->getPost('name')),
            'email'   => trim((string) $this->request->getPost('email')) ?: null,
            'phone'   => trim((string) $this->request->getPost('phone')) ?: null,
            'message' => trim((string) $this->request->getPost('message')),
        ]);

        return redirect()->to(base_url('#contact'))->with('success', 'Pesan terkirim. Terima kasih, kami akan segera membalas.');
    }
}
