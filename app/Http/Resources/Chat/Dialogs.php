<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class Dialogs extends JsonResource
{
    protected $maxLenContext = 64;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $me = auth()->user();        
        return [
            'id' => $this->id,
            'opponent' => $this->sender->id == $me->id ? $this->recipient : $this->sender,
            'date_last_message' => $this->getLastMessageDate(),
            'context_last_message' => $this->getLastMessageContext(),            
        ];
    }

    public function getLastMessageContext() {
        if ($this->messages->count()) {
            $message = $this->messages->last()->message;
            if (strlen($message) > $this->maxLenContext) {
                return substr($message, 0, $this->maxLenContext) . "...";
            }
            return $message;
        }

        return '';
    }

    public function getLastMessageDate() {
        return $this->messages->count() ? $this->messages->last()->created_at->format('H:i A') : '';
    }
}
