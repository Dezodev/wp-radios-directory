<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Radios_Directory
 * @subpackage Wp_Radios_Directory/admin
 * @author     Dezodev <dezodev@gmail.com>
 */
class Wp_Radios_Directory_Metabox {

	/**
	 * Post Types to display metabox
	 *
	 * @since 	0.0.1
	 * @var 	array	$screen		Post Types to display metabox
	 */
	private $screen;

	/**
	 * List of meta fields
	 *
	 * @since 	0.0.1
	 * @var 	array
	 */
	private $meta_fields;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 	0.0.1
	 */
	public function __construct() {
		$this->screen = array( 'radios', );
		$this->meta_fields = array(
			array(
				'label' => 'Website',
				'id' => 'radio-website',
				'type' => 'url',
			),
			array(
				'label' => 'Main stream url',
				'id' => 'radio-main-stream',
				'type' => 'text',
			),
		);
	}

	/**
	 * Register metabox for each post type
	 *
	 * @since 	0.0.1
	 * @return 	void
	 */
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'radio_informations', __( 'Information of the radio', 'wp-radios-directory' ),
				array( $this, 'meta_box_callback' ), $single_screen, 'normal', 'high'
			);
		}
	}

	/**
	 * Generate the metabox
	 *
	 * @since 	0.0.1
	 * @param 	WP_Post		$post
	 * @return 	void
	 */
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'radio_informations_data', 'radio_informations_nonce' );
		$this->field_generator( $post );
	}

	/**
	 * Generates fields
	 *
	 * @since	0.0.1
	 * @param 	WP_Post 	$post
	 * @return 	void
	 */
	public function field_generator( $post ) {
		$output = '';

		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );

			if ( empty( $meta_value ) ) $meta_value = $meta_field['default'];

			switch ( $meta_field['type'] ) {
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						($meta_field['type'] !== 'color') ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}

		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Format form row
	 *
	 * @since 	0.0.1
	 * @param 	string 		$label
	 * @param 	string 		$input
	 * @return 	string
	 */
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}

	/**
	 * Save meta value
	 *
	 * @since 	0.0.1
	 * @param 	int 		$post_id
	 * @return 	void
	 */
	public function save_fields( $post_id ) {
		if (!isset($_POST['radio_informations_nonce'])) return $post_id;

		$nonce = $_POST['radio_informations_nonce'];

		if (!wp_verify_nonce($nonce, 'radio_informations_data')) return $post_id;	// If form none isn't valid
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;			// If it's autosave

		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset($_POST[$meta_field['id']]) ) {

				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[$meta_field['id']] = sanitize_email( $_POST[$meta_field['id']] );
						break;
					case 'text':
						$_POST[$meta_field['id']] = sanitize_text_field( $_POST[$meta_field['id']] );
						break;
				}

				update_post_meta( $post_id, $meta_field['id'], $_POST[$meta_field['id']] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}