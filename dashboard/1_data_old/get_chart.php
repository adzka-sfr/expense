<?php
// check cookie
$jwt = $_COOKIE['expense_token'] ?? null;
if ($jwt === null) {
    echo "cookie_expired";
} else {
    // Auto-detect if running on localhost or domain
    $is_localhost = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']) ||
        strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0;
    if ($is_localhost) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/connect.php'; // local
        require_once $_SERVER['DOCUMENT_ROOT'] . '/expense/config/check_cookie.php'; // local
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/connect.php'; // hosting
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/check_cookie.php'; // hosting
    }

    // get data post
    $username = $user['username'];
    $type_chart = $_POST['jenis_chart'];
    $month = $_POST['bulan'] ?? date('Y-m', strtotime($now));
    // $month = date('Y-m', strtotime($month));

    if ($type_chart == 'bare') {

        $stmt = $connect->prepare("SELECT c_category_id, c_category_name, c_total FROM v_category_outcome_monthly WHERE c_username = :username AND c_month = :month ORDER BY c_total ASC");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        $totals = [];

        foreach ($result as $row) {
            $categories[] = $row['c_category_name'];
            $totals[] = $row['c_total'];
        }
?>
        <div id="bare" style="height:500px; width: 100%; margin-top: 20px;"></div>
        <script type="text/javascript">
            var chartDom = document.getElementById('bare');
            var myChart = echarts.init(chartDom);
            var option;

            option = {
                title: {
                    text: 'Semua Pengeluaran',
                    subtext: 'Bulan : <?= $month ?>',
                    left: 'right'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: {
                    type: 'value',
                    boundaryGap: [0, 0.01],
                    axisLabel: {
                        show: false
                    }
                },
                yAxis: {
                    type: 'category',
                    data: <?php echo json_encode($categories); ?>
                },
                series: [{
                    name: 'Aktual',
                    type: 'bar',
                    data: <?php echo json_encode($totals); ?>,
                    itemStyle: {
                        color: '#91CC75'
                    },
                    label: {
                        show: true,
                        position: 'insideLeft',
                        align: 'left',
                        formatter: function(params) {
                            return params.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }
                    }
                }]
            };

            option && myChart.setOption(option);
        </script>
    <?php
    } elseif ($type_chart == 'balance') {
        $stmt = $connect->prepare("SELECT c_total_income, c_total_outcome FROM v_monthly_balance WHERE c_username = :username AND c_month = :month");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            $pemasukan = 0;
            $pengeluaran = 0;
        } else {
            $pemasukan = $result[0]['c_total_income'];
            $pengeluaran = $result[0]['c_total_outcome'];
        }
    ?>
        <div id="bancance" style="height:500px; width: 100%; margin-top: 20px;"></div>
        <script>
            var chartDom = document.getElementById('bancance');
            var myChart = echarts.init(chartDom);
            var option;

            option = {
                title: {
                    text: 'Pengeluaran X Pemasukan',
                    subtext: 'Bulan : <?= $month ?>',
                    left: 'right'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {
                    orient: 'vertical',
                    left: 'left'
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: {
                    type: 'value',
                    boundaryGap: [0, 0.01],
                    axisLabel: {
                        show: false
                    }
                },
                yAxis: {
                    type: 'category',
                    data: ['<?= date('M', strtotime($month)) ?>']
                },
                series: [{
                        name: 'Pengeluaran',
                        type: 'bar',
                        data: [<?= $pengeluaran ?>],
                        itemStyle: {
                            color: '#EE6666'
                        },
                        label: {
                            show: true,
                            position: 'insideLeft',
                            align: 'left',
                            formatter: function(params) {
                                return params.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            }
                        }
                    },
                    {
                        name: 'Pemasukan',
                        type: 'bar',
                        data: [<?= $pemasukan ?>],
                        itemStyle: {
                            color: '#91CC75'
                        },
                        label: {
                            show: true,
                            position: 'insideLeft',
                            align: 'left',
                            formatter: function(params) {
                                return params.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            }
                        }
                    }
                ]
            };

            option && myChart.setOption(option);
        </script>
    <?php
    } elseif ($type_chart == 'bunder') {
        $stmt = $connect->prepare("SELECT c_category_id, c_category_name, c_total FROM v_category_outcome_monthly WHERE c_username = :username AND c_month = :month ORDER BY c_total ASC");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        $totals = [];

        foreach ($result as $row) {
            $categories[] = $row['c_category_name'];
            $totals[] = $row['c_total'];
        }
    ?>
        <div id="bunder" style="height:500px; width: 100%; margin-top: 20px;"></div>
        <script>
            var chartDom = document.getElementById('bunder');
            var myChart = echarts.init(chartDom);
            var option;

            option = {
                title: {
                    text: 'Semua Pengeluaran',
                    subtext: 'Bulan : <?= $month ?>',
                    left: 'right'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: function(params) {
                        return params.seriesName + '<br/>' + params.name + ': ' + params.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' (' + params.percent + '%)';
                    }
                },
                legend: {
                    orient: 'vertical',
                    left: 'left'
                },
                series: [{
                    name: 'Pengeluaran',
                    type: 'pie',
                    radius: '50%',
                    data: <?php echo json_encode(array_map(function ($category, $total) {
                                return ['value' => $total, 'name' => $category];
                            }, $categories, $totals)); ?>,
                    label: {
                        show: true,
                        formatter: '{d}%' // Label shows percentage
                    },
                    emphasis: {
                        disabled: true // Disables hover effect
                    }
                }]
            };

            option && myChart.setOption(option);
        </script>
    <?php
    } else {
        $stmt = $connect->prepare("SELECT c_category_id, c_category_name, c_total_outcome, c_budget FROM v_category_budget_outcome WHERE c_username = :username AND c_month = :month ORDER BY c_budget ASC");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':month', $month);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        $totals = [];
        $budgets = [];

        foreach ($result as $row) {
            $categories[] = $row['c_category_name'];
            $totals[] = $row['c_total_outcome'];
            $budgets[] = $row['c_budget'];
        }
    ?>
        <div id="anggar" style="height:500px; width: 100%; margin-top: 20px;"></div>
        <script type="text/javascript">
            var chartDom = document.getElementById('anggar');
            var myChart = echarts.init(chartDom);
            var option;

            option = {
                title: {
                    text: 'Anggaran X Pengeluaran',
                    subtext: 'Bulan : <?= $month ?>',
                    left: 'right'
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                legend: {
                    orient: 'vertical',
                    left: 'left'
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: {
                    type: 'value',
                    boundaryGap: [0, 0.01],
                    axisLabel: {
                        show: false
                    }
                },
                yAxis: {
                    type: 'category',
                    data: <?php echo json_encode($categories); ?>
                },
                series: [{
                        name: 'Anggaran',
                        type: 'bar',
                        data: <?php echo json_encode($budgets); ?>,
                        itemStyle: {
                            color: '#EE6666'
                        },
                        label: {
                            show: true,
                            position: 'insideLeft',
                            align: 'left',
                            formatter: function(params) {
                                return params.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            }
                        }
                    },
                    {
                        name: 'Aktual',
                        type: 'bar',
                        data: <?php echo json_encode($totals); ?>,
                        itemStyle: {
                            color: '#91CC75'
                        },
                        label: {
                            show: true,
                            position: 'insideLeft',
                            align: 'left',
                            formatter: function(params) {
                                return params.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            }
                        }
                    }
                ]
            };

            option && myChart.setOption(option);

            // untuk handle ketika chart di klik
            // myChart.on('click', function(params) {
            //     // var dataIndex = params.dataIndex; // index / urutan
            //     var legend = params.seriesName; // by tipe data / legend
            //     var label = params.name; // label / nama yang ada di sumbu x (bawah)
            //     // var deptCode = efficiencyData.deptCode[dataIndex]; // mengambil full date dengan bantuan index

            //     if (legend != 'Total Piano' && legend != 'Rata-Rata NG') {
            //         gettrend(legend, label);
            //     }
            // });
        </script>
<?php
    }
}
