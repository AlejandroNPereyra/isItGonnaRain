<!-- resources/views/weather.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
</head>
<body>
    <h1>Weather Forecast for Barcelona</h1>

    <!-- Display Soon (Next Few Hours) Data -->
    <h2>Soon (Next Few Hours)</h2>
    @if (!empty($soonData))
        <ul>
            @foreach ($soonData['hourly']['data'] as $hourData)
                <li>
                    Hour: {{ $hourData['time'] }},
                    Precipitation: {{ $hourData['precipitation'] }},
                    Temperature: {{ $hourData['temperature'] }} °C
                </li>
            @endforeach
        </ul>
    @else
        <p>No data available for the next few hours.</p>
    @endif

    <!-- Display Next 24 Hours Data -->
    <h2>Next 24 Hours</h2>
    @if (!empty($next24Data))
        <ul>
            @foreach ($next24Data['hourly']['data'] as $hourData)
                <li>
                    Hour: {{ $hourData['time'] }},
                    Precipitation: {{ $hourData['precipitation'] }},
                    Temperature: {{ $hourData['temperature'] }} °C
                </li>
            @endforeach
        </ul>
    @else
        <p>No data available for the next 24 hours.</p>
    @endif

    <!-- Display Next 48 Hours Data -->
    <h2>Next 48 Hours</h2>
    @if (!empty($next48Data))
        <ul>
            @foreach ($next48Data['hourly']['data'] as $hourData)
                <li>
                    Hour: {{ $hourData['time'] }},
                    Precipitation: {{ $hourData['precipitation'] }},
                    Temperature: {{ $hourData['temperature'] }} °C
                </li>
            @endforeach
        </ul>
    @else
        <p>No data available for the next 48 hours.</p>
    @endif
</body>
</html>
