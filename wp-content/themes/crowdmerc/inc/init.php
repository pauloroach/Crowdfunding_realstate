<?php

if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );

class crowdmerc_Theme_Includes {

	private static $rel_path	 = null;
	private static $initialized	 = false;

	public static function init() {

		if(class_exists('XsCustomPost\Xs_CustomPost')){

			/**
			 *
			 * Faq Custom Post And Taxonomies
			 *
			 */
			
			$faq = new XsCustomPost\Xs_CustomPost('crowdmerc');
    		$faq->xs_init('faq', 'Faq', 'Faq', array('menu_icon' => 'dashicons-format-aside','supports'=>array('title','editor')));
    		/**
    		 *
    		 * Event
    		 *
    		 */
    		
    		$faq = new XsCustomPost\Xs_CustomPost('crowdmerc');
    		$faq->xs_init('event', 'Event', 'Events', array('menu_icon' => 'dashicons-format-aside'));
            $tab_tax = new  XsCustomPost\Xs_Taxonomies('crowdmerc');
            $tab_tax->xs_init('event_cat', 'Category', 'Categories', 'event');
    	}

		if ( self::$initialized ) {
			return;
		} else {
			self::$initialized = true;
		}

		/**
		 * Both frontend and backend
		 */ {
			self::include_child_first( '/xs-crowdfunding.php' );
			self::include_child_first( '/helpers.php' );
			self::include_child_first( '/hooks.php' );
			self::include_child_first( '/includes/enqueue-inline.php' );
			self::include_child_first( '/includes/plugin-activator.php' );
			self::include_child_first( '/includes/template-tags.php' );
			self::include_child_first( '/includes/option-types.php' );
			self::include_child_first( '/shortcode/elementor.php' );
			self::include_child_first( '/customizer/customizer-config.php' );

			add_action( 'init', array( __CLASS__, '_action_init' ) );
			add_action('widgets_init', array(__CLASS__, '_action_widgets_init'));
		}

		/**
		 * Only frontend
		 */
		if ( !is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( __CLASS__, '_action_enqueue_scripts' ), 20 // Include later to be able to make wp_dequeue_style|script()
			);
		} else { //ar
			// for include back-end files
			add_action( 'admin_enqueue_scripts', array( __CLASS__, '_action_enqueue_admin_scripts' ), 20 // Include later to be able to make wp_dequeue_style|script()
			);
		}
	}

	private static function get_rel_path( $append = '' ) {
		if ( self::$rel_path === null ) {
			self::$rel_path = '/inc';
		}

		return self::$rel_path . $append;
	}

	/**
	 * @param string $dirname 'foo-bar'
	 * @return string 'Foo_Bar'
	 */
	private static function dirname_to_classname( $dirname ) {
		$class_name	 = explode( '-', $dirname );
		$class_name	 = array_map( 'ucfirst', $class_name );
		$class_name	 = implode( '_', $class_name );

		return $class_name;
	}

	public static function get_parent_path( $rel_path ) {
		return get_template_directory() . self::get_rel_path( $rel_path );
	}

	public static function get_child_path( $rel_path ) {
		if ( !is_child_theme() ) {
			return null;
		}

		return get_stylesheet_directory() . self::get_rel_path( $rel_path );
	}

	public static function include_isolated( $path ) {
        include $path;
	}

	public static function include_child_first( $rel_path ) {
		if ( is_child_theme() ) {
			$path = self::get_child_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		} {
			$path = self::get_parent_path( $rel_path );

			if ( file_exists( $path ) ) {
				self::include_isolated( $path );
			}
		}
	}

	/**
	 * @internal
	 */
	public static function _action_enqueue_scripts() {
		self::include_child_first( '/static.php' );
	}

	/**
	 * @internal
	 * ar
	 */
	public static function _action_enqueue_admin_scripts() {
		self::include_child_first( '/admin-static.php' );
	}

	/**
	 * @internal
	 */
	public static function _action_init() {
		self::include_child_first( '/menus.php' );
		self::include_child_first( '/posts.php' );
	}
	
	/**
	 * @internal
	 */
	public static function _action_widgets_init()
	{
		{
			$paths = array();

			if (is_child_theme()) {
				$paths[] = self::get_child_path('/widgets');
			}

			 $paths[] = self::get_parent_path('/widgets');
		}

		$included_widgets = array();

		foreach ($paths as $path) {
			$dirs = glob($path .'/*', GLOB_ONLYDIR);

			if (!$dirs) {
				continue;
			}

			foreach ($dirs as $dir) {
				$dirname = basename($dir);

				if (isset($included_widgets[$dirname])) {
					// this happens when a widget in child theme wants to overwrite the widget from parent theme
					continue;
				} else {
					$included_widgets[$dirname] = true;
				}

				self::include_isolated($dir .'/class-widget-'. $dirname .'.php');

				register_widget('Crowdmerc_'. self::dirname_to_classname($dirname));
			}
		}
	}

}

crowdmerc_Theme_Includes::init();

