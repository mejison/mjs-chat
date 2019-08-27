<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [
    'dialog_id',
    'message',
    'sender_id',
    'recipient_id',
  ];
}
