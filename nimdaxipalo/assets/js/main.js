// server
// var firebaseConfig = {
//   apiKey: "AIzaSyD8qQCweeSGCWZYA9BrBMwACfgVuvIzxbU",
//   authDomain: "zabivaka-prod.firebaseapp.com",
//   databaseURL: "https://zabivaka-prod.firebaseio.com",
//   projectId: "zabivaka-prod",
//   storageBucket: "zabivaka-prod.appspot.com",
//   messagingSenderId: "580184843548",
//   appId: "1:580184843548:web:83d0e7ef276158a79e86d9",
//   measurementId: "G-T8BXGZSL5R",
// };

// local
// const firebaseConfig = {
//   apiKey: "AIzaSyDGMzUA1sCYV3eSFphVBtdRAMnHuYttjkY",
//   authDomain: "sample-project-1-bf9ae.firebaseapp.com",
//   databaseURL: "https://sample-project-1-bf9ae.firebaseio.com",
//   projectId: "sample-project-1-bf9ae",
//   storageBucket: "sample-project-1-bf9ae.appspot.com",
//   messagingSenderId: "640050135477",
//   appId: "1:640050135477:web:8c1ba22825ac1e2a3e99fc",
//   measurementId: "G-2VP793F89X",
// };
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
var database = firebase.database();

const todayDate = () => {
  const today = new Date();
  const date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  return date;
};

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

const currentDate = () => {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  var yyyy = today.getFullYear();

  today = yyyy + "-" + mm + "-" + dd;

  return today;
};

const getloggedData = localStorage.getItem("key");
if (getloggedData != "quizValidate") {
  window.location.href = "index.html";
}

