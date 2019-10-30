<?php

use Illuminate\Database\Seeder;
use App\Models\Poll\Questionnaire;
use App\Models\Poll\QuestionnaireLang;

class QuestionnaireTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Questionnaire::class, 10)
            ->create(['state' => 'ACTIVE'])
            ->each(function (Questionnaire $questionnaire){
                factory(QuestionnaireLang::class, 1)->create(['questionnaire_id' => $questionnaire->id, 'lang_id' => 1, 'question' => 'Ingles']);
                factory(QuestionnaireLang::class, 1)->create(['questionnaire_id' => $questionnaire->id, 'lang_id' => 2, 'question' => 'Portugues']);
                factory(QuestionnaireLang::class, 1)->create(['questionnaire_id' => $questionnaire->id, 'lang_id' => 3, 'question' => 'Español']);
            });
    }
}
