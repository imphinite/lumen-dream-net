<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    /**
     * 
     */
    public function get(Request $request, int $id)
    {
        $posts = User::find($id)->posts()->get();
        
        return ($posts);
    }
}