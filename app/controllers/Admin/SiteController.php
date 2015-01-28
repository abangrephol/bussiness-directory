<?php
namespace Admin;

class SiteController extends BaseController {

    public function index()
    {

        return $this->theme->scope('site.index')->render();
    }
    public function login()
    {

        return $this->theme->layout('login')->scope('site.login')->render();
    }
}
