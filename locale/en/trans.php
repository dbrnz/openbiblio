<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/**********************************************************************************
 *   Instructions for translators:
 *
 *   All gettext key/value pairs are specified as follows:
 *     $trans["key"] = "<php translation code to set the $text variable>";
 *   Allowing translators the ability to execute php code withint the transFunc string
 *   provides the maximum amount of flexibility to format the languange syntax.
 *
 *   Formatting rules:
 *   - Input arguments must be surrounded by % characters (i.e. %pageCount%).
 *   - A backslash ('\') needs to be placed before any special php characters
 *     (such as $, ", etc.) within the php translation code.
 *
 *   Simple Example:
 *     $trans["homeWelcome"]       = "Welcome to OpenBiblio";
 *
 *   Example Containing Argument Substitution:
 *     $trans["searchResult"]      = "page %page% of %pages%";
 *
 *   Example Containing a PHP If Statment and Argument Substitution:
 *     $trans["searchResult"]      =
 *       "if (%items% == 1) {
 *         \$text = '%items% result';
 *       } else {
 *         \$text = '%items% results';
 *       }";
 *
 **********************************************************************************
 */
$myTrnas = "./customTrans.php";
if (file_exists($myTrans)) include ($myTrans);

#****************************************************************************
#*  Formats
#****************************************************************************
$trans["headerDateFormat"]	 = "m.d.Y";


