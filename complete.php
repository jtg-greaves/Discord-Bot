<?php
session_start();
$UUID = $_SESSION['uuid'];

?>

<body>
    <p> The download is ready! </p>
    <?php
    echo "<a href='https://db.jtgreaves.com/downloads/$UUID/download.zip'>Download</a>";
    ?>

</body>