<?php

namespace App\Repositories\Admin\Chart;
use App\Repositories\BaseRepository;
use App\Repositories\Admin\Chart\ChartRepositoryInterface;
use App\Models\Payment;
use Carbon\Carbon;
use DB;

class ChartRepository extends BaseRepository implements ChartRepositoryInterface{

    public function getModel()
    {
        return Payment::class;
    }

    public function getChartByMonth()
    {
        return Payment::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy('created_at', 'DESC')->limit(12)->get();
    }

    public function getChartByYear()
    {
        return Payment::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
        ->groupBy(DB::raw('YEAR(created_at)'))->orderBy('created_at', 'DESC')->limit(5)->get();
    }

}

?>
