


var btcInfo;
var payment_request;
var balance; 
var walletID;
var aniSum;
var transactions = 3; // transactions count to be used 


function formatValueAsWallet(val){
    var value = (val).toLocaleString('de-DE');
      return value;
}


function formatValueAsSatoshi(val){
    var value = (val).toLocaleString('de-DE');
      return value;
}

function formatValueAsEUR(val){

    var eur = {
        style: "currency",
        currency: "EUR"
      }

    return (val).toLocaleString('de-DE', eur);
}


function getWalletID(){
    jQuery.ajax({
        type: 'POST',
/*WICHTIG*/ url: '/assets/check_lnbits_wallet/check-wallet.php', // <-- Hier der Pfad/URL zu der php mit den Funktionen
        dataType: 'JSON',
        data: {functionname: 'getWalletID', arguments: ['name']}, // <---- Name der Funktion die du aufrufen willst und die Argumente die du Übergeben willst
        success: function (resp) { //Diese Funktion wird bei erfolgreicher abfrage ausgelöst Hier Daten rausziehen und ggf. Fehler abfangen 
               console.log(resp);
                walletID = JSON.parse(resp);
                document.getElementById('walletID').innerHTML = walletID;
               
            }
    });
}

function getBTCinfo(){
    jQuery.ajax({
        type: 'POST',
/*WICHTIG*/ url: '/assets/check_lnbits_wallet/check-wallet.php', // <-- Hier der Pfad/URL zu der php mit den Funktionen
        dataType: 'JSON',
        data: {functionname: 'getBTCinfo', arguments: ['fck bnks']}, // <---- Name der Funktion die du aufrufen willst und die Argumente die du Übergeben willst
        success: function (resp) { //Diese Funktion wird bei erfolgreicher abfrage ausgelöst Hier Daten rausziehen und ggf. Fehler abfangen 
            // console.log(resp);
            //btcInfo = JSON.parse(resp);
            btcInfo = resp;
            document.getElementById('balanceEur').innerHTML = formatValueAsEUR(btcInfo.EUR.last*0.00000001*(balance/1000));
        }
    });
}

function getWalletDetails(){
    jQuery.ajax({
        type: 'POST',
/*WICHTIG*/ url: '/assets/check_lnbits_wallet/check-wallet.php', // <-- Hier der Pfad/URL zu der php mit den Funktionen
        dataType: 'JSON',
        data: {functionname: 'getWalletDetails', arguments: ['fck bnks']}, // <---- Name der Funktion die du aufrufen willst und die Argumente die du Übergeben willst
        success: function (resp) { //Diese Funktion wird bei erfolgreicher abfrage ausgelöst Hier Daten rausziehen und ggf. Fehler abfangen 
                balance = resp;
                document.getElementById('balanceSat').innerHTML = (balance/1000);
                getBTCinfo();
            }
    });
}



getWalletID();
getWalletDetails();


