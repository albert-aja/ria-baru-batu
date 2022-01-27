<script>
    $(document).ready(function () {
        $(".select2").select2();

        $('#periode').datetimepicker({
            locale: 'id',
            format: 'YYYY-MM',
            ignoreReadonly: true
        });
        
        $('#Form').on('submit', (function (e) {
            e.preventDefault();

            var pegawai = $("#pegawai").val();            
            
            if (!pegawai) {
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
                    url: "{{ route('Operator Excavator Kepegawaian Gaji Store') }}",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == 'Valid') {
                            swal({
                                title: 'Berhasil',
                                text: "Gaji berhasil ditambah.",
                                icon: 'success',
                                button: "Lanjutkan"
                            }).then(function () {
                                document.location.href = "{{ route('Operator Excavator Kepegawaian Gaji') }}";
                            })
                        } else {
                            swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                        }
                    }
                });
            }
        }));

        $(document).on('change', '#pegawai', function () {
            var pegawai = $('#pegawai').val();
            var periode = $('#periode').val();
            
            $.ajax({
                type: "post",
                dataType: 'JSON',
                async: false,
                url: "{{ route('Operator Excavator Kepegawaian Gaji Req') }}",
                data: {
                    req: 'Detail Pegawai',
                    pegawai: pegawai,
                    periode: periode,
                    "_token": "{{ csrf_token() }}",                    
                },
                cache: false,
                success: function (data) {
                    if(data.role == 'Operator Excavator'){
                        $("#muatan_operator_excavator").val(data.muatan);
                    }
                    
                    $("#pinjaman").val(data.utang);
                    $("#role").val(data.role);
                }
            });
        });

        $(document).on('change', '#pegawai', function () {
            var pegawai = $('#pegawai').val();
            var periode = $('#periode').val();
            
            $.ajax({
                type: "post",
                dataType: 'JSON',
                async: false,
                url: "{{ route('Operator Excavator Kepegawaian Gaji Req') }}",
                data: {
                    req: 'Detail Pegawai',
                    pegawai: pegawai,
                    periode: periode,
                    "_token": "{{ csrf_token() }}",                    
                },
                cache: false,
                success: function (data) {
                    if(data.role == 'Operator Excavator'){
                        $("#muatan_operator_excavator").val(data.muatan);
                    }
                    
                    $("#pinjaman").val(data.utang);
                    $("#role").val(data.role);
                }
            });
        });
    });
</script>