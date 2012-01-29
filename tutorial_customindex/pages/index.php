<?php
/**
 * This is the page where you can place your markup for the index page
 *
 * There are 2 cases defined here depending on what you want to do.
 * 
 * Case 1: You control the entire markup of the page
 * In this case you must include *all* of the markup for the page including the <html> and <body> tags
 * the advantage to doing it this way as opposed to using index.html or configuring your server
 * to show a certain file is that you still have access to the elgg engine this way.
 * This means that in the php here, you can call elgg functions, include elgg views, etc.
 * 
 * 
 * Case 2: You supply just the content that goes inside the elgg theme.
 * In this case elgg will supply the header/footer/navigation as per the theme
 * You don't have to supply <html><body> etc, just the markup you want in the content
 */


/*
 * 		START CASE 1
 */

$case1 = <<<CASE1
<html>
<body style="background-color: #C1FFC5">
<div>
Hello World, this is my custom index
</div>
</body>
</html>
CASE1;

echo $case1;

/*
 * 		END CASE 1
 */


// --------------------------------------------------------------------------- //


/*
 * 		START CASE 2
 * 
 * 		To make this case active you must comment out the "echo" of case 1
 * 		and uncomment the elgg_view_page function of case 2
 */


$case2 = <<<CASE2
<div style="background-color: #C1FFC5">
Hello World, this is my custom index
</div>
CASE2;

// there are a number of layouts that can be used
// the layouts provided by elgg can be found in the core at views/default/page/layouts
// themes and plugins may define their own layouts
// layouts take sections of content as an associative array
// here we are using the most basic layout, a single column of content, which takes a single
// argument of 'content'
$layout = elgg_view_layout('one_column', array('content' => $case2));

// elgg_view_page compiles all of the views and your layout into the final html
// it takes 2 arguments, first is the title of the page, what will be set between the
// <title></title> tags
// and the second is your layout

// to try CASE 2 make sure you comment out the "echo" of case 1
// and then uncomment this echo

// echo elgg_view_page('My Page Title', $layout);