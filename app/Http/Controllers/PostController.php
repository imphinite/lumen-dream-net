<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Transformers\PostTransformer;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Resource\Collection;

class PostController extends Controller
{
    private $fractal;

    function __construct() {
        $this->fractal = new \League\Fractal\Manager();
        $this->fractal->setSerializer(new \League\Fractal\Serializer\DataArraySerializer());
    }

    /**
     *
     */
    public function get(Request $request)
    {
        $currentCursor = $request->cursor;
        $previousCursor = $request->previous;
        $limit = $request->limit ? $request->limit : 10;

        if ($currentCursor) {
            $posts = Post::where('id', '>', $currentCursor)->take($limit)->get();
        } else {
            $posts = Post::take($limit)->get();
        }

        $newCursor = $posts->last()->id;
        $cursor = new Cursor($currentCursor, $previousCursor, $newCursor, $posts->count());

        $resource = new Collection($posts, new PostTransformer);
        $resource->setCursor($cursor);

        return $this->fractal->createData($resource)->toJson();
    }
}
