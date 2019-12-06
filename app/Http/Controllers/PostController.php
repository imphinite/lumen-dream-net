<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class PostController extends Controller
{
    private $fractal;

    function __construct() {
        $this->fractal = new Manager();
    }

    /**
     *
     */
    public function get(Request $request, int $id)
    {
        $posts = User::find($id)->posts()->get();

        return ($posts);
    }
}
