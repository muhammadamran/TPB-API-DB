<div class="line-page-bottom"></div>
<div class="footer-wrap pd-20 mb-20 card-box" style="text-align: center;">
    <?php if ($resultSetting['company'] == NULL) { ?>
        Copyright © 2022 - Company All Rights Reserved.
    <?php } else { ?>
        Copyright © 2022 - <?= $resultSetting['company'] ?> All Rights Reserved.
    <?php } ?>
    <a class="font-w600" href="mailto:info@hellos-id.com" target="_blank">
        Hellos-ID
    </a>
    <br>
    <?php if ($resultSetting['version'] == NULL) { ?>
        <b>Version -</b>
    <?php } else { ?>
        <b><?= $resultSetting['version'] ?> - <?= $resultSetting['type'] ?></b>
    <?php } ?>
</div>