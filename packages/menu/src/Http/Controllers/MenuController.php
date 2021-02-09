<?php

namespace MyCore\Menu\Http\Controllers;

use Illuminate\Http\Request;
use MyCore\Core\Helpers\Breadcrumb;
use MyCore\Core\Http\Controllers\BaseController;

class MenuController extends BaseController
{
    public function __construct()
    {
        $this->middleware('permission:menus.index');
    }

    public function index()
    {
        $title = trans('oc_menu::menu.heading.index');
        return view('oc_menu::menu.index', compact(
            'title'
        ));
    }
}
