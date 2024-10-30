<style media="screen">
  .ccloud-input-container {
    margin-bottom: 20px;
    padding: 10px;
    vertical-align: top;
    position: relative;
  }
  .ccloud-input-container input,
  .ccloud-input-container select,
  .ccloud-input-container textarea {
    border: solid 1px gray;
    padding: 5px;
    width: 100%;
    max-width: 100%;
  }
  .ccloud-half-input {
    display: inline-block;
    width: calc(50% - 3px);
  }
  .ccloud-full-input {
    display: block;
    width: 100%;
  }
  input[name="ccloud-submitted"] {
    display: block;
    margin: 0 0 0 auto;
  }
  .ccloud-full-input textarea {
    width: 100%;
    max-width: 100%;
  }
  .ccloud-city-input {
    display: inline-block;
    width: calc(50% - 3px);
  }
  .ccloud-state-input {
    display: inline-block;
    width: calc(20% - 3px);
  }
  .ccloud-zip-input {
    display: inline-block;
    width: calc(30% - 3px);
  }
  .ccloud-contact-form sup {
    color: red;
  }
  .error_message_shake {
    background: red;
    color: white;
    padding: 10px;
    margin: 10px;
    max-width: 100%;
    text-align: center;
    display: block;
    animation: shake 0.5s linear;
    animation-fill-mode: forwards;
  }
  @keyframes shake {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(0px, 0px) rotate(0deg); }
}
</style>

<?php
if(empty(get_option('form_title_hide')))
    {
?>
    <h2 style="margin-bottom: 10px;">
      <?php echo !empty(get_option('form_title')) ? get_option('form_title') : ''; ?>
    </h2>
<?php
    }
?>
<p style="margin-bottom: 30px;">
  <?php echo !empty(get_option('form_text')) ? get_option('form_text') : ''; ?>
</p>

<form id="ccloud_contact_form" class="ccloud-contact-form" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ) ; ?>" method="post">


<div class="ccloud-input-container ccloud-half-input">
First Name <sup>*</sup><br/>
<input id="ccloud_first_name_input" required style="width: 100%" type="text" name="req_firstname" value="<?php echo( isset( $_POST["req_firstname"] ) ? esc_attr( $_POST["req_firstname"] ) : '' ) ; ?>" size="40" />
</div>

<div class="ccloud-input-container ccloud-half-input">
Last Name <sup>*</sup><br/>
<input id="ccloud_last_name_input" required style="width: 100%" type="text" name="req_lastname" value="<?php echo( isset( $_POST["req_lastname"] ) ? esc_attr( $_POST["req_lastname"] ) : '' ) ; ?>" size="40" />
</div>

<?php
if(empty(get_option('form_hide_company_name')))
    {
?>
<div class="ccloud-input-container ccloud-full-input">
Company Name <br/>
<input style="width: 100%" type="text" name="req_accountname" value="<?php echo( isset( $_POST["req_accountname"] ) ? esc_attr( $_POST["req_accountname"] ) : '' ) ; ?>" size="40" />
</div>
<?php
    }
?>

<?php
if(empty(get_option('form_hide_street')))
    {
?>
<div class="ccloud-input-container ccloud-full-input">
Street <br/>
<input style="width: 100%" type="text" name="req_street" value="<?php echo( isset( $_POST["req_street"] ) ? esc_attr( $_POST["req_street"] ) : '' ) ; ?>" size="40" />
</div>
<?php
    }
?>

<?php
if(empty(get_option('form_hide_city')))
    {
?>
<div class="ccloud-input-container ccloud-city-input">
City <br/>
<input style="width: 100%" type="text" name="req_city" value="<?php echo( isset( $_POST["req_city"] ) ? esc_attr( $_POST["req_city"] ) : '' ) ; ?>" size="40" />
</div>
<?php
    }
?>

<?php
if(empty(get_option('form_hide_state')))
    {
?>
<div class="ccloud-input-container ccloud-state-input">
State <br/>
<select name="req_state">
  <option selected value="">&nbsp;</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>
</div>
<?php
    }
?>

<?php
if(empty(get_option('form_hide_zip')))
    {
?>
<div class="ccloud-input-container ccloud-zip-input">
Zip <br/>
<input style="width: 100%" type="text" name="req_zip" value="<?php echo( isset( $_POST["req_zip"] ) ? esc_attr( $_POST["req_zip"] ) : '' ) ; ?>" size="40" />
</div>
<?php
    }
?>

<?php
if(empty(get_option('form_hide_email')))
    {
?>
<div class="ccloud-input-container ccloud-full-input">
Email <br/>
<input style="width: 100%" type="email" name="opt_emailPrimary" value="<?php echo( isset( $_POST["opt_emailPrimary"] ) ? esc_attr( $_POST["opt_emailPrimary"] ) : '' ) ; ?>" size="40" />
</div>
<?php
    }
