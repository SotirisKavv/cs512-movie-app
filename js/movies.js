const formatDate = (date) => {
    datep = date.split('-');
    return `${datep[2]}/${datep[1]}/${datep[0]}`;
}

const fetch_movies = () => {
  $.ajax({
    url:"movie/read.php",
    success: (data) => {
      $('.movies').html(() => {
        if (data.message) {
          return `<p>${data.message}</p>`;
        } else {  
          return data.cinemas.map((cinema) => {
            var cinemaMrkup = `<h4>${cinema.name}</h4><hr>
                               <div class="row row-cols-1 row-cols-md-5">`;
            var movies = cinema.movies.map((movie)=>(
              ` <div class="card-wrapper card-action mx-4 mb-2">
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
                        <a class="btn btn-flat blue-text p-1 my-1 mr-0 mml-1 infos" id="${movie.movie_id}_c">Read More</a>
                      </div>
                    </div>                    
                  </div>
                </div>`
            )).join('');
            return cinemaMrkup+movies+"</div>";
          }
        );
      }
    });
  }})
};

const fetch_favourites = () => {
  $.ajax({
    url:"movie/read_favourites.php",
    success: (data) => {
      $('.favourites').html(() => {
        if (data.message) {
          return `<p>${data.message}</p>`;
        } else {  
          return data.body.map((movie) => (
              ` <div class="card-wrapper card-action mb-4 mx-4">
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

  $(".heart.fa-heart").click(function() {
    var action = $('.heart').hasClass("far")?"add":"delete";
    var movie_id = $(this).attr('id');
    $.ajax({
      url: "movie/toggleFav.php",
      method: "post",
      data: 
      {
        "action":action,
        "id":movie_id
      },
      success: (data) => {
        $(".heart.fa-heart").toggleClass("far fa");
        fetch_favourites();
      }
    })
  });

  $("input[name='search_term']").on('keyup input focus', function() {
    var inputVal = $(this).val();
    var resultDropdown = $(this).siblings(".result");
    if(inputVal.length){
      $.get("movie/liveSearch.php", {"search_term": inputVal}).done(function(data){
        resultDropdown.html(()=>{
          if (data.body) 
          { return data.body.map((movie)=>(
              `<div class="media float-left" style="width: 100%;" id="${movie.id}_m">
                ${(movie.posterLink) ?
                  (`<img class="d-flex align-self-center mr-3" src="${movie.posterLink}" alt="${movie.title}" style="height: 100px;">`) :
                  (`<img class="d-flex align-self-center mr-3" src="images/null-img.png" alt="${movie.title}" style="height: 100px;">`)
                }
                <div class="media-body align-self-center">
                  <h5 class="mt-0 font-weight-bold"><b>${movie.title}</b> ${movie.releaseYear}</h5>
                  <p class="mb-0">${movie.cinemaName} &middot; ${formatDate(movie.startDate)} - ${formatDate(movie.endDate)} &middot; ${movie.category}</p>
                </div>
              </div>`
            ));
          } else {
            return "";
          }
        });
      });
    } else{
        resultDropdown.empty();
    }
  });

  $("input[name='search_term']").on('blur', function() {
    var resultDropdown = $(this).siblings(".result");
    resultDropdown.empty();
  });

  fetch_movies();
  fetch_favourites();
});

$(document).on('click', '.infos', function() {
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
      if (movie.fav) {
        $(".heart.fa-heart").addClass("fa");
        $(".heart.fa-heart").removeClass("far");
      } else {
        $(".heart.fa-heart").addClass("far");
        $(".heart.fa-heart").removeClass("fa");
      }
      $(".heart").attr('id', movie.id);
      $('#movieModal').modal('show');
    }
  })
})

$(document).on('click', '.media', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url: "movie/single_read.php",
    method: "post",
    data: {"id": id},
    success: (movie) => {
      $('#image').attr('src', movie.poster_link);
      $('#image').attr('alt', movie.title);
      $('#title').html(`<b>${movie.title}</b> ${movie.release_year}`);
      $('#cinema_name').html(`<b>In</b> ${movie.cinema_name}`);
      $('#dates').html(`<b>From</b> ${formatDate(movie.start_date)}<br/>
                        <b>Until</b> ${formatDate(movie.end_date)}`);
      $('#category').html(`<b>Category</b> ${movie.category}`);
      if (movie.fav) {
        $(".heart.fa-heart").addClass("fa");
        $(".heart.fa-heart").removeClass("far");
      } else {
        $(".heart.fa-heart").addClass("far");
        $(".heart.fa-heart").removeClass("fa");
      }
      $(".heart").attr('id', movie.id);
      $('#movieModal').modal('show');
    }
  })
})
