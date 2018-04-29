<?php
include 'top.php';
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
// if ($debug){  // later you can uncomment the if statement
print '<p>Post Array:</p><pre>';
print_r($_POST);
print '</pre>';
// }
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.

$thisURL = $domain . $phpSelf;


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form

$firstName = "";

$email = "kwu4@uvm.edu";

$comments = "";

$gender = "Female";

$hiking = true;    // checked
$kayaking = false; // not checked

$undershirt = true;    // checked
$underwear = false; // not checked

$enviroment = true;    // checked
$geography = false; // not checked

$mountain = "Camels Hump";    // pick the option
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;

$emailERROR = false;

$commentsERROR = false;

$genderERROR = false;

$activityERROR = false;
$totalChecked = 0;

$clotingERROR = false;
$totalChecked1 = 0;

$classERROR = false;
$totalChecked2 = 0;

$mountainError = false;
////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();

// array used to hold form values that will be written to a CSV file
$dataRecord = array();

// have we mailed the information to the user?
$mailed = false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2a Security
    // 
    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry you cannot access this page. ';
        $msg .= 'Security breach detected and reported.</p>';
        die($msg);
    }


    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;

    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $comments;

    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $gender;

    if (isset($_POST["chkHiking"])) {
        $hiking = true;
        $totalChecked++;
    } else {
        $hiking = false;
    }
    $dataRecord[] = $hiking;

    if (isset($_POST["chkKayaking"])) {
        $kayaking = true;
        $totalChecked++;
    } else {
        $kayaking = false;
    }
    $dataRecord[] = $kayaking;

    if (isset($_POST["chkUndershirt"])) {
        $undershirt = true;
        $totalChecked1++;
    } else {
        $hiking = false;
    }
    $dataRecord[] = $undershirt;

    if (isset($_POST["chkUnderwear"])) {
        $underwear = true;
        $totalChecked1++;
    } else {
        $underwear = false;
    }
    $dataRecord[] = $underwear;

    if (isset($_POST["chkEnviroment"])) {
        $enviroment = true;
        $totalChecked2++;
    } else {
        $enviroment = false;
    }
    $dataRecord[] = $enviroment;

    if (isset($_POST["chkGeography"])) {
        $geography = true;
        $totalChecked2++;
    } else {
        $geography = false;
    }
    $dataRecord[] = $geography;

    $mountain = htmlentities($_POST["lstMountains"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $mountain;

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra character.";
        $firstNameERROR = true;
    }

    if ($email == "") {
        $errorMsg[] = 'Please enter your email address';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = 'Your email address appears to be incorrect.';
        $emailERROR = true;
    }

    if ($comments != "") {
        if (!verifyAlphaNum($comments)) {
            $errorMsg[] = "Your comments appear to have extra characters that are not allowed.";
            $commentsERROR = true;
        }
    }

    if ($gender != "Male" AND $gender != "Female" AND $gender != "Neutral") {
        $errorMsg[] = "Please choose a gender";
        $genderERROR = true;
    }

    if ($totalChecked < 1) {
        $errorMsg[] = "Please choose at least one activity";
        $activityERROR = true;
    }

    if ($totalChecked1 < 1) {
        $errorMsg[] = "Please choose at least one cloth";
        $clotingERROR = true;
    }
    if ($totalChecked2 < 1) {
        $errorMsg[] = "Please choose at least one class";
        $classERROR = true;
    }

    if ($mountain == "") {
        $errorMsg[] = "Please choose a favorite mountain";
        $mountainError = true;
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //    
    if (!$errorMsg) {
        if ($debug)
            print PHP_EOL . '<p>Form is valid</p>';


        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2e Save Data
        //
        // This block saves the data to a CSV file.   
        $myFolder = 'data/';

        $myFileName = 'registration';

        $fileExt = '.csv';

        $filename = $myFolder . $myFileName . $fileExt;
        if ($debug)
            print PHP_EOL . '<p>filename is ' . $filename;

        // now we just open the file for append
        $file = fopen($filename, 'a');

        // write the forms informations
        fputcsv($file, $dataRecord);

        // close the file
        fclose($file);


        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2f Create message
        //
        // build a message to display on the screen in section 3a and to mail
        // to the person filling out the form (section 2g).

        $message = '<h2>Your information.</h2>';

        foreach ($_POST as $htmlName => $value) {

            $message .= '<p>';
            // breaks up the form names into words. for example
            // txtFirstName becomes First Name
            $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));

            foreach ($camelCase as $oneWord) {
                $message .= $oneWord . ' ';
            }

            $message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';
        }

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = '';
        $bcc = '';

        $from = 'Join us <customer.service@uvm.edu>';

        // subject of mail should make sense to your form
        $subject = 'Changing Earth: ';

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    } // end form is valid
}   // ends if form was submitted.
//#############################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">

    <?php
