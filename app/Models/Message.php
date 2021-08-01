<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property string $message
 * @property int $conversation_id
 * @property int $is_seen
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Conversation $conversation
 * @property-read User $sender
 * @method static \Database\Factories\MessageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereConversationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereIsSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 * @mixin Eloquent
 */
class Message extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'conversation_id',
        'user_id',
        'message',
        'is_seen',
    ];


    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }


    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
