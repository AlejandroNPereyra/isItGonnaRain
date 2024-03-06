<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <title>Is It Gonna Rain?</title>
  <style>
    /* Add some basic styling for a weather theme */
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; /* Change font family to a generic sans-serif font */
      background-image: url('isItGonnaRain.png');
      background-size: cover;
      background-position: center;      
      color: #333; /* Set font color to a dark color for better readability */
      padding: 10px; /* Add padding to body for better spacing */
    }
    h1 {
      text-align: center;
      margin-bottom: 20px; /* Add margin at the bottom of h1 for better spacing */
    }
    .weather-box {
      border: 1px solid #ddd;
      padding: 25px;
      margin: 40px;
      background-color: rgba(255, 255, 255, 0.3); /* Add a semi-transparent white background for better readability */
    }
    .weather-box h3 {
      /* text-transform: uppercase; */
      font-weight: bold;
    }
    .outlook-message {
      text-align: center;
    }
    .green-dot {
      color: green;
      font-size: 50px; /* Adjust the size of the dot as needed */
    }
    .red-dot {
      color: red;
      font-size: 50px; /* Adjust the size of the dot as needed */
    }
  </style>
</head>
<body>
  <h1>Is It Gonna Rain?</h1>

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
        <p class="outlook-message"><span class="red-dot">&#8226;</span> It is likely to rain within the next {{ $timeFrame }} hours.</p>
        @else
        <p class="outlook-message"><span class="green-dot">&#8226;</span> It is not likely to rain within the next {{ $timeFrame }} hours.</p>
        @endif
      </div>
    @endforeach
  @else
    <p>No data available for the next 72 hours.</p>
  @endif
  
</body>
</html>
