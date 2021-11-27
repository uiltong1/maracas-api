<?php

namespace Tests\Feature;

use App\Models\Tale;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class TaleTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $baseUrl;
    private $tale;
  
    public function setUp(): void
    {
        parent::setUp();
        $this->tale = Tale::factory()->create();
        $this->baseUrl = 'api/tales';
    }

    protected function basicAuth($user = 'admin@admin.com', $password = '12345')
    {
        $headers = [
            'HTTP_Authorization' => 'Basic ' . base64_encode("{$user}:{$password}")
        ];
        return $headers;
    }

    /**
     * @test
     */
    public function listAllTales()
    {
        $this->withHeaders($this->basicAuth())->get($this->baseUrl)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function getTaleById()
    {
        $this->withHeaders($this->basicAuth())->get($this->baseUrl . '/' . $this->tale->id)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function registerTale()
    {
        $this->withHeaders($this->basicAuth())->post($this->baseUrl, [
            'title' => 'My new tale',
            'is_enable' => true,
            'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
        ])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function updateTale()
    {
        $this->withHeaders($this->basicAuth())->put($this->baseUrl . '/' . $this->tale->id, [
            'title' => 'My new tale',
            'is_enable' => true,
            'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry'
        ])
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @test
     */
    public function deleteTale()
    {
        $this->withHeaders($this->basicAuth())->delete($this->baseUrl . '/' . $this->tale->id)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
