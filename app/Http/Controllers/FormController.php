<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexFormRequest;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Form;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forms = Form::where('user_id', '=', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return response([
            'forms' => $forms,
            'all' => Form::paginate(10)->lastPage()
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormRequest $request)
    {
        $validation = $request->validated();
        try {
            DB::transaction(function () use ($validation) {
                $form = Form::create([
                    'title' => $validation['title'],
                    'user_id' => auth()->id()
                ]);
                foreach ($validation['questions'] as $questionData) {
                    $question = $form->questions()->create([
                        'title' => $questionData['title'],
                        'type' => $questionData['type']
                    ]);

                    foreach ($questionData['options'] as $optionData) {
                        $question->options()->create($optionData);
                    }
                }
            });
            return response([
                'success' => true
            ], 201);
        } catch (\Exception | QueryException | ValidationException $error) {
            return response([
                'success' => false,
                'error' => $error
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Form $form)
    {
        $questions = $form->questions()
            ->with('options')
            ->get();
        return response($questions, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest $request, Form $form)
    {
        $validation = $request->validated();
        $form->update([
            'title' => $validation['title'],
            'type' => $validation['type']
        ]);
        return response(true, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form)
    {
        $form->delete();
        return response(true, 200);
    }
}
