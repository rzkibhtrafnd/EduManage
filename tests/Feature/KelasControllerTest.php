<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KelasControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $teacher;
    protected $student;
    protected $kelas;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat user dengan role teacher
        $this->teacher = User::factory()->create(['role' => 2]);

        // Buat user dengan role student
        $this->student = User::factory()->create(['role' => 3]);

        // Buat kelas dengan teacher_id
        $this->kelas = Kelas::factory()->create(['teacher_id' => $this->teacher->id]);
    }

    /** @test */
    public function it_can_list_all_kelas()
    {
        $response = $this->actingAs($this->teacher)->getJson('/api/kelas');
        $response->assertStatus(200)->assertJsonStructure([
            '*' => ['id', 'name', 'teacher_id', 'students']
        ]);
    }

    /** @test */
    public function it_can_create_a_kelas()
    {
        $data = [
            'name' => 'Kelas Baru',
            'teacher_id' => $this->teacher->id
        ];

        $response = $this->actingAs($this->teacher)->postJson('/api/kelas', $data);

        $response->assertStatus(201)->assertJson(['message' => 'Kelas berhasil dibuat']);
        $this->assertDatabaseHas('kelas', $data);
    }

    /** @test */
    public function it_can_show_a_kelas()
    {
        $response = $this->actingAs($this->teacher)->getJson("/api/kelas/{$this->kelas->id}");

        $response->assertStatus(200)->assertJson([
            'id' => $this->kelas->id,
            'name' => $this->kelas->name,
            'teacher_id' => $this->kelas->teacher_id
        ]);
    }

    /** @test */
    public function it_can_update_a_kelas()
    {
        $data = ['name' => 'Kelas Diperbarui'];

        $response = $this->actingAs($this->teacher)->putJson("/api/kelas/{$this->kelas->id}", $data);

        $response->assertStatus(200)->assertJson(['message' => 'Kelas diperbarui']);
        $this->assertDatabaseHas('kelas', ['id' => $this->kelas->id, 'name' => 'Kelas Diperbarui']);
    }

    /** @test */
    public function it_can_delete_a_kelas()
    {
        $response = $this->actingAs($this->teacher)->deleteJson("/api/kelas/{$this->kelas->id}");

        $response->assertStatus(200)->assertJson(['message' => 'Kelas dihapus']);
        $this->assertDatabaseMissing('kelas', ['id' => $this->kelas->id]);
    }

    /** @test */
    public function it_can_add_a_student_to_a_kelas()
    {
        $response = $this->actingAs($this->teacher)->postJson("/api/kelas/{$this->kelas->id}/add-student/{$this->student->id}");

        $response->assertStatus(200)->assertJson(['message' => 'Siswa ditambahkan ke kelas']);
        $this->assertTrue($this->kelas->students()->where('id', $this->student->id)->exists());
    }

    /** @test */
    public function it_can_remove_a_student_from_a_kelas()
    {
        // Tambahkan siswa dulu
        $this->kelas->students()->attach($this->student->id);

        $response = $this->actingAs($this->teacher)->deleteJson("/api/kelas/{$this->kelas->id}/remove-student/{$this->student->id}");

        $response->assertStatus(200)->assertJson(['message' => 'Siswa dihapus dari kelas']);
        $this->assertFalse($this->kelas->students()->where('id', $this->student->id)->exists());
    }
}
