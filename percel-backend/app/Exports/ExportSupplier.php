<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Supplier;
//FromCollection, WithHeadings, WithColumnWidths, WithStyles
class ExportSupplier implements FromCollection, WithTitle, WithHeadings { 
    
    public function collection()
    {
        return Supplier::select('id','name','email','phone_number','created_at','updated_at')->get();
    }

    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Phone Number',
            'Created_at',
            'Updated_at' 
        ];
    } 

    public function title(): string
    {
        return 'Supplier';
    }
}