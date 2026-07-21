#!/bin/zsh
set -e

SCRIPT_DIR="${0:A:h}"
REMOTE_PATH_DEFAULT="live/homepage/content"
LOCAL_PATH_DEFAULT="$SCRIPT_DIR/content"
LOG_FILE="$SCRIPT_DIR/content-sync.log"

echo "=== ALL-INKL Content-Sync ==="
echo

read "HOST?FTP-Host: "

read "REMOTE_PATH?Remote-Pfad zum content-Ordner (Enter für Default: $REMOTE_PATH_DEFAULT): "
REMOTE_PATH=${REMOTE_PATH:-$REMOTE_PATH_DEFAULT}

read "LOCAL_PATH?Lokales Zielverzeichnis (Enter für Default: $LOCAL_PATH_DEFAULT): "
LOCAL_PATH=${LOCAL_PATH:-$LOCAL_PATH_DEFAULT}
LOCAL_PATH="${LOCAL_PATH%/}"

if grep -q "machine $HOST" "$HOME/.netrc" 2>/dev/null; then
  echo "Gespeicherte Zugangsdaten für $HOST gefunden."
  USE_NETRC=1
else
  read "FTP_USER?FTP-Username: "
  read -s "FTP_PASS?FTP-Passwort: "
  echo
  read "SAVE?Zugangsdaten in ~/.netrc speichern für nächstes Mal? (j/n): "
  if [[ "$SAVE" == "j" ]]; then
    touch "$HOME/.netrc"
    chmod 600 "$HOME/.netrc"
    { echo "machine $HOST"; echo "login $FTP_USER"; echo "password $FTP_PASS"; echo; } >> "$HOME/.netrc"
  fi
  USE_NETRC=0
fi

echo
echo "--- Zusammenfassung ---"
echo "Host:   $HOST"
echo "Remote: $REMOTE_PATH"
echo "Lokal:  $LOCAL_PATH"
echo "-----------------------"
read "CONFIRM?Sync starten? (j/n): "
if [[ "$CONFIRM" != "j" ]]; then
  echo "Abgebrochen."
  read "?Enter zum Schließen..."
  exit 0
fi

if [[ -d "$LOCAL_PATH" ]]; then
  PARENT_DIR="$(dirname "$LOCAL_PATH")"
  BACKUP_NAME="_content-$(date +%y%m%d)"
  BACKUP_PATH="$PARENT_DIR/$BACKUP_NAME"
  if [[ -e "$BACKUP_PATH" ]]; then
    BACKUP_PATH="$PARENT_DIR/${BACKUP_NAME}-$(date +%H%M)"
  fi
  mv "$LOCAL_PATH" "$BACKUP_PATH"
  echo "Vorheriger Stand gesichert nach: $BACKUP_PATH"
fi

mkdir -p "$LOCAL_PATH"

START_TIME=$(date +%s)

if [[ "$USE_NETRC" == "1" ]]; then
  lftp "$HOST" -e "set net:timeout 10; set net:max-retries 3; mirror --verbose --parallel=4 '$REMOTE_PATH' '$LOCAL_PATH'; quit"
else
  lftp -u "$FTP_USER,$FTP_PASS" "$HOST" -e "set net:timeout 10; set net:max-retries 3; mirror --verbose --parallel=4 '$REMOTE_PATH' '$LOCAL_PATH'; quit"
fi

END_TIME=$(date +%s)
DURATION=$((END_TIME - START_TIME))
FILE_COUNT=$(find "$LOCAL_PATH" -type f | wc -l | tr -d ' ')

mkdir -p "$(dirname "$LOG_FILE")"
echo "$(date '+%Y-%m-%d %H:%M:%S') | $HOST/$REMOTE_PATH -> $LOCAL_PATH | $FILE_COUNT Dateien | ${DURATION}s" >> "$LOG_FILE"

echo
echo "Fertig: $FILE_COUNT Dateien in ${DURATION}s synchronisiert."

BACKUP_DIR="$(dirname "$LOCAL_PATH")"
BACKUP_COUNT=$(find "$BACKUP_DIR" -maxdepth 1 -type d -name "_content-*" | wc -l | tr -d ' ')
if [[ "$BACKUP_COUNT" -gt 0 ]]; then
  BACKUP_SIZE=$(du -ch "$BACKUP_DIR"/_content-* 2>/dev/null | tail -1 | cut -f1)
  echo "Hinweis: $BACKUP_COUNT alte Backups belegen insgesamt $BACKUP_SIZE (manuell aufräumen unter $BACKUP_DIR)."
fi

osascript -e 'display notification "Content-Sync abgeschlossen" with title "ALL-INKL Sync"' 2>/dev/null || true

echo
read "?Enter zum Schließen..."
