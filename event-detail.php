<?php
include ('top.php');
$artName = '';
if (isset($_GET['artName'])) {
    $artName = htmlentities($_GET['artName'], ENT_QUOTES, "UTF-8");
}

$debug = FALSE;
if (isset($_GET["debug"])) {
    $debug = true;
}
$myFolder = '../data/';
$myFileName = 'art';
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
        $allArts[] = fgetcsv($file);
    }
    if ($debug) {
        print '<p>Finished reading data. File closed.</p>';
        print '<p>My data array<p><pre> ';
        print_r($allArts);
        print '</pre></p>';
    }
} // ends if file was opened 
//*****************  End Read Weather Data ***********************************//
fclose($file)
?>
<article class='lab4_article'>
    <header>
        <h2>Get involved!</h2>
    </header>
                <?php
                foreach($allArts as $allArt){
                    $thisAllArt= str_replace(' ','', $allArt[1]);
                    if ($artName== $thisAllArt) {
                    print '<figure class="roundedCornerSmall fiftyPercent">';
                    print '<img class="roundedCornerSmall" src="../images/'. $allArt[1] .'" alt="">';
                    print '<figcaption>';
                    print $allArt[2];
                    print '</figcaption>';
                    print '</figure>' . PHP_EOL;
                }        
                }
                ?> 
</article>
<?php
include ('footer.php');
?>

</body>
</html>
