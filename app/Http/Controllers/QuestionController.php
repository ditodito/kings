<?php
namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Log;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    public function index($id = null) {
        return view('list', [
            'model' => Question::find($id),
            'questions' => Question::all()
        ]);
    }

    public function save(Request $request) {
        $id = $request['id'] ? $request['id'] : null;
        $q_name = $request->input('question');
        $correct = $request->input('correct');
        Log::info($request);
        $question = $id ? Question::find($id) : new Question();
        $question->question = $q_name;
        $question->save();

        foreach ($request->input('answers') as $key => $a_name) {
            $answer = $id ? Answer::find($question->answers[$key]->id) : new Answer();
            $answer->question_id = $question->id;
            $answer->correct = ($key == $correct) ? 1 : 0;
            $answer->answer = $a_name;
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