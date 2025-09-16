<?php
// if (!defined('ABSPATH')) exit;

// add_action('customize_preview_init', function () {
//     wp_add_inline_script('customize-preview', "
//     (function(api){
//       api('edw_primary_color', function(v){ v.bind(function(val){ document.documentElement.style.setProperty('--edw-primary', val); });});
//       api('edw_accent_color',  function(v){ v.bind(function(val){ document.documentElement.style.setProperty('--edw-accent',  val); });});
//       api('edw_nav_link_pad',  function(v){ v.bind(function(val){
//         let s=document.getElementById('edw-live-css'); if(!s){s=document.createElement('style');s.id='edw-live-css';document.head.appendChild(s);}
//         s.textContent='@media(min-width:769px){.main-navigation .main-nav>ul>li>a{padding-top:'+val+'px;padding-bottom:'+val+'px;line-height:1.2}}';
//       });});
//       api('edw_logo_max_h', function(v){ v.bind(function(val){
//         let s=document.getElementById('edw-live-css2'); if(!s){s=document.createElement('style');s.id='edw-live-css2';document.head.appendChild(s);}
//         s.textContent='@media(min-width:769px){.site-logo img{max-height:'+val+'px;height:auto}}';
//       });});
//     })(wp.customize);
//   ");
// });
