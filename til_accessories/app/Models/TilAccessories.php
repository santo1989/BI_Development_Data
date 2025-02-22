<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TilAccessories extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    protected $table = 'til_accessories';

    protected $casts = [
        'WO_Date' => 'date',
        'Delivery_Date' => 'date',
    ];

    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where(function ($query) use ($term) {
                $query->where('WO_No', 'like', "%{$term}%")
                ->orWhere('Supplier', 'like', "%{$term}%")
                ->orWhere('Buyer', 'like', "%{$term}%");
            });
        }

        return $query; // Ensure it returns a query builder, not a collection.
    }


    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function itemUmo()
    {
        return $this->belongsTo(ItemUmo::class);
    }
}
