<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDashboardTest extends TestCase {

	use DatabaseMigrations;
	use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminDasboardAccess() {

		 $response = $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    public function testAdminDasboardLoggedIn() {

		 $this->actingAs(factory(User::class)->create());
		 $response = $this->get('/admin/dashboard')->assertOk();
    }
}
