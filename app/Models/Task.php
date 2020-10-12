<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo};

class Task extends Model
{
    use HasFactory;

    public const STATUS_PENDING = '0';
    public const STATUS_ASSIGNED = '1';
    public const STATUS_COMPLETED = '2';

    protected $fillable = [
        'name',
        'status',
    ];

    protected $appends = [
        'status_label',
        'assigned_at',
    ];

    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ASSIGNED,
            self::STATUS_COMPLETED,
        ];
    }

    public function assigner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigner_id', 'id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function completedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by', 'id');
    }

    public function getStatusLabelAttribute(): string
    {
        switch ($this->attributes['status']) {
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_ASSIGNED:
                return 'Assigned';
            case self::STATUS_COMPLETED:
                return 'Completed';
            default:
                return 'N/A';
        }
    }

    public function getAssignedAtAttribute(): string
    {
        return (new Carbon($this->attributes['created_at']))->format('m-d-Y H:i:s');
    }
}
