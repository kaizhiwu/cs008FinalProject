<!--####################  Main Navigation   #############################-->
<nav>
    <ol>
        <?php
        //Repeat this if block for each menu item
        //designed to give current page a class but also allows
        //you to have more classes if you need them
           print '<li class="';
        if ($path_parts['filename'] == "art") {
            print ' activePage ';
        }
        print '">';
        print '<a href="art.php">Art</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "contest") {
            print ' activePage ';
        }
        print '">';
        print '<a href="contest.php">Contest</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "index") {
            print ' activePage ';
        }
        print '">';
        print '<a href="index.php">Home</a>';
        print '</li>';

        /*example of repeating */
        print '<li class="';
        if ($path_parts['filename'] == "form") {
            print ' activePage ';
        }
        print '">';
        print '<a href="form.php">Join</a>';
        print '</li>';
        
        print '<li class="';
        if ($path_parts['filename'] == "news") {
            print ' activePage ';
        }
        print '">';
        print '<a href="news.php">News</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "weather") {
            print ' activePage ';
        }
        print '">';
        print '<a href="weather.php">Weather</a>';
        print '</li>';
        ?>
    </ol>
</nav>