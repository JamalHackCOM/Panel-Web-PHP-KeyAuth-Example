<?php

require '../KeyAuth.php';

if (isset($_SESSION['user_data'])) 
{
	  header("Location: dashboard/");
    exit();
}

$name = ""; // Application name
$ownerid = ""; // Application ownerID
$KeyAuthApp = new KeyAuth\api($name, $ownerid);

if (!isset($_SESSION['sessionid'])) 
{
  	$KeyAuthApp->init();
}
//echo $_SESSION['sessionid']; //Will print current sessionid, that you can make request manually with like postman
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Register | MrGarabato</title>
<link rel="shortcut icon" href="/img/logo0020.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<style>

    @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap');
@-webkit-keyframes autofill {
    0%,
    100% {
        color: #666;
        background: transparent;
    }
}

input:-webkit-autofill {
    -webkit-animation-delay: 1s;
    /* Safari support - any positive time runs instantly */
    -webkit-animation-name: autofill;
    -webkit-animation-fill-mode: both;
}

body,
button,
html,
input,
p {
    font-family: "Titillium Web", sans-serif;
}

#page {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 1;
    box-sizing: border-box;
}

#page>div {
    height: 100%;
    position: relative;
    width: 100%;
    overflow-y: auto;
    box-sizing: border-box;
}

.jss1 .hangarOutlinedInput-root .hangarInputAdornment-root .hangarSvgIcon-root {
    fill: #3e4168;
}


/****************************************************************
*   Hangar UI
****************************************************************/

body {
    background-image: url("/img/r33.png");
    background-color: rgba(255,255,255,0.13);
}

.hangar-auth {
    background-color: #000;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: rgb(0 0 0 / 50%);
    transform: translate(0%,0%);
    top: 0%;
    left: 0%;
    border-radius: 0px;
    backdrop-filter: blur(7px);
    box-shadow: 0 0 40px rgb(8 7 16 / 60%);
    height: 100%;
    display: flex;
    -webkit-box-pack: center;
    flex-wrap: wrap;
    overflow-y: auto;
    box-sizing: border-box;
    justify-content: center;
    align-items: center;
}


.hangar-form {
    max-width: 460px;
    width: 100%;
    position: relative;
    background: #141525;
    padding: 25px;
    box-sizing: border-box;
    margin: 0;
    border-radius: 12px;
    align-items: center;
    text-align: center;
}

.hangar-fieldset {
    border: 0;
    outline: 0;
    padding: 0;
    margin: 0;
}

.hangar-ui-svg {
    fill: currentColor;
    width: 1em;
    height: 1em;
    display: inline-block;
    font-size: 1.5rem;
    transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    flex-shrink: 0;
    user-select: none;
}

.go_back {
    position: absolute;
    color: #363872;
    left: 8px;
    top: 6px;
    transition: color .5s ease;
}

.go_signup {
    position: absolute;
    color: #363872;
    right: 15px;
    top: 10px;
    transition: color .5s ease;
}

