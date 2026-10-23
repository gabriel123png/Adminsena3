<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Apprentice;
use App\Models\Area;
use App\Models\Course;
use App\Models\Training_center;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login_endpoints_are_removed(): void
    {
        $this->get('/login')->assertNotFound();
        $this->post('/login')->assertNotFound();
        $this->post('/logout')->assertNotFound();
        $this->postJson('/api/login')->assertNotFound();
        $this->postJson('/api/logout')->assertNotFound();
    }

    public function test_management_pages_are_public_and_render(): void
    {
        foreach ([
            '/areas',
            '/training_centers',
            '/computers',
            '/courses',
            '/teachers',
            '/apprentices',
        ] as $path) {
            $this->get($path)->assertOk();
        }

        foreach ([
            '/areas/create',
            '/training_centers/create',
            '/computers/create',
            '/courses/create',
            '/teachers/create',
            '/apprentices/create',
        ] as $path) {
            $this->get($path)->assertOk();
        }

        $this->getJson('/api/areas')
            ->assertOk()
            ->assertJsonStructure(['success', 'data']);

        $this->getJson('/api/user')->assertUnauthorized();
    }

    public function test_area_can_be_created_updated_and_deleted_from_the_web(): void
    {
        $this->post('/areas', [
            'nombre' => 'Tecnología',
            'descripcion' => 'Área de prueba',
        ])->assertRedirect(route('areas.index'));

        $this->assertDatabaseHas('areas', ['nombre' => 'Tecnología']);

        $area = \App\Models\Area::where('nombre', 'Tecnología')->firstOrFail();

        $this->put('/areas/' . $area->id, [
            'nombre' => 'Tecnología actualizada',
            'descripcion' => 'Descripción actualizada',
        ])->assertRedirect(route('areas.index'));

        $this->assertDatabaseHas('areas', ['nombre' => 'Tecnología actualizada']);

        $this->delete('/areas/' . $area->id)->assertRedirect(route('areas.index'));
        $this->assertDatabaseMissing('areas', ['id' => $area->id]);
    }

    public function test_apprentice_photo_is_saved_to_the_public_disk(): void
    {
        Storage::fake('public');

        $area = Area::create(['nombre' => 'Tecnología']);
        $trainingCenter = Training_center::create([
            'name' => 'Centro de prueba',
            'location' => 'Bogotá',
        ]);
        $course = Course::create([
            'course_number' => '1234567',
            'day' => 'Diurna',
            'area_id' => $area->id,
            'training_center_id' => $trainingCenter->id,
        ]);

        $this->post('/apprentices', [
            'name' => 'Aprendiz de prueba',
            'email' => 'aprendiz@example.com',
            'cell_number' => '3001234567',
            'photo' => UploadedFile::fake()->createWithContent(
                'aprendiz.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAADUlEQVR4nGP4z8AAAAMBAQDJ/pLvAAAAAElFTkSuQmCC')
            ),
            'course_id' => $course->id,
        ])->assertRedirect(route('apprentices.index'));

        $apprentice = Apprentice::where('email', 'aprendiz@example.com')->firstOrFail();

        $this->assertNotEmpty($apprentice->photo);
        Storage::disk('public')->assertExists($apprentice->photo);
    }
}
