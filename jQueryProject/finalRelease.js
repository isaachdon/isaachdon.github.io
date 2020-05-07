/*
    Filename: finalRelease.js
    Written by: Isaac Herndon (INH)
    Purpose: add functionality for final release page
    Last Modified: 05/02/2020
    Modification History: 
    04/29/2020: Created Date
    05/01/2020: Added comments (INH)
    05/02/2020: Fixed header block documentation (INH)
*/
$(document).ready(function(){
    
    $( "input[type='submit']" ).button();		// Use the jQuery UI library to style <input type="submit">
    $( "input[type='reset']" ).button();		// Use the jQuery UI library to style <input type="reset">
    
    /*
    Purpose: doesn't allow user to type numbers
    Parameters: N/A
    Return: nothing if a number is pressed
    */
    $('#first').on('keypress', function(key) {
		if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45)) {
			return false;	
		}
	});
    
    /*
    Purpose: doesn't allow user to type numbers
    Parameters: N/A
    Return: nothing if a number is pressed
    */
    $('#last').on('keypress', function(key) {
		if((key.charCode < 97 || key.charCode > 122) && (key.charCode < 65 || key.charCode > 90) && (key.charCode != 45)) {
			return false;	
		}
	});
    
    /*
    Purpose: doesn't allow user to type letters or nonstandard phone punctuation
    Parameters: N/A
    Return: nothing if a letter or nonstandard phone punctuation is pressed
    */
	$('#phone').on('keypress', function(key) {
        if(key.charCode > 57) {
			return false;
		}
    });
    
    /*
    Purpose: doesn't allow user to type letters
    Parameters: N/A
    Return: nothing if a letter is pressed
    */
	$('#carSpinner').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) {
			return false;
		}
    });
    
    /*
    Purpose: doesn't allow user to type letters
    Parameters: N/A
    Return: nothing if a letter is pressed
    */
	$('#shopSpinner').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) {
			return false;
		}
    });
    
    /*
    Purpose: doesn't allow user to type letters
    Parameters: N/A
    Return: nothing if a letter is pressed
    */
	$('#equipSpinner').on('keypress', function(key) {
        if(key.charCode < 48 || key.charCode > 57) {
			return false;
		}
    });
    
    //list of tags for autocomplete to look through
    var availableTags = [
        "Automobiles",
        "Basic Learning",
        "Basically an Apprenticeship Learning",
        "Car Purchase",
        "Car Rental",
        "Equipment Rental",
        "Fabrication Learning",
        "Garage",
        "Shop Rental",
        "NA"
    ];
    
    //jQuery UI for autocomplete, source being availableTags
    $( "#tags" ).autocomplete({
       source: availableTags
    });
    
    //jQuery UI for tabs
    $('#information').tabs();

    //jQuery UI for datepicker, minimum date being the current day
    $( "#date" ).datepicker({
        minDate: -0
    });

    //jQuery UI for spinner, minimum of 0 and no maximum
    $('#carSpinner').spinner({
        range: true,
        min: 0,
        max: null
    })

    //jQuery UI for spinner, minimum of 0 and no maximum
    $('#shopSpinner').spinner({
        range: true,
        min: 0,
        max: null
    })

    //jQuery UI for spinner, minimum of 0 and no maximum
    $('#equipSpinner').spinner({
        range: true,
        min: 0,
        max: null
    })

    //jQuery UI for checkboxes
    $( ".checkboxes" ).checkboxradio();
    
    //jQuery UI for radio buttons
    $("input[name='radio']").checkboxradio();
    
    /*
    Purpose: displays the scraped data in the output div and validates
    Parameters: N/A
    Return: All data put into the form in the output area
    */
    $.validator.setDefaults({
        
        /*
        Purpose: depletes the need to have the program stop
        Parameters: N/A
        Return: All data put into the form
        */
        submitHandler: function() {
            
            //first name field
            var first = new String($('#first').val());
            
            //last name field
            var last = new String($('#last').val());
            
            //email field
            var email = new String($('#email').val());
            
            //password field
            var pass = new String($('#pass').val());
            
            //phone field
            var phone = new String($('#phone').val());
            
            //start string which will contain the list of checkboxes checked
            var strCheckboxes = "";
            
            /*
            Purpose: check each checkbox for whether it is checked, and add its value to strCheckboxes if it is checked
            Parameters: N/A
            Return: strCheckboxes will contain a list of all checkboxes checked
            */
            $('input[name="checkbox"]:checked').each(function() {
                strCheckboxes += $(this).val() + " ";
            })

            //initiate hourly rate total
            var checkboxTotal = 0;

            /*
            Purpose: if the 'Basic Fix Learning' button is checked, add 15 to the hourly rate, and change whether the output will say it is checked or not
            Parameters: N/A
            Return: if checked, add 15 to checkboxTotal and create basic as "Yes". If not checked, don't add anything, and create basic as "No"
            */
            if (strCheckboxes.includes('Basic')) {
                checkboxTotal += 15;
                var basic = "Yes";
            } else {
                var basic = "No";
            }

            /*
            Purpose: if the 'Fabrication Learning' button is checked, add 20 to the hourly rate, and change whether the output will say it is checked or not
            Parameters: N/A
            Return: if checked, add 20 to checkboxTotal and create fabrication as "Yes". If not checked, don't add anything, and create fabrication as "No"
            */
            if (strCheckboxes.includes('Fabrication')) {
                checkboxTotal += 20;
                var fabrication = "Yes";
            } else {
                var fabrication = "No";
            }

            /*
            Purpose: if the 'Basically an Apprentice Learning' button is checked, add 20 to the hourly rate, and change whether the output will say it is checked or not
            Parameters: N/A
            Return: if checked, add 20 to checkboxTotal and create apprentice as "Yes". If not checked, don't add anything, and create apprentice as "No"
            */
            if (strCheckboxes.includes('Apprentice')) {
                checkboxTotal += 20;
                var apprentice = "Yes";
            } else {
                var apprentice = "No";
            }

            //carRental spinner
            var carRental = new String(parseInt($('#carSpinner').val()));
            
            //shopRental spinner
            var shopRental = new String(parseInt($('#shopSpinner').val()));
            
            //equipRental spinner
            var equipRental = new String(parseInt($('#equipSpinner').val()));
            
            //date field
            var date = new String($('#date').val());
            
            //radio buttons result
            var understand = new String($('input[name$="radio"]:checked').val());
            
            //autocomplete field
            var additionalInfo = new String($('#tags').val());

            //reset the output area if there was content before
            $("#output").html("");
            
            //put in new content from fields
            $('#output')
                    .append('<hr/><h1>Output</h1><br><span class="darker">Name: ' + first + ' ' + last + '</span>')
                    .append('<br><span class="lighter">Email: ' + email + '</span>')
                    .append('<br><span class="darker">Password: ' + pass + '</span>')
                    .append('<br><span class="lighter">Phone: ' + phone + '</span>')
                    .append('<br><span class="darker">Basic Fix Learning: ' + basic + '</span>')
                    .append('<br><span class="lighter">Fabrication Learning: ' + fabrication + '</span>')
                    .append('<br><span class="darker">Basically an Apprentice Learning: ' + apprentice + '</span>')
                    .append('<br><span class="lighter">Overall price added to bill per hour: $' + checkboxTotal + '</span>')
                    .append('<br><span class="darker">Number of rental cars selected: ' + carRental + '</span>')
                    .append('<br><span class="lighter">Number of shop rentals selected: ' + shopRental + '</span>')
                    .append('<br><span class="darker">Number of equipment rentals selected: ' + equipRental + '</span>')
                    .append('<br><span class="lighter">Total rental bill per day: $' + (parseInt($('#carSpinner').val())*100 + parseInt($('#shopSpinner').val())*150 + parseInt($('#equipSpinner').val())*50) + '</span>')
                    .append('<br><span class="darker">Visit Date: ' + date + '</span>')
                    .append('<br><span class="lighter">Understand?: ' + understand + '</span>')
                    .append('<br><span class="darker">Additional info requested: ' + additionalInfo + '</span><br>');
            
        },
        
        /*
        Purpose: define placement of the validator error message
        Parameters: error, element
        Return: the error message in the correct location
        */
        errorPlacement: function(error, element) {
            if (element.attr("id") == "carSpinner" || element.attr("id") == "shopSpinner" || element.attr("id") == "equipSpinner") {
					error.insertAfter($(element).parent());
            } else if (element.attr("name") == "radio") {
					error.insertAfter($("#radio-2"));
            } else {
                error.insertAfter(element);
            }
        }
    
    }); //end validator.setDefaults
    
    /*
    Purpose: calls validator. Specifies what is required for each error and the message to give
    Parameters: N/A
    Return: the error message
    */
    $("#formId").validate({
        rules: {
				first: {							//<input name="first">
					required: true,
					maxlength: 15,
                    lettersonly: true
				},
				last: {							//<input name="last">
					required: true,
					maxlength: 15,
                    lettersonly: true
				},
				email: {							//<input name="email">
					required: true,
					email: true
				},
                password: {							//<input name="password">
					required: true,
					minlength: 5
				},
				confirmPassword: {					//<input name="confirmPassword"
					required: true,
					equalTo: "#pass"
				},
				tel: {							//<input name="tel">
					required: true,
                    phoneUS: true               //accepts international numbers
				},
                carRental: {								//<input name="carRental">
                    required: true,
                    digits: true
                },
                shopRental: {								//<input name="shopRental">
                    required: true,
                    digits: true
                },
                equipRental: {								//<input name="equipRental">
                    required: true,
                    digits: true
                },
				date: {								//<input name="date">
					required: true,
					date: true
				},
                radio: {								//<input name="radio">
                    required: true
                },
                tags: {
                    required: true
                }
			}, // end rules
			messages: {                             // These messages are displayed when user input doesn't match the rules
				first: {							//<input name="first">
					required: " Please enter your first name",
					maxlength: $.validator.format(" Must not have more than {0} characters"),
                    lettersonly: " Please use only letters"
				},
                last: {								//<input name="last">
                    required: " Please enter your last name",
					maxlength: $.validator.format(" Must not have more than {0} characters"),
                    lettersonly: " Please use only letters"
                },
				email: {							//<input name="email">
					required: " Please enter an email address",
					email: " Please enter a valid email address"
				},
				password: {							//<input name="password">
					required: " Please provide a password",
					minlength: $.validator.format(" Must have at least {0} characters")
				},
				confirmPassword: {					//<input name="confirmPassword"
					required: " Please confirm the password",
					equalTo: " Passwords must match"
				},
				tel: {							//<input name="tel">
					required: " Please enter your phone number",
                    phoneUS: " Please enter a valid number"
				},
                carRental: {								//<input name="carRental">
                    required: " Please indicate how many you need to rent",
                    digits: " Please enter digits only"
                },
                shopRental: {								//<input name="shopRental">
                    required: " Please indicate how many you need to rent",
                    digits: " Please enter digits only"
                },
                equipRental: {								//<input name="equipRental">
                    required: " Please indicate how many you need to rent",
                    digits: " Please enter digits only"
                },
				date: {								//<input name="date">
					required: " Please enter a date for your visit",
					date: " Please enter a valid date"
				},
				radio: {						//<input name="radio">
					required: " Please select an answer"
				},
                tags: {
                    required: " Please type an answer. If you don't need anything else, type NA"
                }
			}  // end messages
    });
        
});

