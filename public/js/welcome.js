const formatDate = (date) => {
    datep = date.split('-');
    return `${datep[2]}/${datep[1]}/${datep[0]}`;
}

const fetch_todays = () => {
  $.ajax({
    url:"movie/read_todays.php",
    success: (data) => {
      $('.todays_movies').html(() => {
        if (data.message) {
          return `<p>${data.message}</p>`;
        } else {  
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
                        <a class="btn btn-flat blue-text p-1 my-1 mr-0 mml-1 todays" id="${movie.id}_c">Read More</a>
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
  $.ajax({
    url: "movie/single_read.php",
    method: "post",
    data: {"id": id},
    success: (movie) => {
      $('#image').attr('src', (movie.poster_link)?movie.poster_link:"images/null-img.png");
      $('#image').attr('alt', movie.title);
      $('#title').html(`<b>${movie.title}</b> ${movie.release_year}`);
      $('#cinema_name').html(`<b>In</b> ${movie.cinema_name}`);
      $('#dates').html(`<b>From</b> ${formatDate(movie.start_date)}<br/>
                        <b>Until</b> ${formatDate(movie.end_date)}`);
      $('#category').html(`<b>Category</b> ${movie.category}`);
      $(".heart").attr('id', movie.id);
      $('#movieModal').modal('show');
    }
  })
})