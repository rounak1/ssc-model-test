const database = firebase.database();

const dateCustomize = (date, from = true) => {
  return from ? date.setHours(0, 0, 0, 0) : date.setHours(23, 59, 59, 999);
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

const sumEachUserQuiz = (quizes) => {
  let temp = {};
  let result = [];
  quizes.forEach(function (quiz) {
    if (!temp[quiz.user_id]) {
      temp[quiz.user_id] = { ...quiz, total_played: 1 };
    } else {
      const quizDay = dateFormat(quiz.created_at);
      const tempObjDay = dateFormat(temp[quiz.user_id].created_at);
      //ignored same day duplicate entry
      if (quizDay !== tempObjDay) {
        temp[quiz.user_id] = {
          ...quiz,
          total_marks: temp[quiz.user_id].total_marks + quiz.total_marks,
          quiz_complete_time:
            Number(temp[quiz.user_id].quiz_complete_time) +
            Number(quiz.quiz_complete_time),
          total_played: temp[quiz.user_id].total_played + 1,
        };
      }
    }
  });

  for (let key in temp) {
    result = [
      ...result,
      {
        ...temp[key],
        user_id: key,
      },
    ];
  }
  return result;
};

const renderParticipants = () => {
  const fromDate = dateCustomize(new Date());
  const toDate = dateCustomize(new Date(), false);
  const participantsEle = document.getElementsByClassName(
    "participants-information-body"
  )[0];
  let participantsContent = "";

  const quizRef = database.ref(`quiz_history`);
  const profileRef = database.ref(`profiles`);
  const snapshot = quizRef
    .orderByChild("created_at")
    .startAt(fromDate)
    .endAt(toDate)
    .on("value", (histories) => {
      let historyArray = [];
      let total_participant = 1;

      histories.forEach((history) => {
        historyArray = [...historyArray, { ...history.val() }];
      });

      historyArray.sort(function (a, b) {
        return (
          b.total_marks - a.total_marks ||
          a.quiz_complete_time - b.quiz_complete_time
        );
      });

      historyArray.slice(0, 30).forEach(async (sortedArray) => {
        const profile = await profileRef
          .child(sortedArray.user_id)
          .once("value");
        const combined = { ...sortedArray, ...profile.val() };

        $(".participants-information-body-1").append(`
        <tr><td>${getBanglaNumber(total_participant)}</td>  
        <td>${combined.name}</td>
        <td>${combined.occupation}</td>
        <td>${combined.district}</td>
        <td>${combined.upazila}</td></tr>
        `);
        total_participant += 1;
      });
    });
};

const renderAllParticipants = () => {
  const participantsEle = document.getElementsByClassName(
    "all-participants-information-body"
  )[0];
  $(".participants-information-body-2").html("");
  let participantsContent = "";

  const allquizRef = database.ref(`quiz_history`);
  const allprofileRef = database.ref(`profiles`);
  const allsnapshot = allquizRef
    .orderByChild("created_at")
    .once("value", (histories) => {
      let historyArray = [];
      let total_participant = 1;

      histories.forEach((history) => {
        historyArray = [...historyArray, { ...history.val() }];
      });

      const sumEachUser = sumEachUserQuiz(historyArray);

      sumEachUser.sort(function (a, b) {
        return (
          b.total_marks - a.total_marks ||
          a.quiz_complete_time - b.quiz_complete_time
        );
      });

      sumEachUser.slice(0, 100).forEach(async (sortedArray) => {
        const profile = await allprofileRef
          .child(sortedArray.user_id)
          .once("value");
        const combined = { ...sortedArray, ...profile.val() };

        $(".participants-information-body-2").append(`
          <tr><td>${getBanglaNumber(total_participant)}</td>  
          <td>${combined.name}</td>
          <td>${combined.occupation}</td>
          <td>${combined.district}</td>
          <td>${combined.upazila}</td></tr>
        `);

        total_participant += 1;
      });
    });
};

const dashboardHistory = document.getElementsByClassName("dashboard-history");
$(dashboardHistory).click(function () {
  var clickedData = $(this).attr("data");
  if (clickedData == "tab2") {
  	$('.leaderboard-tab .tab1').removeClass('active');
  	$('.leaderboard-tab .tab2').addClass('active');
  	$('.leaderboard-container .tab2').css({'display':'block'});
  	$('.leaderboard-container .tab1').css({'display':'none'});
    renderAllParticipants();
  }else{
  	$('.leaderboard-tab .tab2').removeClass('active');
  	$('.leaderboard-tab .tab1').addClass('active');
  	$('.leaderboard-container .tab2').css({'display':'none'});
  	$('.leaderboard-container .tab1').css({'display':'block'});
  }
});

renderParticipants();