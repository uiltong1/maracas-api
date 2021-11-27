<?php

namespace Tests\Feature;

use App\Models\Media;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    private $baseUrl;
    private $media;

    protected function setUp(): void
    {
        parent::setUp();
        $this->media = Media::factory()->create();
        $this->baseUrl = 'api/medias';
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
    public function listAllMedias()
    {
        $this->withHeaders($this->basicAuth())->get($this->baseUrl)
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function getMediaByIdNoContent()
    {
        $this->withHeaders($this->basicAuth())->get($this->baseUrl . '/' . $this->media->id)
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function registerMedia()
    {
        $this->withHeaders($this->basicAuth())->post($this->baseUrl, [
            'description' => true,
            'file' => UploadedFile::fake()->image('file.png', 600, 600)
        ])
            ->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function updateMedia()
    {
        $this->withHeaders($this->basicAuth())->put($this->baseUrl . '/' . $this->media->id, [
            'description' => true,
            'file' => UploadedFile::fake()->image('file.png', 600, 600)
        ])
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @test
     */
    public function deleteMedia()
    {
        $this->withHeaders($this->basicAuth())->delete($this->baseUrl . '/' . $this->media->id)
            ->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
