<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
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
                <table class="table table-bordered table-condensed" id="table_loket">
                   
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <b>Panggil ke Ruang Tes</b>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-condensed" id="table_tes">
                   
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<div id="snackbar"></div>


<!-- <script src="https://code.responsivevoice.org/responsivevoice.js?key=fgAqPdhm"></script> -->
<script src="<?php echo base_url('assets/howler');?>/howler.min.js"></script>

<script>
function showToast(textString) {
    $(document).Toasts('create', {
        class: 'bg-success', 
        title: 'Notification',
        autohide: true,
        delay: 3000,
        body: "Copied Text: "+textString
      })
} 

    function copyToClipboard(copyText) {
        var textarea = document.createElement("textarea");
        textarea.textContent = copyText;
        textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy"); 

        document.body.removeChild(textarea)
        /* Alert the copied text */
        showToast(copyText);
        console.log(copyText);
        // alert("Copied the text: " + copyText);
    } 

    function panggilAntrianLoket(nomor_antrian,loket){
        var tingtung = new Howl({
            src: [
                '<?php echo base_url();?>assets/sound/tingtung.mp3',
            ]
        });

        var sound1 = new Howl({
            src: [
                '<?php echo base_url();?>assets/sound/loket/'+loket+'/'+nomor_antrian+'.mp3',
            ]
        });
        
        tingtung.play();
        setTimeout(function () {
            sound1.play();
        }, 1500);
    }
    function panggilAntrianTes(nomor_antrian,loket){
        var tingtung = new Howl({
            src: [
                '<?php echo base_url();?>assets/sound/tingtung.mp3',
            ]
        });

        var sound1 = new Howl({
            src: [
                '<?php echo base_url();?>assets/sound/periksa/'+loket+'/'+nomor_antrian+'.mp3',
            ]
        });

        tingtung.play();
        setTimeout(function () {
            sound1.play();
        }, 1500);
    }
</script>

<script>
$(function () {
	setInterval( function () {
        _init();
    }, 1500); // refresh setiap 5000 milliseconds

})

function _init(){
    ajaxGetAntrianLoket();
    ajaxGetAntrianTes();
    ajaxGetJumlahAntrian();
}

function ajaxGetJumlahAntrian(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_get_jumlah_antrian',
        type: 'GET',
        data: {},
        success: function(json) {
           $('#jumlah_antrian').text(json.jumlah_antrian);
           $('#sisa_antrian').text(json.sisa_antrian);
        },
        error: function() {
            // swal({
            //         type: 'error',
            //         title: 'Oops...',
            //         html: 'Error occured. Please try again or contact administrator'
            //     })	
            
        }
    });
}


function ajaxPanggilAntrianLoket(id,loket,nomor_antrian){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_panggil_antrian_loket?id='+id+'&&loket='+loket,
        type: 'GET',
        data: {},
        success: function(json) {
            if(json['status']=='success'){
                panggilAntrianLoket(nomor_antrian,loket);
            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    html: json['data']
                })
            }
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


function ajaxCancel(id){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_cancel?id='+id,
        type: 'GET',
        data: {},
        success: function(json) {
            if(json['status']=='success'){
                _init();
            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    html: json['data']
                })
            }
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

function ajaxSelesaiLoket(id){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_selesai_loket?id='+id,
        type: 'GET',
        data: {},
        success: function(json) {
            if(json['status']=='success'){
                _init();
            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    html: json['data']
                })
            }
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

function ajaxPanggilAntrianTes(id,loket,nomor_antrian){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_panggil_antrian_tes?id='+id+'&&loket='+loket,
        type: 'GET',
        data: {},
        success: function(json) {
            if(json['status']=='success'){
                panggilAntrianTes(nomor_antrian,loket);
            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    html: json['data']
                })
            }
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


function ajaxSelesaiTes(id){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_selesai_tes?id='+id,
        type: 'GET',
        data: {},
        success: function(json) {
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
           var html=` <tr>
                        <th class="text-center">Antrian</th>
                        <th class="text-center">Loket</th>
                        <th class="text-left">No Booking</th>
                        <th class="text-left">Panggil</th>
                    </tr>`;
           for (let i = 0; i < json.antrian.length; i++) {
                const el = json.antrian[i];
                var btnSlesai=``;
                if(el.is_panggil_loket=='1'){
                    btnSlesai=`<button onclick="ajaxSelesaiLoket('${el.id}')" class="btn btn-info btn-sm">Selesai</button>`;
                }
                var btnLoket=``;
                for (let j = 0; j < json.jumlah_loket; j++) {
                    const el2 = json.jumlah_loket[j];
                    
                    var no_loket=j+1;
                    btnLoket+=`<button onclick="ajaxPanggilAntrianLoket('${el.id}','${no_loket}',${el.no_antrian})" class="btn btn-primary btn-sm" style="margin-right:5px;">${no_loket}</button>`;
                    
                }
                html+=`<tr>
                    <td class="text-center">${el.no_antrian}</td>
                    <td class="text-center">${(el.loket)?el.loket:""}</td>
                    <td class="text-center"><span>${(el.no_booking)?el.no_booking:""}</span><button style="margin-left:5px;" class="btn btn-xs btn-default" onclick="copyToClipboard('${(el.no_booking)?el.no_booking:""}')">c</button></td>
                    <td class="text-left">
                        ${btnLoket}
                        <button onclick="ajaxCancel('${el.id}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        ${btnSlesai}
                        
                    </td>
                <tr>`;
           }
           $('#table_loket').html(html)
        },
        error: function() {
            // swal({
            //         type: 'error',
            //         title: 'Oops...',
            //         html: 'Error occured. Please try again or contact administrator'
            //     })	
            
        }
    });
}

function ajaxGetAntrianTes(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_get_antrian_tes',
        type: 'GET',
        data: {},
        success: function(json) {
           var html=` <tr>
                        <th class="text-center">Antrian</th>
                        <th class="text-center">Ruang Tes</th>
                        <th class="text-left">Panggil</th>
                    </tr>`;
           for (let i = 0; i < json.antrian.length; i++) {
                const el = json.antrian[i];
                var btnSlesai=``;
                if(el.is_panggil_ruangan=='1'){
                    btnSlesai=`<button onclick="ajaxSelesaiTes('${el.id}')" class="btn btn-success btn-sm">Selesai</button>`;
                }
                var btnLoket=``;
                for (let j = 0; j < json.jumlah_loket; j++) {
                    const el2 = json.jumlah_loket[j];
                    
                    var no_loket=j+1;
                    btnLoket+=`<button onclick="ajaxPanggilAntrianTes('${el.id}','${no_loket}',${el.no_antrian})" class="btn btn-warning btn-sm" style="margin-right:5px;">${no_loket}</button>`;
                    
                }
                html+=`<tr>
                    <td class="text-center">${el.no_antrian}</td>
                    <td class="text-center">${(el.ruangan)?el.ruangan:""}</td>
                    <td class="text-left">
                        ${btnLoket}
                        ${btnSlesai}
                        
                    </td>
                <tr>`;
           }
           $('#table_tes').html(html)
        },
        error: function() {
            // swal({
            //         type: 'error',
            //         title: 'Oops...',
            //         html: 'Error occured. Please try again or contact administrator'
            //     })	
            
        }
    });
}



</script>
