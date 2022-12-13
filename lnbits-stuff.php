<?php

/*

Plugin Name: lnbits stuff
Plugin URI: https://satoshibox.io
Description: plugin for lnbits functions
Version: 1.0
Author: Disbuster / onnbt
Author URI: https://github.com/onnbt/lnQr_php
 
License: GPLv2 or later


*/
	




    header('Content-Type: application/json');


    function getWalletID()
    {
  
      $url = 'https://lnbits.papersats.io/api/v1/wallet';//API URL
   
      $options = array(
        'http' => array(
        'method'  => 'GET',
        'header'=>  "Content-Type: application/json\r\n".
              "Accept: application/json\r\n".
              "X-Api-Key: 202684973e5f456c8096161b4bf39661\r\n" //Invoice Key
        )
      );
      

      
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );
      echo $response->name;
     

    } 
    
    function btcInfo()
    {
      //https://www.blockchain.com/api/exchange_rates_api
      $url = 'https://blockchain.info/ticker';//API URL 4 btc to eur
    
    
      $options = array(
          'http' => array(
          'method'  => 'GET'
          )
      );
        
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );
      echo $result;
      //return $response;
    }

    function getWalletDetails()
    {
      $url = 'https://lnbits.papersats.io/api/v1/wallet';//API URL

      $options = array(
          'http' => array(
          'method'  => 'GET',
          'header'=>  "Content-Type: application/json\r\n".
                      "Accept: application/json\r\n".
              
                      "X-Api-Key: 202684973e5f456c8096161b4bf39661\r\n" //Invoice Key vps

          )
      );
        
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );

      echo $response->balance;
    }

    //block um GET/POST -Requests endgegen zu nehmen und an die jeweilige funktion weiterzuleiten 
    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {

        switch($_POST['functionname']) {
               case 'getWalletID':
                if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                    $aResult['error'] = 'Error in arguments!';
                }
                else {
                    $aResult['result'] = getWalletID($_POST['arguments'][0]);
                }
                break;
                case 'getBTCinfo':
                    if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 1) ) {
                        $aResult['error'] = 'Error in arguments!';
                    }
                    else {
                        $aResult['result'] = btcInfo($_POST['arguments'][0]);
                    }
                    break;      
                case 'getWalletDetails':
                    if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 0) ) {
                        $aResult['error'] = 'Error in arguments!';
                    }
                    else {
                        $aResult['result'] = getWalletDetails($_POST['arguments'][0]);
                    }
                    break;
                case 'freiBez':
                    if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 0) ) {
                            $aResult['error'] = 'Error in arguments!';
                    }
                    else {
                            $aResult['result'] = getFreiBez($_POST['arguments'][0]);
                    }
                    break;
                case 'getGesperteBezAll':
                    if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 0) ) {
                            $aResult['error'] = 'Error in arguments!';
                          }
                    else {
                            $aResult['result'] = getGesperteBezAll($_POST['arguments'][0]);
                    }
                    break;                                                        
             default:
                $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
                break;
        }

    }

    //echo json_encode($aResult);
?>