.hangar-logo {
    height: 100px;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.hangar-auth_title {
    font-size: 28px;
    color: #858ab7;
    vertical-align: middle;
    margin-bottom: 16px;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.hangarFormControl-root {
    border: 0;
    margin: 0;
    display: inline-flex;
    padding: 0;
    position: relative;
    min-width: 0;
    flex-direction: column;
    vertical-align: top;
}

.hangarButtonBase-root {
    color: ;
    border: 0;
    cursor: pointer;
    margin: 0;
    display: inline-flex;
    outline: 0;
    padding: 0;
    position: relative;
    box-sizing: border-box;
    align-items: center;
    user-select: none;
    border-radius: 0;
    vertical-align: middle;
    -moz-appearance: none;
    justify-content: center;
    text-decoration: none;
    background-color: transparent;
    -webkit-appearance: none;
    -webkit-tap-highlight-color: transparent;
}

.hangarButtonBase-root::-moz-focus-inner {
    border-style: none;
}

.hangarButtonBase-root.hangar-disabled {
    cursor: default;
    pointer-events: none;
}

@media print {
    .hangarButtonBase-root {
        -webkit-print-color-adjust: exact;
    }
}

.hangarSvgIcon-root {
    fill: currentColor;
    width: 1em;
    height: 1em;
    display: inline-block;
    font-size: 1.5rem;
    transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    flex-shrink: 0;
    user-select: none;
}

.hangarSvgIcon-colorPrimary {
    color: #3f51b5;
}

.hangarSvgIcon-colorSecondary {
    color: #f50057;
}

.hangarSvgIcon-colorAction {
    color: rgba(0, 0, 0, 0.54);
}

.hangarSvgIcon-colorError {
    color: #f44336;
}

.hangarSvgIcon-colorDisabled {
    color: rgba(0, 0, 0, 0.26);
}

.hangarSvgIcon-fontSizeInherit {
    font-size: inherit;
}

.hangarSvgIcon-fontSizeSmall {
    font-size: 1.25rem;
}

.hangarSvgIcon-fontSizeLarge {
    font-size: 2.1875rem;
}

.hangarButton-root {
    padding: 6px 16px;
    font-size: 0.875rem;
    min-width: 64px;
    transition: background-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, border-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
    font-family: 'Titillium Web', sans-serif;
    font-weight: 500;
    line-height: 1.75;
    border-radius: 4px;
    text-transform: uppercase;
}

.hangarButton-root:hover {
    text-decoration: none;
    background-color: blue;
}

.hangarButton-root.hangar-disabled {
    color: rgba(0, 0, 0, 0.26);
}

@media (hover: none) {
    .hangarButton-root:hover {
        background-color: transparent;
    }
}

.hangarButton-label {
    width: 100%;
    display: inherit;
    align-items: inherit;
    justify-content: inherit;
}

.hangarButton-text {
    padding: 6px 8px;
}

.hangarButton-textPrimary {
    color: #3f51b5;
}

.hangarButton-textPrimary:hover {
    background-color: rgba(63, 81, 181, 0.04);
}

@media (hover: none) {
    .hangarButton-textPrimary:hover {
        background-color: transparent;
    }
}

.hangarButton-textSecondary {
    color: #f50057;
}

.hangarButton-textSecondary:hover {
    background-color: rgba(245, 0, 87, 0.04);
}

@media (hover: none) {
    .hangarButton-textSecondary:hover {
        background-color: transparent;
    }
}

.hangarButton-outlined {
    border: 1px solid rgba(0, 0, 0, 0.23);
    padding: 5px 15px;
}

.hangarButton-outlined.hangar-disabled {
    border: 1px solid rgba(0, 0, 0, 0.12);
}

.hangarButton-outlinedPrimary {
    color: #3f51b5;
    border: 1px solid rgba(63, 81, 181, 0.5);
}

.hangarButton-outlinedPrimary:hover {
    border: 1px solid #3f51b5;
    background-color: rgba(63, 81, 181, 0.04);
}

@media (hover: none) {
    .hangarButton-outlinedPrimary:hover {
        background-color: transparent;
    }
}

.hangarButton-outlinedSecondary {
    color: #f50057;
    border: 1px solid rgba(245, 0, 87, 0.5);
}

.hangarButton-outlinedSecondary:hover {
    border: 1px solid #f50057;
    background-color: rgba(245, 0, 87, 0.04);
}

.hangarButton-outlinedSecondary.hangar-disabled {
    border: 1px solid rgba(0, 0, 0, 0.26);
}

@media (hover: none) {
    .hangarButton-outlinedSecondary:hover {
        background-color: transparent;
    }
}

.hangarButton-contained {
    color: rgba(0, 0, 0, 0.87);
    box-shadow: 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
    background-color: #e0e0e0;
}

.hangarButton-contained:hover {
    box-shadow: 0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12);
    background-color: #d5d5d5;
}

.hangarButton-contained.hangar-focusVisible {
    box-shadow: 0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 6px 10px 0px rgba(0, 0, 0, 0.14), 0px 1px 18px 0px rgba(0, 0, 0, 0.12);
}

.hangarButton-contained:active {
    box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);
}

