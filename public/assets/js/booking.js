let url=document.URL;
const myArray=url.split('/');
url=myArray[0]+"//"+myArray[2];
$(document).ready(function () {
    check_schedule();
});
$("#id_lapangan").change(function (e) { 
    check_schedule();
});
$("#tgl_booking").change(function (e) { 
    check_schedule();
});
function check_schedule() { 
    let id_lapangan=$("#id_lapangan").children("option:selected").val();
    let tgl_booking=$("#tgl_booking").val();
    $.ajax({
        type: "POST",
        url: url+"/api/check-schedule",
        data: {id_lapangan:id_lapangan,tgl_booking:tgl_booking},
        dataType: "JSON",
        success: function (response) {
            if (response.status=='success') {
                let start=[];
                let finish=[];
                let time=response.time;
                $.each(time.mulai, function (index, value) { 
                    start+=`<option value="${value}">${value.substring(0,5)}</option>`;
                });
                $.each(time.selesai, function (index, value) { 
                    finish+=`<option value="${value}">${value.substring(0,5)}</option>`;
                });
                 $("#jam_mulai").html(`<option disabled selected>Jam Mulai</option>${start}`);
                 $("#jam_berakhir").html(`<option disabled selected>Jam Berakhir</option>${finish}`);
            }
        },error:function(){
            console.warn('something wrong');
        }
    });
 }