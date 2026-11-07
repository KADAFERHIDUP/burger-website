<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Home extends BaseController
{
    public function index()
    {
        $search = trim((string) $this->request->getGet('q'));

        return view('shop/home', [
            'title'  => 'Burger Lezat di Lhokseumawe',
            'menus'  => (new MenuModel())->available($search),
            'search' => $search,
        ]);
    }
}
