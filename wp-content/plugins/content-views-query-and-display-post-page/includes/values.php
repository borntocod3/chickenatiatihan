<?php

/**
 * Define values for input, select...
 *
 * @package   PT_Content_Views
 * @author    PT Guy <palaceofthemes@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_Values' ) ) {

	/**
	 * @name PT_CV_Values
	 * @todo Define values for input, select...
	 */
	class PT_CV_Values {

		/**
		 * Get Post Types
		 *
		 * @param array  $args      Array of query parameters
		 * @param string $excludes_ Array of slug of post types want to exclude from result
		 *
		 * @return array
		 */
		static function post_types( $args = array(), $excludes_ = array() ) {
			$excludes	 = array_merge( array( 'attachment' ), $excludes_ );
			$result		 = array();
			$args		 = array_merge( array( 'public' => true, '_builtin' => true ), $args );
			$args		 = apply_filters( PT_CV_PREFIX_ . 'post_types', $args );
			$post_types	 = get_post_types( $args, 'objects' );

			foreach ( $post_types as $post_type ) {
				if ( in_array( $post_type->name, $excludes ) ) {
					continue;
				}
				$result[ $post_type->name ] = __( $post_type->labels->singular_name, PT_CV_TEXTDOMAIN );
			}

			$result = apply_filters( PT_CV_PREFIX_ . 'post_types_list', $result );

			return $result;
		}

		/**
		 * Get list of post types and related taxonomies
		 *
		 * @return array
		 */
		static function post_types_vs_taxonomies() {
			// Get post types
			$args		 = apply_filters( PT_CV_PREFIX_ . 'post_types', array( 'public' => true, 'show_ui' => true, '_builtin' => true ) );
			$post_types	 = get_post_types( $args );

			// Get taxonomies of post types
			$result = array();

			foreach ( $post_types as $post_type ) {
				$taxonomy_names			 = get_object_taxonomies( $post_type );
				$result[ $post_type ]	 = $taxonomy_names;
			}

			return apply_filters( PT_CV_PREFIX_ . 'post_types_taxonomies', $result );
		}

		/**
		 * Get list of taxonomies
		 *
		 * @param array $args Array of query parameters
		 *
		 * @return array
		 */
		static function taxonomy_list( $args = array() ) {
			$result		 = array();
			$args		 = array_merge( array( 'public' => true, 'show_ui' => true, '_builtin' => true ), $args );
			$args		 = apply_filters( PT_CV_PREFIX_ . 'taxonomy_query_args', $args );
			$taxonomies	 = get_taxonomies( $args, 'objects' );

			foreach ( $taxonomies as $taxonomy ) {
				$result[ $taxonomy->name ] = __( $taxonomy->labels->singular_name, PT_CV_TEXTDOMAIN );
			}

			return $result;
		}

		/**
		 * The logical relationship between taxonomies
		 *
		 * @return array
		 */
		static function taxonomy_relation() {
			return array(
				'AND'	 => __( 'AND', PT_CV_TEXTDOMAIN ) . ' &#8212; ' . __( 'show posts which match all settings', PT_CV_TEXTDOMAIN ),
				'OR'	 => __( 'OR', PT_CV_TEXTDOMAIN ) . ' &#8212; ' . __( 'show posts which match one or more settings', PT_CV_TEXTDOMAIN ),
			);
		}

		/**
		 * Operator to join. Possible values are 'IN'(default), 'NOT IN', 'AND'.
		 * @return type
		 */
		static function taxonomy_operators() {
			return array(
				'IN'	 => __( 'IN', PT_CV_TEXTDOMAIN ) . ' &#8212; ' . __( 'show posts which associate with one or more of selected terms', PT_CV_TEXTDOMAIN ),
				'NOT IN' => __( 'NOT IN', PT_CV_TEXTDOMAIN ) . ' &#8212; ' . __( 'show posts which do not associate with any of selected terms', PT_CV_TEXTDOMAIN ),
				'AND'	 => __( 'AND', PT_CV_TEXTDOMAIN ) . ' &#8212; ' . __( 'show posts which associate with all of selected terms', PT_CV_TEXTDOMAIN ),
			);
		}

		/**
		 * Get taxonomies of Post type
		 *
		 * @param string $object Name of the post type, or a post object
		 * @param string $output The type of output to return, either taxonomy 'names' or 'objects'
		 *
		 * @return array
		 */
		static function taxonomy_by_post_type( $object, $output = 'names' ) {
			$data	 = get_object_taxonomies( $object, $output );
			$result	 = array();

			foreach ( (array) $data as $taxonomy ) {
				$result[ $taxonomy ] = self::taxonomy_info( $taxonomy, 'singular_name' );
			}

			return $result;
		}

		/**
		 * Get taxonomy information
		 *
		 * @param string $taxonomy The name of the taxonomy
		 * @param string $info     Field of metadata want to retrieve
		 *
		 * @return string | array
		 */
		static function taxonomy_info( $taxonomy, $info ) {
			$data = get_taxonomy( $taxonomy );

			if ( isset( $data->$info ) ) {
				$result = $data->$info;
			} else {
				if ( isset( $data->labels->$info ) ) {
					$result = __( $data->labels->$info, PT_CV_TEXTDOMAIN );
				}
			}

			return isset( $result ) ? $result : NULL;
		}

		/**
		 * Get terms of one/many taxonomies
		 *
		 * @param string $taxonomy            The name of the taxonomy
		 * @param string $terms_of_taxonomies Array of terms of taxonomies
		 * @param array  $args                Array of query parameters
		 */
		static function term_of_taxonomy( $taxonomy, &$terms_of_taxonomies, $args = array() ) {
			$args	 = array_merge( array( 'hide_empty' => false ), $args );
			$terms	 = get_terms( array( $taxonomy ), $args );

			$term_slug_name = array();
			foreach ( $terms as $term ) {
				$term_slug_name[ PT_CV_Functions::term_slug_sanitize( $term->slug ) ] = $term->name;
			}

			// Sort values of param by saved order
			$term_slug_name = apply_filters( PT_CV_PREFIX_ . 'settings_sort_single', $term_slug_name, $taxonomy . '-' . 'terms' );

			$terms_of_taxonomies[ $taxonomy ] = $term_slug_name;
		}

		/**
		 * Yes no options
		 *
		 * @return array
		 */
		static function yes_no( $key = '', $value = '' ) {
			$result = array(
				'yes'	 => __( 'Yes', PT_CV_TEXTDOMAIN ),
				'no'	 => __( 'No', PT_CV_TEXTDOMAIN ),
			);
			if ( !empty( $key ) ) {
				return array( $key => empty( $value ) ? $result[ $key ] : $value );
			}

			return $result;
		}

		/**
		 * Show Hide options
		 *
		 * @return array
		 */
		static function show_hide() {
			return array(
				'show'	 => __( 'Show', PT_CV_TEXTDOMAIN ),
				'hide'	 => __( 'Hide', PT_CV_TEXTDOMAIN ),
			);
		}

		/**
		 * Paging types
		 *
		 * @return array
		 */
		static function pagination_types() {
			$result = array(
				'ajax'	 => __( 'Ajax', PT_CV_TEXTDOMAIN ),
				'normal' => __( 'Normal', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'pagination_types', $result );

			return $result;
		}

		/**
		 * Paging styles
		 *
		 * @return array
		 */
		static function pagination_styles() {
			$result = array(
				'regular' => __( 'Numbered pagination', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'pagination_styles', $result );

			return $result;
		}

		/**
		 * Order options
		 *
		 * @return array
		 */
		static function orders() {
			return array(
				'asc'	 => __( 'Ascending', PT_CV_TEXTDOMAIN ),
				'desc'	 => __( 'Descending', PT_CV_TEXTDOMAIN ),
			);
		}

		/**
		 * List post status
		 */
		static function post_statuses() {
			return array(
				'publish'	 => __( 'Publish', PT_CV_TEXTDOMAIN ),
				'pending'	 => __( 'Pending', PT_CV_TEXTDOMAIN ),
				'draft'		 => __( 'Draft', PT_CV_TEXTDOMAIN ),
				'auto-draft' => __( 'Auto draft', PT_CV_TEXTDOMAIN ),
				'future'	 => __( 'Future', PT_CV_TEXTDOMAIN ),
				'private'	 => __( 'Private', PT_CV_TEXTDOMAIN ),
				'inherit'	 => __( 'Inherit', PT_CV_TEXTDOMAIN ),
				'trash'		 => __( 'Trash', PT_CV_TEXTDOMAIN ),
			);
		}

		/**
		 * Advanced filters options
		 *
		 * @return array
		 */
		static function advanced_settings() {
			return apply_filters(
				PT_CV_PREFIX_ . 'advanced_settings', array(
				'taxonomy'	 => __( 'Taxonomy (Categories, Tags...)', PT_CV_TEXTDOMAIN ),
				'status'	 => __( 'Status', PT_CV_TEXTDOMAIN ),
				'order'		 => __( 'Order', PT_CV_TEXTDOMAIN ),
				'search'	 => __( 'Search', PT_CV_TEXTDOMAIN ),
				'author'	 => __( 'Author', PT_CV_TEXTDOMAIN ),
				)
			);
		}

		/**
		 * Show WP author dropdown list by WP wp_dropdown_users functions
		 *
		 * @return array
		 */
		static function post_author( $name = 'author', $data = array() ) {
			$field_name	 = PT_CV_PREFIX . $name;
			$selected	 = isset( $data[ $field_name ] ) ? $data[ $field_name ] : '';

			return wp_dropdown_users( array( 'name' => $field_name, 'selected' => $selected, 'class' => 'form-control', 'show_option_none' => __( '- Select -', PT_CV_TEXTDOMAIN ), 'echo' => false ) );
		}

		/**
		 * Show WP author dropdown list
		 *
		 * @return array
		 */
		static function user_list() {

			$result	 = array();
			$show	 = 'display_name';

			$args = array(
				'fields'	 => array( 'ID', $show ),
				'orderby'	 => 'display_name',
				'order'		 => 'ASC',
			);

			$users = get_users( $args );
			foreach ( (array) $users as $user ) {
				$user->ID	 = (int) $user->ID;
				$display	 = !empty( $user->$show ) ? $user->$show : '(' . $user->user_login . ')';

				$result[ $user->ID ] = esc_html( $display );
			}

			return $result;
		}

		/**
		 * Get available filters for Order by Content item
		 */
		static function post_regular_orderby() {
			$regular_orderby = array(
				''			 => __( '- Select -', PT_CV_TEXTDOMAIN ),
				'ID'		 => __( 'ID', PT_CV_TEXTDOMAIN ),
				'title'		 => __( 'Title', PT_CV_TEXTDOMAIN ),
				'date'		 => __( 'Created date', PT_CV_TEXTDOMAIN ),
				'modified'	 => __( 'Modified date', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'regular_orderby', $regular_orderby );

			return $result;
		}

		/**
		 * View type options
		 *
		 * @return array
		 */
		static function view_type() {

			$view_type = array(
				'grid'			 => __( 'Grid', PT_CV_TEXTDOMAIN ),
				'collapsible'	 => __( 'Collapsible List', PT_CV_TEXTDOMAIN ),
				'scrollable'	 => __( 'Scrollable List', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'view_type', $view_type );

			return $result;
		}

		/**
		 * Settings of All View Types
		 *
		 * @return array
		 */
		static function view_type_settings() {

			$view_type_settings = array();

			// Settings of Grid type
			$view_type_settings[ 'grid' ] = PT_CV_Settings::view_type_settings_grid();

			// Settings of Collapsible type
			$view_type_settings[ 'collapsible' ] = PT_CV_Settings::view_type_settings_collapsible();

			// Settings of Scrollable type
			$view_type_settings[ 'scrollable' ] = PT_CV_Settings::view_type_settings_scrollable();

			$result = apply_filters( PT_CV_PREFIX_ . 'view_type_settings', $view_type_settings );

			return $result;
		}

		/**
		 * Layout format options
		 *
		 * @return array
		 */
		static function layout_format() {

			$result = array(
				'1-col'	 => __( '1 column &#8212; show all fields in one column', PT_CV_TEXTDOMAIN ),
				'2-col'	 => __( '2 columns &#8212; show thumbnail on the left/right side of other fields', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'layout_format', $result );

			return $result;
		}

		/**
		 * Open in options
		 */
		static function open_in() {

			$open_in = array(
				'_self'	 => __( 'Current tab', PT_CV_TEXTDOMAIN ),
				'_blank' => __( 'New tab', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'open_in', $open_in );

			return $result;
		}

		/**
		 * Get all thumbnail sizes
		 */
		static function field_thumbnail_sizes( $_size_name = '' ) {
			// All available thumbnail sizes
			global $_wp_additional_image_sizes;

			$result				 = $sizes_to_sort		 = $dimensions_to_sort	 = array();

			foreach ( get_intermediate_image_sizes() as $size_name ) {
				if ( in_array( $size_name, array( 'thumbnail', 'medium', 'large' ) ) ) {
					$this_size	 = array();
					$this_size[] = get_option( $size_name . '_size_w' );
					$this_size[] = get_option( $size_name . '_size_h' );

					// Add official sizes to result
					$result[ $size_name ] = ucfirst( $size_name ) . ' (' . implode( ' &times; ', $this_size ) . ')';
				} else {
					if ( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $size_name ] ) ) {

						$this_size				 = array();
						$this_size[ 'width' ]	 = $_wp_additional_image_sizes[ $size_name ][ 'width' ];
						$this_size[ 'height' ]	 = $_wp_additional_image_sizes[ $size_name ][ 'height' ];

						// Calculate sizes value for sorting
						$sizes_value = intval( $this_size[ 'width' ] ) * intval( $this_size[ 'height' ] ) + rand( 1, 10 );

						$dimensions_to_sort[ $sizes_value ] = $size_name;
					} else {
						$this_size = array( 0, 0 );
					}

					$sizes_to_sort[ $size_name ] = ucfirst( preg_replace( '/[\-_]/', ' ', $size_name ) ) . ' (' . implode( ' &times; ', $this_size ) . ')';
				}

				if ( !empty( $_size_name ) && $_size_name == $size_name ) {
					return $this_size;
				}
			}
			// Add full sizes
			$result[ 'full' ] = __( 'Full image', PT_CV_TEXTDOMAIN );

			// Sort custom sizes by index (width * height)
			krsort( $dimensions_to_sort );

			// Get array element in ASC sorted order
			foreach ( array_reverse( $dimensions_to_sort ) as $size_name ) {
				$result[ $size_name ] = $sizes_to_sort[ $size_name ];
			}

			$result = apply_filters( PT_CV_PREFIX_ . 'field_thumbnail_sizes', $result );

			return $result;
		}

		/**
		 * Tab Position
		 *
		 * @return array
		 */
		static function tab_position() {

			$tab_position = array(
				'top'	 => __( 'Top', PT_CV_TEXTDOMAIN ),
				'left'	 => __( 'Left', PT_CV_TEXTDOMAIN ),
				'bottom' => __( 'Bottom', PT_CV_TEXTDOMAIN ),
				'right'	 => __( 'Right', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'tab_position', $tab_position );

			return $result;
		}

		/**
		 * Thumbnail Position
		 *
		 * @return array
		 */
		static function thumbnail_position() {

			$thumbnail_position = array(
				'left'	 => __( 'Left', PT_CV_TEXTDOMAIN ),
				'right'	 => __( 'Right', PT_CV_TEXTDOMAIN ),
			);

			$result = apply_filters( PT_CV_PREFIX_ . 'thumbnail_position', $thumbnail_position );

			return $result;
		}

	}

}