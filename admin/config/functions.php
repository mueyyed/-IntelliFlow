<?php

$request = $_GET['req'];
switch ($request) {
    case "login_form_submitted":
        login();
        break;
    case "user_delete":
        user_delete();
        break;
    case "propose_delete":
        propose_delete();
        break;
    case "give_prize":
        give_prize();
        break;
    case "report_delete":
        report_delete();
        break;
    case "accept_report":
        accept_report();
        break;

}
function dt_debag($data = null, $with_die = true)
{
    echo "<pre>";
    print_r($data);
    if ($with_die) {
        die();
    }


}

function getDateFromString($str)
{
    $date = DateTime::createFromFormat('d.m.y', $str);
    if ($date !== false)
        return $date->getTimestamp();

    // you can try other common formats here
    // ...

    // otherwise just parse whatever there is
    return strtotime($str);
}

//----------------------------------------------
// Endpoint:
function endpoint_fetch_all($endpoint, $filter = null)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://frientek.com/' . $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);

}

function endpoint_fetch($endpoint, $id = null)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://frientek.com/' . $endpoint . '/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);

}

function endpoint_create($endpoint, $data = null)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://frientek.com/' . $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);

}

function endpoint_update($endpoint, $data = null, $id = null)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://frientek.com/' . $endpoint . '/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'patch',
        CURLOPT_POSTFIELDS => $data,
    ));

    $response = curl_exec($curl);
    curl_close($curl);


    return json_decode($response);

}

function endpoint_delete($endpoint, $id = null)
{

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://frientek.com/' . $endpoint . '/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}

function accept_report()
{
    $id = $_GET['id'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://frientek.com/Reports/accept-report/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    //dt_debag($response);
    curl_close($curl);

    if ($response->error) {
        header('Location: ../reports/index.php?approved=0');
    } else {
        header('Location: ../reports/index.php?approved=1');
    }
    die();
}

function report_delete()
{
    $id = $_GET['id'];
    $response = endpoint_delete("Reports", $id);

    if ($response->error) {
        header('Location: ../reports/index.php?deleted=0');
    } else {
        header('Location: ../reports/index.php?deleted=1');
    }
    die();
}

function give_prize()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://frientek.com/Proposes/give-prize',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('prize' => $_POST['prize'], 'id' => $_POST['id']),
    ));

    $response = curl_exec($curl);

    curl_close($curl);


    if ($response->error) {
        echo 0;
    } else {
        echo 1;
    }
    die();
}

function propose_delete()
{
    $id = $_GET['id'];
    $response = endpoint_delete("Proposes", $id);

    if ($response->error) {
        header('Location: ../Proposes?deleted=0');
    } else {
        header('Location: ../Proposes?deleted=1');
    }
    die();
}

function user_delete()
{
    $id = $_GET['id'];
    $response = endpoint_delete("Users", $id);

    if ($response->error) {
        header('Location: ../users?deleted=0');
    } else {
        header('Location: ../users?deleted=1');
    }
    die();
}

