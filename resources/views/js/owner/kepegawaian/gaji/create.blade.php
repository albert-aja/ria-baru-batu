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
                    url: "{{ route('Owner Kepegawaian Gaji Store') }}",
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
                                document.location.href = "{{ route('Owner Kepegawaian Gaji') }}";
                            })
                        } else {
                            swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                        }
                    }
                });
            }
        }));

        $(document).on('change', '.main_trigger', function () {
            var pegawai = $('#pegawai').val();
            var periode = $('#periode').val();
            get_data(pegawai, periode);
        });

        $('#periode').on('dp.change', function (e) {
            var pegawai = $('#pegawai').val();
            var periode = $('#periode').val();
            get_data(pegawai, periode);
        });

        function get_data(pegawai, periode){
            if(pegawai != '' && periode != ''){
                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    async: false,
                    url: "{{ route('Owner Kepegawaian Gaji Req') }}",
                    data: {
                        req: 'Pinjaman',
                        pegawai: pegawai,
                        "_token": "{{ csrf_token() }}",
                    },
                    cache: false,
                    success: function (data) {
                        $("#pinjaman").val(data.utang);
                    }
                });

                $.ajax({
                    type: "post",
                    dataType: 'JSON',
                    async: false,
                    url: "{{ route('Owner Kepegawaian Gaji Req') }}",
                    data: {
                        req: 'Pekerjaan',
                        pegawai: pegawai,
                        periode: periode,
                        "_token": "{{ csrf_token() }}",
                    },
                    cache: false,
                    success: function (data) {
                        $("#pekerjaan").html(data.form);
                    }
                });
            }

            setTimeout(() => {  
                var total = 0;
                var minus = 0;
        
                $('.plus_operation').each(function(){
                    total += parseFloat($(this).val());
                });

                $('.minus_operation').each(function(){
                    minus += parseFloat($(this).val());
                });

                $('#total_gaji').val(total);
                $('#diterima').val(total - minus);
            }, 3000);
        }

        $(document).on('change', '.times_operation', function () {
            var kuantitas_pekerjaan = $(this).parent().parent().siblings('#pekerjaan_container').children().children('.times_operation').val();
            var harga_per_pekerjaan = $(this).val();
            var hasil = harga_per_pekerjaan * kuantitas_pekerjaan;
            $(this).parent().parent().siblings('#subtotal').val(hasil);
            var total = 0;
            var minus = 0;
    
            $('.plus_operation').each(function(){
                total += parseFloat($(this).val());
            });

            $('.minus_operation').each(function(){
                minus += parseFloat($(this).val());
            });

            $('#total_gaji').val(total);
            $('#diterima').val(total - minus);
        });
    });
</script>