?>

<?php
if(empty(get_option('form_hide_phone')))
    {
?>
<div class="ccloud-input-container ccloud-full-input">
Phone<br/>
<input style="width: 100%" type="text" name="opt_phonePrimary" value="<?php echo( isset( $_POST["opt_phonePrimary"] ) ? esc_attr( $_POST["opt_phonePrimary"] ) : '' ) ; ?>" size="40" />
</div>
<?php
    }
?>

<?php
if(empty(get_option('form_hide_message')))
    {
?>
<div class="ccloud-input-container ccloud-full-input">
Message<br/>
<textarea rows="10" cols="35" name="opt_note4"><?php echo ( isset( $_POST["opt_note4"] ) ? esc_attr( $_POST["opt_note4"] ) : '' ); ?></textarea>
</div>

<?php
    }
?>

<style media="screen">
/* emoji security styles */
#emoji_security_container {
  position: relative;
  text-align: center;
}
#emoji_prompt {
  font-size: 16px;
  font-family: arial;
  margin-top: 20px;
  margin-bottom: 5px;
}
.emoji_button {
  padding: 0;
  display: inline-block;
  margin: 5px;
  padding: 10px;
  border: solid 1px #c1c1c1;
  border-radius: 50%;
  background: transparent;
  cursor: pointer;
  outline: none!important;
}
.emoji_button img {
  width: 40px;
  height: 40px;
}
.selected_emoji {
  border: solid 3px black;
}

</style>
<?php

$number_of_emojis = 4;
$min_img_number = 1;
$max_img_number = 10;
$target_img_number = 4;
$emoji_array = array($target_img_number);
for($x = 1; $x < $number_of_emojis; $x++)
  {
  $img_number = 0;

  while(empty($img_number))
      {
      $img_number = rand($min_img_number, $max_img_number);

      if($img_number == $target_img_number || in_array($img_number, $emoji_array))
          {
          $img_number = 0;
          }
      }

  $emoji_array[] = $img_number;
  }

shuffle($emoji_array);

$img_path = plugin_dir_url( dirname( __FILE__ ) ) . 'images/tools/';

echo '<div id="emoji_security_container">';
echo '<div id="emoji_prompt"><b><sup style="color: red">*</sup>Security Test:</b> Select the Cone below</div>';

foreach($emoji_array as $emoji_number)
  {
  echo '<button type="button" class="emoji_button" data-img_number="' . $emoji_number . '"><img src="' . $img_path . $emoji_number . '.svg" /></button>';
  }

echo '</div>';
?>
<input type="hidden" id="img_number_input" name="emoji_number" />

<div id="submit_error_message"></div>

<p><input id="ccloud_submit_button" type="button" value="Send"></p>
<input type="hidden" name="ccloud-submitted" value="Send">
</form>

<script type="text/javascript">
var ccloud_submit_button = document.getElementById('ccloud_submit_button');

ccloud_submit_button.addEventListener('click', ccloud_check_emoji_security, false);

function ccloud_check_emoji_security()
    {
    var emoji_input = document.getElementById('img_number_input');
    var emoji_prompt = document.getElementById('emoji_prompt');
    var emoji_form = document.getElementById('ccloud_contact_form');
    var first_name_value = document.getElementById('ccloud_first_name_input').value;
    var last_name_value = document.getElementById('ccloud_last_name_input').value;

    if(emoji_input.value.length === 0)
        {
        document.getElementById('submit_error_message').classList.remove('error_message_shake');
        document.getElementById('submit_error_message').innerHTML = 'Oops. You did not click the Cone from the emojis above.';
        document.getElementById('submit_error_message').classList.add('error_message_shake');
        }
    else if(first_name_value.replace(/\s/g, '').length === 0 || last_name_value.replace(/\s/g, '').length === 0)
        {
        document.getElementById('submit_error_message').classList.remove('error_message_shake');
        document.getElementById('submit_error_message').innerHTML = 'First and Last Name are required. Fill them out to submit.';
        document.getElementById('submit_error_message').classList.add('error_message_shake');
        }
    else
        {
        emoji_form.submit();
        }
    }

var emoji_buttons = document.getElementsByClassName("emoji_button");

for(var x = 0; x < emoji_buttons.length; x++)
    {
    emoji_buttons[x].addEventListener('click', ccloud_update_img_number, false);
    }

function ccloud_update_img_number()
    {
    var new_img_number = this.getAttribute('data-img_number');

    for (var x = 0; x < emoji_buttons.length; x++)
        {
        emoji_buttons[x].classList.remove('selected_emoji');
        }

    this.classList.add('selected_emoji');

    document.getElementById('img_number_input').value = new_img_number;
    }
</script>
