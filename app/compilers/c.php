<?php
putenv("PATH=C:\Program Files (x86)\CodeBlocks\MinGW\bin");
$CC = "gcc";
$out = APPROOT."/compilers/a.exe";

$filename_code = APPROOT."/compilers/main.c";
$filename_in = APPROOT."/compilers/input.txt";
$filename_error = APPROOT."/compilers/error.txt";
$executable = APPROOT."/compilers/a.exe";
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
    $compilationError = "Succes";
} else {
    $check = 1;
    $compilationError = $error;
    setFlash('failed', '<strong>Compilation Error Or Submit Failed!</strong>');
    redirect('problems/submit');
}

if ($check == 0)
{
    //compare output
    if (strcmp($output, $testCase->outputcase)==0) {
        $result = "ACCEPTED";
    } else {
        $result = "WRONG ANSWER";
    }
}
