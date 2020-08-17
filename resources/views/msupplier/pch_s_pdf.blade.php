<!doctype html>
<html>

	<head>

	    <meta charset="utf-8">

	    <title>Data Penyuplai Barang ({{ date('d F Y') }})</title>

	    <style>

		    .invoice-box {
		        max-width: 800px;
		        margin: auto;
		        padding: 30px;
		        border: 1px solid #eee;
		        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
		        font-size: 11px;
		        line-height: 24px;
		        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		        color: #555;
		    }
		    
		    .invoice-box table {
		        width: 100%;
		        line-height: inherit;
		        text-align: left;
		    }
		    
		    .invoice-box table td {
		        padding: 5px;
		        vertical-align: top;
		    }
		    
		    .invoice-box table tr td:nth-child(2) {
		        text-align: right;
		    }

		    .invoice-box table tr.item td:nth-child(2) {
		        text-align: left;
		    }

		    .invoice-box table tr.heading td:nth-child(2) {
		        text-align: left;
		    }
		    
		    .invoice-box table tr.top table td {
		        padding-bottom: 20px;
		    }
		    
		    .invoice-box table tr.top table td.title {
		        font-size: 25px;
		        line-height: 45px;
		        color: #333;
		    }
		    
		    .invoice-box table tr.information table td {
		        padding-bottom: 40px;
		    }
		    
		    .invoice-box table tr.heading td {
		        background: #eee;
		        border-bottom: 1px solid #ddd;
		        font-weight: bold;
		    }
		    
		    .invoice-box table tr.details td {
		        padding-bottom: 20px;
		    }
		    
		    .invoice-box table tr.item td{
		        border-bottom: 1px solid #eee;
		    }
		    
		    .invoice-box table tr.item.last td {
		        border-bottom: none;
		    }
		    
		    .invoice-box table tr.total td:nth-child(2) {
		        border-top: 2px solid #eee;
		        font-weight: bold;
            }
            
            .newline {
                height: 50px;
                width: 100%;
            }

		    @media only screen and (max-width: 600px) {
		        .invoice-box table tr.top table td {
		            width: 100%;
		            display: block;
		            text-align: center;
		        }
		        
		        .invoice-box table tr.information table td {
		            width: 100%;
		            display: block;
		            text-align: center;
		        }
		    }
	    
		    /** RTL **/
		    .rtl {
		        direction: rtl;
		        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		    }
		    
		    .rtl table {
		        text-align: right;
		    }
		    
		    .rtl table tr td:nth-child(2) {
		        text-align: left;
		    }

	    </style>

	</head>

	<body>

	    <div class="invoice-box">

	        <table cellpadding="0" cellspacing="0">

	            <tr class="top">

	                <td colspan="7">

	                    <table>

	                        <tr>

	                            <td class="title">

	                                <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">

	                            </td>
	                            
	                            <td>

	                                Tanggal : {{ date('d F Y') }}<br>

	                            </td>

	                        </tr>

	                    </table>

	                </td>

	            </tr>
	            
	            <tr class="information">

	                <td colspan="7">

	                    <table>

	                        <tr>

	                            <td>

	                                SJPOS<br>

	                                Tangerang Selatan<br>

	                                Western Cosmo, C1 / 19

	                            </td>
	                            
	                            <td>

	                                {!! 'sjpos@email.com' !!}

	                            </td>

	                        </tr>

	                    </table>

	                </td>

	            </tr>

	            <tr class="heading">

                    <td colspan="7">Total Pembelian : </td>

	            </tr>

	            <tr class="details">

	            	<td>{{ count($purchasements) }}</td>

	            </tr>
	            
	            <tr class="heading">

                    <td>Kode</td>

                    <td>Biaya</td>

                    <td>Pajak</td>

                    <td>Diskon</td>

                    <td>Pengiriman</td>

                    <td>Penyuplai</td>

                    <td>Tanggal</td>
                    
	            </tr>
	            	
	            @foreach($purchasements as $purchasement)

		            <tr class="item">

                        <td>{{ $purchasement->pch_code }}</td>

		                <td>{{ Utilities::rupiahFormat($purchasement->pch_cost) }}</td>

                        <td>{{ Utilities::rupiahFormat($purchasement->pch_tax) }}</td>

                        <td>{{ Utilities::rupiahFormat($purchasement->pch_disc) }}</td>

                        <td>{{ Utilities::rupiahFormat($purchasement->pch_ship) }}</td>

                        <td>{{ $purchasement->supplier->s_name }}</td>

                        <td>{{ Utilities:: dateFormat($purchasement->pch_date) }}</td>

                        <td>

                            <tr class="heading">

                                <td colspan="2">Kode</td>

                                <td colspan="2">Produk</td>

                                <td>Jumlah</td>

                                <td>Harga</td>

                                <td>Total</td>

                            </tr>

                            <tr class="item">

                                @foreach($purchasement->detailPurchasements as $dp)

                                    <td colspan="2">{{ $dp->product->ps_code }}</td>

                                    <td colspan="2">{{ $dp->product->ps_name }}</td>

                                    <td>{{ $dp->qty }}</td>

                                    <td>{{ Utilities::rupiahFormat($dp->product->ps_price) }}</td>

                                    <td>{{ Utilities::rupiahFormat($dp->product->ps_price * $dp->qty) }}</td>
        
                                @endforeach
        
                            </tr>
                        
                        </td>

                    </tr>
                    
		        @endforeach
	       
	        </table>

	    </div>

	</body>

</html>