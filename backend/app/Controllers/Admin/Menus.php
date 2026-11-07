<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class Menus extends BaseController
{
    private MenuModel $menus;

    public function __construct()
    {
        $this->menus = new MenuModel();
    }

    public function index()
    {
        return view('admin/menus/index', [
            'title' => 'Kelola Menu',
            'menus' => $this->menus->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('admin/menus/form', [
            'title' => 'Tambah Menu',
            'menu'  => null,
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->rules(true))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data          = $this->formData();
        $data['image'] = $this->storeImage();
        $this->menus->insert($data);

        return redirect()->to(site_url('admin/menu'))->with('success', 'Menu "' . esc($data['name']) . '" ditambahkan.');
    }

    public function edit(int $id)
    {
        return view('admin/menus/form', [
            'title' => 'Edit Menu',
            'menu'  => $this->findOrFail($id),
        ]);
    }

    public function update(int $id)
    {
        $menu = $this->findOrFail($id);

        if (! $this->validate($this->rules(false))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data  = $this->formData();
        $image = $this->storeImage();

        if ($image !== null) {
            $this->deleteUploadedImage($menu['image']);
            $data['image'] = $image;
        }

        $this->menus->update($id, $data);

        return redirect()->to(site_url('admin/menu'))->with('success', 'Menu "' . esc($data['name']) . '" diperbarui.');
    }

    public function toggle(int $id)
    {
        $menu = $this->findOrFail($id);
        $this->menus->update($id, ['is_available' => $menu['is_available'] ? 0 : 1]);

        return redirect()->to(site_url('admin/menu'))
            ->with('success', esc($menu['name']) . ($menu['is_available'] ? ' ditandai habis.' : ' tersedia lagi.'));
    }

    public function delete(int $id)
    {
        $menu = $this->findOrFail($id);
        $this->menus->delete($id);
        $this->deleteUploadedImage($menu['image']);

        return redirect()->to(site_url('admin/menu'))->with('success', 'Menu "' . esc($menu['name']) . '" dihapus.');
    }

    private function rules(bool $imageRequired): array
    {
        $rules = [
            'name'        => ['label' => 'Nama menu', 'rules' => 'required|max_length[100]'],
            'category'    => ['label' => 'Kategori', 'rules' => 'required|in_list[sapi,ayam]'],
            'price'       => ['label' => 'Harga', 'rules' => 'required|is_natural_no_zero|less_than[10000000]'],
            'description' => ['label' => 'Deskripsi', 'rules' => 'permit_empty|max_length[500]'],
        ];

        $file = $this->request->getFile('image');
        if ($imageRequired || ($file !== null && $file->getError() !== UPLOAD_ERR_NO_FILE)) {
            $rules['image'] = [
                'label' => 'Foto',
                'rules' => 'uploaded[image]|is_image[image]|max_size[image,2048]|ext_in[image,png,jpg,jpeg,webp]',
            ];
        }

        return $rules;
    }

    private function formData(): array
    {
        return [
            'name'         => trim((string) $this->request->getPost('name')),
            'category'     => $this->request->getPost('category'),
            'price'        => (int) $this->request->getPost('price'),
            'description'  => trim((string) $this->request->getPost('description')) ?: null,
            'is_available' => $this->request->getPost('is_available') ? 1 : 0,
        ];
    }

    /** Simpan foto yang diupload ke public/images/menu dan kembalikan path relatifnya. */
    private function storeImage(): ?string
    {
        $file = $this->request->getFile('image');

        if ($file === null || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        $name = $file->getRandomName();
        $file->move(FCPATH . 'images/menu', $name);

        return 'images/menu/' . $name;
    }

    /** Hapus foto lama hanya jika itu foto upload (bukan foto bawaan). */
    private function deleteUploadedImage(?string $path): void
    {
        if ($path !== null && str_starts_with($path, 'images/menu/') && is_file(FCPATH . $path)) {
            unlink(FCPATH . $path);
        }
    }

    private function findOrFail(int $id): array
    {
        $menu = $this->menus->find($id);

        if ($menu === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Menu tidak ditemukan.');
        }

        return $menu;
    }
}
