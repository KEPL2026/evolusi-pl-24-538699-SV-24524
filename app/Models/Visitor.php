<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visitor extends Model
{
    protected $primaryKey = 'id_visitor';
    public $timestamps = false;

    protected $fillable = [
        'id_link',
        'ip_address',
        'browser',
        'referrer',
        'device',
        'country',
        'city',
        'user_agent',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    /**
     * Get the link that owns the visitor.
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class, 'id_link', 'id_link');
    }
}
