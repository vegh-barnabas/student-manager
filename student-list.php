<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Student Manager - Students</title>
        <link rel="stylesheet" href="styles.css" />
    </head>
    <body>
        <nav class="navbar">
            <span>Student Manager</span>
            <ul>
                <li>
                    <a href="student-list.html" class="current">Students</a>
                </li>
                <li><a href="#">Add Student</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>
        <div class="container">
            <h1>Student List</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Neptun Code</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Classes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>AK3G4F</td>
                        <td>2000-04-14</td>
                        <td>Male</td>
                        <td>
                            <div>Webprogramming</div>
                            <div>Discrete Mathematics</div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>AK3G4J</td>
                        <td>2000-01-09</td>
                        <td>Female</td>
                        <td>
                            <div>Webprogramming</div>
                            <div>Discrete Mathematics</div>
                            <div>Linux Basics</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="statistics">
                <p><strong>Statistics:</strong></p>
                <p>Oldest Student: Jane Smith (24 years)</p>
                <p>Total Students: 2</p>
            </div>
        </div>
    </body>
</html>
