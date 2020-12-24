<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Chart\ChartRepositoryInterface;

class ChartController extends Controller
{
    protected $chartRepo;

    public function __construct(ChartRepositoryInterface $chartRepo) {
        $this->chartRepo = $chartRepo;
    }

    function index(){
        $payments_month = $this->chartRepo->getChartByMonth();
        $payments_year = $this->chartRepo->getChartByYear();
        return view('admin.pages.chart', compact('payments_month', 'payments_year'));
    }
}
