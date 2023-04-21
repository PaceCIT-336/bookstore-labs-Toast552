function filter() {
    let products = document.getElementsByClassName("review__item");
    let searchTerm = document.filterform.filter.value.toLowerCase();
    for (let i = 0; i < products.length; i++) {
      let productName = products[i].textContent.toLowerCase();
      if (searchTerm === "") {
        products[i].style.display = "block";
      } else if (productName.includes(searchTerm)) {
        products[i].style.display = "block";
      } else {
        products[i].style.display = "none";
      }
    }
    document.filterform.filter.value = searchTerm;
  }

  document.filterform.search.addEventListener("click", function(event) {
    filter();
    event.preventDefault();
  });
  document.filterform.filter.value = searchTerm;
  if (searchTerm === "") {
    carousel(0);
  } else if (productName.includes(searchTerm)) {
    products[i].style.display = "block";
  } else {
    products[i].style.display = "none";
  }
  
  