<?php

global $mainframe, $database, $my;
global $mosConfig_live_site;
global $Itemid;

$rows 		= array();
$pollid = $params->get('pollid', 1);
$maxbarwidth = $params->get('max', 1);
$barcolor = $params->get('color', 1);
$vb_poll = $params->get('vb_poll', 1);
$vb_pollvote = $params->get('vb_pollvote', 1);
$directory = $params->get('forumdir', 1);

$admin = ($my->usertype == "Super Administrator" || $my->usertype == "Administrator");

$output = '<div class="menu">';

//You can only see polls if you're logged in.
if($my->id)
{

	//Get the information from the database for the poll specified
	$query = "SELECT question, options, votes, voters, active"
	. "\n FROM $vb_poll"
	. "\n WHERE pollid = $pollid"
	. "\n LIMIT 1"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	//If the specified poll couldn't be found in the database, display a message saying so
	if(!$rows)
	{
		$output .= 'The specified poll (' . $pollid . ') could not be found.';
		echo $output . '</div>';
		break;
	}
	//Get all the values from the database that we collected earlier
	foreach ($rows as $row)
	{
		$div = '|||';
		$question = $row->question;
		$alloptions = $row->options;
		$numoptions = substr_count($alloptions, $div) + 1;
		$allvotes = $row->votes;
		$numvotes = 0;
		$active = $row->active;

		//Separate the options from each other and put them into an array
		$options[0] = strtok($alloptions, $div);
		$counter = 0;
		while($counter < $numoptions - 1)
		{
			$options[$counter + 1] = strtok($div);
			$counter+=1;
		}



		//Check if you have already voted
		$query = "SELECT userid"
		. "\nFROM $vb_pollvote"
		. "\nWHERE userid = " . $my->id
		. "\nAND pollid = " . $pollid;

		$database->setQuery( $query );
		$alreadyvoted = $database->loadObjectList();

		//You haven't voted and the poll is still active, so let's display the options in the voting format
		if(!$alreadyvoted && $active)
		{
			//Display voting options
			$output .= "<form action=\"" . $directory . "/poll.php?do=pollvote&amp;pollid=\"" . $pollid . "\" method=\"post\">"
			. "\n<input type=\"hidden\" name=\"do\" value=\"pollvote\" />"
			. "\n<input type=\"hidden\" name=\"pollid\" value=\"" . $pollid . "\" />\n<div style=\"font-weight: bold;\">" . $question . "</div>\n";

			$counter = 0;
			while($counter < $numoptions)
			{
				$opnum = $counter + 1;
				$output .= "<div><label for=\"rb_optionnumber_" . $opnum . "\"><input type=\"radio\" name=\"optionnumber\" value=\"" . $opnum . "\" id=\"rb_optionnumber_" . $opnum . "\" />" . $options[$counter] . "</label></div>\n";
				$counter+=1;
			}
			$output .= "\n<input type=\"submit\" class=\"button\" value=\"Vote\" /><br/></form>";
		}

		//You have already voted, or the poll is closed, so we'll just show you the options in the results format
		if($alreadyvoted || !$active)
		{
			if(!$active) $output .= "\nThis poll is now closed.  The final results can be found below.<br/>\n";
			else if($alreadyvoted) $output .= "\nThanks for voting, " . $my->username . "!<br/>\n";

			//Separate the votes from each other and put them into an array
			$counter = 0;
			$votes[0] = strtok($allvotes, $div);
			while($counter < $numoptions - 1)
			{
				$votes[$counter + 1] = strtok($div);
				$counter+=1;
			}

			//Count the number of votes that have been made
			$counter = 0;
			while($counter < sizeof($votes))
			{
				$numvotes+=$votes[$counter];
				$counter+=1;
			}

			//Print results
			$output .= "<div class=\"menu\" style=\"font-weight: bold; border-top: 1px solid;\">" . $question . "</div><br/>\n";
			$counter = 0;
			while($counter < $numoptions)
			{
				$percent = ($votes[$counter]/$numvotes)*100;
				$percent = round($percent, 2);

				$barwidth = ($votes[$counter]/$numvotes)*$maxbarwidth;
				if($barwidth < 5) $barwidth = 5;

				$output .= $options[$counter] . "<br/><div align=\"center\" class=\"menu\" style=\"font-size: 6pt; background: " . $barcolor . "; width:" . $barwidth . "px;\">" . $percent . "%</div>\n(" . $votes[$counter] . " votes)<br/><br/>\n";
				$counter+=1;
			}

			//Show the total number of votes
			$output .= "<center>\n(" . $numvotes . " votes total)</center>";
		}
	}

	//If you're an admin, you'll see a link to edit the poll
	if($admin) $output .= "<br/>\n<a href=\"" . $directory . "/poll.php?do=polledit&pollid=" . $pollid . "\">Edit Poll</a>";
}
//Not logged in.  No polls for you!
else
{
	$output .= 'Sorry, but you can only see the poll if you are logged in!';
}

echo $output . '</div>';
?>