<?php
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
          case 'noauth':
            echo "<div class=\"error\">
                    <p>Δεν έχετε την άδεια για πρόσβαση στη 
                    συγκεκριμένη σελίδα</p>
                  </div>";
            break;
          default:
            // code...
            break;
        }
    }
?>