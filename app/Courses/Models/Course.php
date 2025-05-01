<?php

namespace App\Courses\Models;

use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course withoutTrashed()
 * @mixin \Eloquent
 */
class Course extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return CourseFactory::new();
    }

    protected $table = 'courses';

    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'status',
        'is_premium',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

}
