<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table         = 'menus';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['name', 'description', 'category', 'price', 'image', 'is_available'];
    protected $useTimestamps = true;

    /** Menu yang tampil di website, bisa dicari berdasarkan nama atau deskripsi. */
    public function available(?string $search = null): array
    {
        $builder = $this->where('is_available', 1);

        if ($search !== null && $search !== '') {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('description', $search)
                ->groupEnd();
        }

        return $builder->orderBy('id', 'ASC')->findAll();
    }
}
