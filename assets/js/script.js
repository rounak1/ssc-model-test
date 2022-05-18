// const database = firebase.database();
// const auth = firebase.auth();
var tiktik;
var focusDocument;
const quizStartButton = document.getElementById("start_exam_container");
const accomplishmentElement = document.getElementById("accomplishTime");
const questionsLength = 20;
const startHourMin = new Date().setHours(11, 00, 00);
const endHourMin = new Date().setHours(11, 50, 00);
const startHour = 11;
const endMin = 50;

const getBanglaNumber = (str) => {
  let banglaNumber = {
    0: "০",
    1: "১",
    2: "২",
    3: "৩",
    4: "৪",
    5: "৫",
    6: "৬",
    7: "৭",
    8: "৮",
    9: "৯",
    "-": "/",
  };
  for (var x in banglaNumber) {
    str = str.toString().replace(new RegExp(x, "g"), banglaNumber[x]);
  }
  return str;
};

const dateFormat = (date) => {
  const dateObj = new Date(date);
  return (
    dateObj.getFullYear() +
    "-" +
    (dateObj.getMonth() + 1) +
    "-" +
    dateObj.getDate()
  );
};

const currentDate = () => {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  var yyyy = today.getFullYear();

  today = yyyy + "-" + mm + "-" + dd;

  return today;
};

const dateCustomize = (date, from = true) => {
  return from ? date.setHours(0, 0, 0, 0) : date.setHours(23, 59, 59, 999);
};

function shuffle(a) {
  const length = a.length;
  for (let i = length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [a[i], a[j]] = [a[j], a[i]];
  }
  return a;
}

const countdown = () => {
  var timeleft = 900;
  var original_time = timeleft;
  tiktik = setInterval(function () {
    if (timeleft <= 0) {
      clearInterval(tiktik);
      // console.log("Tiome Over");
      // return false;
      // $("#exam_submit").submit();
      document.getElementById("submit_form").submit();
    } else {
      var min = parseInt(timeleft / 60);
      var seconds = timeleft % 60;
      var timeCalculate =
        getBanglaNumber(min) +
        " মিনিট " +
        getBanglaNumber(seconds) +
        " সেকেন্ডস";
      document.getElementById("countdown").innerHTML = timeCalculate;
      console.log(original_time - timeleft);
      document.getElementById("examAttendentTime").innerHTML = original_time - timeleft;
  
    }
    timeleft -= 1;
  }, 1000);
};

countdown();
