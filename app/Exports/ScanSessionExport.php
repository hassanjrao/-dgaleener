<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;

use App\Models\ScanSession;

class ScanSessionExport implements FromView, ShouldAutoSize, WithEvents
{
    use RegistersEventListeners;

    public $scan_session;

    public function __construct(int $id)
    {
        $this->scan_session = ScanSession::find($id);
    }

    public function view(): View
    {
        return view('exports.scan_sessions', [
            'scan_session' => $this->scan_session
        ]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        $styles = [
            'default' => [
                'size' => '12'
            ],
            'headers' => [
                'font' => [
                    'bold' => true,
                    'size' => '12'
                ]
            ],
            'pairs' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                    ]
                ],
                'font' => [
                    'size' => '12'
                ]
            ]
        ];
        
        // Heading section
        $event->sheet->getDelegate()->getStyle('A1:A5')->applyFromArray($styles['headers']);

        // Client Information section
        $event->sheet->getDelegate()->getStyle('A7:A7')->applyFromArray($styles['headers']);
        $event->sheet->getDelegate()->getStyle('A8:A12')->applyFromArray($styles['default']);

        // Pairs List section
        $pairsStartRow = 13;
        $pairsEndRow = $event->sheet->getHighestRow();
        if ($pairsStartRow == $pairsEndRow) {
            $startRow = $pairsStartRow + 1;
            $event->sheet->append(['No records.'], 'A'.$startRow);
            $pairsEndRow++;
        }
        $event->sheet->getDelegate()->getStyle('A'.$pairsStartRow.':F'.$pairsStartRow)->applyFromArray($styles['headers']);
        $event->sheet->getDelegate()->getStyle('A'.$pairsStartRow.':F'.$pairsEndRow)->applyFromArray($styles['pairs']);
    }
}
