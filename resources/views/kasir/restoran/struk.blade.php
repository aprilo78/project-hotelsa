@extends('layouts.dashboard')
@section('title','Struk Pembayaran')
@section('content')
<div class="struk-container">
    <div class="struk-card" id="struk-print">
        <div class="struk-header">
            <h2>DRG Hotel</h2>
            <p>Restoran & Kuliner</p>
            <hr>
        </div>

        <div class="struk-meta">
            <p><strong>No. Order:</strong> #{{ str_pad($order->id,6,'0',STR_PAD_LEFT) }}</p>
            <p><strong>Tamu:</strong> {{ $order->guest?->name ?? 'Walk-in Guest' }}</p>
            @if($order->booking)
            <p><strong>Kamar:</strong> {{ $order->booking->room->room_number }}</p>
            @endif
            <p><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Kasir:</strong> {{ $order->payment?->kasir?->name ?? '-' }}</p>
        </div>

        <hr>

        <table class="struk-items">
            <thead>
                <tr>
                    <th>Item</th><th>Qty</th><th>Harga</th><th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $detail)
                <tr>
                    <td>{{ $detail->menu->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->price,0,',','.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal(),0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <div class="struk-total">
            <div class="struk-row">
                <span>Total</span>
                <strong>Rp {{ number_format($order->total_price,0,',','.') }}</strong>
            </div>
            @if($order->payment)
            <div class="struk-row">
                <span>Metode</span>
                <span>{{ strtoupper($order->payment->payment_method) }}{{ $order->payment->bank ? ' - '.$order->payment->bank : '' }}</span>
            </div>
            <div class="struk-row">
                <span>Status</span>
                <span class="badge badge-success">LUNAS</span>
            </div>
            @endif
        </div>

        <div class="struk-footer">
            <p>Terima kasih telah menikmati hidangan kami!</p>
            <p>DRG Hotel — Selalu Melayani dengan Sepenuh Hati</p>
        </div>
    </div>

    <div class="struk-actions no-print">
        <button onclick="window.print()" class="btn btn-gold">🖨️ Cetak Struk</button>
        <a href="{{ route('kasir.restoran.dashboard') }}" class="btn btn-outline">← Kembali</a>
    </div>
</div>

@push('styles')
<style>
@media print {
    .no-print { display: none !important; }
    .struk-card { max-width: 300px; margin: 0 auto; font-size: 12px; }
}
</style>
@endpush
@endsection