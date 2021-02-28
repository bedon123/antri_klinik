<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <a href="javascript:void(0)" onclick="addNew()" class="btn btn-success btn-sm" style="margin-right:5px;"><i class="fa fa-plus" style="margin-right:5px;"></i> Tambah Data</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dt_table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="no-sort" width="20px">No</th>
                        <th>Usernama</th>
                        <th>Fullname</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th class="no-sort" width="120px"></th>
                    </tr>
                    </thead>
                    
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    
        <form id="form1">
        <!-- Modal body -->
        <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="fullname" id="fullname" class="form-control">
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="uname" id="uname" class="form-control">
        </div>
        <div class="form-group" id="div_pass">
            <label>Password</label>
            <input type="password" name="pass" id="pass" class="form-control">
        </div>
        
        <div class="form-group" >
            <label>Role</label>
            <?php echo 
            form_dropdown('role_id', $cb_roles, '','class="form-control" id="role_id"');
            ?>
        </div>


        </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ubah Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    
        <form id="form2">
      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" name="id" id="id_cp">
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass" id="pass_cp" class="form-control">
        </div>

        <div class="form-group">
            <label>Ketik Ulang Password</label>
            <input type="password" name="retype_pass" id="retype_pass_cp" class="form-control">
        </div>
        
        
        </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </form>
    </div>
  </div>
</div>


<script>
$(function () {
	showDataTable();
    $("#form1"). submit(function (event) { 
        event.preventDefault();
        ajaxSubmit();
    }); 
    $("#form2"). submit(function (event) { 
        event.preventDefault();
        ajaxSubmitCp();
    }); 

})

function showDataTable(){
    $("#dt_table").dataTable().fnDestroy();
    $('#dt_table').DataTable({
      "lengthChange": true,
      "searching": true,
        // 'scrollX': true,
        // 'scrollCollapse' : true,
        'processing': true,
        'serverSide': true,
        "columnDefs": [{
            "targets"  : 'no-sort',
            "orderable": false,
        }],
        "order": [[ 1, "ASC" ]],
        ajax: {
            url: "<?php echo base_url($this->uri->segment(1).'/ajax_list?').urldecode($_SERVER['QUERY_STRING']); ?>",
            type:'POST',
        }
    });
}
</script>


<script>
function ajaxCp(id){
    $('#id_cp').val(id);
    $('#pass_cp').val('');
    $('#retyppe_pass_cp').val('');
    $('#myModal2').modal('show')
}

function addNew(){
    $('#id').val('');
    $('#uname').val('');
    $('#fullname').val('');
    $('#pass').val('');
    $('#role_id').val('2').change();
    $('#div_pass').show();
    $('#modal_title').html("Tambah Data");
    $('#myModal').modal('show');
}

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
            if(json['status']=='sukses'){
                
                showDataTable();
                $('#myModal').modal('hide');

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

function ajaxSubmitCp(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_submit_cp',
        type: 'POST',
        data: $("#form2").serialize(),
        beforeSend: function() {
            $.LoadingOverlay("show");
        },
        complete: function() {
            $.LoadingOverlay("hide");
        },
        success: function(json) {
            $.LoadingOverlay("hide");
            if(json['status']=='sukses'){
                $('#myModal2').modal('hide');
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


function ajaxGetOne(id){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_get_one',
        type: 'POST',
        data: {id:id},
        beforeSend: function() {
            $.LoadingOverlay("show");
        },
        complete: function() {
            $.LoadingOverlay("hide");
        },
        success: function(json) {
            $.LoadingOverlay("hide");
            if(json['status']=='sukses'){
                var res=json['data'];
                $('#id').val(res.id);
                $('#uname').val(res.uname);
                $('#fullname').val(res.fullname);
                $('#role_id').val(res.role_id).change();
                $('#div_pass').hide();
                $('#modal_title').html("Ubah Data")
                $('#myModal').modal('show');

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

function ajaxDelete(id){
    var r = confirm("Yakin akan hapus data ini??");
    if (r == false) {
        return false;
    } 
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_delete',
        type: 'POST',
        data: {id:id},
        beforeSend: function() {
            $.LoadingOverlay("show");
        },
        complete: function() {
            $.LoadingOverlay("hide");
        },
        success: function(json) {
            $.LoadingOverlay("hide");
            if(json['status']=='sukses'){
                showDataTable();
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
