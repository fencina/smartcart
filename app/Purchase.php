<?php

namespace App;

use App\Events\PurchaseCreated;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'amounts',
    ];

    /**
     * @var array
     */
    protected $events = [
        'created' => PurchaseCreated::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }

    /**
     * Filter pending purchases
     *
     * @param $query
     * @return mixed
     */
    public function scopePending($query)
    {
        return $query->where('status_id', Status::PENDING);
    }
}
