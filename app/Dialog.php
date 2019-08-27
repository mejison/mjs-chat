<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    public function messages() {
        return $this->hasMany(Message::class, 'dialog_id');
    }

    public function recipient() {
        return $this->hasOne(User::class, 'id', 'user_to_id');
    }

    public function scopeMe() {
        $me = auth()->user();
        $this->where('user_from_id', $me->id)->orWhere('user_to_id', $me->id);
    }
}
