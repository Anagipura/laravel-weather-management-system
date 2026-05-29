$(document).ready(function () {
    var userLocation;
    var temperature;
    var description;
    var humidity;
    var windSpeed;
    var country;

    liveTime();
    function fetchWeather() {
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function(position) {

                let lat = position.coords.latitude;
                let lon = position.coords.longitude;

                $.ajax({
                    url: '/weather-data',
                    method: "GET",
                    dataType: 'json',
                    data: {
                        latitude: lat,
                        longitude: lon
                    },

                    success: function(response) {
                        console.log('Data Retrieved');
                        if (response.error) {
                            $('#weather_status').text(response.error);
                            return;
                        } else {
                            updateWeatherUi(response);
                        }
                    },

                    error: function() {
                        $('#weather_status').text("Server error");
                    }
                });

            }, function() {
                $('#weather_status').text("Location permission denied");
            });

        } else {
            alert("Geolocation not supported");
        }
    }

    // initial load
    fetchWeather();

    function updateWeatherUi(data) {

        country = data.sys.country;
        userLocation = data.name;
        temperature = data.main.temp;
        humidity = data.main.humidity;
        windSpeed = data.wind.speed;
        description = data.weather[0].description;

        $('#location_name').text(userLocation);
        $('#temperature').text(temperature + ' °C');
        $('#humidity').text(humidity + ' %');
        $('#wind_speed').text(windSpeed + ' m/s');
        $('#weather_condition').text(description);
        $('#weather_status').text('Weather data updated successfully.');

    }
    // auto refresh every 10s
    setInterval(fetchWeather, 60000);

    $('#refreshWeather').on('click', function () {
        $('#weather_status').text('Loading Weather Data...');
       fetchWeather();
    });


    function liveTime() {
        const dateInfo = new Date();

        document.getElementById('liveTime').innerHTML = dateInfo.toLocaleTimeString();
    }
    setInterval(liveTime,1000);

    // chat bot management

    // get the input box value
    //const toggleBtn = document.getElementById('chatbot-toggle');
    const chatbot = document.getElementById('chatbot-container');
    //const sendBtn = document.getElementById('chatbot-send');
    const inputField = document.getElementById('chatbot-input');
    const messages = document.getElementById('chatbot-messages');
    // send the value string to the bot via a .... request

    $('#chatbot-toggle').on('click', function() {
        chatbot.style.display = chatbot.style.display === 'flex' ? 'none' : 'flex';
    });
    $('#chatbot-send').on('click', function () {
        botManager();
        messages.scrollTop = messages.scrollHeight;
    });

     function botManager() {
        const text = inputField.value.trim();
        if(!text) {
          return;
        }
        const userMsg = document.createElement('div');
        userMsg.className = 'message user-message';
        userMsg.textContent = text;
        messages.appendChild(userMsg);

        inputField.value = "";

         $.ajax({
             url: "/chatbot",
             method: 'POST',
             dataType: 'json',
             data: {
                 _token: $('meta[name="csrf-token"]').attr('content'),
                 message: text,
                 country: country,
                 temperature: temperature,
                 humidity: humidity,
                 weather_description: description,
                 city: userLocation,
                 wind_speed: windSpeed
             },
             success: function (response) {
                 const botMsg = document.createElement('div');
                 botMsg.className = "message bot-message";
                 botMsg.textContent = response.reply;
                 messages.appendChild(botMsg);
                 messages.scrollTop = messages.scrollHeight;
                 console.log("success");
             },
             error: function (xhr, status, error) {
                 const errorMsg = document.createElement('div');
                 errorMsg.className = "message bot-message error";
                 errorMsg.textContent =  xhr.responseJSON.reply;
                 messages.appendChild(errorMsg);
                 messages.scrollTop = messages.scrollHeight;
                 console.log("Bot response error!", error, status, xhr);
             }
         });

    }

});

