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
      padding: 20px;
      margin: 40px;
      background-color: rgba(255, 255, 255, 0.3); /* Add a semi-transparent white background for better readability */
    }
    .weather-box h3 {
      /* text-transform: uppercase; */
      font-weight: bold;
    }
    .outlook-message {
      text-align: center;
      line-height: 50px; /* Set the line height to match the dot size */
    }
    .green-dot {
      color: green;
      font-size: 50px; /* Adjust the size of the dot as needed */
      vertical-align: -11px; /* Align the dots vertically with the text */
    }
    .red-dot {
      color: red;
      font-size: 50px; /* Adjust the size of the dot as needed */
      vertical-align: -11px; /* Align the dots vertically with the text */
    }
    /* Style for real-time date and time */
    #datetime {
      position: absolute;
      top: 55px;
      right: 180px;
      font-size: 15px;
    }
    /* Style for city selector */
    #citySelector {
      position: absolute;
      top: 55px;
      right: 310px;
      font-size: 15px;
    }
  </style>
</head>
<body>
  <!-- Real-time date and time -->
  <div id="datetime"></div>

<!-- City selector -->
<select id="citySelector">
  @foreach ($europeanCities as $country => $cities)
      @foreach ($cities as $city => $coordinates)
          <option value="{{ $coordinates['latitude'] }},{{ $coordinates['longitude'] }}">{{ $city }}, {{ $country }}</option>
      @endforeach
  @endforeach
</select>

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

  <script>
    // Update date and time in real-time
    function updateTime() {
      var now = new Date();
      var datetimeElement = document.getElementById('datetime');
      datetimeElement.textContent = now.toLocaleString();
    }

    // Call updateTime function initially and then every second
    updateTime(); // Initial call
    setInterval(updateTime, 1000); // Update every second

    // Handle city selector change event
    document.getElementById('citySelector').addEventListener('change', function() {
      var selectedValue = this.value;
      var coordinates = selectedValue.split(',');
      var latitude = coordinates[0];
      var longitude = coordinates[1];

      // Redirect to the weather endpoint with new coordinates
      window.location.href = '/weather?latitude=' + latitude + '&longitude=' + longitude;
    });
  </script>
</body>
</html>