.hangarButton-contained.hangar-disabled {
    color: rgba(0, 0, 0, 0.26);
    box-shadow: none;
    background-color: rgba(0, 0, 0, 0.12);
}

@media (hover: none) {
    .hangarButton-contained:hover {
        box-shadow: 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
        background-color: #e0e0e0;
    }
}

.hangarButton-containedPrimary {
    color: #fff;
    background-color: #3f51b5;
}

.hangarButton-containedPrimary:hover {
    background-color: #303f9f;
}

@media (hover: none) {
    .hangarButton-containedPrimary:hover {
        background-color: #3f51b5;
    }
}

.hangarButton-containedSecondary {
    color: #fff;
    background-color: #f50057;
}

.hangarButton-containedSecondary:hover {
    background-color: #c51162;
}

@media (hover: none) {
    .hangarButton-containedSecondary:hover {
        background-color: #f50057;
    }
}

.hangarButton-disableElevation {
    box-shadow: none;
}

.hangarButton-disableElevation:hover {
    box-shadow: none;
}

.hangarButton-disableElevation.hangar-focusVisible {
    box-shadow: none;
}

.hangarButton-disableElevation:active {
    box-shadow: none;
}

.hangarButton-disableElevation.hangar-disabled {
    box-shadow: none;
}

.hangarButton-colorInherit {
    color: inherit;
    border-color: currentColor;
}

.hangarButton-textSizeSmall {
    padding: 4px 5px;
    font-size: 0.8125rem;
}

.hangarButton-textSizeLarge {
    padding: 8px 11px;
    font-size: 0.9375rem;
}

.hangarButton-outlinedSizeSmall {
    padding: 3px 9px;
    font-size: 0.8125rem;
}

.hangarButton-outlinedSizeLarge {
    padding: 7px 21px;
    font-size: 0.9375rem;
}

.hangarButton-containedSizeSmall {
    padding: 4px 10px;
    font-size: 0.8125rem;
}

.hangarButton-containedSizeLarge {
    padding: 8px 22px;
    font-size: 0.9375rem;
}

.hangarButton-fullWidth {
    width: 100%;
}

.hangarButton-startIcon {
    display: inherit;
    margin-left: -4px;
    margin-right: 8px;
}

.hangarButton-startIcon.hangarButton-iconSizeSmall {
    margin-left: -2px;
}

.hangarButton-endIcon {
    display: inherit;
    margin-left: 8px;
    margin-right: -4px;
}

.hangarButton-endIcon.hangarButton-iconSizeSmall {
    margin-right: -2px;
}

.hangarButton-iconSizeSmall>*:first-child {
    font-size: 18px;
}

.hangarButton-iconSizeMedium>*:first-child {
    font-size: 20px;
}

.hangarButton-iconSizeLarge>*:first-child {
    font-size: 22px;
}

.hangarFormLabel-root {
    color: rgba(0, 0, 0, 0.54);
    padding: 0;
    font-size: 1rem;
    font-family: 'Titillium Web', sans-serif;
    font-weight: 400;
    line-height: 1;
}

.hangarFormLabel-root.hangar-focused {
    color: #3f51b5;
}

.hangarFormLabel-root.hangar-disabled {
    color: rgba(0, 0, 0, 0.38);
}

.hangarFormLabel-root.hangar-error {
    color: #f44336;
}

.hangarFormLabel-colorSecondary.hangar-focused {
    color: #f50057;
}

.hangarFormLabel-asterisk.hangar-error {
    color: #f44336;
}

.hangarInputLabel-root {
    display: block;
    transform-origin: top left;
}

.hangarInputLabel-formControl {
    top: 0;
    left: 0;
    position: absolute;
    transform: translate(0, 24px) scale(1);
}

