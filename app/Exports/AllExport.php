<?php

namespace App\Exports;

use App\Models\Admin;
use App\Models\Nomination;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Nomination::get()->map(function ($nomination) {
            return [
                'name' => $nomination->name,
                'email' => $nomination->email,
                'phone' => $nomination->phone,
            ];
        });
    }

    public function headings(): array
    {
        return ["name", "email", "phone"];
    }
}
