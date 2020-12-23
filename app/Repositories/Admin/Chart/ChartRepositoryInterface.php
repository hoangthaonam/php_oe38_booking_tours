<?php

namespace App\Repositories\Admin\Chart;

interface ChartRepositoryInterface {
    public function getChartByMonth();
    public function getChartByYear();
}
?>
