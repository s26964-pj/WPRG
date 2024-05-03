<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Handling</title>
</head>
<body>
<?php
function manage_directory($path, $directory, $operation = "read") {
    if (substr($path, -1) != '/') {
        $path .= '/';
    }

    if (!is_dir($path)) {
        return "The specified path does not exist.";
    }

    switch ($operation) {
        case 'read':
            $contents = scandir($path . $directory);
            if ($contents !== false) {
                return "Contents of directory '$directory': " . implode(", ", $contents);
            } else {
                return "Failed to read directory contents.";
            }
            break;

        case 'delete':
            if (is_dir($path . $directory)) {
                $dir_contents = scandir($path . $directory);
                if (count($dir_contents) <= 2) { // If directory is empty
                    if (rmdir($path . $directory)) {
                        return "Directory '$directory' has been deleted.";
                    } else {
                        return "Failed to delete directory '$directory'.";
                    }
                } else {
                    return "Directory '$directory' is not empty.";
                }
            } else {
                return "Directory '$directory' does not exist.";
            }
            break;

        case 'create':
            if (!is_dir($path . $directory)) {
                if (mkdir($path . $directory)) {
                    return "Directory '$directory' has been created.";
                } else {
                    return "Failed to create directory '$directory'.";
                }
            } else {
                return "Directory '$directory' already exists.";
            }
            break;

        default:
            return "Invalid operation type.";
            break;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $path = $_POST["path"];
    $directory = $_POST["directory"];
    $operation = isset($_POST["operation"]) ? $_POST["operation"] : "read";

    $result = manage_directory($path, $directory, $operation);

    echo $result;
}
?>

<form action="" method="POST">
    <label for="path">Path:</label>
    <input type="text" id="path" name="path" required><br><br>

    <label for="directory">Directory Name:</label>
    <input type="text" id="directory" name="directory" required><br><br>

    <label for="operation">Operation Type:</label>
    <select id="operation" name="operation">
        <option value="read">Read</option>
        <option value="delete">Delete</option>
        <option value="create">Create</option>
    </select><br><br>

    <button type="submit">Execute Operation</button>
</form>
</body>
</html>
