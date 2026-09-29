# cards.kuzub.com

Site content lives in `public/` and is deployed over FTPS to the cPanel host on every push to `main` (`.github/workflows/deploy.yml`).

Required repository secrets: `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`, `DB_NAME`, `DB_USERNAME`, `DB_PASSWORD`. The deploy writes `public/db_config.php` from the DB secrets.

## Offline backup

`python3 tools/backup_db.py` downloads every table to `backups/` as JSON and a restorable `.sql` dump (import it in phpMyAdmin). It needs the backup key in `.backup_token` (or `CARDS_BACKUP_TOKEN`), matching the `BACKUP_TOKEN` repo secret. Backups contain collectors' secret initials, so keep them private — `backups/` is git-ignored.
