@extends("layouts.app")

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create')}}" method="GET" class="btn btn-primary mb-3">Create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input 
            type="text"
            name="search"
            value=""
            class="form-control"
            placeholder="Search nama produk"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table align-middle"> <!-- Ditambahkan align-middle agar semua baris sejajar vertikal di tengah -->
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
      <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
      <td>{{ $product->user->name }}</td>
      <td>
        <img src="{{ asset('storage/'.$product->foto) }}"
                  width="100"
                  class="img-thumbnail">
      </td>
      <td>{{ $product->nama }}</td>
      <td>{{ $product->harga_beli }}</td>
      <td>{{ $product->harga_jual }}</td>
      <td>{{ $product->stok }}</td>
      
      <!-- PERBAIKAN DI SINI: Menghapus d-flex dari td dan memindahkannya ke div bungkus -->
      <td>
        <div class="d-flex align-items-center gap-1">
          @can('update', $product)
            <a href="{{ route('produk.edit' , $product) }}" class="btn btn-warning">Edit</a>
          @endcan
          
          <span class="text-muted">||</span> <!-- Membungkus garis pemisah agar rapi -->
          
          @can('delete', $product)
            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline m-0">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">
                    Hapus
                </button> 
            </form>
          @endcan
        </div>
      </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center"><h1>Data tidak tersedia</h1></td>
    </tr>
    @endforelse
  </tbody>
</table>

{{ $products->links() }}

@endsection