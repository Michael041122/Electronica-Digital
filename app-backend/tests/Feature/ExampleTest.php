<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use App\Models\ProductKit;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_admin_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_quote_lead_can_be_stored(): void
    {
        $category = Category::create([
            'name' => 'CCTV',
            'slug' => 'cctv-test',
        ]);

        $kit = ProductKit::create([
            'category_id' => $category->id,
            'name' => 'Kit Test',
            'slug' => 'kit-test',
            'specs_summary' => 'Specs test',
            'estimated_price' => 2500,
        ]);

        $response = $this->postJson('/api/quote-leads', [
            'kit_id' => $kit->id,
            'kit_name' => $kit->name,
            'estimated_price' => '2500',
            'specs_summary' => 'Specs test',
            'customer_name' => 'Juan Perez',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                 ]);

        $this->assertDatabaseHas('quote_leads', [
            'customer_name' => 'Juan Perez',
        ]);
    }

    public function test_admin_responses_include_no_cache_headers(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
        $response->assertHeader('Cache-Control');
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }

    public function test_authenticated_user_can_access_profile_and_docs(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin/perfil')->assertStatus(200);
        $this->actingAs($user)->get('/admin/documentacion')->assertStatus(200);
    }

    public function test_user_can_update_profile_information(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'email' => 'original@test.com',
        ]);

        $response = $this->actingAs($user)->put('/admin/perfil', [
            'name' => 'Updated Name',
            'email' => 'updated@test.com',
        ]);

        $response->assertRedirect('/admin/perfil');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@test.com',
        ]);
    }
}
