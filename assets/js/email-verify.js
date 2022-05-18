toastr.options = {
  closeButton: true,
  timeOut: "7000",
  extendedTimeOut: "0",
};
// Server
const firebaseConfig = {
  apiKey: "AIzaSyD8qQCweeSGCWZYA9BrBMwACfgVuvIzxbU",
  authDomain: "zabivaka-prod.firebaseapp.com",
  databaseURL: "https://zabivaka-prod.firebaseio.com",
  projectId: "zabivaka-prod",
  storageBucket: "zabivaka-prod.appspot.com",
  messagingSenderId: "580184843548",
  appId: "1:580184843548:web:83d0e7ef276158a79e86d9",
  measurementId: "G-T8BXGZSL5R"
};

// local
// const firebaseConfig = {
//   apiKey: "AIzaSyDGMzUA1sCYV3eSFphVBtdRAMnHuYttjkY",
//   authDomain: "sample-project-1-bf9ae.firebaseapp.com",
//   databaseURL: "https://sample-project-1-bf9ae.firebaseio.com",
//   projectId: "sample-project-1-bf9ae",
//   storageBucket: "sample-project-1-bf9ae.appspot.com",
//   messagingSenderId: "640050135477",
//   appId: "1:640050135477:web:8c1ba22825ac1e2a3e99fc",
//   measurementId: "G-2VP793F89X"
// };

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const database = firebase.database();
const auth = firebase.auth();
const params = new URLSearchParams(window.location.search);
const errorMessage = document.getElementsByClassName("error-message")[0];
const sucessMessage = document.getElementsByClassName("success-message")[0];

if (params.get("mode") && params.get("oobCode")) {
  auth
    .applyActionCode(params.get("oobCode"))
    .then((response) => {
      sucessMessage.innerHTML = `
      <h3>আপনার ইমেল সফলভাবে যাচাই করা হয়েছে।</h3> 
      <div class="click-wrapper">প্রোফাইল তৈরি করার জন্য 
      <a href="profile-create.html" class="click-here">এখানে</a> ক্লিক করুন।
      </div>`;
      sucessMessage.style.display = "block";
    })
    .catch((e) => {
      console.log(e);
      errorMessage.innerHTML = "আপনার কোড টি সঠিক নয়!";
      errorMessage.style.display = "block";
    });
}
