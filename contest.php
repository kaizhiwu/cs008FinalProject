<?php
include ('top.php');

$joesPondWinners = array(
    array(2013, "<span class='personsName'>Gary Clark</span>", "Barre, VT", "4/24/13", "8:46 a.m."),
    array(2014, "Kelsey Phillips", "Bill Brochu", "Iowa City, IA and Springfield, MA", "4/29/14", "10:06 a.m."),
    array(2015, "Mary Numa", "West Haven CT", "4/29/15", "6:14 p.m."),
    array(2016, "Pamela Swift", "Barre, VT", "4/12/16", "5:04 p.m."),
    array(2017, "Emily Wiggett", "North Danville, VT,", "4/23/17", "4:32 p.m.")
);
$totalWinners = count($joesPondWinners)
?>
<article class='lab3_article'>
    <h2>Last <?php print $totalWinners; ?> Winners</h2>
    <ol>
        <?php
// print array here with your foreach loop
        foreach ($joesPondWinners as $joesPondWinner) {
            print"<li>";
            print"Year: " . $joesPondWinner[0];
            print"  Winner: " . $joesPondWinner[1];
            print"  From: " . $joesPondWinner[2];
            print"  Date: " . $joesPondWinner[3];
            print"  Time: " . $joesPondWinner[4];
            print"</li>";
        }
        ?>         
    </ol>
    <figure class="small">
    <img src="../images/nature_view.gif" alt="nature view">
    <figcaption>Nature view</figcaption>
</figure>
</article>

<?php
// print out the array here with print_r just so you can see what the computer has in memory
print "<p>contents of array:</p>";
print "<pre>";
print_r($joesPondWinners);
print "</pre>";

include ('footer.php');
?>

</body>
</html>