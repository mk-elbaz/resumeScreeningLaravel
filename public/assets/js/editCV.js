document.addEventListener("DOMContentLoaded", function () {
  const showProfileLink = document.querySelector("#showProfileLink");
  showProfileLink.classList.remove("collapsed");
  const dashboardLink = document.querySelector("#dashboardLink");
  dashboardLink.classList.add("collapsed");
  const editCVButton = document.querySelector("#editCVButton");
  const data = editCVButton.dataset.careerlevel;

  console.log("data ");

  editCVButton.onclick = (e) => {
    const options = document.querySelectorAll("option");
    options.forEach((option) => {
      option.innerHTML == data ? (option.selected = true) : null;
    });
  };
  
});
