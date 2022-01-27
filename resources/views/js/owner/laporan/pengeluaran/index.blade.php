<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#periode_awal').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD',
            ignoreReadonly: true
        });

        $('#periode_akhir').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD',
            ignoreReadonly: true
        });

        var table1 = $('#daftar_data_1').DataTable({
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "ajax": "{{ route('Owner Tabel Laporan Pengeluaran', ['awal' => date('Y-m-d'), 'akhir' => date('Y-m-d'), 'kategori' => 'null']) }}",
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right">>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
            columns: [
                {"data":"kategori"},
                {"data":"tgl"},
                {"data":"nominal"},
                {"data":"keterangan"},
            ],
        });

        $(document).on('click', 'TombolLihat', function () {
            reload_table();
        });

        function reload_table(){
            table1.destroy();
            var awal = $('#periode_awal').val();
            var akhir = $('#periode_akhir').val();
            var kategori = $('#kategori').val();

            var link = "{{ route('Owner Tabel Laporan Pengeluaran', ['awal' => ':periode_awal', 'akhir' => ':periode_akhir', 'kategori' => ':kategori']) }}";
            var url = link.replace(':periode_awal', awal);
            url = url.replace(':periode_akhir', akhir);
            url = url.replace(':kategori', kategori);
            
            table1 = $('#daftar_data_1').DataTable({
            "processing": true,
            "serverSide": false,
            "ordering": false,
            "ajax": url,
            lengthMenu: [
                [5, 10, 25, 100, -1],
                [5, 10, 25, 100, "All"]
            ],
            pageLength: 10,
            dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"B>>,' +
                '<"columns row"<"column col-sm-12"tr>>,' +
                '<"columns row"<"column col-sm-12 text-center"i>>,' +
                '<"columns row"<"column col-sm-12"<"text-center"p>>>',
                buttons: [
                { 
                    extend: 'excel', 
                    text: 'Export Excel',
                    messageTop: 'Laporan Pengeluaran',
                    className: 'btn btn-sm btn-success',
                    init: function (api, node, config) {
                        $(node).removeClass('btn-default')
                    }
                },
                { 
                    extend: 'pdf', 
                    text: 'Export PDF',
                    messageTop: 'Laporan Pengeluaran',
                    className: 'btn btn-sm btn-success',
                    init: function (api, node, config) {
                        $(node).removeClass('btn-default')
                    }
                },
            ],
            columns: [
                {"data":"kategori"},
                {"data":"tgl"},
                {"data":"nominal"},
                {"data":"keterangan"},
            ],
        });
        }
    });
</script>