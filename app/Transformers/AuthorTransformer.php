<?php
namespace App\Transformer;

use App\Model\User;
use League\Fractal;

class AuthorTransformer extends Fractal\TransformerAbstract
{
	public function transform(User $user)
	{
	    return [
	        'id'        => (int) $user->id,
	        'name'      => $user->name,
	        'avatar'    => $user->avatar
	    ];
	}
}
