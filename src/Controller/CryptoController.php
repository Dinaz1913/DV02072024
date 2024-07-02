<?php

namespace Reelz222z\Cryptoexchange\Controller;

use Reelz222z\Cryptoexchange\Model\Crypto;

class CryptoController
{
    public function index()
    {
        $cryptos = Crypto::all();

        return [
            'template' => 'crypto/index.html.twig',
            'params' => ['cryptos' => $cryptos]
        ];
    }

    public function show($id)
    {
        $crypto = Crypto::find($id);

        if (!$crypto) {
            return [
                'template' => 'errors/404.html.twig',
                'params' => []
            ];
        }

        return [
            'template' => 'crypto/detail.html.twig',
            'params' => ['crypto' => $crypto]
        ];
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $symbol = $_POST['symbol'];
            $price = $_POST['price'];

            $crypto = new Crypto();
            $crypto->name = $name;
            $crypto->symbol = $symbol;
            $crypto->price = $price;
            $crypto->save();

            header('Location: /crypto');
            exit;
        }

        return [
            'template' => 'crypto/create.html.twig',
            'params' => []
        ];
    }

    public function edit($id)
    {
        $crypto = Crypto::find($id);

        if (!$crypto) {
            return [
                'template' => 'errors/404.html.twig',
                'params' => []
            ];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $crypto->name = $_POST['name'];
            $crypto->symbol = $_POST['symbol'];
            $crypto->price = $_POST['price'];
            $crypto->save();

            header('Location: /crypto/' . $crypto->id);
            exit;
        }

        return [
            'template' => 'crypto/edit.html.twig',
            'params' => ['crypto' => $crypto]
        ];
    }

    public function portfolio()
    {
        $cryptos = Crypto::all();

        return [
            'template' => 'crypto/portfolio.html.twig',
            'params' => ['cryptos' => $cryptos]
        ];
    }
}
