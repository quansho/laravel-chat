<?php


namespace App\Services;

use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Messenger
{
    /**
     * @param int $authId
     * @param int $withId
     * @return Conversation|Builder|Model|object|null
     */
    public static function getConversation(int $authId, int $withId)
    {
        return Conversation::where(function ($query) use ($authId, $withId) {
            $query->whereUserOne($authId)
                ->whereUserTwo($withId);
        })->orWhere(function ($query) use ($authId, $withId) {
            $query->whereUserOne($withId)
                ->whereUserTwo($authId);
        })->first();
    }

    /**
     * @param int $authId
     * @param int $withId
     * @return Conversation
     */
    public function newConversation(int $authId, int $withId): Conversation
    {
        return Conversation::create([
            'user_one' => $authId,
            'user_two' => $withId
        ]);
    }

    /**
     * @param int $authId
     * @return Builder[]|Conversation[]|\Illuminate\Database\Eloquent\Collection
     */
    public function userConversations(int $authId)
    {
        return Conversation::whereUserOne($authId)->orWhere('user_two', $authId)->get();
    }

    /**
     * @param int $conversationId
     * @param int $senderId
     * @param string $message
     * @return Message
     */
    public function newMessage(
        int $conversationId,
        int $senderId,
        string $message
    ): Message
    {
        return Message::create([
            'conversation_id' => $conversationId,
            'user_id' => $senderId,
            'message' => $message,
        ]);
    }

    /**
     * @param int $authId
     * @param int $withId
     * @return Collection
     */
    public function messagesWith(int $authId, int $withId) : Collection
    {
        $conversation = $this->getConversation($authId, $withId);

        if (!$conversation) {
            return collect();
        }

        return Message::whereConversationId($conversation->id)
            ->where(function ($query) use ($authId, $withId) {
                $query->where(function ($qr) use ($authId) {
                    $qr->where('user_id', $authId);
                })->orWhere(function ($qr) use ($withId) {
                    $qr->where('user_id', $withId);
                });
            })
            ->latest()
            ->get();
    }
}
