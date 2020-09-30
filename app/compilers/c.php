<?php
putenv("PATH=C:\Program Files\CodeBlocks\MinGW\bin");
$CC = "gcc";

$out = "a.exe";

$filename_code = "main.c";
$filename_in = "input.txt";
$filename_error = "error.txt";
$executable = "a.exe";
$command = $CC . " -lm " . $filename_code;
$command_error = $command . " 2>" . $filename_error; //writting error

$file_code = fopen($filename_code, "w+");
fwrite($file_code, $code);
fclose($file_code);
$file_in = fopen($filename_in, "w+");
fwrite($file_in, $input);
fclose($file_in);

exec("cacls  $executable /g everyone:f");
exec("cacls  $filename_error /g everyone:f");

shell_exec($command_error);
$error = file_get_contents($filename_error);

global $output;

if (trim($error) == "") {
    $out = $out . " < " . $filename_in;   //if input
    $output = shell_exec($out);
    $compilationError = "Succes";
} else if (!strpos($error, "error")) {
    $out = $out . " < " . $filename_in;
    $output = shell_exec($out);
    $compilationError = "Success";
} else {
    $check = 1;
    $compilationError = $error;
    $result = "Compilation Error";
}

if ($check == 0)
{
    
    $output = trim($output);
    $databaseoutput = str_replace("\r",'',$testCase->outputcase);
    if (strcmp($output, $databaseoutput)==0) {
        $result = "ACCEPTED";
    } else {
        $result = "WRONG ANSWER";
    }
}
