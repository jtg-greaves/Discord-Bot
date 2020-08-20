<?php
session_start();
if (isset($_POST["submit"])) {

    // Creates the function for generating a random string of 16 characters for the directory name - count this as a UUID for the download.
    function generateRandomString($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $directoryCreated = false;

    // Tries to create a random string.. if a directory already exists with this name it randomly generates another one until a unique one is made. Prevents files being overwritten. 
    do {
        $generatedString = generateRandomString();

        if (file_exists("/home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/")) {
        } else {
            mkdir("/home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/");
            $directoryCreated = true;
        }
    } while ($directoryCreated = false);


    // Once a directory for the files has been made it copies the base bot code into its directory. 
    if ($directoryCreated = true) {
        function custom_copy($src, $dst)
        {
            $dir = opendir($src);
            @mkdir($dst);
            while ($file = readdir($dir)) {
                if (($file != '.') && ($file != '..')) {
                    if (is_dir($src . '/' . $file)) {
                        custom_copy($src . '/' . $file, $dst . '/' . $file);
                    } else {
                        copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
            closedir($dir);
        }
        $src = "/home/jtgreaves/db.jtgreaves.com/bot/base/";
        $dst = "/home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/";
        custom_copy($src, $dst);
    }

    // !!! Below this is where the files are modified to the users input.

    // Setting variables from the form inputs
    $token = $_POST['token'];
    $prefix = $_POST['prefix'];
    $ownerid = $_POST['ownerid'];

    $ghex = $_POST['ghex'];
    $mahex = $_POST['maxhex'];
    $mohex = $_POST['mohex'];
    $lhex = $_POST['lhex'];
    $ehex = $_POST['ehex'];

    $status_command = $_POST['status-command'];
    $clear_command = $_POST['clear-command'];
    $moveall_command = $_POST['moveall-command'];



    // Checks if the token is not null, should not need to worry about the prefix being null as it is required and defaults to '-'
    if ($token == null) {
        $token = "Bot-Token";
    };

    chdir("/");
    $str = implode("\n", file("home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/index.js"));
    $fp = fopen("home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/index.js", 'w');
    $str = str_replace('{%BOT_TOKEN%}', $token, $str);
    $str = str_replace('{%BOT_PREFIX%}', $prefix, $str);
    $str = str_replace('{%OWNER_ID%}', $ownerid, $str);
    fwrite($fp, $str, strlen($str));


    // Start of checking and adding various commands
    if ($status_command == "enabled") {
        chdir("/");
        if (!copy("home/jtgreaves/db.jtgreaves.com/bot/commands/status.js", "home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/commands/bot-information-&-management/status.js")) {
            echo "Failed copying \"status\" command!";
        }
    }

    if ($clear_command == "enabled") {
        chdir("/");
        if (!copy("home/jtgreaves/db.jtgreaves.com/bot/commands/clear.js", "home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/commands/moderation/clear.js")) {
            echo "Failed copying \"clear\" command!";
        }
    }
    
    if ($moveall_command == "enabled") {
        chdir("/");
        if (!copy("home/jtgreaves/db.jtgreaves.com/bot/commands/moveall.js", "home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/commands/moderation/moveall.js")) {
            echo "Failed copying \"moveall\" command!";
        }
    }
    
    // End of checking and adding various commands

    function globalVariableReplace($path)
    {
        global $ghex, $mahex, $mohex, $lhex, $ehex;
        chdir("/");
        $str = implode("\n", file($path));
        $fp = fopen($path, 'w');
        $str = str_replace('{%COLOUR_GEN%}', $ghex, $str);
        $str = str_replace('{%COLOUR_MAN%}', $mahex, $str);
        $str = str_replace('{%COLOUR_MOD%}', $mohex, $str);
        $str = str_replace('{%COLOUR_LOG%}', $lhex, $str);
        $str = str_replace('{%COLOUR_ERROR%}', $ehex, $str);
        fwrite($fp, $str, strlen($str));
    }

    // Global variables of what to change (Bot name & Colours)
    function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
                globalVariableReplace($path);
                echo $path . "<br>";
            } else if ($value != "." && $value != "..") {
                getDirContents($path);
                $results[] = $path;
            }
        }
        return $results;
    }

    getDirContents("home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/");
    // !!! End of file changes dependant on the user's input - all file changes should be made above. The file is now prepating for download!

    // Zip the folders
    function zipData($source, $destination)
    {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new ZipArchive();
                if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    if (is_dir($source)) {
                        $iterator = new RecursiveDirectoryIterator($source);
                        // skip dot files while iterating 
                        $iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
                        $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = realpath($file);
                            if (is_dir($file)) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }
    zipData("home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/build/", "home/jtgreaves/db.jtgreaves.com/downloads/$generatedString/download.zip");


    // Global variables
    $_SESSION['uuid'] = $generatedString;
    echo "<script> location.href='/complete.php'; </script>";
    exit();
}
