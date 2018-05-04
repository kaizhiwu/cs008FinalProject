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
            print str_replace(' ', '', $allEvent[1]);
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
    <p>Vermont and Africa are two very different places. Vermonters enjoy living standards that are luxurious compared to what many Africans. The cold, winter climate is also  vastly different from the sub-sharan climate. Then, there are also polarities of race, wealth and technology.  Despite an immigrants, most Vermonters are white. In fact, according to the national census, 96.9 percent of Vermont of white. The mayors fear that more and more young people are leaving the state for more cosmopolitan cities. In the last decade, Vermont has been pushing for more diversity. This is also reflective in the policies and the commitments in college and universities of Vermont. </p>
    <p>For example, the University of Vermont integrate “diversity and equity and human resource functions into strategically, purpose-driven initiatives and services, we support a culture of excellence at UVM that is diverse and inclusive.” In 2001, the "Lost Boys" made journeys to Vermont from squalid camps in Kenya. They were refugees who fled the civil war in southern Sudan. Although they were among the first arrivals, the the Sudanese are not the only Africans who have taken up residence in Vermont. </p>
    <p>Somali women, people from Afghanistan, Burma, Syria and such were new arrivals to the state. There are African kids now attend schools in the neighborhood, and Shea butter soap and fufu flour can be purchased at grocery stores opened by Somalis and Congolese. Perhaps Burlington area is the most diverse and prominent intersection of cultures in Vermont due to the presence of some 1500 Africans. </p>
    <p>A growing number of young Vermonters are traveling to Ghana, Uganda, Tanzania and other sub-Saharan countries on service-learning trips sponsored by St. Michael's College and other local academic institutions. In addition, Africa-focused programs at churches, schools and colleges around the state are introducing Vermonters to the cultures and histories of countries that are at once horrifyingly poor and enviably rich. Vermont's indigenous tradition of tolerance, together with the cosmopolitan outlook, has primed the state to become a safe harbor for Africans cut adrift from their homelands.</p>
</article>
<?php
include ('footer.php');
?>

</body>
</html>
