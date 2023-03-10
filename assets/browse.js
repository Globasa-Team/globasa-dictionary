function filterBrowse() {
  var letter, category;
  
  let letterElement = document.querySelector(`[name="letter"]:checked`);
  if (letterElement != null && letterElement.value != "all") {
    letter = letterElement.value;
  } else {
    letter = null;
  }
  let categoryElement = document.querySelector(`[name="category"]:checked`);
  if (categoryElement != null && categoryElement.value != "all") {
    category = categoryElement.value;
  } else {
    category = null;
  }

  let elements = document.querySelectorAll('dt,dd');
  for(var i=0, len = elements.length; i <  len; i++) {
    if (category && elements[i].getAttribute("data-category") !== category) {
      elements[i].style.display = "none";
    }
    else if (letter && elements[i].getAttribute("data-char") !== letter) {
      elements[i].style.display = "none";
    }
    else {
      elements[i].style.display = "block";
    }
  }
}


document.addEventListener('DOMContentLoaded', (event) => {
  document.querySelectorAll("input[name='letter']").forEach((input) => {
    input.addEventListener('change', filterBrowse);
  });

  document.querySelectorAll("input[name='category']").forEach((input) => {
    input.addEventListener('change', filterBrowse);
  });
});