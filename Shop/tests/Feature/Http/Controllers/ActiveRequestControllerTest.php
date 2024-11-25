<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ActiveRequest;
use App\Models\Request;
use App\Models\RequestTypeUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ActiveRequestController
 */
final class ActiveRequestControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $activeRequests = ActiveRequest::factory()->count(3)->create();

        $response = $this->get(route('active-request.index'));

        $response->assertOk();
        $response->assertViewIs('activeRequest.index');
        $response->assertViewHas('activeRequests');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('active-request.create'));

        $response->assertOk();
        $response->assertViewIs('activeRequest.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ActiveRequestController::class,
            'store',
            \App\Http\Requests\ActiveRequestStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $request = Request::factory()->create();
        $request_status = $this->faker->boolean();
        $name = $this->faker->name();
        $surname = $this->faker->word();
        $patronymic = $this->faker->word();
        $country = $this->faker->country();
        $town = $this->faker->word();
        $request_type_user = RequestTypeUser::factory()->create();

        $response = $this->post(route('active-request.store'), [
            'user_id' => $user->id,
            'request_id' => $request->id,
            'request_status' => $request_status,
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'country' => $country,
            'town' => $town,
            'request_type_user_id' => $request_type_user->id,
        ]);

        $activeRequests = ActiveRequest::query()
            ->where('user_id', $user->id)
            ->where('request_id', $request->id)
            ->where('request_status', $request_status)
            ->where('name', $name)
            ->where('surname', $surname)
            ->where('patronymic', $patronymic)
            ->where('country', $country)
            ->where('town', $town)
            ->where('request_type_user_id', $request_type_user->id)
            ->get();
        $this->assertCount(1, $activeRequests);
        $activeRequest = $activeRequests->first();

        $response->assertRedirect(route('active-request.index'));
        $response->assertSessionHas('activeRequest.id', $activeRequest->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $activeRequest = ActiveRequest::factory()->create();

        $response = $this->get(route('active-request.show', $activeRequest));

        $response->assertOk();
        $response->assertViewIs('activeRequest.show');
        $response->assertViewHas('activeRequest');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $activeRequest = ActiveRequest::factory()->create();

        $response = $this->get(route('active-request.edit', $activeRequest));

        $response->assertOk();
        $response->assertViewIs('activeRequest.edit');
        $response->assertViewHas('activeRequest');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ActiveRequestController::class,
            'update',
            \App\Http\Requests\ActiveRequestUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $activeRequest = ActiveRequest::factory()->create();
        $user = User::factory()->create();
        $request = Request::factory()->create();
        $request_status = $this->faker->boolean();
        $name = $this->faker->name();
        $surname = $this->faker->word();
        $patronymic = $this->faker->word();
        $country = $this->faker->country();
        $town = $this->faker->word();
        $request_type_user = RequestTypeUser::factory()->create();

        $response = $this->put(route('active-request.update', $activeRequest), [
            'user_id' => $user->id,
            'request_id' => $request->id,
            'request_status' => $request_status,
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'country' => $country,
            'town' => $town,
            'request_type_user_id' => $request_type_user->id,
        ]);

        $activeRequest->refresh();

        $response->assertRedirect(route('active-request.index'));
        $response->assertSessionHas('activeRequest.id', $activeRequest->id);

        $this->assertEquals($user->id, $activeRequest->user_id);
        $this->assertEquals($request->id, $activeRequest->request_id);
        $this->assertEquals($request_status, $activeRequest->request_status);
        $this->assertEquals($name, $activeRequest->name);
        $this->assertEquals($surname, $activeRequest->surname);
        $this->assertEquals($patronymic, $activeRequest->patronymic);
        $this->assertEquals($country, $activeRequest->country);
        $this->assertEquals($town, $activeRequest->town);
        $this->assertEquals($request_type_user->id, $activeRequest->request_type_user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $activeRequest = ActiveRequest::factory()->create();

        $response = $this->delete(route('active-request.destroy', $activeRequest));

        $response->assertRedirect(route('active-request.index'));

        $this->assertModelMissing($activeRequest);
    }
}
