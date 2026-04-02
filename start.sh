#!/bin/sh
set -e

PORT_TO_USE="${PORT:-8080}"

try_db_init() {
  HOST_TO_USE="${DB_HOST:-${MYSQLHOST:-}}"
  USER_TO_USE="${DB_USER:-${MYSQLUSER:-}}"
  PASS_TO_USE="${DB_PASS:-${MYSQLPASSWORD:-}}"
  NAME_TO_USE="${DB_NAME:-${MYSQLDATABASE:-}}"
  PORT_TO_USE_DB="${DB_PORT:-${MYSQLPORT:-3306}}"

  if [ -z "${HOST_TO_USE}" ] || [ -z "${USER_TO_USE}" ] || [ -z "${NAME_TO_USE}" ]; then
    echo "DB init: DB_HOST/DB_USER/DB_NAME (or MYSQLHOST/MYSQLUSER/MYSQLDATABASE) not set, skipping SQL import"
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

  echo "DB init: waiting for MySQL at ${HOST_TO_USE}:${PORT_TO_USE_DB}..."
  i=0
  while [ $i -lt 30 ]; do
    if MYSQL_PWD="${PASS_TO_USE}" mysql --protocol=TCP --connect-timeout=5 -h"${HOST_TO_USE}" -P"${PORT_TO_USE_DB}" -u"${USER_TO_USE}" -e "SELECT 1" >/dev/null 2>&1; then
      break
    fi
    i=$((i + 1))
    sleep 2
  done

  if ! MYSQL_PWD="${PASS_TO_USE}" mysql --protocol=TCP --connect-timeout=5 -h"${HOST_TO_USE}" -P"${PORT_TO_USE_DB}" -u"${USER_TO_USE}" -e "SELECT 1" >/dev/null 2>&1; then
    echo "DB init: could not connect to MySQL, skipping SQL import"
    return 0
  fi

  MYSQL_PWD="${PASS_TO_USE}" mysql --protocol=TCP -h"${HOST_TO_USE}" -P"${PORT_TO_USE_DB}" -u"${USER_TO_USE}" -e "CREATE DATABASE IF NOT EXISTS \`${NAME_TO_USE}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" >/dev/null 2>&1 || true

  table_count=$(MYSQL_PWD="${PASS_TO_USE}" mysql --protocol=TCP -N -s -h"${HOST_TO_USE}" -P"${PORT_TO_USE_DB}" -u"${USER_TO_USE}" -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='${NAME_TO_USE}';" 2>/dev/null || echo "")
  if [ -n "${table_count}" ] && [ "${table_count}" -gt 0 ] 2>/dev/null; then
    echo "DB init: ${NAME_TO_USE} already has ${table_count} tables, skipping SQL import"
    return 0
  fi

  echo "DB init: importing /var/www/html/database/fitness.sql into ${NAME_TO_USE}..."
  if MYSQL_PWD="${PASS_TO_USE}" mysql --protocol=TCP -h"${HOST_TO_USE}" -P"${PORT_TO_USE_DB}" -u"${USER_TO_USE}" "${NAME_TO_USE}" < /var/www/html/database/fitness.sql; then
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
