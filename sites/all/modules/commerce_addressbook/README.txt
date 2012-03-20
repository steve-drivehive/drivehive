Description:
============

The Commerce Addressbook module provides a dropdown field that can be attached to customer profile entities.
It allows customers to select a previously entered profile upon checkout, so they don't have to reenter the same information all the time.

Upon selecting an existing address, the selected customer profile entity gets referenced by the order entity, instead of creating a new customer profile entity.
Upon submitting the form, a new customer profile entity is created anyway when the customer updated the information. If the information was not updated, no new customer profile is created (in contrary to standard Drupal Commerce behavior)
This allows for cleaner administration of customer profiles, since it avoids lots of duplicates from recurring clients to your shop.

The dropdown field to select previously entered addresses will be attached by default to customer profile entity types,
such as the default "Billing" profile, or the "Shipping" profile as provided by http://drupal.org/project/commerce_shipping

Installation:
=============

* Enable the Commerce Addresbook module
* Go to admin/commerce/config/addressbook to set options
* Upon activating a new customer profile entity type, the "Saved addresses" field should automatically be attached.
  In case it is not, or you want to attach this field to other entity types (WARNING: untested functionality), you can do so through the normal Field UI.

Developer information:
=======================
Hooks:

hook_commerce_addressbook_label_alter(&$label, $entity)
  This hook allows you to alter the label that is shown in the dropdown list.