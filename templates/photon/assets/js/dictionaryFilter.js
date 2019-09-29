
function filterDL() {
  var input, filter, ul, li, a, i, txtValue;
  filter = $('#search').val().toUpperCase();
  listing = document.getElementsByClassName('dictionaryEntry');

  // Loop through entries, and hide those who don't match search query
  for (i = 0; i < listing.length; i++) {
    termValue = $(listing[i]).data('search');
    
    if (termValue.toUpperCase().indexOf(filter) > -1) {
      listing[i].style.display = "";
    } else {
      listing[i].style.display = "none";
    }
  }
}