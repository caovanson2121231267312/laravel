<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExport implements FromCollection, WithTitle, WithColumnFormatting, WithColumnWidths, WithHeadings, WithMapping, WithEvents, WithStyles
{

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $event->sheet->setCellValue("A1", "Quản lý báo cáo người dùng");
            }
        ];
    }

    public function collection()
    {
        $data = User::all();

        return collect($data);
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->name,
            $data->email,
            $data->establish,
            $data->created_at,
            $data->updated_at,
        ];
    }

    public function title(): string
    {
        return "Danh sách người dùng";
    }

    public function  columnFormats(): array
    {
        return [
            "D" => NumberFormat::FORMAT_DATE_DDMMYYYY,
            "E" => NumberFormat::FORMAT_DATE_DDMMYYYY,
            "F" => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function columnWidths(): array
    {
        return [
            "A" => 20,
            "B" => 30,
            "C" => 50,
            "D" => 40,
        ];
    }

    public function headings(): array
    {
        return [
            [
                "ID",
                "Tên khách hàng",
                "Email",
                "Ngày tháng năm sinh",
                "Tạo lúc",
                "cập nhật lúc",
            ]
        ];
    }

    public function styles(Worksheet $wk) {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'rgb' => 'FF0000'
                    ],
                ],
            ],
        ];
    }
}
