<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LikeCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $collects = 'App\Http\Resources\LikeResource';

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'like_count' => $this->count(),
            'user_likes_post' => $this->collection->contains('id', auth()->user()->id),
            'links' => [
                'self' => url('/posts'),
            ]
        ];
    }
}
