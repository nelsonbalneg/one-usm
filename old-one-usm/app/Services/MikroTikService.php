<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Query;

class MikroTikService
{
    protected $client;

    public function __construct()
    {
        $host = env('MIKROTIK_HOST', '192.168.88.1');
        $user = env('MIKROTIK_USER', 'admin');
        $pass = env('MIKROTIK_PASS', '');

        $this->client = new Client([
            'host' => $host,
            'user' => $user,
            'pass' => $pass,
            'port' => 8728, // default API port
        ]);
    }

    public function addHotspotUser($server, $name, $password, $profile)
    {
        $query = new Query('/ip/hotspot/user/add');
        $query->equal('server', $server)
              ->equal('name', $name)
              ->equal('password', $password)
              ->equal('profile', $profile);

        return $this->client->query($query)->read();
    }
}
