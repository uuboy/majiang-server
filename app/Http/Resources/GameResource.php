<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'id' => $this->id,
            'player1' => new UserResource($this->whenLoaded('player1')),
            'player2' => new UserResource($this->whenLoaded('player2')),
            'player3' => new UserResource($this->whenLoaded('player3')),
            'player4' => new UserResource($this->whenLoaded('player4')),
            'play1_score' => $this->player1_score,
            'play2_score' => $this->player2_score,
            'play3_score' => $this->player3_score,
            'play4_score' => $this->player4_score,
            'winner_id' => $this->winner_id,
            'goal' => $this->goal,
            'is_end' => $this->is_end,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
