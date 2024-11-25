<?php

namespace App\Exports;

use App\Models\Prosthes;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
class ProductsExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $data = $this->getProductsData();

        return collect($data)->map(function ($product) {
            return [
                'Товар' => $product->name,
                'Цена' => $product->price,
                'Кол-во продаж' => $product->total,
            ];
        });
    }

    public function getProductsData()
    {
        $popularProducts = DB::table('prosthes_orders')
            ->select('prosthes_id', DB::raw('COUNT(*) as total'))
            ->groupBy('prosthes_id')
            ->orderBy('total', 'desc')
            ->get();

        $data = [];

        foreach ($popularProducts as $product) {
            $productData = Prosthes::find($product->prosthes_id);
            $productData->total = $product->total;
            $data[] = $productData;
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Товар',
            'Цена',
            'Кол-во продаж',
        ];
    }
}