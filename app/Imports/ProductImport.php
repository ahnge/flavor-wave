<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class ProductImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $product = Product::find($row['product_id']);

        if ($product) {
            $product->total_box_count += $row['count'];
            $product->available_box_count += $row['count'];
            $product->save();
        }

        return null;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required',
            'count' => 'required',
        ];
    }
}
