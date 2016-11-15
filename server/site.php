<?php
    $database = $GLOBALS['database'];
    $period = date('Ym');
    $time_start = time();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="../site.css">
        <title>Statistik Pengguna IGN</title>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Statistik Pengguna IGN</a>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                        $periods = $database->select('data', ['period'], [
                            'GROUP' => 'period'
                        ]);
                        $btn_class = 'btn-default';

                        foreach ($periods as $row) {
                            if ($row['period'] == $arg['period']) $btn_class = "btn-primary";
                            echo '<a href="'.$row['period'].'" class="btn '.$btn_class.'">'.$row['period'].'</a>&nbsp;';
                        }
                    ?>
                    <br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Jumlah Sampel</p>
                    <div class="col-md-6">
                        <p><?php echo $database->count('data', ['period' => $period]); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Berdasarkan Rilis</p>
                    <div class="col-md-6">
                        <table class="table table-condensed table-bordered">
                            <?php
                                $kernel_arch = $database->select('data', [
                                    'os_release'
                                ], [
                                    'period' => $period,
                                    'GROUP' => 'os_release'
                                ]);

                                foreach ($kernel_arch as $row) {
                                    echo '<tr><td>'.$row['os_release'].'</td><td></td></tr>';
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Berdasarkan Arsitektur</p>
                    <div class="col-md-6">
                        <table class="table table-condensed table-bordered">
                            <?php
                                $kernel_arch = $database->select('data', [
                                    'kernel_arch'
                                ], [
                                    'period' => $period,
                                    'GROUP' => 'kernel_arch'
                                ]);

                                foreach ($kernel_arch as $row) {
                                    echo '<tr><td>'.$row['kernel_arch'].'</td><td></td></tr>';
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Berdasarkan Rilis Kernel</p>
                    <div class="col-md-6">
                        <table class="table table-condensed table-bordered">
                            <?php
                                $kernel_release = $database->select('data', ['kernel_release'], [
                                    'period' => $period,
                                    'GROUP' => 'kernel_release'
                                ]);

                                foreach ($kernel_release as $row) {
                                    echo '<tr><td>'.$row['kernel_release'].'</td><td></td></tr>';
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Berdasarkan CPU</p>
                    <div class="col-md-6">
                        <table class="table table-condensed table-bordered">
                            <?php
                                $cpu_vendor = $database->select('data', ['cpu_vendor'], [
                                    'period' => $period,
                                    'GROUP' => 'cpu_vendor'
                                ]);

                                foreach ($cpu_vendor as $row) {
                                    echo '<tr><td>'.$row['cpu_vendor'].'</td><td></td></tr>';
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <small>
                    <?php
                        $time_delta = time() - $time_start;
                        if ($time_delta > 0) {
                            echo "Render time is ".$time_delta." sec(s).";
                        } else {
                            echo "Render time is less than a second";
                        }
                    ?>
                    </small>
                </div>
            </div>
        </div>
    </body>
</html>
