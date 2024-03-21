<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AgendaAPITest extends TestCase
{
    public function test_endpoint_returns_a_successful_response()
    {
        $apiRequest = $this->call('POST', '/agenda', [
            'name'  => 'Usuario',
            'email' => 'user@email.com',
            'birth' => '1990-10-30',
            'cpf'   => '43434343434',
            'phone' => '5454545455'
        ]);
    }
}
