#!/bin/sh
set -e

PORT_TO_USE="${PORT:-8080}"

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

sed -i "s/Listen 80/Listen ${PORT_TO_USE}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT_TO_USE}/" /etc/apache2/sites-available/000-default.conf

apache2-foreground
