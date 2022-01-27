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

            var tgl = $("#tgl").val();            
            
            if (!tgl) {
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
                    url: "{{ route('Admin Penjualan Customer Update', $data) }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Penjualan customer berhasil diubah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Admin Penjualan Customer Show', $data) }}";
                            })
                        } else {
                            swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                        }
                    }
                });
            }
        }));
    });
</script>