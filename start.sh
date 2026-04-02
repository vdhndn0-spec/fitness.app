#!/bin/sh
set -e

PORT_TO_USE="${PORT:-8080}"

try_db_init() {
  if [ -z "${DB_HOST:-}" ] || [ -z "${DB_USER:-}" ] || [ -z "${DB_NAME:-}" ]; then
    echo "DB init: DB_HOST/DB_USER/DB_NAME not set, skipping SQL import"
    return 0
  fi

  if [ ! -f /var/www/html/database/fitness.sql ]; then
    echo "DB init: /var/www/html/database/fitness.sql not found, skipping SQL import"
    return 0
  fi

  if ! command -v mysql >/dev/null 2>&1; then
    echo "DB init: mysql client not found in container, skipping SQL import"
    return 0
  fi

  DB_PORT_TO_USE="${DB_PORT:-3306}"

  echo "DB init: waiting for MySQL at ${DB_HOST}:${DB_PORT_TO_USE}..."
  i=0
  while [ $i -lt 30 ]; do
    if MYSQL_PWD="${DB_PASS:-}" mysql --protocol=TCP --connect-timeout=5 -h"${DB_HOST}" -P"${DB_PORT_TO_USE}" -u"${DB_USER}" -e "SELECT 1" >/dev/null 2>&1; then
      break
    fi
    i=$((i + 1))
    sleep 2
  done

  if ! MYSQL_PWD="${DB_PASS:-}" mysql --protocol=TCP --connect-timeout=5 -h"${DB_HOST}" -P"${DB_PORT_TO_USE}" -u"${DB_USER}" -e "SELECT 1" >/dev/null 2>&1; then
    echo "DB init: could not connect to MySQL, skipping SQL import"
    return 0
  fi

  MYSQL_PWD="${DB_PASS:-}" mysql --protocol=TCP -h"${DB_HOST}" -P"${DB_PORT_TO_USE}" -u"${DB_USER}" -e "CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" >/dev/null 2>&1 || true

  table_count=$(MYSQL_PWD="${DB_PASS:-}" mysql --protocol=TCP -N -s -h"${DB_HOST}" -P"${DB_PORT_TO_USE}" -u"${DB_USER}" -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${DB_NAME}';" 2>/dev/null || echo "")
  if [ -n "${table_count}" ] && [ "${table_count}" -gt 0 ] 2>/dev/null; then
    echo "DB init: ${DB_NAME} already has ${table_count} tables, skipping SQL import"
    return 0
  fi

  echo "DB init: importing /var/www/html/database/fitness.sql into ${DB_NAME}..."
  if MYSQL_PWD="${DB_PASS:-}" mysql --protocol=TCP -h"${DB_HOST}" -P"${DB_PORT_TO_USE}" -u"${DB_USER}" "${DB_NAME}" < /var/www/html/database/fitness.sql; then
    echo "DB init: import done"
  else
    echo "DB init: import failed (continuing to start Apache)"
  fi
}

try_db_init || true

# Railway/containers can occasionally end up with multiple MPM modules enabled.
# Force a single MPM (prefork) right before starting Apache.
rm -f /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf || true
if command -v a2enmod >/dev/null 2>&1; then
  a2enmod mpm_prefork >/dev/null 2>&1 || true
  a2dismod mpm_event >/dev/null 2>&1 || true
  a2dismod mpm_worker >/dev/null 2>&1 || true
fi

echo "Enabled MPM files:"
ls -la /etc/apache2/mods-enabled/ | grep -i mpm || true

if [ -f /etc/apache2/apache2.conf ] && ! grep -qE '^[[:space:]]*ServerName[[:space:]]+' /etc/apache2/apache2.conf; then
  echo "ServerName localhost" >> /etc/apache2/apache2.conf
fi

sed -i "s/Listen 80/Listen ${PORT_TO_USE}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT_TO_USE}/" /etc/apache2/sites-available/000-default.conf

apache2-foreground
