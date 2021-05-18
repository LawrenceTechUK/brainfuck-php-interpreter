<?php
if (empty($_SESSION['file']) == false) {
  $openFile = file_get_contents($_SESSION['file']);
  $openFileArray = array($openfile, 1);
  $pointer = 0;
  $tape = array();
  $i - 0;
  while ($i < strlen($openFile)) {
    $current_instruction = $openFileArray[$i = $i + 1];
    switch ($current_instruction) {
      case '>':
        $pointer = $pointer + 1;
        break;
      case '<':
        $pointer = $pointer - 1;
        break;
      case '+':
        $tape[$pointer] = $tape[$pointer] + 1;
        break;
      case '-':
        $tape[$pointer] = $tape[$pointer] - 1;
        break;
      case '.':
        $output = chr($tape[$pointer]);
        break;
      case ',':
        $tape[$pointer] = ord($_POST['input']);
        break;
      case '[':
        if ($tape[$pointer] == 0) {
            while ($current_instruction != "]") {
              $i = $i + 1;
              $current_instruction = $openFileArray[$i = $i + 1];
            }
        }
        break;
      case ']':
        if ($tape[$pointer] !=  0) {
          while ($current_instruction != "[") {
            $i = $i - 1;
            $current_instruction = $openFileArray[$i = $i + 1];
          }
        }
        break;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>brainfuck</title>
  </head>
  <body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      Select file to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload File" name="submit">
    </form>
    <p>Output: <?php echo $output; ?></p>
    <form method="post" enctype="multipart/form-data">
      Other input:
      <input type="text" name="input" id="input">
      <input type="submit" value="Upload Image" name="submit">
    </form>
  </body>
</html>
