<div class="row">
    <div class="col-md-6">
        <div class="card card-default">
            <form id="form1">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" id="pass" class="form-control">
                </div>

                <div class="form-group">
                    <label>Ketik Ulang Password</label>
                    <input type="password" name="retype_pass" id="retype_pass" class="form-control">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function () {
	$("#form1"). submit(function (event) { 
        event.preventDefault();
        ajaxSubmit();
    }); 

})

function ajaxSubmit(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_submit',
        type: 'POST',
        data: $("#form1").serialize(),
        beforeSend: function() {
            $.LoadingOverlay("show");
        },
        complete: function() {
            $.LoadingOverlay("hide");
        },
        success: function(json) {
            $.LoadingOverlay("hide");
            if(json['status']=='success'){
                swal({
                    type: 'success',
                    title: 'Success',
                    html: json['data']
                })

            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    html: json['data']
                })
            }
        },
        error: function() {
            $.LoadingOverlay("hide");
            swal({
                    type: 'error',
                    title: 'Oops...',
                    html: 'Error occured. Please try again or contact administrator'
                })	
            
        }
    });
}
</script>