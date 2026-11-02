<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Dashboard Admin</h3>
      </div>
    </div>

    <!-- Statistik -->
    <div class="row">
      <!-- Total Barang -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-boxes"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Barang</p>
                  <h4 class="card-title"><?php echo e($totalBarang); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Barang Masuk -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-dolly"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Barang Masuk</p>
                  <h4 class="card-title"><?php echo e($totalBarangMasuk); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Supplier -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-truck"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Supplier</p>
                  <h4 class="card-title"><?php echo e($totalSupplier); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Penjualan -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                  <i class="fas fa-shopping-cart"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Penjualan</p>
                  <h4 class="card-title"><?php echo e($totalPenjualan); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card card-round">
          <div class="card-header">
            <h5>Grafik Penjualan Bulanan</h5>
          </div>
          <div class="card-body">
            <canvas id="salesChart" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Transaksi Terbaru dan Stok Kurang -->
    <div class="row mt-4">
      <!-- Transaksi Terbaru -->
      <div class="col-md-7">
        <div class="card card-round">
          <div class="card-header">
            <h5>Transaksi Terbaru</h5>
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pembeli</th>
                  <th>Tanggal</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $transaksiTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaksi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($transaksi->user->name ?? 'User'); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($transaksi->tanggal)->format('Y-m-d')); ?></td>
                    <td>Rp <?php echo e(number_format($transaksi->total, 2)); ?></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Stok Kurang -->
      <div class="col-md-5">
        <div class="card card-round">
          <div class="card-header">
            <h5>Stok Barang Kurang dari 5</h5>
          </div>
          <div class="card-body">
            <ul class="list-group">
              <?php $__currentLoopData = $stokKurang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?php echo e($barang->nama_barang); ?>

                  <span class="badge bg-danger rounded-pill"><?php echo e($barang->stok); ?> pcs</span>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Barang Terlaris -->
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card card-round">
          <div class="card-header">
            <h5 >Barang Terlaris (Top 5)</h5>
          </div>
          <div class="card-body">
            <?php if($barangTerlaris->count() > 0): ?>
              <ul class="list-group">
                <?php $__currentLoopData = $barangTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo e($barang->nama_barang); ?>

                    <span class="badge bg-primary rounded-pill"><?php echo e($barang->total_terjual); ?> terjual</span>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            <?php else: ?>
              <p class="text-muted">Belum ada data penjualan.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('salesChart').getContext('2d');
  const salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: json(range(1, 12)),
      datasets: [{
        label: 'Penjualan',
        data: json($dataGrafik),
        backgroundColor: 'rgba(255, 111, 0, 0.6)',
        borderColor: '#ff6f00',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          min: 0,
          max: 20000000,
          ticks: {
            stepSize: 5000000,
            callback: function (value) {
              return 'Rp ' + (value / 1000000).toLocaleString() + ' Juta';
            }
          }
        }
      }
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\Sifabrik\resources\views/content/admin/dashboard.blade.php ENDPATH**/ ?>