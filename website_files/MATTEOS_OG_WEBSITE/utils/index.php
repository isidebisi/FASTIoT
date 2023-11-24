<?php

$servername = "localhost";
$dBUsername = "id21525238_id21476219_ismaelfrei";
$dBPassword = "FASTIoT_2023";
$dBName = "id21525238_id21476219_esp32";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}

// Check if form is submitted - MODE
if (isset($_POST['change_mode'])) {
    $new_mode = $_POST['operation_mode'];
    $update = mysqli_query($conn, "UPDATE Operation_Mode SET status = '$new_mode' WHERE id = 1;");
}



if (isset($_POST['toggle_LED'])) {
	$sql = "SELECT * FROM LED_status;";
	$result   = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	
	if($row['status'] == 0){
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 1 WHERE id = 1;");		
	}		
	else{
		$update = mysqli_query($conn, "UPDATE LED_status SET status = 0 WHERE id = 1;");		
	}
}



// Fetch the current operation mode
$sqlO = "SELECT * FROM Operation_Mode WHERE id = 1;";
$resultO = mysqli_query($conn, $sqlO);
$rowO = mysqli_fetch_assoc($resultO);
$current_mode = $rowO['status'];


$sql = "SELECT * FROM LED_status;";
$result   = mysqli_query($conn, $sql);
$row  = mysqli_fetch_assoc($result);
?>





<html><head><meta charset="utf-8"><meta name="viewport" content="width=1440, maximum-scale=1.0"><link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png"><meta name="og:type" content="website"><meta name="twitter:card" content="photo"><script id="anima-hotspots-script" src="hotspots.js"></script><script id="anima-overrides-script" src="overrides.js"></script><script src="https://animaapp.s3.amazonaws.com/js/timeline.js"></script><style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");

@import url("https://fonts.googleapis.com/css?family=Roboto:500,400");

/* The following line is used to measure usage of this code. You can remove it if you want. */
@import url("https://px.animaapp.com/654924bc6a10cb7e214665eb.654924c16a10cb7e214665ee.u120ISO.hch.png");


.screen textarea:focus,
.screen input:focus {
  outline: none;
}

.screen * {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

.screen div {
  -webkit-text-size-adjust: none;
}

.component-wrapper a {
  display: contents;
  pointer-events: auto;
  text-decoration: none;
}

.component-wrapper * {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
  pointer-events: none;
}

.component-wrapper a *,
.component-wrapper input,
.component-wrapper video,
.component-wrapper iframe {
  pointer-events: auto;
}

.component-wrapper.not-ready,
.component-wrapper.not-ready * {
  visibility: hidden !important;
}

.screen a {
  display: contents;
  text-decoration: none;
}

.full-width-a {
  width: 100%;
}

.full-height-a {
  height: 100%;
}

.container-center-vertical {
  align-items: center;
  display: flex;
  flex-direction: row;
  height: 100%;
  pointer-events: none;
}

.container-center-vertical > * {
  flex-shrink: 0;
  pointer-events: auto;
}

.container-center-horizontal {
  display: flex;
  flex-direction: row;
  justify-content: center;
  pointer-events: none;
  width: 100%;
}

.container-center-horizontal > * {
  flex-shrink: 0;
  pointer-events: auto;
}

.auto-animated div {
  --z-index: -1;
  opacity: 0;
  position: absolute;
}

.auto-animated input {
  --z-index: -1;
  opacity: 0;
  position: absolute;
}

.auto-animated .container-center-vertical,
.auto-animated .container-center-horizontal {
  opacity: 1;
}

.overlay-base {
  display: none;
  height: 100%;
  opacity: 0;
  position: fixed;
  top: 0;
  width: 100%;
}

.overlay-base.animate-appear {
  align-items: center;
  animation: reveal 0.3s ease-in-out 1 normal forwards;
  display: flex;
  flex-direction: column;
  justify-content: center;
  opacity: 0;
}

.overlay-base.animate-disappear {
  animation: reveal 0.3s ease-in-out 1 reverse forwards;
  display: block;
  opacity: 1;
  pointer-events: none;
}

.overlay-base.animate-disappear * {
  pointer-events: none;
}

@keyframes reveal {
  from { opacity: 0 }
 to { opacity: 1 }
}

.animate-nodelay {
  animation-delay: 0s;
}

.align-self-flex-start {
  align-self: flex-start;
}

.align-self-flex-end {
  align-self: flex-end;
}

.align-self-flex-center {
  align-self: flex-center;
}

.valign-text-middle {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.valign-text-bottom {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
}

input:focus {
  outline: none;
}

.listeners-active,
.listeners-active * {
  pointer-events: auto;
}

.hidden,
.hidden * {
  pointer-events: none;
  visibility: hidden;
}

.smart-layers-pointers,
.smart-layers-pointers * {
  pointer-events: auto;
  visibility: visible;
}

.listeners-active-click,
.listeners-active-click * {
  cursor: pointer;
}

* {
  box-sizing: border-box;
}
:root { 
  --black: #000000;
  --colourbackground-light-grey: #fbfbfd;
  --colourmainblue400: #6f7cb2;
  --colourmainblue500: #505f98;
  --colourmainblue800: #111b47;
  --colourmainblue900: #091133;
  --colourmaingrey600: #5d6970;
  --coloursecondarywhite-100-general: #ffffff;
 
  --font-size-l: 14px;
  --font-size-m: 12px;
  --font-size-xl: 16px;
  --font-size-xxl: 36px;
 
  --font-family-roboto: "Roboto", Helvetica;
}
.medium-16 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xl);
  font-style: normal;
  font-weight: 500;
  letter-spacing: 0px;
}

.regular-12 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-m);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.regular-16 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xl);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.regular-14 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-l);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.medium-36 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xxl);
  font-style: normal;
  font-weight: 500;
  letter-spacing: 0px;
}

:root {
}


