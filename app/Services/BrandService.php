<?php

namespace App\Services;

use App\Models\Brand;

class BrandService
{
    public function store(string $name, array $categories = []): Brand
    {

        return Brand::create([
            'name' => $name,
            'categories' => $categories,
        ]);
    }

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

    public function update(Brand $brand, string $name, array $categories = []): Brand
    {
         $brand->update([
            'name' => $name,
            'categories' => $categories,
        ]);

        return $brand;
    }
}
