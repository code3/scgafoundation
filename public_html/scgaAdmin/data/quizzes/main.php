<?php

if ($_login->groupID == 1)
{

    $_isAdmin = true;

}

$_title = 'Yoc Quizzes';

$sortList = array('quiz.scga'

, 'kids.fname'

, 'kids.lname'

);
$orderStr = '';
if (in_array($_GET['sort_field'], $sortList))
{
    $orderStr = 'ORDER BY ' . $_GET['sort_field'];
}
$descStr = '';
if ($_GET['sort_desc'] == 1)
{
    $descStr = ' DESC';
}
if ($_GET['search'])
{
    $whereList = array();
    $onList = array();

    $scga = $_mysql->makeSafe(trim($_GET['scga']));
    $first_name = $_mysql->makeSafe(trim($_GET['first_name']));
    $last_name = $_mysql->makeSafe(trim($_GET['last_name']));

    //validate string lengths
    if (isset($scga[MAXLENB]))
    {
        $_SESSION[PRFIX . 'error'] = $_p . ' -  SCGA is too long';
    }

    if (isset($first_name[MAXLENB]))
    {
        $_SESSION[PRFIX . 'error'] = $_p . ' -  first name is too long';
    }

    if (isset($last_name[MAXLENB]))
    {
        $_SESSION[PRFIX . 'error'] = $_p . ' -  last name is too long';
    }

    if (isset($_SESSION[PRFIX . 'error']))
    {
        died(CLIENTROOT . '/error/');
    }

    if ($scga != '')
    {
        array_push($whereList, "quiz.scga LIKE '%$scga%'");
    }

    if ($first_name != '')
    {
        array_push($whereList, " kids.fname LIKE '%$first_name%'");
    }

    if ($last_name != '')
    {
        array_push($whereList, " kids.lname LIKE '%$last_name%'");
    }
    if (count($whereList) > 0)
    {
        $where = "WHERE " . implode(' AND ', $whereList);
    }
}
$countInfo = $_mysql->get("SELECT COUNT(*) AS count FROM kids Inner join quiz on kids.scga = quiz.scga " . $where);

if ($countInfo)
{

    $numOfItem = $countInfo[0]['count'];

    $_pl = new pageLinks(10, $numOfItem);

}

else
{

    $numOfItem = 0;

    $_pl = new pageLinks(10, $numOfItem);

}
$quizzes = $_mysql->get("select quiz.scga, kids.fname, kids.lname from kids Inner join quiz on kids.scga = quiz.scga " . $where . " " . $orderStr . $descStr . " LIMIT " . $_pl->limit);

?>