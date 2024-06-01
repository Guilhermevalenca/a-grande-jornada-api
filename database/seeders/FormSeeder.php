<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Form::factory(30)
            ->create()
            ->each(function ($form) {
                Question::factory(30)
                    ->create(['form_id' => $form->id])
                    ->each(function ($question) {
                       Option::factory(6)
                           ->create(['question_id' => $question->id]);
                    });
            });
    }
}
