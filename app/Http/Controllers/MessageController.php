<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Facades\Messenger;
use App\Http\Requests\MessageStoreRequest;

class MessageController extends Controller
{
    public function getDialogs(): JsonResponse
    {
        return response()->json(Messenger::userConversations(Auth::id()));
    }

    public function getMessages($withId): JsonResponse
    {
        return response()->json(Messenger::messagesWith(Auth::id(), $withId));
    }

    public function store(MessageStoreRequest $request): JsonResponse
    {
        $authId = Auth::id();
        $conversation = Messenger::getConversation($authId, $request->getParticipant());

        if (!$conversation) {
            $conversation = Messenger::newConversation($authId, $request->getParticipant());
        }

        $message = Messenger::newMessage($conversation->id, $authId, $request->getMessage());

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

}