//####################################
//
    // SECTION 3a. 
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
        print '<h2>Thank you for providing your information.</h2>';

        print '<p>For your records a copy of this data has ';

        if (!$mailed) {
            print "not ";
        }
        print 'been sent:</p>';
        print '<p>To: ' . $email . '</p>';

        print $message;
    } else {

        print '<h2>Register Today</h2>';
        print '<p class="form-heading">You information will greatly help us with our research.</p>';

        //####################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form

        if ($errorMsg) {
            print '<div id="errors">' . PHP_EOL;
            print '<h2>Your form has the following mistakes that need to be fixed.</h2>' . PHP_EOL;
            print '<ol>' . PHP_EOL;

            foreach ($errorMsg as $err) {
                print '<li>' . $err . '</li>' . PHP_EOL;
            }

            print '</ol>' . PHP_EOL;
            print '</div>' . PHP_EOL;
        }

        //####################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php
          NOTE the line:
          value="<?php print $email; ?>
          this makes the form sticky by displaying either the initial default value (line ??)
          or the value they typed in (line ??)
          NOTE this line:
          <?php if($emailERROR) print 'class="mistake"'; ?>
          this prints out a css class so that we can highlight the background etc. to
          make it stand out that a mistake happened here.
         */
        ?>

        <form action="<?php print $phpSelf; ?>"
              id="frmRegister"
              method="post">

            <fieldset class="contact">
                <legend>Contact Information</legend>
                <p>
                    <label class="required text-field" for="txtFirstName">First Name</label>  
                    <input autofocus
                    <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                           id="txtFirstName"
                           maxlength="45"
                           name="txtFirstName"
                           onfocus="this.select()"
                           placeholder="Enter your first name"
                           tabindex="100"
                           type="text"
                           value="<?php print $firstName; ?>"                    
                           >                    
                </p>

                <p>   
                    <label class="required text-field" for="txtEmail">Email</label>
                    <input 
                    <?php if ($emailERROR) print 'class="mistake"'; ?>
                        id="txtEmail"
                        maxlength="45"
                        name="txtEmail"
                        onfocus="this.select()"
                        placeholder="Enter a valid email address"
                        tabindex="120"
                        type="text"
                        value="<?php print $email; ?>"
                        >
                </p>
            </fieldset> <!-- ends contact -->

            <fieldset class="textarea">
                <p>
                    <label  class="required" for="txtComments">Comments</label>
                    <textarea <?php if ($commentsERROR) print 'class="mistake"'; ?>
                        id="txtComments" 
                        name="txtComments" 
                        onfocus="this.select()" 
                        tabindex="200"><?php print $comments; ?></textarea>
                    <!-- NOTE: no blank spaces inside the text area, be sure to close 
                            the text area directly -->
                </p>
            </fieldset>

            <fieldset class="radio <?php if ($genderERROR) print ' mistake'; ?>">
                <legend>What is your gender?</legend>
                <p>
                    <label class="radio-field">
                        <input type="radio" 
                               id="radGenderMale" 
                               name="radGender" 
                               value="Male" 
                               tabindex="572"
                               <?php if ($gender == "Male") echo ' checked="checked" '; ?>>
                        Male</label>
                </p>

                <p>    
                    <label class="radio-field">
                        <input type="radio" 
                               id="radGenderFemale" 
                               name="radGender" 
                               value="Female" 
                               tabindex="582"
                               <?php if ($gender == "Female") echo ' checked="checked" '; ?>>
                        Female</label>
                </p>

                <p>    
                    <label class="radio-field">
                        <input type="radio" 
                               id="radGenderNeutral" 
                               name="radGender" 
                               value="Neutral" 
                               tabindex="583"
                               <?php if ($gender == "Neutral") echo ' checked="checked" '; ?>>
                        Neutral</label>
                </p>

            </fieldset>

            <fieldset class="checkbox <?php if ($activityERROR) print ' mistake'; ?>">
                <legend>Do you like (choose at least one and check all that apply):</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($hiking) print " checked "; ?>
                            id="chkHiking"
                            name="chkHiking"
                            tabindex="420"
                            type="checkbox"
                            value="Hiking"> Hiking</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($kayaking) print " checked "; ?>
                            id="chkKayaking" 
                            name="chkKayaking" 
                            tabindex="430"
                            type="checkbox"
                            value="Kayaking"> Kayaking</label>
                </p>
            </fieldset>

            <fieldset class="checkbox <?php if ($clotingERROR) print ' mistake'; ?>">
                <legend>Are you wearing (choose at least one and check all that apply):</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($undershirt) print " checked "; ?>
                            id="chkUndershirt"
                            name="chkUndershirt"
                            tabindex="520"
                            type="checkbox"
                            value="Undershirt"> Undershirt</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($underwear) print " checked "; ?>
                            id="chkUnderwear" 
                            name="chkUnderwear" 
                            tabindex="530"
                            type="checkbox"
                            value="Underwear"> Underwear</label>
                </p>
            </fieldset>

            <fieldset class="checkbox <?php if ($classERROR) print ' mistake'; ?>">
                <legend>Have you taken (choose at least one and check all that apply):</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($geography) print " checked "; ?>
                            id="chkGeography"
                            name="chkGeography"
                            tabindex="620"
                            type="checkbox"
                            value="Geography"> Geography</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($enviroment) print " checked "; ?>
                            id="chkEnvironment" 
                            name="chkEnvironment" 
                            tabindex="630"
                            type="checkbox"
                            value="Environment"> Environment</label>
                </p>
            </fieldset>

            <fieldset  class="listbox <?php if ($mountainERROR) print ' mistake'; ?>">
                <legend>Favorite Mountain</legend>
                <p>
                    <select id="lstMountains" 
                            name="lstMountains" 
                            tabindex="520" >
                        <option <?php if ($mountain == "HayStack Mountain") print " selected "; ?>
                            value="HayStack Mountain">HayStack Mountain</option>

                        <option <?php if ($mountain == "Camels Hump") print " selected "; ?>
                            value="Camels Hump">Camels Hump</option>

                        <option <?php if ($mountain == "Laraway Mountain") print " selected "; ?>
                            value="Laraway Mountain">Laraway Mountain</option>
                    </select>
                </p>
            </fieldset>

            <fieldset class="buttons">
                <legend></legend>
                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register" >
            </fieldset> <!-- ends buttons -->

        </form>

        <?php
    } //end body submit
    ?>

</article>

<?php include 'footer.php'; ?>

</body>
</html>
