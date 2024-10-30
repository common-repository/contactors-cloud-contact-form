<?php
$img_path = plugin_dir_url( dirname( __FILE__ ) ) . 'images/';
?>
<img src="<?php echo $img_path; ?>ccloud_logo_long.png" alt="Contractors Cloud Logo" style="max-width: 240px; max-height: 70px; margin: 10px 0; display: block;"/>
<h1>Contractors Cloud Form</h1>
<p>You've successfully installed the Contractors Cloud Wordpress Plugin! Now you'll just need to add a few things to get started:</p>
<li>Enter in your Contractors Cloud Api key into the input field below</li>
<li>Enter in the Email Address where you want the contact form to send to</li>
<li>Modify the any form text if you want to</li>
<p>Paste the following shortcode on any page where you want the form: <b>[ccloud_contact_form]</b></p>
<hr>

<?php
settings_errors();
?>
<form action="options.php" method="post">
  <?php
  settings_fields('ccloud-settings-group');
  do_settings_sections('ccloud-admin-page');
  submit_button();
  ?>
</form>

<script type="text/javascript">
   var checkboxs = document.getElementsByClassName("customize_checkbox");

   for (var i = 0; i < checkboxs.length; i++)
      {
      checkboxs[i].addEventListener('click', ccloud_change_hidden_value, false);
      }

  function ccloud_change_hidden_value()
      {
      var value_target = this.getAttribute('data-value_id');
      var checkbox_value = 0;

      if(value_target.length > 0)
         {
         if (this.checked) {
           checkbox_value = 1;
         }

         document.getElementById(value_target).value = checkbox_value;
         }
      }
</script>
