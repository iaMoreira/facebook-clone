<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'posts',
                'post_id' => $this->id,
                'attributes' => [
                    'posted_by' => new UserResource($this->user),
                    'likes' => new LikeCollectionResource($this->likes),
                    'comments' => new CommentCollectionResource($this->comments),
                    'body' => $this->body,
                    'image' => url('storage/'.$this->image),
                    'posted_at' => $this->created_at->diffForHumans(),
                ]
            ],
            'links' => [
                'self' => url('posts/' . $this->id)
            ]
        ];
    }
}
