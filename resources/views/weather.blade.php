<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <title>Barcelona Weather Forecast</title>
  <style>
    /* Add some basic styling for a weather theme */
    body {
      font-family: Arial, sans-serif;
      background-color: #e0e0e0;
      color: #333;
    }
    h1, h2 {
      text-align: center;
    }
    .weather-box {
      border: 1px solid #ddd;
      padding: 10px;
      margin: 10px;
    }
    .weather-box h3 {
      text-transform: uppercase;
      font-weight: bold;
    }
    .outlook-message {
  text-align: center;
    }
  </style>
</head>
<body>
  <h1>Barcelona Weather Forecast</h1>

  @if (isset($data['hourly']))
    @foreach ([4, 24, 48] as $timeFrame)
      <div class="weather-box">
        <h3 class="outlook-message">{{ $timeFrame }} Hours Outlook</h3>
        @php
          $hourlyData = $data['hourly'];
          $rain = false;

          // Loop through the specified number of hours and check for rain
          for ($i = 0; $i < $timeFrame; $i++) {
            if (isset($hourlyData['rain'][$i]) && $hourlyData['rain'][$i] > 0) {
              $rain = true;
              break; // Exit loop if rain is found
            }
          }
        @endphp

        @if ($rain)
        <p class="outlook-message"><i class="fas fa-cloud-rain"></i> It is likely to rain within the next {{ $timeFrame }} hours.</p>
        @else
        <p class="outlook-message"><i class="fas fa-sun"></i> It is not likely to rain within the next {{ $timeFrame }} hours.</p>
        @endif
      </div>
    @endforeach
  @else
    <p>No data available for the next 72 hours.</p>
  @endif
</body>
</html>