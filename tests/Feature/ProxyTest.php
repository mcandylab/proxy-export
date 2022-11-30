<?php

namespace Tests\Feature;

use App\Exports\ProxyExport;
use App\Models\Provider;
use App\Models\Proxy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ProxyTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_proxy_list()
    {
        $user = User::factory()->create();

        Provider::factory()->create();
        Proxy::factory(10)->create();

        $response = $this->actingAs($user, 'api')->postJson(route('api.proxies.list'));

        $response->assertStatus(200)->assertJsonCount(10);
    }

    public function test_export_format_not_exists()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson(route('api.proxies.export'));

        $response->assertStatus(422)->assertJsonValidationErrors('format');
    }

    public function test_incorrect_format()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson(route('api.proxies.export'), ['format', 'port:ip']);

        $response->assertStatus(422)->assertJsonValidationErrors('format');
    }

    public function test_successful_export()
    {
        Excel::fake();

        $user = User::factory()->create();

        Provider::factory()->create();
        $proxies = Proxy::factory(10)->create();

        $response = $this->actingAs($user, 'api')->postJson(route('api.proxies.export'), ['format' => 'ip:port@login:password']);

        $response->assertStatus(200);

        Excel::assertDownloaded('proxies.csv', function (ProxyExport $export) use ($proxies) {
            return $export->collection()->count() === $proxies->count();
        });
    }
}
