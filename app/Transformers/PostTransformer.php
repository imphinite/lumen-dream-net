<?php
namespace App\Transformer;

use App\Models\Post;
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

	public function transform(Post $post)
	{
	    return [
	        'id'      => (int) $post->id,
	        'content' => $post->content,
	        'date'    => (int) $book->created_at
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
