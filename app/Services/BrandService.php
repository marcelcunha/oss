<?php

namespace App\Services;

use App\Enums\BrandCategoryEnum;
use App\Models\Brand;
use Illuminate\Support\Collection;

class BrandService
{
    /**
     * @return Collection <int, Brand>
     */
    public static function brands(?BrandCategoryEnum $category = null): Collection
    {
        return Brand::query()
            ->when($category, fn ($query) => $query->whereJsonContains('categories', $category))
            ->orderBy('name')
            ->get();
    }

    /**
     * @return Collection <int, string>
     */
    public static function brandsForSelect(?BrandCategoryEnum $category = null): Collection
    {
        return self::brands($category)
            ->mapWithKeys(
                function (Brand $brand) {
                    return [
                        $brand->id => $brand->name,
                    ];
                }
            );
    }

    /**
     * @return array<string, mixed>
     */
    public function edit(Brand $brand): array
    {
        $categories = '';
        if (! empty($brand->categories)) {
            $categories = implode('; ', $brand->categories);
        }

        return [
            'brand' => $brand,
            'categories' => $categories,
        ];
    }

    /**
     * @param  array<string, mixed>  $categories
     */
    public function store(string $name, array $categories = []): Brand
    {

        return Brand::create([
            'name' => $name,
            'categories' => $categories,
        ]);
    }

    /**
     * @param  array<string, mixed>  $categories
     */
    public function update(Brand $brand, string $name, array $categories = []): Brand
    {
        $brand->update([
            'name' => $name,
            'categories' => $categories,
        ]);

        return $brand;
    }
}