#****************************************************************************
#*  Common translation text
#****************************************************************************
$trans[" THIS ITEM WAS NOT CHECKED OUT."] = " THIS ITEM WAS NOT CHECKED OUT.";
$trans["\$t != \"string\""] = "\$t != \"string\"";
$trans["\$type != \"order_by\""] = "\$type != \"order_by\"";
$trans["%barcode% added to shelving cart."] = "%barcode% added to shelving cart.";
$trans["%count% bookings in cart."] = "%count% bookings in cart.";
$trans["%count% calendars."] = "%count% calendars.";
$trans["%count% copies with broken status references"] = "%count% copies with broken status references";
$trans["%count% double check outs"] = "%count% double check outs";
$trans["%count% items in cart."] = "%count% items in cart.";
$trans["%count% results found."] = "%count% results found.";
$trans["%count% sites."] = "%count% sites.";
$trans["%count% unattached copies"] = "%count% unattached copies";
$trans["%count% unattached copy status history records"] = "%count% unattached copy status history records";
$trans["%count% unattached images"] = "%count% unattached images";
$trans["%count% unattached MARC fields"] = "%count% unattached MARC fields";
$trans["%count% unattached MARC subfields"] = "%count% unattached MARC subfields";
$trans["%units% Late"] = "%units% Late";
$trans["(enter 0 for unlimited)"] = "(enter 0 for unlimited)";
$trans["Accompanying Material"] = "Accompanying Material";
$trans["Account"] = "Account";
$trans["Active"] = "Active";
$trans["Action query returned results."] = "Action query returned results.";
$trans["'Add New' Successful"] = "'Add New' Successful!";
$trans["Add a custom biblio copy field"] = "Add a custom biblio copy field";
$trans["Add a Transaction"] = "Add a Transaction";
$trans["Add custom member field"] = "Add custom member field";
$trans["Add List To Cart"] = "Add List to Cart";
$trans["Add Member..."] = "Add Member...";
$trans["Add New Collection"] = "Add New Collection";
$trans["Add New Copy"] = "Add New Copy";
$trans["Add New Item"] = "Add New Item";
$trans["Add new custom field"] = "Add new custom field";
$trans["Add New Image..."] = "Add New Image...";
$trans["Add New Photo"] = "Add New Photo";
$trans["Add New Material Type"] = "Add New Material Type";
$trans["Add New Media"] = "Add New Media";
$trans["Add New Site"] = "Add New Site";
$trans["Add New Staff Member"] = "Add New Staff Member";
$trans["Add New State & Abreviation"] = "Add New State & Abreviation";
$trans["Add new successful"] = "Add new successful";
$trans["Add New Theme"] = "Add New Theme";
$trans["Add New"] = "Add New";
$trans["AddNewMtlMsg"] = "Click 'Add to / Modify...' to create new entries";
$trans["Add To Booking"] = "Add to Booking";
$trans["Add To Cart"] = "Add to Cart";
$trans["Add to Shelving Cart"] = "Add to Shelving Cart";
$trans["Add"] = "Add";
$trans["Added Before Date"] = "Added Before Date";
$trans["Address Line 1"] = "Address Line 1";
$trans["Address Line 2"] = "Address Line 2";
$trans["Admin Summary"] = "Admin Summary";
$trans["Admin"] = "Admin";
$trans["adminIndexDesc"] = "Use the functions located in the left hand navigation area to manage your library's staff and administrative records.";
$trans["Adult Checkout Limit:"] = "Adult Checkout Limit:";
$trans["Adult"] = "Adult";
$trans["Advanced Search?"] = "Advanced Search?";
$trans["Align:"] = "Align:";
$trans["All"] = "All";
$trans["Amount is required."] = "Amount is required.";
$trans["Amount must be numeric."] = "Amount must be numeric.";
$trans["Amount"] = "Amount";
$trans["Amount:"] = "Amount:";
$trans["And"] = "And";
$trans["Any"] = "Any";
$trans["Are you sure you want to delete "] = "Are you sure you want to delete ";
$trans["Are you sure you want to delete this copy?"] = "Are you sure you want to delete this copy?";
$trans["Are you sure you want to delete this item?"] = "Are you sure you want to delete this item?";
$trans["Are you sure you want to delete this material field"] = "Are you sure you want to delete this material field?";
$trans["Are you sure you want to delete this cover photo"] = "Are you sure you want to delete this cover photo?";
$trans["As Of"] = "As Of";
$trans["Audience Level:"] = "Audience Level:";
$trans["Author"] = "Author";
$trans["Authorization"] = "Authorization";
$trans["Authorization:"] = "Authorization:";
$trans["Auto Barcode"] = "Auto Barcode";
$trans["Auto Collection"] = "Auto Collection";
$trans["Auto Cutter"] = "Auto Cutter";
$trans["Auto Dewey"] = "Auto Dewey";
$trans["Available"] = "Available";
$trans["Available elsewhere"] = "Available elsewhere";
$trans["Available Themes"] = "Available Themes";
$trans["Background Color:"] = "Background Color:";
$trans["Bad collection type"] = "Bad collection type";
$trans["Bad day number: %day%"] = "Bad day number: %day% (please use yyyy-mm-dd)";
$trans["Bad key (%key%) for %name% table"] = "Bad key (%key%) for %name% table";
$trans["Bad locale metadata: %file%: No class"] = "Bad locale metadata: %file%: No class";
$trans["Bad MARC record, giving up: %err%"] = "Bad MARC record, giving up: %err%";
$trans["Bad mkSQL() format string."] = "Bad mkSQL() format string.";
$trans["Bad month number: %month%"] = "Bad month number: %month% (please use yyyy-mm-dd)";
$trans["Balance"] = "Balance";
$trans["Barcode"] = "Barcode";
$trans["Barcode number already in use."] = "Barcode number already in use.";
$trans["Barcode number in use."] = "Barcode number in use.";
$trans["Barcode Number"] = "Barcode Number";
$trans["Barcode Number:"] = "Barcode Number:";
$trans["Barcodes to delete"] = "Enter barcodes to delete,<br />one entry per line.";
$trans["bibid"] = "bibid";
$trans["Biblio Copy Fields"] = "Biblio Copy Fields";
$trans["Biblio Fields"] = "Biblio Fields";
$trans["Biblio Information"] = "Biblio Information";
$trans["Biblio Search Opts."] = "Biblio Search Opts.";
$trans["BiblioFieldsConfig"] = 'Biblio Fields Configuration for ';
$trans["BiblioFieldsEditor"] = 'Biblio Fields Maintenance';
$trans["biblioMarcEditError"] = "An error occurred processing your request, see below for details.";
$trans["biblioCopyFieldsDelConfirmSure"] = "Are you sure you want to delete biblio copy field, %desc%?";
$trans["biblioCopyFieldsDelMsg"] = "Biblio copy field, %desc%, has been deleted.";
$trans["biblioCopyFieldsEditMsg"] = "Biblio Copy Field, %desc%, has been updated.";
$trans["biblioCopyFieldsNewMsg"] = "Biblio copy field, %desc%, has been added.";
$trans["bold"] = "bold";
$trans["Book Item"] = "Book Item";
$trans["Booked"] = "Booked";
$trans["Booked since"] = "Booked since";
$trans["Booking %item% out of %items% in sequence"] = "Booking %item% out of %items% in sequence";
$trans["Booking cart is empty"] = "Booking cart is empty";
$trans["Booking Cart"] = "Booking Cart";
$trans["Booking Count"] = "Booking Count";
$trans["Booking deleted"] = "Booking deleted";
$trans["Booking History"] = "Booking History";
$trans["Booking Info"] = "Booking Info";
$trans["Booking Information"] = "Booking Information";
$trans["Booking Request"] = "Booking Request";
$trans["Bookings not checked out, errors below"] = "Some bookings could not be checked out; see errors below.";
$trans["Bookings"] = "Bookings";
$trans["Broken histid/booking reference"] = "Broken histid/booking reference";
$trans["Broken RPT code structure"] = "Broken RPT code structure";
$trans["Browse Images"] = "Browse Images";
$trans["Browser not supported"] = "<b>You are using Internet Explorer</b>.<br/><br/>Openbiblio <i>might</i> not work correctly with this version.<br/>Please use either Firefox, Google Chome or Safari.<br/><br/>";
$trans["Bulk Delete"] = "Bulk Delete";
$trans["Bulk Delete Confirm"] = "Are you certain you want to delete %copy% copies and %item% items?";
$trans["Calendar Deleted"] = "Calendar Deleted";
$trans["Calendar"] = "Calendar";
$trans["Calendar:"] = "Calendar:";
$trans["Calendars"] = "Calendars";
$trans["calendarDelConfirmMsg"] = "Are you sure you want to delete calendar %desc%?";
$trans["calendarEditFormMsg"] = "Toggle holidays by clicking on days, weekday letters, or month names.";
$trans["Call Nmbr Type"] = "Call Number Type";
$trans["Call No."] = "Call No.";
$trans["CAN'T FIX:"] = "CAN'T FIX:";
$trans["Can't happen"] = "Can't happen";
$trans["Cancel"] = "Cancel";
$trans["CANNOT BE FIXED AUTOMATICALLY"] = "CANNOT BE FIXED AUTOMATICALLY";
$trans["Cannot connect to database server."] = "Cannot connect to database server.";
$trans["Cannot Delete Master Calendar"] = "Cannot delete master calendar";
$trans["Cannot get database lock"] = "Cannot get database lock";
$trans["Cannot open file: %file%"] = "Cannot open file: %file%";
$trans["Cannot retrieve stats for that dm table"] = "Cannot retrieve stats for that dm table";
$trans["Cannot select database."] = "Cannot select database.";
$trans["Cannot update history entries"] = "Cannot update history entries";
$trans["Caption:"] = "Caption:";
$trans["Caption"] = "Caption";
$trans["Card Number:"] = "Card Number:";
$trans["Cart is empty"] = "Cart is empty";
$trans["Catalog"] = "Catalog";
$trans["Cataloging"] = "Cataloging";
$trans["catalogIndexDesc"]                = "Use the functions located in the left hand navigation area to manage your library's collection efforts.";
$trans["center"] = "center";
$trans["Change Caption"] = "Change Caption";
$trans["Change Dates"] = "Change Dates";
$trans["Change Stock:"] = "Change Stock:";
$trans["Change Theme In Use:"] = "Change Theme In Use:";
$trans["Check Database Integrity"] = "Check Database Integrity";
$trans["Check Database"] = "Check Database";
$trans["Check in all items"] = "Check in all items";
$trans["Check in selected items"] = "Check in selected items";
$trans["Check In"] = "Check In";
$trans["Check Now"] = "Check Now";
$trans["Check Out"] = "Check Out";
$trans["Checkout Limit"] = "Checkout Limit";
$trans["Checked Out"] = "Checked Out";
$trans["Checking Database Integrity"] = "Checking Database Integrity";
$trans["Checking for MySQL Extension..."] = "Checking for MySQL Extension...";
$trans["Checkout Date"] = "Checkout Date";
$trans["Checkout History"] = "Checkout History";
$trans["Checkout Limit"] = "Checkout Limit";
$trans["Checkout"] = "Checkout";
$trans["Choose a New Theme:"] = "Choose a New Theme:";
$trans["Choose a valid value from the list."] = "Choose a valid value from the list.";
$trans["Choose booking date"] = "Choose booking date";
$trans["Circ"] = "Circ";
$trans["Circulation"] = "Circulation";
$trans["Citation"] = "Citation";
$trans["City"] = "City";
$trans["Classification"]="Classification";
$trans["Close Window"] = "Close Window";
$trans["Code"] = "Code";
$trans["Code:"] = "Code:";
$trans["Collection, %desc%, has been added."] = "Collection, %desc%, has been added.";
$trans["Collection, %desc%, has been deleted."] = "Collection, %desc%, has been deleted.";
$trans["Collection, %desc%, has been updated."] = "Collection, %desc%, has been updated.";
$trans["Collection Type"] = "Collection Type";
$trans["Collection"] = "Collection";
$trans["Collection:"] = "Collection:";
$trans["Collections"] = "Collections";
$trans["collectionsDelConfirmMsg"] = "Are you sure you want to delete collection, %desc%?";
$trans["collectionsListNoteMsg"] = "The delete function is only available on collections that have an item count of zero.<br />If you wish to delete a collection with an item count greater than zero,<br/>you will first need to change the material type on those items to another material type.";
$trans["Column count mismatch in TableDisplay"] = "Column count mismatch in TableDisplay";
$trans["Connecting to database server..."] = "Connecting to database server...";
$trans["Connection to database server failed"] = "Connection to database server failed";
$trans["Connection to DB server OK"] = "Connection to DB server OK";
$trans["Contents"] = "Contents";
$trans["%copy% copies and %item% items deleted."] = "%copy% copies and %item% items deleted.";
$trans["Copies Currently On Hold"] = "Copies Currently On Hold";
$trans["copy"] = "copy";
$trans["Copy"] = "Copy";
$trans["Copy barcode %barcode% does not exist"] = "Copy barcode %barcode% does not exist";
$trans["Copy Check In"] = "Copy Check In";
$trans["Copy Has Been Placed On Hold!"] = "Copy Has Been Placed On Hold!";
$trans["Copy Information"] = "Copy Information";
$trans["Copy Status"] = "Copy Status";
$trans["Copy successfully created."] = "Copy successfully created.";
$trans["Copy successfully updated."] = "Copy successfully updated.";
$trans["Copyright"] = "Copyright";
$trans["Copyright Date"] = "Copyright Date";
$trans["Cover Type"] = "Cover Type";
$trans["Create Booking"] = "Create Booking";
$trans["Created Since"] = "Created Since";
$trans["Current Checkouts"] = "Current Checkouts";
$trans["Current Patron:"] = "Current Patron:";
$trans["Current Shelving Cart List"] = "Current Shelving Cart List";
$trans["Custom Copy Fields"] = "Custom Copy Fields";
$trans["Custom Member Fields"] = "Custom Member Fields";
$trans["Cutter Type"] = "Cutter Type";
$trans["Cutter Word"] = "Cutter Word";
$trans["Daily late fee can not be less than zero."] = "Daily late fee can not be less than zero.";
$trans["Daily late fee must be numeric."] = "Daily late fee must be numeric.";
$trans["Daily Late Fee:"] = "Daily Late Fee:";
$trans["Data has been updated."] = "Data has been updated.";
$trans["Database needs upgrading"] = "Database needs upgrading";
$trans["Database not found"] = "Database not found";
$trans["Database query failed"] = "Database query failed";
$trans["Database uptodate"] = "Database uptodate";
$trans["Date"] = "Date";
$trans["Date Added:"] = "Date Added:";
$trans["Date Booked"] = "Date Booked";
$trans["Date Out"] = "Date Out";
$trans["Date Due"] = "Date Due";
$trans["Date Scanned"] = "Date Scanned";
$trans["DBTableBadForeignKey"]          = "Bad foreign key reference \"%key%\" in field \"%field%\"";
$trans["DBTableErrorInserting"]          = "Unexpected error inserting into %name% table: %error%";
$trans["DBTableErrorUpdating"]          = "Unexpected error updating %name% table: %error%";
$trans["DBTableIncompleteKey"]          = "Incomplete key for update; missing %key%";
$trans["DBTableSequenceField"]          = "Sequence field %sequence% not in field list";
$trans["Help"] = "Help";
$trans["Database"] = "Database";
$trans["DatabaseConnectErr"] = "The connection to the database failed with the following error:";
$trans["Date:"] = "Date:";
$trans["Date Added"] = "Date Added";
$trans["Date is in the past"] = "Date is in the past";
$trans["day"] = "day";
$trans["Days due back can not be less than zero."] = "Days due back can not be less than zero.";
$trans["Days due back must be numeric."] = "Days due back must be numeric.";
$trans["Days Due Back:"] = "Days Due Back:";
$trans["Days Late"] = "Days Late";
$trans["Days Out:"] = "Days Out:";
$trans["days"] = "days";
$trans["Default"] = "Default";
$trans["Default (Y/N)"] = "Default (Y/N)";
$trans["Default Dewey"] = "Default Dewey";
$trans["del"] = "del";
$trans["Delete Calendar"] = "Delete Calendar";
$trans["Delete"] = "Delete";
$trans["Delete completed"] = "Delete completed";
$trans["Delete Image"] = "Delete Image";
$trans["Delete items if all copies are deleted."] = "Delete items if all copies are deleted.";
$trans["Delete Site"] = "Delete Site";
$trans["Delete This Item"] = "Delete This Item";
$trans["Deleted"] = "Deleted";
$trans["DeliveryNote"] = "Delivery Note (displayed on booking screen)";
$trans["Description is required."] = "Description is required.";
$trans["Description"] = "Description";
$trans["Description:"] = "Description:";
$trans["Detailed View"] = "Detailed View";
$trans["Dimensions"] = "Dimensions";
$trans["Due Back"] = "Due Back";
$trans["Due Date"] = "Due Date";
$trans["Due Date:"] = "Due Date:";
$trans["Duplicate barcode: %barcode%"] = "Duplicate barcode: %barcode%";
$trans["Earliest Checkout Date"] = "Earliest Checkout Date";
$trans["Earliest Return Date"] = "Earliest Return Date";
$trans["Edit Biblio Copy Field:"] = "Edit Biblio Copy Field:";
$trans["Edit Calendar"] = "Edit Calendar";
$trans["Edit Collection"] = "Edit Collection";
$trans["Edit Copy"] = "Edit Copy";
$trans["Edit Copy Properties"] = "Edit Copy Properties";
$trans["Edit Info"] = "Edit Info";
$trans["Edit Item"] = "Edit Item";
$trans["Edit Item Properties"] = "Edit Item Properties";
$trans["Edit Library Settings"]          = "Edit Library Settings";
$trans["Edit MARC"] = "Edit MARC";
$trans["Edit Media"] = "Edit Media Properties";
$trans["Edit Material Type"] = "Edit Material Type";
$trans["Edit Member Field"] = "Edit Member Field";
$trans["Edit Member Info"] = "Edit Member Info";
$trans["Edit Site"] = "Edit Site";
$trans["Edit System Settings"] = "Edit System Settings";
$trans["Edit Staff Member"] = "Edit Staff Member Information";
$trans["Edit State & Abreviation"] = "Edit State & Abreviation";
$trans["Edit Stock Info"] = "Edit Stock Info";
$trans["Edit This Item"] = "Edit this Item";
$trans["Edit This Photo"] = "Edit this Photo";
$trans["Edit"] = "Edit";
$trans["Editing Custom Fields"] = "Editing Custom Fields";
$trans["Editing Member Type"] = "Editing Member Type";
$trans["edit"] = "edit";
$trans["Edition"] = "Edition";
$trans["Email (optional)"] = "Email (optional)";
$trans["Email Address"] = "Email Address";
$trans["Email Address:"] = "Email Address:";
$trans["Email or ID Number:"] = "Email or ID Number:";
$trans["Email"] = "Email";
$trans["End Date"] = "EndDate";
$trans["Enter barcodes to delete below, one per line."] = "Enter barcodes to delete below, one per line.";
$trans["Error accessing session information."] = "Error accessing session information.";
$trans["Error accessing staff member information."] = "Error accessing staff member information.";
$trans["Error accessing the marc block data."] = "Error accessing the marc block data.";
$trans["Error accessing the marc subfield data."] = "Error accessing the marc subfield data.";
$trans["Error accessing the marc tag data."] = "Error accessing the marc tag data.";
$trans["Error checking for dup username."] = "Error checking for dup username.";
$trans["Error Color:"] = "Error Color:";
$trans["Error creating a new session."] = "Error creating a new session.";
$trans["Error deleting member account information."] = "Error deleting member account information.";
$trans["Error deleting session information."] = "Error deleting session information.";
$trans["Error deleting staff information."] = "Error deleting staff information.";
$trans["Error inserting control field"] = "Error inserting control field";
$trans["Error inserting data field"] = "Error inserting data field";
$trans["Error inserting member account information."] = "Error inserting member account information.";
$trans["Error inserting new staff member information."] = "Error inserting new staff member information.";
$trans["Error inserting subfield"] = "Error inserting subfield";
$trans["Error resetting password."] = "Error resetting password.";
$trans["Error suspending staff member."] = "Error suspending staff member.";
$trans["Error updating session timeout."] = "Error updating session timeout.";
$trans["Error updating staff member information."] = "Error updating staff member information.";
$trans["Error verifying username and password."] = "Error verifying username and password.";
$trans["Every calendar must have a name."] = "Every calendar must have a name.";
$trans["Existing Items"] = "Existing Items";
$trans["expecting \"%exp%\""] = "expecting \"%exp%\"";
$trans["Fatal Error"] = "Fatal Error";
$trans["Fax"] = "Fax";
$trans["Fiction Code"] = "Fiction Code";
$trans["Fiction Codes - Dewey"] = "Dewey Fiction Codes";
$trans["Fiction Codes - LoC"] = "LoC Fiction Codes";
$trans["Fiction Name"] = "Fiction Name";
$trans["Fetch On-line Data"] = "Fetch On-line Data";
$trans["Fetching list of available languages"] = "Fetching list of available languages";
$trans["Field cannot be less than zero"]  = "Field cannot be less than zero";
$trans["Field is required."] = "Field is required.";
$trans["Field must be greater than zero"] = "Field must be greater than zero";
$trans["Field must be numeric"] = "Field must be numeric";
$trans["Field Successfully Deleted"] = "Field Successfully Deleted";
$trans["Field Updated successfully"] = "Field Updated successfully";
$trans["Field"] = "Field";
$trans["Fields marked are required"] = "Fields marked with <span class=\"reqd\">*</span> are required.";
$trans["File name end not jpg or png"] = "File name does not end in '.jpg' or '.png'.";
$trans["Find Item by Barcode Number"] = "Find Item by Barcode Number";
$trans["First Name"] = "First Name";
$trans["First Name:"] = "First Name:";
$trans["FIXED"] = "FIXED";
$trans["Font Color:"] = "Font Color:";
$trans["Font Face:"] = "Font Face:";
$trans["Font Size:"] = "Font Size:";
$trans["For Date:"] = "For Date:";
$trans["Form Type"] = "Form Type";
$trans["Form Type Label"] = 'Data Type:';
$trans["From Year:"] = "From year:";
$trans["Function"] = "Function";
$trans["Funding Source"] = "Funding Source";
$trans["Funding Source:"] = "Funding Source:";
$trans["Get Member by Card Number"] = "Get Member by Card Number";
$trans["getQuoted() called with empty \$str"] = "getQuoted() called with empty \$str";
$trans["Grade Level"] = "Grade Level";
$trans["Go Back"] = "Go Back";
$trans["Grade"] = "Grade";
$trans["Grade:"] = "Grade:";
$trans["headerDateFormat"]	 = "m.d.Y";
$trans["Help"] = "Help";
$trans["Hide Marc Tags"] = "Hide Marc Tags";
$trans["%num% hits found, too many to process"] = "%num% hits found, too many to process";
$trans["hits found"] = "hits found";
$trans["Hold"] = "Hold";
$trans["Hold Requests"] = "Hold Requests";
$trans["Hold request was successfully deleted."] = "Hold request was successfully deleted.";
$trans["Home Phone"] = "Home Phone";
$trans["Host Editor"] = "Host Editor";
$trans["Host URL"] = "Host URL";
$trans["I would like the Media Center staff to:"] = "I would like the Media Center staff to:";
$trans["Image file located in directory"] = "Image files must be located in the openbiblio/images directory.";
$trans["Image File"] = "Image File";
$trans["IN"] = "IN";
$trans["Insert Completed"] = "Insert Completed";
$trans["In Stock"] = "In Stock";
$trans["in use"] = "in use";
$trans["Installing DB tables with test data"] = "Installing DB tables with test data";
$trans["Installing DB tables without test data"] = "Installing DB tables without test data";
$trans["Insufficient stock"] = "Insufficient stock";
$trans["Intermediate"] = "Intermediate";
$trans["Internal Error: %msg%"] = "Internal Error: %msg%";
$trans["Invalid bibid or position."] = "Invalid bibid or position.";
$trans["Invalid date format"] = "Invalid date format (please use yyyy-mm-dd)";
$trans["Invalid domain table code"] = "Invalid domain table code";
$trans["Invalid ID or password"] = "Invalid ID or password";
$trans["Invalid signon."] = "Invalid signon.";
$trans["ISBN"] = 'ISBN';
$trans["ISSN"] = 'ISSN';
$trans["Item Barcode"] = "Item, Barcode";
$trans["Item Bookings"] = "Item Bookings";
$trans["Item Count"] = "Item<br />Count";
$trans["Item Counts by Media Type"] = "Item Counts by Media Type";
$trans["Item Image"] = "Item Image";
$trans["Item Info"] = "Item Info";
$trans["Item Information"] = "Item Information";
$trans["Item Number"] = "Item Number";
$trans["Item Number:"] = "Item Number:";
$trans["Item Number Starts With"] = "Item Number Starts With";
$trans["Item Search"] = "Item Search";
$trans["Item successfully updated."] = "Item successfully updated.";
$trans["Item"] = "Item";
$trans["Items"] = "Items";
$trans["Item#"] = "Item#";
$trans["Item(s) Requested"] = "Item(s) Requested";
$trans["Item, %title%, has been deleted."] = "Item, %title%, has been deleted.";
$trans["Item:"] = "Item:";
$trans["Item<br />Count"] = "Item<br />Count";
$trans["Items Currently Checked Out"] = "Items Currently Checked Out";
$trans["Junior High"] = "Junior High";
$trans["Juvenile Checkout Limit:"] = "Juvenile Checkout Limit:";
$trans["Juvenile"] = "Juvenile";
$trans["Keep Dashes"] = "Keep Dashes";
$trans["Key field %key% not in field list"] = "Key field %key% not in field list";
$trans["Keyword"] = "Keyword";
$trans["Kindergarten"] = "Kindergarten";
$trans["Label"] = "Label";
$trans["Last name is required."] = "Last name is required.";
$trans["Last Name"] = "Last Name";
$trans["Last Name:"] = "Last Name:";
$trans["Late fee (barcode=%barcode%)"] = "Late fee (barcode=%barcode%)";
$trans["Latest Checkout Date"] = "Latest Checkout Date";
$trans["Latest Return Date"] = "Latest Return Date";
$trans["LayoutConfig"] = 'Add to / Modify Layout';
$trans["LayoutSave"] = 'Save Layout';
$trans["LCCN"] = "LCCN";
$trans["left"] = "left";
$trans["Length"] = "Length";
$trans["Library Hours"] = "Library Hours";
$trans["Library Phone"] = "Library Phone";
$trans["Library Settings"] = "Library Settings";
$trans["Library Site"] = "Library Site";
$trans["Library Title"] = "Library Title";
$trans["Limit Search Results"] = "Limit Search Results";
$trans["Link Color:"] = "Link Color:";
$trans["Link"] = "Link";
$trans["Links"] = "Links";
$trans["List of Media Types"] = "List of Media Types";
$trans["List of Sites"] = "List of Sites";
$trans["List of States & Abreviations"] = "List of States & Abreviations";
$trans["LOAN"] = "ON LOAN";
$trans["Local Data"] = "Local Data";
$trans["Local Search"] = "Local Search";
$trans["Location"] = "Location";
$trans["Login Username:"] = "Login Username:";
$trans["Login"] = "Login";
$trans["Logout"] = "Logout";
$trans["Looking for Database"] = "Looking for Database";
$trans["lookup_patience"] = 'Please be patient. this may take a while.';
$trans["lookup_refineSearch"] = "Try refining your search.";
$trans["lookup_resetInstr"] = 'After 30 secs. Press F5 to try again.';
$trans["lookup_rqdNote"]	= 'required field';
$trans["lookup_tooManyHits"] = "Too many hits!";
$trans["Lower"] = "Lower";
$trans["Main Body"] = "Main Body";
$trans["Make Booking"] = "Make Booking";
$trans["Manage Bookings"] = "Manage Bookings";
$trans["Manage Images"] = "Manage Images";
$trans["MARC Block"] = 'Marc Category:';
$trans["MARC Fields"] = "MARC Fields";
$trans["MARC File:"] = "MARC File:";
$trans["MARC Import"] = "MARC Import";
$trans["MARC Record:"] = "MARC Record:";
$trans["MARC sort without skip indicator"] = "MARC sort without skip indicator";
$trans["MARC Subfield"] = "MARC Subfield";
$trans["MARC Tag"] = "MARC Tag";
$trans["MARC View"] = "MARC View";
$trans["Max Fine"] = "Max Fine";
$trans["mbrid"] = "mbrid";
$trans["Media"] = "Media";
$trans["Media Type:"] = "Media Type:";
$trans["Media Type"] = "Media Type";
$trans["MediaTypeListLabel"] = 'Media Type:';
$trans["Media type, %desc%, has been added."] = "Media type, %desc%, has been added.";
$trans["Media type, %desc%, has been deleted."] = "Media type, %desc%, has been deleted.";
$trans["Media type, %desc%, has been updated."] = "Media type, %desc%, has been updated.";
$trans["Media Types"] = "Media Types";
$trans["material_field_id not set"] = "material_field_id not set";
$trans["Maximum Hits"] = "Maximum Hits";
$trans["Member Account Transactions"] = "Member Account Transactions";
$trans["Member Types"] = "Member Types";
$trans["Member field, %desc%, has been added."] = "Member field '%desc%' has been added.";
$trans["Member field, %desc%, has been updated."] = "Member field '%desc%' has been updated.";
$trans["Member Fields"] = "Member Fields";
$trans["Member has exceeded %number% items"] = "exceeded %number% items that can be checked-out of this type";
$trans["Member has been successfully added."] = "Member has been successfully added.";
$trans["Member has been successfully updated."] = "Member has been successfully updated.";
$trans["Member Info"] = "Member Info";
$trans["Member Information"] = "Member Information";
$trans["Member Name"] = "Member Name";
$trans["Member Search"] = "Member Search";
$trans["Member"] = "Member";
$trans["Member, %name%, has been deleted."] = "Member, %name%, has been deleted.";
$trans["Member:"] = "Member:";
$trans["Members:"] = "Members:";
$trans["%count% members without sites"] = "%count% members without sites";
$trans["Missing required page parameter: %param%"] = "Missing required page parameter: %param%";
$trans["My Account"] = "My Account";
$trans["My Bookings"] = "My Bookings";
$trans["Name Contains:"] = "Name Contains:";
$trans["Name"] = "Name";
$trans["Name:"] = "Name:";
$trans["Navigation"] = "Navigation";
$trans["Negative lock depth"] = "Negative lock depth";
$trans["New Calendar"] = "New Calendar";
$trans["New Copy"] = "New Copy";
$trans["New Field Added Successfully"] = "New Field Added Successfully";
$trans["New Item"] = "New Item";
$trans["New Member"] = "New Member";
$trans["New Search"] = "New Search";
$trans["New Search"] = "New Search";
$trans["New Staff Member"] = "New Staff Member";
$trans["Next"] = "Next";
$trans["Next Page"] = "Next Page";
$trans["No barcode set."] = "No barcode set.";
$trans["No bibid set in biblio update"] = "No bibid set in biblio update";
$trans["No bookings selected for checkout."] = "No bookings selected for checkout.";
$trans["No calendars have been defined."] = "No calendars have been defined.";
$trans["No copies are currently in shelving cart status."] = "No copies are currently in shelving cart status.";
$trans["No copies"] = "No copies have been created.";
$trans["No copies on hold"] = "No copies are currently on hold.";
$trans["No copy with barcode %barcode%"] = "There is no copy with barcode %barcode%";
$trans["No copy with that barcode"] = "No copy was found with that barcode number.";
$trans["No DBMS error."] = "No DBMS error.";
$trans["No delete on active theme"] = "The delete function is not available on the theme that is currently in use.";
$trans["No errors found"] = "No errors found";
$trans["No fields have been defined!"] = "No fields have been defined!";
$trans["No fields to fill in."] = "No fields to fill in.";
$trans["No form action"] = "No form action";
$trans["No images found"] = "No images found";
$trans["No items are currently checked out."] = "No items are currently checked out.";
$trans["No items have been selected."] = "No items have been selected.";
$trans["No MARC record set"] = "No MARC record set";
$trans["No material code set"] = "No material code set";
$trans["No name set for form field."] = "No name set for form field.";
$trans["No results found."] = "No results found.";
$trans["No sites have been defined."] = "No sites have been defined.";
$trans["No staff has been defined."] = "No staff has been defined.";
$trans["No states have been defined."] = "No states have been defined.";
$trans["No such image."] = "No such image.";
$trans["No such link type: "] = "No such link type: ";
$trans["No transactions found."] = "No transactions found.";
$trans["No"] = "No";
$trans["Noise Words"] = "Noise Words";
$trans["Not authorized for cataloging"] = "You are not authorized to use the Cataloging tab.";
$trans["Not enough arguments given to mkSQL()."] = "Not enough arguments given to mkSQL().";
$trans["Note: Mbr outstanding balance %bal%"] = "Note: Member has an outstanding account balance of %bal%.";
$trans["Note:"] = "Note:";
$trans["Nothing Found"] = "Nothing Found";
$trans["Nothing Found error"] = "Nothing Found error";
$trans["Number"] = "Number";
$trans["Number of items is required."] = "Number of items is required.";
$trans["NumberOnHand"] = "Nunber on hand";
$trans["old search"] = "Old Search";
$trans["Online Data"] = "Online Data";
$trans["Online Protocol"] = "Online Protocol";
$trans["ON_HOLD"] = "ON HOLD";
$trans["ON_ORDER"] = "ON Order";
$trans["On hold"] = "On hold";
$trans["Not on loan/on hold"] = "Not on loan/on hold";
$trans["On loan/not available"] = "On loan/not available";
$trans["Online Hosts"] = "Online Hosts";
$trans["Online Options"] = "Online Options";
$trans["OPAC"] = "OPAC";
$trans["OPAC Interface"] = "OPAC Interface";
$trans["OpenBiblio Help"] = "OpenBiblio Help";
$trans["OpenBiblio Install"] = "OpenBiblio Install";
$trans["Opening Balance"] = "Opening Balance";
$trans["Other notes:"] = "Other notes:";
$trans["Other Physical Details"] = "Other Physical Details";
$trans["Out Date"] = "Out Date";
$trans["Out Date:"] = "Out Date:";
$trans["Out"] = "Out";
$trans["OUT"] = "OUT";
$trans["Packing Slips"] = "Packing Slips";
$trans["Packing List"] = "Packing List";
$trans["Pages:"] = "Pages:";
$trans["Password (Confirm):"] = "Password (Confirm):";
$trans["Password at least 4 chars"] = "Password must be at least 4 characters long.";
$trans["Password has been reset."] = "Password has been reset.";
$trans["Password is required."] = "Password is required.";
$trans["Password must not contain any spaces."] = "Password must not contain any spaces.";
$trans["Password"] = "Password";
$trans["Password:"] = "Password:";
$trans["Passwords do not match."] = "Passwords do not match.";
$trans["Passwords may not be empty."] = "Passwords may not be empty.";
$trans["Patron #"] = "Patron #";
$trans["Patron #:"] = "Patron #:";
$trans["Pending Bookings"] = "Pending Bookings";
$trans["Phone"] = "Phone";
$trans["Phone:"] = "Phone:";
$trans["Place on Hold"] = "Place on Hold";
$trans["Placed on Hold"] = "Placed on Hold";
$trans["Please fill in your name."] = "Please fill in your name.";
$trans["Please fill in your school."] = "Please fill in your school.";
$trans["Please fill in your grade."] = "Please fill in your grade.";
$trans["Please enter your phone number."] = "Please enter your phone number.";
$trans["Please enter your e-mail address."] = "Please enter your e-mail address.";
$trans["Plugin Manager"] = "Plugin Manager";
$trans["Port"] = "Port";
$trans["Position"] = "Position";
$trans["Prev"] = "Prev";
$trans["Previous Page"] = "Previous Page";
$trans["Preview Theme Changes"] = "Preview Theme Changes";
$trans["Price"] = "Price";
$trans["Price:"] = "Price:";
$trans["Primary"] = "Primary";
$trans["Print Catalog"] = "Print Catalog";
$trans["Print List"] = "Print List";
$trans["Print"] = "Print";
$trans["Production Date:"] = "Production Date:";
$trans["Publication Date"] = "Publication Date";
$trans["Publication Location"] = "Publication Location";
$trans["Published After"] = "Published After";
$trans["Published Before"] = "Published Before";
$trans["Publisher"] = "Publisher";
$trans["Pull List"] = "Pull List";
$trans["pwd"] = "pwd";
$trans["px"] = "px";
$trans["Quick Check Out"] = "Quick Check Out";
$trans["Raise"] = "Raise";
$trans["Re-enter Password:"] = "Re-enter Password:";
$trans["Really delete booking of %item%?"] = "Are you sure you want to delete this booking of %item%?";
$trans["Really delete this booking?"] = "Are you certain you want to delete this booking?";
$trans["Really delete this image?"] = "Are you certain you want to delete this image?";
$trans["Really delete transaction?"] = "Are you certain you want to delete this transaction?";
$trans["Recheck"] = "Recheck";
$trans["Record %item% of %items%"] = "Record %item% out of %items% in sequence";
$trans["Record Info"] = "Record Info";
$trans["Records added to %url%Cart"] = "Imported records have been added to the %url%Cart";
$trans["Records imported: %rec%"] = "Records imported: %rec%";
$trans["Re-enter:"] = "Re-enter:";
$trans["Re-enter"] = "Re-enter";
$trans["Register"] = "Register";
$trans["Remove from Cart"] = "Remove from Cart";
$trans["Remove"] = "Remove";
$trans["Repeatable"] = 'Repeatable';
$trans["Repeatable?"] = "Repeatable?";
$trans["Report Criteria"] = "Report Criteria";
$trans["Report Errors"] = "Report Errors";
$trans["Report List"] = "Report List";
$trans["Report Results"] = "Report Results";
$trans["Reports"] = "Reports";
$trans["Rpts"] = "Rpts";
$trans["Reqd"] = "Reqd";
$trans["Request cart is empty"] = "Request cart is empty";
$trans["Request Cart"] = "Request Cart";
$trans["Request failed, call %library% %phone%"] = "Request failed to send, please call the %library% at %phone%.";
$trans["Request sent successfully."] = "Request sent successfully.";
$trans["Requested Delivery Date"] = "Requested Delivery Date";
$trans["REQUIRED FIELD"] = "REQUIRED FIELD";
$trans["Required field missing"] = "Required field missing";
$trans["Required note"] = " - required fields.";
$trans["Required"] = "Required";
$trans["Required?"] = "Required?";
$trans["Reset Password"] = "Reset Password";
$trans["Restock amount:"] = "Restock amount:";
$trans["Restock Threshold"] = "Restock Threshold";
$trans["Restock at "] = "Restock at ";
$trans["Return Date"] = "Return Date";
$trans["Return Date:"] = "Return Date:";
$trans["Return to copy check in"] = "Return to copy check in";
$trans["Return to item information"] = "Return to item information";
$trans["Return to member fields list"] = "Return to member fields list";
$trans["Return to member information"] = "Return to member information";
$trans["Return to Member Search"] = "Return to Member Search";
$trans["Return to staff list"] = "Return to staff list";
$trans["Return to theme list"] = "Return to theme list";
$trans["Return"] = "Return";
$trans["Returned"] = "Returned";
$trans["right"] = "right";
$trans["Sample Button"] = "Sample Button";
$trans["Sample data row 1"] = "Sample data row 1";
$trans["Sample data row 2"] = "Sample data row 2";
$trans["Sample data row 3"] = "Sample data row 3";
$trans["Sample error"] = "Sample error";
$trans["Sample Input"] = "Sample Input";
$trans["Sample link"] = "Sample link";
$trans["Sample List:"] = "Sample List:";
$trans["Save Changes"] = "Save Changes";
$trans["Schema"] = "Schema";
$trans["School Grade"] = "School Grade";
$trans["School Grade:"] = "School Grade:";
$trans["School"] = "School";
$trans["School:"] = "School:";
$trans["School Teacher"] = "School Teacher";
$trans["Search Catalog"] = "Search Catalog";
$trans["Search Complete"] = "Search Complete";
$trans["Search Member by Name"] = "Search Member by Name";
$trans["Search Results"] = "Search Results";
$trans["Search Site"] = "Search Site";
$trans["Search"] = "Search";
$trans["Searching"]     = 'Searching... Please wait...';
$trans["Searching for ISBN %isbn%"] = "Searching for ISBN %isbn%";
$trans["Searching for<br />Title: '%title%',<br />by %author%"] = "Searching for<br />Title: '%title%',<br />by %author%";
$trans["Select did not return results."] = "Select did not return results.";
$trans["Select"] = "Select";
$trans["Selecting database..."] = "Selecting database...";
$trans["SeniorHigh"] = "Senior High";
$trans["Senior High"] = "Senior High";
$trans["Service"] = "Service";
$trans["Seq"] = "Seq";
$trans["Sequence"] = "Sequence";
$trans["Series"] = "Series";
$trans["Series Contains"] = "Series contains";
$trans["Series Starts With"] = "Series starts with";
$trans["Server Information"] = "Server Information";
$trans["Setting zero days no checkout"] = "Setting the days due back to zero makes the entire collection unavailable for checkout.";
$trans["SHELVING_CART"] = "SHELVING CART";
$trans["Show in OPAC:"] = "Show in OPAC:";
$trans["Show Marc Tags"] = "Show Marc Tags";
$trans["Simple View"] = "Simple View";
$trans["Site"] = "Site";
$trans["Site:"] = "Site:";
$trans["Site, %name%, has been deleted."] = "Site, %name%, has been deleted.";
$trans["Site, %name%, updated."] = "Site, %name%, updated.";
$trans["Site, Member"] = "Site, Member";
$trans["Site, Out Date, Title"] = "Site, Out Date, Title";
$trans["Sites"] = "Sites";
$trans["Skip Labels"] = "Skip Labels";
$trans["Sort by: "] = "Sort by:";
$trans["Source"] = "Source";
$trans["Source:"] = "Source:";
$trans["Soonest Delivery<br />Date Available"] = "Soonest Delivery<br />Date Available";
$trans["SRU"] = "SRU";
$trans["Staff Admin"] = "Staff Admin";
$trans["Staff Interface"] = "Staff Interface";
$trans["Staff Login"] = "Staff Login";
$trans["Staff member, %name%, has been added."] = "Staff member, %name%, has been added.";
$trans["Staff member, %name%, has been deleted."] = "Staff member, %name%, has been deleted.";
$trans["Staff member, %name%, has been updated."] = "Staff member, %name%, has been updated.";
$trans["Staff Members"] = "Staff Members";
$trans["Start Date"] = "Start Date";
$trans["Start using the catalog"] = "Start using the catalog";
$trans["Start Using OpenBiblio"] = "Start Using OpenBiblio";
$trans["State"] = "State";
$trans["States"] = "States/Provinces";
$trans["Statistical Reports"] = "Statistical Reports";
$trans["Status Dt"] = "Status Dt";
$trans["Status"] = "Status";
$trans["Status:"] = "Status:";
$trans["Stock info changed"] = "Stock info changed";
$trans["Subfield Code"] = "Subfield Code";
$trans["Subfield"] = "Subfield";
$trans["Subfield Contains"] = "Subfield contains";
$trans["Subfield Starts With"] = "Subfield starts with";
$trans["Subject"] = "Subject";
$trans["Subjects"] = "Subjects";
$trans["Submit Request"] = "Submit Request";
$trans["Submit"] = "Submit";
$trans["Subject Contains"] = "Subject contains";
$trans["Subject Starts With"] = "Subject starts with";
$trans["Success"] = "Success";
$trans["Success!"] = "Success!";
$trans["Summary"] = "Summary";
$trans["Supplied passwords do not match."] = "Supplied passwords do not match.";
$trans["Suspended"] = "Suspended";
$trans["Suspended:"] = "Suspended:";
$trans["Syntax"] = "Syntax";
$trans["Table Border Color:"] = "Table Border Color:";
$trans["Table Border Width:"] = "Table Border Width:";
$trans["Table Cell Padding:"] = "Table Cell Padding:";
$trans["Table Heading"] = "Table Heading";
$trans["Table installation complete"] = "Table installation complete";
$trans["Table update complete"] = "Table update complete";
$trans["Tabs"] = "Tabs";
$trans["Tag"] = "Tag";
$trans["Testing Connection to DB server"] = "Testing Connection to DB server";
$trans["Test Load:"] = "Test Load:";
$trans["Text Area"] = "Text Area";
$trans["Text Field"] = "Text Field";
$trans["The MySQL extension is not available"] = "The MySQL extension is not available";
$trans["Theme Name"] = "Theme Name";
$trans["Theme Preview"] = "Theme Preview";
$trans["Theme"] = "Theme";
$trans["Theme, %name%, has been added."] = "Theme, %name%, has been added.";
$trans["Theme, %name%, has been deleted."] = "Theme, %name%, has been deleted.";
$trans["Theme, %name%, has been updated."] = "Theme, %name%, has been updated.";
$trans["Themes"] = "Themes";
$trans["This field must be filled in."] = "This field must be filled in.";
$trans["This is a preview of the %name% theme."] = "This is a preview of the %name% theme.";
$trans["This is a required field."] = "This is a required field.";
$trans["This item cannot be booked."] = "This item cannot be booked.";
$trans["this may take a moment."] = "This may take a moment.";
$trans["Thumbnailed"] = "Thumbnailed";
$trans["Title"] = "Title";
$trans["Title:"] = "Title:";
$trans["Timeout"] = "Timeout (seconds)";
$trans["To ignore book again"] = "To ignore this problem, submit the booking again.";
$trans["To Year:"] = "To Year:";
$trans["Today's Date"] = "Today's Date";
$trans["Too many arguments to mkSQL()."] = "Too many arguments to mkSQL().";
$trans["Tools"] = "Tools";
$trans["Total Holdings Value"] = "Total Holdings Value";
$trans["Trans Type"] = "Trans Type";
$trans["Transaction Activity"] = "Transaction Activity";
$trans["Transaction successfully completed."] = "Transaction successfully completed.";
$trans["Transaction successfully deleted."] = "Transaction successfully deleted.";
$trans["Transaction Type:"] = "Transaction Type:";
$trans["Transformer: scaling not implemented"] = "Transformer: scaling not implemented";
$trans["Transformer: skew not implemented"] = "Transformer: skew not implemented";
$trans["Tried to unlock an unlocked database."] = "Tried to unlock an unlocked database.";
$trans["Try to Fix Errors"] = "Try to Fix Errors";
$trans["Type of Media:"] = "Type of Media:";
$trans["Type"] = "Type";
$trans["Type:"] = "Type:";
$trans["Unable to connect to database."] = "Unable to connect to database.";
$trans["Unable to create thumbnail."] = "Unable to create thumbnail.";
$trans["Unable to move uploaded file."] = "Unable to move uploaded file.";
$trans["%count% unattached copy status history records"] = "%count% unattached copy status history records";
$trans["Unexpected date error: "] = "Unexpected date error: ";
$trans["Unexpected end of file"] = "Unexpected end of file";
$trans["Unexpected error creating report"] = "Unexpected error creating report";
$trans["Unexpected error reading date: %date%"] = "Unexpected error reading date: %date%";
$trans["Unexpected error: "] = "Unexpected error: ";
$trans["Unexpected hidden field error: %error%"] = "Unexpected hidden field error: %error%";
$trans["Unexpected token \"%token%\""] = "Unexpected token \"%token%\"";
$trans["Update Member"] = "Update Member";
$trans["Update"] = "Update";
$trans["Updated"] = "Updated";
$trans["Update completed"] = "Update completed";
$trans["Update successful"] = "Update successful";
$trans["Updating Database Tables"] = "Updating Database Tables";
$trans["Upload File"] = "Upload File";
$trans["Upload Image"] = "Upload Image";
$trans["URL:"] = "URL:";
$trans["Usage"] = "Usage";
$trans["Userid"] = "User Id";
$trans["Username is already in use."] = "Username is already in use.";
$trans["Username is required."] = "Username is required.";
$trans["Username must be at least 4 characters."] = "Username must be at least 4 characters.";
$trans["Username must not contain any spaces."] = "Username must not contain any spaces.";
$trans["Username:"] = "Username:";
$trans["USMarc Fields:"] = "USMarc Fields:";
$trans["Value"] = "Value";
$trans["Value by Media Type"] = "Value by Media Type";
$trans["Vendor"] = "Vendor";
$trans["Vendor:"] = "Vendor:";
$trans["View"] = "View";
$trans["View Opac"] = "View OPAC";
$trans["waitForServer"] = 'DUMMY, disregard';
$trans["(when available)"] = "(when available)";
$trans["Work Phone"] = "Work Phone";
$trans["Wrong key length"] = "Wrong key length";
$trans["YAZ"] = "YAZ";
$trans["Yes"] = "Yes";
$trans["You must enter exactly 1 record"] = "You must enter exactly 1 record";
$trans["Your userid has been suspended."] = "Your userid has been suspended.";
$trans["Zip Code"] = "Zip Code";
$trans["Zip Code ext"] = "Zip Code ext";






