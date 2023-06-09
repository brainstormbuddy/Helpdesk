<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ticket
 *
 * @property int $id
 * @property int $priority_id
 * @property int $unit_id
 * @property int $owner_id
 * @property int $problem_category_id
 * @property string $title
 * @property string $description
 * @property int $ticket_statuses_id
 * @property int|null $responsible_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $approved_at
 * @property Carbon|null $solved_at
 * @property string|null $deleted_at
 *
 * @property Priority $priority
 * @property Unit $unit
 * @property User|null $user
 * @property ProblemCategory $problem_category
 * @property TicketStatus $ticket_status
 * @property Collection|Comment[] $comments
 *
 * @package App\Models
 */
class Ticket extends Model
{
    use SoftDeletes;
    protected $table = 'tickets';

    protected $casts = [
        'priority_id' => 'int',
        'unit_id' => 'int',
        'owner_id' => 'int',
        'problem_category_id' => 'int',
        'ticket_statuses_id' => 'int',
        'responsible_id' => 'int',
        'approved_at' => 'datetime',
        'solved_at' => 'datetime'
    ];

    protected $fillable = [
        'priority_id',
        'unit_id',
        'owner_id',
        'problem_category_id',
        'title',
        'description',
        'ticket_statuses_id',
        'responsible_id',
        'approved_at',
        'solved_at'
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function problemCategory()
    {
        return $this->belongsTo(ProblemCategory::class);
    }

    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_statuses_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'tiket_id');
    }
}
