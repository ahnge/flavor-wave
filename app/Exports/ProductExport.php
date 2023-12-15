<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select('title', 'price', 'total_box_count', 'available_box_count', 'updated_at')->get();
    }

    public function headings(): array
    {
        return ['Title', 'Price', 'Total Box Count', 'Available Box Count', 'Updated At'];
    }

    public function map($product): array
    {
        return [
            $product->title,
            $product->price,
            $product->total_box_count,
            $product->available_box_count,
            $product->updated_at,
        ];
    }
}
