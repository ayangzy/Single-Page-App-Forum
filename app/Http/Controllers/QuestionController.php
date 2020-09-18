<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = QuestionResource::collection(Question::latest()->orderBy('created_at', 'desc')->get());
        if(!$question){

            return $this->errorResponse('Unable to display data', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Sucessfully retrieved', $question);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $question = new Question();
        $question->title = $request->title;
        $question->body = $request->body;
        $question->slug = Str::slug($question->title);
        $question->user_id = 2;
        $question->category_id = $request->category_id;

        if(!$question->save()){
            return $this->errorResponse('An errror occure while trying to create a question', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Data successfully created', new QuestionResource($question));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $questionData = new QuestionResource($question);
        if(!$questionData){
            return $this->errorResponse('Data not found', Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse('Data successfully retrieved', $questionData);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $questionData = $question->update($request->all());
        if(!$questionData){
            return $this->errorResponse('Unable to update data, try again');
        }
        return $this->successResponse('Question sucessfully updated', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question = $question->delete();
        if(!$question){
            return $this->errorResponse('An error occured while trying to delete question, plase try again', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('Question successfully removed', null);
    }
}