#****************************************************************************
#*  Translation text for integrity.php
#****************************************************************************
$trans["integrityMsg"] = "OpenBiblio can check its database for inconsistencies.<br />Would you like to do so now?";
$trans["%count% unattached MARC fields"]="%count% unattached MARC fields";
$trans["%count% unattached MARC subfields"]="%count% unattached MARC subfields";
$trans["%count% unattached images"]="%count% unattached images";
$trans["%count% unattached copies"]="%count% unattached copies";
$trans["%count% copies with broken status references"]="%count% copies with broken status references";
$trans["%count% items with multiple 245 fields"]="%count% items with multiple 245 fields";
$trans["%count% unattached copy status history records"]="%count% unattached copy status history records";
$trans['IntegrityQueryInvalidStatusCodes']='IntegrityQueryInvalidStatusCodes';
$trans['IntegrityQueryBrokenBibidRef']='IntegrityQueryBrokenBibidRef';
$trans['IntegrityQueryBrokenOutRef']='IntegrityQueryBrokenOutRef';
$trans['IntegrityQueryBrokenReturnRef']='IntegrityQueryBrokenReturnRef';
$trans['IntegrityQueryNoAssBooking']='IntegrityQueryNoAssBooking';
$trans['IntegrityQueryNoAssMember']='IntegrityQueryNoAssMember';
$trans["%count% copies without site"]="%count% copies without site";
$trans["%count% members without sites"]="%count% members without sites";
$trans['IntegrityQueryUnattachedAccTrans']='IntegrityQueryUnattachedAccTrans';
$trans['IntegrityQueryChangedCopyStatus']='IntegrityQueryChangedCopyStatus';
$trans['IntegrityQueryOutRecNoBooking']='IntegrityQueryOutRecNoBooking';
$trans["%count% double check outs"]="%count% double check outs";


