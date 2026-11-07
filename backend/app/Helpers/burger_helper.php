<?php

if (! function_exists('rupiah')) {
    /** Format angka menjadi "Rp 30.000". */
    function rupiah(int|float|string|null $amount): string
    {
        return 'Rp ' . number_format((float) $amount, 0, ',', '.');
    }
}

if (! function_exists('wa_url')) {
    /** Link WhatsApp ke nomor toko dengan pesan yang sudah terisi. */
    function wa_url(string $message = ''): string
    {
        $number = config('Burger')->whatsapp;

        return 'https://wa.me/' . $number . ($message !== '' ? '?text=' . rawurlencode($message) : '');
    }
}

if (! function_exists('order_statuses')) {
    /** Daftar status pesanan beserta labelnya. */
    function order_statuses(): array
    {
        return [
            'baru'     => 'Baru',
            'diproses' => 'Diproses',
            'diantar'  => 'Diantar',
            'selesai'  => 'Selesai',
            'batal'    => 'Batal',
        ];
    }
}

if (! function_exists('status_label')) {
    function status_label(string $status): string
    {
        return order_statuses()[$status] ?? ucfirst($status);
    }
}
