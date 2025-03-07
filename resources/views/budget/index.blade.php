@extends('layouts.app')

@section('title', 'Buget')

@section('content')
@vite('resources/css/style.css')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .chart-container {
      position: relative;
      height: 300px;
      width: 100%;
      max-width: 500px;
      margin: 0 auto;
    }
    @media (min-width: 768px) {
      .chart-container {
        height: 400px;
      }
    }
</style>

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
        <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Budget Distribution</h1>
        <p class="text-gray-600 dark:text-gray-400">Monthly breakdown of expenses and savings</p>
        </div>
    <div class="flex justify-center mb-4">
        <div class="inline-flex rounded-md shadow-sm" role="group">
        <button type="button" id="pieChartBtn" class="px-4 py-2 text-sm font-medium text-blue-700 dark:text-blue-400 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-l-lg hover:bg-gray-100 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-blue-700 dark:focus:ring-blue-500 focus:text-blue-700 dark:focus:text-blue-400">
            Pie Chart
        </button>
        <button type="button" id="barChartBtn" class="px-4 py-2 text-sm font-medium text-gray-900 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-r-lg hover:bg-gray-100 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-blue-700 dark:focus:ring-blue-500 focus:text-blue-700 dark:focus:text-blue-400">
            Bar Graph
        </button>
        </div>
    </div>

    <div class="chart-container">
        <canvas id="budgetChart"></canvas>
    </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Budget Breakdown</h2>
    <div class="overflow-x-auto">
    @php
        $budgetCategories = [
            ['name' => 'Needs (Rent, Food, Bills, etc.)', 'amount' => $budgetOpt->needs, 'color' => 'rgb(220, 38, 38)'], // Red
            ['name' => 'Wants (Entertainment, Shopping, etc.)', 'amount' => $budgetOpt->wants, 'color' => 'rgb(234, 179, 8)'], // Yellow
            ['name' => 'Savings', 'amount' => $budgetOpt->savings, 'color' => 'rgb(34, 197, 94)'], // Green
        ];

        $totalIncome = $budgetOpt->income;
        $balance = $totalIncome - collect($budgetCategories)->sum('amount');
        $budgetCategories[] = ['name' => 'Balance', 'amount' => $balance, 'color' => 'rgb(59, 130, 246)']; // Blue
    @endphp

    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Percentage</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($budgetCategories as $category)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-4 w-4 rounded-full mr-2" style="background-color: {{ $category['color'] }}"></div>
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $category['name'] }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        ${{ number_format($category['amount'], 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $totalIncome > 0 ? round(($category['amount'] / $totalIncome) * 100, 2) : 0 }}%
                    </td>
                </tr>
            @endforeach
            <tr class="bg-gray-50 dark:bg-gray-700">
                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">Total</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                    ${{ number_format($totalIncome, 2) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">100%</td>
            </tr>
        </tbody>
    </table>

    </div>
    </div>
</div>

<script>
// Budget data
const budgetValues = [
    {{ $budgetOpt->income - $budgetOpt->needs - $budgetOpt->wants - $budgetOpt->savings }},
    {{ $budgetOpt->needs }}+700,
    {{ $budgetOpt->wants }}+300,
    {{ $budgetOpt->savings }}
];

const totalIncome = {{ $budgetOpt->income }};

// Calculate actual percentages
const budgetPercentages = budgetValues.map(value =>
totalIncome > 0 ? ((value / totalIncome) * 100).toFixed(2) : 0
);
const budgetLabels = ['Balance', 'Needs ('+budgetPercentages[1]+'%)', 'Wants ('+budgetPercentages[2]+'%)', 'Savings ('+budgetPercentages[3]+'%)'];
const budgetColors = ['rgb(59, 130, 246)', 'rgb(220, 38, 38)', 'rgb(234, 179, 8)', 'rgb(34, 197, 94)'];

//
const expectedPercentages = [50, 30, 20, 0];
const expectedValues = expectedPercentages.map(percent =>
    (percent / 100) * totalIncome
);

// Budget data for actual spending
const budgetData = {
    labels: budgetLabels,
    values: budgetValues,
    percentages: budgetPercentages,
    colors: budgetColors
};

// Expected budget data for comparison (50/30/20 rule)
const expectedBudgetData = {
    labels: ['Needs (50%)', 'Wants (30%)', 'Savings (20%)'],
    values: expectedValues.slice(0, 3),
    colors: ['rgba(220, 38, 38, 0.3)', 'rgba(234, 179, 8, 0.3)', 'rgba(34, 197, 94, 0.3)']
};

// Chart configuration
let chartType = 'pie';
let budgetChart;

// Initialize chart
function initChart() {
    const ctx = document.getElementById('budgetChart').getContext('2d');

    budgetChart = new Chart(ctx, {
        type: chartType,
        data: {
            labels: budgetData.labels.concat(expectedBudgetData.labels), // Merging actual & expected labels
            datasets: [
                {
                    label: 'Actual Budget',
                    data: budgetData.values,
                    backgroundColor: budgetData.colors,
                    borderWidth: 1
                },
                {
                    label: '50/30/20 Rule (Recommended)',
                    data: expectedBudgetData.values,
                    backgroundColor: expectedBudgetData.colors,
                    borderWidth: 1
                }
            ]
        },
        options: getChartOptions(chartType)
    });
}

// Get chart options based on chart type
function getChartOptions(chartType) {
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.raw || 0;
                        let percentage = 0;

                        // Ensure correct tooltip values for expected budget
                        if (context.datasetIndex === 1) {
                            const index = expectedBudgetData.labels.indexOf(label);
                            percentage = expectedPercentages[index] || 0;
                        } else {
                            percentage = budgetData.percentages[context.dataIndex] || 0;
                        }

                        return `${label}: $${value.toLocaleString()} (${percentage}%)`;
                    }
                }
            }
        }
    };

    if (chartType === 'bar') {
        return {
            ...commonOptions,
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { weight: 'bold' } }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            },
            indexAxis: 'x' // Horizontal bars; use 'y' for vertical bars
        };
    }

    return commonOptions;
}

// Call initChart() when the page loads


// Switch chart type
function switchChartType(type) {
    chartType = type;
    budgetChart.destroy();
    initChart();

    // Update active button
    document.getElementById('pieChartBtn').classList.toggle('text-blue-700', type === 'pie');
    document.getElementById('pieChartBtn').classList.toggle('text-gray-900', type !== 'pie');
    document.getElementById('barChartBtn').classList.toggle('text-blue-700', type === 'bar');
    document.getElementById('barChartBtn').classList.toggle('text-gray-900', type !== 'bar');
}

// Event listeners
document.getElementById('pieChartBtn').addEventListener('click', () => switchChartType('pie'));
document.getElementById('barChartBtn').addEventListener('click', () => switchChartType('bar'));

// Initialize the chart on page load
document.addEventListener('DOMContentLoaded', initChart);
</script>

@endsection
