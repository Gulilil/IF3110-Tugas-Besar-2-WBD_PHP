function handleSearch(){
  let search = document.getElementById('search-bar').value;
  let genre = document.getElementById('filter-genre').value;
  let type = document.getElementById('filter-type').value;
  let status = document.getElementById('filter-status').value;
  let rating = document.getElementById('filter-rating').value;
  let studio = document.getElementById('filter-studio').value;
  let sort = document.getElementById('filter-sort').value;

  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../../api/anime/filter.php', true);
  xhr.onload = function() {
    if (this.status == 200){
      let response = JSON.parse(this.responseText);
      if (response.status == 'success'){
        window.location.hred = response.url;
      }
    }
  };
  xhr.send(JSON.stringify(
    {
      'filter-search' : search,
      'filter-genre' : genre,
      'filter-type' : type,
      'filter-status' : status,
      'filter-rating' : rating,
      'filter-studio' : studio,
      'filter-sort' : sort,
    }
  ));

}