<?php 

namespace MyCore\Core\Http\Controllers;

class CoreController extends BaseController
{
    public function index()
    {
        $title = 'Dashboard';
        return view('mc_core::core.index', compact(
            'title'
        ));
    }
}
