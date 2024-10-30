<?php
/*
Plugin Name: Contactors Cloud Contact Form
Plugin URI: http://www.contractorscloud.com/
Description: A plugin for contractors cloud users to create a form that will submit to the contractors cloud app.
Version: 1.1.1
Author: Contractors Cloud
Author URI: https://www.contractorscloud.info/
*/

    add_shortcode( 'ccloud_contact_form', 'ccloud_form_shortcode' );
    add_action('admin_menu', 'ccloud_admin_menu');

    function ccloud_admin_menu()
        {
        add_menu_page('CC Form', 'CC Form API', 'manage_options', 'ccloud-admin-menu', 'ccloud_admin_menu_main', 'dashicons-cloud', 1);
        add_action('admin_init', 'ccloud_custom_settings');
        }

    function ccloud_admin_menu_main()
        {
        require_once dirname(__FILE__) . '/templates/ccloud-admin.php';
        }

    function ccloud_custom_fields_array()
        {
        $fields_array = array(
          // 'First Name' => 'first_name',
          // 'Last Name' => 'last_name',
          'Company Name' => 'company_name',
          'Street' => 'street',
          'City' => 'city',
          'State' => 'state',
          'Zip' => 'zip',
          'Email' => 'email',
          'Phone' => 'phone',
          'Message' => 'message'
        );

        return $fields_array;
        }

    function ccloud_custom_settings()
        {
        // ability to create a section in db - record our fiends
        // ccloud-settings-group is the group name stored in db for fields
        $fields = ccloud_custom_fields_array();

        // fields
        foreach($fields as $field => $key)
            {
            register_setting('ccloud-settings-group', 'form_hide_' . $key);
            // register_setting('ccloud-settings-group', 'form_required_' . $field);
            }


				register_setting('ccloud-settings-group', 'form_api');
        register_setting('ccloud-settings-group', 'form_send_to_email');
        register_setting('ccloud-settings-group', 'form_title');
        register_setting('ccloud-settings-group', 'form_title_hide');
        register_setting('ccloud-settings-group', 'form_text');
        register_setting('ccloud-settings-group', 'form_success');
        add_settings_section('ccloud-form-text-options', 'Plugin Settings', 'ccloud_text_options', 'ccloud-admin-page');
        add_settings_field('form-text-input', 'Form Text', 'ccloud_form_text', 'ccloud-admin-page', 'ccloud-form-text-options');
				add_settings_field('form-api-input', 'Api Key', 'ccloud_form_api', 'ccloud-admin-page', 'ccloud-form-text-options');
        add_settings_field('form-email-input', 'Send To Email', 'ccloud_form_send_to_email', 'ccloud-admin-page', 'ccloud-form-text-options');
        add_settings_field('form-fields-input', 'Customize Fields', 'ccloud_form_customize_fields', 'ccloud-admin-page', 'ccloud-form-text-options');
        }

    function ccloud_text_options()
        {
        // echo "Customize The Form Text";
        }

    function ccloud_form_customize_fields()
        {
        $fields = ccloud_custom_fields_array();

        foreach($fields as $field => $key)
            {
            $hide = get_option('form_hide_' . $key);

            if(empty($hide))
                {
                $hide_checked = "";
                $hide_value = 0;
                }
            else
                {
                $hide_checked = "checked";
                $hide_value = 1;
                }


            echo '<div class="ccloud_custom_field">';
                echo '<div class="ccloud_field_title">' . $field . '</div>';
                echo '<label for="ccloud_input_' . $key . '">Hide?</label> <input name="" id="ccloud_input_' . $key . '" class="customize_checkbox" data-value_id="' . $key . '_hide_value" type="checkbox" ' . $hide_checked . ' value="1" /> ';
                echo '<input type="hidden" id="' . $key . '_hide_value" name="form_hide_' . $key . '" value="' . $hide_value . '" />';
            echo '</div>';
            echo '<hr>';
            }
        }

    function ccloud_form_text()
        {
        $form_title = get_option('form_title');
        $form_title_hide = get_option('form_title_hide');
        $form_text = get_option('form_text');
        $form_success = get_option('form_success');

        if(empty($form_title_hide))
            {
            $title_hide_checked = "";
            $form_title_hide = 0;
            }
        else
            {
            $title_hide_checked = "checked";
            $form_title_hide = 1;
            }

        echo '<label style="display: block">Title</label><input type="text" name="form_title" value="' . $form_title . '" placeholder="Form Title" />';
        echo '<label>Hide?<input ' . $title_hide_checked . ' name="" data-value_id="title_hide_value" type="checkbox" class="customize_checkbox" value="1"></label>';
        echo '<input type="hidden" id="title_hide_value" name="form_title_hide" value="' . $form_title_hide . '">';
        echo '<br>';
        echo '<label style="display: block; margin-top: 15px;">Sub text</label><textarea rows="3" cols="40" name="form_text" placeholder="Form Text">' . $form_text . '</textarea>';
        echo '<br>';
        echo '<label style="display: block; margin-top: 15px;">Message after submit</label><textarea rows="3" cols="40" name="form_success" placeholder="Success Message">' . $form_success . '</textarea>';
        }

		function ccloud_form_api()
				{
				$form_api = get_option('form_api');

        echo '<input type="text" name="form_api" value="' . $form_api . '" placeholder="Api Key" />';
				}

    function ccloud_form_send_to_email()
        {
        $form_send_to_email = get_option('form_send_to_email');

        echo '<input type="text" name="form_send_to_email" value="' . $form_send_to_email . '" placeholder="Email address to send to" />';
        }

    function ccloud_check_emoji_security()
        {
        $target_emoji_number = 4;
        if(empty($_REQUEST['emoji_number']) || $_REQUEST['emoji_number'] != $target_emoji_number)
            {
            die("Wrong security animal selected. Please go back and try again.");
            }
        }

    function ccloud_html_form_code()
        {
        require_once dirname(__FILE__) . '/templates/ccloud-form-content.php';
        }

    function ccloud_deliver_mail()
        {
    		// sanitize form values
    		$req_firstname = !empty($_POST['req_firstname']) ? sanitize_text_field( $_POST["req_firstname"] ) : '';
        $req_lastname = !empty($_POST['req_lastname']) ? sanitize_text_field( $_POST["req_lastname"] ) : '';
        $req_accountname = !empty($_POST['req_accountname']) ? sanitize_text_field( $_POST["req_accountname"] ) : '';
        $req_street = !empty($_POST['req_street']) ? sanitize_text_field( $_POST["req_street"] ) : 'TBD';
        $req_city = !empty($_POST['req_city']) ? sanitize_text_field( $_POST["req_city"] ) : 'TBD';
        $req_state = !empty($_POST['req_state']) ?  sanitize_text_field( $_POST["req_state"] ) : 'TBD';
        $req_zip = !empty($_POST['req_zip']) ? sanitize_text_field( $_POST["req_zip"] ) : 'TBD';
        $opt_phonePrimary = !empty($_POST['opt_phonePrimary']) ? sanitize_text_field( $_POST["opt_phonePrimary"] ) : 'TBD';
        $opt_emailPrimary = !empty($_POST['opt_emailPrimary']) ? sanitize_email( $_POST["opt_emailPrimary"] ) : 'TBD';
        $opt_note4 = !empty($_POST['opt_note4']) ? sanitize_textarea_field( $_POST["opt_note4"] ) : 'NA';

        if(empty($req_accountname))
            {
            $req_accountname = $req_firstname . " " . $req_lastname;
            }

        $post_body = array(
            'req_firstname' => $req_firstname,
            'req_lastname' => $req_lastname,
            'req_accountname' => $req_accountname,
            'req_street' => $req_street,
            'req_city' => $req_city,
            'req_state' => $req_state,
            'req_zip' => $req_zip,
            'opt_phonePrimary' => $opt_phonePrimary,
            'opt_emailPrimary' => $opt_emailPrimary,
            'opt_note4' => $opt_note4,
        );

        $url = 'https://app.contractorscloud.com/api/v2/import/record';

        $api_key = get_option('form_api');

        $auth = base64_encode('api:' . $api_key);

        $result = wp_remote_post($url, array(
            'method'      => 'POST',
            'timeout'     => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => array(
              'Authorization' => 'Basic ' . $auth
            ),
            'body'        => $post_body,
            'cookies'     => array()
            )
        );

        $email_fields = array(
            'First Name' => $req_firstname,
            'Last Name' => $req_lastname,
            'Company' => $req_accountname,
            'Street' => $req_street,
            'City' => $req_city,
            'State' => $req_state,
            'Zip' => $req_zip,
            'Phone Number' => $opt_phonePrimary,
            'Email' => $opt_emailPrimary,
            'Note' => $opt_note4,
        );

        // the email address to send to
        $email_to = get_option('form_send_to_email');

        if(empty($email_to))
            {
            $email_to = get_option('admin_email');
            }

        $email_subject = "Contractors Cloud Plugin Submission";

        $email_body = '<h2>Contractors Cloud Form submission</h2>';

        foreach($email_fields as $key => $value)
            {
            if(!empty($value))
                {
                $email_body .= '<p><b>' . $key . ':</b> ' . $value . '</p>';
                }
            }

        $email_headers = array('Content-Type: text/html; charset=UTF-8');

    		// If email has been process for sending, display a success message
    		if (wp_mail($email_to, $email_subject, $email_body, $email_headers))
            {
      			echo '<div>';
            echo '<h2>Submit Success</h2>';
      			echo '<p>' . get_option('form_success') . '</p>';
      			echo '</div>';
        		}
        else
            {
      			echo 'An unexpected error occurred';
        		}
        }

    function ccloud_form_shortcode()
        {
      	ob_start();

        // if the submit button is clicked, send the email
        if (isset($_POST['ccloud-submitted']))
            {
            ccloud_check_emoji_security();
          	ccloud_deliver_mail();
            }
        else
            {
            ccloud_html_form_code();
            }

      	return ob_get_clean();
        }
?>
