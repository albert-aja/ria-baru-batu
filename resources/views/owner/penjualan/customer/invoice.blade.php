<!DOCTYPE html>
<html>
	<head>
        <title>{{ config('app.name') }}</title>        
        <link rel="stylesheet" href="{{ asset('dashboard-package/themes/css/OwnerLTE.css') }}">        
        <style>
            table {
                border-collapse: collapse !important;
                font-weight: 400;
            }
            td{
                padding: 5px;
            }
            th{
                padding: 8px;
            }
            @page {
                margin: 50px 25px;
            }

            header {
                position: fixed;
                top: -40px;
                left: 0px;
                right: 0px;
                height: 50px;                
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
	</head>

	<body>
        <header>
            <table style="width: 100%;">
                <tr>
                    <th style="font-size: 12pt; text-align: left; border-top: 1px solid black; border-bottom: 1px solid black; vertical-align: middle !important;">Invoice</th>
                    <th style="font-size: 12pt; text-align: right; border-top: 1px solid black; border-bottom: 1px solid black; vertical-align: middle !important;">Ria Baru <font style="font-size: 11pt; font-weight: 400;">Pertambangan Batu</font></th>
                </tr>
            </table>
        </header>
        
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <table style="width: 100%; margin-bottom: 10px;">
                        <tr>
                            <th style="font-size: 8pt; width: 40%; text-align:left; font-weight: bold;">Tanggal</th>
                            <td style="font-size: 8pt; width: 1%; text-align:left; font-weight: light;">:</td>
                            <td style="font-size: 8pt; text-align:left; font-weight: light;">{{ Carbon::parse($data->tgl)->isoFormat('dddd, D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <th style="font-size: 8pt; text-align:left; font-weight: bold;">Kepada</th>
                            <td style="font-size: 8pt; text-align:left; font-weight: light;">:</td>
                            <td style="font-size: 8pt; text-align:left; font-weight: light;">{{ $data->customer }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                </td>
            </tr>
        </table>

        <table style="width: 100%; font-size: 8pt; margin-bottom: 20px;">
            <tr>
                <th style="text-align: left; border-top: 1px solid black; border-bottom: 1px solid black; vertical-align: middle !important;">Kuantitas</th>
                <th style="text-align: right; border-top: 1px solid black; border-bottom: 1px solid black; vertical-align: middle !important;">Harga/Truk</th>
                <th style="text-align: right; border-top: 1px solid black; border-bottom: 1px solid black; vertical-align: middle !important;">Subtotal</th>
            </tr>
            <tr>
                <td style="text-align: left;">{{ $data->kuantitas }} Truk</td>
                <td style="text-align: right;">{{ GeneralHelp::get_numeral(1, $data->harga_jual) }}</td>
                <td style="text-align: right;">{{ GeneralHelp::get_numeral(1, ($data->harga_jual * $data->kuantitas)) }}</td>
            </tr>
            <tr>
                <th colspan="2" style="text-align: right; border-bottom: 1px solid black; ">Total</th>
                <th style="text-align: right; border-bottom: 1px solid black; ">{{ GeneralHelp::get_numeral(1, $data->harga_jual * $data->kuantitas) }}</th>
            </tr>
        </table>

        <table style="width: 100%; font-size: 9pt; ">
            <tr>
                <th style="width: 50%;">Hormat Kami<br><br><br><br><br><br>Ria Baru</th>
                <th style="width: 50%;">Diterima Oleh<br><br><br><br><br><br>{{ $data->customer }}</th>
            </tr>
        </table>
    </body>
</html>
