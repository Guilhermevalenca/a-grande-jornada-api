<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Question $question)
    {
        return response($question, 200);
    }

    public function update(Question $question, UpdateQuestionRequest $request)
    {
        $validation = $request->validated();
        if($question->title !== $validation['title']) {
            $question->update([
                'title' => $validation['title']
            ]);
        }
        $question->options()->delete();
        $question->options()->createMany($validation['options']);
        return response(true, 200);
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response(true, 200);
    }
}
