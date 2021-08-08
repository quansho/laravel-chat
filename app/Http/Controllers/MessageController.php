<?php

namespace App\Http\Controllers;

use App\Transformers\ConversationTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Facades\Messenger;
use App\Http\Requests\MessageStoreRequest;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class MessageController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|Manager|mixed
     */
    private mixed $fractal;
    /**
     * @var ConversationTransformer|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private mixed $conversationTransformer;

    public function __construct()
    {
        $this->fractal = app(Manager::class);
        $this->conversationTransformer = app(ConversationTransformer::class);
    }

    public function getDialogs(): JsonResponse
    {
        $conversations = new Collection(Messenger::userConversations(Auth::id()), $this->conversationTransformer);
        $conversations = $this->fractal->createData($conversations);
        return response()->json($conversations->toArray());
    }

    public function getMessages($withId): JsonResponse
    {
        return response()->json(Messenger::messagesWith(Auth::id(), $withId));
    }

    public function sendMessage(MessageStoreRequest $request): JsonResponse
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
