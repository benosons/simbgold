<?php

// Echo the image - timestamp appended to prevent caching
echo '<a href="index.php" id="refreshimg" title="Click to refresh image"><img src="/simbg_v2/assets/global/jquery-validate/captcha/images/image.php?' . time() . '" width="132" height="46" alt="Captcha image"></a>';
