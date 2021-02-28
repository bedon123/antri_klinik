<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<title>Pengunjung</title>
 
<style rel="stylesheet">
	body {
        color:black;
        font-size: 24px;
    }
    #hidden_div{display: none;}
</style>
 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


  <!-- Sweet Alert css -->
  <link href="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/theme_admin/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Loading Overlay Js  -->
    <script src="<?php echo base_url();?>assets/loading_overlay/loadingoverlay.js"></script>

    <!-- Sweet Alert Js  -->
    <script src="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.js"></script>

    <script src="<?php echo base_url();?>assets/printThis.js"></script>

</head>
<body>
<center>
    <div>
        <img width="500px" src="<?php echo base_url();?>assets/logo.jpg" alt="logo">
    </div>
    <div>
           <b> Selamat Datang di <?php echo $this->config->item('company');?>.</b>
    </div>
    <div style="margin-top:10px;">
           Silahkan Masukkan Nomor Booking Anda untuk mendapatkan nomor antrian.
    </div>
    <br>
    <form id="form1">
        <div>
            <input type="text" name="no_booking" id"no_booking" value="" style="width:220px;font-size:20px;padding:5px 10px 5px 10px;border-radius:20px;margin-bottom:10px;">
        </div>
        <div>
            <button id="btn_antrian" type="submit" style="border-radius:50px;padding:5px 40px 5px 40px;font-weight:bold;border:1px solid green;background-color:green;color:white;font-size:20px;">Ambil Antrian</button>
        </div>
    </form>
    <div style="left:10px;bottom:10px;position:fixed;">
    <a href="javascript:void(0)" onclick="printTiketBypass()">Print</a>
    </div>
</center>

<div id='DivIdToPrint'>
    <div id="hidden_div" style="font-size: 24px;color:black;">
        <table>
            <tr>
                <td align="center"><?php echo $this->config->item('company');?></td>
            </tr>
            <tr>
                <td align="center" style="font-size: 18px;padding-left:30px;padding-right:30px;"><?php echo $this->config->item('address');?></td>
            </tr>
            <tr>
                <td align="center" style="border-bottom:1px solid black;"></td>
            </tr>
            <tr>
                <td align="center">Nomor Antrian</td>
            </tr>
            <tr>
                <td align="center" style="font-size:60px;"><span id="nomor_antrian">0</span></td>
            </tr>
            <tr>
                <td align="center"><span id="no_booking_tiket"></span></td>
            </tr>
            <tr>
                <td align="center"><span id="tiket_layanan"></span></td>
            </tr>
            
            <tr>
                <td align="center" style="font-size:18px;"><?php echo date('d-M-Y H:i');?></td>
            </tr>
      </table>
    </div>
</div>

<!-- <button onclick="printDiv2()">prin div</button> -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
     
      <div class="modal-body">
        <table class="table table-condensed">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?php echo date('d/m/Y H:i')?></td>
            </tr>
            <tr>
                <td width="100px">No Booking</td>
                <td width="5px">:</td>
                <td><div id="no_booking"></div></td>
            </tr>
            <tr>
                <td>Layanan</td>
                <td>:</td>
                <td><div id="nama_produk"></div></td>
            </tr>
        </table>

        <div id="list_pasien"></div>
      </div>
     
    </div>

  </div>
</div>


<script>


$(function () {
   
    $('input[name="no_booking"]').focus()
	$("#form1"). submit(function (event) { 
        event.preventDefault();
        getDataBooking();
    }); 

})

function printTiketBypass(){
    ajaxAmbilAntrian("0");
}

function printDiv2(no_booking) 
{
    if(no_booking=="0"){
        $('#DivIdToPrint').printThis();
    }else{
        setTimeout(function(){ $('#myModal').modal('hide'); }, 5000);
        $('#myModal').modal('show');
        $('#DivIdToPrint').printThis();
    }
}
function getDataBooking(){
    var no_booking=$('input[name="no_booking"]').val();
    $.ajax({
        url: 'https://klinikibuku.id/booking?no_booking='+no_booking.trim(),
        type: 'GET',
        data: {},   
        beforeSend: function() {
            $('#btn_antrian').LoadingOverlay("show");
        },
        complete: function() {
            $('#btn_antrian').LoadingOverlay("hide");
        },
        success: function(json) {
            $('#btn_antrian').LoadingOverlay("hide");
            $('input[name="no_booking"]').val('');
            $('input[name="no_booking"]').focus();
            if(json['status']=='success'){
               console.log(json.data)
               var res=json.data;
               $('#no_booking').html(res.no_booking);
               $('#tgl_tes').html(res.tgl_tes);
               $('#nama_produk').html(res.nama_produk);
               $('#tiket_layanan').text(res.nama_produk);
               $('#no_booking_tiket').text(res.no_booking);
               var html=`<table class="table table-bordered table-striped table-condensed">
               <tr>
                    <th width="30px;">No</th>
                    <th>Pasien</th>
               </tr>
               `;
               for (let i = 0; i < res.pasiens.length; i++) {
                   const el = res.pasiens[i];
                   html+=`<tr>
                        <td>1.</td>
                        <td>${el.nama}</td>
                   </tr>`;
               }
                html+=`</table>`
                $('#list_pasien').html(html);
                // $('input[name="no_booking"]').val('');
                // $('input[name="no_booking"]').focus();
                ajaxAmbilAntrian(no_booking);
                
            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    timer: 2000,
                    html: json['data']
                })
            }
        },
        error: function() {
            $('#btn_antrian').LoadingOverlay("hide");
            swal({
                    type: 'error',
                    title: 'Oops...',
                    timer: 2000,
                    html: 'Error occured. Please try again or contact administrator'
                })	
            
        }
    });
}
function ajaxAmbilAntrian(no_booking){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_ambil_antrian?no_booking='+no_booking,
        type: 'GET',
        data: {},
        beforeSend: function() {
            $('#btn_antrian').LoadingOverlay("show");
        },
        complete: function() {
            $('#btn_antrian').LoadingOverlay("hide");
        },
        success: function(json) {
            $('#btn_antrian').LoadingOverlay("hide");
            if(json['status']=='success'){
                $('#nomor_antrian').html(json.data);
                printDiv2(no_booking);
            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    timer: 2000,
                    html: json['data']
                })
            }
        },
        error: function() {
            $('#btn_antrian').LoadingOverlay("hide");
            swal({
                    type: 'error',
                    title: 'Oops...',
                    timer: 2000,
                    html: 'Error occured. Please try again or contact administrator'
                })	
            
        }
    });
}
</script>
</body>
</html>