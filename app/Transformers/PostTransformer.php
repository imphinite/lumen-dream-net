<?php
namespace App\Transformers;

use App\Models\Post;
use Carbon\Carbon;
use League\Fractal;

class PostTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'author'
    ];

    /**
    * List of resources to automatically include
    *
    * @var array
    */
    protected $defaultIncludes = [
        'author'
    ];

	public function transform(Post $post)
	{
	    return [
	        'id'      => (int) $post->id,
	        'content' => $post->content,
	        'date'    => (new Carbon($post->created_at))->diffForHumans()
	    ];
    }

    /**
     * Include Author
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeAuthor(Post $post)
    {
        $author = $post->user;

        return $this->item($author, new AuthorTransformer);
    }
}
