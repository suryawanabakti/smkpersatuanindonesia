<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Payment::with('user.pendaftaran')->latest();

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['jurusan'])) {
            $jurusan = $this->filters['jurusan'];
            $query->whereHas('user.pendaftaran', function ($q) use ($jurusan) {
                $q->where('jurusan_pilihan', $jurusan);
            });
        }

        if (!empty($this->filters['start_date'])) {
            $query->whereDate('created_at', '>=', $this->filters['start_date']);
        }

        if (!empty($this->filters['end_date'])) {
            $query->whereDate('created_at', '<=', $this->filters['end_date']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Order ID',
            'Nama Siswa',
            'Jurusan',
            'Jumlah',
            'Status',
            'Keterangan',
            'Atribut',
            'Tanggal',
        ];
    }

    public function map($payment): array
    {
        static $no = 0;
        $no++;

        $attributes = [];
        if ($payment->topi) $attributes[] = 'Topi';
        if ($payment->dasi) $attributes[] = 'Dasi';
        if ($payment->baju) $attributes[] = 'Baju';
        if ($payment->batik) $attributes[] = 'Batik';
        if ($payment->baju_olahraga) $attributes[] = 'Baju Olahraga';

        return [
            $no,
            $payment->order_id,
            $payment->user?->name ?? 'N/A',
            $payment->user?->pendaftaran?->jurusan_pilihan ?? '-',
            'Rp ' . number_format($payment->amount, 0, ',', '.'),
            ucfirst($payment->status),
            $payment->description ?? '-',
            implode(', ', $attributes) ?: '-',
            $payment->created_at->format('d/m/Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
