<script>
    $(document).ready(function () {
        $(document).on('click', 'TombolHapus', function () {
            swal({
                title: "Konfirmasi?",
                text: $(this).attr('pertanyaan'),
                icon: "warning",
                buttons: {
                    cancel: "Tidak",
                    confirm: {
                        text: "Ya",
                        value: "Ya",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "Ya":
                        var nilai = $(this).attr("value");
                        var url = $(this).attr("url");
                        $.ajax({
                            type: "post",
                            dataType: 'JSON',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: nilai
                            },
                            cache: false,
                            success: function (data) {
                                if (data.status == 'Valid') {
                                    swal({
                                        title: 'Berhasil',
                                        text: data.text,
                                        icon: 'success',
                                        button: "Lanjutkan"
                                    }).then(function () {
                                        document.location.href = "{{ route('Operator Excavator Pinjaman') }}";
                                    })
                                } else {
                                    swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                                }
                            }
                        });
                        break;

                    default:
                }
            });
        });

        $(document).on('click', 'TombolLunaskan', function () {
            swal({
                title: "Konfirmasi?",
                text: 'Anda yakin ingin melunasi pinjaman ini?',
                icon: "warning",
                buttons: {
                    cancel: "Tidak",
                    confirm: {
                        text: "Ya",
                        value: "Ya",
                    },
                },
            })
            .then((value) => {
                switch (value) {
                    case "Ya":
                        var nilai = $(this).attr("value");
                        var req = "Pelunasan";
                        var url = "{{ route('Operator Excavator Pinjaman Req') }}";
                        $.ajax({
                            type: "post",
                            dataType: 'JSON',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: nilai,
                                req: req,
                            },
                            cache: false,
                            success: function (data) {
                                if (data.status == 'Valid') {
                                    swal({
                                        title: 'Berhasil',
                                        text: 'Berhasil melunasi pinjaman',
                                        icon: 'success',
                                        button: "Lanjutkan"
                                    }).then(function () {
                                        location.reload();
                                    })
                                } else {
                                    swal("Gagal", 'Terjadi kesalahan pada sistem.', "error");
                                }
                            }
                        });
                        break;

                    default:
                }
            });
        });
    });
</script>