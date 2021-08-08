<?php


namespace App\Transformers;
use App\Models\Conversation;
use App\Models\User;
use League\Fractal;

class ConversationTransformer extends Fractal\TransformerAbstract
{
    public function transform(Conversation $c)
    {
        return [
            'id'          => $c->id,
            'user_one'    => $c->user_one,
            'user_two'    => $c->user_two,
            'participant' => $c->user_one !== \Auth::id() ? User::find($c->user_one) : User::find($c->user_two)
        ];
    }
}

