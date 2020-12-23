const formatDate = (date) => {
    datep = date.substring(0,10).split('-');
    return `${datep[2]} / ${datep[1]} / ${datep[0]}`;
}

const fetch_movies = () => {
  $.ajax({
    url:"http://172.18.1.16:8095/api/cinemas/movies/",
    headers: {"X-Auth-Token": "maG!cK3y"},
    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
    dataType: 'json',
    type: 'GET',
    success: (data) => {
      $('.movies').html(() => {
        if (data.body.length === 0) {
          return `<p>No Movies were Found</p>`;
        } else {
          var cinemas = data.body;
          return cinemas.map((cinema) => {
            var cinemaMrkup = "";
            var movies = ""
            if (cinema) {
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
                          <a class="btn btn-flat blue-text p-1 my-1 mr-0 mml-1 infos" id="${movie._id}_c">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>`
              )).join('');
            }

            return (!cinema)?"":(cinemaMrkup+movies+"</div>");
          }
        );
      }
    });
  }})
};

const fetch_favourites = () => {
  $.ajaxSetup({cache: false});
  $.get('../php/getSession.php', function(data) {
    var session = JSON.parse(data);
    $.ajax({
      url:`http://172.18.1.16:8095/api/favourites/${session.id}`,
      headers: {"X-Auth-Token": "maG!cK3y"},
      contentType: 'application/x-www-form-urlencoded; charset=utf-8',
      dataType: 'json',
      type: 'GET',
      success: (data) => {
        $('.favourites').html(() => {
          if (data.body.length === 0) {
            return `<p>No Favourites were found</p>`;
          } else {
            var favourites = data.body;
            return favourites.map((favourite) => {
              var movie = favourite.movie;
              return (!movie)?"":(
                `<div class="card-wrapper card-action mb-4 mx-4">
                    <div id="card-1" class="card card-rotating text-center h-100">
                      <div class="face front">
                        <div class="card-up">
                          ${(movie.posterLink) ?
                            (`<img class="card-img-top" src="${movie.posterLink}" alt="${movie.title}" style="height: 300px;">`) :
                            (`<img class="card-img-top" src="images/null-img.png" alt="${movie.title}" style="height: 300px;">`)
                          }
                        </div>
                        <div class="card-body">
                          <h5 class="card-title font-weight-bold mb-0">${movie.title}</h5>
                          <p class="mb-3">${movie.releaseYear}</p>
                        </div>
                      </div>
                    </div>
                  </div>`);
            });
          }
        });
    }});
  });
};

$(document).ready(() => {

  $(".heart.fa-heart").click(function() {
    var action = $('.heart').hasClass("far")?"add":"delete";
    var movie_id = $(this).attr('id');
    $.ajaxSetup({cache: false});
    $.get('../php/getSession.php', function(data) {
      var session = JSON.parse(data);
      $.ajax({
        url:`http://172.18.1.16:8095/api/favourites${(action==="delete")?`/${session.id}/${movie_id}`:""}`,
        headers: {"X-Auth-Token": "maG!cK3y"},
        contentType: 'application/x-www-form-urlencoded; charset=utf-8',
        dataType: 'json',
        data: {"movieId":movie_id, "userId": session.id},
        type: (action==="delete")?'DELETE':'POST',
        success: (data) => {
          console.log(data);
          $(".heart.fa-heart").toggleClass("far fa");
          fetch_favourites();
        }
      });
    });
  });

  $("input[name='search_term']").on('keyup input focus', function() {
    var inputVal = $(this).val();
    var resultDropdown = $(this).siblings(".result");
    if(inputVal.length){
      $.ajax({
        url:`http://172.18.1.16:8095/api/movies/search/${inputVal}`,
        headers: {"X-Auth-Token": "maG!cK3y"},
        contentType: 'application/x-www-form-urlencoded; charset=utf-8',
        dataType: 'json',
        type: 'GET',
      }).then(function(data){
        resultDropdown.html(()=>{
          if (data.body)
          { return data.body.map((movie)=>(
              `<div class="media float-left" style="width: 100%;" id="${movie._id}_m">
                ${(movie.posterLink) ?
                  (`<img class="d-flex align-self-center mr-3" src="${movie.posterLink}" alt="${movie.title}" style="height: 100px;">`) :
                  (`<img class="d-flex align-self-center mr-3" src="images/null-img.png" alt="${movie.title}" style="height: 100px;">`)
                }
                <div class="media-body align-self-center">
                  <h5 class="mt-0 font-weight-bold"><b>${movie.title}</b> ${movie.releaseYear}</h5>
                  <p class="mb-0">${movie.cinema.name} &middot; ${formatDate(movie.startDate)} - ${formatDate(movie.endDate)} &middot; ${movie.category}</p>
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

  // $("input[name='search_term']").on('blur', function() {
  //   var resultDropdown = $(this).siblings(".result");
  //   resultDropdown.empty();
  // });

  fetch_movies();
  fetch_favourites();
});

$(document).on('click', '.infos', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url:`http://172.18.1.16:8095/api/movies/${id}`,
    headers: {"X-Auth-Token": "maG!cK3y"},
    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
    dataType: 'json',
    type: 'GET',
  }).then((data) => {
      var movie = data.body;
      console.log(movie);
      $('#image').attr('src', (movie.posterLink)?movie.posterLink:"images/null-img.png");
      $('#image').attr('alt', movie.title);
      $('#title').html(`<b>${movie.title}</b> ${movie.releaseYear}`);
      $('#cinema_name').html(`<b>In</b> ${movie.cinema.name}`);
      $('#dates').html(`<b>From</b> ${formatDate(movie.startDate)}<br/>
                        <b>Until</b> ${formatDate(movie.endDate)}`);
      $('#category').html(`<b>Category</b> ${movie.category}`);
      $.ajaxSetup({cache: false});
      $.get('../php/getSession.php', function(data) {
        var session = JSON.parse(data);
        $.ajax({
          url:`http://172.18.1.16:8095/api/favourites/${session.id}`,
          headers: {"X-Auth-Token": "maG!cK3y"},
          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
          dataType: 'json',
          type: 'GET',
          success: (res) => {
            var favourites = res.body.map((fav) => fav.movie._id);
            var fav = favourites.find(m => movie._id === m);
            if (fav) {
              $(".heart.fa-heart").addClass("fa");
              $(".heart.fa-heart").removeClass("far");
            } else {
              $(".heart.fa-heart").addClass("far");
              $(".heart.fa-heart").removeClass("fa");
            }
            $(".heart").attr('id', movie._id);
            $('#movieModal').modal('show');
          }
        });
      });
    });
});

$(document).on('click', '.media', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url:`http://172.18.1.16:8095/api/movies/${id}`,
    headers: {"X-Auth-Token": "maG!cK3y"},
    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
    dataType: 'json',
    type: 'GET',
  }).then((data) => {
      var movie = data.body;
      console.log(movie);
      $('#image').attr('src', (movie.posterLink)?movie.posterLink:"images/null-img.png");
      $('#image').attr('alt', movie.title);
      $('#title').html(`<b>${movie.title}</b> ${movie.releaseYear}`);
      $('#cinema_name').html(`<b>In</b> ${movie.cinema.name}`);
      $('#dates').html(`<b>From</b> ${formatDate(movie.startDate)}<br/>
                        <b>Until</b> ${formatDate(movie.endDate)}`);
      $('#category').html(`<b>Category</b> ${movie.category}`);
      $.ajaxSetup({cache: false});
      $.get('../php/getSession.php', function(data) {
        var session = JSON.parse(data);
        $.ajax({
          url:`http://localhost:8095/api/favourites/${session.id}`,
          headers: {"X-Auth-Token": "maG!cK3y"},
          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
          dataType: 'json',
          type: 'GET',
          success: (res) => {
            var favourites = res.body.map((fav) => fav.movie._id);
            var fav = favourites.find(m => movie._id === m);
            if (fav) {
              $(".heart.fa-heart").addClass("fa");
              $(".heart.fa-heart").removeClass("far");
            } else {
              $(".heart.fa-heart").addClass("far");
              $(".heart.fa-heart").removeClass("fa");
            }
            $(".heart").attr('id', movie._id);
            $('#movieModal').modal('show');
          }
        });
      });
    });
})
