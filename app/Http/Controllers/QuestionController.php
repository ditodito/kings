<?php
namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Validator;
use Log;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    public function index($id = null) {
        $model = Question::find($id);
        $questions = Question::all();

        return view('questions', [
            'model' => $model,
            'questions' => $questions
        ]);
    }

    public function save(Request $request) {
        $rules = [
            'question' => 'required',
            'answers1' => 'required',
            'answers2' => 'required',
            'answers3' => 'required',
            'answers4' => 'required',
            'correct' => 'required',
        ];

        $messages = [
            'question.required' => 'მიუთითეთ შეკითხვა',
            'answers1.required' => 'მიუთითეთ პასუხი 1',
            'answers2.required' => 'მიუთითეთ პასუხი 2',
            'answers3.required' => 'მიუთითეთ პასუხი 3',
            'answers4.required' => 'მიუთითეთ პასუხი 4',
            'correct.required' => 'მონიშნეთ სწორი პასუხი',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('questions')->withInput()->withErrors($validator);
        }

        $id = $request['id'] ? $request['id'] : null;

        $question = $id ? Question::find($id) : new Question();
        $question->question = $request->input('question');
        $question->save();

        for ($i = 0; $i < 4; $i++) {
            $k = $i + 1;
            $answer = $id ? Answer::find($question->answers[$i]->id) : new Answer();
            $answer->question_id = $question->id;
            $answer->correct = ($i == $request->input('correct')) ? 1 : 0;
            $answer->answer = $request->input('answers'.$k);
            $answer->save();
        }

        return redirect('questions');
    }

    public function delete(Question $question) {
        $question->delete();
        $question->answers()->delete();

        return redirect('questions');
    }

}