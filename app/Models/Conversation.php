<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Conversation
 *
 * @property int $id
 * @property int $user_one
 * @property int $user_two
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Message[] $messages
 * @property-read int|null $messages_count
 * @property-read User $userOne
 * @property-read User $userTwo
 * @method static \Database\Factories\ConversationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereUserOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conversation whereUserTwo($value)
 * @mixin Eloquent
 */
class Conversation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'user_one', 'user_two'
    ];

    /**
     * @return HasMany
     */
    public function messages() : HasMany
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }

    /**
     * @return BelongsTo
     */
    public function userOne() : BelongsTo
    {
        return $this->belongsTo(User::class,  'user_one');
    }

    /**
     * Get conversation second user.
     *
     * @return BelongsTo
     */
    public function userTwo() : BelongsTo
    {
        return $this->belongsTo(User::class,  'user_two');
    }

    /**
     * @return Collection
     */
    public function lastMessage(): Collection
    {
        return $this->messages->last();
    }
}
