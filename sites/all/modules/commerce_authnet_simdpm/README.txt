The Commerce Authorize.Net SIM/DPM Payment Methods module provides two additional
payment methods to Drupal Commerce for users of the Authorize.Net payment processing
service.  These methods are alternatives to the existing AIM payment method for
users who wish to avoid additional PCI validation responsibilities for their
Drupal server, as both send credit card information directly to Authorize.Net and
never report it to Drupal. They may also be useful for those whose Drupal hosting
arrangement makes it difficult to secure their site via SSL.

The SIM method (http://developer.authorize.net/api/sim/) works much like the
familiar PayPal Website Payments Standard service.  Upon checkout, Commerce
displays a secure form hosted by Authorize.net which collects credit card data.
Successful payments are reported by to the Drupal site, without sensitive details,
to allow the order to complete normally.  The secure form may be customized with
a client-specific logo image, if desired.

The DPM method (http://developer.authorize.net/api/dpm) allows the payment form
to be constructed by the Drupal site, but posted directly to Authorize.Net.  It
employs a behind-the-scenes post-and-redirect scheme that makes the checkout
appear seamless to the customer, as though he or she never left the Drupal site.

Configuration
-------------

This payment module may be added and configured via the normal Rules interface.

Both SIM and DPM modes normally use the authorize-and-capture transaction mode,
which fully automates payment handling.  They do support authorize-only mode,
but note that such payments must be subsequently captured via the Authorize.Net
Web interface and manually recorded in Ubercart.

Authorize.Net account settings
------------------------------

It is highly recommended that one choose an MD5 hash key for communication with
Authorize.Net and configure that key in both the payment method settings and in
the Authorize.Net account settings via their Web interface.  The latter is found
at Account -> Settings -> MD5-Hash.

When using SIM mode, it is recommended that one configure the Authorize.Net
hosted payment form to make most fields non-editable.  These settings are found
at Account -> Settings -> Payment Form -> Form Fields.  You will likely want to
make all items displayed non-editable, with the exception of Card Code .  You
normally should make the Fax field and the fields listed under "Additional
Information" non-viewable as well.

JavaScript considerations
-------------------------

Both SIM and DPM modes will function correctly with JavaScript disabled in the
browser.  The DPM checkout process is less seamless without JavaScript, as a
payment processing page will appear for a second or so before redirecting back
to Drupal Commerce.

SSL considerations
------------------

From a technical standpoint, neither SIM nor DPM require SSL on the Drupal site
in order to be fully secure.  From a practical standpoint, there are two caveats:

1)  In DPM mode, clients won't realize that the payment form is being posted via
HTTPS regardless of whether or not that page itself was loaded securely.  If the
payment page (checkout/*/payment) isn't secure, those who notice this will
assume that their payment isn't secure and likely decline to complete checkout.
For this reason, Authorize.Net recommends SSL for shopping carts which use DPM.

2)  In SIM mode, if a custom logo is specified, it normally should be loaded via
HTTPS.  Failure to do this will produce a mixed-security situation on the
Authorize.Net payment form, making that page appear insecure to the customer.

Troubleshooting
---------------

Please note that neither SIM nor DPM transactions can be processed normally when
the Drupal site is off-line.  An error will be displayed by Authorize.Net when
it attempts to redirect back to your site.

Credits
-------

This module is based on a SIM-only implementation originally posted to the
ubercart.org archive by Sarah Azurin (sarah.azurin@gmail.com).  The DPM support
was added by Ritu Agarwal (rituraj05@gmail.com).  Various enhancements and tweaks
were made by me (Jerry Hudgins, jerry@laureldigital.com), including the Drupal
Commerce conversion.
