<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Data toko. Bisa juga diubah lewat file .env, contoh:
 *   burger.whatsapp = 6282276078880
 */
class Burger extends BaseConfig
{
    public string $shopName     = 'Burger';
    public string $owner        = 'Ahmad Umraithi';
    public string $email        = 'umraithi769@gmail.com';
    public string $phoneDisplay = '0822-7607-8880';
    // Format internasional untuk link WhatsApp: tanpa "+" dan tanpa 0 di depan
    public string $whatsapp     = '6282276078880';
    public string $address      = 'Panggoi, Kota Lhokseumawe 24351';
    public string $mapsQuery    = 'Panggoi, Kota Lhokseumawe';
    public string $instagram    = 'https://www.instagram.com/ahmadumraithi';
}
