let $court, $date, $deporte, $hours;
let iRadio;
const noHoursAlert = `<div class="alert alert-danger" role="alert">
    <strong>Lo sentimos!</strong> No se encontraron horas disponibles para la cancha seleccionada.!
</div>`;

 $(function (){
      $deporte = $('#deporte');
      $court = $('#court');
      $date = $('#date');
      $hours = $('#hours');

      $deporte.change(() => {
      const deporteId = $deporte.val();
      const url = `/deportes/${deporteId}/courts`;
      $.getJSON(url, onCourtsLoaded); 
    });

      $court.change(loadHours);
      $date.change(loadHours);
});
  
 function onCourtsLoaded(courts){
        let htmlOptions = '';
        courts.forEach(court =>{
          htmlOptions +=`<option value="${court.id}">${court.name}</option>`;
        });
        $court.html(htmlOptions);
        loadHours();
}
 function loadHours(){
 	const selectDate = $date.val();
 	const courtId = $court.val();
 	const url = `/schedule/hours?date=${selectDate}&court_id=${courtId}`;
    $.getJSON(url, displayHours); 
}

function displayHours(data){
 	if(!data.morning && !data.afternoon){
 		$hours.html(noHoursAlert);
 		return;
 	}

 	let htmlHours = '';
 	iRadio = 0;

 	if(data.morning) {
 		const morning_intervals =  data.morning;
 		morning_intervals.forEach(interval =>{
 			htmlHours += getRadioIntervalHtml(interval);
 		});
 	}
 	if(data.afternoon){
 		const afternoon_intervals =  data.afternoon;
 		afternoon_intervals.forEach(interval =>{
 			htmlHours += getRadioIntervalHtml(interval);
 		});
 	}
 	$hours.html(htmlHours);
 }
function getRadioIntervalHtml(interval) {
	const text = `${interval.start} - ${interval.end}`;

	return `<div class="custom-control custom-radio mb-3">
  <input name="schedule_time" value="${interval.start}" class="custom-control-input" id="interval${iRadio}" type="radio"  required>
  <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
</div>`;
}