<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Student Manager - Login</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <nav class="navbar">
            <span>Student Manager</span>
        </nav>

        <div class="container">
            <h1>Student Manager - Register</h1>
            <form id="registerForm">
                <label for="regUsername">Username</label>
                <input
                    type="text"
                    id="regUsername"
                    name="regUsername"
                    placeholder="Enter a username"
                    required
                />
                <label for="regPassword">Password</label>
                <input
                    type="password"
                    id="regPassword"
                    name="regPassword"
                    placeholder="Enter a password"
                    required
                />
                <label for="regPasswordAgain">Password again</label>
                <input
                    type="password"
                    id="regPasswordAgain"
                    name="regPasswordAgain"
                    placeholder="Enter the password again"
                    required
                />
                <label for="neptun">Neptun Code</label>
                <input
                    type="password"
                    id="neptun"
                    name="neptun"
                    placeholder="Enter the neptun code"
                    required
                />

                <fieldset>
                    <legend>Gender</legend>
                    <div>
                        <input
                            type="radio"
                            id="male"
                            name="gender"
                            value="male"
                        />
                        <label for="male">Male</label>
                    </div>
                    <div>
                        <input
                            type="radio"
                            id="female"
                            name="gender"
                            value="female"
                        />
                        <label for="female">Female</label>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Your classes</legend>
                    <div>
                        <input 
                            type="checkbox" 
                            id="webprog" 
                            name="webprog"
                            checked
                        />
                        <label for="webprog">Webprogramming</label>
                    </div>
                    <div>
                        <input 
                            type="checkbox" 
                            id="discrete" 
                            name="discrete"
                        />
                        <label for="discrete">Discrete Mathematics</label>
                    </div>
                    <div>
                        <input 
                            type="checkbox" 
                            id="linux" 
                            name="linux"
                        />
                        <label for="linux">Linux Basics</label>
                    </div>
                </fieldset>


                <button type="submit">Register</button>
            </form>
            <a id="registerLink" href="index.php">Click here to log in!</a>
        </div>
    </body>
</html>         