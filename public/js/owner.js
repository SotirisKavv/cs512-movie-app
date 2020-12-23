const formatDate = (date) => {
    datep = date.split('-');
    return `${datep[2]} / ${datep[1]} / ${datep[0]}`
}

const fetch_cinemas = () => {
  $.ajaxSetup({cache: false});
  $.get('../php/getSession.php', function(data) {
    var session = JSON.parse(data);
    // console.log(session.id);
    $.ajax({
      url:`http://localhost:8095/api/cinemas/owner/${session.id}`,
      headers: {"X-Auth-Token": "maG!cK3y"},
      contentType: 'application/x-www-form-urlencoded; charset=utf-8',
      dataType: 'json',
      type: 'GET',
      success: (data) => {
        // console.log(data);
        var i = 1;
        $('tbody').html(() => {
          if (data.body.length === 0) {
            return `<tr>
                      <td>No records were found</td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>`;
          } else {
            return data.body.map((cinema) => (
             `<tr>
               <td>${i++}</td>
               <td>${cinema.name}</td>
               <td>
                 <button type="button" name="edit" class="btn btn-warning edit_cinema" id="${cinema._id}_u">
                   <i class="fa fa-edit"></i>
                 </button>
               </td>
               <td>
                 <button type="button" name="delete" class="btn btn-danger delete_cinema" id="${cinema._id}_d">
                   <i class="fa fa-trash"></i>
                 </button>
               </td>
             </tr>`
           ));
          }
        });
      }
    })
  });
};

const fetch_movies = () => {
  $.ajaxSetup({cache: false});
  $.get('../php/getSession.php', function(data) {
    var session = JSON.parse(data);
    // console.log(session);
    $.ajax({
      url:`http://localhost:8095/api/cinemas/movies/owner/${session.id}`,
      headers: {"X-Auth-Token": "maG!cK3y"},
      contentType: 'application/x-www-form-urlencoded; charset=utf-8',
      dataType: 'json',
      type: 'GET'
    }).then(data => {
        // console.log(data);
        if (data.body.length == 0) {
          $('.owner_movies').html(() => {
            return `<p>No Records were found</p>`;
          });
        } else {
          $('.owner_movies').html(() => {
            data.body.map((cinema) => {
              if (cinema.movies.length > 0 ) {
                cinema.movies.map((movie) => {
                  console.log(movie);
                    return (
                     `<div class="card mb-3">
                        <div class="row no-gutters">
                          <div class="col-md-4">
                            ${(movie.posterLink)?
                              (`<img src="${movie.posterLink}" alt="${movie.title} Poster"/>`):
                              (`<img src="images/null-img.png" alt="${movie.title} Poster">`)
                            }
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h4 class="card-title"><b>${movie.title}</b> (${movie.releaseYear})</h4>
                                <p class="card-text">
                                  <div class="col-xs-4">
                                    <h5><b>In</b> ${cinema.name}</h5>
                                  </div>
                                  <div class="col-xs-4">
                                    From ${formatDate(movie.startDate.substring(0, 10))}<br/>
                                    Until ${formatDate(movie.endDate.substring(0, 10))}
                                  </div>
                                  <div class="col-xs-4">
                                    <h5><b>Category</b> ${movie.category}</h5>
                                  </div>
                                </p>
                                <p class="card-text">
                                  <button type="button" name="edit" class="btn btn-warning btn-xs edit_movie" id="${movie._id}_u">
                                    <i class="fa fa-edit"></i> Update
                                  </button>
                                  <button type="button" name="delete" class="btn btn-danger btn-xs delete_movie" id="${movie._id}_d">
                                    <i class="fa fa-trash"></i> Delete
                                  </button>
                                </p>
                              </div>
                            </div>
                          </div>
                      </div>`);
                    })
                  }
                })
              })
          }}
    )})
  };


