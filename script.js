document
  .querySelector(".form-container")
  .addEventListener("submit", function (e) {
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const linkedin = document.getElementById("linkedin").value.trim();
    const photo = document.getElementById("photo").files[0];

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^[0-9]{10}$/;
    const linkedinPattern = /^https?:\/\/(www\.)?linkedin\.com\/.*$/;

    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      e.preventDefault();
      return;
    }

    if (!phonePattern.test(phone)) {
      alert("Please enter a valid 10-digit phone number.");
      e.preventDefault();
      return;
    }

    if (!linkedinPattern.test(linkedin)) {
      alert("Please enter a valid LinkedIn profile URL.");
      e.preventDefault();
      return;
    }

    if (photo && photo.size > 1024 * 1024) {
      alert("Image must be 1MB or smaller.");
      e.preventDefault();
      return;
    }
  });
