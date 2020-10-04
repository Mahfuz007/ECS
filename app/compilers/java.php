<?php

putenv("PATH=C:\Program Files\Java\jdk-14\bin");
$CC = "javac";
$out = "java Main";

$filename_code = "Main.java";
$filename_in = "input.txt";
$filename_error = "error.txt";
$runtime_file = "runtime.txt";
$executable = "*.class";

$command = $CC." ".$filename_code;
$command_error = $command." 2>".$filename_error;
$runtime_error_command = $out." 2>".$runtime_file;

$file_code = fopen($filename_code, "w+");
fwrite($file_code, $code);
fclose($file_code);
$file_in = fopen($filename_in, "w+");
fwrite($file_in, $input);
fclose($file_in);

exec("cacls $executable /g everyone:f");
exec("cacls $filename_error /g everyone:f");

shell_exec($command_error);
$error = file_get_contents($filename_error);

global $output;

if(trim($error) == "")
{
    shell_exec($runtime_error_command);
    $runtime_error = file_get_contents($runtime_file);
    $out = $out." < ".$filename_in;
    $output = shell_exec($out);
    $compilationError = "Succes";
}
else if(!strpos($error, "error"))
{
    $out = $out." < ".$filename_in;
    $output = shell_exec($out);
    $compilationError = "Succes";
}
else
{
    $check = 1;
    $compilationError = $error;
    $result = "Compilation Error";
}

if ($check == 0)
{
    //compare output
    $output = trim($output);
    $databaseoutput = str_replace("\r",'',$testCase->outputcase);
    if (strcmp($output, $databaseoutput)==0) {
        $result = "ACCEPTED";
    } else {
        $result = "WRONG ANSWER";
    }
}



exec("del $filename_code");
exec("del *.txt");
exec("del $executable");