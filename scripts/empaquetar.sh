#!/usr/bin/env bash
set -euo pipefail

raiz="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")/.." && pwd)"
destino="${1:-$raiz/dist/nitro-sesiones.zip}"
mkdir -p "$(dirname -- "$destino")"
destino="$(cd -- "$(dirname -- "$destino")" && pwd)/$(basename -- "$destino")"
temporal="$(mktemp -d)"
trap 'rm -rf -- "$temporal"' EXIT
cd "$raiz"
LC_ALL=C find nitro-sesiones -type f \( -name '*.php' -o -name '*.json' -o -name '*.tsv' -o -name '*.css' -o -name '*.js' \) |
    LC_ALL=C sort | zip -X -q "$temporal/nitro-sesiones.zip" -@
unzip -tq "$temporal/nitro-sesiones.zip"
mv -f -- "$temporal/nitro-sesiones.zip" "$destino"
printf '%s\n' "$destino"
