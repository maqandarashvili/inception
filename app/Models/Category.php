<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @return BelongsToMany
     */
    public function ranks()
    {
        return $this->belongsToMany(Rank::class);
    }

    /**
     * @return BelongsToMany
     */
    public function prizes()
    {
        return $this->belongsToMany(Prize::class)->withPivot('amount', 'odds');
    }

}
