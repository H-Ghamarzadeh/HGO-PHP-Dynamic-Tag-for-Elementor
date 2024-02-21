<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_PHP_Code extends \Elementor\Core\DynamicTags\Tag {

	public function get_name() {
		return 'php-code-runner';
	}

	public function get_title() {
		return  'PHP Code Runner';
	}

	public function get_group() {
		return [ 'hgo-dynamic-tag' ];
	}

	public function get_categories() {
		return [ 
			\Elementor\Modules\DynamicTags\Module::POST_META_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::GALLERY_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::COLOR_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
			\Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY
		];
	}
	
	protected function register_controls() {
		$this->add_control(
			'php_code',
			[
				'label' => 'Your PHP Code',
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'php',
				'default' => 'echo "Hello World!";',
				'rows' => 20,
			]
		);
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		if (empty($settings)) {
            return;
        }
        $error = \false;
        try {
            @eval($settings['php_code']);
        } catch (\ParseError $e) {
            $error = $e->getMessage();
        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
        if ($error && \Elementor\Plugin::$instance->editor->is_edit_mode()) {
            echo '<strong>';
            echo 'Please check your PHP code';
            echo '</strong><br />';
            echo 'ERROR' . ': ' . $error, "\n";
        }
	}

}