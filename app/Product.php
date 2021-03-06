<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait, Searchable;

    protected $guarded = [];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.name' => 10,
            'products.details' => 5,
            'products.description' => 2,
        ],
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $extraFields = [
            'categories' => $this->categories->pluck('name')->toArray()
        ];

        return array_merge($array, $extraFields);
    }

    public function categories()
    {
        return $this->belongsToMany('App\ProductCategory');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getFormattedPrice()
    {
        return '$' . number_format($this->price / 100, 2);
    }

    public function getImagePath()
    {
        return generateImageLink($this->image, $this->slug);
    }

    public function getImageGalleryPaths()
    {
        $images = json_decode($this->images, true);
        $imagePaths = [];

        if (isset($images) && count($images) > 0) {
            foreach ($images as $image) {
                array_push($imagePaths, generateImageLink($image));
            }
        }
        return $imagePaths;
    }

    public function scopeMightLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }

    public function getStockLevel()
    {
        if ($this->quantity > setting('site.stock_threshold')) {
            $stockLevel =  '<div class="badge badge-success">In Stock</div>';
        } else if ($this->quantity < setting('site.stock_threshold') && $this->quantity > 0) {
            $stockLevel =  '<div class="badge badge-warning">Low Stock</div>';
        } else {
            $stockLevel = '<div class="badge badge-danger">Out of Stock</div>';
        }

        return $stockLevel;
    }
}
