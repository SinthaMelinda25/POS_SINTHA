@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<style>
    :root {
        --green-darkest: #33623c;
        --green-primary:  #4f8a5b;
        --green-soft:     #9fc7a8;
        --green-pale:     #eef5ef;
    }

    .page-heading-detail {
        font-weight: 800;
        color: var(--green-darkest);
        margin: 1.8rem 0 1.2rem;
        text-align: center;
    }

    .struk-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
    }

   .struk {
    background-color: #fff;
    width: 380px;
    max-width: 100%;
    padding: 1.75rem 1.5rem;
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(51, 98, 60, 0.12);
    font-family: 'Courier New', Courier, monospace;
    color: #333;
    position: relative;
}

.struk-header .toko-name {
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--green-darkest);
    letter-spacing: .5px;
    margin-bottom: .15rem;
    text-align: center;
}

.struk-header .toko-sub {
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: .75rem;
    color: #777;
    text-align: center;
}
    .struk-divider {
        border-top: 1px dashed var(--green-soft);
        margin: .9rem 0;
    }

    .struk-info {
        font-size: .8rem;
        line-height: 1.6;
    }

    .struk-info .row-item {
        display: flex;
        justify-content: space-between;
        gap: .5rem;
    }

    .struk-info .row-item span:first-child {
        color: #777;
    }

    .struk-items .item-row {
        margin-bottom: .6rem;
    }

    .struk-items .item-name {
        font-size: .85rem;
        font-weight: 700;
        color: #222;
    }

    .struk-items .item-detail {
        display: flex;
        justify-content: space-between;
        font-size: .8rem;
        color: #555;
    }

    .struk-total {
        display: flex;
        justify-content: space-between;
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--green-darkest);
        margin-top: .5rem;
    }

    .struk-status {
        text-align: center;
        margin-top: 1.1rem;
    }

    .struk-status .badge-status {
        background-color: var(--green-pale);
        color: var(--green-darkest);
        font-weight: 700;
        font-size: .75rem;
        letter-spacing: 1px;
        padding: .35rem 1rem;
        border-radius: 999px;
        display: inline-block;
    }

    .struk-footer {
        text-align: center;
        font-size: .75rem;
        color: #999;
        margin-top: 1.2rem;
    }

    .btn-kembali-wrapper {
        text-align: center;
    }

    .btn-kembali {
        border: 1.5px solid var(--green-primary);
        color: var(--green-primary);
        background: transparent;
        border-radius: 8px;
        font-weight: 500;
        padding: .5rem 1.4rem;
    }

    .btn-kembali:hover {
        background-color: var(--green-primary);
        color: #fff;
    }
</style>

<h1 class="page-heading-detail">Detail Penjualan</h1>

<div class="struk-wrapper">
    <div class="struk">

        <div class="struk-header">
            <div class="toko-name">POINT OF SALE</div>
            <div class="toko-sub">Struk Transaksi Penjualan</div>
        </div>

        <div class="struk-divider"></div>

        <div class="struk-info">
            <div class="row-item">
                <span>No. Transaksi</span>
                <span>#{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="row-item">
                <span>Tanggal</span>
                <span>{{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y H:i:s') : '-' }}</span>
            </div>
            <div class="row-item">
                <span>Kasir</span>
                <span>{{ $sale->user->name ?? '-' }}</span>
            </div>
        </div>

        <div class="struk-divider"></div>

        <div class="struk-items">
            @forelse ($sale->itemPenjualan as $item)
            <div class="item-row">
                <div class="item-name">{{ $item->produk->nama ?? 'Produk tidak ditemukan' }}</div>
                <div class="item-detail">
                    <span>{{ $item->kuantitas }} x Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                    <span>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <div class="text-center text-muted" style="font-size:.8rem;">Tidak ada item.</div>
            @endforelse
        </div>

        <div class="struk-divider"></div>

        <div class="struk-total">
            <span>TOTAL</span>
            <span>Rp{{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
        </div>

        <div class="struk-info" style="margin-top:.6rem;">
            <div class="row-item">
                <span>Metode Bayar</span>
                <span>{{ $sale->metode_pembayaran ?? '-' }}</span>
            </div>
        </div>

        <div class="struk-status">
            <span class="badge-status">{{ $sale->status }}</span>
        </div>

        <div class="struk-footer">
            *** Terima Kasih ***
        </div>

    </div>
</div>

<div class="btn-kembali-wrapper">
    <a href="{{ route('penjualan.index') }}" class="btn btn-kembali">Kembali</a>
</div>

@endsection