.hangarInputLabel-marginDense {
    transform: translate(0, 21px) scale(1);
}

.hangarInputLabel-shrink {
    transform: translate(0, 1.5px) scale(0.75);
    transform-origin: top left;
}

.hangarInputLabel-animated {
    transition: color 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms, transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
}

.hangarInputLabel-filled {
    z-index: 1;
    transform: translate(12px, 20px) scale(1);
    pointer-events: none;
}

.hangarInputLabel-filled.hangarInputLabel-marginDense {
    transform: translate(12px, 17px) scale(1);
}

.hangarInputLabel-filled.hangarInputLabel-shrink {
    transform: translate(12px, 10px) scale(0.75);
}

.hangarInputLabel-filled.hangarInputLabel-shrink.hangarInputLabel-marginDense {
    transform: translate(12px, 7px) scale(0.75);
}

.hangarInputLabel-outlined {
    z-index: 1;
    transform: translate(14px, 20px) scale(1);
    pointer-events: none;
}

.hangarInputLabel-outlined.hangarInputLabel-marginDense {
    transform: translate(14px, 12px) scale(1);
}

.hangarInputLabel-outlined.hangarInputLabel-shrink {
    transform: translate(14px, -6px) scale(0.75);
}

@-webkit-keyframes hangar-auto-fill {}

@-webkit-keyframes hangar-auto-fill-cancel {}

.hangarInputBase-root {
    color: rgba(0, 0, 0, 0.87);
    cursor: text;
    display: inline-flex;
    position: relative;
    font-size: 1rem;
    box-sizing: border-box;
    align-items: center;
    font-family: 'Titillium Web', sans-serif;
    font-weight: 400;
    line-height: 1.4375em;
}

.hangarInputBase-root.hangar-disabled {
    color: rgba(0, 0, 0, 0.38);
    cursor: default;
}

.hangarInputBase-multiline {
    padding: 4px 0 5px;
}

.hangarInputBase-multiline.hangarInputBase-marginDense {
    padding-top: 1px;
}

.hangarInputBase-fullWidth {
    width: 100%;
}

.hangarInputBase-input {
    font: inherit;
    color: currentColor;
    width: 100%;
    border: 0;
    height: 1.4375em;
    margin: 0;
    display: block;
    padding: 4px 0 5px;
    min-width: 0;
    background: none;
    box-sizing: content-box;
    animation-name: hangar-auto-fill-cancel;
    letter-spacing: inherit;
    animation-duration: 10ms;
    -webkit-tap-highlight-color: transparent;
}

.hangarInputBase-input::-webkit-input-placeholder {
    color: currentColor;
    opacity: 0.42;
    transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}

.hangarInputBase-input::-moz-placeholder {
    color: currentColor;
    opacity: 0.42;
    transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}

.hangarInputBase-input:-ms-input-placeholder {
    color: currentColor;
    opacity: 0.42;
    transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}

.hangarInputBase-input::-ms-input-placeholder {
    color: currentColor;
    opacity: 0.42;
    transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}

.hangarInputBase-input:focus {
    outline: 0;
}

.hangarInputBase-input:invalid {
    box-shadow: none;
}

.hangarInputBase-input::-webkit-search-decoration {
    -webkit-appearance: none;
}

.hangarInputBase-input.hangar-disabled {
    opacity: 1;
}

