let url=document.URL;
const myArray=url.split('/');
url=myArray[0]+"//"+myArray[2];
$(document).ready(function () {
});

$('#datepicker').datepicker().on('changeDate', function (e) {
    let mydate=convert(e.date);
    check_schedule(mydate);
});

function convert(str) {
    var date = new Date(str),
      mnth = ("0" + (date.getMonth() + 1)).slice(-2),
      day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
  }
// $("#id_lapangan").change(function (e) { 
//     check_schedule();
// });
// $("#tgl_booking").change(function (e) { 
//     check_schedule();
// });
function check_schedule(date) { 
    $.ajax({
        type: "POST",
        url: url+"/api/check-schedule",
        data: {tgl_booking:date},
        dataType: "JSON",
        success: function (response) {
            if (response.status=='success') {
                $.each(response.schedule, function (index, value) { 
                    let start=[];
                    let finish=[];
                    let time=value.time;
                    $.each(time.mulai, function (index, value) { 
                        start+=`<option value="${value}">${value.substring(0,5)}</option>`;
                    });
                    $.each(time.selesai, function (index, value) { 
                        finish+=`<option value="${value}">${value.substring(0,5)}</option>`;
                    });
                     $("#jam_mulai_"+value.id_lapangan).html(`<option disabled selected>Jam Mulai</option>${start}`);
                     $("#jam_berakhir_"+value.id_lapangan).html(`<option disabled selected>Jam Berakhir</option>${finish}`);
                });

            }
        },error:function(){
            console.warn('something wrong');
        }
    });
}

function addbooking(id_lapangan) {
    var date = $('#datepicker').datepicker('getDate'),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
    
    let id_tuser = $('#id_tuser').val();
    let idLapangan = id_lapangan;
    var tgl_booking = [date.getFullYear(), mnth, day].join("-");
    let jam_mulai = $('select[name=jam_mulai] option').filter(':selected').val();
    let jam_berakhir = $('select[name=jam_berakhir] option').filter(':selected').val();

    $.ajax({
        url: url+"/api/booking/create",
        type: "POST",
        data: {
            id_tuser: id_tuser,
            id_lapangan: idLapangan,
            tgl_booking: tgl_booking,
            jam_mulai: jam_mulai,
            jam_berakhir: jam_berakhir
        },
        dataType: 'JSON',
        success:function(hasil) {
            Swal.fire({
                icon: 'success',
                title: 'Booking Lapangan Berhasil, Silahkan lakukan pembayaran',
                timer: 1500
            });

            window.location.replace('{{route("pemainPembayaranBooking"}}');
        }
    });
}