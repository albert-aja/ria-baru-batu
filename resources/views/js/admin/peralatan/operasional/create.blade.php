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
                    url: "{{ route('Admin Peralatan Operasional Store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Operasional berhasil ditambah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Admin Peralatan Operasional') }}";
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
            
            $.ajax({
                type: "post",
                async: false,
                url: "{{ route('Admin Peralatan Operasional Req') }}",
                data: {
                    req: 'Option Unit',
                    jenis: jenis,
                    "_token": "{{ csrf_token() }}",                    
                },
                cache: false,
                success: function (data) {
                    $("#peralatan").html(data);
                }
            });
        });

        function change_option(table, id, data, template, where){
            var response = '';
            $.ajax({
                type: "post",
                async: false,
                url: "{{ route('Admin Select Option') }}",
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