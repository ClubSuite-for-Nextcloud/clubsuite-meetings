# ClubSuite Meetings

[![Nextcloud Version](https://img.shields.io/badge/Nextcloud-28--32-blue.svg)](https://nextcloud.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1--8.3-purple.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-AGPL%20v3-green.svg)](LICENSE)

> 📋 Professionelle Sitzungs- und Protokollverwaltung für Vereine.

## 📋 Übersicht

ClubSuite Meetings organisiert Ihre Vereinssitzungen:

- **Sitzungsplanung**: Termine, Einladungen, Tagesordnung
- **Protokolle**: Strukturierte Erfassung von Beschlüssen
- **Abstimmungen**: Dokumentation von Abstimmungsergebnissen
- **Archiv**: Durchsuchbares Protokollarchiv
- **PDF-Export**: Professionelle Protokollerstellung

## 🚀 Installation

### Über den Nextcloud App Store
1. **ClubSuite Core** muss installiert sein
2. Apps → Organisation → "ClubSuite Meetings" suchen
3. Installieren und aktivieren

### Manuelle Installation
```bash
cd /path/to/nextcloud/apps
git clone https://github.com/clubsuite/clubsuite-meetings.git
php occ app:enable clubsuite-meetings
```

## 📦 Anforderungen

| Komponente | Version |
|------------|--------|
| Nextcloud | 28 - 32 |
| PHP | 8.1 - 8.3 |
| **clubsuite-core** | erforderlich |

## 🔒 DSGVO / Datenschutz

- Protokolle mit Personenbezug werden geschützt
- Zugriffsrechte nach Rolle
- Datenexport über Nextcloud Privacy API

## 📄 Lizenz

AGPL v3 – Siehe [LICENSE](LICENSE)

## 🐛 Bugs & Feature Requests

[GitHub Issues](https://github.com/clubsuite/clubsuite-meetings/issues)

---

© 2026 Stefan Schulz
