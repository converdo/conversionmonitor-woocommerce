<?php if (! defined('ABSPATH')) { exit; } ?>

<div class="clear tab-margin"></div>
<p class="tab-container clear">
</p>
<div class="clear"></div>
<h3 class="title title-custom"><img src="https://www.conversionmonitor.com/favicon-16x16.png" style="position:relative; top:1px;"> Conversion Monitor</h3>
<p>
    <strong>ConversionMonitor Woocommerce 🚀 <?php echo cvd_config()->version(); ?></strong> <br>
    <a href="https://www.conversionmonitor.com" target="_blank">https://www.conversionmonitor.com</a>
</p>
<hr>

<?php if (count(include __DIR__ . '/../../../Core/dependencies.php') !== 0) { ?>
<div style="color: #fff; background-color: #E74C3C; font-size: 14px; padding: 15px; border-radius: 4px;">
    The required extensions <strong><?= implode(',', include __DIR__ . '/../../../Core/dependencies.php'); ?></strong> are missing. Without this extension the plugin does not work.
</div>
<hr>
<?php } ?>

<table class="form-table" id="conversionmonitor-settings">
	<?php $this->generate_settings_html(); ?>
</table>

<!-- Section -->
<div><input type="hidden" name="section" value="<?php echo $this->id; ?>"/></div>