const formatDate = (date) => {
    datep = date.split('-');
    return `${datep[2]}/${datep[1]}/${datep[0]}`
}

const fetch_cinemas = () => {
  $.ajax({
    url:"cinema/read_owner.php",
    success: (data) => {
      $('tbody').html(() => {
        if (data.message) {
          return `<tr>
                    <td>${data.message}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>`;
        } else {
          return data.body.map((cinema) => (
           `<tr>
             <td>${cinema.id}</td>
             <td>${cinema.name}</td>
             <td>
               <button type="button" name="edit" class="btn btn-warning edit_cinema" id="${cinema.id}_u">
                 <i class="fa fa-edit"></i>
               </button>
             </td>
             <td>
               <button type="button" name="delete" class="btn btn-danger delete_cinema" id="${cinema.id}_d">
                 <i class="fa fa-trash"></i>
               </button>
             </td>
           </tr>`
         ));
        }
      });            
    }
  })
};

const fetch_movies = () => {
  $.ajax({
    url:"movie/read_owner.php",
    success: (data) => {
      $('.owner_movies').html(() => {
        if (data.message) {
          return `<p>${data.message}</p>`;
        } else {
          return data.body.map((movie) => (
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
                          <h5><b>In</b> ${movie.cinemaName}</h5>
                        </div>
                        <div class="col-xs-4">
                          From ${formatDate(movie.startDate)}<br/>
                          Until ${formatDate(movie.endDate)}
                        </div>
                        <div class="col-xs-4">
                          <h5><b>Category</b> ${movie.category}</h5>
                        </div>
                      </p>
                      <p class="card-text">
                        <button type="button" name="edit" class="btn btn-warning btn-xs edit_movie" id="${movie.id}_u">
                          <i class="fa fa-edit"></i> Update
                        </button>
                        <button type="button" name="delete" class="btn btn-danger btn-xs delete_movie" id="${movie.id}_d">
                          <i class="fa fa-trash"></i> Delete
                        </button>
                      </p>
                    </div>
                  </div>
                </div>
            </div>`
           ));
          }
        });            
      }
    })
  };
  
$(document).ready(() => {   

  $('.user').blur(function() {
    $('.dropdown-menu').hide();
  })
  
  $("#cinema_form").submit((e)=>{
    e.preventDefault();
    var form_data = $("#cinema_form").serialize();
    console.log(form_data);
    $.ajax({
      url: "cinema/save.php",
      data: form_data,
      method: "post",
      success: (data) => {
        fetch_cinemas();
        $('#cinemaModal').modal('hide');
      }
    })
  });
  
  $("#deleteCinemaForm").submit((e)=>{
    e.preventDefault();
    var form_data = $("#deleteForm").serialize();
    $.ajax({
      url: "cinema/delete.php",
      data: form_data,
      method: "post",
      success: (data) => {
        fetch_cinemas();
        $('#deleteCinemaModal').modal('hide');
      }
    })
  });

  $("#movie_form").submit((e)=>{
    e.preventDefault();
    var form_data = $("#movie_form").serialize();
    console.log(form_data);
    $.ajax({
      url: "movie/save.php",
      data: form_data,
      method: "post",
      success: (data) => {
        fetch_movies();
        $('#movieModal').modal('hide');
      }
    })
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
    url:"cinema/single_read.php",
    method: "post",
    data: {"id":id},
    dataType: "json",
    success: (data) => {
      $('#id_u_cinema').val(data.id);
      $('#name').val(data.name);
      $('.modal-title').text('Edit Cinema');
      $('#button_action_cinema').val('Update');
      $('#cinemaModal').modal('show');
    }
  });
});
  
$(document).on('click', '.delete_cinema', function() {
  var id = $(this).attr('id');
  id = id.substring(0, id.length-2);
  $.ajax({
    url: "cinema/single_read.php",
    method: "post",
    data: {"id":id},
    dataType: "json",
    success: (data) => {
      $('#id_d_cinema').val(data.id);
      $('#deleteCinemaModal').modal('show');
    }
  });
})


//MOVIES
$(document).on('click', '.create_movie', function() {
  $.ajax({
    url: "cinema/read_owner.php",
    success: (data) => {
      $('select').html(()=>{
        if (!data.message) {
          return data.body.map((cinema)=>(
            `<option value="${cinema.id}">${cinema.name}</option>`
          ))
        }
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
    }
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