<?php
/*
@Auther: Gabriel Rodriguez
Page: deleted
Project: collaborate
Date: 3/6/2018

inbox.php was written to retreive messages from the database
these messages are currently marked with an ENUM value set to 0
the user also has the option to move the message back to the deleted
by setting the ENUM value to 1.
Collaborate 2017-2018
*/
    include "header.php";
	
	if(!isset($_SESSION['username']))
	{
		Header("Location: ./../index.php");
	}
?>
<div id="message-nav">
    <div id="message-nav-buttons">
		<a href="inbox.php"><img src='./../img/inbox_icon.png' alt='Inbox' />Inbox</a>
		<hr id="hr2"/>
		<a href="sent.php"><img src='./../img/sent.png' alt='Sent' />Sent</a>
		<hr id="hr2"/>
		<a href="draft.php"><img src='./../img/draft.png'  alt='Draft' />Drafts</a>
		<hr id="hr2"/>
		<a href="deleted.php"><img src='./../img/trash.png' alt='Sent' />Deleted</a><br/>
	</div>
</div>
<br/>
<div id='messageHead'>
<h2  >Inbox</h2>
</div>
<div class="bgstyle4">
    <div id="msg">
	<br/>
	<div id="draft-2">
<?php
    //retreive messages that are for user
    $get_messages = ("SELECT * FROM `pvt_messages` WHERE to_user='$username' AND opened='0' AND recipientDelete='0' AND `draft`='0'");
    //call to function to get messages
    GetMessages($get_messages, 2);

	print("</div>");
	print("</div>");
	print("</div>");
	
    _html_end();
?>
