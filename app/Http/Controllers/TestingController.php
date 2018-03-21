<?php
namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Result;
use Log;
use Excel;
use Illuminate\Http\Request;
use App\Http\Requests;

class TestingController extends Controller {

    public function index() {
        $question = Question::where(['finished' => 0])->first();
        if ($question)
            return view('testing', ['question' => $question]);
        else
            return view('results', ['results' => Result::all()]);
    }

    public function save(Request $request) {
        $question_id = $request->input('question_id');
        $answer_id = $request->input('answer_id');

        // Log::info($question_id.":::".$answer_id);
        $question = Question::find($question_id);
        $question->finished = 1;
        $question->save();

        $answer = Answer::find($answer_id);

        $result = new Result();
        $result->question = $question->question;
        $result->answer = $answer->answer;
        $result->correct_answer = Answer::where(['question_id' => $question_id, 'correct' => 1])->first()->answer;
        if ($answer->correct == 1)
            $result->score = 1;
        $result->save();

        return redirect('testing');
    }

    public function reset() {
        Question::where(['finished' => 1])->update(['finished' => 0]);
        Result::truncate();
        return redirect('testing');
    }

    public function export($type = 'xlsx') {
        $data = [];
        $data[] = ['შეკითხვა', 'თქვენი პასუხი', 'სწორი პასუხი', 'ქულა'];
        $results = Result::all();
        $total_score = 0;

        foreach($results as $result) {
            if ($result->score == 1)
                $total_score++;
            $data[] = [$result->question, $result->answer, $result->correct_answer, $result->score];
        }

        $data[] = [count($results) . ' შესაძლებელი ქულიდან თქვენ დააგროვეთ ' . $total_score . ' ქულა'];

        return Excel::create('results', function($excel) use ($data) {
            $excel->sheet('results_sheet', function($sheet) use ($data) {
                $sheet->fromArray($data, null, null, true, false);
            });
        })->download($type);
    }

}
