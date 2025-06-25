<?php

namespace Tests\Feature;

use App\Models\AcademicYear;
use App\Models\CalculationMethod;
use App\Models\Madrasah;
use App\Models\MadrasahLevel;
use App\Models\Subject;
use App\Models\TeacherNeed;
use App\Models\TeacherNeedCalculation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MadrasahFilterApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_filter_madrasah_by_subject_shortage_and_excess(): void
    {
        $level = MadrasahLevel::factory()->create();
        $year = AcademicYear::factory()->create();
        $method = CalculationMethod::factory()->create();
        $subjectShort = Subject::factory()->create();
        $subjectExcess = Subject::factory()->create();
        $user = User::factory()->create();

        $madrasahShort = Madrasah::factory()->create([
            'madrasah_level_id' => $level->id,
            'regency_id' => 1,
        ]);
        $needShort = TeacherNeed::factory()->create([
            'madrasah_id' => $madrasahShort->id,
            'subject_id' => $subjectShort->id,
            'academic_year_id' => $year->id,
            'calculation_method_id' => $method->id,
        ]);
        TeacherNeedCalculation::factory()->create([
            'teacher_need_id' => $needShort->id,
            'calculation_method_id' => $method->id,
            'result' => 2,
        ]);

        $madrasahExcess = Madrasah::factory()->create([
            'madrasah_level_id' => $level->id,
            'regency_id' => 1,
        ]);
        $needExcess = TeacherNeed::factory()->create([
            'madrasah_id' => $madrasahExcess->id,
            'subject_id' => $subjectExcess->id,
            'academic_year_id' => $year->id,
            'calculation_method_id' => $method->id,
        ]);
        TeacherNeedCalculation::factory()->create([
            'teacher_need_id' => $needExcess->id,
            'calculation_method_id' => $method->id,
            'result' => -1,
        ]);

        $shortRes = $this->actingAs($user)
            ->getJson('/api/v1/madrasahs?subjectShortageId=' . $subjectShort->id);

        $shortRes->assertStatus(200)
            ->assertJsonPath('result.total', 1)
            ->assertJsonPath('result.result.0.id', $madrasahShort->id);

        $excessRes = $this->actingAs($user)
            ->getJson('/api/v1/madrasahs?subjectExcessId=' . $subjectExcess->id);

        $excessRes->assertStatus(200)
            ->assertJsonPath('result.total', 1)
            ->assertJsonPath('result.result.0.id', $madrasahExcess->id);
    }
}
