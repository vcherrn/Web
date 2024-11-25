<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Characteristic;
use App\Models\CharacteristicUser;
use App\Models\User;
use App\Models\UserCharacterisctic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UserCharacteriscticController
 */
final class UserCharacteriscticControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $userCharacterisctics = UserCharacterisctic::factory()->count(3)->create();

        $response = $this->get(route('user-characterisctic.index'));

        $response->assertOk();
        $response->assertViewIs('userCharacterisctic.index');
        $response->assertViewHas('userCharacterisctics');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('user-characterisctic.create'));

        $response->assertOk();
        $response->assertViewIs('userCharacterisctic.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserCharacteriscticController::class,
            'store',
            \App\Http\Requests\UserCharacteriscticStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $characteristic = Characteristic::factory()->create();
        $characteristic_user = CharacteristicUser::factory()->create();

        $response = $this->post(route('user-characterisctic.store'), [
            'user_id' => $user->id,
            'characteristic_id' => $characteristic->id,
            'characteristic_user_id' => $characteristic_user->id,
        ]);

        $userCharacterisctics = UserCharacterisctic::query()
            ->where('user_id', $user->id)
            ->where('characteristic_id', $characteristic->id)
            ->where('characteristic_user_id', $characteristic_user->id)
            ->get();
        $this->assertCount(1, $userCharacterisctics);
        $userCharacterisctic = $userCharacterisctics->first();

        $response->assertRedirect(route('user-characterisctic.index'));
        $response->assertSessionHas('userCharacterisctic.id', $userCharacterisctic->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $userCharacterisctic = UserCharacterisctic::factory()->create();

        $response = $this->get(route('user-characterisctic.show', $userCharacterisctic));

        $response->assertOk();
        $response->assertViewIs('userCharacterisctic.show');
        $response->assertViewHas('userCharacterisctic');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $userCharacterisctic = UserCharacterisctic::factory()->create();

        $response = $this->get(route('user-characterisctic.edit', $userCharacterisctic));

        $response->assertOk();
        $response->assertViewIs('userCharacterisctic.edit');
        $response->assertViewHas('userCharacterisctic');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UserCharacteriscticController::class,
            'update',
            \App\Http\Requests\UserCharacteriscticUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $userCharacterisctic = UserCharacterisctic::factory()->create();
        $user = User::factory()->create();
        $characteristic = Characteristic::factory()->create();
        $characteristic_user = CharacteristicUser::factory()->create();

        $response = $this->put(route('user-characterisctic.update', $userCharacterisctic), [
            'user_id' => $user->id,
            'characteristic_id' => $characteristic->id,
            'characteristic_user_id' => $characteristic_user->id,
        ]);

        $userCharacterisctic->refresh();

        $response->assertRedirect(route('user-characterisctic.index'));
        $response->assertSessionHas('userCharacterisctic.id', $userCharacterisctic->id);

        $this->assertEquals($user->id, $userCharacterisctic->user_id);
        $this->assertEquals($characteristic->id, $userCharacterisctic->characteristic_id);
        $this->assertEquals($characteristic_user->id, $userCharacterisctic->characteristic_user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $userCharacterisctic = UserCharacterisctic::factory()->create();

        $response = $this->delete(route('user-characterisctic.destroy', $userCharacterisctic));

        $response->assertRedirect(route('user-characterisctic.index'));

        $this->assertModelMissing($userCharacterisctic);
    }
}
