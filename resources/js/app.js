import {
    Chart,
    DoughnutController,
    ArcElement,
    Tooltip,
    Legend,
} from 'chart.js';

// Register Chart.js components
Chart.register(
    DoughnutController,
    ArcElement,
    Tooltip,
    Legend
);

// Make Chart available globally
window.Chart = Chart;