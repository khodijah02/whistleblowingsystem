$(function() {
    $(document).ready(function () {
        $('#add_complaint').submit(function (e) {
            e.preventDefault();
            var data = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "http://192.168.0.3/wbs/complaint/store",
                data: data,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function (response) {
                    $('#complaint_submit_button').attr('disabled', 'disabled');
                },
                success: function (response) {
                    if (response.code == 400) {
                        $('#add_complaint_error_message').html('');
                        $('#add_complaint_error_message').addClass('alert-error');
                        $('#add_complaint_error_message').addClass('mt-3');
                        $.each(response.message, function (key, value) {
                            $('#add_complaint_error_message').append('<span><i class="bi bi-x"></i> '+value+'</span><br>');
                        });
                        $('html, body').animate({
                            scrollTop: $("#main").offset().top
                        }, 50);
                    } else {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Terimakasih Telah Melakukan Laporan',
                            icon: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            Swal.fire({
                                title: 'Simpan Nomor Pengaduan Anda',
                                text: response.ticket,
                                icon: 'info',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                            }).then((result) => {
                                location.reload()
                            })
                        });
                    }
                    $('#complaint_submit_button').removeAttr('disabled', 'disabled');
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Ooops',
                        text: 'Ada Kesalahan, Silahkan hubungi Pihak RSUD Kota Bogor',
                        icon: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then((result) => {
                        location.reload()
                    });

                }
            });
        });

        $('#search_complaint').submit(function (e) {
            e.preventDefault();
            var complaint = $('#complaint_ticket').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: "http://192.168.0.3/wbs/complaint/search/show",
                data: {complaint:complaint},
                dataType: "json",
                beforeSend: function (response) {
                    $('#search_complaint_button').attr('disabled', 'disabled');
                },
                success: function (response) {
                    $('#search_result').html('');
                    $('#search_result').html(response.complaint);
                    $('#search_complaint_button').removeAttr('disabled');
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Ooops',
                        text: 'Ada Kesalahan, Silahkan hubungi Pihak RSUD Kota Bogor',
                        icon: 'error',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    }).then((result) => {
                        location.reload()
                    });

                }
            });
        });

        $('#province').on('change', function () {
            var data = this.value;
            $.ajax({
                type: "get",
                url: "http://192.168.0.3/wbs/get-regency",
                data: {data:data},
                dataType: "json",
                success: function (response) {
                    $('#regency').html('<option value="">-- Pilih Kabupaten --</option>');
                    $.each(response, function (key, value) {
                        $('#regency').append('<option value="'+value.ID+'">'+value.NAMA+'</option>');
                    });
                }
            });
        });

        $('#regency').on('change', function () {
            var data = this.value;
            $.ajax({
                type: "get",
                url: "http://192.168.0.3/wbs/get-district",
                data: {data:data},
                dataType: "json",
                success: function (response) {
                    $('#district').html('<option value="">-- Pilih Kecamatan --</option>');
                    $.each(response, function (key, value) {
                        $('#district').append('<option value="'+value.ID+'">'+value.NAMA+'</option>');
                    });
                }
            });
        });

        $('#district').on('change', function () {
            var data = this.value;
            $.ajax({
                type: "get",
                url: "http://192.168.0.3/wbs/get-village",
                data: {data:data},
                dataType: "json",
                success: function (response) {
                    $('#village').html('<option value="">-- Pilih Kelurahan --</option>');
                    $.each(response, function (key, value) {
                        $('#village').append('<option value="'+value.ID+'">'+value.NAMA+'</option>');
                    });
                }
            });
        });
    });
});
