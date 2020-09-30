<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App\Models
 * @property int $id;
 * @property string $short_text
 * @property string $long_text
 * @property string $status
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property int $user_id
 */
class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'short_text',
        'long_text',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'foreign_key');
    }
}
