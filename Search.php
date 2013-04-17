<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once(str_replace('//','/',dirname(__FILE__).'/')."../functions/stringFuncs.php");
 
class Search {

	
  function type($title, $within, $fields, $method='words', $operator='like', $where='anywhere') {
    return array('title'=>$title, 'within'=>$within, 'fields'=>$fields,
      'method'=>$method, 'operator'=>$operator, 'where'=>$where);
  }
  function getParamDefs($types) {
    $l = array();
    foreach ($types as $n=>$t) {
      $l[] = array($n, array('title'=>$t['title']));
    }
    return array(
      array('group', 'terms', array('repeatable'=>true, 'must_have'=>'text'), array(
        array('select', 'type', array('title'=>'Search Type'), $l),
        array('string', 'text', array('title'=>'Search Text')),
        array('select', 'exact', array('title'=>'Exact Match', 'default'=>'0'), array(
          array('0', array('title'=>'No')),
          array('1', array('title'=>'Yes')),
        )),
      )),
    );
  }
  function getTerms($types, $terms) {
    $ret = array();
    foreach ($terms as $t) {
      assert('$t[0] == "group"');
      $t = $t[1];
      foreach (array('type', 'text', 'exact') as $n) {
        if ($t[$n]) {
          assert('$t[$n][0] == "string"');
          $t[$n] = $t[$n][1];
        }
      }
      list($type, $text, $exact) = $t;
      if (!array_key_exists($t['type'], $types)) {
        continue;
      }
      if ($types[$t['type']]['method'] == 'words' and !$t['exact']) {
       $words = explodeStr($t['text']);
        // Optimize the query a bit by eliminating duplicates and looking for longer
        // words first.  This should help cut down the number of records that have
        // to be scanned for subsequent words.
        usort($words, array('Search', 'lencmp'));
        foreach (array_unique($words) as $word) {
          if ($word == "") {
            continue;
          }
          array_push($ret, array($t['type'], $word, $t['exact']));
        }
      } else {
        array_push($ret, array($t['type'], $t['text'], $t['exact']));
      }
    }
    return $ret;
  }
  
  

}

?>
