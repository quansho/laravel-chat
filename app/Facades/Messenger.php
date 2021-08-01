<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Messenger
 * @method static newConversation($authId, $withId)
 * @method static getConversation($authId, $withId)
 * @method static userConversations($authId)
 * @method static messagesWith($authId, $withId)
 * @method static newMessage($conversationId, $authId, $message)
 * @package App\Facades
 */
class Messenger extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Messenger';
    }
}
