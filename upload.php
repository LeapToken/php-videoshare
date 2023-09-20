<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = "videos/";

    if ($_FILES["video"]["type"] == "video/mp4") {
        // Get the next available number for the filename
        $nextNumber = 1;
        while (file_exists($uploadDir . $nextNumber . ".mp4")) {
            $nextNumber++;
        }

        // Rename the uploaded file to the next available number
        $uploadFile = $uploadDir . $nextNumber . ".mp4";

        if (move_uploaded_file($_FILES["video"]["tmp_name"], $uploadFile)) {
            $videoURL = $uploadFile;

            // Create a new HTML page for the uploaded video
            $videoPage = fopen("videos/video_" . $nextNumber . ".html", "w");

            // Build the HTML structure for the video page
            $htmlContent = "<!DOCTYPE html>
<html>
<head>
    <title>Video Page</title>
</head>
<body>
    <h1>Video Page</h1>
    <video controls>
        <source src='$videoURL' type='video/mp4'>
        Your browser does not support the video tag.
    </video>
</body>
</html>";

            // Write the HTML content to the new page
            fwrite($videoPage, $htmlContent);
            fclose($videoPage);

            echo "Video uploaded successfully! <a href='videos/video_" . $nextNumber . ".html'>View Video</a>";
        } else {
            echo "Error uploading video.";
        }
    } else {
        echo "Only MP4 files are allowed.";
    }
}
?>
