<?php
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
          case 'emptyfields':
            echo "<div class=\"error\">
                    <p>Παρακαλώ, συμπληρώστε όλα τα πεδία!</p>
                  </div>";
            break;
          case 'nouser':
            echo "<div class=\"error\">
                    <p>Δε βρέθηκε χρήστης με αυτά τα στοιχεία. Παρακαλώ
                    βεβαιωθείτε ότι έχετε βάλει σωστά τα στοιχεία σας!</p>
                  </div>";
            break;
          case 'noconfirm':
            echo "<div class=\"error\">
                    <p>Ο χρήστης δεν έχει εγκριθεί ακόμα από κάποιον admin.</p>
                  </div>";
          break;
          case 'wrongpwd':
            echo "<div class=\"error\">
                    <p>Ο κωδικός σας είναι λανθασμένος. Παρακαλώ, προσπαθήστε
                    πάλι!</p>
                  </div>";
            break;
          case 'sqlerror':
            echo "<div class=\"error\">
                    <h1>505 Internal Error</h1>
                    <p>Παρακαλώ, επικοινωνήστε μαζί με την Ομάδα Τεχνικής
                    Υποστήριξης!</p>
                  </div>";
            break;
          default:
            // code...
            break;
        }
    }
?>