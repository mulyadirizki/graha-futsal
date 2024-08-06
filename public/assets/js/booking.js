let url = document.URL;
const myArray = url.split('/');
url = myArray[0] + "//" + myArray[2];

let allTimes = [];
for (let hour = 0; hour < 24; hour++) {
    let time = (`0${hour}`).slice(-2) + ':00';
    allTimes.push(time);
}

$(document).ready(function () {
    populateTimeOptions();
});

$('#datepicker').datepicker().on('changeDate', function (e) {
    let mydate = convert(e.date);
    check_schedule(mydate);
});

function convert(str) {
    var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
}

function check_schedule(date) {
    $.ajax({
        type: "POST",
        url: url + "/api/check-schedule",
        data: { tgl_booking: date },
        dataType: "JSON",
        success: function (response) {
            if (response.status == 'success') {
                $.each(response.schedule, function (index, value) {
                    let start = [];
                    let finish = [];
                    let time = value.time;
                    $.each(time.mulai, function (index, value) {
                        start.push(`<option value="${value}">${value.substring(0, 5)}</option>`);
                    });
                    $.each(time.selesai, function (index, value) {
                        finish.push(`<option value="${value}">${value.substring(0, 5)}</option>`);
                    });
                    $("#jam_mulai_" + value.id_lapangan).html(`<option disabled selected>Jam Mulai</option>${start}`);
                    $("#jam_berakhir_" + value.id_lapangan).html(`<option disabled selected>Jam Berakhir</option>${finish}`);
                });
            }
        },
        error: function () {
            console.warn('something wrong');
        }
    });
}

function populateTimeOptions() {
    let startOptions = '';
    let endOptions = '';

    allTimes.forEach(time => {
        startOptions += `<option value="${time}">${time}</option>`;
        endOptions += `<option value="${time}">${time}</option>`;
    });

    $('select[name=jam_mulai]').html(startOptions);
    $('select[name=jam_berakhir]').html(endOptions);
}

function updateEndTimeOptions(startTime) {
    let validEndTimes = allTimes.filter(time => time > startTime);
    let endOptions = validEndTimes.map(time => `<option value="${time}">${time}</option>`).join('');
    
    $(`select[name=jam_berakhir]`).html(`<option disabled selected>Jam Berakhir</option>${endOptions}`);
}

function validateBookingDuration(start, end) {
    let [hour_start, min_start] = start.split(':').map(Number);
    let [hour_end, min_end] = end.split(':').map(Number);

    let startDate = new Date(0, 0, 0, hour_start, min_start);
    let endDate = new Date(0, 0, 0, hour_end, min_end);
    let duration = (endDate - startDate) / 3600000; // Durasi dalam jam

    return duration <= 2;
}

$('select[name=jam_mulai]').on('change', function() {
    let startTime = $(this).val();
    updateEndTimeOptions(startTime);
});

function addbooking(id_lapangan) {
    var date = $('#datepicker').datepicker('getDate'),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);

    let id_tuser = $('#id_tuser').val();
    let idLapangan = id_lapangan;
    var tgl_booking = [date.getFullYear(), mnth, day].join("-");
    let jam_mulai = $(`#jam_mulai_${id_lapangan}`).val();
    let jam_berakhir = $(`#jam_berakhir_${id_lapangan}`).val();

    if (!jam_mulai || !jam_berakhir) {
        Swal.fire(
            'Gagal!',
            'Mohon pilih jam mulai dan jam berakhir.',
            'error'
        );
        return;
    }

    if (!validateBookingDuration(jam_mulai, jam_berakhir)) {
        Swal.fire(
            'Gagal!',
            'Durasi pemesanan tidak bisa lebih dari 2 jam.',
            'error'
        );
        return;
    }

    $.ajax({
        url: url + "/api/booking/create",
        type: "POST",
        data: {
            id_tuser: id_tuser,
            id_lapangan: idLapangan,
            tgl_booking: tgl_booking,
            jam_mulai: jam_mulai,
            jam_berakhir: jam_berakhir
        },
        dataType: 'JSON',
        success: function (data) {
            if (data.success) {
                Swal.fire(
                    'Berhasil!',
                    'Booking berhasil.',
                    'success'
                ).then(() => {
                    window.location.href = "/id/u/pemain/pembayaran";
                });
            } else {
                Swal.fire(
                    'Gagal!',
                    'Terjadi kesalahan, coba lagi.',
                    'error'
                );
            }
        },
        error: function (err) {
            console.log(err.responseJSON.message);
            Swal.fire(
                'Gagal!',
                err.responseJSON.message,
                'error'
            );
        }
    });
}
