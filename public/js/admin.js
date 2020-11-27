const fetch_data = () => {
  $.ajax({
    url:"./user/read.php",
      success: (data) => {
        $('tbody').html(() => {
          if (data.body.error) {
            return "<tr>Error</tr>";
          } else {
            return data.body.map((user) => (
              `<tr>
                <td>${user.id}</td>
                <td>${user.name} ${user.surname}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td>${(user.confirmed>0) ? 
                  ('') : 
                  (
                    `<button type="button" name="confirm" class="btn btn-primary confirm" id="${user.username}_c">Confirm</button>`
                  )
                    }
                </td>
                <td>
                  <button type="button" name="edit" class="btn btn-warning btn-xs edit" id="${user.username}_u">
                    <i class="fa fa-edit"></i>
                  </button>
                </td>
                <td>
                 <button type='button' name='delete' class='btn btn-danger btn-xs delete' id='${user.username}_d'>
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

$(document).ready(() => {   

  $('.user').blur(function() {
    $('.dropdown-menu').hide();
  })
  
  $("#editForm").submit((e)=>{
    e.preventDefault();
    var form_data = $("#editForm").serialize();
    $.ajax({
      url: "user/update.php",
      data: form_data,
      method: "post",
      success: (data) => {
        fetch_data();
        $('#editUserModal').modal('hide');
      }
    })
  });

  $("#deleteForm").submit((e)=>{
    e.preventDefault();
    var form_data = $("#deleteForm").serialize();
    console.log(form_data);
    $.ajax({
      url: "user/delete.php",
      data: form_data,
      method: "post",
      success: (data) => {
        fetch_data();
        $('#deleteUserModal').modal('hide');
      }
    })
  });

  fetch_data();
});

$(document).on('click', '.edit', function() {
    var uname = $(this).attr('id');
    uname = uname.substring(0, uname.length-2);
    $.ajax({
        url:"user/single_read.php",
        method: "post",
        data: {"username":uname},
        dataType: "json",
        success: (data) => {
            $('#id_u').val(data.id);
            $('#name').val(data.name);
            $('#surname').val(data.surname);
            $('#username').val(uname);
            $('#email').val(data.email);
            $(`#role option[value=${data.role}]`).attr('selected', true);
            $('#editUserModal').modal('show');
        }
    });
});

$(document).on('click', '.delete', function() {
  var uname = $(this).attr('id');
  uname = uname.substring(0, uname.length-2);
  $.ajax({
    url: "user/single_read.php",
    method: "post",
    data: {"username":uname},
    dataType: "json",
    success: (data) => {
      $('#id_d').val(data.id);
      $('#deleteUserModal').modal('show');
    }
  });
})

$(document).on('click', '.confirm', function() {
  var uname = $(this).attr('id');
  uname = uname.substring(0, uname.length-2);
  $.ajax({
    url: "user/single_read.php",
    method: "post",
    data: {"username":uname},
    dataType: "json",
    success: (data) => {
      $.ajax({
        url: "user/confirm.php",
        method: "post",
        data: {"id":data.id},
        success: (data) => {
          fetch_data();
        }
      })
    }
  });
})

