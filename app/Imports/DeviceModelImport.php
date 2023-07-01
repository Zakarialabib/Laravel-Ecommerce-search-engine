<?php

declare(strict_types=1);

namespace App\Imports;

use App\Helpers;
use App\Models\Brand;
use App\Models\DeviceModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeviceModelImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            DeviceModel::create([
                'name' => $row['nom'],
                'description' => $row['description'],
                'slug' => Str::slug($row['nom'], '-').'-'.Str::random(5),
                'code' => Str::random(10),
                'brand_id' => Brand::where('name', $row['marque'])->first()->id ?? Helpers::createBrand(['name' => $row['marque']]),
                'image' => Helpers::uploadImage($row['image'], $row['nom']) ?? 'default.jpg',
                'meta_title' => Str::limit($row['nom'], 60),
                'meta_description' => Str::limit($row['description'], 160),
                'meta_keywords' => Str::limit($row['nom'], 60),
                'status' => 0,
            ]);
        }
    }
}
