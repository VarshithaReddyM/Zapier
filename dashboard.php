<?php
// SQLite database connection
$db = new SQLite3('database.db');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $certifications = $_POST['certifications'];
    $hobbies = $_POST['hobbies'];

    // Create a table to store resume details (if it doesn't exist)
    $db->exec('CREATE TABLE IF NOT EXISTS dashboard (
        id INTEGER PRIMARY KEY,
        email TEXT UNIQUE,
        name TEXT,
        education TEXT,
        experience TEXT,
        skills TEXT,
        certifications TEXT,
        hobbies TEXT
    )');

    // Prepare the SQL statement to insert or update data
    $stmt = $db->prepare('INSERT OR REPLACE INTO dashboard (email, name, education, experience, skills, certifications, hobbies)
                         VALUES (:email, :name, :education, :experience, :skills, :certifications, :hobbies)');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':education', $education, SQLITE3_TEXT);
    $stmt->bindValue(':experience', $experience, SQLITE3_TEXT);
    $stmt->bindValue(':skills', $skills, SQLITE3_TEXT);
    $stmt->bindValue(':certifications', $certifications, SQLITE3_TEXT);
    $stmt->bindValue(':hobbies', $hobbies, SQLITE3_TEXT);

    // Execute the statement
    $result = $stmt->execute();
	// After successful database operation, redirect to the home page
    header('Location: website.html'); // Replace 'index.php' with the home page URL
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h2, h3 {
            text-align: center;
            color: #4CAF50;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Your Dashboard</h2>
        <h3>Update Your Resume</h3>
        <form method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $email ?? ''; ?>" required>

            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $name ?? ''; ?>" required>

            <label for="education">Education:</label>
            <input type="text" name="education" value="<?php echo $education ?? ''; ?>" required>

            <label for="experience">Experience:</label>
            <textarea name="experience" required><?php echo $experience ?? ''; ?></textarea>

            <label for="skills">Skills:</label>
            <input type="text" name="skills" value="<?php echo $skills ?? ''; ?>" required>

            <label for="certifications">Certifications:</label>
            <input type="text" name="certifications" value="<?php echo $certifications ?? ''; ?>">

            <label for="hobbies">Hobbies:</label>
            <input type="text" name="hobbies" value="<?php echo $hobbies ?? ''; ?>">

            <button type="submit">Save</button>
        </form>
    </div>
<script>
        // JavaScript code for redirection to the home page after saving the details
        // Add this script at the end of the body section
        window.onload = function() {
            const saveButton = document.querySelector('button[type="submit"]');
            saveButton.addEventListener('click', function() {
                // Redirect to the home page after clicking the "Save" button
                window.location.replace("index.php"); // Replace 'index.php' with the home page URL
            });
        };
    </script>

</body>
</html>

<?php
// Close the database connection
$db->close();
?>