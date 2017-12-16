<style>
	.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
	margin-bottom: -1px;
}
/********************************************************************/
/*** PANEL DEFAULT ***/
.with-nav-tabs.panel-default .nav-tabs > li > a,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
}
.with-nav-tabs.panel-default .nav-tabs > .open > a,
.with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
	background-color: #ddd;
	border-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.active > a,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
	color: #555;
	background-color: #fff;
	border-color: #ddd;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #f5f5f5;
    border-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #777;   
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #555;
}



.my_pro_info .accordion {
  padding: 0;
  margin: 2em 0;
  width: 100%;
  overflow: hidden;
  font-size: 1em;
  position: relative;
}

.my_pro_info .accordion__title {
  padding: 0 1em;  
  border-bottom: 3px solid #fff;
  color: #222;
  float: left;
  line-height: 3;
  height: 3em;
  cursor: pointer;
  margin-right: .25em;
  width: 15%;
  text-align: center;
}

.my_pro_info .no-js .accordion__title {
  float: none;
  height:auto;
  cursor:auto;
  margin:0;
  padding:0 2em;
}

.my_pro_info .accordion__content {
  float: right;
  width: 100%;
  margin: 3em 0 0 -100%;
  padding: 2em;
  border-top:1px solid #ccc;
}

.my_pro_info .no-js .accordion__content {
  float:left;
  margin:0;
}

.my_pro_info .accordion__title:hover,
.my_pro_info .accordion__title.active {
  
  color:#4bd058;
}

.my_pro_info .no-js .accordion__title:hover {
  background-color:#ccc;
  color:#222;
}

.my_pro_info .accordion__title.active {
  border-bottom-color:#61bd62;
      color: #61bd62;
}

@media (max-width:767) {
  
  .my_pro_info .accordion {
    border: 1px solid grey;
  }
  
  .my_pro_info .accordion__title,
  .my_pro_info .accordion__content { 
    float: none;
    margin: 0;
  }
  
  .my_pro_info .accordion__title:first-child {
    border:none;
  }
  
 .my_pro_info .accordion__title.active {
  border-bottom-color:#eee;
  }
  
  .my_pro_info .accordion__title.active, .accordion__title:hover {
    background:#777;
  }
  
  .my_pro_info .accordion__title:before {
  content:"+";
  text-align:center;
  width:2em;
  display:inline-block;
  }
 .my_pro_info .accordion__title.active:before {
  content:"-";
  }
  
 .overflow-scrolling {
  overflow-y: scroll;
  height:11em;
  padding:1em 1em 0 1em;
  /* Warning: momemtum scrolling seems buggy on iOS 7  */
  -webkit-overflow-scrolling: touch;
  }

  .my_pro_info .accordion__content {
    position:relative;
    overflow:hidden;
    padding:0;
  }
  
  .my_pro_info .no-js .accordion__content {
    padding:1em;
    overflow:auto;
    display:block;
  }
  
  .my_pro_info .accordion__content:after {
    position:absolute;
    top:100%;
    left:0;
    width:100%;
    height:50px;
    border-radius:10px 0 0 10px / 50% 0 0 50%;
    box-shadow:-5px 0 10px rgba(0, 0, 0, 0.5);
    content:'';
}
   
}


  
</style>