#!/usr/bin/php

<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function deploy($request)
{
  //echo($request["message"]);
  //echo("THIS ECHO IS ONLY FOR TESTING");
  //shell_exec("python3 install.py ". $request["version"].$request["BUNDLENAME"]); 

$deployPath = '/home/vm1/temp/';

  echo "\n Installing " . $request['bundleName']. $request['version']. " \n";

  //create tmp folder
  shell_exec('mkdir ' . $deployPath . 'tmp/');

  //decompress
  shell_exec('tar -xvf '. $deployPath .$request['bundleTar'] . ' -C ' . $deployPath . "tmp");

  $ini = (parse_ini_file($deployPath . 'tmp/' . 'bundle.ini'));
  $dstPath =  $ini[$request['bundleFolder']];

  //delete tmp folder
//  shell_exec('rm -rf ' . $deployPath . 'tmp/' );

  //copy tar to correct path - 1 directory
  $rtPath = str_replace(PHP_EOL, '',  shell_exec('dirname '. $dstPath));
 // $rtPath = $dstPath;

 // shell_exec('rm -rf ' . $dstPath);
  shell_exec('cp ' . $deployPath . $request['bundleTar'] . ' ' . $rtPath);
	//echo 'cp ' . $deployPath . $request['bundleTar'] . ' ' . $rtPath;

  shell_exec( 'tar -xvf '. $rtPath . '/' . $request['bundleTar']. ' -C ' . $rtPath );
//echo 'tar -xvf '. $rtPath . '/' . $request['bundleTar']. ' -C ' . $rtPath;  
  shell_exec('rm ' . $rtPath . '/'. $request['bundleTar'] );

	
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "deployAlert":
      return deploy($request);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
?>

