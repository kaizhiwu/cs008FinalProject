<!--####################  Main Navigation   #############################-->
<nav>
    <ol>
        <?php
        
        print '<li class="';
        if ($path_parts['filename'] == "home") {
            print ' activePage ';
        }
        print '">';
        print '<a href="home.php">Home</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "about") {
            print ' activePage ';
        }
        print '">';
        print '<a href="about.php">About Us</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "services") {
            print ' activePage ';
        }
        print '">';
        print '<a href="services.php">Services</a>';
        print '</li>';

        /*example of repeating */
        print '<li class="';
        if ($path_parts['filename'] == "events") {
            print ' activePage ';
        }
        print '">';
        print '<a href="events.php">Events</a>';
        print '</li>';
        
        print '<li class="';
        if ($path_parts['filename'] == "resources") {
            print ' activePage ';
        }
        print '">';
        print '<a href="resources.php">Resources</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "form") {
            print ' activePage ';
        }
        print '">';
        print '<a href="form.php">Contact Us</a>';
        print '</li>';
        ?>
        
    </ol>
</nav>