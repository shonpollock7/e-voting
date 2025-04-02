const form = document.querySelector(".form form"),
  submitbtn = form.querySelector(".btn .button"),
  errortxt = form.querySelector(".result");

form.onsubmit = (e) => {
  e.preventDefault(); //stops the default action
};
submitbtn.onclick = () => {
  // start ajax

  let xhr = new XMLHttpRequest(); //create xml object
  xhr.open("POST", "./php/loginotp.php", true);
  xhr.onload = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;
        if (data == "success") {
          window.location.href = "./Dashboard/dashboard.php";
          return false;
        } else {
          errortxt.textContent = data;
          errortxt.style.display = "block";
        }
      }
    }
  };
  let formData = new FormData(form);
  xhr.send(formData);
};
