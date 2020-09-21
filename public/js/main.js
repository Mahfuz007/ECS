
// Selectors
let examTime = document.querySelector('[name="_time"]').value;
const customTest = document.getElementById('custom-test');


//events
if (examTime) {
    examTime *= 1000;
    CountDown();
}


//methods
function addCustomTest() {
    const customField = document.getElementById('custom-field');
    if (customField.style.display == "none") customField.style.display = "block";
    else customField.style.display = "none";
    window.scrollTo(0,document.body.scrollHeight);
}

function CountDown() {
    var timer = setInterval(() => {

        var curr = new Date().getTime();
        var diff = examTime - curr;

        let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById("hours").innerHTML = (hours.toString().length == 1) ? "0" + `${hours}` : hours;
        document.getElementById("minutes").innerHTML = (minutes.toString().length == 1) ? "0" + `${minutes}` : minutes;
        document.getElementById("seconds").innerHTML = (seconds.toString().length == 1) ? "0" + `${seconds}` : seconds;
        if (diff <= 0) {
            clearInterval(timer);
            if (confirm('Exam has started. Please click on "ok" button to enter!')) {
                location.reload();
            }
        }
    }, 1000);
}
