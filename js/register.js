const form = document.querySelector(".form form"),
  submitbtn = form.querySelector(".submit input"),
  errortxt = form.querySelector(".error-text");

// console.log(spinner);
form.onsubmit = (e) => {
  e.preventDefault(); //stops the default action
};

submitbtn.onclick = () => {
  // start ajax
  let xhr = new XMLHttpRequest(); // create xml object
  xhr.open("POST", "./php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data == "success") {
          window.location.href = "./verify.php";
          return false;
        } else {
          errortxt.textContent = data;
          errortxt.style.display = "block";
        }
      }
    }
  };

  // send data through ajax to php
  let formData = new FormData(form); //creating new object from form data
  xhr.send(formData); //sending data to php
};
