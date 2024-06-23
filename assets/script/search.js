function searchItems() {
  let query = document.getElementById("search").value;
  if (query.length > 2) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?q=" + query, true);
    xhr.onload = function () {
      if (xhr.status == 200) {
        document.getElementById("results").innerHTML = xhr.responseText;
      }
    };
    xhr.send();
  } else {
    document.getElementById("results").innerHTML = "";
  }
}
