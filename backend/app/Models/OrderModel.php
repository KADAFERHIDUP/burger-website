<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table         = 'orders';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['code', 'customer_name', 'phone', 'address', 'note', 'total', 'status'];
    protected $useTimestamps = true;

    /** Kode pesanan unik, contoh: BRG-261107-4F2A */
    public function generateCode(): string
    {
        do {
            $code = 'BRG-' . date('ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
        } while ($this->where('code', $code)->countAllResults() > 0);

        return $code;
    }
}
