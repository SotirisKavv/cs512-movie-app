<?php
    if (isset($_GET['error'])) {
        switch ($_GET['error']) {
          case 'emptyfields':
            echo "<div class=\"error\">
                    <p>Παρακαλώ, συμπληρώστε όλα τα πεδία!</p>
                  </div>";
            break;
          case 'invalidmail':
            echo "<div class=\"error\">
                    <p>Παρακαλώ, συμπληρώστε σωστά το mail σας!</p>
                  </div>";
            break;
          case '6charsorpassword':
            echo "<div class=\"error\">
                    <p>Ο κωδικός σας πρέπει να είναι τουλάχιστον 6 χαρακτήρων,
                      και να περιέχει σύμβολα όπως a-z, A-Z, 0-9 ή $,:,?,.,~,^,_
                       .</p>
                  </div>";
            break;
          case 'invalid_password':
            echo "<div class=\"error\">
                    <p>Ο κωδικός που βάλατε δεν αντιστοιχεί με αυτόν στο
                    τελευταίο!</p>
                  </div>";
            break;
          case 'usernameTaken':
            echo "<div class=\"error\">
                    <p>Το username που επιλέξατε έχει επιλεχθεί από κάποιον
                    άλλον χρήστη. Παρακαλώ επιλέξτε κάποιο άλλο!</p>
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