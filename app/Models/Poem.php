<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'poem_proper', 'last_accessed_at', 'length'];

    // Mutator to calculate length based on poem_proper
    public function setPoemProperAttribute($value)
    {
        $this->attributes['poem_proper'] = $value;
        $this->attributes['length'] = str_word_count($value);
    }

    // Eloquent event listener
    protected static function boot()
    {
        parent::boot();

        // On creating event
        static::creating(function ($poem) {
            // Calculate length if poem_proper is set
            if ($poem->poem_proper) {
                $poem->length = str_word_count($poem->poem_proper);
            }
        });
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->as('tags');
    }
}