#****************************************************************************
#*  Translation text for class IntegrityQuery.php
#****************************************************************************
$trans["IntegrityQueryInvalidStatusCodes"] = "%count% copy status history records with invalid status codes";
$trans["IntegrityQueryBrokenBibidRef"] = "%count% bookings with broken bibid references";
$trans["IntegrityQueryBrokenOutRef"] = "%count% bookings with broken \"out\" status references";
$trans["IntegrityQueryBrokenReturnRef"] = "%count% bookings with broken \"return\" status references";
$trans["IntegrityQueryNoAssBooking"] = "%count% booking member references with no associated booking";
$trans["IntegrityQueryNoAssMember"] = "%count% booking member references with no associated member";
$trans["IntegrityQueryUnattachedAccTrans"] = "%count% unattached member account transactions";
$trans["IntegrityQueryChangedCopyStatus"]  = "%count% \"out\" bookings where copy status has changed";
$trans["IntegrityQueryOutRecNoBooking"] = "%count% copy check out records with no associated booking";


#****************************************************************************
#*  Translation text for materials_del_confirm.php
#****************************************************************************
$trans["materialsDelConfirmMsg"]          = "Are you sure you want to delete material type, '%desc%'?";


#****************************************************************************
#*  Translation text for materials_list.php
#****************************************************************************
$trans["materialsListNoteMsg"]          = "The delete function is only available on material types that have an item count of zero. <br />"
																					."If you wish to delete a material type with an item count greater than zero, <br />"
																					."you will first need to change the material type on those items to another material type.";



