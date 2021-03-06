<?php

namespace Drupal\dollop\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form for creating/ editing Product entities.
 *
 */

class ProductForm extends ContentEntityForm
{

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state) {
        $entity = &$this->entity;

        $status = parent::save($form, $form_state);

        // the following switch statement overrides the parent form, adding custom messages
        switch ($status) {
            case SAVED_NEW:
                drupal_set_message($this->t('Created the %label Product.', [
                    '%label' => $entity->label(),
                ]));
                break;

            default:
                drupal_set_message($this->t('Saved the %label Product.', [
                    '%label' => $entity->label(),
                ]));
        }
        $form_state->setRedirect('entity.product.canonical', ['product' =>$entity->id()]);
    }

}