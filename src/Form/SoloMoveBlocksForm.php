<?php

namespace Drupal\solo_move_blocks\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * SoloMoveBlocsForm Class.
 */
class SoloMoveBlocksForm extends FormBase {

  /**
   * Return FormId.
   */
  public function getFormId() {
    return 'solo_move_blocks_form';
  }

  /**
   * Build Form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#markup' => $this->t('Use this form to migrate blocks from the default theme to the solo theme.'),
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Migrate Blocks'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * Submit the Form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Get the default theme and use it as the source theme.
    $default_theme = \Drupal::config('system.theme')->get('default');
    _solo_move_blocks_move_blocks_and_config_between_themes($default_theme, 'solo', 'footer_menu');
  }

}
