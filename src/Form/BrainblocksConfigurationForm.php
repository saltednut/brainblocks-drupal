<?php

namespace Drupal\brainblocks\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure Amplitude settings for the site.
 */
class BrainblocksConfigurationForm extends ConfigFormBase {

  /**
   * Constructs a \Drupal\as_tracking\Form\AmplitudeApiForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'brainblocks_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('brainblocks.settings');
    $form['xrb_address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('XRB Address'),
      '#default_value' => $config->get('xrb_address'),
      '#required' => TRUE,
      '#size' => 75,
    ];
    $options = [];
    $currencies = explode(', ', 'rai, aud, brl, cad, chf, clp, cny, czk, dkk, eur, gbp, hkd, huf, idr, ils, inr, jpy, krw, mxn, myr, nok, nzd, php, pkr, pln, rub, sek, sgd, thb, try, usd, twd, zar');
    foreach ($currencies as $key) {
      $options[$key] = $key;
    }
    $form['currency'] = [
      '#type' => 'select',
      '#title' => $this->t('Currency'),
      '#default_value' => $config->get('currency'),
      '#required' => TRUE,
      '#options' => $options,
    ];
    $form['amount'] = [
      '#type' => 'number',
      '#title' => $this->t('Amount'),
      '#default_value' => $config->get('amount'),
      '#required' => TRUE,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $config = $this->config('brainblocks.settings');
    $config->set('xrb_address', $form_state->getValue('xrb_address'));
    $config->set('currency', $form_state->getValue('currency'));
    $config->set('amount', $form_state->getValue('amount'));
    $config->save();
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['brainblocks.settings'];
  }

}

