<?php
    if (!empty($_POST)) {
        $mysqlConnection = mysql_connect("mysql.neuralprediction.dreamhosters.com", "frethe", "ucb137strf");
        if (!$mysqlConnection) {
	        die ("Error connecting to database: ".mysql_error());
        }

        mysql_select_db("strflab");
        $names = array();
        $vals = array();
        foreach (array("name", "institute", "lab", "email", "comments") as $name) {
            $names[] = $name;
            $vals[] = "\"".mysql_real_escape_string($_POST[$name])."\"";
        }
        if (isset($_POST['mailing']) && $_POST['mailing'] == "true") {
            $names[] = "mailing";
            $vals[] = "1";
        }
        mysql_query("INSERT INTO registration (".implode(",", $names).") VALUES (".implode(",",$vals).")");
        
        header("Location: strflab_v1.45.zip");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
    <head>
        <title>STRFlab</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <link rel="stylesheet" type="text/css" href="download.css" /> 
        <script type="text/javascript">
            function bannerImg() {
                var width = window.innerWidth / 2
                document.getElementById("bgImg").style.marginLeft = width-825 + "px"
            }
            function validate(form) {
                if (!form.name.js.filled()) {
                    alert("Please fill in your name")
                    return false;
                }
                if (!form.institute.js.filled()) {
                    alert("Please fill in your institute")
                    return false;
                }
                if (!form.lab.js.filled()) {
                    alert("Please fill in your lab")
                    return false;
                }
                if (!form.email.js.filled()) {
                    alert("Please fill in your email")
                    return false;
                }
                return true
            }
            window.onload = function() {
                bannerImg()
                makeForms()
            }
            window.onresize=bannerImg
        </script>
        <script type="text/javascript" src="niceForms.js"></script>
    </head>
    <body>
        <div id='main'>
            <div id='menu'><a href='http://strfpak.berkeley.edu/'>STRFPak</a><a href='http://neuralprediction.berkeley.edu/'>Challenge</a></div>
            <img id='bgImg' src='logo3.png' alt='Logo' />
            <div id='banner'>
                <div id='title'><h1><a href="index.html">STRFlab</a></h1><p>Spatio-temporal receptive field lab</p></div>
            </div>
            <div class="clear"></div>
            <div id='maintext'>
                <h2>Download STRFlab</h2>
                <p>Please register to download STRFlab:</p>
                <form action="<?$_SERVER['PHP_SELF']?>" method="post" onsubmit="return validate(this)">
                <div class='formLeft'>
                <p id="form_name"><input type='text' id='name' name='name' /></p>
                <p id="form_inst"><input type='text' id='institute' name='institute' /></p>
                <p id="form_lab"><input type='text' id='lab' name='lab' /></p>
                <p id="form_email"><input type='text' id='email' name='email' /></p>
                <p id="form_list"><label for="mailing">Sign up for mailing list: </label><input type='checkbox' id='mailing' name='mailing' value="true" /></p>
                <p id="disclaimer"> We will not spam you or distribute your personal information to anyone. <a href='http://technology.berkeley.edu/privacy/privacy-statement.html'>Click here for more info.</a></p>
                </div><div class='formRight'>
                <textarea id='comments' name='comments'></textarea>
                <input id='download' type='submit' value="Download" />
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
