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
                    url: "{{ route('Supir Muatan Update', $data) }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Muatan berhasil diubah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Supir Muatan Show', $data) }}";
                            })
                        } else {
                            swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                        }
                    }
                });
            }
        }));

        $(document).on('change', '#bongkar_muat', function () {
            var bongkar_muat = $(this).val();
            
            if(bongkar_muat == 'Ya'){
                $('#cotainer_supir').removeAttr('style');
            } else{
                $('#cotainer_supir').css('display', 'none');
            }
        });
    });
</script>