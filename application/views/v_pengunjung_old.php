
<style>
body{
    font-size:30px;
    color:black;
}
</style>
<div class="container">
    <div class="row text-center">
        <div class="col-md-12">
            <img width="600px" src="<?php echo base_url();?>assets/logo.jpg" alt="logo">
        </div>
    </div>
    <div class="row text-center" style="color:#2C4E95;">
        <div class="col-md-12">
            <h5><b>Selamat Datang di <?php echo $this->config->item('company');?>.</b><br> Silahkan tekan tombol dibawah ini untuk mendapatkan nomor antrian.</h5> 
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12" style="margin-top:10px;">
            <button id="btn_antrian" onclick="ajaxAmbilAntrian()" class="btn btn-success btn-lg bg-color" style="border-radius:50px;padding:10px 40px 10px 40px;font-weight:bold;">Ambil Antrian</button>
        </div>
       
    </div>
</div>

<div id="printableArea" style="padding-left:100px;font-family: 'Times New Roman';">
      Print me asdasd 1234567890<br> 1234567890
</div>

<input type="button" onclick="printDiv('printableArea')" value="print a div!" />


<script>

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

function ajaxAmbilAntrian(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_ambil_antrian',
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
                
                
            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    html: json['data']
                })
            }
        },
        error: function() {
            $('#btn_antrian').LoadingOverlay("hide");
            swal({
                    type: 'error',
                    title: 'Oops...',
                    html: 'Error occured. Please try again or contact administrator'
                })	
            
        }
    });
}
</script>
