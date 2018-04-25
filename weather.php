<?php
include ('top.php');
//*****************    Open a CSV file   ********************************//
$debug = FALSE;
if (isset($_GET["debug"])) {
    $debug = true;
}
$myFolder = '';
$myFileName = 'weather';
$fileExt = '.csv';
$filename = $myFolder . $myFileName . $fileExt;
if ($debug) {
    print '<p>filename is ' . $filename;
}
$file = fopen($filename, "r");
if ($debug) {
    if ($file) {
        print '<p>File Opened Successfully.</p>';
    } else {
        print '<p>File Open Failed.</p>';
    }
}
//*****************    End Open A CSV File   ********************************//
//*****************  Read Weather Data ***************************************//
if ($file) {
    if ($debug)
        print '<p>Begin reading data into an array</p>';
// read the header row, copy the line for each header row // you have.
    $headers[] = fgetcsv($file);
    if ($debug) {
        print '<p>Finished reading headers.</p>';
        print '<p>My header array:</p><pre>';
        print_r($headers);
        print '</pre>';
    }
// read all the data
    while (!feof($file)) {
        $weatherDetails[] = fgetcsv($file);
    }
    if ($debug) {
        print '<p>Finished reading data. File closed.</p>';
        print '<p>My data array<p><pre> ';
        print_r($weatherDetails);
        print '</pre></p>';
    }
} // ends if file was opened 
//*****************  End Read Weather Data ***********************************//
fclose($file)
?>
<article class="persist-area">
    <h2>BTV Burlington Weather Data</h2>
    <ol>
        <?php
        $lastWeatherStation="";
        foreach ($weatherDetails as $weatherDetail) {
            if ($lastWeatherStation != $weatherDetail[1]) {
                print '<li>';
                print '<a href="weather-detail.php?weatherStation=';
                print str_replace(' ','',$weatherDetail[1]);
                print '">';
                print $weatherDetail[1];
                print '</a>';
                print '</li>';
                $lastWeatherStation = $weatherDetail[1];
            }
        }
        ?>
    </ol>
</article>
<?php
include ('footer.php');
?>

</body>
</html>
