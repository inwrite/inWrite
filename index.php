<?php include 'head.php'; ?>
<title>inWrite</title>
</head>

    <body class="<?php echo $bodyClass; ?>">


        <?php include 'header.php'; ?>




        <div class="editor-container" id="editor-container">
            <div id="toolbarFloating">
                <!-- <button id="add-image-button"><svg viewBox="0 0 18 18">
                        <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
                        <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
                        <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
                    </svg></button> -->
                <!-- <button id="add-video-button">
                    <svg viewBox="0 0 18 18">
                        <rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect>
                        <rect class="ql-fill" height="12" width="1" x="5" y="3"></rect>
                        <rect class="ql-fill" height="12" width="1" x="12" y="3"></rect>
                        <rect class="ql-fill" height="2" width="8" x="5" y="8"></rect>
                        <rect class="ql-fill" height="1" width="3" x="3" y="5"></rect>
                        <rect class="ql-fill" height="1" width="3" x="3" y="7"></rect>
                        <rect class="ql-fill" height="1" width="3" x="3" y="10"></rect>
                        <rect class="ql-fill" height="1" width="3" x="3" y="12"></rect>
                        <rect class="ql-fill" height="1" width="3" x="12" y="5"></rect>
                        <rect class="ql-fill" height="1" width="3" x="12" y="7"></rect>
                        <rect class="ql-fill" height="1" width="3" x="12" y="10"></rect>
                        <rect class="ql-fill" height="1" width="3" x="12" y="12"></rect>
                    </svg>
                </button> -->


                <!-- <button type="button" class="ql-video" aria-pressed="false" aria-label="video"><svg viewBox="0 0 18 18"><rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect><rect class="ql-fill" height="12" width="1" x="5" y="3"></rect><rect class="ql-fill" height="12" width="1" x="12" y="3"></rect><rect class="ql-fill" height="2" width="8" x="5" y="8"></rect><rect class="ql-fill" height="1" width="3" x="3" y="5"></rect><rect class="ql-fill" height="1" width="3" x="3" y="7"></rect><rect class="ql-fill" height="1" width="3" x="3" y="10"></rect><rect class="ql-fill" height="1" width="3" x="3" y="12"></rect><rect class="ql-fill" height="1" width="3" x="12" y="5"></rect><rect class="ql-fill" height="1" width="3" x="12" y="7"></rect><rect class="ql-fill" height="1" width="3" x="12" y="10"></rect><rect class="ql-fill" height="1" width="3" x="12" y="12"></rect></svg></button> -->


                <button id="insert-table">
                    <svg viewBox="0 0 18 18">
                        <rect class="ql-fill" height="5" width="12" x="3" y="1"></rect>
                        <line class="ql-stroke" x1="3" x2="3" y1="2" y2="15"></line>
                        <line class="ql-stroke" x1="15" x2="15" y1="2" y2="15"></line>
                        <line class="ql-stroke" x1="9" x2="9" y1="3" y2="15"></line>
                        <line class="ql-stroke" x1="3" x2="15" y1="10" y2="10"></line>
                        <line class="ql-stroke" x1="3" x2="15" y1="15" y2="15"></line>
                    </svg>
                </button>
            </div>
            <div id="editor"></div>
        </div>
        <div id="contenteditablefalse"></div>

        <?php include 'footer.php'; ?>

    </body>
</html>