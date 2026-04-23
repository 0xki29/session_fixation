# Session Fixation Lab

## Overview
A vulnerable PHP authentication lab demonstrating Session Fixation attack.

## Attack Flow
1. Attacker creates a fixed PHPSESSID
2. Victim logs in with attacker-controlled session
3. Attacker reuses same session ID to hijack account

## Fix
Regenerate session after login:

```php
session_regenerate_id(true);
