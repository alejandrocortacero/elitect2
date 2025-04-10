<?php defined( 'ABSPATH' ) or die( 'Wrong Access' ); ?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo esc_html( __( 'JLC Custom Form Help', JLCCustomForm::TEXT_DOMAIN ) ); ?></h1>
	<hr />
	<ul>
		<li><a href="#i18n">I18n</a></li>
		<li><a href="#template_overwriting">Template overwriting</a></li>
		<li><a href="#printing_forms">Printing forms</a></li>
		<ul>
			<li><a href="#decoration">Decoration</a></li>
		</ul>
		<li><a href="#nonce">Nonces</a></li>
		<li><a href="#reading">Reading forms</a></li>
		<ul>
			<li><a href="#registering_forms">Registering forms</a></li>
			<li><a href="#initilizing_reading">Initializing</a></li>
			<li><a href="#reading_users">Logged users</a></li>
			<li><a href="#reading_simple">Reading synchronously</a></li>
			<li><a href="#reading_ajax">AJAX reading</a></li>
		</ul>
		<li><a href="#abstract">Abstract forms</a></li>
		<ul>
			<li><a href="#admin_form">Admin form</a></li>
			<li><a href="#admin_settings_form">Admin form</a></li>
		</ul>
		
	</ul>
	<hr/>
	<h2 id="i18n">I18n</h2>
	<p>The <code>JLCCustomForm</code> has its own text domain for its default messages, but it can not translate the messages of your custom forms, therefore you must include a custom text domain for your custom forms.</p>
	<p>So the custom forms may have its own text domain or use the text domain of the plugin that uses it. In this case, remember to include the text domain in <code>JLCCustomForm::register_form()</code> and <code>JLCCustomForm::get_form()</code> if you wish to use the <code>JLCCustomForm</code> mechanics.</p> 
	<hr/>
	<h2 id="printing_forms">Printing forms</h2>
	<p>The <code>JLCCustomForm</code> class has default methdos for printing public and admin forms. For this purpose has two methods for printing the whole form:</p>
	<ul>
		<li><code>public print_public_form( $hide_messages = false )</code></li>
		<li><code>public print_admin_form( $readonly_form = false )</code></li>
	</ul>
	<p>The parameter <code>$hide_messages</code> is used to print the messages in other place than over the form.</p>
	<p>The parameter <code>$readonly_form</code> is used in forms that are filled by public users and read by admin users.</p>
	<h3>Printing submethods</h3>
	<p>The two previous methods call these by default for printing:</p>
	<ul>
		<li><code>public print_public_notices()</code></li>
		<li><code>public print_public_form_opening()</code></li>
		<li><code>public print_public_form_body()</code></li>
		<li><code>public print_public_form_closing()</code></li>
		<li><code>public print_admin_notices()</code></li>
		<li><code>public print_admin_form_opening()</code></li>
		<li><code>public print_admin_form_body()</code></li>
		<li><code>public print_admin_form_closing()</code></li>
	</ul>
	<p>These methods print default templates for each case. You will only need to overwrite <code>print_public_form_body()</code> and <code>print_admin_form_body()</code> usually, but everyone can be overwritten for functionality purposes. For design purposes a <a href="#template_overwriting">template overwriting</a> in body methods will be enough, but the body method must be overwritten loading other template for full customization, because default templates only print default field templates sequentially.</p>
	<p>There is another method called in default printing form methods: <code>protected preload_field_values_from_transient( $remove = true )</code>. When an error occurs, values sent by the user are stored in a transient. Then, in next form printing, those values are recovered in this transient to fill the fields.</p>
	<p><code>$remove</code> parameter is used for forms that will be printed several time in the same page.</p>
	<hr/>
	<h3 id="decoration">Decoration</h3>
	<p>As seen above, you can overwrite printing methods to get a custom layout for your form, but there are cases when this task can be considered very heavy. E.g: Adding a separator between two fields. To solve this, <code>JLCCustomForm</code> has pseudo-fields that are ignored in reading process:</p>
	<ul>
		<li><code>add_separator_field()</code></li>
		<li><code>add_heading_field()</code></li>
	</ul>
	<p>Like all the fields, decoration fields implement <code>JLCCustomFormRequestReader</code> but inherit from abstract class <code>AbstractJLCCustomFormDecorationField</code>. So if you wish a new decoration field, just create a subclass of this.</p>
	<hr/>
	<h2 id="nonces">Nonces</h2>
	<p>The checking nonce process is automatized by <code>JLCCustomForm</code> class. It has three default methods, one for naming and two for checking:</p>
	<ul>
		<li><strong><code>protected get_nonce_action()</code></strong> - This method returns nonce name for use it in <code>check_nonce()</code> or in Wordpress nonce creation functions: <code>wp_nonce_url()</code>, <code>wp_nonce_field()</code> or <code>wp_create_nonce()</code>. The name is generated concatening <code>internal_id</code> and <code>action</code> class properties. Fell free to overwrite this method.</li>
		<li><strong><code>protected check_nonce()</code></strong> - This method checks nonce is most vesatile way, using <code>wp_verify_nonce()</code> function. It get nonce value from <code>$_POST</code> or <code>$_GET</code> depending on class <code>method</code> property. In included class <code>JLCAdminForm</code> this method directly uses function <code>check_admin_referer()</code>.</li>
		<li><strong><code>protected check_ajax_nonce()</code></strong> - This method only uses <code>check_ajax_nonce()</code> function, but is encapsulated into a class method for simple overwriting purposes. E.g: your child form does not require abort execution when checking fails.</li>
	</ul>
	<hr/>
	<h2 id="reading">Reading</h2>
	<p>Forms inhereting from <code>JLCCustomForm</code> use Wordpress method for reading forms by default. That is, requests are sent to <code>admin-post.php</code> or <code>admin-ajax.php</code> and hooked to <code>admin_post_</code> or <code>wp_ajax_</code> actions respectively. These actions are hooked automatically and calls are included in forms or managed by <code>ajax.js</code> script.</p>
	<p>To force a form to use a different method for mananging requests, just pass <code>false</code> to <code>$wordpress_method</code> argument of form constructor. Then you can manage the request in the way you wish.</p>
	<h3 id="registering_forms">Registering forms</h3>
	<ul>
		<li>If you are going to <b>use a form following the Wordpress method</b>, then yo must register the form once (eg: on plugin or theme activation) using <code>JLCCustomForm::register_form()</code> method. Once registered, the form will be initialized for reading at <code>init</code> hook if <code>$_REQUEST['jlc_custom_form']</code> is defined and equal to the internal form ID (this field is automatically included when printing the form).</li>
		<li>If you are going yo <b>use a form following your OWN method</b>, the registration is not mandatory, but you can register the form as well and overwrite the <code>initialize_reading()</code> method of your form, allowing it to manage the request at <code>init</code> hook or hooking to a later action.</li>
	<h3 id="initilizing_reading">Initializing</h3>
	<p>Reading initialization means the form processing methods are hooked to <code>admin_post_</code> or <code>wp_ajax_</code> depending on the type of request and wheter the user is logged in (see more of these methods in ...). At the end of reading process, these methods call the abstract method <code>process_form()</code>, where you must insert the code in charge of manage the form main task. (<b>IMPORTANT!</b>: See more about this method at ...)</p>
	<h3 id="reading_users">Logged users</h3>
	<p>The Wordpress actions for reading forms, <code>admin_post_{action_name}</code> and <code>wp_ajax_{action_name}</code> are for logged users, but also exists their equivalent actions <code>admin_post_nopriv_{action_name}</code> and <code>wp_ajax_nopriv_{action_name}</code> for every user.<p>
	<p>Actions are hooked to the following methods:</p>
	<ul>
		<li><code>admin_post_{action_name}</code> &rarr; <code>process_action</code></li>
		<li><code>admin_post_nopriv_{action_name}</code> &rarr; <code>process_nopriv_action</code></li>
		<li><code>wp_ajax_{action_name}</code> &rarr; <code>process_ajax_action</code></li>
		<li><code>wp_ajax_nopriv_{action_name}</code> &rarr; <code>process_ajax_nopriv_action</code></li>
	</ul>
	<p>Hooking all of these actions is done automatically if the form follows the Wordpress method, but if only logged users must be able of sending the form, just pass <code>true</code> as <code>$private</code> constructor argument and the public (<code>nopriv</code>) actions will not be hooked.</p>
	<p>If form is constructed as public (<code>$private =&gt; false</code>), <code>nopriv</code> methods call its equivalent private method by default. These methods check nonces, load and check values from request, generate errors if exist and call <code>process_form()</code> if everything went OK.</p>
	<h3 id="reading_process_form">The <code>process_form()</code> method</h3>
	<p>Once here, its turn of execute custom child form code. This method is abstract in <code>JLCCustomForm</code> and is where you insert the code that finally processes the user input.</p>
	<h4>Getting input values</h4>
	<p>You can use the method <code>get_fields()</code> to get all the fields, or <code>get_field_by_name( $name, $include_internal_id = false )</code> to get the fields by name. After that, use <code>$field->get_value()</code> for each field.  E.g:</p>
	<p><code>$first_name = $this-&gt;get_field_by_name( 'first_name' )->get_value();</code></p>
	<p>The second argument of <code>get_field_by_name( $name, $include_internal_id = false )</code> must be set to <code>true</code> if field names were prefixed with the form intenral id at construction time.</p>
	<h4>Generating the response</h4>
	<p>A form, by default, works with responses under this structure:</p>
	<code>
		array(<br/>
		&nbsp;&nbsp;array( 'code' => int, 'text' => string ),</br>
		&nbsp;&nbsp;.<br/>
		&nbsp;&nbsp;.<br/>
		&nbsp;&nbsp;.<br/>
		)
	</code>
	<p>Where every inner array corresponds to a message, <code>code</code> is <code>0</code> for success messages and other values for errors and <code>text</code> is the text message.</p>
	<p>In <code>process_form()</code> you can return an array like described before, or return these values:</p>
	<ul>
		<li><code>true</code> is transformed into a default success message (<code>array( 'code' =&gt; 0, 'Form sent successfully' )</code>)</li>
		<li><code>false</code> is transformed into a default error message (<code>array( 'code' =&gt; 2, 'There was an error while processing the form. Try again later please.' )</code>)</li>
		<li><code>string</code> is transformed into a success message with text specified by the string (<code>array( 'code' =&gt; 2, $string )</code>)</li>
	</ul>
		
	<p>Note there is no limit in how many messages the array can contain.</p>
	<h3 id="reading_simple">Reading synchronously</h3>
	<p>In this mode, <code>process_action()</code> stores the messages in a transient which is read and cleaned when the form is printed again.</p>
	<p>You can use <code>external_print_public_notices()</code> to print the messages without printing the form.</p>
	<h3 id="reading_ajax">AJAX reading</h3>
	<p><code>process_ajax_action()</code> does not store responses anywhere, it generates a <code>WP_Ajax_Response</code> object containing the messages and send it to the browser. Then the default <code>ajax.js</code> prepend the messages to the form.</p>
	<p>To alter the way in messages are transformed into <code>WP_Ajax_Response</code> just overwrite the method <code>generate_wpajax_response</code>.</p>
	<p>Default script <code>ajax.js</code> also is prepared to read different responses. See more at <a href="#">...</a>.</p>

	<h2 id="abstract">Abstract forms</h2>
	<p><code>JLCCustomForm</code> comes with predefined abstract forms to help the developer automating common tasks.</p>
	<h3 id="admin_form">Admin form</h3>
	<h3 id="admin_settings_form">Admin settings form</h3>
	<p>The class <code>JLCAdminSettingsForm</code> is usefull to generate forms that will store all the fields as Wordpress options.</p>
	<p>This form redirects to <code>admin_url( 'admin.php?page=' . $admin_page_slug )</code> by default, but if you wish to redirect to another admin page, just set the URL on <code>$admin_page_slug</code>. The <code>JLCAdminSettingsForm</code> constructor compares <code>$admin_page_slug</code> against the regular expression <code>/\.php\?page=/</code> and if matches, generates the URL for given string. E.g:</code>
	<p><code>$admin_page_slug = 'my_slug'</code> redirects to <code>admin_url( 'admin.php?page=my_slug' )</code></p>
	<p><code>$admin_page_slug = 'themes.php?page=my_slug'</code> redirects to <code>admin_url( 'themes.php?page=my_slug' )</code></p>


</div>
