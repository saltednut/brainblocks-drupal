<?php

namespace Drupal\brainblocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Brainblocks XRB Gateway' block.
 *
 * @Block(
 *  id = "brainblocks_block",
 *  admin_label = @Translation("Brainblocks block"),
 * )
 */
class BrainblocksBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return ['#markup' => '<div id="raiblocks-button"></div>'];
  }

}

