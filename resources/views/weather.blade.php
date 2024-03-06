<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
</head>
<body>
    <h1>Weather Forecast for Barcelona</h1>

    <pre>
        {{ dd($data) }}
    </pre>

    <h2>Next 4 Hours</h2>
    @if (isset($data['hourly']))
        <?php
        // Extract hourly data and initialize rain flag
        $hourlyData = $data['hourly'];
        $rain = false;

        // Loop through the first 4 hours and check for rain
        for ($i = 0; $i < 4; $i++) {
            if (isset($hourlyData['rain'][$i]) && $hourlyData['rain'][$i] > 0) {
                $rain = true;
                break; // Exit loop if rain is found
            }
        }
        ?>
        @if ($rain)
            <p>It is likely to rain within the next 4 hours.</p>
        @else
            <p>It is not likely to rain within the next 4 hours.</p>
        @endif
    @else
        <p>No data available for the next 4 hours.</p>
    @endif

    <h2>Next 24 Hours</h2>
    @if (isset($data['hourly']))
        <?php
        // Extract hourly data and initialize rain flag
        $hourlyData = $data['hourly'];
        $rain = false;

        // Loop through the first 24 hours and check for rain
        for ($i = 0; $i < 24; $i++) {
            if (isset($hourlyData['rain'][$i]) && $hourlyData['rain'][$i] > 0) {
                $rain = true;
                break; // Exit loop if rain is found
            }
        }
        ?>
        @if ($rain)
            <p>It is likely to rain within the next 24 hours.</p>
        @else
            <p>It is not likely to rain within the next 24 hours.</p>
        @endif
    @else
        <p>No data available for the next 24 hours.</p>
    @endif

    <h2>Next 48 Hours</h2>
    @if (isset($data['hourly']))
        <?php
        // Extract hourly data and initialize rain flag
        $hourlyData = $data['hourly'];
        $rain = false;

        // Loop through the first 48 hours and check for rain
        for ($i = 0; $i < 48; $i++) {
            if (isset($hourlyData['rain'][$i]) && $hourlyData['rain'][$i] > 0) {
                $rain = true;
                break; // Exit loop if rain is found
            }
        }
        ?>
        @if ($rain)
            <p>It is likely to rain within the next 48 hours.</p>
        @else
            <p>It is not likely to rain within the next 48 hours.</p>
        @endif
    @else
        <p>No data available for the next 48 hours.</p>
    @endif

    </body>
</html>