<?php
include 'top.php';
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
// if ($debug){  // later you can uncomment the if statement
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

$email = "";

$introduceSelf = "";

$gender = "Female";

$residing = "Burlington";

$ageRange = "20-30";

$volunteer = true;    // checked
$service = false; // not checked

$monday = true;    // checked
$tuesday = false; // not checked
$wednesday = false; // not checked
$thursday = false; // not checked
$friday = false; // not checked
$saturday = false; // not checked
$sunday = false; // not checked

$english = true; // checked
$french = false; //  not checked 
$spanish = false; //not checked
$otherLan = false; //not checked
        
$services = "translation";   // pick the option
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;

$emailERROR = false;

$introduceERROR = false;

$genderERROR = false;

$residingERROR = false;

$ageERROR = false;

$activityERROR = false;
$totalChecked = 0;

$timeERROR = false;
$totalChecked1 = 0;

$languageERROR = false;
$totalChecked2 = 0;

$serviceERROR = false;
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

    $introduceSelf = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $introduceSelf;

    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $gender;
    
    $residing = htmlentities($_POST["radResiding"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $residing;
    
    $ageRange = htmlentities($_POST["radAgeRange"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $ageRange;

    if (isset($_POST["chkVolunteer"])) {
        $volunteer = true;
        $totalChecked++;
    } else {
        $volunteer = false;
    }
    $dataRecord[] = $volunteer;

    if (isset($_POST["chkService"])) {
        $service = true;
        $totalChecked++;
    } else {
        $service = false;
    }
    $dataRecord[] = $service;
    
    // @@@@@@@@@@@@@@@@@@@@@@@@  Time Available section  @@@@@@@@@@@@@@@@@@@@//

    if (isset($_POST["chkMonday"])) {
        $monday = true;
        $totalChecked1++;
    } else {
        $monday = false;
    }
    $dataRecord[] = $monday;

    if (isset($_POST["chkTuesday"])) {
        $tuesday = true;
        $totalChecked1++;
    } else {
        $tuesday = false;
    }
    $dataRecord[] = $tuesday;
    
    if (isset($_POST["chkWednesday"])) {
        $wednesday = true;
        $totalChecked1++;
    } else {
        $wednesday = false;
    }
    $dataRecord[] = $wednesday;
    
    if (isset($_POST["chkThursday"])) {
        $thursday = true;
        $totalChecked1++;
    } else {
        $thursday = false;
    }
    $dataRecord[] = $thursday;
    
    if (isset($_POST["chkFriday"])) {
        $friday = true;
        $totalChecked1++;
    } else {
        $friday = false;
    }
    $dataRecord[] = $friday;
    
    if (isset($_POST["chkSaturday"])) {
        $saturday = true;
        $totalChecked1++;
    } else {
        $saturday = false;
    }
    $dataRecord[] = $saturday;
    
    if (isset($_POST["chkSunday"])) {
        $sunday = true;
        $totalChecked1++;
    } else {
        $sunday = false;
    }
    $dataRecord[] = $sunday;
    
    //@@@@@@@@@@@@@@@@@@@@@  END OF TIME AVAILABLE SECTION @@@@@@@@@@@@@@@@@@@//
    
    //@@@@@@@@@@@@@@@@@@@@@  language Spoken section @@@@@@@@@@@@@@@@@@@@@@@@@//

    if (isset($_POST["chkEnglish"])) {
        $english = true;
        $totalChecked2++;
    } else {
        $english = false;
    }
    $dataRecord[] = $english;

    if (isset($_POST["chkFrench"])) {
        $french = true;
        $totalChecked2++;
    } else {
        $french = false;
    }
    $dataRecord[] = $french;
    
    if (isset($_POST["chkSpanish"])) {
        $spanish = true;
        $totalChecked2++;
    } else {
        $spanish = false;
    }
    $dataRecord[] = $spanish;
    
    if (isset($_POST["chkOtherLan"])) {
        $otherLan = true;
        $totalChecked2++;
    } else {
        $otherLan = false;
    }
    $dataRecord[] = $otherLan;
    
    //@@@@@@@@@@@@@@@@@  List of Service section @@@@@@@@@@@@@@@@@@@@@@@@@@@@//

    $services = htmlentities($_POST["lstServices"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $services;

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

    if ($introduceSelf != "") {
        if (!verifyAlphaNum($comments)) {
            $errorMsg[] = "Your self-introduction appears to have extra characters that are not allowed.";
            $commentsERROR = true;
        }
    }

    if ($gender != "Male" AND $gender != "Female" AND $gender != "Neutral") {
        $errorMsg[] = "Please choose a gender";
        $genderERROR = true;
    }
    
    if ($residing != "Burlington" AND $residing != "Winooski" AND $residing != "Colchester" AND $residing != "None of the above") {
        $errorMsg[] = "Please choose a city";
        $residingERROR = true;
    }
    
    if ($ageRange != "20-30" AND $ageRange != "31-40" AND $ageRange != "41-50") {
        $errorMsg[] = "Please choose a age range";
        $ageERROR = true;
    }

    if ($totalChecked < 1) {
        $errorMsg[] = "Please choose at least one activity";
        $activityERROR = true;
    }

    if ($totalChecked1 < 1) {
        $errorMsg[] = "Please choose at least one free day";
        $timeERROR = true;
    }
    if ($totalChecked2 < 1) {
        $errorMsg[] = "Please choose at least one language";
        $classERROR = true;
    }

    if ($services == "") {
        $errorMsg[] = "Please choose a service";
        $serviceERROR = true;
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
                <legend>Introduce yourself</legend>
                <p>
                    <label  class="required" for="txtIntroduction">Introduction</label>
                    <textarea <?php if ($introduceERROR) print 'class="mistake"'; ?>
                        id="txtIntroduction" 
                        name="txtIntroduction" 
                        onfocus="this.select()" 
                        tabindex="200"><?php print $introduceSelf; ?></textarea>
                    <!-- NOTE: no blank spaces inside the text area, be sure to close 
                            the text area directly -->
                </p>
            </fieldset>
            
            <!-- This is for Gender -->
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
                               tabindex="573"
                               <?php if ($gender == "Female") echo ' checked="checked" '; ?>>
                        Female</label>
                </p>

                <p>    
                    <label class="radio-field">
                        <input type="radio" 
                               id="radGenderNeutral" 
                               name="radGender" 
                               value="Neutral" 
                               tabindex="574"
                               <?php if ($gender == "Neutral") echo ' checked="checked" '; ?>>
                        Neutral</label>
                </p>

            </fieldset>
            
            <!-- This is for residence -->
            <fieldset class="radio <?php if ($residingERROR) print ' mistake'; ?>">
                <legend>Which city do you live in?</legend>
                <p>
                    <label class="radio-field">
                        <input type="radio" 
                               id="radBurlington" 
                               name="radResiding" 
                               value="Burlington" 
                               tabindex="582"
                               <?php if ($residing == "Burlington") echo ' checked="checked" '; ?>>
                        Burlington</label>
                </p>

                <p>    
                    <label class="radio-field">
                        <input type="radio" 
                               id="radWinooski" 
                               name="radResiding" 
                               value="Winooski" 
                               tabindex="583"
                               <?php if ($residing == "Winooski") echo ' checked="checked" '; ?>>
                        Winooski</label>
                </p>

                <p>    
                    <label class="radio-field">
                        <input type="radio" 
                               id="radColchester" 
                               name="radResiding" 
                               value="Colchester" 
                               tabindex="584"
                               <?php if ($residing == "Colchester") echo ' checked="checked" '; ?>>
                        Colchester</label>
                </p>
                
                <p>    
                    <label class="radio-field">
                        <input type="radio" 
                               id="radNoneAbove" 
                               name="radResiding" 
                               value="None of the above" 
                               tabindex="585"
                               <?php if ($residing == "None of the above") echo ' checked="checked" '; ?>>
                        None of the above</label>
                </p>
            </fieldset>
            
        <!-- This is for age -->
            <fieldset class="radio <?php if ($ageERROR) print ' mistake'; ?>">
                <legend>What is your age range?</legend>
                <p>
                    <label class="radio-field">
                        <input type="radio" 
                               id="rad20" 
                               name="radAgeRange" 
                               value="20-30" 
                               tabindex="592"
                               <?php if ($ageRange == "20-30") echo ' checked="checked" '; ?>>
                        20-30</label>
                </p>

                <p>
                    <label class="radio-field">
                        <input type="radio" 
                               id="rad30" 
                               name="radAge" 
                               value="31-40" 
                               tabindex="593"
                               <?php if ($ageRange == "31-40") echo ' checked="checked" '; ?>>
                        31-40</label>
                </p>

                <p>
                    <label class="radio-field">
                        <input type="radio" 
                               id="rad40" 
                               name="radAge" 
                               value="41-50" 
                               tabindex="594"
                               <?php if ($ageRange == "41-50") echo ' checked="checked" '; ?>>
                        41-50</label>
                </p>                
            </fieldset>

            <fieldset class="checkbox <?php if ($activityERROR) print ' mistake'; ?>">
                <legend>Do you like (choose at least one and check all that apply):</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($volunteer) print " checked "; ?>
                            id="chkVolunteer"
                            name="chkVolunteer"
                            tabindex="620"
                            type="checkbox"
                            value="Volunteer"> Volunteer </label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($service) print " checked "; ?>
                            id="chkService" 
                            name="chkService" 
                            tabindex="630"
                            type="checkbox"
                            value="Service"> Service </label>
                </p>
            </fieldset>
            
            <!-- checkbox for time available -->
            <fieldset class="checkbox <?php if ($timeERROR) print ' mistake'; ?>">
                <legend>What time are you available? (choose at least one and check all that apply):</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($monday) print " checked "; ?>
                            id="chkMonday"
                            name="chkMonday"
                            tabindex="720"
                            type="checkbox"
                            value="Monday"> Monday</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($tuesday) print " checked "; ?>
                            id="chkTuesday"
                            name="chkTuesday"
                            tabindex="730"
                            type="checkbox"
                            value="Tuesday">Tuesday</label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($wednesday) print " checked "; ?>
                            id="chkWednesday"
                            name="chkWednesday"
                            tabindex="740"
                            type="checkbox"
                            value="Wednesday"> Wednesday </label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($thursday) print " checked "; ?>
                            id="chkThursday"
                            name="chkThursday"
                            tabindex="741"
                            type="checkbox"
                            value="Thursday"> Thursday </label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($friday) print " checked "; ?>
                            id="chkFriday"
                            name="chkFriday"
                            tabindex="743"
                            type="checkbox"
                            value="Friday"> Friday </label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($saturday) print " checked "; ?>
                            id="chkSaturday"
                            name="chkSaturday"
                            tabindex="744"
                            type="checkbox"
                            value="Saturday"> Saturday </label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($sunday) print " checked "; ?>
                            id="chkSunday"
                            name="chkSunday"
                            tabindex="745"
                            type="checkbox"
                            value="Sunday"> Sunday </label>
                </p> 
            </fieldset>
            
            <!-- language spoken section -->
            <fieldset class="checkbox <?php if ($languageERROR) print ' mistake'; ?>">
                <legend>What language can you speak? (choose at least one and check all that apply):</legend>

                <p>
                    <label class="check-field">
                        <input <?php if ($english) print " checked "; ?>
                            id="chkEnglish"
                            name="chkEnglish"
                            tabindex="820"
                            type="checkbox"
                            value="English"> English</label>
                </p>

                <p>
                    <label class="check-field">
                        <input <?php if ($french) print " checked "; ?>
                            id="chkFrench"
                            name="chkFrench"
                            tabindex="821"
                            type="checkbox"
                            value="French"> French</label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($spanish) print " checked "; ?>
                            id="chkSpanish"
                            name="chkSpanish"
                            tabindex="822"
                            type="checkbox"
                            value="Spanish"> Spanish</label>
                </p>
                
                <p>
                    <label class="check-field">
                        <input <?php if ($otherLan) print " checked "; ?>
                            id="chkOtherLan"
                            name="chkOtherLan"
                            tabindex="823"
                            type="checkbox"
                            value="other languages"> Other Language </label>
                </p>
            </fieldset>

            <fieldset  class="listbox <?php if ($serviceERROR) print ' mistake'; ?>">
                <legend>What service do you need?</legend>
                <p>
                    <select id="lstServices" 
                            name="lstServices" 
                            tabindex="920" >
                        <option <?php if ($services == "translation") print " selected "; ?>
                            value="translation">Translation</option>

                        <option <?php if ($services == "transportation") print " selected "; ?>
                            value="transportation">Transportation</option>

                        <option <?php if ($services == "case management") print " selected "; ?>
                            value="case management">case management</option>
                        
                        <option <?php if ($services == "emergency cash") print " selected "; ?>
                            value="emergency cash">emergency cash</option>
                        
                        <option <?php if ($services == "first aid kit") print " selected "; ?>
                            value="first aid kit">first aid kit</option>
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
