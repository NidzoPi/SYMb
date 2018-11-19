
<?php
try {
        //This input should be from somewhere else, hard-coded in this example
    $file_name = 'saznajsve.tar.gzip';

    // Raising this value may increase performance
    $buffer_size = 4096; // read 4kb at a time
    $out_file_name = str_replace('.gzip', '', $file_name); 

    // Open our files (in binary mode)
    $file = gzopen($file_name, 'rb');
    $out_file = fopen($out_file_name, 'wb'); 

    // Keep repeating until the end of the input file
    while (!gzeof($file)) {
        // Read buffer-size bytes
        // Both fwrite and gzread and binary-safe
        fwrite($out_file, gzread($file, $buffer_size));
    }

    // Files are done, close files
    fclose($out_file);
    gzclose($file);

    $phar = new PharData($out_file_name);
    $phar->extractTo('.');
} catch (Exception $e) {
    // handle errors
}
?>
