<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_logged_in_user_can_view_dashboard()
    {
        $this->login();

        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function test_guest_can_view_home_page()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $this->assertGuest();
    }
}
