var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
canvas.style.display="none";
var videoStream = null;
var preLog = document.getElementById('preLog');
// Custom video filters
var iFilter = 0;
var filters = [
	'grayscale',
	'sepia',
	'blur',
	'brightness',
	'contrast',
	'hue-rotate',
	'hue-rotate2',
	'hue-rotate3',
	'saturate',
	'invert',
	'none'
	 ];

function log(text)
{
	if (preLog) preLog.textContent += ('\n' + text);
	else alert(text);
}

// Add event listener for our Button (to switch video filters)
document.querySelector('button').addEventListener('click', function() {
		video.className = '';
		canvas.className = '';
		var effect = filters[iFilter++ % filters.length]; // Loop through the filters.
		if (effect) {
				video.classList.add(effect);
				canvas.classList.add(effect);

				document.querySelector('.camera h3').innerHTML = effect;
		}
}, false);

function snapshot()
{
	canvas.width = video.videoWidth;
	canvas.height = video.videoHeight;
	canvas.getContext('2d').drawImage(video, 0, 0);
	var canvasData = canvas.toDataURL("image/png");
	$.ajax({
  type: "POST",
  url: "save.php",
  data: {
     canvasData: canvasData
  }
}).done(function(o) {
		console.log(o);
	});
	window.location.reload();
}

function noStream()
{
	log('L’accès à la caméra a été refusé !');
}

function stop()
{
	var myButton = document.getElementById('buttonStop');
	if (myButton) myButton.disabled = true;
	myButton = document.getElementById('buttonSnap');
	if (myButton) myButton.disabled = true;
	if (videoStream)
	{
		if (videoStream.stop) videoStream.stop();
		else if (videoStream.msStop) videoStream.msStop();
		videoStream.onended = null;
		videoStream = null;
	}
	if (video)
	{
		video.onerror = null;
		video.pause();
		if (video.mozSrcObject)
			video.mozSrcObject = null;
		video.src = "";
	}
	myButton = document.getElementById('buttonStart');
	if (myButton) myButton.disabled = false;
}

function gotStream(stream)
{
	var myButton = document.getElementById('buttonStart');
	if (myButton) myButton.disabled = true;
	videoStream = stream;
	video.onerror = function ()
	{
		log('video.onerror');
		if (video) stop();
	};
	stream.onended = noStream;
	if (window.webkitURL) video.src = window.webkitURL.createObjectURL(stream);
	else if (video.mozSrcObject !== undefined)
	{//FF18a
		video.mozSrcObject = stream;
		video.play();
	}
	else if (navigator.mozGetUserMedia)
	{//FF16a, 17a
		video.src = stream;
		video.play();
	}
	else if (window.URL) video.src = window.URL.createObjectURL(stream);
	else video.src = stream;
	myButton = document.getElementById('buttonSnap');
	if (myButton) myButton.disabled = false;
	myButton = document.getElementById('buttonStop');
	if (myButton) myButton.disabled = false;
}

function start()
{
	if ((typeof window === 'undefined') || (typeof navigator === 'undefined')) log('Cette page requiert un navigateur Web avec les objets window.* et navigator.* !');
	else if (!(video && canvas)) log('Erreur de contexte HTML !');
	else
	{
		if (navigator.getUserMedia) navigator.getUserMedia({video:true}, gotStream, noStream);
		else if (navigator.oGetUserMedia) navigator.oGetUserMedia({video:true}, gotStream, noStream);
		else if (navigator.mozGetUserMedia) navigator.mozGetUserMedia({video:true}, gotStream, noStream);
		else if (navigator.webkitGetUserMedia) navigator.webkitGetUserMedia({video:true}, gotStream, noStream);
		else if (navigator.msGetUserMedia) navigator.msGetUserMedia({video:true, audio:false}, gotStream, noStream);
		else log('getUserMedia() n’est pas disponible depuis votre navigateur !');
	}
}

start();
