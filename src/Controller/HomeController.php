<?php

namespace Reelz222z\Cryptoexchange\Controller;

class HomeController
{
    public function index()
    {
        return [
            'template' => 'home.html.twig',
            'params' => []
        ];
    }

    public function about()
    {
        return [
            'template' => 'about.html.twig',
            'params' => []
        ];
    }

    public function contact()
    {
        return [
            'template' => 'contact.html.twig',
            'params' => []
        ];
    }

    public function dashboard()
    {
        return [
            'template' => 'dashboard.html.twig',
            'params' => []
        ];
    }
}
