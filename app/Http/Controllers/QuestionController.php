<?php

namespace App\Http\Controllers;

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
        //
    }

    public function update(Question $question, Request $request)
    {
        //
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response(true, 200);
    }
}