$(document).ready(() => {

  $('.user').blur(function() {
    $('.dropdown-menu').hide();
  })

  $("#cinema_form").submit((e)=>{
    e.preventDefault();
    $.ajaxSetup({cache: false});
    $.get('../php/getSession.php', function(data) {
      var session = JSON.parse(data);
      var form_data = $("#cinema_form").serialize()+"&ownerId="+session.id;
      // console.log(session, session.id);
      if (form_data.indexOf('id_u=&') > -1){
        $.ajax({
          url:"http://localhost:8095/api/cinemas",
          headers: {"X-Auth-Token": "maG!cK3y"},
          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
          dataType: 'json',
          data: form_data,
          type: 'POST',
        }).then((res) => {
          // console.log(res);
          fetch_cinemas();
          $('#cinemaModal').modal('hide');
        })
      } else {
        var index = form_data.indexOf('id_u=');
        $.ajax({
          url:`http://localhost:8095/api/cinemas/${form_data.substring(index+5, index+29)}`,
          headers: {"X-Auth-Token": "maG!cK3y"},
          contentType: 'application/x-www-form-urlencoded; charset=utf-8',
          dataType: 'json',
          data: form_data,
          type: 'PUT',
        }).then((res) => {
          // console.log(res);
          fetch_cinemas();
          $('#cinemaModal').modal('hide');
        })
      }
    });
  });

  $("#deleteCinemaForm").submit((e)=>{
    e.preventDefault();
    var form_data = $("#deleteCinemaForm").serialize();
    var index = form_data.indexOf('id_d=');
    $.ajax({
      url:`http://localhost:8095/api/cinemas/${form_data.substring(index+5, index+29)}`,
      headers: {"X-Auth-Token": "maG!cK3y"},
      contentType: 'application/x-www-form-urlencoded; charset=utf-8',
      dataType: 'json',
      type: 'DELETE',
    }).then((res) => {
      // console.log(res);
      fetch_cinemas();
      $('#deleteCinemaModal').modal('hide');
    })
  });

  $("#movie_form").submit((e)=>{
    e.preventDefault();
    var form_data = $("#movie_form").serialize();
    console.log(form_data);
    // console.log(form_data.substring(form_data.length -1));
    if (form_data.substring(form_data.length -1) === '='){
      $.ajax({
        url:"http://localhost:8095/api/movies",
        headers: {"X-Auth-Token": "maG!cK3y"},
        contentType: 'application/x-www-form-urlencoded; charset=utf-8',
        dataType: 'json',
        data: form_data,
        type: 'POST',
      }).then((res) => {
        console.log(res);
        fetch_movies();
        $('#movieModal').modal('hide');
      })
    } else {
      var index = form_data.indexOf('id_u=');
      $.ajax({
        url:`http://localhost:8095/api/movies/${form_data.substring(index+5)}`,
        headers: {"X-Auth-Token": "maG!cK3y"},
        contentType: 'application/x-www-form-urlencoded; charset=utf-8',
        dataType: 'json',
        data: form_data,
        type: 'PUT',
      }).then((res) => {
        // console.log(res);
        fetch_movies();
        $('#movieModal').modal('hide');
      })
    }
  });

  $("#deleteMovieForm").submit((e)=>{
    e.preventDefault();
    var form_data = $("#deleteMovieForm").serialize();
    $.ajax({
      url: "movie/delete.php",
      data: form_data,
      method: "post",
      success: (data) => {
        fetch_movies();
        $('#deleteMovieModal').modal('hide');
      }
    })
  });

  fetch_cinemas();
  fetch_movies();
});


//CINEMAS
$(document).on('click', '.create_cinema', function() {
  $('.modal-title').text('Add Cinema');
  $('#id_u_cinema').val("");
  $('#name').val("");
  $('#button_action_cinema').val('Insert');
  $('#cinemaModal').modal('show');
});

$(document).on('click', '.edit_cinema', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url:`http://localhost:8095/api/cinemas/${id}`,
    headers: {"X-Auth-Token": "maG!cK3y"},
    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
    dataType: 'json',
    type: 'GET',
  }).then((data) => {
    var cinema = data.body;
    $('#id_u_cinema').val(cinema._id);
    $('#name').val(cinema.name);
    $('.modal-title').text('Edit Cinema');
    $('#button_action_cinema').val('Update');
    $('#cinemaModal').modal('show');
  });
});

$(document).on('click', '.delete_cinema', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url:`http://localhost:8095/api/cinemas/${id}`,
    headers: {"X-Auth-Token": "maG!cK3y"},
    contentType: 'application/x-www-form-urlencoded; charset=utf-8',
    dataType: 'json',
    type: 'GET',
  }).then((data) => {
    var cinema = data.body;
    $('#id_d_cinema').val(cinema._id);
    $('#deleteCinemaModal').modal('show');
  });
})

//MOVIES
$(document).on('click', '.create_movie', function() {
  $.ajaxSetup({cache: false});
  $.get('../php/getSession.php', function(data) {
    var session = JSON.parse(data);
    $.ajax({
      url:`http://localhost:8095/api/cinemas/owner/${session.id}`,
      headers: {"X-Auth-Token": "maG!cK3y"},
      contentType: 'application/x-www-form-urlencoded; charset=utf-8',
      dataType: 'json',
      type: 'GET',
    }).then((data) => {
      var cinemas = data.body;
      $('select').html(()=>{
        return cinemas.map((cinema)=>(
          `<option value="${cinema._id}">${cinema.name}</option>`
        ))
      });
      $('.modal-title').text('Add Movie');
      $('#id_u_movie').val("");
      $('#title').val("");
      $('#poster_link').val("");
      $('#year').val("");
      $('#start_date').val("");
      $('#end_date').val("");
      $('#category').val("");
      $('#button_action_movie').val('Insert');
      $('#movieModal').modal('show');
    });
  });
});

$(document).on('click', '.edit_movie', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url:"movie/single_read.php",
    method: "post",
    data: {"id":id},
    dataType: "json",
    success: (movie) => {
      $.ajax({
        url: "cinema/read_owner.php",
        success: (data) => {
          $('select').html(()=>{
            if (!data.message) {
              return data.body.map((cinema)=>(
                `<option value="${cinema.id}">${cinema.name}</option>`
              ));
            }
          });
          $('#id_u_movie').val(movie.id);
          $('#title').val(movie.title);
          $('#poster_link').val(movie.poster_link);
          $('#year').val(movie.release_year);
          $('#start_date').val(formatDate(movie.start_date));
          $('#end_date').val(formatDate(movie.end_date));
          $(`#cinema_name option[value=${movie.cinema_id}]`).attr('selected', true);
          $('#category').val(movie.category);
          $('.modal-title').text('Edit Movie');
          $('#button_action_movie').val('Update');
          $('#movieModal').modal('show');
        }
      });
    }
  });
});

$(document).on('click', '.delete_movie', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url: "movie/single_read.php",
    method: "post",
    data: {"id":id},
    dataType: "json",
    success: (data) => {
      $('#id_d_movie').val(data.id);
      $('#deleteMovieModal').modal('show');
    }
  });
})
