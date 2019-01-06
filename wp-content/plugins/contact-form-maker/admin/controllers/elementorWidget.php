<?php

class FMCElementor extends \Elementor\Widget_Base {
  /**
   * PLUGIN = 2 points to Contact Form Maker
   */
  const PLUGIN = 2;

  /**
   * Get widget name.
   *
   * @return string Widget name.
   */
  public function get_name() {
    return 'fm-elementor';
  }

  /**
   * Get widget title.
   *
   * @return string Widget title.
   */
  public function get_title() {
    return __('Form', WDFMInstance(self::PLUGIN)->prefix);
  }

  /**
   * Get widget icon.
   *
   * @return string Widget icon.
   */
  public function get_icon() {
    return 'fa twbb-form-maker twbb-widget-icon';
  }

  /**
   * Get widget categories.
   *
   * @return array Widget categories.
   */
  public function get_categories() {
    return [ 'tenweb-widgets' ];
  }

  /**
   * Register widget controls.
   */
  protected function _register_controls() {
    $this->start_controls_section(
      'general',
      [
        'label' => __('Form', WDFMInstance(self::PLUGIN)->prefix),
      ]
    );

    $this->add_control(
      'form_id',
      [
        'label_block' => TRUE,
        'show_label' => FALSE,
        'description' => __('Select the form to display.', WDFMInstance(self::PLUGIN)->prefix) . ' <a target="_balnk" href="' . add_query_arg(array( 'page' => 'manage_fmc' ), admin_url('admin.php')) . '">' . __('Edit form', WDFMInstance(self::PLUGIN)->prefix) . '</a>',
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 0,
        'options' => WDW_FM_Library(self::PLUGIN)->get_forms(),
      ]
    );

    $this->end_controls_section();
  }

  /**
   * Render widget output on the frontend.
   */
  protected function render() {
    $settings = $this->get_settings_for_display();

    echo WDFMInstance(self::PLUGIN)->fm_shortcode(array('id' => $settings['form_id']));
  }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new FMCElementor());
