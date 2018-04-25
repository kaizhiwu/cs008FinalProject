<!--####################  Main Navigation   #############################-->
<nav>
    <ol>
        <?php
        //Repeat this if block for each menu item
        //designed to give current page a class but also allows
        //you to have more classes if you need them
           print '<li class="';
        if ($path_parts['filename'] == "pictures") {
            print ' activePage ';
        }
        print '">';
        print '<a href="pictures.php">Pictures</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "services") {
            print ' activePage ';
        }
        print '">';
        print '<a href="services.php">Services</a>';
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
        print '<a href="form.php">Contact Us</a>';
        print '</li>';
        
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
        ?>
    </ol>
</nav>