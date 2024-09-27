<?php

namespace Tests\Feature\Api\v1;

use App\Enums\RoleEnum;
use App\Http\Resources\SpaceResource;
use App\Models\Space;
use App\Models\Type;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SpaceControllerTest extends TestCase
{
    protected const TOTAL_REGISTERS = 5;
    protected string $tokenAdmin;
    protected string $tokenAssistant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->tokenAdmin = $this->createTokenUser(RoleEnum::ADMIN);
        $this->tokenAssistant = $this->createTokenUser(RoleEnum::ASSISTANT);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $spaces = Space::factory()->count(self::TOTAL_REGISTERS)->create();
        $response = $this->getJson('/api/v1/spaces', [
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(self::TOTAL_REGISTERS);
        $this->assertEquals(self::TOTAL_REGISTERS, Space::count());
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'description', 'capacity', 'type_name', 'photos', 'status', 'type', 'created_at','updated_at']
        ]);
        $responseData = SpaceResource::collection($spaces)->toArray(null);

        $response->assertJson($responseData);
    }

    public function test_show()
    {
        $spacesTotal = Space::get()->count();
        $space = Space::factory()->create();
        $response = $this->getJson("/api/v1/spaces/{$space->id}", [
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'id', 'name', 'description', 'capacity', 'type_name', 'photos', 'status', 'type', 'created_at', 'updated_at',
        ]);

        $response->assertJson((new SpaceResource($space))->toArray(null));
        
        $newSpacesTotal = Space::count();
        $this->assertEquals($spacesTotal + 1, $newSpacesTotal);
    }

    public function test_show_error_not_found()
    {
        $id = $this->faker->randomNumber(6);
        $response = $this->getJson("/api/v1/spaces/{$id}", [
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_store()
    {
        $spacesTotal = Space::get()->count();
        $data = $this->getObjectSpace();
        $response = $this->postJson('/api/v1/spaces', $data, [
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $newSpacesTotal = Space::count();
        $this->assertDatabaseHas('spaces', $data);
        $response->assertJsonStructure([
            'id', 'name', 'description', 'capacity', 'type_name', 'photos', 'status', 'type', 'created_at', 'updated_at',
        ]);
        $this->assertNotNull($response->json('id'));
        $this->assertEquals($spacesTotal + 1, $newSpacesTotal);
    }

    public function test_store_error_forbidden_for_non_admin()
    {
        $data = $this->getObjectSpace();
        $response = $this->postJson('/api/v1/spaces', $data, [
            'Authorization' => "Bearer {$this->tokenAssistant}",
        ]);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_store_error_unauthorized()
    {
        $data = $this->getObjectSpace();
        $response = $this->postJson('/api/v1/spaces', $data);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_store_error_validations()
    {
        $data = $this->getObjectSpace();
        unset($data['name']); //Eliminamos el name de los parametros para provocar el error de validación de laravel

        $response = $this->postJson('/api/v1/spaces', $data, [
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_update()
    {
        $data = $this->getObjectSpace();
        $data['status'] = $this->faker->randomElement([0,1]);
        $space = Space::factory()->create();
        
        $response = $this->putJson("/api/v1/spaces/{$space->id}", $data, [
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('spaces', $data);
        $response->assertJsonStructure([
            'id', 'name', 'description', 'capacity', 'type_name', 'photos', 'status', 'type', 'created_at', 'updated_at',
        ]);
        $this->assertNotNull($response->json('id'));

        $this->assertNotEquals($space->name, $data['name']);
        $this->assertNotEquals($space->description, $data['description']);
        $this->assertNotEquals($space->capacity, $data['capacity']);
        $this->assertNotEquals($space->photos, $data['photos']);
        $spaceNew = Space::findOrFail($space->id);
        $response->assertJson((new SpaceResource($spaceNew))->toArray(null));
    }

    public function test_update_error_not_found()
    {
        $data = $this->getObjectSpace();
        $data['status'] = $this->faker->randomElement([0,1]);
        $id = $this->faker->randomNumber(6);
        $response = $this->putJson("/api/v1/spaces/{$id}", $data,[
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_update_error_validations()
    {
        $data = $this->getObjectSpace();
        unset($data['capacity']);
        $space = Space::factory()->create();
        $response = $this->putJson("/api/v1/spaces/{$space->id}", $data,[
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors(['capacity']);
    }

    public function test_destroy()
    {
        #
    }

    private function getObjectSpace()
    {
        $type = Type::factory()->create();
        return [
            'name' => $this->faker->lexify('???????'),
            'description' => $this->faker->text(),
            'capacity' => $this->faker->randomNumber(4),
            'type_id' => $type->id,
            'photos' => $this->faker->lexify('???????')
        ];
    }
}
