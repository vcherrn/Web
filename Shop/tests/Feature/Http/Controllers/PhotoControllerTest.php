<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Photo;
use App\Models\Prosthes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PhotoController
 */
final class PhotoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $photos = Photo::factory()->count(3)->create();

        $response = $this->get(route('photo.index'));

        $response->assertOk();
        $response->assertViewIs('photo.index');
        $response->assertViewHas('photos');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('photo.create'));

        $response->assertOk();
        $response->assertViewIs('photo.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhotoController::class,
            'store',
            \App\Http\Requests\PhotoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $prosthes = Prosthes::factory()->create();

        $response = $this->post(route('photo.store'), [
            'prosthes_id' => $prosthes->id,
        ]);

        $photos = Photo::query()
            ->where('prosthes_id', $prosthes->id)
            ->get();
        $this->assertCount(1, $photos);
        $photo = $photos->first();

        $response->assertRedirect(route('photo.index'));
        $response->assertSessionHas('photo.id', $photo->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $photo = Photo::factory()->create();

        $response = $this->get(route('photo.show', $photo));

        $response->assertOk();
        $response->assertViewIs('photo.show');
        $response->assertViewHas('photo');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $photo = Photo::factory()->create();

        $response = $this->get(route('photo.edit', $photo));

        $response->assertOk();
        $response->assertViewIs('photo.edit');
        $response->assertViewHas('photo');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PhotoController::class,
            'update',
            \App\Http\Requests\PhotoUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $photo = Photo::factory()->create();
        $prosthes = Prosthes::factory()->create();

        $response = $this->put(route('photo.update', $photo), [
            'prosthes_id' => $prosthes->id,
        ]);

        $photo->refresh();

        $response->assertRedirect(route('photo.index'));
        $response->assertSessionHas('photo.id', $photo->id);

        $this->assertEquals($prosthes->id, $photo->prosthes_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $photo = Photo::factory()->create();

        $response = $this->delete(route('photo.destroy', $photo));

        $response->assertRedirect(route('photo.index'));

        $this->assertModelMissing($photo);
    }
}
