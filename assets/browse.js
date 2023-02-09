function filterBrowse() {
    var input, filter, table, tr, td, i, letter, category;
    
    let letterElement = document.querySelector(`[name="letter"]:checked`);
    if (letterElement != null) {
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
        // console.debug("Hide "+letter+elements[i].getAttribute("data-char"));
        elements[i].style.display = "none";
      }
      else {
        elements[i].style.display = "";
        // console.debug("Skip "+letter);
        // console.debug(elements[i]);
      }
    }

    /*
    let  = document.getElementById("letter");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
    */
  }


document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll("input[name='letter']").forEach((input) => {
        input.addEventListener('change', filterBrowse);
    });

    document.querySelectorAll("input[name='category']").forEach((input) => {
        input.addEventListener('change', filterBrowse);
    });
});

