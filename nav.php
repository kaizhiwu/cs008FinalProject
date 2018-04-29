<!--####################  Main Navigation   #############################-->
<nav>
    <ol>
        <?php
        //Repeat this if block for each menu item
        //designed to give current page a class but also allows
        //you to have more classes if you need them
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
        print '<a href="resource.php">Resources</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "contact") {
            print ' activePage ';
        }
        print '">';
        print '<a href="contact.php">Contact Us</a>';
        print '</li>';
        ?>
        
    </ol>
</nav>