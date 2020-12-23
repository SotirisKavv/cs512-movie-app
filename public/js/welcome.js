const formatDate = (date) => {
  console.log(date);
    datep = date.split('-');
    return `${datep[2]} / ${datep[1]} / ${datep[0]}`;
}



const fetch_todays = () => {
  $.ajax({
    url:"http://localhost:8095/api/movies/today",
    headers: {"X-Auth-Token": "maG!cK3y"},
    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
    dataType: 'json',
    type: 'GET',
    success: (data) => {
      $('.todays_movies').html(() => {
        if (data.status === 'error') {
          return `<p>${data.message}</p>`;
        } else {
          console.log();
          return data.body.map((movie) => (
              ` <div class="card-wrapper card-action mb-4 mx-3">
                  <div id="card-1" class="card card-rotating text-center h-100">
                    <div class="face front">
                      <div class="card-up">
                        ${(movie.posterLink) ?
                          (`<img class="card-img-top" src="${movie.posterLink}" alt="${movie.title}">`) :
                          (`<img class="card-img-top" src="images/null-img.png" alt="${movie.title}">`)
                        }
                      </div>
                      <div class="card-body">
                        <h5 class="card-title font-weight-bold mb-0">${movie.title}</h5>
                        <p class="mb-3">${movie.releaseYear}</p>
                        <a class="btn btn-flat blue-text p-1 my-1 mr-0 mml-1 todays" id="${movie._id}_c">Read More</a>
                      </div>
                    </div>
                  </div>
                </div>`
          ));
        }
      });
  }})
};

$(document).ready(() => {
  $('.user').blur(function() {
    $('.dropdown-menu').hide();
  })
  fetch_todays();
});

$(document).on('click', '.todays', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  console.log("http://localhost:8095/api/movies/"+id);
  $.ajax({
    url:"http://localhost:8095/api/movies/"+id,
    headers: {"X-Auth-Token": "maG!cK3y"},
    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
    dataType: 'json',
    type: 'GET',
    success: (res) => {
      var movie = res.body;
      $('#image').attr('src', (movie.posterLink)?movie.posterLink:"images/null-img.png");
      $('#image').attr('alt', movie.title);
      $('#title').html(`<b>${movie.title}</b> ${movie.releaseYear}`);
      $('#cinema_name').html(`<b>In</b> ${movie.cinemaName}`);
      $('#dates').html(`<b>From</b> ${formatDate(movie.startDate.substring(0, 10))}<br/>
                        <b>Until</b> ${formatDate(movie.endDate.substring(0, 10))}`);
      $('#category').html(`<b>Category</b> ${movie.category}`);
      $('#movieModal').modal('show');
    }
  })
})