#****************************************************************************
#*  Translation text for material_fields_view.php
#****************************************************************************
$trans["materialFieldsViewAddField"]          = "Add a custom MARC Field to this material type";


#****************************************************************************
#*  Translation text for member_fields_del.php
#****************************************************************************
$trans["memberFieldsDelMsg"]          = "Member field, %desc%, has been deleted.";


#****************************************************************************
#*  Translation text for member_fields_del_confirm.php
#****************************************************************************
$trans["memberFieldsDelConfirmMsg"]          = "Are you sure you want to delete field '%desc%'?";


#****************************************************************************
#*  Translation text for admin/noauth.php
#****************************************************************************
$trans["adminNoauth"]          = "You are not authorized to use the Admin tab.";




#****************************************************************************
#*  Translation text for sites_del_confirm.php
#****************************************************************************
$trans["sitesDelConfirmMsg"]          = "Are you sure you want to delete site %name%?";




#****************************************************************************
#*  Translation text for staff_del_confirm.php
#****************************************************************************
$trans["staffDelConfirmMsg"]          = "Are you sure you want to delete staff member, %name%?";




#****************************************************************************
#*  Translation text for theme_del_confirm.php
#****************************************************************************
$trans["themeDelConfirmMsg"]          = "Are you sure you want to delete theme, %name%?";


