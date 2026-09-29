#!/usr/bin/env python3
"""Download a full offline backup of the cards.kuzub.com database.

Saves two files in backups/ (git-ignored):
  cards-YYYYmmdd-HHMMSS.json  raw data
  cards-YYYYmmdd-HHMMSS.sql   restorable dump (import via phpMyAdmin)

The backup key is read from the CARDS_BACKUP_TOKEN environment variable or the
.backup_token file in the repo root; it must match the BACKUP_TOKEN GitHub secret.

Usage: python3 tools/backup_db.py
"""
import json
import os
import sys
import urllib.error
import urllib.request
from datetime import datetime
from pathlib import Path

URL = "https://cards.kuzub.com/api.php?action=backup"
ROOT = Path(__file__).resolve().parent.parent
# Restore order respects foreign keys
TABLE_ORDER = ["cards", "users", "collections", "user_collection"]


def read_token():
    token = os.environ.get("CARDS_BACKUP_TOKEN")
    if not token:
        token_file = ROOT / ".backup_token"
        if not token_file.exists():
            sys.exit("No backup key: set CARDS_BACKUP_TOKEN or create .backup_token")
        token = token_file.read_text().strip()
    return token


def fetch(token):
    request = urllib.request.Request(URL, headers={"X-Backup-Token": token, "User-Agent": "cards-backup"})
    try:
        with urllib.request.urlopen(request, timeout=60) as response:
            return json.load(response)
    except urllib.error.HTTPError as e:
        sys.exit(f"Backup failed: HTTP {e.code} {e.read().decode(errors='replace')}")


def sql_value(value):
    if value is None:
        return "NULL"
    if isinstance(value, (int, float)):
        return str(value)
    escaped = str(value).replace("\\", "\\\\").replace("'", "\\'").replace("\n", "\\n").replace("\r", "\\r")
    return f"'{escaped}'"


def to_sql(data):
    lines = [
        f"-- cards.kuzub.com backup of {data['database']} taken {data['created_at']}",
        "SET NAMES utf8mb4;",
        "SET FOREIGN_KEY_CHECKS = 0;",
    ]
    for table in TABLE_ORDER:
        info = data["tables"][table]
        lines += ["", f"DROP TABLE IF EXISTS `{table}`;", info["create"] + ";"]
        for row in info["rows"]:
            columns = ", ".join(f"`{c}`" for c in row)
            values = ", ".join(sql_value(v) for v in row.values())
            lines.append(f"INSERT INTO `{table}` ({columns}) VALUES ({values});")
    lines += ["", "SET FOREIGN_KEY_CHECKS = 1;", ""]
    return "\n".join(lines)


def main():
    data = fetch(read_token())
    out_dir = ROOT / "backups"
    out_dir.mkdir(exist_ok=True)
    stamp = datetime.now().strftime("%Y%m%d-%H%M%S")
    json_path = out_dir / f"cards-{stamp}.json"
    sql_path = out_dir / f"cards-{stamp}.sql"
    json_path.write_text(json.dumps(data, indent=2, ensure_ascii=False), encoding="utf-8")
    sql_path.write_text(to_sql(data), encoding="utf-8")
    for table in TABLE_ORDER:
        print(f"{table:16} {len(data['tables'][table]['rows']):5} rows")
    print(f"Saved {json_path.relative_to(ROOT)} and {sql_path.relative_to(ROOT)}")


if __name__ == "__main__":
    main()
