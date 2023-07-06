<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Stats;

use App\Models\Category;
use App\Models\DeviceModel;
use App\Models\UserSubscription;
use App\Models\SubscriptionOrder;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Transactions extends Component
{
    public $typeChart = 'monthly';

    public $categoriesCount;
    public $deviceModelCount;
    public $productCount;
    public $clientCount;
    public $vendorCount;
    public $userSubscriptions_count;
    public $userSubscriptions;
    public $charts;

    public function mount(): void
    {
        $this->categoriesCount = Category::count('id');
        $this->productCount = Product::count('id');
        $this->clientCount = User::role('client')->count('id');
        $this->vendorCount = User::role('vendor')->count('id');
        $this->deviceModelCount = DeviceModel::count('id');

        $this->userSubscriptions_count = UserSubscription::whereDate('created_at', '>=', now()->subWeek())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as user_subscriptions'))
            ->groupBy('date')
            ->pluck('user_subscriptions');

        $this->chart();
    }

    public function chart(): void
    {
        $query = SubscriptionOrder::selectRaw('SUM(amount) as amount')
            ->when($this->typeChart === 'monthly', function ($q) {
                return $q->selectRaw('MONTH(created_at) as labels, COUNT(*) as subscription_order')
                    ->whereYear('created_at', '=', date('Y'))
                    ->groupByRaw('MONTH(created_at)');
            }, function ($q) {
                return $q->selectRaw('YEAR(created_at) as labels, COUNT(*) as subscription_order')
                    ->groupByRaw('YEAR(created_at)');
            })
            ->get()
            ->toArray();

        $subscription_order = [
            'amount' => array_column($query, 'amount'),
            'labels' => array_column($query, 'labels'),
        ];

        $this->charts = json_encode([
            'amount' => [
                'subscription_order' => $subscription_order['amount'],
            ],
            'labels' => $subscription_order['labels'],
        ]);
    }

    public function getDailyChartOptionsProperty()
    {
        $currentMonth = Carbon::now()->startOfMonth();

        // Get all days in the current month
        $daysInMonth = [];
        $currentDay = Carbon::now()->startOfMonth();

        while ($currentDay->month === $currentMonth->month) {
            $daysInMonth[] = $currentDay->format('Y-m-d');
            $currentDay->addDay();
        }

        // Get user_subscriptions data for each day in the current month
        $orderSubscriptionData = SubscriptionOrder::selectRaw('DATE(created_at) as day, SUM(amount) as amount_subscription_orders')
            ->whereBetween('created_at', [$currentMonth, Carbon::now()->endOfMonth()])
            ->groupBy('day')
            ->orderBy('day', 'ASC')
            ->get();

        // Combine user_subscriptions
        $chartData = [];

        foreach ($daysInMonth as $day) {
            $order = $orderSubscriptionData->where('day', $day)->first();
            $chartData[] = [
                'day'                => $day,
                'subscription_orders' => $order ? $order->amount_subscription_orders : 0,
            ];
        }

        // Create stacked bar chart options
        return [
            'chart' => [
                'type'    => 'bar',
                'stacked' => true,
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal'  => false,
                    'endingShape' => 'flat',
                    'columnWidth' => '70%',
                ],
            ],
            'series' => [
                [
                    'name' => __('User Subscriptions'),
                    'data' => array_column($chartData, 'subscription_orders'),
                ],
            ],
            'xaxis' => [
                'categories' => array_column($chartData, 'day'),
                'labels'     => [
                    'rotateAlways' => true,
                    'rotate'       => -45,
                ],
            ],
            'yaxis' => [
                'title' => [
                    'text' => __('Amount'),
                ],
            ],
            'legend' => [
                'position'        => 'top',
                'horizontalAlign' => 'center',
                'offsetX'         => 40,
            ],
            'colors' => ['#4CAF50', '#F44336'],
        ];
    }

    public function render()
    {
        return view('livewire.admin.stats.transactions');
    }

    protected function getChart($user_subscriptions)
    {
        $dataarray = [];
        $i = 0;

        foreach ($user_subscriptions as $order) {
            $dataarray['amount']['user_subscriptions'][$i] = $order['amount'];
            $dataarray['amount']['user_subscriptions'][$i] = $order['amount'] - $order['amount'];
            $dataarray['labels'][$i] = $order['labels'];
            $i++;
        }

        return json_encode($dataarray);
    }
}
