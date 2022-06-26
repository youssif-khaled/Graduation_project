<?php

namespace App\Exports;

use App\Models\Request;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Request::select('id','created_at','employee_id','status')->get();
    }
    public function headings(): array
    {
        return ["ID", "CREATED_AT","Employee_ID", "STATUS"];
    }
}
