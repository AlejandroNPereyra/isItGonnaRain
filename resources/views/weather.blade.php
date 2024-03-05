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
    <h2>Soon (Next Few Hours)</h2>
    <p>Rain: {{ $soonWillRain ? 'Yes' : 'No' }}</p>
    <h2>Next 24 Hours</h2>
    <p>Rain: {{ $next24WillRain ? 'Yes' : 'No' }}</p>
    <h2>Next 48 Hours</h2>
    <p>Rain: {{ $next48WillRain ? 'Yes' : 'No' }}</p>
</body>
</html>
