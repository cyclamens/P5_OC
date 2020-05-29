class Meteo{
	constructor(){
		this.button = document.getElementById("button");
		this.inputValue = document.getElementById("inputValue");
		this.desc = document.getElementById("desc");
		this.temp = document.getElementById("temp");
		this.icon = document.getElementById("wi");

		
		this.bindEvent();
		
	}//Fin du contructor


	afficheTemps(){
		var weatherIcons = {
			"Rain" : "wi wi-day-rain",
			"Clouds" : "wi wi-day-cloudy",
			"Clear" : "wi wi-day-sunny",
			"Snow" : "wi wi-day-snow",
			"mist" : "wi wi-day-fog",
			"Drizzle" : "wi wi-day-sleet",
		}
		fetch('https://api.openweathermap.org/data/2.5/weather?q='+this.inputValue.value+'&appid=95e39b9afaaf95c46301bb3620c5ff8e&lang=fr&units=metric')
	
		.then(response => response.json())
		.then(data => {
		
		var tempValue = data['main']['temp'];
		var descValue = data['weather'][0]['description'];
		var conditions = data['weather'][0]['main'];

		temp.innerHTML = Math.round(tempValue);
		desc.innerHTML = this.capitalize(descValue);
		this.icon.className = weatherIcons[conditions];

		document.body.className = conditions.toLowerCase();

		})

	}

	capitalize(str){
		return str[0].toUpperCase() + str.slice(1);
	}

	bindEvent(){
		this.button.addEventListener('click', () => {
			this.afficheTemps();
			
		})
	}

}//Fin de la class











