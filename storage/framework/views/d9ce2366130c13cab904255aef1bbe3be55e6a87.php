<?php $__env->startSection('content'); ?>
<style>
.select2-container--default .select2-selection--single{
    border: 1px #f8f9fc solid;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
    background-color: #f8f9fc;
    font-size: 1.75rem;
    font-weight: 400;
    line-height: 1.2;
    padding: 10px 0px;
}
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between <?php if(Auth::user()->instansiname != ''): ?> mb-4 <?php else: ?> mb-2 <?php endif; ?>">
    <h1 class="h3 mb-0 text-gray-800">Dashboard 
    
        <?php if(Auth::user()->instansiname == ''): ?>
        <span>
            <select name="finstansiname" id="finstansiname">
                <option value="">Semua Perangkat Daerah</option>
                <?php $__currentLoopData = $instansi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($in->name); ?>" <?php if($in->name == $ins): ?> selected="selected" <?php endif; ?>><?php echo e($in->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </span>
        <?php endif; ?>
    </h1>
    
    <b class="float-right" style="border-bottom: 1px #000 solid">
        Tahun:&nbsp; 
        <select id="year" style="background: none;border: none;">
            <?php for($y=date('Y'); $y>=2010; $y--): ?>
            <option value="<?php echo e($y); ?>" <?php if($y == $year): ?> selected="selected <?php endif; ?>"><?php echo e($y); ?></option>
            <?php endfor; ?>
        </select>
    </b>
    
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengajuan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($booking); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Diproses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($create); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Proses Autentifikasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($auten); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($finish); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-flag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Frekuensi Pengajuan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-3">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Jenis Pengajuan</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
        <i>&nbsp; *) Data berdasarkan tgl entry.</i>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('vendor/chart.js/Chart.min.js')); ?>"></script>




<script>
var ctx = $("#myAreaChart");
$('#finstansiname').select2();
$.get("<?php echo e(route('dashboard.getAreaChart', [':year', ':ins'])); ?>".replace(':year', $('#year').val()).replace(':ins', $('#finstansiname').val()), function(res){
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Des"],
            datasets: [{
            label: "Jumlah",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: res.data,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 10,
                padding: 10,
                callback: function(value, index, values) {
                    return value;
                }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
                label: function(tooltipItem, chart) {
                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                return datasetLabel + ': ' + tooltipItem.yLabel;
                }
            }
            }
        }
    });
});

$('#year, #finstansiname').change(function(){
    document.location.href = "<?php echo e(route('dashboard')); ?>?year=" + $('#year').val() + "&ins=" + $('#finstansiname').val();
});

Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

var ctxp = document.getElementById("myPieChart");
$.get("<?php echo e(route('dashboard.getAreaPie', [':year', ':ins'])); ?>".replace(':year', $('#year').val()).replace(':ins', $('#finstansiname').val()), function(resp){
    lp = [];
    dp = [];
    $.each(resp.data, function(ip, vp){
        lp.push(vp.n_sub);
        dp.push(vp.c);
    });

    var myPieChart = new Chart(ctxp, {
        type: 'doughnut',
        data: {
            labels: lp,
            datasets: [{
            data: dp,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            }
        },
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Downloads\kominfo.jdih-main\resources\views/dashboard.blade.php ENDPATH**/ ?>