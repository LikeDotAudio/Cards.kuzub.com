# cards.kuzub.com

Site content lives in `public/` and is deployed over FTPS to the cPanel host on every push to `main` (`.github/workflows/deploy.yml`).

Required repository secrets: `FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`, `DB_NAME`, `DB_USERNAME`, `DB_PASSWORD`. The deploy writes `public/db_config.php` from the DB secrets.
