  <style>
  
  /* ===================================================================================
 *
 * Datepicker with style and language customized to any language!
 * Custom Example - Language Portuguese (Brazil) and orange theme
 * Visit: http://materializecss.com/ 
 * 
 * Author: Frederico S. Rocha
 * Contact: @fredsrocha
 * License: The MIT License (MIT)
 *
 * ===================================================================================
 */
.picker { outline: none; } /* Optional feature */
/* Header - Day of the week */

/* Body - Today info */
.picker__date-display { background-color: rgb(121,134,203); }
/* Buttons of actions */
.picker__nav--prev:hover { background-color: #fff3e0; }
.picker__nav--next:hover { background-color: #fff3e0; }
.picker__nav--prev:before {
  border-left: 0;
  border-right: 0.75em solid #0F74BD;
}
.picker__nav--next:before {
  border-right: 0;
  border-left: 0.75em solid #0F74BD;
}
.picker__today { color: #15F384; }
.picker__clear { /* If you want to customize */ }
.picker__close { color: #15F384; }
.btn-flat.picker__today:active { background-color: #fff3e0; }
.btn-flat.picker__close:active { background-color: #fff3e0; }
.btn-flat.picker__clear:active { background-color: #fff3e0; }
/* Select months of the year */
.picker__select--month.browser-default {
  display: inline;
  background-color: #FFFFFF;
  width: 34%;
  border: none;
  outline: none;
}
/* Every month of the year except: today */
.picker__day { /* If you want to customize */ }
.picker__day:hover { /* If you want to customize */ }
.picker__day--infocus:hover { color: #f57c00; }
.picker__day--selected, .picker__day--selected:hover, .picker--focused .picker__day--selected { 
    color: #F5F4F3;
    font-weight: 700;
}

/* Today */
.picker__day.picker__day--infocus.picker__day--today.picker__day--selected.picker__day--highlighted { background-color: rgb(255,64,129); }
.picker__day.picker__day--today 
{ color: rgb(15, 50, 234);
  font-weight: 700; }
  
.right-addon input{padding-right: 30px;
    padding: 10px;
    width: 100%;
    border: navajowhite;
    border: 1px solid #95989c;}
  
  
 .overlay { 
  color:#fff;
  <!-- position:absolute -->;
  z-index:25!important; 
  left:0;  
  text-align:center;  
  height:172px!important;
  top:86%;
  bottom:0;
}

.picker__table{border-collapse: collapse;
    border-spacing: 0;
    table-layout: fixed;
    font-size:1.8rem!important;
    width: 100%;
    margin-top: .75em;
    margin-bottom: .5em;}

.carousel{height:134vh!important;}


#slider2 {
    
    margin-right: 20px;
}


.slider{
    height:750px!important;    
}


.row2Wrap {
    display: flex;
}

.content {
    padding: 50px;
    margin-bottom: 100px;
}



.content {
    padding: 10px 15vw;
}


.select-wrapper .caret{
    text-indent: 1px;	
	width:90px;
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	padding: 2px 2px 2px 2px;
	border: none;
	background: transparent url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") no-repeat 60px center!important;
}

.select-wrapper span.caret{font-size:0px!important;}
div.transbox {
  margin: 30px;
  background-color: #ffffff;
  border: 1px solid black;
  opacity: 0.6;
  filter: alpha(opacity=60); /* For IE8 and earlier */
}

div.transbox p {
  margin: 5%;
  font-weight: bold;
  color: #000000;
}
  </style>