.hangarInputBase-input:-webkit-autofill {
    animation-name: hangar-auto-fill;
    animation-duration: 5000s;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input::-webkit-input-placeholder {
    opacity: 0 !important;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input::-moz-placeholder {
    opacity: 0 !important;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input:-ms-input-placeholder {
    opacity: 0 !important;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input::-ms-input-placeholder {
    opacity: 0 !important;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input:focus::-webkit-input-placeholder {
    opacity: 0.42;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input:focus::-moz-placeholder {
    opacity: 0.42;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input:focus:-ms-input-placeholder {
    opacity: 0.42;
}

label[data-shrink=false]+.hangarInputBase-formControl .hangarInputBase-input:focus::-ms-input-placeholder {
    opacity: 0.42;
}

.hangarInputBase-inputMarginDense {
    padding-top: 1px;
}

.hangarInputBase-inputMultiline {
    height: auto;
    resize: none;
    padding: 0;
}

.hangarInputBase-inputTypeSearch {
    -moz-appearance: textfield;
    -webkit-appearance: textfield;
}

.jss2 {
    top: -5px;
    left: 0;
    right: 0;
    bottom: 0;
    margin: 0;
    padding: 0 8px;
    overflow: hidden;
    position: absolute;
    text-align: left;
    border-style: solid;
    border-width: 1px;
    border-radius: inherit;
    pointer-events: none;
}

.jss3 {
    padding: 0;
    transition: width 150ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
    line-height: 11px;
}

.jss4 {
    width: auto;
    height: 11px;
    display: block;
    padding: 0;
    font-size: 0.75em;
    max-width: 0.01px;
    transition: max-width 50ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
    visibility: hidden;
}

.jss4>span {
    display: inline-block;
    padding-left: 5px;
    padding-right: 5px;
}

.jss5 {
    max-width: 1000px;
    transition: max-width 100ms cubic-bezier(0.0, 0, 0.2, 1) 50ms;
}

.hangarOutlinedInput-root {
    position: relative;
    border-radius: 4px;
}

.hangarOutlinedInput-root:hover .hangarOutlinedInput-notchedOutline {
    border-color: rgba(0, 0, 0, 0.87);
}

@media (hover: none) {
    .hangarOutlinedInput-root:hover .hangarOutlinedInput-notchedOutline {
        border-color: rgba(0, 0, 0, 0.23);
    }
}

.hangarOutlinedInput-root.hangar-focused .hangarOutlinedInput-notchedOutline {
    border-color: #3f51b5;
    border-width: 2px;
}

.hangarOutlinedInput-root.hangar-error .hangarOutlinedInput-notchedOutline {
    border-color: #f44336;
}

.hangarOutlinedInput-root.hangar-disabled .hangarOutlinedInput-notchedOutline {
    border-color: rgba(0, 0, 0, 0.26);
}

.hangarOutlinedInput-colorSecondary.hangar-focused .hangarOutlinedInput-notchedOutline {
    border-color: #f50057;
}

.hangarOutlinedInput-adornedStart {
    padding-left: 14px;
}

.hangarOutlinedInput-adornedEnd {
    padding-right: 14px;
}

.hangarOutlinedInput-multiline {
    padding: 16.5px 14px;
}

.hangarOutlinedInput-multiline.hangarOutlinedInput-marginDense {
    padding-top: 10.5px;
    padding-bottom: 10.5px;
}

.hangarOutlinedInput-notchedOutline {
    border-color: rgba(0, 0, 0, 0.23);
}

.hangarOutlinedInput-input {
    padding: 16.5px 14px;
}

.hangarOutlinedInput-input:-webkit-autofill {
    border-radius: inherit;
}

.hangarOutlinedInput-inputMarginDense {
    padding-top: 8.5px;
    padding-bottom: 8.5px;
}

.hangarOutlinedInput-inputMultiline {
    padding: 0;
}

.hangarOutlinedInput-inputAdornedStart {
    padding-left: 0;
}

.hangarOutlinedInput-inputAdornedEnd {
    padding-right: 0;
}

.hangarFormControl-root {
    border: 0;
    margin: 0;
    display: inline-flex;
    padding: 0;
    position: relative;
    min-width: 0;
    flex-direction: column;
    vertical-align: top;
}

.hangarFormControl-marginNormal {
    margin-top: 16px;
    margin-bottom: 8px;
}

.hangarFormControl-marginDense {
    margin-top: 8px;
    margin-bottom: 4px;
}

.hangarFormControl-fullWidth {
    width: 100%;
}

.hangarInputAdornment-root {
    height: 0.01em;
    display: flex;
    max-height: 2em;
    align-items: center;
    white-space: nowrap;
}

.hangarInputAdornment-filled.hangarInputAdornment-positionStart:not(.hangarInputAdornment-hiddenLabel) {
    margin-top: 16px;
}

.hangarInputAdornment-positionStart {
    margin-right: 8px;
}

.hangarInputAdornment-positionEnd {
    margin-left: 8px;
}

.hangarInputAdornment-disablePointerEvents {
    pointer-events: none;
}

.hangarTooltip-popper {
    z-index: 1500;
    pointer-events: none;
}

.hangarTooltip-popperInteractive {
    pointer-events: auto;
}

.hangarTooltip-popperArrow[data-popper-placement*="bottom"] .hangarTooltip-arrow {
    top: 0;
    left: 0;
    margin-top: -0.71em;
}

.hangarTooltip-popperArrow[data-popper-placement*="top"] .hangarTooltip-arrow {
    left: 0;
    bottom: 0;
    margin-bottom: -0.71em;
}

.hangarTooltip-popperArrow[data-popper-placement*="right"] .hangarTooltip-arrow {
    left: 0;
    width: 0.71em;
    height: 1em;
    margin-left: -0.71em;
}

.hangarTooltip-popperArrow[data-popper-placement*="left"] .hangarTooltip-arrow {
    right: 0;
    width: 0.71em;
    height: 1em;
    margin-right: -0.71em;
}

.hangarTooltip-popperArrow[data-popper-placement*="left"] .hangarTooltip-arrow::before {
    transform-origin: 0 0;
}

.hangarTooltip-popperArrow[data-popper-placement*="right"] .hangarTooltip-arrow::before {
    transform-origin: 100% 100%;
}

.hangarTooltip-popperArrow[data-popper-placement*="top"] .hangarTooltip-arrow::before {
    transform-origin: 100% 0;
}

.hangarTooltip-popperArrow[data-popper-placement*="bottom"] .hangarTooltip-arrow::before {
    transform-origin: 0 100%;
}

.hangarTooltip-tooltip {
    color: #fff;
    padding: 4px 8px;
    font-size: 0.6875rem;
    max-width: 300px;
    word-wrap: break-word;
    font-family: 'Titillium Web', sans-serif;
    font-weight: 500;
    border-radius: 4px;
    background-color: rgba(97, 97, 97, 0.92);
}

.hangarTooltip-tooltipArrow {
    margin: 0;
    position: relative;
}

.hangarTooltip-arrow {
    color: rgba(97, 97, 97, 0.9);
    width: 1em;
    height: 0.71em;
    overflow: hidden;
    position: absolute;
    box-sizing: border-box;
}

.hangarTooltip-arrow::before {
    width: 100%;
    height: 100%;
    margin: auto;
    content: "";
    display: block;
    transform: rotate(45deg);
    background-color: currentColor;
}

.hangarTooltip-touch {
    padding: 8px 16px;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.14286em;
}

.hangarTooltip-tooltipPlacementLeft {
    margin: 0 24px;
    transform-origin: right center;
}

@media (min-width:600px) {
    .hangarTooltip-tooltipPlacementLeft {
        margin: 0 14px;
    }
}

.hangarTooltip-tooltipPlacementRight {
    margin: 0 24px;
    transform-origin: left center;
}

@media (min-width:600px) {
    .hangarTooltip-tooltipPlacementRight {
        margin: 0 14px;
    }
}

.hangarTooltip-tooltipPlacementTop {
    margin: 24px 0;
    transform-origin: center bottom;
}

@media (min-width:600px) {
    .hangarTooltip-tooltipPlacementTop {
        margin: 14px 0;
    }
}

.hangarTooltip-tooltipPlacementBottom {
    margin: 24px 0;
    transform-origin: center top;
}

@media (min-width:600px) {
    .hangarTooltip-tooltipPlacementBottom {
        margin: 14px 0;
    }
}

.hangarCircularProgress-root {
    display: inline-block;
}

.hangarCircularProgress-determinate {
    transition: transform 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}

.hangarCircularProgress-indeterminate {
    animation: hangarCircularProgress-keyframes-circular-rotate 1.4s linear infinite;
}

.hangarCircularProgress-colorPrimary {
    color: #3f51b5;
}

.hangarCircularProgress-colorSecondary {
    color: #f50057;
}

.hangarCircularProgress-svg {
    display: block;
}

.hangarCircularProgress-circle {
    stroke: currentColor;
}

.hangarCircularProgress-circleDeterminate {
    transition: stroke-dashoffset 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}

.hangarCircularProgress-circleIndeterminate {
    animation: hangarCircularProgress-keyframes-circular-dash 1.4s ease-in-out infinite;
    stroke-dasharray: 80px, 200px;
    stroke-dashoffset: 0px;
}

@-webkit-keyframes hangarCircularProgress-keyframes-circular-rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@-webkit-keyframes hangarCircularProgress-keyframes-circular-dash {
    0% {
        stroke-dasharray: 1px, 200px;
        stroke-dashoffset: 0px;
    }
    50% {
        stroke-dasharray: 100px, 200px;
        stroke-dashoffset: -15px;
    }
    100% {
        stroke-dasharray: 100px, 200px;
        stroke-dashoffset: -125px;
    }
}

.hangarCircularProgress-circleDisableShrink {
    animation: none;
}

.jss1 {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 42px;
}

.jss1 label {
    color: #3e4168;
}

.jss1 label.hangar-focused:not(.hangar-error) {
    color: #43467d;
}

.jss1 .hangarInputBase-input {
    color: #75799e;
    font-size: 18px;
}

.jss1 .hangarOutlinedInput-root {
    background: #e0e0e0;
}

.jss1 .hangarOutlinedInput-root .hangarInputAdornment-root .hangarSvgIcon-root {
    fill: #3e4168;
}

.jss1 .hangarOutlinedInput-root.hangar-error {
    background: rgb(255 66 54 / 10%);
}

.jss1 .hangarOutlinedInput-root fieldset {
    border-color: #e0e0e0;
}

.jss1 .hangarOutlinedInput-root.hangar-focused:not(.hangar-error) fieldset {
    border-color: #1f2146;
}

.jss1 .hangarOutlinedInput-root.hangar-error .hangarInputBase-input {
    color: #ff8e85;
}

.jss1 .hangarOutlinedInput-root.hangar-error .hangarInputAdornment-root .hangarSvgIcon-root {
    fill: #fb6b60;
}



.jss6:disabled {
    color: #4a4c63;
    cursor: not-allowed;
    box-shadow: none;
    border-color: #0062cc;
    background-color: #18192f;
}

.jss6:hover {
    box-shadow: 0 0 20px rgb(75 15 66), 0 0 0 0.1rem rgb(75 15 66);
    border-color: rgb(75 15 66);
    background-color: rgb(75 15 66);
}

.jss6:focus {
    box-shadow: 0 0 0 0.15rem rgb(75 15 66);
}

.jss7 {
    font-size: 17px;
    font-weight: 500;
    text-transform: uppercase;
}

.hangarFormHelperText-root {
    color: rgba(0, 0, 0, 0.54);
    margin: 0;
    font-size: 0.75rem;
    margin-top: 3px;
    text-align: left;
    font-family: 'Titillium Web', sans-serif;
    font-weight: 400;
    line-height: 1.66;
}

.hangarFormHelperText-root.hangar-error {
    color: #f44336;
}
.flex-sb-m {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: space-between;
    -ms-align-items: center;
    align-items: center;
}

.w-full {
    width: 100%;
}
.p-b-24 {
    padding-bottom: 24px;
}
.p-t-3 {
    padding-top: 3px;
}
.hangarFormHelperText-root.hangar-error {
    color: #858ab7!important;
}
a:-webkit-any-link {
    color: #dddddd;
    cursor: pointer;
    text-decoration: underline;
}
.hangar-form {
    max-width: 460px;
    width: 100%;
    position: relative;
    background: #00000050!important;
    padding: 25px;
    box-sizing: border-box;
    margin: 0;
    border-radius: 12px;
    align-items: center;
    text-align: center;
}
.jss1 .hangarInputBase-input {
    color: #e0e0e0!important;
    font-size: 18px;
}
.jss1 .hangarOutlinedInput-root {
    background: #18193100!important;
}
.jss6 {
    color: #dddddd;
    width: 100%;
    border: 0;
    cursor: pointer;
    height: 48px;
    margin: 32px 0 0 0;
    font-size: 18px;
    background: #00000000;
    box-shadow: 0 0 30px rgb(75 15 66);
    margin-top: 0;
    font-weight: 500;
    border-radius: 3px;
    margin-bottom: 16px;
}
.jss1 label {
    color: #dddddd!important;
}
.hangar-auth_title {
    font-size: 28px;
    color: #dddddd!important;
    vertical-align: middle;
    margin-bottom: 16px;
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.jss1 .hangarOutlinedInput-root fieldset {
    border-color: #5d5d61!important;
}
</style>
<body>
<div id="page">
<div class="hangar-auth">
<div class="hangar-form">
<img draggable="false" src="/img/logo0021.png" alt="Login" class="hangar-logo">
<h1 class="hangar-auth_title">
<i class="fad fa-user-plus"></i>
<span>Register</span>
</h1>
<form class="hangar-fieldset2" method="post">
<div class="hangarFormControl-root hangarTextField-root jss1" data-validate = "Username is required">
<label class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined" data-shrink="true">Username</label>
<div class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
<div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
<div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
<i style="color:#7c7c81" class="fa fa-user-circle"></i>
</div>
</div>
<input autocomplete="off" aria-invalid="false" type="text" name="username" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="Username">
<fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
<legend class="jss4 jss5"><span>Username</span></legend>
</fieldset>
</div>
</div>
<div class="hangarFormControl-root hangarTextField-root jss1" data-validate = "Password is required">
<label class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined" data-shrink="true">Password</label>
<div class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
<div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
<div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
<i style="color:#7c7c81" class="fa fa-lock-alt"></i>
 </div>
</div>
<input autocomplete="off" aria-invalid="false" type="password" name="password" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="Password">
<fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
<legend class="jss4 jss5"><span>Password</span></legend>
</fieldset>
</div>
</div>
<div class="hangarFormControl-root hangarTextField-root jss1" data-validate = "Password is required">
<label class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined" data-shrink="true">License</label>
<div class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
<div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
<div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
<i style="color:#7c7c81" class="fa fa-key"></i>
 </div>
</div>
<input autocomplete="off" aria-invalid="false" type="text" name="license" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="License">
<fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
<legend class="jss4 jss5"><span>License</span></legend>
</fieldset>
</div>
</div>
<button name="register" class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary">
Register
</button>
&nbsp;
<button name="" class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary">
<a href="/" style="text-decoration:none;" >
		Login
	</a>
</button>

<div class="flex-sb-m w-full p-t-3 p-b-24">
<div>
</div>
	</div>
</form>



<p class="hangarFormHelperText-root hangarFormHelperText-contained hangar-error hangarFormHelperText-filled" style="text-align:center;">All rights reserved to <a style="text-decoration:none;" href="https://mrgarabato.com/">MrGarabato</a> 2022</p>
</div>
</div>
</div>
	
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <?php
        if (isset($_POST['register']))
{
	if($KeyAuthApp->register($_POST['username'],$_POST['password'],$_POST['license']))
	{
		$_SESSION['un'] = $_POST['username'];
		echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/'>";
		                            echo '
                        <script type=\'text/javascript\'>
                        
                        const notyf = new Notyf();
                        notyf
                          .success({
                            message: \'You have successfully registered!\',
                            duration: 3500,
                            dismissible: true
                          });                
                        
                        </script>
                        ';     
	}
}
    ?>
</body>
</html>