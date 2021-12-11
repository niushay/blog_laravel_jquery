<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class PostsExport implements
    FromCollection,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user_id = auth() -> user() ->id;
        return Post::where('user_id', $user_id)->get();
    }


    public function map($row): array
    {
        return [
            $row -> title,
            $row -> post_content,
            $row -> time,
        ];
    }

    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Time to read in min'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->getStyle('A1:C1') -> applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                    ]
                ]);
            },
        ];
    }
}
