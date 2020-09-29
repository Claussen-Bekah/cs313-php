<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Wk 3, Group 4 Form</title>
    <meta name="description" content="Wk 3 form submission">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <main>
        <form action="welcome.php" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            </div>

            <br>

            <div>
            <label for="name">Email:</label>
            <input type="text" id="email" name="email">
            </div>

            <p>Major:</p>
            <div>
                <input type="radio" id="cs" name="major" value="Computer Science">
                <label for="cs">Computer Science</label>
            </div>
            <div>
                <input type="radio" id="wdd" name="major" value="Web Design and Development">
                <label for="wdd">Web Design and Development</label>
            </div>
            <div>
                <input type="radio" id="cit" name="major" value="Computer Information Technology">
                <label for="cit">Computer Information Technology</label>
            </div>
            <div>
                <input type="radio" id="ce" name="major" value="Computer Engineering">
                <label for="ce">Computer Engineering</label>
            </div>

            <br>

            <label for="comments">Comments:</label>
            <input type="textarea" id="comments" name="comments">

            <div>

            <p>Where have you been?</p>

            <input type="checkbox" id="namerica" name="continent[]" value="North America">
            <label for="namerica">North America</label>

            <input type="checkbox" id="samerica" name="continent[]" value="South America">
            <label for="samerica">South America</label>

            <input type="checkbox" id="europe" name="continent[]" value="Europe">
            <label for="europe">Europe</label>

            <input type="checkbox" id="asia" name="continent[]" value="Asia">
            <label for="asia">Asia</label>

            <input type="checkbox" id="australia" name="continent[]" value="Australia">
            <label for="australia">Australia</label>

            <input type="checkbox" id="africa" name="continent[]" value="Africa">
            <label for="africa">Africa</label>

            <input type="checkbox" id="antartica" name="continent[]" value="Antartica">
            <label for="antartica">Antartica</label>

            </div>
            <br>

            <input type="submit" value="Submit">

        </form>
    </main>

    <script src="" async defer></script>
</body>

</html>