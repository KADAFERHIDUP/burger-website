<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $now   = date('Y-m-d H:i:s');
        $menus = [
            ['Classic Cheese Burger', 'sapi', 'Daging sapi, keju cheddar, selada, tomat, dan acar.', 'images/product-1.webp'],
            ['Crispy Chicken Burger', 'ayam', 'Ayam goreng renyah dengan coleslaw dan saus spesial.', 'images/product-2.webp'],
            ['Chicken Fillet Burger', 'ayam', 'Fillet ayam krispi, selada segar, dan mayones.', 'images/product-3.webp'],
            ['Smoked Beef Burger', 'sapi', 'Daging sapi, smoked beef, keju, dan sayuran segar.', 'images/product-4.webp'],
            ['Cheesy Beef Burger', 'sapi', 'Daging sapi tebal dengan keju lumer berlimpah.', 'images/product-5.webp'],
            ['BBQ Beef Burger', 'sapi', 'Daging sapi berbalut saus BBQ dan bawang karamel.', 'images/product-6.webp'],
        ];

        foreach ($menus as [$name, $category, $description, $image]) {
            $this->db->table('menus')->insert([
                'name'         => $name,
                'category'     => $category,
                'description'  => $description,
                'price'        => 30000,
                'image'        => $image,
                'is_available' => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }
    }
}
