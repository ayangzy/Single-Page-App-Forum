<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        $replies = $question->replies;
        if(!$replies){
            return $this->errorResponse('Unable to view Replies', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Data successfully retrieved', ReplyResource::collection($replies));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, ReplyRequest $request)
    {
        $reply = $question->replies()->create($request->all());
        if(!$reply){
            return $this->errorResponse('Unable to create a reply, try again', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Reply successfully store',  new ReplyResource($reply), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        $replyData = $reply;
        if(!$replyData){
            return $this->errorResponse('Unable to view Reply', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('Data successfully retrieved', new ReplyResource($replyData));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        $replydata = $reply->update($request->all());
        if(!$replydata){
            return $this->errorResponse('Unable to update data', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->successResponse('reply successfully updated', new ReplyResource($reply));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $replyData = $reply->delete();
        if($replyData){
            return $this->errorResponse('An error occure while trying to delete data, please retry', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse('deleted successfully', null);

    }
}
