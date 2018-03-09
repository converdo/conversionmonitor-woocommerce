<?php if (cvd_config()->platform()->enabled()) { ?>

    <?php $collection = new \Converdo\ConversionMonitor\Core\Support\TrackableCollection(); ?>

    <!-- START CONVERSION MONITOR TRACKING CODE -->
    <script type="text/javascript">
        var cvd_cm = "<?= $collection->toEncryptedString(); ?>;<?= cvd_config()->platform()->website(); ?>", d=document, c=d.createElement('script'), s=d.getElementsByTagName('script')[0]; c.type='text/javascript'; c.defer=true; c.async=true; c.src='<?= cvd_config()->url('collect.js'); ?>'; s.parentNode.insertBefore(c,s);
    </script>
    <!-- END CONVERSION MONITOR TRACKING CODE -->

<?php }