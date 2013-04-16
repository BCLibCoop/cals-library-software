<?php

defined('__ROOT__') or define('__ROOT__', dirname(dirname(__FILE__)).'/');
require_once(__ROOT__."libs/ezsql/ez_sql_mysql.php");
require_once(__ROOT__."functions/sqlFuncs.php");

/******************************************************************************
 * ezQuery extends the usage of ezSQL_mysql
 *
 * @author Kieren Eaton <circledev@gmail.com>;
 * @version 1.0
 * @access public
 ******************************************************************************
 */

class ezQuery extends ezSQL_mysql
{

	function __construct()
	{
		parent::__construct();
	}

	/****************************************************************************
   	* Makes SQL by interpolating values into a format string.
   	* This function works something like printf() for SQL queries.  Format
   	* strings contain %-escapes signifying that a value from the argument
   	* list should be inserted into the string at that point.  The routine
   	* properly quotes or transforms the value to make sure that it will be
   	* handled correctly by the SQL server.  The recognized format strings
   	* are as follows:
   	*  %% - is replaced by a single '%' character and does not consume a
   	*       value form the argument list.
   	*  %! - inserts the argument in the query unaltered -- BE CAREFUL!
   	*  %B - treates the argument as a boolean value and inserts either
   	*       'Y' or 'N'as appropriate.
   	*  %C - treats the argument as a column reference.  This differs from
   	*       %I below only in that it passes the '.' operator for separating
   	*       table and column names on to the SQL server unquoted.
   	*  %I - treats the argument as an identifier to be quoted.
   	*  %i - does the same escaping as %I, but does not add surrounding
   	*       quotation marks.
   	*  %N - treats the argument as a number and strips off all of it but
   	*       an initial numeric string with optional sign and decimal point.
   	*  %Q - treats the argument as a string and quotes it.
   	*  %q - does the same escaping as %Q, but does not add surrounding
   	*       quotation marks.
   	* @param string $fmt format string
   	* @param string ... optional argument values
   	* @return string the result of interpreting $fmt
   	* @access public
   	****************************************************************************
   	*/
  	public function mkSQL()
  	{
    	$n = func_num_args();
    	if ($n < 1) {
    	  Fatal::internalError('Not enough arguments given to mkSQL().');
    	}
    	$i = 1;
    	$SQL = "";
    	$fmt = func_get_arg(0);
    	while (strlen($fmt)) {
    	  $p = strpos($fmt, "%");
    	  if ($p === false) {
    	    $SQL .= $fmt;
    	    break;
    	  }
    	  $SQL .= substr($fmt, 0, $p);
    	  if (strlen($fmt) < $p+2) {
    	    Fatal::internalError('Bad mkSQL() format string.');
    	  }
    	  if ($fmt{$p+1} == '%') {
    	    $SQL .= "%";
    	  } else {
    	    if ($i >= $n) {
    	      Fatal::internalError('Not enough arguments given to mkSQL().');
    	    }
    	    $arg = func_get_arg($i++);
    	    switch ($fmt{$p+1}) {
    	    case '!':
    	      /* very dangerous, but sometimes very useful -- be careful */
    	      $SQL .= $arg;
    	      break;
    	    case 'B':
    	      if ($arg) {
    	        $SQL .= "'Y'";
    	      } else {
    	        $SQL .= "'N'";
    	      }
    	      break;
    	    case 'C':
    	      $a = array();
    	      foreach (explode('.', $arg) as $ident) {
    	        array_push($a, '`'.$this->_ident($ident).'`');
    	      }
    	      $SQL .= implode('.', $a);
    	      break;
    	    case 'I':
    	      $SQL .= '`'.$this->_ident($arg).'`';
    	      break;
    	    case 'i':
    	      $SQL .= $this->_ident($arg);
    	      break;
    	    case 'N':
    	      $SQL .= $this->_numstr($arg);
    	      break;
    	    case 'Q':
    	      $SQL .= "'".$this->escape($arg)."'";
    	      break;
    	    case 'q':
    	      $SQL .= $this->escape($arg);
    	      break;
    	    default:
    	      Fatal::internalError('Bad mkSQL() format string.');
    	    }
    	  }
    	  $fmt = substr($fmt, $p+2);
    	}

    	if ($i != $n) {
    	  Fatal::internalError("Too many arguments to mkSQL(). Required $i recieved $n");
    	}
    	return $SQL;
  	}

  	protected function _numstr($n)
  	{
    	if (preg_match('/^([+-]?[0-9]+(\.[0-9]*)?([Ee][0-9]+)?)/', $n, $subs))
      		return $subs[1];

      	return '0';
  	}

	protected function _ident($i)
	{
		// strip quotes so we can add them manually
    	return str_replace('`', '', $i);
	}
}
