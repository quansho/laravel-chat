<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomConversation = Conversation::all()->random();
        return [
            'message' => $this->faker->sentence,
            'conversation_id' => $randomConversation->id,
            'user_id' => $randomConversation->user_one,
        ];
    }

}