#****************************************************************************
#*  Translation text for biblio_bulk_del.php
#****************************************************************************


#****************************************************************************
#*  Translation text for biblio_copy_del.php
#****************************************************************************
$trans["biblioCopyDelSuccess"]     = "Copy with barcode %barcode% was successfully deleted.";


#****************************************************************************
#*  Translation text for biblio_copy_del_confirm.php
#****************************************************************************
$trans["biblioCopyDelConfirmErr1"] = "Could not delete copy.<br />A copy must be checked in before it can be deleted.";
$trans["biblioCopyDelConfirmMsg"]  = "Are you sure you want to delete the copy with barcode %barcodeNmbr%?<br />This will also delete all status change history for this copy.";


#****************************************************************************
#*  Translation text for biblio_del_confirm.php
#****************************************************************************
$trans["biblioDelConfirmWarn"]     = "This item has %copyCount% copy(ies) and %holdCount% hold request(s).<br />Please delete these copies and/or hold requests before deleting this bibliography.";
$trans["biblioDelConfirmMsg"]      = "Are you sure you want to delete the item with title %title%?";


#****************************************************************************
#*  Translation text for page hold_message.php
#****************************************************************************
$trans["holdMessageMsg1"]         = "The copy with barcode number %barcode% that you are attempting to check<br />in has one or more hold requests placed on it. <b>Please file this copy with your held items instead of placing it on your shelving cart.</b> The status code for this copy has been set to hold.";


