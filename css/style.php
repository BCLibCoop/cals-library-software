/*********************************************************
 *  Body Style
 *********************************************************/
body {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>
}

/*********************************************************
 *  Font Styles
 *********************************************************/
font.primary {
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_PRIMARY_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
}
font.alt1 {
  color: <?php echo H(OBIB_ALT1_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT1_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT1_FONT_FACE);?>;
}
font.alt1tab {
  color: <?php echo H(OBIB_ALT1_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT2_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT2_FONT_FACE);?>;
<?php if (OBIB_ALT2_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
}
font.alt2 {
  color: <?php echo H(OBIB_ALT2_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT2_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT2_FONT_FACE);?>;
<?php if (OBIB_ALT2_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
}
font.error {
  color: <?php echo H(OBIB_PRIMARY_ERROR_COLOR);?>;
  font-size: <?php echo H(OBIB_PRIMARY_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  font-weight: bold;
}
font.small {
  font-size: 10px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
}
a.nav {
  color: <?php echo H(OBIB_ALT1_FONT_COLOR);?>;
  font-size: 10px;
  font-family: <?php echo H(OBIB_ALT1_FONT_FACE);?>;
  text-decoration: none;
  background-color: <?php echo H(OBIB_ALT1_BG);?>;
  border-style: solid;
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: <?php echo H(OBIB_BORDER_WIDTH);?>
}
ul.primary{
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_PRIMARY_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  display:inline;
}

h1 {
  font-size: 16px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  font-weight: normal;
}

/*********************************************************
 *  Link Styles
 *********************************************************/
a:link {
  color: <?php echo H(OBIB_PRIMARY_LINK_COLOR);?>;
}
a:visited {
  color: <?php echo H(OBIB_PRIMARY_LINK_COLOR);?>;
}
a.primary:link {
  color: <?php echo H(OBIB_PRIMARY_LINK_COLOR);?>;
}
a.primary:visited {
  color: <?php echo H(OBIB_PRIMARY_LINK_COLOR);?>;
}
a.alt1:link {
  color: <?php echo H(OBIB_ALT1_LINK_COLOR);?>;
}
a.alt1:visited {
  color: <?php echo H(OBIB_ALT1_LINK_COLOR);?>;
}
a.alt2:link {
  color: <?php echo H(OBIB_ALT2_LINK_COLOR);?>;
}
a.alt2:visited {
  color: <?php echo H(OBIB_ALT2_LINK_COLOR);?>;
}
a.tab:link {
  color: <?php echo H(OBIB_ALT2_LINK_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT2_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT2_FONT_FACE);?>;
<?php if (OBIB_ALT2_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
  text-decoration: none
}
a.tab:visited {
  color: <?php echo H(OBIB_ALT2_LINK_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT2_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT2_FONT_FACE);?>;
<?php if (OBIB_ALT2_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
  text-decoration: none
}
a.tab:hover {text-decoration: underline}

/*********************************************************
 *  Table Styles
 *********************************************************/
table.primary {
  border-collapse: collapse
}
table.border {
  border-style: solid;
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: <?php echo H(OBIB_BORDER_WIDTH);?>
}
th {
  background-color: <?php echo H(OBIB_ALT2_BG);?>;
  color: <?php echo H(OBIB_ALT2_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT2_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT2_FONT_FACE);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
  border-style: solid;
<?php if (OBIB_ALT2_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: <?php echo H(OBIB_BORDER_WIDTH);?>;
  height: 1
}
th.rpt {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo (OBIB_PRIMARY_FONT_SIZE - 2);?>px;
  font-family: Arial;
  font-weight: bold;
  padding: <?php echo H(OBIB_PADDING);?>;
  border-style: solid;
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: 1;
  text-align: left;
  vertical-align: bottom;
}
td.primary {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_PRIMARY_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
  border-style: solid;
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: <?php echo H(OBIB_BORDER_WIDTH);?>
}
td.rpt {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo (OBIB_PRIMARY_FONT_SIZE - 2);?>px;
  font-family: Arial;
  padding: <?php echo H(OBIB_PADDING);?>;
  border-top-style: none;
  border-bottom-style: none;
  border-left-style: solid;
  border-left-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-left-width: 1;
  border-right-style: solid;
  border-right-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-right-width: 1;
  text-align: left;
  vertical-align: top;
}
td.primaryNoWrap {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_PRIMARY_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
  border-style: solid;
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: <?php echo H(OBIB_BORDER_WIDTH);?>;
  white-space: nowrap
}

td.title {
  background-color: <?php echo H(OBIB_TITLE_BG);?>;
  color: <?php echo H(OBIB_TITLE_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_TITLE_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_TITLE_FONT_FACE);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
<?php if (OBIB_TITLE_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: <?php echo H(OBIB_BORDER_WIDTH);?>;
  text-align: <?php echo H(OBIB_TITLE_ALIGN);;?>
}
td.alt1 {
  background-color: <?php echo H(OBIB_ALT1_BG);?>;
  color: <?php echo H(OBIB_ALT1_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT1_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT1_FONT_FACE);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
  border-style: solid;
  border-color: <?php echo H(OBIB_BORDER_COLOR);?>;
  border-width: <?php echo H(OBIB_BORDER_WIDTH);?>
}
td.tab1 {
  background-color: <?php echo H(OBIB_ALT1_BG);?>;
  color: <?php echo H(OBIB_ALT1_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT1_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT2_FONT_FACE);?>;
<?php if (OBIB_ALT2_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
  padding: <?php echo H(OBIB_PADDING);?>;
}
td.tab2 {
  background-color: <?php echo H(OBIB_ALT2_BG);?>;
  color: <?php echo H(OBIB_ALT2_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_ALT2_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_ALT2_FONT_FACE);?>;
<?php if (OBIB_ALT2_FONT_BOLD) { ?>
  font-weight: bold;
<?php } else { ?>
  font-weight: normal;
<?php } ?>
  padding: <?php echo H(OBIB_PADDING);?>;
}
td.noborder {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_PRIMARY_FONT_SIZE);?>px;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
}
/*********************************************************
 *  Form Styles
 *********************************************************/
input.button {
  background-color: <?php echo H(OBIB_ALT1_BG);?>;
  border-color: <?php echo H(OBIB_ALT1_BG);?>;
  border-left-color: <?php echo H(OBIB_ALT1_BG);?>;
  border-top-color: <?php echo H(OBIB_ALT1_BG);?>;
  border-bottom-color: <?php echo H(OBIB_ALT1_BG);?>;
  border-right-color: <?php echo H(OBIB_ALT1_BG);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  color: <?php echo H(OBIB_ALT1_FONT_COLOR);?>;
}
input.navbutton {
  background-color: <?php echo H(OBIB_ALT2_BG);?>;
  border-color: <?php echo H(OBIB_ALT2_BG);?>;
  border-left-color: <?php echo H(OBIB_ALT2_BG);?>;
  border-top-color: <?php echo H(OBIB_ALT2_BG);?>;
  border-bottom-color: <?php echo H(OBIB_ALT2_BG);?>;
  border-right-color: <?php echo H(OBIB_ALT2_BG);?>;
  padding: <?php echo H(OBIB_PADDING);?>;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  color: <?php echo H(OBIB_ALT2_FONT_COLOR);?>;
}
input {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-left-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-top-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-bottom-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-right-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  padding: 0px;
  scrollbar-base-color: <?php echo H(OBIB_ALT1_BG);?>;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
}
textarea {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-left-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-top-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-bottom-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-right-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  padding: 0px;
  scrollbar-base-color: <?php echo H(OBIB_ALT1_BG);?>;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
  font-size: <?php echo H(OBIB_PRIMARY_FONT_SIZE);?>px;
}
select {
  background-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-left-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-top-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-bottom-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  border-right-color: <?php echo H(OBIB_PRIMARY_BG);?>;
  padding: 0px;
  scrollbar-base-color: <?php echo H(OBIB_ALT1_BG);?>;
  font-family: <?php echo H(OBIB_PRIMARY_FONT_FACE);?>;
  color: <?php echo H(OBIB_PRIMARY_FONT_COLOR);?>;
}

ul.nav_main { list-style-type: none; padding-left: 0; margin-left: 0; }
li.nav_selected:before { white-space: pre-wrap; content: "\bb  " }
ul.nav_main li.nav_selected { font-weight: bold }
ul.nav_sub li.nav_selected { font-weight: bold }
ul.nav_main li { font-weight: normal }
ul.nav_sub li { font-weight: normal }

li.report_category { margin-bottom: 1em }

table.results {
  width: 100%;
  border-collapse: collapse;
}
table.resultshead {
  width: 100%;
  border-collapse: separate;
  border-top: solid <?php echo OBIB_ALT2_BG;?> 3px;
  border-bottom: solid <?php echo OBIB_ALT2_BG;?> 3px;
  clear: both;
}
table.resultshead th {
  text-align: left;
  color: <?php echo OBIB_PRIMARY_FONT_COLOR;?>;
  border: none;
  background: <?php echo OBIB_PRIMARY_BG;?>;
  font-size: 16px;
  font-weight: bold;
  vertical-align: middle;
  padding: 2px;
}
table.resultshead td {
  text-align: right;
}
table.results td.primary { border-top: none; }

#container{
  width: 850px;
  margin-left: 40px; 
}
#navcontainer
 {
 font-family: Arial,Sans-Serif;
 margin: 0 auto;
 width: 70%;
 border-bottom: 1px solid #ddd;
 }

 #navlist
 {
 width: 60%;
 text-align: center;
 margin: 0 auto;
 padding: 0;
 text-indent: 0;
 list-style-type: none;
 }

 #navlist li
 {
 padding: 0;
 margin: 0;
 text-indent: 0;
 display: inline;
 }

 #navlist li a
 {
 letter-spacing: -1px;
 text-decoration: none;
 color: #ccc;
 font-size: 1em;
 padding: 0 2px;
 border-top: .5em solid #eee;
 }

 #navlist li a:hover,#navlist a#current
 {
 color: #333;
 border-top: none;
 }

 #navlist a#current { color: #fc6; font-size: 1.5em;}
 
 div.shadow {
 float: left;
	padding: 5px 20px 20px 20px;
	border: 1px solid #f0f0f0;
	border-bottom: 2px solid #ccc;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	width: 50%;
	background-image:url('../images/gradient.png');
	background-repeat:repeat-x; 
}

div.shadowStats
{
 	float: left;
	padding: 5px 20px 20px 20px;
	border: 1px solid #f0f0f0;
	border-bottom: 2px solid #ccc;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	width: 80%;
	margin-bottom: 20px;
	background-image:url('../images/gradient.png');
	background-repeat:repeat-x; 
}

div.shadowStats ul
{
 	list-style-type: square;
 	padding-left: 40px;
 	margin: 0px;
}
 
div.shadowStats li
{
 	margin-bottom: 10px
}

div.shadowStats h3 {
 font-size: 16px;
 color: #000000;
 margin-left: 20px;
 margin-right: 20px;
 padding-top: 2px;
 padding-left: 4px;
 font-family: Georgia, "Times New Roman", Times, serif;
 font-weight: bold;
} 

div.boxBiblioViewStats
{
 	float: left;
	padding: 5px 20px 20px 20px;
	border: 1px solid #f0f0f0;
	border-bottom: 2px solid #ccc;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	width: 250px;
	height: 135px;
	margin-bottom: 20px;
}


div.shadowWOImage
{
 	float: left;
	padding: 5px 20px 20px 20px;
	border: 1px solid #f0f0f0;
	border-bottom: 2px solid #ccc;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	width: 350px;
	margin-bottom: 20px; 
}

#shadow
{
 	float: left;
	padding: 5px 20px 20px 20px;
	border: 1px solid #f0f0f0;
	border-bottom: 2px solid #ccc;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	width: 350px;
	height: 300px;
	background-image:url('images/gradient.png');
	background-repeat:repeat-x; 
	color: #000000;
  font-size: 13px;
  font-family: verdana,arial,helvetica;
  position:relative;
}

#shadow div
{
	position: absolute;
	bottom: 0;
	border-top: 1px dotted black;
	width: inherit;
}

#shadow ul
{
 	list-style-type: square;
 	padding-left: 14px;
 	margin: 0px;
}
 
#shadow li
{
 	margin-bottom: 10px
}

#shadow h3 {
 font-size: 16px;
 color: #000000;
 margin-left: 20px;
 margin-right: 20px;
 padding-top: 2px;
 padding-left: 4px;
 font-family: Georgia, "Times New Roman", Times, serif;
 font-weight: bold;
} 
 
div.seperator{
   float: left;
   width: 20px;
   height: 300px;
}

div.clearboth{
   clear: both;
}
 
div.hseperator{
   height: 20px;
}
 
#shadowChangePassword
{
 	float: left;
	padding: 5px 20px 20px 20px;
	border-bottom: 2px solid #ccc;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	width: 420px;
	height: 130px;
	background-image:url('../images/gradient.png');
	background-repeat:repeat-x; 
	color: #000000;
  font-size: 13px;
  font-family: verdana,arial,helvetica;
  position:relative;
}

#shadowLargeSize
{
 	float: left;
	padding: 5px 20px 20px 10px;
	margin: 10px 10px 10px 0px;
	border: 1px solid #f0f0f0;
	border-bottom: 2px solid #ccc;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	width: 500px;
	/* height: 130px; */
	background-image:url('../images/gradient.png');
	background-repeat:repeat-x; 
	color: #000000;
  font-size: 13px;
  font-family: verdana,arial,helvetica;
  position:relative;
}

#shadowLargeSize ul
{
 	list-style-type: square;
 	padding-left: 14px;
 	margin: 0px;
}
 
#shadowLargeSize li
{
 	margin-bottom: 10px
}

#shadowLargeSize div
{
	position: absolute;
	bottom: 5;
	width: inherit;
}
.submitLink {
 color: #00f;
 background-color: transparent;
 text-decoration: underline;
 cursor: pointer;
 border: none;
 cursor: hand;
}

.buttonAsLink_hover {
 color: #00f;
 background-color: transparent;
 background-color:  #e9f3f6;
 text-decoration: underline;
 cursor: pointer;
 border: none;
 cursor: hand;
}

.boxMedium{
width: 650px;
}

.itemviewdetailslink
{
text-decoration: none;
}
