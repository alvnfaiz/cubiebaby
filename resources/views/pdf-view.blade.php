<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
<style>
    @page { size: A4 }
    body{
        margin:20px;
    }
    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }
  
    table {
        border-collapse: collapse;
        width: 100%;
    }
  
    .table th {
        padding: 8px 8px;
        border:1px solid #000000;
        text-align: center;
    }
  
    .table td {
        padding: 3px 3px;
        border:1px solid #000000;
    }
  
    .text-center {
        text-align: center;
    }
</style>
</head>

<body class="A4">
    <section class="sheet">
        <h1>Cubie Baby</h1>
        <h5>{{$tanggal}}</h5>  
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th>
                        Nama Produk
                    </th>
                    <th>
                        Modal
                    </th>
                    <th>
                        Terjual
                    </th>
                    <th>
                        Harga
                    </th>
                    <th>
                        Pendapatan
                    </th>
                    <th>
                        Keuntungan
                    </th>
                </tr>
            </thead>
            <tbody id="report">
                @foreach ($reports['products'] as $product)
                        <tr>
                            <td>
                                <div>
                                    <div>
                                        <p>
                                            {{ $product->name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>Rp. {{ number_format($product->capital,2,',','.') }}</p>
                            </td>
                            <td>
                                <p>
                                    {{ $product->total_order }}
                                </p>
                            </td>
                            <td>
                                <p>
                                    Rp. {{ number_format($product->price,2,',','.') }}
                                </p>
                            </td>
                            <td>
                                <p>
                                    Rp. {{ number_format($product->total_order*$product->price,2,',','.') }}
                                </p>
                            </td>
                            <td>
                                <span
                                   >
                                    <span
                                       ></span>
                                    <span>Rp. {{ number_format($product->total_order*$product->price - $product->total_order*$product->capital,2,',','.') }}</span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>