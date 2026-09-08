<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    protected $primaryKey = 'id_link';

    protected $fillable = [
        'id_user',
        'name',
        'true_link',
        'new_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the link.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Get the visitors for the link.
     */
    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'id_link');
    }
}
