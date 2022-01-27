<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#tgl').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM-DD',
            ignoreReadonly: true
        });

        $('#Form').on('submit', (function (e) {
            e.preventDefault();

            var peralatan = $("#peralatan").val();            
            
            if (!peralatan) {
                swal("Gagal", "Silahkan periksa kembali form.", "error");
            } else {
                swal({
                        title: 'Harap Tunggu',
                        text: 'Sedang menyimpan data.',
                        button: false,
                        showConfirmButton: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    });

                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    url: "{{ route('Owner Peralatan Operasional Update', $data) }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Operasional berhasil diubah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Owner Peralatan Operasional Show', $data) }}";
                            })
                        } else {
                            swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                        }
                    }
                });
            }
        }));

        $(document).on('change', '#jenis', function () {
            var jenis = $(this).val();
            
            if(jenis == 'Truk'){
                var table = "truk";
            } else{
                var table = "excavator";
            }
            
            var id = "id";
            var data = ['nama'];
            var template = '$0$';
            var where = 'deleted_at is null';
            var response = change_option(table, id, data, template, where);

            $("#peralatan").html(response);
        });

        function change_option(table, id, data, template, where){
            var response = '';
            $.ajax({
                type: "post",
                async: false,
                url: "{{ route('Owner Select Option') }}",
                data: {
                    table: table,
                    id: id,
                    data: data,
                    template: template,
                    where: where,
                    "_token": "{{ csrf_token() }}",                    
                },
                cache: false,
                success: function (data) {
                    response = data
                }
            });
            return response;
        }
    });
</script>