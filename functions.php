<?php

include_once 'config.php';

// Verbindung zur Datenbank herstellen
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
  die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

/**
 * Fügt einen neuen Benutzer zur Datenbank hinzu.
 *
 * @param string $benutzername Der Benutzername des Benutzers.
 * @param string $email Die E-Mail-Adresse des Benutzers.
 * @param string $passwort Das Passwort des Benutzers.
 *
 * @return boolean TRUE, wenn der Benutzer erfolgreich hinzugefügt wurde, ansonsten FALSE.
 */
function add_user($benutzername, $email, $passwort) {
  global $conn;

  $stmt = $conn->prepare("INSERT INTO benutzer (benutzername, email, passwort) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $benutzername, $email, $passwort);

  return $stmt->execute();
}

/**
 * Holt alle Benutzer aus der Datenbank.
 *
 * @return array Ein Array mit allen Benutzern.
 */
function get_users() {
  global $conn;

  $result = $conn->query("SELECT * FROM benutzer");

  if ($result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  } else {
    return array();
  }
}
/**
 * Holt einen Benutzer aus der Datenbank anhand seiner ID.
 *
 * @param int $id Die ID des Benutzers.
 *
 * @return array Das Array mit den Benutzerdaten.
 */
function get_user($id) {
  global $conn;

  $stmt = $conn->prepare("SELECT * FROM benutzer WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return array();
  }
}

/**
 * Aktualisiert einen Benutzer in der Datenbank anhand seiner ID.
 *
 * @param int $id Die ID des Benutzers.
 * @param string $benutzername Der Benutzername des Benutzers.
 * @param string $email Die E-Mail-Adresse des Benutzers.
 * @param string $passwort Das Passwort des Benutzers.
 *
 * @return boolean TRUE, wenn der Benutzer erfolgreich aktualisiert wurde, ansonsten FALSE.
 */
function update_user($id, $benutzername, $email, $passwort) {
  global $conn;

  $stmt = $conn->prepare("UPDATE benutzer SET benutzername = ?, email = ?, passwort = ? WHERE id = ?");
  $stmt->bind_param("sssi", $benutzername, $email, $passwort, $id);

  return $stmt->execute();
}

/**
 * Löscht einen Benutzer aus der Datenbank anhand seiner ID.
 *
 * @param int $id Die ID des Benutzers.
 *
 * @return boolean TRUE, wenn der Benutzer erfolgreich gelöscht wurde, ansonsten FALSE.
 */
function delete_user($id) {
  global $conn;

  $stmt = $conn->prepare("DELETE FROM benutzer WHERE id = ?");
  $stmt->bind_param("i", $id);

  return $stmt->execute();
}

/**
 * Fügt einen neuen Beitrag zur Datenbank hinzu.
 *
 * @param int $benutzer_id Die ID des Benutzers, der den Beitrag erstellt hat.
 * @param string $titel Der Titel des Beitrags.
 * @param string $link Der Link zum Video.
 *
 * @return boolean TRUE, wenn der Beitrag erfolgreich hinzugefügt wurde, ansonsten FALSE.
 */
function add_post($benutzer_id, $titel, $link) {
  global $conn;

  $stmt = $conn->prepare("INSERT INTO beitraege (benutzer_id, titel, link) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $benutzer_id, $titel, $link);

  return $stmt->execute();
}

/**
 * Holt alle Beiträge aus der Datenbank.
 *
 * @return array Ein Array mit allen Beiträgen.
 */
function get_posts() {
  global $conn;

  $result = $conn->query("SELECT * FROM beitraege");

  if ($result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  } else {
    return array();
  }
}

/**
 * Holt alle Beiträge eines Benutzers aus der Datenbank anhand seiner ID.
 *
 * @param int $benutzer_id Die ID des Benutzers.
 *
 * @return array Ein Array mit allen Beiträgen des Benutzers.
 */
function get_posts_by_user($benutzer_id) {
  global $conn;

  $stmt = $conn->prepare("SELECT * FROM beitraege WHERE benutzer_id = ?");
  $stmt->bind_param("i", $benutzer_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  } else {
    return array();
  }
}
/**
 * Holt einen Beitrag aus der Datenbank anhand seiner ID.
 *
 * @param int $id Die ID des Beitrags.
 *
 * @return array Das Array mit den Beitragsdaten.
 */
function get_post($id) {
  global $conn;

  $stmt = $conn->prepare("SELECT * FROM beitraege WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return array();
  }
}
/**
 * Aktualisiert einen Beitrag in der Datenbank anhand seiner ID.
 *
 * @param int $id Die ID des Beitrags.
 * @param int $benutzer_id Die ID des Benutzers, der den Beitrag erstellt hat.
 * @param string $titel Der Titel des Beitrags.
 * @param string $link Der Link zum Video.
 *
 * @return boolean TRUE, wenn der Beitrag erfolgreich aktualisiert wurde, ansonsten FALSE.
 */
function update_post($id, $benutzer_id, $titel, $link) {
  global $conn;

  $stmt = $conn->prepare("UPDATE beitraege SET benutzer_id = ?, titel = ?, link = ? WHERE id = ?");
  $stmt->bind_param("issi", $benutzer_id, $titel, $link, $id);

  return $stmt->execute();
}

/**
 * Löscht einen Beitrag aus der Datenbank anhand seiner ID.
 *
 * @param int $id Die ID des Beitrags.
 *
 * @return boolean TRUE, wenn der Beitrag erfolgreich gelöscht wurde, ansonsten FALSE.
 */
function delete_post($id) {
  global $conn;

  $stmt = $conn->prepare("DELETE FROM beitraege WHERE id = ?");
  $stmt->bind_param("i", $id);

  return $stmt->execute();
}

/**
 * Fügt einen neuen Kommentar zu einem Beitrag in der Datenbank hinzu.
 *
 * @param int $beitrag_id Die ID des Beitrags, zu dem der Kommentar hinzugefügt wird.
 * @param int $benutzer_id Die ID des Benutzers, der den Kommentar erstellt hat.
 * @param string $text Der Text des Kommentars.
 *
 * @return boolean TRUE, wenn der Kommentar erfolgreich hinzugefügt wurde, ansonsten FALSE.
 */
function add_comment($beitrag_id, $benutzer_id, $text) {
  global $conn;

  $stmt = $conn->prepare("INSERT INTO kommentare (beitrag_id, benutzer_id, text) VALUES (?, ?, ?)");
  $stmt->bind_param("iis", $beitrag_id, $benutzer_id, $text);

  return $stmt->execute();
}
/**
 * Holt alle Kommentare zu einem Beitrag aus der Datenbank anhand seiner ID.
 *
 * @param int $beitrag_id Die ID des Beitrags.
 *
 * @return array Ein Array mit allen Kommentaren zu dem Beitrag.
 */
function get_comments($beitrag_id) {
  global $conn;

  $stmt = $conn->prepare("SELECT * FROM kommentare WHERE beitrag_id = ?");
  $stmt->bind_param("i", $beitrag_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    return $result->fetch_all(MYSQLI_ASSOC);
  } else {
    return array();
  }
}

/**
 * Löscht einen Kommentar aus der Datenbank anhand seiner ID.
 *
 * @param int $id Die ID des Kommentars.
 *
 * @return boolean TRUE, wenn der Kommentar erfolgreich gelöscht wurde, ansonsten FALSE.
 */
function delete_comment($id) {
  global $conn;

  $stmt = $conn->prepare("DELETE FROM kommentare WHERE id = ?");
  $stmt->bind_param("i", $id);

  return $stmt->execute();
}

