<!DOCTYPE html>
<html style="margin: 0;padding: 0;">
   <head>
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

      <style type="text/css">
            #sidebar {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            padding: 0;
            margin: 0;
            overflow: auto;
            }
            #page-container {
            position: absolute;
            top: 0;
            left: 0;
            margin: 0;
            padding: 0;
            border: 0;
            }
            @media screen {
            #sidebar.opened + #page-container {
                left: 250px;
            }
            #page-container {
                bottom: 0;
                right: 0;
                overflow: auto;
            }
            .loading-indicator {
                display: none;
            }
            .loading-indicator.active {
                display: block;
                position: absolute;
                width: 64px;
                height: 64px;
                top: 50%;
                left: 50%;
                margin-top: -32px;
                margin-left: -32px;
            }
            .loading-indicator img {
                position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
            }
            }
            @media print {
            @page {
                margin: 0;
            }
            html {
                margin: 0;
            }
            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
            }
            #sidebar {
                display: none;
            }
            #page-container {
                width: auto;
                height: auto;
                overflow: visible;
                background-color: transparent;
            }
            .d {
                display: none;
            }
            }
            .pf {
            position: relative;
            background-color: white;
            overflow: hidden;
            margin: 0;
            border: 0;
            }
            .pc {
            position: absolute;
            border: 0;
            padding: 0;
            margin: 0;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: block;
            transform-origin: 0 0;
            -ms-transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
            }
            .pc.opened {
            display: block;
            }
            .bf {
            position: absolute;
            border: 0;
            margin: 0;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            -ms-user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            }
            .bi {
            position: absolute;
            border: 0;
            margin: 0;
            -ms-user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            }
            @media print {
            .pf {
                margin: 0;
                box-shadow: none;
                page-break-after: always;
                page-break-inside: avoid;
            }
            @-moz-document url-prefix() {
                .pf {
                overflow: visible;
                border: 1px solid #fff;
                }
                .pc {
                overflow: visible;
                }
            }
            }
            .c {
            position: absolute;
            border: 0;
            padding: 0;
            margin: 0;
            overflow: hidden;
            display: block;
            }
            .t {
            position: absolute;
            white-space: pre;
            font-size: 1px;
            transform-origin: 0 100%;
            -ms-transform-origin: 0 100%;
            -webkit-transform-origin: 0 100%;
            unicode-bidi: bidi-override;
            -moz-font-feature-settings: "liga" 0;
            }
            .t:after {
            content: "";
            }
            .t:before {
            content: "";
            display: inline-block;
            }
            .t span {
            position: relative;
            unicode-bidi: bidi-override;
            }
            ._ {
            display: inline-block;
            color: transparent;
            z-index: -1;
            }
            ::selection {
            background: rgba(127, 255, 255, 0.4);
            }
            ::-moz-selection {
            background: rgba(127, 255, 255, 0.4);
            }
            .pi {
            display: none;
            }
            .d {
            position: absolute;
            transform-origin: 0 100%;
            -ms-transform-origin: 0 100%;
            -webkit-transform-origin: 0 100%;
            }
            .it {
            border: 0;
            background-color: rgba(255, 255, 255, 0);
            }
            .ir:hover {
            cursor: pointer;
            }

            @keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
            }
            @-webkit-keyframes fadein {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
            }
            @keyframes swing {
            0 {
                transform: rotate(0);
            }
            10% {
                transform: rotate(0);
            }
            90% {
                transform: rotate(720deg);
            }
            100% {
                transform: rotate(720deg);
            }
            }
            @-webkit-keyframes swing {
            0 {
                -webkit-transform: rotate(0);
            }
            10% {
                -webkit-transform: rotate(0);
            }
            90% {
                -webkit-transform: rotate(720deg);
            }
            100% {
                -webkit-transform: rotate(720deg);
            }
            }
            @media screen {
            #sidebar {
                background-color: #2f3236;
                background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjNDAzYzNmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDBMNCA0Wk00IDBMMCA0WiIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2U9IiMxZTI5MmQiPjwvcGF0aD4KPC9zdmc+");
            }
            #outline {
                font-family: Georgia, Times, "Times New Roman", serif;
                font-size: 13px;
                margin: 2em 1em;
            }
            #outline ul {
                padding: 0;
            }
            #outline li {
                list-style-type: none;
                margin: 1em 0;
            }
            #outline li > ul {
                margin-left: 1em;
            }
            #outline a,
            #outline a:visited,
            #outline a:hover,
            #outline a:active {
                line-height: 1.2;
                color: #e8e8e8;
                text-overflow: ellipsis;
                white-space: nowrap;
                text-decoration: none;
                display: block;
                overflow: hidden;
                outline: 0;
            }
            #outline a:hover {
                color: #0cf;
            }
            #page-container {
                background-color: #9e9e9e;
                background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjOWU5ZTllIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9IiM4ODgiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4=");
                -webkit-transition: left 500ms;
                transition: left 500ms;
            }
            .pf {
                margin: 13px auto;
                box-shadow: 1px 1px 3px 1px #333;
                border-collapse: separate;
            }
            .pc.opened {
                -webkit-animation: fadein 100ms;
                animation: fadein 100ms;
            }
            .loading-indicator.active {
                -webkit-animation: swing 1.5s ease-in-out 0.01s infinite alternate none;
                animation: swing 1.5s ease-in-out 0.01s infinite alternate none;
            }
            .checked {
                background: no-repeat
                url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAWCAYAAADEtGw7AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3goQDSYgDiGofgAAAslJREFUOMvtlM9LFGEYx7/vvOPM6ywuuyPFihWFBUsdNnA6KLIh+QPx4KWExULdHQ/9A9EfUodYmATDYg/iRewQzklFWxcEBcGgEplDkDtI6sw4PzrIbrOuedBb9MALD7zv+3m+z4/3Bf7bZS2bzQIAcrmcMDExcTeXy10DAFVVAQDksgFUVZ1ljD3yfd+0LOuFpmnvVVW9GHhkZAQcxwkNDQ2FSCQyRMgJxnVdy7KstKZpn7nwha6urqqfTqfPBAJAuVymlNLXoigOhfd5nmeiKL5TVTV+lmIKwAOA7u5u6Lped2BsbOwjY6yf4zgQQkAIAcedaPR9H67r3uYBQFEUFItFtLe332lpaVkUBOHK3t5eRtf1DwAwODiIubk5DA8PM8bYW1EU+wEgCIJqsCAIQAiB7/u253k2BQDDMJBKpa4mEon5eDx+UxAESJL0uK2t7XosFlvSdf0QAEmlUnlRFJ9Waho2Qghc1/U9z3uWz+eX+Wr+lL6SZfleEAQIggA8z6OpqSknimIvYyybSCReMsZ6TislhCAIAti2Dc/zejVNWwCAavN8339j27YbTg0AGGM3WltbP4WhlRWq6Q/btrs1TVsYHx+vNgqKoqBUKn2NRqPFxsbGJzzP05puUlpt0ukyOI6z7zjOwNTU1OLo6CgmJyf/gA3DgKIoWF1d/cIY24/FYgOU0pp0z/Ityzo8Pj5OTk9PbwHA+vp6zWghDC+VSiuRSOQgGo32UErJ38CO42wdHR09LBQK3zKZDDY2NupmFmF4R0cHVlZWlmRZ/iVJUn9FeWWcCCE4ODjYtG27Z2Zm5juAOmgdGAB2d3cBADs7O8uSJN2SZfl+WKlpmpumaT6Yn58vn/fs6XmbhmHMNjc3tzDGFI7jYJrm5vb29sDa2trPC/9aiqJUy5pOp4f6+vqeJ5PJBAB0dnZe/t8NBajx/z37Df5OGX8d13xzAAAAAElFTkSuQmCC);
            }
            }

         .ff0 {
         font-family: sans-serif;
         visibility: hidden;
         }
         .sc_ {
         text-shadow: none;
         }
         @media screen and (-webkit-min-device-pixel-ratio: 0) {
         .sc_ {
         -webkit-text-stroke: 0px transparent;
         }
         }
         .y0 {
         bottom: -0.75px;
         }
         .h0 {
         height: 816px;
         }
         .h1 {
         height: 810.75px;
         }
         .w0 {
         width: 1344px;
         }
         .w1 {
         width: 1440.75px;
         }
         .x0 {
         left: 0px;
         }
         @media print {
         .y0 {
         bottom: -0.666667pt;
         }
         .h0 {
         height: 720pt;
         }
         .h1 {
         height: 720.666667pt;
         }
         .w0 {
         width: 1280pt;
         }
         .w1 {
         width: 1280.666667pt;
         }
         .x0 {
         left: 0pt;
         }
         }
      </style>
   </head>
   <body>
      <!-- <div id="page-container"> -->
         <div class="w0 h0" data-page-no="1" style="background-image: url('<?= base_url()  ?>/assets/bgh/sertif/sertifik.png');background-size: 100%;background-repeat: no-repeat;">
            <div class="row">
                <div class="col-sm-8">
                    <table style="width:100%;margin:16% 0 10% 3%;">
                        <tr>
                            <th class="text-center" ><img width="8%" src="<?= base_url()  ?>/assets/bgh/sertif/garuda.png" /></th>
                            <th class="text-center">
                                <p style="font-size: 18px;text-decoration: underline;">-----</p>
                                <p style="font-size: 18px;text-decoration: underline;">-----</p>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                <span style="font-size: 38px;"><b style="color: #126f21;font-weight: bolder;">S E R T I F I K A T</b></span>
                                <p style="font-size: 22px;margin-top: -10px;font-weight: bolder;">BANGUNAN GEDUNG HIJAU</p>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                <p style="font-size: 18px;">PEMERINTAH KABUPATEN/ KOTA</p>
                                <p style="font-size: 18px;">MENYATAKAN BAHWA BANGUNAN GEDUNG MILIK</p>
                                <p style="font-size: 18px;text-decoration: underline;font-weight: bolder;">-----</p>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                <p style="font-size: 18px;">KATEGORI : </p>
                                <p style="font-size: 18px;">YANG BERALAMAT DI</p>
                                <p style="font-size: 18px;text-decoration: underline;font-weight: bolder;">-----</p>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                <p style="font-size: 18px;">TELAH MEMENUHI SYARAT BANGUNAN GEDUNG HIJAU DENGAN PERINGKAT</p>
                                <p style="font-size: 21px;font-weight: bolder;"><b>TAHAPAN PERENCANAAN TEKNIS/ PELAKSANA KONSTRUKSI/ PEMANFAATAN</b></p>
                                <p style="font-size: 21px;font-weight: bolder;"><b>UTAMA/ MADYA/ PRATAMA</b></p>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" ><img width="15%" src="<?= base_url()  ?>/assets/bgh/sertif/logobgh.png" /></th>
                        </tr>
                    </table> 
                </div>
                <div class="col-sm-4">
                    <table style="width:100%;margin:32% 10% 10% 0;">
                        <tr>
                            <th class="text-center">
                                <p style="font-size: 18px;text-decoration: underline;">-----</p>
                            </th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th class="text-center" ><img width="30%" src="<?= base_url()  ?>/assets/bgh/sertif/placeholder.png" /></th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                <p style="font-size: 18px;">A/N KEPALA DAERAH</p>
                                <p style="font-size: 18px;">KEPALA DINAS</p>
                            </th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr> 
                            <th>&nbsp;</th>
                        </tr>
                        <tr>
                            <th class="text-center" ><img width="28%" src="<?= base_url()  ?>/assets/bgh/sertif/logobgh.png" style="-webkit-filter: grayscale(100%);" /></th>
                        </tr>
                    </table>
                </div>
            </div>
               
         </div>
   </body>
</html>
