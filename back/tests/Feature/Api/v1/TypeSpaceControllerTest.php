<?php

namespace Tests\Feature\Api\v1;

use App\Enums\RoleEnum;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TypeSpaceControllerTest extends TestCase
{
    protected const TOTAL_REGISTERS = 5;
    protected string $tokenAdmin;
    protected string $tokenAssistant;


    protected function setUp(): void
    {
        parent::setUp();
        $this->tokenAdmin = $this->createTokenUser(RoleEnum::ADMIN->value);
        $this->tokenAssistant = $this->createTokenUser(RoleEnum::ASSISTANT->value);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $types = Type::all();
        if ($total = count($types) == 0) {
            $total = self::TOTAL_REGISTERS;
            $types = Type::factory()->count(self::TOTAL_REGISTERS)->create();
        }

        $response = $this->getJson('/api/v1/types', [
            'Authorization' => "Bearer {$this->tokenAdmin}",
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($total);
        $this->assertEquals($total, Type::count());
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'created_at', 'updated_at']
        ]);
        $response->assertJson(TypeResource::collection($types)->toArray(null));
    }

    public function test_index_error_unauthorized()
    {
        $response = $this->getJson('/api/v1/types');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
