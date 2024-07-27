

//calendar
let date = new Date();
let year = date.getFullYear();
let month = date.getMonth();

const day = document.querySelector(".calendar-dates");

const currdate = document
	.querySelector(".calendar-current-date");

const prenexIcons = document
	.querySelectorAll(".calendar-navigation span");

// Array of month names
const months = [
	"January",
	"February",
	"March",
	"April",
	"May",
	"June",
	"July",
	"August",
	"September",
	"October",
	"November",
	"December"
];

const manipulate = () => {

	
	let dayone = new Date(year, month, 1).getDay();

	let lastdate = new Date(year, month + 1, 0).getDate();

	let dayend = new Date(year, month, lastdate).getDay();

	let monthlastdate = new Date(year, month, 0).getDate();

	let lit = "";

	
	for (let i = dayone; i > 0; i--) {
		lit +=`<li class="inactive">${monthlastdate - i + 1}</li>`;
	}

	
	for (let i = 1; i <= lastdate; i++) {
	

		let isToday = i === date.getDate()
			&& month === new Date().getMonth()
			&& year === new Date().getFullYear()
			? "active"
			: "";
		lit += `<li class="${isToday}">${i}</li>`;
		
	}

	
	for (let i = dayend; i < 6; i++) {
		lit += `<li class="inactive">${i - dayend + 1}</li>`
	}

	
	currdate.innerText = `${months[month]} ${year}`;

	
	day.innerHTML = lit;

	
	document.querySelectorAll(".calendar-dates li").forEach(item => {
		item.addEventListener("click", (e) => {
			document.getElementById("eventDisplay").style.display="block";
			
			
		});
	});
}

manipulate();



  
// Attach a click event listener to each icon
prenexIcons.forEach(icon => {
   



	// When an icon is clicked
	icon.addEventListener("click", () => {

		// Check if the icon is "calendar-prev"
		// or "calendar-next"
		month = icon.id === "calendar-prev" ? month - 1 : month + 1;

		// Check if the month is out of range
		if (month < 0 || month > 11) {

			// Set the date to the first day of the 
			// month with the new year
			date = new Date(year, month, new Date().getDate());

			// Set the year to the new year
			year = date.getFullYear();

			// Set the month to the new month
			month = date.getMonth();
		}

		else {

			// Set the date to the current date
			date = new Date();
		}

		// Call the manipulate function to 
		// update the calendar display
		manipulate();
	});
});
0

//world clock

const timezones = [
	{ name: "India", offset: 5.5, id: "Asia/Kolkata" }, // UTC+5:30
	{ name: "Germany", offset: 1, id: "Europe/Berlin" }, // UTC+1 (CET)
	{ name: "China", offset: 8, id: "Asia/Shanghai" }, // UTC+8 (CST)
	{ name: "London", offset: 0, id: "Europe/London" }, // UTC+0 (GMT)
	{ name: "Canada", offset: -5, id: "America/Toronto" }, // UTC-5 (EST)
	{ name: "Australia", offset: 11, id: "Australia/Sydney" } // UTC+11 (AEST)
];

timezones.forEach((tz) => {
	const checkboxId = `${tz.name.toLowerCase()}Checkbox`;
	const clockId = `${tz.name.toLowerCase()}Clock`;
	
	if (tz.name.toLowerCase() === 'india') {
        $(`#${clockId}`).show();
        $(`#${checkboxId}`).prop('checked', true);
    } else {
        $(`#${clockId}`).hide();
    }
	$(`#${checkboxId}`).on('change', function() {
		

		if ($(this).is(':checked')) {
			$(`#${clockId}`).show();
		} else {
			$(`#${clockId}`).hide();
		}
	});

	setInterval(() => {
		const currentTime = new Date();
		const timezoneDate = new Date(currentTime.toLocaleString("en-US", { timeZone: tz.id }));
		const hours = timezoneDate.getHours();
		const minutes = timezoneDate.getMinutes();
		const seconds = timezoneDate.getSeconds();

		const hourDeg = (hours * 30) + (minutes * 0.5);
		const minuteDeg = (minutes * 6) + (seconds * 0.1);
		const secondDeg = seconds * 6;

		const clockContainer = document.getElementById(clockId);
		const hourHand = clockContainer.querySelector(`#${tz.name.toLowerCase()}Hour`);
		const minuteHand = clockContainer.querySelector(`#${tz.name.toLowerCase()}Minute`);
		const secondHand = clockContainer.querySelector(`#${tz.name.toLowerCase()}Second`);

		hourHand.style.transform = `rotate(${hourDeg}deg)`;
		minuteHand.style.transform = `rotate(${minuteDeg}deg)`;
		secondHand.style.transform = `rotate(${secondDeg}deg)`;
	}, 1000);
});


function updateTime() {
	const timezones = {
		'india-clock-digital': 'Asia/Kolkata',
		'germany-clock-digital': 'Europe/Berlin',
		'canada-clock-digital': 'America/Toronto',
		'australia-clock-digital': 'Australia/Sydney',
		'china-clock-digital': 'Asia/Shanghai',
		'london-clock-digital': 'Europe/London',
	};

	const options = { 
		year: 'numeric', month: 'numeric', day: 'numeric', 
		hour: '2-digit', minute: '2-digit', second: '2-digit', 
		hour12: true 
	};

	for (const [id, timezone] of Object.entries(timezones)) {
		const dateTime = new Date().toLocaleString('en-US', { ...options, timeZone: timezone });
		const date = dateTime.split(', ')[0]; // Extract the date
		const time = dateTime.split(', ')[1]; // Extract the time
	
		document.getElementById(id).innerText = `${date}\n${time}`;
	}
	
}

setInterval(updateTime, 1000);
updateTime();

