<?php

namespace App\Imports;

use App\Produk;
use Maatwebsite\Excel\Concerns\ToModel;

class CsvImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Produk([
            'name'          => $row[0],
            'kategoris_id'  =>  $row[1],
            'price'         =>  $row[2],
            'thumb'         =>  $row[3],
            'deskripsi'     =>  $row[4],
        ]);
    }
}
