<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {
        return dd($post);
    }
}
