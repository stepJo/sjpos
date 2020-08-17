<!doctype html>
<html>

	<head>

	    <meta charset="utf-8">

	    <title>Data Transaksi ({{ date('d F Y') }})</title>

	    <style>

	    	* {
	    		border-size: border-box;
	    	}

	    	body {
	    		margin: 0;
	    		padding: 0;
	    	}

		    .invoice-box {
		        width: 700px;
		        margin: auto;
		        padding: 20px 0 10px 0;
		        border: 1px solid #eee;
		        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
		        font-size: 14px;
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
		        vertical-align: middle;
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
		        padding-bottom: 10px;
		    }
		    
		    .invoice-box table tr.top table td.title {
		        font-size: 25px;
		        line-height: 45px;
		        color: #333;
		    }
		    
		    .invoice-box table tr.information table td {
		        padding-bottom: 20px;
		    }
		    
		    .invoice-box table tr.heading td {
		        background: #eee;
		        border-bottom: 1px solid #ddd;
		        font-size: 13px;
		        width: 100%;
		    }
		    
		    .invoice-box table tr.details td {
		        padding-bottom: 15px;
		        vertical-align: middle;
		        font-weight: bold;
		    }
		    
		    .invoice-box table tr.item td{
		        border-bottom: 1px solid #eee;
		        font-size: 12px;
		    }
		    
		    .invoice-box table tr.total td:nth-child(2) {
		        border-top: 2px solid #eee;
		        font-weight: bold;
		    }

		    h4 {
		    	margin-left: 15px;
		    	font-size: 20px;
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

	                <td colspan="6">

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

	                <td colspan="6">

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

	            	<td colspan="6">Total Transaksi : </td>

	            </tr>

	            <tr class="details">

	            	<td>{{ count($transactions) }}</td>

	            </tr>
	            
	            <tr class="heading">

	                <td>Kode</td>

	                <td>Metode Bayar</td>

	                <td>Total</td>

	                <td>Pajak</td>

	                <td>Diskon</td>

	                <td>Tanggal</td>

	            </tr>
	            	
	            @foreach($transactions as $transaction)

		            <tr class="item">

		                <td>{{ $transaction->t_code }}</td>

		                <td>{{ $transaction->t_type }}</td>

		                <td>{{ Utilities::rupiahFormat($transaction->t_total) }}</td>

		                <td>{{ Utilities::rupiahFormat($transaction->t_tax) }}</td>

		                <td>{{ Utilities::rupiahFormat($transaction->t_disc) }}</td>

		                <td>{{ date('d F Y H:i:s', strtotime($transaction->t_date)) }}</td>

		            </tr>

		        @endforeach
	       
	        </table>

	        <h4>Total : {{ Utilities::rupiahFormat($transactions->sum('t_total')) }}</h4>

	    </div>

	</body>

</html>