#****************************************************************************
#*  Translation text for mbr_del_confirm.php
#****************************************************************************
$trans["mbrDelConfirmWarn"]       = "Member, %name%, has %checkoutCount% checkout(s) and %holdCount% hold request(s). All checked out materials must be checked in and<br />all hold requests deleted before deleting this member.";
$trans["mbrDelConfirmMsg"]        = "Are you sure you want to delete the member, %name%?<br />This will also delete all checkout history for this member.";


#****************************************************************************
#*  Translation text for mbr_fields.php
#****************************************************************************
$trans["mbrFldsMustAddSite"]      = "You must %link%add a site%end% before you can edit members.";


#****************************************************************************
#*  Translation text for circ/noauth.php
#****************************************************************************
$trans["circNoauth"]       = "You are not authorized to use this function under the Circulation tab.";


#****************************************************************************
#*  Translation text for class Error.php
#****************************************************************************
$trans["ErrorDatabase"]          = "Database Error: %msg% in query: %sql% DBMS says: %dberror%";
$trans["ErrorInternalFoundBug"]          = "Internal Error - You've Probably Found a Bug";
$trans["ErrorInfoToSupport"]          = "Please give all the information on this page to your support personnel.";
$trans["ErrorDbQuery"]          = "Database Query Error - You've Probably Found a Bug";
$trans["ErrorQueryFailed"]          = "Query %query% failed. The DBMS said this:";
$trans["ErrorDebugBacktrace"]          = "Debug Backtrace (most recent call first):";


#****************************************************************************
#*  Translation text for class IntegrityQuery.php
#****************************************************************************
$trans["IntegrityQueryInvalidStatusCodes"] = "%count% copy status history records with invalid status codes";
$trans["IntegrityQueryBrokenBibidRef"]     = "%count% bookings with broken bibid references";
$trans["IntegrityQueryBrokenOutRef"]       = "%count% bookings with broken \"out\" status references";
$trans["IntegrityQueryBrokenReturnRef"] = "%count% bookings with broken \"return\" status references";
$trans["IntegrityQueryNoAssBooking"] = "%count% booking member references with no associated booking";
$trans["IntegrityQueryNoAssMember"] = "%count% booking member references with no associated member";
$trans["IntegrityQueryUnattachedAccTrans"] = "%count% unattached member account transactions";
$trans["IntegrityQueryChangedCopyStatus"]  = "%count% \"out\" bookings where copy status has changed";
$trans["IntegrityQueryOutRecNoBooking"] = "%count% copy check out records with no associated booking";


#****************************************************************************
#*  Translation text for class Lay.php
#****************************************************************************
$trans["LaySupportedRotation"]          = "Transformer: rotation is only supported in pi/2 increments";
$trans["LayPercentLengths"]          = "percent lengths require a current container";


$trans["QueryWrongNrRows"]          = "Wrong number of result rows: expected 1, got %count%";
$trans["QueryBeforeConnect"]          = "Tried to make database query before connection.";


