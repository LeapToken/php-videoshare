<?php
$uploadDir = "files/";
$pagesDir = "pages/";

if (isset($_POST["submit"])) {
    $targetFile = $uploadDir . basename($_FILES["fileToUpload"]["name"]);
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        // File uploaded successfully, create a download page
        $fileName = basename($targetFile);
        $pageContent = '<html><head><title>Download Page</title></head><body>';
        $pageContent .= "<h2>Download $fileName:</h2>";
        $pageContent .= "<a href='../$targetFile' download>Download $fileName</a>";
        $pageContent .= '</body></html>';
        
        $pageFileName = $pagesDir . uniqid() . ".html";
        
        file_put_contents($pageFileName, $pageContent);
        
        echo "File uploaded successfully. <a href='$pageFileName'>Click here</a> to access your download page.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
