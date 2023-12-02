<?php

namespace App\Imports;

use App\Models\Producto;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductosImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Producto([
            'foto'              => !empty($row['foto']) ? trim($row['foto']) : null,
            'codigo'            => !empty($row['codigo']) ? trim($row['codigo']) : null,
            'producto'          => Str::upper($row['titulo']),
            'precio'            => !empty($row['precio']) ? trim($row['precio']) : null,
            'categoria'         => !empty($row['precio']) ? trim(Str::upper($row['categoria'])) : null,
            'descripcion'       => !empty($row['precio']) ? trim(Str::ucfirst($row['descripcion'])) : null,
        ]);
    }

    /**
    * @return array
    */
    public function rules(): array
    {
        return [
            '*.titulo' => ['string', 'unique:productos,producto'],
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'titulo.unique' => 'El nombre del producto ya existe.',
        ];
    }
}
