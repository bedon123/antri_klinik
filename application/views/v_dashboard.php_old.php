<div class="bg-color">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4" style="padding:10px;">
                <div style="padding:10px;background-color:white; width:120px;border-radius:20px;">
                    <img width="100px;" src="<?php echo base_url();?>assets/logo.jpg" alt="logo">
                </div>
               
            </div>
            <div class="col-md-5">
            </div>
            <div class="col-md-3 text-white">
                <div style="font-size:30px;">
                    <span id="jam"></span> : <span id="menit"></span> : <span id="detik"></span>
                </div>
                <div style="font-size:20px;margin-bottom:10px;">
                    <?php $hariIni = new DateTime();
                    echo strftime('%A, %d %B %Y', $hariIni->getTimestamp());?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="margin-top:10px;">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card bg-success">
                <div style="font-size:40px;margin-top:20px;">Antrian</div>
                <div style="font-size:80px;"><span id="current_no_antrian">-</span></div>
                <div style="font-size:30px;border-top:1px solid white;padding-bottom:10px;">Menuju <span id="current_loket">-</span></div>
            </div>
            <div class="row" id="div_loket">
                <?php foreach($loket as $r_loket){?>
                <div class="col-md-6">
                    <div class="card bg-primary">
                        <div style="font-size:20px;">Antrian</div>
                        <div style="font-size:40px;height:70px"><?php echo ($r_loket['current_antrian'])?$r_loket['current_antrian']:'-';?></div>
                        <div style="font-size:20px;border-top:1px solid white;padding-bottom:5px;"> <?php echo $r_loket['nama'].' '.$r_loket['nomor'];?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row" id="div_ruangan">
            <?php foreach($ruangan as $r_ruangan){?>
                <div class="col-md-4">
                    <div class="card bg-info">
                        <div style="font-size:20px;">Antrian</div>
                        <div style="font-size:40px;height:70px"><?php echo ($r_ruangan['current_antrian'])?$r_ruangan['current_antrian']:'-';?></div>
                        <div style="font-size:20px;border-top:1px solid black;padding-bottom:5px;"><?php echo $r_ruangan['nama'].' '.$r_ruangan['nomor'];?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            
        </div>
    </div>
    

</div>

<script>
$(function () {
    window.setTimeout("waktu()", 1000);
    setInterval( function () {
        ajaxGetAntrian();
    }, 1000); // refresh setiap 5000 milliseconds

})

 
function waktu() {
    var waktu = new Date();
    var displayHour="";
    if (waktu.getHours() < 10) displayHour += '0' + waktu.getHours();
    else displayHour +=  waktu.getHours();

    var displayMinute="";
    if (waktu.getMinutes() < 10) displayMinute += '0' + waktu.getMinutes();
    else displayMinute +=  waktu.getMinutes();

    var displaySecond="";
    if (waktu.getSeconds() < 10) displaySecond += '0' + waktu.getSeconds();
    else displaySecond +=  waktu.getSeconds();

    setTimeout("waktu()", 1000);
    document.getElementById("jam").innerHTML = displayHour;
    document.getElementById("menit").innerHTML = displayMinute;
    document.getElementById("detik").innerHTML = displaySecond;
}


function ajaxGetAntrian(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_get_antrian',
        type: 'GET',
        data: {},
        success: function(json) {
            $('#div_loket').html('');
            var html1='';
            for (let i = 0; i < json.loket.length; i++) {
                const el = json.loket[i];
                html1+=`
                <div class="col-md-6">
                    <div class="card bg-primary">
                        <div style="font-size:20px;">Antrian</div>
                        <div style="font-size:40px;height:70px">${(el.current_antrian)?el.current_antrian:'-'}</div>
                        <div style="font-size:20px;border-top:1px solid white;padding-bottom:5px;">${el.nama} ${el.nomor}</div>
                    </div>
                </div>
                `;
            }

            var html2='';
            for (let j = 0; j < json.ruangan.length; j++) {
                const el2 = json.ruangan[j];
                html2+=`
                <div class="col-md-4">
                    <div class="card bg-warning">
                        <div style="font-size:20px;">Antrian</div>
                        <div style="font-size:40px;height:70px">${(el2.current_antrian)?el2.current_antrian:'-'}</div>
                        <div style="font-size:20px;border-top:1px solid black;padding-bottom:5px;">${el2.nama} ${el2.nomor}</div>
                    </div>
                </div>`;
            }

            $('#div_loket').html(html1);
            $('#div_ruangan').html(html2);
            $('#current_no_antrian').text(json.current_no_antrian);
            $('#current_loket').text(json.current_loket);
            
        },
        error: function() {
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