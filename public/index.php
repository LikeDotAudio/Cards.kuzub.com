<?php
// Root router for Cards.kuzub.com
if (!empty($_COOKIE['cards_session'])) {
    header('Location: collection.php');
} else {
    header('Location: login.php');
}
exit;
