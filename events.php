<?php
include ('top.php');
$debug = FALSE;
if (isset($_GET["debug"])) {
    $debug = true;
}
$myFolder = 'data/';
$myFileName = 'events';
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
        $allEvents[] = fgetcsv($file);
    }
    if ($debug) {
        print '<p>Finished reading data. File closed.</p>';
        print '<p>My data array<p><pre> ';
        print_r($allEvents);
        print '</pre></p>';
    }
} // ends if file was opened 
//*****************  End Read Weather Data ***********************************//
fclose($file)
?>
<article class='lab4_article'>
    <header>
        <h2>Events</h2>
    </header>
    
        <table>
            <?php
            foreach ($headers as $header) {
                print '<tr class="persist-header">';
                print '<th>' . $header[0] . '</th>';
                print '<th>' . $header[1] . '</th>';
                print '<th>' . $header[2] . '</th>';
                print '<th>' . $header[3] . '</th>';

                print '</tr>' . PHP_EOL;
            }
            foreach ($allEvents as $allEvent) {
                print '<tr>';
                print '<td>' . $allEvent[0] . '</td>';
                print '<td>';
                print '<a href="event-detail.php?eventName=';
                print str_replace(' ','',$allEvent[1]);
                print '">';
                print $allEvent[1];
                print '</a>';
                print '</td>';                
                print '<td>' . $allEvent[2] . '</td>';
                print '<td>' . $allEvent[3] . '</td>';
                
                print '</tr>' . PHP_EOL;
            }
            ?> 
        </table>
</article>
<?php
include ('footer.php');
?>

</body>
</html>