#****************************************************************************
#*  Translation text for class Report.php
#****************************************************************************
$trans["ReportCreatingReport"]          = "Unexpected error creating report: %error%";
$trans["ReportNoLoadReport"]          = "Couldn't load cached report: %name%";
$trans["ReportInitReport"]          = "Unexpected error initializing report: %error%";
$trans["ReportMakingVariant"]          = "Unexpected error making report variant: %error%";
$trans["ReportNoParams"]          = "Tried to make report variant without cached params";
$trans["ReportCreationFailed"]          = "Report creation failed trying to make variant";


$trans["modelBookingsMemberNoExist"]          = "A member you are booking for does not exist. Perhaps it has been deleted.";
$trans["modelBookingsDueNotEarlier"]          = "The due date cannot be earlier than the checkout date.";
$trans["modelBookingsNotEnoughCopies"]          = "Not enough copies are available for the dates you selected.";
$trans["modelBookingsClosedOnBookDate"]          = "A member's site is closed on the booking date.";
$trans["modelBookingsClosedOnDueDate"]          = "A member's site is closed on the due date.";
$trans["modelBookingsBarcodeNoMatch"]          = "The given copy barcode doesn't match the booking.";
$trans["modelBookingsAlreadyCheckedOut"]          = "The booking has already been checked out.";
$trans["modelBookingsCopyUnavailable"]          = "The copy with barcode %barcode% is unavailable or already checked out.";
$trans["modelBookingsSetForOtherBooking"]          = "The copy with barcode %barcode% is set to be checked out for another booking in this batch.";
$trans["modelBookingsPayFinesFirst"]          = "The members with this booking may not check out items until their fines are paid.";
$trans["modelBookingsHeldForOtherMember"]          = "The copy with barcode %barcode% is on hold for another member.";
$trans["modelBookingsNotOnLoan"]          = "The copy with barcode %barcode% is not on loan, and cannot be checked out.";
$trans["modelBookingsNotAvailable"]          = "The item with barcode %barcode% is not available for checkout.";

$trans["Authority Search"]          = "Authority Search";
$trans["Average Copyright Date"]          = "Average Copyright Date";
$trans["Barcode Starts With"] = "Barcode Starts With";
$trans["Biblio Counts by Media Type"]          = "Biblio Counts by Media Type";
$trans["Bookings by Site"]          = "Bookings by Site";
$trans["Bookings by Title"]          = "Bookings by Title";
$trans["Call no."]			= "Call no.";
$trans["Copy Search"]     = "Copy Search";
$trans["Earliest Date Out"] = "Earliest Date Out";
$trans["Exact Match"]		= "Exact Match";
$trans["Images"]          = "Images";
$trans["Item Cart"]       = "Item Cart";
$trans["New Items"]          = "New Items";
$trans["Understocked Items"]          = "Understocked Items";
$trans["Booking Search"]          = "Booking Search";
$trans["Checkouts"]          = "Checkouts";
$trans["Confirmation Notices"]          = "Confirmation Notices";
$trans["Latest Date Out"]		= "Latest Date Out";
$trans["Must Returns"]          = "Must Returns";
$trans["Newer than (yyyy-mm-dd)"] = "Newer than (yyyy-mm-dd)";
$trans["Non-delivery List"]          = "Non-delivery List";
$trans["Overdue Items"]          = "Overdue Items";
$trans["Popular Titles"]          = "Popular Titles";
$trans["Search Type"]			= "Search Type";
$trans["Search Text"]			= "Search Text";
$trans["Series Search"]          = "Series Search";
$trans["Subject Search"]          = "Subject Search";
$trans["MARC Reports"]          = "MARC Reports";
$trans["Member Reports"]          = "Member Reports";
$trans["Only In Item Cart"] 		= "Only In Item Cart";
$trans["Site List"]          = "Site List";
$trans["Sort By"]			= "Sort By";
$trans["Site code"]			= "Site code";
$trans["tatistical Reports"]          = "tatistical Reports";
$trans["Non-circulating Titles"]          = "Non-circulating Titles";
$trans["Site Usage"]          = "Site Usage";

#****************************************************************************
#*  Translation text for Calendars.php
#****************************************************************************
$trans["CalendarsLaterDate"]          = "\"To\" date must be later than \"From\" date";


#****************************************************************************
#*  Translation text for book_item.php
#****************************************************************************
$trans["bookItemOnlyStaff"]          = "Only staff may book items for today or earlier days.";


#****************************************************************************
#*  Translation text for register.php
#****************************************************************************
$trans["registerNoMatch"]          = "The information you entered does not exactly match any member in our database.<br />Please try again or call the Media Center for assistance.";
$trans["registerGotLogin"]          = "That member has already setup a login ID.<br />If you need to change it, please call the Media Center for assistance.";
$trans["registerYouHaveRegd"]          = "You have successfully registered and are now logged in.";
$trans["registerNextTime"]          = "<strong>To log in next time</strong>,<br />use the password you just set with your card number (%barcode%)<br />or the email address you entered as ID.";
$trans["registerEditInfo"]          = "If you like, you can %link%edit your account info%end%<br />to change your password or email address at any time.";
$trans["registerMustMatch"]          = "The site and member name below must match our records exactly in order for you to register.<br />If you have trouble, please call the Media Center for assistance.";


#****************************************************************************
#*  Translation text for page reports/index.php
#****************************************************************************
$trans["reportsDesc"]           = "Choose from one of the following links to run a report.";


#****************************************************************************
#*  Translation text for page reports/noauth.php
#****************************************************************************
$trans["reportsNoauth"]                = "You are not authorized to use the Reports tab.";


#****************************************************************************
#*  Translation text for biblio_search.php
#****************************************************************************
$trans["biblioSearchMsg"]          = "%nrecs% records found. Showing results %start%-%end%";


#****************************************************************************
#*  Translation text for demo_msg.php
#****************************************************************************
$trans["demoMsg"]       = "This function is not available in the demo version of OpenBiblio<br />in order to limit the demo database size and to keep the data presentable.";


#****************************************************************************
#*  Translation text for help_footer.php
#****************************************************************************
$trans["helpFooter"]          = "Powered by OpenBiblio version %version%<br />OpenBiblio is free software, copyright by its authors.<br />Get <a href=\"../COPYRIGHT.html\">more information</a>.";


#****************************************************************************
#*  Translation text for hold_del_confirm.php
#****************************************************************************
$trans["holdDelConfirmMsg"]        = "Are you sure you want to delete this hold request?";


#****************************************************************************
#*  Translation text for request.php
#****************************************************************************
$trans["requestFieldsReqd"]          = "Fields marked with an asterisk (*) are required.";
$trans["requestCallMe"]          = "Call me if an item is not available on the date requested.";
$trans["requestMailMe"]          = "Send me an e-mail confirmation of the booking.";
$trans["requestAltTitles"]          = "Select alternate titles if items I've requested are not available.";
$trans["requestOtherNotes"]          = "Other notes (e.g. sharing, extended checkout length):";


#****************************************************************************
#*  Translation text for request_send.php
#****************************************************************************
$trans["requestSendPleaseCall"]          = "Please call me if an item is not available on the date requested.";
$trans["requestSendPleaseSend"]          = "Please send me an e-mail confirmation of the booking.";
$trans["requestSendPleaseSelect"]          = "Please select alternate titles if items I've requested are not available.";
$trans["requestSendMustEnterDate"]          = "You must enter a request date and/or check the box for the soonest delivery date available.";


#****************************************************************************
#*  Translation text for tools/index.php
#****************************************************************************
$trans["toolsIndexDesc"]  = "Use the functions located in the left hand navigation area<br />"
													.	"to manage the internal workings of your copy of OpenBiblio.<br />"
													.	" - System Settings: maintain options not appropriate to day-to-day managers.<br />"
													.	" - Plugin Manager: determine which, if any, plugin to allow.<br />";

#****************************************************************************
#*  Translation text for tools/noauth.php
#****************************************************************************
$trans["toolsNoauth"]          = "You are not authorized to use the Tools tab.";

#****************************************************************************
#*  Translation text for tools/settings_edit_form.php
#****************************************************************************
$trans["System Settings"]          = "System Settings";

#****************************************************************************
#*  Translation text for tools/plugin_mgr_form.php
#****************************************************************************
$trans["Plugins Allowed?"]          = "Plugins Allowed?";
$trans["No Plugins found"]          = "No Plugins found.";
$trans["Select Plugins"]          	= "Select Plugins to be used.";






    ## ##################################
    ## adds suport for plugins - fl, 2009
    ## ##################################
		$list = getPlugIns('tran.tran');
		for ($x=0; $x<count($list); $x++) {
			include($list[$x]);
		}
    ## ##################################
