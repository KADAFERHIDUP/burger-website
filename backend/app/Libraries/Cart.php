<?php

namespace App\Libraries;

use App\Models\MenuModel;

/**
 * Keranjang belanja yang disimpan di session.
 * Session hanya menyimpan [id_menu => jumlah]; harga selalu diambil ulang dari database.
 */
class Cart
{
    public const MAX_QTY = 20;
    private const KEY    = 'cart';

    public function raw(): array
    {
        return session()->get(self::KEY) ?? [];
    }

    public function add(int $menuId, int $qty = 1): void
    {
        $cart          = $this->raw();
        $cart[$menuId] = min(self::MAX_QTY, ($cart[$menuId] ?? 0) + max(1, $qty));
        session()->set(self::KEY, $cart);
    }

    public function set(int $menuId, int $qty): void
    {
        $cart = $this->raw();

        if ($qty <= 0) {
            unset($cart[$menuId]);
        } else {
            $cart[$menuId] = min(self::MAX_QTY, $qty);
        }

        session()->set(self::KEY, $cart);
    }

    public function remove(int $menuId): void
    {
        $this->set($menuId, 0);
    }

    public function clear(): void
    {
        session()->remove(self::KEY);
    }

    public function count(): int
    {
        return array_sum($this->raw());
    }

    /**
     * Isi keranjang lengkap dengan data menu terbaru dari database.
     *
     * @return array{items: list<array>, total: int}
     */
    public function contents(): array
    {
        $cart = $this->raw();

        if ($cart === []) {
            return ['items' => [], 'total' => 0];
        }

        $menus = (new MenuModel())
            ->whereIn('id', array_keys($cart))
            ->where('is_available', 1)
            ->findAll();

        $items = [];
        $total = 0;

        foreach ($menus as $menu) {
            $qty      = (int) $cart[$menu['id']];
            $subtotal = (int) $menu['price'] * $qty;
            $total += $subtotal;
            $items[] = [
                'menu_id'  => (int) $menu['id'],
                'name'     => $menu['name'],
                'image'    => $menu['image'],
                'price'    => (int) $menu['price'],
                'qty'      => $qty,
                'subtotal' => $subtotal,
            ];
        }

        // Buang menu yang sudah dihapus atau tidak tersedia lagi
        if (count($items) !== count($cart)) {
            session()->set(self::KEY, array_column($items, 'qty', 'menu_id'));
        }

        return ['items' => $items, 'total' => $total];
    }
}
