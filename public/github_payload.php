<?php

// Use in the "Post-Receive URLs" section of your GitHub repo.

if ( $_POST['payload'] ) {
  shell_exec( 'cd /home/bitnami/htdocs/proyekto/memorial && git pull origin master' );
}

?>