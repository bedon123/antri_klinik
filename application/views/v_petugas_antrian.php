<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Jumlah Antrian</span>
                <span class="info-box-number" id="jumlah_antrian">
                    -
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Antrian Sekarang</span>
                <span class="info-box-number" id="antrian_sekarang">
                    -
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Antrian Selanjutnya</span>
                <span class="info-box-number" id="antrian_selanjutnya">
                    -
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sisa Antrian</span>
                <span class="info-box-number" id="sisa_antrian">
                    -
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <b>Panggil ke Loket</b>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table>
                    <tr>
                        <td>Nomor Antrian</td>
                        <td><input readonly id="no_antrian_loket" type="text" class="form-control form-control-sm text-center" value="1" style="width:50px;background-color:white;margin-left:3px;margin-right:3px;font-weight:bold;"></td>
                        <td width="20px">ke</td>
                        <td>
                        <?php echo 
                        form_dropdown('loket', $this->M_cmb->getLoketPangil(1), '','class="form-control form-control-sm" id="loket"');
                        ?>
                        </td>
                        <td><button class="btn btn-success" onclick="panggilAntrianLoket()">Panggil</button></td>
                    </tr>
                </table>
                <table class="table table-bordered table-condensed" id="table_loket">
                   
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <b>Panggil ke Ruang Periksa</b>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table>
                    <tr>
                        <td>Nomor Antrian</td>
                        <td><input readonly id="no_antrian_ruang" type="text" class="form-control form-control-sm text-center" value="1" style="width:50px;background-color:white;margin-left:3px;margin-right:3px;font-weight:bold;"></td>
                        <td width="20px">ke</td>
                        <td>
                        <?php echo 
                        form_dropdown('ruang', $this->M_cmb->getLoketPangil(2), '','class="form-control form-control-sm" id="ruang"');
                        ?>
                        </td>
                        <td><button class="btn btn-success" onclick="panggilAntrianRuang()">Panggil</button></td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=fgAqPdhm"></script>
<script>
    function panggilAntrianLoket(loket){
        var nomor_antrian=$('#no_antrian_loket').val();
        // var loket=$('#loket').val();
        responsiveVoice.speak(` Nomor Antrian, ${nomor_antrian}, ke loket ${loket}`,"Indonesian Female",{rate: 0.8, pitch: 1, volume: 1});
    }
    function panggilAntrianRuang(){
        var nomor_antrian=$('#no_antrian_ruang').val();
        var loket=$('#ruang').val();
        responsiveVoice.speak(` Nomor Antrian, ${nomor_antrian}, ke ruang periksa ${loket}`,"Indonesian Female",{rate: 0.8, pitch: 1, volume: 1});
    }
</script>

<script>
$(function () {
	// ajaxAmbilAntrian();
    setInterval( function () {
        // ajaxAmbilAntrian();
        ajaxGetAntrianLoket();
    }, 1000); // refresh setiap 5000 milliseconds

})

function ajaxGetJumlahAntrian(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_get_jumlah_antrian',
        type: 'GET',
        data: {},
        success: function(json) {
        //    console.log(json);
           $('#jumlah_antrian').text(json.jumlah_antrian);
           $('#sisa_antrian').text(json.sisa_antrian);
           $('#antrian_sekarang').text(json.antrian_sekarang);
           $('#antrian_selanjutnya').text(json.antrian_selanjutnya);
        },
        error: function() {
            swal({
                    type: 'error',
                    title: 'Oops...',
                    html: 'Error occured. Please try again or contact administrator'
                })	
            
        }
    });
}

function ajaxGetAntrianLoket(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_get_antrian_loket',
        type: 'GET',
        data: {},
        success: function(json) {
           console.log(json);
           var html=` <tr>
                        <th class="text-center">Nomor Antrian</th>
                        <th class="text-center">Loket</th>
                        <th class="text-center">Panggil</th>
                    </tr>`;
           for (let i = 0; i < json.length; i++) {
                const el = json[i];
                html+=`<tr>
                    <td class="text-center">${el.no_antrian}</td>
                    <td class="text-center">${(el.loket)?el.loket:""}</td>
                    <td class="text-center">
                        <button  onclick="panggilAntrianLoket('1')" class="btn btn-primary btn-sm" style="margin-right:5px;">1</button>
                        <button  onclick="panggilAntrianLoket('2')" class="btn btn-success btn-sm">2</button>
                    </td>
                <tr>`;
           }
           $('#table_loket').html(html)
        },
        error: function() {
            swal({
                    type: 'error',
                    title: 'Oops...',
                    html: 'Error occured. Please try again or contact administrator'
                })	
            
        }
    });
}

</script>
