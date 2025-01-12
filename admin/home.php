<?php include 'includes/session.php'; ?>
<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $currentMonth = date('m');
  $currentYear = date('Y');
  if (isset($_GET['month'])) {
    $currentMonth = $_GET['month'];
  }
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Tableau de Bord</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li class="active">Tableau de bord</li>
            </ol>
        </section>

        <section class="content">
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM agent";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>";
              ?>

              <p>Total Agent</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="agent.php" class="small-box-footer">Voir plus <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM presence";
                $query = $conn->query($sql);
                $total = $query->num_rows;

                $sql = "SELECT * FROM presence WHERE status = 1";
                $query = $conn->query($sql);
                $early = $query->num_rows;
                
                $percentage = ($early/$total)*100;

                echo "<h3>".number_format($percentage, 2)."<sup style='font-size: 20px'>%</sup></h3>";
              ?>
          
              <p>Taux de ponctualité</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="presence.php" class="small-box-footer">Voir plus <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM presence WHERE date = '$today' AND status = 1";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>"
              ?>
             
              <p>Agents Ponctuels</p>
            </div>
            <div class="icon">
              <i class="ion ion-clock"></i>
            </div>
            <a href="presence.php" class="small-box-footer">Voir Plus <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM presence WHERE date = '$today' AND status = 0";
                $query = $conn->query($sql);

                echo "<h3>".$query->num_rows."</h3>"
              ?>

              <p>Retardateurs</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert-circled"></i>
            </div>
            <a href="presence.php" class="small-box-footer">Voir plus<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Rapport Mensuel de Présence</h3>
                            <div class="box-tools pull-right">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label>Sélectionner le mois : </label>
                                        <select class="form-control input-sm" id="select_month">
                                            <?php
                                            for ($m = 1; $m <= 12; $m++) {
                                                $selected = ($m == $currentMonth) ? 'selected' : '';
                                                echo "<option value='" . $m . "' " . $selected . ">" . date('F', mktime(0, 0, 0, $m, 1)) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <!-- Premier graphique : Barres -->
                                <div class="col-md-8">
                                    <h4>Statistiques par Jour</h4>
                                    <div class="chart" style="max-width: 100%; height: 300px;">
                                        <canvas id="barChart"></canvas>
                                    </div>
                                </div>

                                <!-- Deuxième graphique : Donut -->
                                <div class="col-md-4">
                                    <h4>Statistiques par Semaine</h4>
                                    <div class="chart" style="max-width: 100%; height: 300px;">
                                        <canvas id="donutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>

<!-- Chart Data -->
<?php
$days = array();
$ontime = array();
$late = array();

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

for ($d = 1; $d <= $daysInMonth; $d++) {
    $date = $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($d, 2, '0', STR_PAD_LEFT);

    // Ponctuels
    $sql = "SELECT * FROM presence WHERE date = '$date' AND status = 1";
    $oquery = $conn->query($sql);
    array_push($ontime, $oquery->num_rows);

    // Retardataires
    $sql = "SELECT * FROM presence WHERE date = '$date' AND status = 0";
    $lquery = $conn->query($sql);
    array_push($late, $lquery->num_rows);

    array_push($days, $d);
}

// Statistiques par semaine
$weeks = ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'];
$ontime_weeks = [];
$late_weeks = [];

for ($week = 1; $week <= 4; $week++) {
    $start_day = ($week - 1) * 7 + 1;
    $end_day = min($week * 7, $daysInMonth);

    // Ponctuels
    $sql = "SELECT * FROM presence WHERE DAY(date) BETWEEN $start_day AND $end_day AND MONTH(date) = $currentMonth AND status = 1";
    $oquery = $conn->query($sql);
    array_push($ontime_weeks, $oquery->num_rows);

    // Retardataires
    $sql = "SELECT * FROM presence WHERE DAY(date) BETWEEN $start_day AND $end_day AND MONTH(date) = $currentMonth AND status = 0";
    $lquery = $conn->query($sql);
    array_push($late_weeks, $lquery->num_rows);
}

$weeks = json_encode($weeks);
$ontime_weeks = json_encode($ontime_weeks);
$late_weeks = json_encode($late_weeks);
?>
<!-- End Chart Data -->

<?php include 'includes/scripts.php'; ?>
<script src="../bower_components/jquery/chart.js"></script>
<script>
$(function(){
    // Vérifier si les données sont bien transmises
    console.log('Jours:', <?php echo $days; ?>);
    console.log('Ponctuels par jour:', <?php echo $ontime; ?>);
    console.log('Retardataires par jour:', <?php echo $late; ?>);
    
    // Graphique à barres
    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var barChartData = {
        labels: <?php echo $days; ?>,
        datasets: [
            {
                label: 'Retard',
                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: <?php echo $late; ?>
            },
            {
                label: 'Ponctualité',
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: <?php echo $ontime; ?>
            }
        ]
    };

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: true, position: 'top' }
        },
        scales: {
            x: { title: { display: true, text: 'Jours du Mois' } },
            y: { title: { display: true, text: 'Nombre d\'agents' } }
        }
    };

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    });

    // Graphique en donut
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
    var donutChartData = {
        labels: <?php echo $weeks; ?>,
        datasets: [
            {
                label: 'Retard',
                data: <?php echo $late_weeks; ?>,
                backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(255, 159, 64, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)']
            },
            {
                label: 'Ponctualité',
                data: <?php echo $ontime_weeks; ?>,
                backgroundColor: ['rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(255, 99, 132, 0.8)', 'rgba(75, 192, 192, 0.8)']
            }
        ]
    };

    var donutChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: true, position: 'top' }
        }
    };

    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutChartData,
        options: donutChartOptions
    });

    // Mise à jour du mois
    $('#select_month').change(function(){
        window.location.href = 'home.php?month=' + $(this).val();
    });
});
</script>

</body>
</html>

<?php
$days = array();
$ontime = array();
$late = array();

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

for ($d = 1; $d <= $daysInMonth; $d++) {
    $date = $currentYear . '-' . str_pad($currentMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($d, 2, '0', STR_PAD_LEFT);

    $sql = "SELECT * FROM presence WHERE date = '$date' AND status = 1";
    $oquery = $conn->query($sql);
    array_push($ontime, $oquery->num_rows);

    $sql = "SELECT * FROM presence WHERE date = '$date' AND status = 0";
    $lquery = $conn->query($sql);
    array_push($late, $lquery->num_rows);

    array_push($days, $d);
}
$days = json_encode($days);
$late = json_encode($late);
$ontime = json_encode($ontime);
?>

<script src="../bower_components/jquery/chart.js"></script>
<script>
$(function(){
    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    new Chart(barChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo $days; ?>,
            datasets: [{
                label: 'Ponctualité',
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                data: <?php echo $ontime; ?>
            },{
                label: 'Retard',
                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                data: <?php echo $late; ?>
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Jours du Mois'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Nombre d\'agents'
                    }
                }
            }
        }
    });

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: {
            labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'],
            datasets: [{
                data: [30, 50, 70, 90], // Replace with your week data
                backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)']
            }]
        }
    });
});
</script>


