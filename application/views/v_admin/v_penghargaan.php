 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0 text-dark"><?= ucwords($title) ?></h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
             <li class="breadcrumb-item active">Penghargaan</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <div class="row">
         <!-- left column -->
         <div class="col-md-12">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Tabel data penghargaan</h3>
               <a class="btn btn-sm btn-primary float-right" href="<?= base_url('admin/sekolah/penghargaan/tambah') ?>"><i class="fa fa-user-plus"></i> Tambah Penghargaan</a>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-striped">
                 <thead>
                   <tr>
                     <th class="text-nowrap" style="width: 5%">No</th>
                     <th class="text-nowrap">Gambar</th>
                     <th class="text-nowrap">Penghargaan</th>
                     <th class="text-nowrap">Deskripsi</th>
                     <th class="text-nowrap">Tanggal</th>
                     <th style="width: 12%">Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    $no = 1;
                    foreach ($penghargaan as $p) :
                      //<?= base_url('admin/sekolah/penghargaan/ubah/'.$p['id_penghargaan'])
                      ?>
                     <tr>
                       <td><?= $no++ ?></td>
                       <td><img class="brand-image" style="width: 70px; height: 70px; border-radius: 5%" src="<?= base_url('assets/img/uploads/' . $p['foto_penghargaan']) ?>">
                       </td>
                       <td><?= ucwords($p['nama_penghargaan']) ?></td>
                       <td><?= ucwords(word_limiter($p['deskripsi_penghargaan'], 27)) ?></td>
                       <td><?= $p['tanggal_penghargaan'] ?></td>
                       <td><a href="javascript:void(0)" data-toggle="modal" id="<?= $p['id_penghargaan'] ?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $p['id_penghargaan'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                     </tr>
                   <?php endforeach; ?>
                 </tbody>
               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>

         <div class="modal fade" id="modal-lg">
           <div class="modal-dialog modal-lg">
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title">Edit <span id="nama2"></span></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="row">
                   <div class="col-md-12">
                     <!-- form start -->
                     <form action="<?= base_url('c_admin/admin/update_penghargaan') ?>" method="post" role="form" enctype="multipart/form-data">
                       <div class="card-body">
                         <div class="row">
                           <div class="col-md-8">
                             <div class="form-group">
                               <label for="nama">Nama Penghargaan</label>
                               <input type="text" class="form-control nama2" name="nama" id="nama2" placeholder="Nama Penghargaan" value="">
                               <small class="text-danger mt-2"><?= form_error('nama') ?></small>

                               <input type="hidden" name="id" class="id" value="" required>
                             </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group">
                               <label for="exampleInputEmail1">Tanggal Penghargaan</label>
                               <div class="input-group">
                                 <div class="input-group-prepend">
                                   <span class="input-group-text">
                                     <i class="far fa-calendar-alt"></i>
                                   </span>
                                 </div>
                                 <input type="text" name="tgl" class="form-control tgl float-right" id="datepicker">
                               </div>
                               <!-- /.input group -->
                               <small class="text-danger mt-2"><?= form_error('tgl') ?></small>
                             </div>
                           </div>
                         </div>
                         <div class="form-group">
                           <label for="des">Deskripsi Penghargaan</label>
                           <textarea id="des" name="deskripsi" class="form-control des" style="height: 150px;" placeholder="Masukkan Deskripsi"><?php if (!empty($profile)) {
                                                                                                                                                  echo $profile['visi_sekolah'];
                                                                                                                                                } ?></textarea>
                           <small class="text-danger mt-2"><?= form_error('deskripsi') ?></small>
                         </div>
                         <div class="form-group">
                           <label for="exampleInputFile">Foto Penghargaan</label>
                           <div class="input-group">
                             <div class="custom-file">
                               <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                               <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                             </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-12">
                             <img class="mt-2 mb-2 img" style="width: 100%; max-height: 300px;" src="" id="output">
                           </div>
                         </div>

                         <!--  <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                          </div> -->
                       </div>
                       <!-- /.card-body -->
                   </div>
                 </div>
               </div>
               <div class="modal-footer justify-content-between">
                 <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                 </form>
               </div>
             </div>
             <!-- /.modal-content -->
           </div>
           <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->
       </div>
     </div>
   </section>
 </div>
 <!-- /.content-wrapper -->

 <?php $this->load->view('templates/cdn_admin'); ?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

 <script>
   $(function() {
     $("#example1").DataTable({});
     $('#example2').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": false,
       "ordering": true,
       "info": true,
       "autoWidth": false,
     });
   });

   $(function() {
     //Date picker
     $('#datepicker').datepicker({
       autoclose: true
     })
   });

   var loadFile = function(event) {
     var output = document.getElementById('output');
     output.src = URL.createObjectURL(event.target.files[0]);
   };

   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/sekolah/penghargaan/update') ?>",
       data: {
         'id': dataId
       },
       dataType: "json",
       success: function(data) {
         $('.id').val(data.id);
         $('.nama2').val(data.nama_penghargaan);
         $('#nama2').text(data.nama_penghargaan);
         $('.tgl').val(data.tanggal_penghargaan);
         $('.des').text(data.deskripsi_penghargaan);
         $('.img').attr('src', data.foto);
       },
     });
   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Penghargaan',
       text: "Apakah anda yakin ingin menghapus data penghargaan ini?",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Hapus!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>admin/sekolah/penghargaan/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/sekolah/penghargaan') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/sekolah/penghargaan') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>