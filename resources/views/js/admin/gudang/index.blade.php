<script>
    $(document).ready(function () {
        $('#daftar_data_1 thead th').each(function () {
            var title = $(this).text();
    
            if (title !== '') {
                $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
            } else {
                $(this).html('');
            }
        });
    
        var table1 = $('#daftar_data_1').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": "{{ route('Admin Tabel Gudang') }}",
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
                {"data":"tgl"},
                {"data":"judul"},
                {"data":"kondisi"},
                {"data":"kuantitas"},
                {"data":"action"},
            ],
            "createdRow": function( row, data, dataIndex){
                if( data['kondisi'] ==  'Berkurang'){
                    $(row).addClass('bg-red');
                } else {
                    $(row).addClass('bg-green');
                }
            }
        });
        
        table1.columns().every(function () {
            var table = this;
            $('input', this.header()).on('keyup change', function () {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
            $('select', this.header()).on('change', function () {
                if (table.search() !== this.value) {
                    table.search(this.value).draw();
                }
            });
        });        
    });
</script>