<!doctype html>

<head>
    <title>CCustom Discord Bot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>

<body>
    <div id="overlay">
        <div class="sidebar">
            <div id="sidebar-header">
                <h3> Testing </h3>
            </div>

            <div class="sidebar-button"></div>
        </div>

        <div class="help-body">
            <div id="help-header">
                <h1 style="float: left; width:95%;"> Discord Bot Builder </h1>
                <button id="hbutton" onclick="helpoff()" alt="Documentation & Support Hub">❌</button>
            </div>
            <p> Test </p>
        </div>
    </div>

    <div id="header-wrapper">
        <h1 style="float: left; width:95%;"> Discord Bot Builder </h1>
        <button id="hbutton" onclick="helpon()" alt="Documentation & Support Hub">❓</button>
    </div>

        <form action="process.php" method="post" enctype="multipart/form-data">
            <div id="collapsible-wrapper">
                <div id="left-column">
                    <!-- First left button -->
                    <button type="button" class="collapsible">Management</button>
                    <div class="content">
                        <p>Lorem ipsum...</p>
                    </div>
                    <br> <br>

                    <!-- Second left button -->
                    <button type="button" class="collapsible">Moderation</button>
                    <div class="content">
                        </br>
                        <input type="checkbox" id="clear-command" name="clear-command" value="enabled">
                        <label for="clear-command"> Clear command</label>
                        </br>
                        </br>

                        <input type="checkbox" id="moveall-command" name="moveall-command" value="enabled">
                        <label for="moveall-command"> Move all command</label>
                        </br>
                        </br>


                    </div>
                    <br> <br>

                    <!-- Third left button -->
                    <button type="button" class="collapsible">Security & Logging</button>
                    <div class="content">
                        <p>Lorem ipsum...</p>
                    </div>
                    <br> <br>

                    <!-- Fourth left button -->
                    <button type="button" class="collapsible">Auto Moderation</button>
                    <div class="content">
                        <p>Lorem ipsum...</p>
                    </div>
                </div>
                <div id="right-column">
                    <!-- First right button -->
                    <button type="button" class="collapsible">Entertainment</button>
                    <div class="content">
                        <p>Lorem ipsum...</p>
                    </div>

                    <br> <br>

                    <!-- Second right button -->
                    <button type="button" class="collapsible">Utilities</button>
                    <div class="content">
                        <p>Lorem ipsum...</p>
                    </div>

                    <br> <br>

                    <!-- Third right button -->
                    <button type="button" class="collapsible">Information</button>
                    <div class="content">
                        <p>Lorem ipsum...</p>
                    </div>
                    <br> <br>

                    <!-- Fourth right button -->
                    <button type="button" class="collapsible">Bot Information & Management</button>
                    <div class="content">
                        </br>
                        <input type="checkbox" id="status-command" name="status-command" value="enabled">
                        <label for="status-command"> Bot status command</label>
                        </br>
                        </br>
                    </div>
                </div>

            </div>

            <hr style="width:100%;text-align:left;margin-left:0;color:white;padding-top: 15px;border: 0px;border-bottom: 1px solid white">

            <div id="under-form">
                <p> Please triple check these options; mistakes may cause the bot not to work! </p>

                <label for="token">Bot Token</label>
                <input type="text" id="token" name="token" placeholder="Bot token; leave blank to input later.">
                </br> </br>
                <label for="token">Bot Prefix</label>
                <input type="text" id="prefix" name="prefix" value="-" required>
                </br> </br>
                <label for="token">Bot Owner ID</label>
                <input type="number" id="ownerid" name="ownerid">
                </br> </br>

                <label style="margin-bottom: 15px;"> Command Colours </label> <br>
                <div style="padding-left: 45px; padding-top: 10px;">
                    <label for="ghex"> • General Colour » </label>
                    <input style="left: 20vw; position: absolute;" type="color" id="ghex" name="ghex" value="#91bdff">
                    </br>
                    </br>

                    <label for="mahex"> • Mangement Colour » </label>
                    <input style="left: 20vw; position: absolute;" type="color" id="mahex" name="mahex" value="#91bdff">
                    </br>
                    </br>

                    <label for="mohex"> • Moderation Colour » </label>
                    <input style="left: 20vw; position: absolute;" type="color" id="mohex" name="mohex" value="#91bdff">
                    </br>
                    </br>


                    <label for="lhex"> • Logs Colour » </label>
                    <input style="left: 20vw; position: absolute;" type="color" id="lhex" name="lhex" value="#91bdff">
                    </br>
                    </br>

                    <label for="ehex"> • Error Colour » </label>
                    <input style="left: 20vw; position: absolute;" type="color" id="ehex" name="ehex" value="#91bdff">
                </div>

                <input type="submit" name="submit" value="Submit" />

        </form>
</body>



<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

    function helpon() {
        document.getElementById("overlay").style.display = "block";
    }

    function helpoff() {
        document.getElementById("overlay").style.display = "none";
    }
</script>