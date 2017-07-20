<?php
  $list_id = "7e2fadsafb";
  $api_key = "80872e1a3fafadfa2dafc1bc1b16f702d-us9";

  include("mailchimp_api.php");
  use \DrewM\MailChimp\MailChimp;

  $MailChimp = new MailChimp($api_key);
  $subscriberHash = $MailChimp->subscriberHash($_POST["email"]);

  $merge_vars = array(
        "NAME"        => $_POST["name"],
        "STATUS"      => $_POST["status"],
        "STOREURL"    => $_POST["storeURL"],
        "COUNTRYCOD"  => $_POST["countryCode"],
        "STARTDATE"   => $_POST["startDate"],
        "EXPIRDATE"   => $_POST["expirationDate"]
    );

  $result = $MailChimp->put("lists/$list_id/members/$subscriberHash", [
    "email_address" => $_POST["email"],
    "merge_fields"  => $merge_vars,
    "status"        => "subscribed",
    "status_if_new" => "subscribed"
  ]);

  if ($MailChimp->success()) {
    echo $MailChimp->success();
  } else {
    echo $MailChimp->getLastError();
  }
?>