const submitButton = document.getElementById("form_submit");
$(submitButton).submit(function (event) {
  event.preventDefault();
  const formData = $("form").serializeArray();
  let date = "";
  let question = "";
  let answer = "";
  let option1 = "";
  let option2 = "";
  let option3 = "";
  let option4 = "";
  let schema = {};
  formData.forEach(function (data) {
    if (data.name === "date" && data.value !== "") {
      schema = { ...schema, date: data.value };
    }
    if (data.name === "question" && data.value !== "") {
      schema = { ...schema, question: data.value };
    }
    if (data.name === "answer" && data.value !== "") {
      schema = { ...schema, answer: data.value };
    }
    if (data.name === "option1" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
    if (data.name === "option2" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
    if (data.name === "option3" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
    if (data.name === "option4" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
  });

  if (!schema.question) {
    toastr.error("Please write the question");
    return;
  }
  if (!schema.answer) {
    toastr.error("Please select the answer option");
    return;
  }
  if (schema.options.length < 2) {
    toastr.error("please give at least 2 option");
    return;
  }
  const timeStamp = new Date().getTime();

  schema = { ...schema, created_at: timeStamp, updated_at: timeStamp };

  var quizRef = database.ref(`questions`);

  quizRef.push(schema, function (error) {
    if (error) {
      toastr.error(error);
      return;
    }
    $(submitButton)[0].reset();
    toastr.success("Quiz has been successfully saved");
  });
});

const submitEditButton = document.getElementById("form_submit_update");
$(submitEditButton).submit(function (event) {
  event.preventDefault();
  const formData = $("form").serializeArray();
  let date = "";
  let question = "";
  let answer = "";
  let option1 = "";
  let option2 = "";
  let option3 = "";
  let option4 = "";
  let schema = {};
  formData.forEach(function (data) {
    if (data.name === "created_at" && data.value !== "") {
      schema = { ...schema, created_at: parseInt(data.value) };
    }
    if (data.name === "date" && data.value !== "") {
      schema = { ...schema, date: data.value };
    }
    if (data.name === "question" && data.value !== "") {
      schema = { ...schema, question: data.value };
    }
    if (data.name === "answer" && data.value !== "") {
      schema = { ...schema, answer: data.value };
    }
    if (data.name === "option1" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
    if (data.name === "option2" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
    if (data.name === "option3" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
    if (data.name === "option4" && data.value !== "") {
      schema = { ...schema, options: [...(schema.options || []), data.value] };
    }
  });

  if (!schema.question) {
    toastr.error("Please write the question");
    return;
  }
  if (!schema.answer) {
    toastr.error("Please select the answer option");
    return;
  }
  if (schema.options.length < 2) {
    toastr.error("please give at least 2 option");
    return;
  }
  const timeStamp = new Date().getTime();

  schema = { ...schema, updated_at: timeStamp };

  const quiz_id = $("#quiz_id").val();
  var quizRef = database.ref(`questions/${quiz_id}`);

  quizRef.set(schema, function (error) {
    if (error) {
      toastr.error(error);
      return;
    }
    toastr.success("Quiz has been successfully updated");
  });
});

const searchSubmitButton = document.getElementById("submit_search");
$(searchSubmitButton).click(function () {
  const searchBydate = $("#search_by_date").val();
  renderSearchQuiz(searchBydate);
});

const renderSearchQuiz = async (searchBydate) => {
  if (searchBydate) {
    const fromDate = searchBydate;
    const toDate = searchBydate + " 23:59:59";

    const quizRef = database.ref(`questions`);
    try {
      $("#contentData").html("");
      const snapshot = await quizRef
        .orderByChild("date")
        .startAt(fromDate)
        .endAt(toDate)
        .once("value");
      if (snapshot.exists()) {
        var content = "";
        snapshot.forEach(function (data) {
          var val = data.val();
          content += "<tr>";
          //content += "<td>" + dateFormat(val.created_at) + "</td>";
          content += "<td>" + val.date + "</td>";
          content += "<td>" + val.question + "</td>";
          content += "<td>" + val.answer + "</td>";
          val.options.forEach((option) => {
            content += "<td>" + option + "</td>";
          });

          content +=
            '<td><a class="edit" href="quiz-edit.html?id=' +
            data.key +
            '">Edit</a><a class="delete" href="quiz-delete.html?id=' +
            data.key +
            '"" onclick="return confirm(`Are you sure?`)">Delete</a></td>';
          content += "</tr>";
        });
        $("#contentData").html(content);
      }
    } catch (error) {
      console.log(error);
    }
  } else {
    toastr.error("please provide date to get data");
  }
};

const renderQuiz = async () => {
  //const fromDate = dateCustomize(new Date());
  //const toDate = dateCustomize(new Date(), false);

  const fromDate = todayDate();
  const quizRef = database.ref(`questions`);
  try {
    const snapshot = await quizRef
      .orderByChild("date")
      .limitToLast(100)
      // .startAt(fromDate)
      .once("value");
    if (snapshot.exists()) {
      var content = "";
      snapshot.forEach(function (data) {
        var val = data.val();
        content += "<tr>";
        content += "<td>" + val.date + "</td>";
        content += "<td>" + val.question + "</td>";
        content += "<td>" + val.answer + "</td>";
        content += "<td>" + val.options[0] + "</td>";
        content += "<td>" + val.options[1] + "</td>";
        content += "<td>" + val.options[2] + "</td>";
        content += "<td>" + val.options[3] + "</td>";
        content +=
          '<td><a class="edit" href="quiz-edit.html?id=' +
          data.key +
          '">Edit</a><span class="bar">|</span><a class="delete" href="quiz-delete.html?id=' +
          data.key +
          '"" onclick="return confirm(`Are you sure?`)">Delete</a></td>';
        content += "</tr>";
      });
      $("#contentData").html(content);
    }
  } catch (error) {
    console.log(error);
  }
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

      historyArray.forEach(async (sortedArray) => {
        const profile = await profileRef
          .child(sortedArray.user_id)
          .once("value");
        const combined = { ...sortedArray, ...profile.val() };

        $(".participants-information-body-1").append(`
        <tr><td>${total_participant}</td>  
        <td>${combined.name} (${combined.email})</td>
        <td>${combined.phone}</td>
        <td>${combined.wallet}</td>
        <td>${combined.total_marks}</td>
        <td>${combined.quiz_complete_time}</td></tr>
        `);
        total_participant += 1;
      });
    });
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

      sumEachUser.slice(0, 50).forEach(async (sortedArray) => {
        const profile = await allprofileRef
          .child(sortedArray.user_id)
          .once("value");
        const combined = { ...sortedArray, ...profile.val() };

        $(".participants-information-body-2").append(`
          <tr><td>${total_participant}</td>  
          <td>${combined.name} (${combined.email})(${combined.total_played})</td>
          <td>${combined.phone}</td>
          <td>${combined.wallet}</td>
          <td>${combined.total_marks}</td>
          <td>${combined.quiz_complete_time}</td></tr>
        `);

        total_participant += 1;
      });
    });
};

const setQuizdataForUpdate = (id) => {
  database
    .ref(`questions/${id}`)
    .once("value")
    .then(function (snap) {
      const data = snap.val();
      $("#date").val(data.date);
      $("#question").val(data.question);
      data.options.forEach((option, index) => {
        $(`#option${index + 1}`).val(option);
      });
      $("input[name=answer][value=" + data.answer + "]").attr(
        "checked",
        "checked"
      );
      $("#quiz_id").val(id);
      $("#created_at").val(data.created_at);
    });
};

const setQuizdelete = (id) => {
  let quizRef = database.ref("questions/" + id);
  if (quizRef.remove()) {
    toastr.success("Quiz has been successfully updated");
    setTimeout(function () {
      window.location.href = "quiz.html";
    }, 1000);
  } else {
    toastr.error("Something wrong");
  }
};

const dashboardHistory = document.getElementsByClassName("dashboard-history");
$(dashboardHistory).click(function () {
  var clickedData = $(this).attr("data");
  if (clickedData == "tab2") {
    renderAllParticipants();
  }
});

if (document.URL.includes("home.html")) {
  renderAllRegistration();
}

if (document.URL.includes("quiz.html")) {
  const searchEle = document
    .getElementById("search_by_date")
    .setAttribute("placeholder", `Search by date ${todayDate()}`);
  renderQuiz();
}

if (document.URL.includes("quiz-edit.html")) {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const id = urlParams.get("id");
  setQuizdataForUpdate(id);
}

if (document.URL.includes("quiz-delete.html")) {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const id = urlParams.get("id");
  setQuizdelete(id);
}

if (document.URL.includes("participants.html")) {
  renderParticipants();
}
