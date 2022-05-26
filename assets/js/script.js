var tiktik;
var focusDocument;
const quizStartButton = document.getElementById("start_exam_container");
const accomplishmentElement = document.getElementById("accomplishTime");

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

const countdown = () => {
  var timeleft = 1800;
  var original_time = timeleft;
  focusDocument = setInterval(() => {
    //if user goes another tab or browser then form will automatically be submitted
    if (!document.hasFocus()) {
      document.getElementById("submit_form").submit();
      clearInterval(focusDocument);
    }
  }, 200);
  tiktik = setInterval(function () {
    if (timeleft <= 0) {
      clearInterval(tiktik);
      document.getElementById("submit_form").submit();
    } else {
      var min = parseInt(timeleft / 60);
      var seconds = timeleft % 60;
      var timeCalculate =
        getBanglaNumber(min) +
        ":" +
        getBanglaNumber(("0" + seconds).slice(-2));
      document.getElementById("countdown").innerHTML = timeCalculate;
      document.getElementById("examAttendentTime").innerHTML =
        original_time - timeleft;
    }
    timeleft -= 1;
  }, 1000);
};

countdown();

