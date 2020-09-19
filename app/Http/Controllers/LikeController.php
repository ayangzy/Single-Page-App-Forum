<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends BaseController
{
    public function likeIt(Reply $reply)
    {
        return $reply->likes()->create([
            'user_id' => 1,
        ]);

    }

    public function unLikeIt(Reply $reply)
    {
        $unlike = $reply->likes()->where('user_id', 1)->first();
        return $unlike->delete();

    }
}
