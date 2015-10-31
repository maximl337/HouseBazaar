<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PropertyControllerTest extends \TestCase
{
    /** @test */
    public function test()
    {
        $this->visit('/properties/create');
    }
}
