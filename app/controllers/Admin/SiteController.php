<?php
namespace Admin;

class SiteController extends BaseController {

    public function index()
    {
        $this->theme->asset()->serve('bootstrap');
        return $this->theme->scope('site.index')->render();
    }
    public function login()
    {
        $this->theme->asset()->serve('bootstrap');
        return $this->theme->layout('login')->scope('site.login')->render();
    }
}
