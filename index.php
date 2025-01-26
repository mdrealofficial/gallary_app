<?php
require 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Photo Gallery</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #dfe9f3, #ffffff);
            color: #495057;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            color: #4a90e2;
            font-size: 2.8rem;
            letter-spacing: 1px;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        form input[type="text"],
        form input[type="file"] {
            width: 100%;
            padding: 14px;
            margin-bottom: 20px;
            border: 1px solid #d1d8e0;
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        form input:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.5);
        }
        form button {
            width: 100%;
            padding: 14px;
            background-color: #4a90e2;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        form button:hover {
            background-color: #357abd;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin: 30px;
            padding: 0;
        }
        .gallery-item {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: 250px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .gallery-item img {
            max-width: 100%;
            border-bottom: 2px solid #f1f3f5;
            display: block;
        }
        .gallery-item strong {
            display: block;
            padding: 12px 0;
            font-size: 1.2rem;
            color: #2c3e50;
            font-weight: bold;
        }
        .gallery-item a {
            display: inline-block;
            margin: 10px 0;
            padding: 8px 15px;
            background-color: #e74c3c;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        .gallery-item a:hover {
            background-color: #c0392b;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <h1>Photo Gallery</h1>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Enter title" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <div class="gallery">
        <?php
        $result = $conn->query("SELECT * FROM photos ORDER BY created_at DESC");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='gallery-item'>";
                echo "<img src='{$row['image_path']}' alt='{$row['title']}'><br>";
                echo "<strong>{$row['title']}</strong><br>";
                echo "<a href='delete.php?id={$row['id']}'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align:center; color: #7f8c8d;'>No photos uploaded yet.</p>";
        }
        ?>
    </div>
</body>
</html>
