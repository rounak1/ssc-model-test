const database = firebase.database();
const auth = firebase.auth();
const params = new URLSearchParams(window.location.search);
const errorMessage = document.getElementsByClassName("error-message")[0];
const sucessMessage = document.getElementsByClassName("success-message")[0];
const resetPassword = document.getElementsByClassName("reset-password")[0];

const code = params.get("oobCode");
const mode = params.get("mode");

if (mode === "resetPassword" && code) {
  resetPassword.style.display = "flex";

  document.getElementsByTagName("title")[0].innerHTML =
    "Prothom Alo Quiz :: Reset Password";
  const submitButton = document.getElementById("new-password_form_submit");
  submitButton.addEventListener("submit", (event) => {
    event.preventDefault();
    const submitButton = document.querySelector("#login-button");
    const submitButtonContent = submitButton.querySelector(".content");
    const submitButtonLoader = submitButton.querySelector(".loader");

    const formData = $("form").serializeArray();
    const password = formData["0"]["value"];
    const confirmPassword = formData["1"]["value"];
    if (password !== confirmPassword) {
      toastr.error("পাসওয়ার্ড ও পুনরায় পাসওয়ার্ড ফিল্ড মিলে নাই");
      return;
    }
    submitButton.style["pointer-events"] = "none";
    submitButtonContent.style.display = "none";
    submitButtonLoader.style.display = "block";
    auth
      .confirmPasswordReset(code, password)
      .then(function () {
        resetPassword.style.display = "none";
        sucessMessage.innerHTML = `
        <h3>আপনার পাসওয়ার্ড পরিবর্তন সফলভাবে সম্পূর্ণ হয়েছে।</h3> 
        <div class="click-wrapper">লগইন করার জন্য 
        <a href="login.html" class="click-here">এখানে</a> ক্লিক করুন।
        </div>`;
        sucessMessage.style.display = "block";
        submitButtonContent.style.display = "block";
        submitButtonLoader.style.display = "none";
        submitButton.style["pointer-events"] = "auto";
      })
      .catch(function (error) {
        if (error.code.includes("auth/user-not-found")) {
          toastr.error("আপনার ইমেইল খুঁজে পাওয়া যায়নি!");
        } else if (error.code.includes("auth/user-disabled")) {
          toastr.error("আপনার ইমেইল ব্লক করা আছে");
        } else {
          toastr.error("আপনার কোড টি সঠিক নয়!");
        }
        submitButtonContent.style.display = "block";
        submitButtonLoader.style.display = "none";
        submitButton.style["pointer-events"] = "auto";
      });
  });
} else if (mode === "verifyEmail" && code) {
  document.getElementsByTagName("title")[0].innerHTML =
    "Prothom Alo Quiz :: Email Verify";
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
      errorMessage.innerHTML = "আপনার কোড টি সঠিক নয়!";
      errorMessage.style.display = "block";
    });
} else {
  window.location.href = "login.html";
}

const renderLogo = () => {
  $("#logo").html(
    '<a class="navbar-brand" href="index.html"><img src="logo.svg" class="logo"></a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation"><span class="oi oi-menu"></span> মেনু</button>'
  );
};

const renderFooter = () => {
  $("#footer").html(
    '<footer class="ftco-footer ftco-bg-dark ftco-section"><div class="container"><div class="row"><div class="col-md-6 footer-logo"><a href="https://www.prothomalo.com" target="_blank"><img src="https://assets.prothomalo.com/prothomalo/assets/palo-bangla-bb996cdb70d2e0ccec8c.svg"></a></div><div class="col-md-6 footer-copyright"><p>স্বত্ব &copy; প্রথম আলো ২০২০</p></div></div></div></footer>'
  );
};

const renderNavBar = () => {
  auth.onAuthStateChanged(function (user) {
    if (user && user.emailVerified) {
      $("#ftco-nav").html(
        '<ul class="navbar-nav ml-auto"><li class="nav-item active"><a class="nav-link" href="index.html">হোমপেজ</a></li><li class="nav-item active"><a class="nav-link" href="leaderboard.html">লিডারবোর্ড</a></li><li class="nav-item active"><a class="nav-link" href="faq.html">ব্যবহারবিধি</a></li><li class="nav-item active"><a class="nav-link" href="myprofile.html">প্রোফাইল</a></li><li class="nav-item cta"><a class="nav-link" href="logout.html"><span>লগ আউট</span></a></li></ul>'
      );
    } else {
      $("#ftco-nav").html(
        '<ul class="navbar-nav ml-auto"><li class="nav-item active"><a class="nav-link" href="index.html">হোমপেজ</a></li><li class="nav-item active"><a class="nav-link" href="leaderboard.html">লিডারবোর্ড</a></li><li class="nav-item active"><a class="nav-link" href="faq.html">ব্যবহারবিধি</a></li><li class="nav-item cta"><a class="nav-link" href="login.html"><span>লগইন</span></a></li></ul>'
      );
    }
  });
};

renderNavBar();
renderLogo();
renderFooter();
