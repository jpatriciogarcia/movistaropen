<?php
DEFINE("_POLLXT_POLL_TITLE","Poll Title");
DEFINE("_POLLXT_VOTABLE","Voting possible");
DEFINE("_POLLXT_RESULTS","Results");
DEFINE("_POLLXT_CONTINUE","Continue");
DEFINE("_POLLXT_CLOSE","Close");
DEFINE("_POLLXT_BACK","Back");
DEFINE("_POLLXT_DETAIL","Detail");
DEFINE("_POLLXT_ACTIVATE","Your vote was succesfully confirmed");
DEFINE("_POLLXT_NOT_ACTIVATED","Confirmation key wrong or already confirmed");
DEFINE("_POLLXT_OBLIGATORY","Obligatory questions not answered:");
DEFINE("_POLLXT_EMAIL_FAIL","Could not send Email. Please check if your User has a valid EMail-address");
DEFINE("_POLLXT_NO_POLLS","Currently no polls available to vote");
DEFINE("_POLLXT_VOTES","No. of Votes");
DEFINE("_POLLXT_VOTING_UNTIL", "Voting possible until: ");

if ($GLOBALS["_VERSION"]->RELEASE == "1.5") {
DEFINE('_BUTTON_VOTE','Vote');
DEFINE('_BUTTON_RESULTS','Results');
DEFINE('_NUM_VOTERS','Number of Voters');
DEFINE('_FIRST_VOTE','First Vote');
DEFINE('_LAST_VOTE','Last Vote');
DEFINE('_SEL_POLL','Select Poll:');
DEFINE('_NO_RESULTS','There are no results for this poll.');
DEFINE('_THANKS','Thanks for your vote.');

}
?>
