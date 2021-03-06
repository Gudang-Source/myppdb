  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard Kepala Sekolah</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?=$pendaftar['total']?></h3>

                <p>Peserta Terdaftar</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?=$rincian['diterima']?></h3>

                <p>Peserta Diterima</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar/diterima') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?=$rincian['dicadangkan']?></h3>

                <p>Peserta Dicadangkan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bookmark"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar/dicadangkan') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?=$rincian['tidakditerima']?></h3>

                <p>Peserta Tidak Diterima</p>
              </div>
              <div class="icon">
                <i class="ion ion-close"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar/ditolak') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- DONUT CHART -->
          <div class="col-md-12">
            <!-- PIE CHART -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Grafik Pendaftaran</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <canvas id="pieChart" style="height:230px; min-height:300px"></canvas>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <canvas id="pieChart2" style="height:230px;"></canvas>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <canvas id="pieChart3" style="height:230px;"></canvas>
                      </div>
                    </div>
                    
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <?php $this->load->view('templates/cdn_admin'); ?>

  <!-- ChartJS -->
  <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>

  <script>
    $(document).ready(function() {
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
            $.ajax({
                type : 'POST',
                url : "<?=base_url('kepsek/dashboard/get_dataChart')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: [
                          'Pendaftar',
                          'Diterima',
                          'Ditolak',
                          'Dicadangkan',
                          'Daftar Ulang'
                        ],
                        datasets: [{
                          data: data.total,
                          backgroundColor: ['#00c0ef', '#00a65a', '#f56954', '#f39c12', '#eaeaea'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>

  <script>
    $(document).ready(function() {
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
            $.ajax({
                type : 'POST',
                url : "<?=base_url('kepsek/dashboard/get_dataChart2')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: [
                          'Laki - Laki',
                          'Perempuan'
                        ],
                        datasets: [{
                          data: data.jumlah,
                          backgroundColor: ['#00c0ef', '#00a65a'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>

  <script>
    $(document).ready(function() {
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
            $.ajax({
                type : 'POST',
                url : "<?=base_url('kepsek/dashboard/get_dataChart3')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart3').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: data.nama_jurusan,
                        datasets: [{
                          data: data.jurusan,
                          backgroundColor: ['#f39c12','#00a65a','#f56954','#00c0ef',  '#eaeaea'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>