/* screen - sectionu47featuresu47multiu4778 */

.sectionu47featuresu47multiu4778 {
  background-color: var(--colourbackground-light-grey);
  height: 909px;
  overflow: hidden;
  overflow-x: hidden;
  position: relative;
  width: 1440px;
}

.sectionu47featuresu47multiu4778 .element-card-info-ca-f4Pf72 {
  background-color: transparent;
  height: 138px;
  left: 51px;
  position: absolute;
  top: 421px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .body-waWlHy {
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 0px;
  line-height: 18px;
  text-align: center;
  top: 81px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .title-waWlHy {
  left: 0px;
  line-height: 26px;
  text-align: left;
  top: 49px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .body-f4Pf72 {
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 242px;
  line-height: 18px;
  text-align: center;
  top: 698px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .flex-container-0155-f4Pf72 {
  align-items: flex-start;
  background-color: transparent;
  display: flex;
  flex-direction: column;
  gap: 4px;
  height: 112px;
  left: 403px;
  position: absolute;
  top: 500px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .text0-0155-cVuXNM {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  line-height: 18px;
  position: relative;
  text-align: center;
}

.sectionu47featuresu47multiu4778 .span0-Zx3zwe {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text1-0155-cVuXNM {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  line-height: 18px;
  position: relative;
  text-align: center;
}

.sectionu47featuresu47multiu4778 .span1-7a1jcc {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .title-f4Pf72 {
  left: 382px;
  line-height: 26px;
  text-align: left;
  top: 499px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-f4Pf72 {
  left: 105px;
  top: 454px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-Z49R6e {
  left: 450px;
  top: 447px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-XxXuiw {
  left: 296px;
  top: 647px;
}

.sectionu47featuresu47multiu4778 .text-block-section-l-f4Pf72 {
  background-color: transparent;
  height: 90px;
  left: 156px;
  position: absolute;
  top: 91px;
  width: 520px;
}

.sectionu47featuresu47multiu4778 .title-VVClgd {
  left: 0px;
  line-height: 48px;
  text-align: center;
  top: -1px;
  width: 520px;
}

.sectionu47featuresu47multiu4778 .devices-samsung-vert-f4Pf72 {
  background-color: transparent;
  height: 1031px;
  left: 783px;
  position: absolute;
  top: 100px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .samsung-9tSitW {
  background-color: transparent;
  height: 1031px;
  left: 0px;
  position: relative;
  top: 0px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .body-12Jxfx {
  height: 1031px;
  left: 0px;
  top: 0px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .layer-0-CM1osj {
  background-color: transparent;
  height: 809px;
  left: 3px;
  position: absolute;
  top: 0px;
  width: 486px;
}

.sectionu47featuresu47multiu4778 .buttons-CM1osj {
  background-color: transparent;
  height: 262px;
  left: 0px;
  position: absolute;
  top: 172px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .group-3-oaMxnx {
  height: 130px;
  top: 6px;
}

.sectionu47featuresu47multiu4778 .group-3-0cAmWi {
  height: 66px;
  top: 197px;
}

.sectionu47featuresu47multiu4778 .group-3-copy-oaMxnx {
  background-color: transparent;
  height: 66px;
  left: 487px;
  position: absolute;
  top: 0px;
  width: 5px;
}

.sectionu47featuresu47multiu4778 .layer-1-CM1osj {
  background-color: #020000;
  border: 2px solid;
  border-color: #e7e7e7;
  border-radius: 62px 62px 67.5px 67.5px;
  box-shadow: 0px 2px 0px #0000003e , 0px -2px 0px #0000003e;
  height: 1019px;
  left: 4px;
  position: absolute;
  top: 6px;
  width: 483px;
}

.sectionu47featuresu47multiu4778 .rectangle-CM1osj {
  background-color: #00000030;
  height: 10px;
  left: 406px;
  position: absolute;
  top: 1022px;
  width: 11px;
}

.sectionu47featuresu47multiu4778 .rectangle-copy-2-CM1osj {
  background-color: #00000030;
  height: 10px;
  left: 74px;
  position: absolute;
  top: 1022px;
  width: 11px;
}

.sectionu47featuresu47multiu4778 .screen-12Jxfx {
  background-color: transparent;
  height: 787px;
  left: 12px;
  position: absolute;
  top: 22px;
  width: 468px;
}

.sectionu47featuresu47multiu4778 .reflections-12Jxfx {
  background-color: transparent;
  height: 799px;
  left: 12px;
  position: absolute;
  top: 10px;
  width: 468px;
}

.sectionu47featuresu47multiu4778 .camera-12Jxfx {
  background-color: transparent;
  height: 34px;
  left: 372px;
  position: absolute;
  top: 36px;
  width: 80px;
}

.sectionu47featuresu47multiu4778 .rectangle-xm2s6v {
  background-color: var(--black);
  border-radius: 26.5px;
  height: 36px;
  left: -1px;
  position: absolute;
  top: -1px;
  width: 82px;
}

.sectionu47featuresu47multiu4778 .group-xm2s6v {
  background-color: transparent;
  height: 23px;
  left: 7px;
  position: absolute;
  top: 6px;
  width: 68px;
}

.sectionu47featuresu47multiu4778 .group-7-3zPRF9 {
  height: 21px;
  left: 0px;
  top: 1px;
  width: 21px;
}

.sectionu47featuresu47multiu4778 .oval-w0ZXV9 {
  left: 0px;
  top: 0px;
}

.sectionu47featuresu47multiu4778 .group-6-w0ZXV9 {
  height: 16px;
  left: 2px;
  top: 3px;
  width: 16px;
}

.sectionu47featuresu47multiu4778 .group-7-PCdqvc {
  height: 23px;
  left: 45px;
  top: 0px;
  width: 23px;
}

.sectionu47featuresu47multiu4778 .oval-Mt56cv {
  left: 1px;
  top: 1px;
}

.sectionu47featuresu47multiu4778 .group-6-Mt56cv {
  height: 23px;
  left: 0px;
  top: 0px;
  width: 23px;
}

.sectionu47featuresu47multiu4778 .flex-container-0168-f4Pf72 {
  align-items: flex-start;
  background-color: transparent;
  display: flex;
  flex-direction: column;
  gap: 10px;
  height: 252px;
  left: 51px;
  position: absolute;
  top: 155px;
  width: 662px;
}

.sectionu47featuresu47multiu4778 .text0-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span0-54bmXF {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text1-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span1-mMoybj {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text2-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span2-F96oLP {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text3-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span3-g6blcS {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text4-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span4-sKVdlr {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text5-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span5-VYf4ms {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .hero-f4Pf72 {
  background-color: transparent;
  height: 1025px;
  left: -18px;
  position: absolute;
  top: -12px;
  width: 1573px;
}

.sectionu47featuresu47multiu4778 .designer_1-FY77tv {
  background-color: transparent;
  height: 521px;
  left: 2205px;
  position: absolute;
  top: 898px;
  width: 88px;
}

.sectionu47featuresu47multiu4778 .home-f4Pf72 {
  background-color: transparent;
  color: var(--colourmainblue500);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 38px;
  line-height: 24px;
  position: absolute;
  text-align: left;
  top: 6px;
  white-space: nowrap;
  width: auto;
}

.sectionu47featuresu47multiu4778 .about-f4Pf72 {
  left: 103px;
}

.sectionu47featuresu47multiu4778 .about-Z49R6e {
  left: 206px;
}

.sectionu47featuresu47multiu4778 .about {
  background-color: transparent;
  color: var(--colourmainblue500);
  font-style: normal;
  font-weight: 400;
  height: auto;
  line-height: 24px;
  position: absolute;
  text-align: left;
  top: 6px;
  white-space: nowrap;
  width: auto;
}

.sectionu47featuresu47multiu4778 .bg {
  background-color: var(--colourmainblue800);
  border-radius: 2px;
  height: 36px;
  left: 0px;
  position: absolute;
  top: 0px;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .body {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .button-label {
  background-color: transparent;
  color: var(--coloursecondarywhite-100-general);
  font-style: normal;
  font-weight: 500;
  height: auto;
  left: 0px;
  line-height: 26px;
  position: absolute;
  text-align: center;
  top: 5px;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled {
  background-color: transparent;
  height: 36px;
  position: absolute;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .group-3 {
  background-color: transparent;
  left: 0px;
  position: absolute;
  width: 5px;
}

.sectionu47featuresu47multiu4778 .group-6 {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .group-7 {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .oval {
  background-color: transparent;
  height: 21px;
  position: absolute;
  width: 21px;
}

.sectionu47featuresu47multiu4778 .title {
  background-color: transparent;
  color: var(--colourmainblue900);
  font-style: normal;
  font-weight: 500;
  height: auto;
  position: absolute;
}



<html><head><meta charset="utf-8"><meta name="viewport" content="width=1440, maximum-scale=1.0"><link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png"><meta name="og:type" content="website"><meta name="twitter:card" content="photo"><script id="anima-hotspots-script" src="hotspots.js"></script><script id="anima-overrides-script" src="overrides.js"></script><script src="https://animaapp.s3.amazonaws.com/js/timeline.js"></script><style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");

@import url("https://fonts.googleapis.com/css?family=Roboto:500,400");

/* The following line is used to measure usage of this code. You can remove it if you want. */
@import url("https://px.animaapp.com/654924bc6a10cb7e214665eb.654924c16a10cb7e214665ee.u120ISO.hch.png");


.screen textarea:focus,
.screen input:focus {
  outline: none;
}

.screen * {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

.screen div {
  -webkit-text-size-adjust: none;
}

.component-wrapper a {
  display: contents;
  pointer-events: auto;
  text-decoration: none;
}

.component-wrapper * {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
  pointer-events: none;
}

.component-wrapper a *,
.component-wrapper input,
.component-wrapper video,
.component-wrapper iframe {
  pointer-events: auto;
}

.component-wrapper.not-ready,
.component-wrapper.not-ready * {
  visibility: hidden !important;
}

.screen a {
  display: contents;
  text-decoration: none;
}

.full-width-a {
  width: 100%;
}

.full-height-a {
  height: 100%;
}

.container-center-vertical {
  align-items: center;
  display: flex;
  flex-direction: row;
  height: 100%;
  pointer-events: none;
}

.container-center-vertical > * {
  flex-shrink: 0;
  pointer-events: auto;
}

.container-center-horizontal {
  display: flex;
  flex-direction: row;
  justify-content: center;
  pointer-events: none;
  width: 100%;
}

.container-center-horizontal > * {
  flex-shrink: 0;
  pointer-events: auto;
}

.auto-animated div {
  --z-index: -1;
  opacity: 0;
  position: absolute;
}

.auto-animated input {
  --z-index: -1;
  opacity: 0;
  position: absolute;
}

.auto-animated .container-center-vertical,
.auto-animated .container-center-horizontal {
  opacity: 1;
}

.overlay-base {
  display: none;
  height: 100%;
  opacity: 0;
  position: fixed;
  top: 0;
  width: 100%;
}

.overlay-base.animate-appear {
  align-items: center;
  animation: reveal 0.3s ease-in-out 1 normal forwards;
  display: flex;
  flex-direction: column;
  justify-content: center;
  opacity: 0;
}

.overlay-base.animate-disappear {
  animation: reveal 0.3s ease-in-out 1 reverse forwards;
  display: block;
  opacity: 1;
  pointer-events: none;
}

.overlay-base.animate-disappear * {
  pointer-events: none;
}

@keyframes reveal {
  from { opacity: 0 }
 to { opacity: 1 }
}

.animate-nodelay {
  animation-delay: 0s;
}

.align-self-flex-start {
  align-self: flex-start;
}

.align-self-flex-end {
  align-self: flex-end;
}

.align-self-flex-center {
  align-self: flex-center;
}

.valign-text-middle {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.valign-text-bottom {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
}

input:focus {
  outline: none;
}

.listeners-active,
.listeners-active * {
  pointer-events: auto;
}

.hidden,
.hidden * {
  pointer-events: none;
  visibility: hidden;
}

.smart-layers-pointers,
.smart-layers-pointers * {
  pointer-events: auto;
  visibility: visible;
}

.listeners-active-click,
.listeners-active-click * {
  cursor: pointer;
}

* {
  box-sizing: border-box;
}
:root { 
  --black: #000000;
  --colourbackground-light-grey: #fbfbfd;
  --colourmainblue400: #6f7cb2;
  --colourmainblue500: #505f98;
  --colourmainblue800: #111b47;
  --colourmainblue900: #091133;
  --colourmaingrey600: #5d6970;
  --coloursecondarywhite-100-general: #ffffff;
 
  --font-size-l: 14px;
  --font-size-m: 12px;
  --font-size-xl: 16px;
  --font-size-xxl: 36px;
 
  --font-family-roboto: "Roboto", Helvetica;
}
.medium-16 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xl);
  font-style: normal;
  font-weight: 500;
  letter-spacing: 0px;
}

.regular-12 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-m);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.regular-16 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xl);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.regular-14 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-l);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.medium-36 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xxl);
  font-style: normal;
  font-weight: 500;
  letter-spacing: 0px;
}

:root {
}


/* screen - sectionu47featuresu47multiu4778 */

.sectionu47featuresu47multiu4778 {
  background-color: var(--colourbackground-light-grey);
  height: 909px;
  overflow: hidden;
  overflow-x: hidden;
  position: relative;
  width: 1440px;
}

.sectionu47featuresu47multiu4778 .element-card-info-ca-f4Pf72 {
  background-color: transparent;
  height: 138px;
  left: 51px;
  position: absolute;
  top: 421px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .body-waWlHy {
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 0px;
  line-height: 18px;
  text-align: center;
  top: 81px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .title-waWlHy {
  left: 0px;
  line-height: 26px;
  text-align: left;
  top: 49px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .body-f4Pf72 {
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 242px;
  line-height: 18px;
  text-align: center;
  top: 698px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .flex-container-0155-f4Pf72 {
  align-items: flex-start;
  background-color: transparent;
  display: flex;
  flex-direction: column;
  gap: 4px;
  height: 112px;
  left: 403px;
  position: absolute;
  top: 500px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .text0-0155-cVuXNM {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  line-height: 18px;
  position: relative;
  text-align: center;
}

.sectionu47featuresu47multiu4778 .span0-Zx3zwe {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text1-0155-cVuXNM {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  line-height: 18px;
  position: relative;
  text-align: center;
}

.sectionu47featuresu47multiu4778 .span1-7a1jcc {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .title-f4Pf72 {
  left: 382px;
  line-height: 26px;
  text-align: left;
  top: 499px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-f4Pf72 {
  left: 105px;
  top: 454px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-Z49R6e {
  left: 450px;
  top: 447px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-XxXuiw {
  left: 296px;
  top: 647px;
}

.sectionu47featuresu47multiu4778 .text-block-section-l-f4Pf72 {
  background-color: transparent;
  height: 90px;
  left: 156px;
  position: absolute;
  top: 91px;
  width: 520px;
}

.sectionu47featuresu47multiu4778 .title-VVClgd {
  left: 0px;
  line-height: 48px;
  text-align: center;
  top: -1px;
  width: 520px;
}

.sectionu47featuresu47multiu4778 .devices-samsung-vert-f4Pf72 {
  background-color: transparent;
  height: 1031px;
  left: 783px;
  position: absolute;
  top: 100px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .samsung-9tSitW {
  background-color: transparent;
  height: 1031px;
  left: 0px;
  position: relative;
  top: 0px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .body-12Jxfx {
  height: 1031px;
  left: 0px;
  top: 0px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .layer-0-CM1osj {
  background-color: transparent;
  height: 809px;
  left: 3px;
  position: absolute;
  top: 0px;
  width: 486px;
}

.sectionu47featuresu47multiu4778 .buttons-CM1osj {
  background-color: transparent;
  height: 262px;
  left: 0px;
  position: absolute;
  top: 172px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .group-3-oaMxnx {
  height: 130px;
  top: 6px;
}

.sectionu47featuresu47multiu4778 .group-3-0cAmWi {
  height: 66px;
  top: 197px;
}

.sectionu47featuresu47multiu4778 .group-3-copy-oaMxnx {
  background-color: transparent;
  height: 66px;
  left: 487px;
  position: absolute;
  top: 0px;
  width: 5px;
}

.sectionu47featuresu47multiu4778 .layer-1-CM1osj {
  background-color: #020000;
  border: 2px solid;
  border-color: #e7e7e7;
  border-radius: 62px 62px 67.5px 67.5px;
  box-shadow: 0px 2px 0px #0000003e , 0px -2px 0px #0000003e;
  height: 1019px;
  left: 4px;
  position: absolute;
  top: 6px;
  width: 483px;
}

.sectionu47featuresu47multiu4778 .rectangle-CM1osj {
  background-color: #00000030;
  height: 10px;
  left: 406px;
  position: absolute;
  top: 1022px;
  width: 11px;
}

.sectionu47featuresu47multiu4778 .rectangle-copy-2-CM1osj {
  background-color: #00000030;
  height: 10px;
  left: 74px;
  position: absolute;
  top: 1022px;
  width: 11px;
}

.sectionu47featuresu47multiu4778 .screen-12Jxfx {
  background-color: transparent;
  height: 787px;
  left: 12px;
  position: absolute;
  top: 22px;
  width: 468px;
}

.sectionu47featuresu47multiu4778 .reflections-12Jxfx {
  background-color: transparent;
  height: 799px;
  left: 12px;
  position: absolute;
  top: 10px;
  width: 468px;
}

.sectionu47featuresu47multiu4778 .camera-12Jxfx {
  background-color: transparent;
  height: 34px;
  left: 372px;
  position: absolute;
  top: 36px;
  width: 80px;
}

.sectionu47featuresu47multiu4778 .rectangle-xm2s6v {
  background-color: var(--black);
  border-radius: 26.5px;
  height: 36px;
  left: -1px;
  position: absolute;
  top: -1px;
  width: 82px;
}

.sectionu47featuresu47multiu4778 .group-xm2s6v {
  background-color: transparent;
  height: 23px;
  left: 7px;
  position: absolute;
  top: 6px;
  width: 68px;
}

.sectionu47featuresu47multiu4778 .group-7-3zPRF9 {
  height: 21px;
  left: 0px;
  top: 1px;
  width: 21px;
}

.sectionu47featuresu47multiu4778 .oval-w0ZXV9 {
  left: 0px;
  top: 0px;
}

.sectionu47featuresu47multiu4778 .group-6-w0ZXV9 {
  height: 16px;
  left: 2px;
  top: 3px;
  width: 16px;
}

.sectionu47featuresu47multiu4778 .group-7-PCdqvc {
  height: 23px;
  left: 45px;
  top: 0px;
  width: 23px;
}

.sectionu47featuresu47multiu4778 .oval-Mt56cv {
  left: 1px;
  top: 1px;
}

.sectionu47featuresu47multiu4778 .group-6-Mt56cv {
  height: 23px;
  left: 0px;
  top: 0px;
  width: 23px;
}

.sectionu47featuresu47multiu4778 .flex-container-0168-f4Pf72 {
  align-items: flex-start;
  background-color: transparent;
  display: flex;
  flex-direction: column;
  gap: 10px;
  height: 252px;
  left: 51px;
  position: absolute;
  top: 155px;
  width: 662px;
}

.sectionu47featuresu47multiu4778 .text0-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span0-54bmXF {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text1-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span1-mMoybj {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text2-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span2-F96oLP {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text3-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span3-g6blcS {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text4-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span4-sKVdlr {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text5-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span5-VYf4ms {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .hero-f4Pf72 {
  background-color: transparent;
  height: 1025px;
  left: -18px;
  position: absolute;
  top: -12px;
  width: 1573px;
}

.sectionu47featuresu47multiu4778 .designer_1-FY77tv {
  background-color: transparent;
  height: 521px;
  left: 2205px;
  position: absolute;
  top: 898px;
  width: 88px;
}

.sectionu47featuresu47multiu4778 .home-f4Pf72 {
  background-color: transparent;
  color: var(--colourmainblue500);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 38px;
  line-height: 24px;
  position: absolute;
  text-align: left;
  top: 6px;
  white-space: nowrap;
  width: auto;
}

.sectionu47featuresu47multiu4778 .about-f4Pf72 {
  left: 103px;
}

.sectionu47featuresu47multiu4778 .about-Z49R6e {
  left: 206px;
}

.sectionu47featuresu47multiu4778 .about {
  background-color: transparent;
  color: var(--colourmainblue500);
  font-style: normal;
  font-weight: 400;
  height: auto;
  line-height: 24px;
  position: absolute;
  text-align: left;
  top: 6px;
  white-space: nowrap;
  width: auto;
}

.sectionu47featuresu47multiu4778 .bg {
  background-color: var(--colourmainblue800);
  border-radius: 2px;
  height: 36px;
  left: 0px;
  position: absolute;
  top: 0px;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .body {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .button-label {
  background-color: transparent;
  color: var(--coloursecondarywhite-100-general);
  font-style: normal;
  font-weight: 500;
  height: auto;
  left: 0px;
  line-height: 26px;
  position: absolute;
  text-align: center;
  top: 5px;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled {
  background-color: transparent;
  height: 36px;
  position: absolute;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .group-3 {
  background-color: transparent;
  left: 0px;
  position: absolute;
  width: 5px;
}

.sectionu47featuresu47multiu4778 .group-6 {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .group-7 {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .oval {
  background-color: transparent;
  height: 21px;
  position: absolute;
  width: 21px;
}

.sectionu47featuresu47multiu4778 .title {
  background-color: transparent;
  color: var(--colourmainblue900);
  font-style: normal;
  font-weight: 500;
  height: auto;
  position: absolute;
}

<html><head><meta charset="utf-8"><meta name="viewport" content="width=1440, maximum-scale=1.0"><link rel="shortcut icon" type="image/png" href="https://animaproject.s3.amazonaws.com/home/favicon.png"><meta name="og:type" content="website"><meta name="twitter:card" content="photo"><script id="anima-hotspots-script" src="hotspots.js"></script><script id="anima-overrides-script" src="overrides.js"></script><script src="https://animaapp.s3.amazonaws.com/js/timeline.js"></script><style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");

@import url("https://fonts.googleapis.com/css?family=Roboto:500,400");

/* The following line is used to measure usage of this code. You can remove it if you want. */
@import url("https://px.animaapp.com/654924bc6a10cb7e214665eb.654924c16a10cb7e214665ee.u120ISO.hch.png");


.screen textarea:focus,
.screen input:focus {
  outline: none;
}

.screen * {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

.screen div {
  -webkit-text-size-adjust: none;
}

.component-wrapper a {
  display: contents;
  pointer-events: auto;
  text-decoration: none;
}

.component-wrapper * {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
  pointer-events: none;
}

.component-wrapper a *,
.component-wrapper input,
.component-wrapper video,
.component-wrapper iframe {
  pointer-events: auto;
}

.component-wrapper.not-ready,
.component-wrapper.not-ready * {
  visibility: hidden !important;
}

.screen a {
  display: contents;
  text-decoration: none;
}

.full-width-a {
  width: 100%;
}

.full-height-a {
  height: 100%;
}

.container-center-vertical {
  align-items: center;
  display: flex;
  flex-direction: row;
  height: 100%;
  pointer-events: none;
}

.container-center-vertical > * {
  flex-shrink: 0;
  pointer-events: auto;
}

.container-center-horizontal {
  display: flex;
  flex-direction: row;
  justify-content: center;
  pointer-events: none;
  width: 100%;
}

.container-center-horizontal > * {
  flex-shrink: 0;
  pointer-events: auto;
}

.auto-animated div {
  --z-index: -1;
  opacity: 0;
  position: absolute;
}

.auto-animated input {
  --z-index: -1;
  opacity: 0;
  position: absolute;
}

.auto-animated .container-center-vertical,
.auto-animated .container-center-horizontal {
  opacity: 1;
}

.overlay-base {
  display: none;
  height: 100%;
  opacity: 0;
  position: fixed;
  top: 0;
  width: 100%;
}

.overlay-base.animate-appear {
  align-items: center;
  animation: reveal 0.3s ease-in-out 1 normal forwards;
  display: flex;
  flex-direction: column;
  justify-content: center;
  opacity: 0;
}

.overlay-base.animate-disappear {
  animation: reveal 0.3s ease-in-out 1 reverse forwards;
  display: block;
  opacity: 1;
  pointer-events: none;
}

.overlay-base.animate-disappear * {
  pointer-events: none;
}

@keyframes reveal {
  from { opacity: 0 }
 to { opacity: 1 }
}

.animate-nodelay {
  animation-delay: 0s;
}

.align-self-flex-start {
  align-self: flex-start;
}

.align-self-flex-end {
  align-self: flex-end;
}

.align-self-flex-center {
  align-self: flex-center;
}

.valign-text-middle {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.valign-text-bottom {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
}

input:focus {
  outline: none;
}

.listeners-active,
.listeners-active * {
  pointer-events: auto;
}

.hidden,
.hidden * {
  pointer-events: none;
  visibility: hidden;
}

.smart-layers-pointers,
.smart-layers-pointers * {
  pointer-events: auto;
  visibility: visible;
}

.listeners-active-click,
.listeners-active-click * {
  cursor: pointer;
}

* {
  box-sizing: border-box;
}
:root { 
  --black: #000000;
  --colourbackground-light-grey: #fbfbfd;
  --colourmainblue400: #6f7cb2;
  --colourmainblue500: #505f98;
  --colourmainblue800: #111b47;
  --colourmainblue900: #091133;
  --colourmaingrey600: #5d6970;
  --coloursecondarywhite-100-general: #ffffff;
 
  --font-size-l: 14px;
  --font-size-m: 12px;
  --font-size-xl: 16px;
  --font-size-xxl: 36px;
 
  --font-family-roboto: "Roboto", Helvetica;
}
.medium-16 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xl);
  font-style: normal;
  font-weight: 500;
  letter-spacing: 0px;
}

.regular-12 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-m);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.regular-16 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xl);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.regular-14 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-l);
  font-style: normal;
  font-weight: 400;
  letter-spacing: 0px;
}

.medium-36 {
  font-family: var(--font-family-roboto);
  font-size: var(--font-size-xxl);
  font-style: normal;
  font-weight: 500;
  letter-spacing: 0px;
}

:root {
}


/* screen - sectionu47featuresu47multiu4778 */

.sectionu47featuresu47multiu4778 {
  background-color: var(--colourbackground-light-grey);
  height: 909px;
  overflow: hidden;
  overflow-x: hidden;
  position: relative;
  width: 1440px;
}

.sectionu47featuresu47multiu4778 .element-card-info-ca-f4Pf72 {
  background-color: transparent;
  height: 138px;
  left: 51px;
  position: absolute;
  top: 421px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .body-waWlHy {
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 0px;
  line-height: 18px;
  text-align: center;
  top: 81px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .title-waWlHy {
  left: 0px;
  line-height: 26px;
  text-align: left;
  top: 49px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .body-f4Pf72 {
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 242px;
  line-height: 18px;
  text-align: center;
  top: 698px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .flex-container-0155-f4Pf72 {
  align-items: flex-start;
  background-color: transparent;
  display: flex;
  flex-direction: column;
  gap: 4px;
  height: 112px;
  left: 403px;
  position: absolute;
  top: 500px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .text0-0155-cVuXNM {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  line-height: 18px;
  position: relative;
  text-align: center;
}

.sectionu47featuresu47multiu4778 .span0-Zx3zwe {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text1-0155-cVuXNM {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmaingrey600);
  font-style: normal;
  font-weight: 400;
  line-height: 18px;
  position: relative;
  text-align: center;
}

.sectionu47featuresu47multiu4778 .span1-7a1jcc {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .title-f4Pf72 {
  left: 382px;
  line-height: 26px;
  text-align: left;
  top: 499px;
  width: 245px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-f4Pf72 {
  left: 105px;
  top: 454px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-Z49R6e {
  left: 450px;
  top: 447px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled-XxXuiw {
  left: 296px;
  top: 647px;
}

.sectionu47featuresu47multiu4778 .text-block-section-l-f4Pf72 {
  background-color: transparent;
  height: 90px;
  left: 156px;
  position: absolute;
  top: 91px;
  width: 520px;
}

.sectionu47featuresu47multiu4778 .title-VVClgd {
  left: 0px;
  line-height: 48px;
  text-align: center;
  top: -1px;
  width: 520px;
}

.sectionu47featuresu47multiu4778 .devices-samsung-vert-f4Pf72 {
  background-color: transparent;
  height: 1031px;
  left: 783px;
  position: absolute;
  top: 100px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .samsung-9tSitW {
  background-color: transparent;
  height: 1031px;
  left: 0px;
  position: relative;
  top: 0px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .body-12Jxfx {
  height: 1031px;
  left: 0px;
  top: 0px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .layer-0-CM1osj {
  background-color: transparent;
  height: 809px;
  left: 3px;
  position: absolute;
  top: 0px;
  width: 486px;
}

.sectionu47featuresu47multiu4778 .buttons-CM1osj {
  background-color: transparent;
  height: 262px;
  left: 0px;
  position: absolute;
  top: 172px;
  width: 492px;
}

.sectionu47featuresu47multiu4778 .group-3-oaMxnx {
  height: 130px;
  top: 6px;
}

.sectionu47featuresu47multiu4778 .group-3-0cAmWi {
  height: 66px;
  top: 197px;
}

.sectionu47featuresu47multiu4778 .group-3-copy-oaMxnx {
  background-color: transparent;
  height: 66px;
  left: 487px;
  position: absolute;
  top: 0px;
  width: 5px;
}

.sectionu47featuresu47multiu4778 .layer-1-CM1osj {
  background-color: #020000;
  border: 2px solid;
  border-color: #e7e7e7;
  border-radius: 62px 62px 67.5px 67.5px;
  box-shadow: 0px 2px 0px #0000003e , 0px -2px 0px #0000003e;
  height: 1019px;
  left: 4px;
  position: absolute;
  top: 6px;
  width: 483px;
}

.sectionu47featuresu47multiu4778 .rectangle-CM1osj {
  background-color: #00000030;
  height: 10px;
  left: 406px;
  position: absolute;
  top: 1022px;
  width: 11px;
}

.sectionu47featuresu47multiu4778 .rectangle-copy-2-CM1osj {
  background-color: #00000030;
  height: 10px;
  left: 74px;
  position: absolute;
  top: 1022px;
  width: 11px;
}

.sectionu47featuresu47multiu4778 .screen-12Jxfx {
  background-color: transparent;
  height: 787px;
  left: 12px;
  position: absolute;
  top: 22px;
  width: 468px;
}

.sectionu47featuresu47multiu4778 .reflections-12Jxfx {
  background-color: transparent;
  height: 799px;
  left: 12px;
  position: absolute;
  top: 10px;
  width: 468px;
}

.sectionu47featuresu47multiu4778 .camera-12Jxfx {
  background-color: transparent;
  height: 34px;
  left: 372px;
  position: absolute;
  top: 36px;
  width: 80px;
}

.sectionu47featuresu47multiu4778 .rectangle-xm2s6v {
  background-color: var(--black);
  border-radius: 26.5px;
  height: 36px;
  left: -1px;
  position: absolute;
  top: -1px;
  width: 82px;
}

.sectionu47featuresu47multiu4778 .group-xm2s6v {
  background-color: transparent;
  height: 23px;
  left: 7px;
  position: absolute;
  top: 6px;
  width: 68px;
}

.sectionu47featuresu47multiu4778 .group-7-3zPRF9 {
  height: 21px;
  left: 0px;
  top: 1px;
  width: 21px;
}

.sectionu47featuresu47multiu4778 .oval-w0ZXV9 {
  left: 0px;
  top: 0px;
}

.sectionu47featuresu47multiu4778 .group-6-w0ZXV9 {
  height: 16px;
  left: 2px;
  top: 3px;
  width: 16px;
}

.sectionu47featuresu47multiu4778 .group-7-PCdqvc {
  height: 23px;
  left: 45px;
  top: 0px;
  width: 23px;
}

.sectionu47featuresu47multiu4778 .oval-Mt56cv {
  left: 1px;
  top: 1px;
}

.sectionu47featuresu47multiu4778 .group-6-Mt56cv {
  height: 23px;
  left: 0px;
  top: 0px;
  width: 23px;
}

.sectionu47featuresu47multiu4778 .flex-container-0168-f4Pf72 {
  align-items: flex-start;
  background-color: transparent;
  display: flex;
  flex-direction: column;
  gap: 10px;
  height: 252px;
  left: 51px;
  position: absolute;
  top: 155px;
  width: 662px;
}

.sectionu47featuresu47multiu4778 .text0-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span0-54bmXF {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text1-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span1-mMoybj {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text2-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span2-F96oLP {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text3-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span3-g6blcS {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text4-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span4-sKVdlr {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .text5-0168-73mCUD {
  align-self: stretch;
  background-color: transparent;
  color: var(--colourmainblue400);
  font-style: normal;
  font-weight: 400;
  line-height: 26px;
  position: relative;
  text-align: left;
}

.sectionu47featuresu47multiu4778 .span5-VYf4ms {
  font-style: normal;
}

.sectionu47featuresu47multiu4778 .hero-f4Pf72 {
  background-color: transparent;
  height: 1025px;
  left: -18px;
  position: absolute;
  top: -12px;
  width: 1573px;
}

.sectionu47featuresu47multiu4778 .designer_1-FY77tv {
  background-color: transparent;
  height: 521px;
  left: 2205px;
  position: absolute;
  top: 898px;
  width: 88px;
}

.sectionu47featuresu47multiu4778 .home-f4Pf72 {
  background-color: transparent;
  color: var(--colourmainblue500);
  font-style: normal;
  font-weight: 400;
  height: auto;
  left: 38px;
  line-height: 24px;
  position: absolute;
  text-align: left;
  top: 6px;
  white-space: nowrap;
  width: auto;
}

.sectionu47featuresu47multiu4778 .about-f4Pf72 {
  left: 103px;
}

.sectionu47featuresu47multiu4778 .about-Z49R6e {
  left: 206px;
}

.sectionu47featuresu47multiu4778 .about {
  background-color: transparent;
  color: var(--colourmainblue500);
  font-style: normal;
  font-weight: 400;
  height: auto;
  line-height: 24px;
  position: absolute;
  text-align: left;
  top: 6px;
  white-space: nowrap;
  width: auto;
}

.sectionu47featuresu47multiu4778 .bg {
  background-color: var(--colourmainblue800);
  border-radius: 2px;
  height: 36px;
  left: 0px;
  position: absolute;
  top: 0px;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .body {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .button-label {
  background-color: transparent;
  color: var(--coloursecondarywhite-100-general);
  font-style: normal;
  font-weight: 500;
  height: auto;
  left: 0px;
  line-height: 26px;
  position: absolute;
  text-align: center;
  top: 5px;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .element-button-large-filled {
  background-color: transparent;
  height: 36px;
  position: absolute;
  width: 137px;
}

.sectionu47featuresu47multiu4778 .group-3 {
  background-color: transparent;
  left: 0px;
  position: absolute;
  width: 5px;
}

.sectionu47featuresu47multiu4778 .group-6 {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .group-7 {
  background-color: transparent;
  position: absolute;
}

.sectionu47featuresu47multiu4778 .oval {
  background-color: transparent;
  height: 21px;
  position: absolute;
  width: 21px;
}

.sectionu47featuresu47multiu4778 .title {
  background-color: transparent;
  color: var(--colourmainblue900);
  font-style: normal;
  font-weight: 500;
  height: auto;
  position: absolute;
}

</style>
</head>
<body style="margin: 0;background: #fbfbfd;">
  <input type="hidden" id="anPageName" name="page" value="sectionu47featuresu47multiu4778">
  <div class="container-center-horizontal">
    <div class="sectionu47featuresu47multiu4778 screen " data-id="0:152">
      <div class="element-card-info-ca-f4Pf72" data-id="0:153">
        <p class="body-waWlHy body regular-12" data-id="I0:153;0:5272">Enabling this mode will let the device communicate with MeteoSuisse and its sensors. It will assure that no ice can form on the road by activating the spraying when a dangerous situation is sensed.</p>
        <div class="title-waWlHy title medium-16" data-id="I0:153;0:5273"></div>
      </div>
      <p class="body-f4Pf72 body regular-12" data-id="0:154">Enabling this mode will let you schedule the use of the device. This link will forward you to a new page where the settings need to be set and the mode activated.</p>
      <div class="flex-container-0155-f4Pf72" data-id="0:155-container">
        <div class="text1-0155-cVuXNM regular-12" data-id="0:155-text1">
          <span class="span1-7a1jcc regular-12">Enabling this mode will spray immediately the deicing solution. The previous mode is use will be disabled. Please assure you that no one is currently in the spraying range and do not forget to enable a mode after the spraying.</span>
        </div>
      </div>
      <div class="title-f4Pf72 title medium-16" data-id="0:156"></div>
      <div class="element-button-large-filled-f4Pf72 element-button-large-filled" data-id="0:157">
        <div class="bg" data-id="0:158"></div>
        <div class="button-label medium-16" data-id="0:159">AUTOMATIC</div>
      </div>
      <div class="element-button-large-filled-Z49R6e element-button-large-filled" data-id="0:160">
        <div class="bg" data-id="0:161"></div>
        <div class="button-label medium-16" data-id="0:162">SPRAY NOW</div>
      </div>
      <div class="element-button-large-filled-XxXuiw element-button-large-filled" data-id="0:163">
        <div class="bg" data-id="0:164"></div>
        <div class="button-label medium-16" data-id="0:165">SCHEDULED</div>
      </div>
      <div class="text-block-section-l-f4Pf72" data-id="0:166">
        <h1 class="title-VVClgd title medium-36" data-id="I0:166;0:5167">My ThawPal</h1>
      </div>
      <div class="devices-samsung-vert-f4Pf72" data-id="0:167">
        
      </div>
      <div class="flex-container-0168-f4Pf72" data-id="0:168-container">
        <div class="text0-0168-73mCUD regular-16" data-id="0:168-text0">
          <span class="span0-54bmXF regular-16">Pressure: NO PROBLEMS<br></span>
        </div>
        <div class="text1-0168-73mCUD regular-16" data-id="0:168-text1">
          <span class="span1-mMoybj regular-16">Water Tank: FULL<br></span>
        </div>
        <div class="text1-0168-73mCUD regular-16" data-id="0:168-text1">
          <span class="span1-mMoybj regular-16">Solution: 23%<br></span>
        </div>
        <div class="text2-0168-73mCUD regular-16" data-id="0:168-text2">
          <span class="span2-F96oLP regular-16">Salt Tank: FULL<br></span>
        </div>
        <div class="text3-0168-73mCUD regular-16" data-id="0:168-text3">
          <span class="span3-g6blcS regular-16">In work: NO<br></span>
        </div>
        <div class="text4-0168-73mCUD regular-16" data-id="0:168-text4">
          <span class="span4-sKVdlr regular-16">Next Use: 2AM Wednesday<br></span>
        </div>
        <div class="text5-0168-73mCUD regular-16" data-id="0:168-text5">
          <span class="span5-VYf4ms regular-16">Current mode: AUTOMATIC</span>
        </div>
      </div>
      <div class="hero-f4Pf72" data-id="0:169">
        <img class="designer_1-FY77tv" data-id="0:171" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" anima-src="https://cdn.animaapp.com/projects/654924c26a10cb7e214665f0/releases/654a12d38d4d8db56459af71/img/path-3.png" alt="designer_1">
      </div>
      <div class="home-f4Pf72 regular-14" data-id="0:214">Home</div>
      <div class="about-f4Pf72 about regular-14" data-id="0:215">My Thawpal</div>
      <div class="about-Z49R6e about regular-14" data-id="0:216">Free Quote</div>
    </div>
  </div>
  <script src="launchpad-js/launchpad-banner.js" async></script>
  <script defer src="https://animaapp.s3.amazonaws.com/static/restart-btn.min.js"></script>
</body>
</html>