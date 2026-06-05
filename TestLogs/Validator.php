<?php

/**
 * Validator — mirrors the server-side validation rules applied in the
 * Admin Dashboard (add_event.php, edit_event.php, admin_login.php).
 *
 * Kept separate so the unit tests can import and exercise it directly.
 */
class Validator
{
    // ── EventName ─────────────────────────────────────────────────────────────

    public static function eventName(string $value): string
    {
        $v = trim($value);
        if ($v === '')       return 'Event name is required.';
        if (strlen($v) < 3)  return 'Event name must be at least 3 characters.';
        if (strlen($v) > 100) return 'Event name cannot exceed 100 characters.';
        return 'ok';
    }

    // ── Location ──────────────────────────────────────────────────────────────

    public static function location(string $value): string
    {
        $v = trim($value);
        if ($v === '')         return 'Location is required.';
        if (strlen($v) > 150) return 'Location cannot exceed 150 characters.';
        return 'ok';
    }

    // ── EventDate ─────────────────────────────────────────────────────────────

    public static function eventDate(string $value): string
    {
        if ($value === '') return 'Event date is required.';
        if ($value < date('Y-m-d')) return 'Event date cannot be in the past.';
        return 'ok';
    }

    // ── EventTime ─────────────────────────────────────────────────────────────

    public static function eventTime(string $value): string
    {
        if (trim($value) === '') return 'Event time is required.';
        return 'ok';
    }

    // ── Description ───────────────────────────────────────────────────────────

    public static function description(string $value): string
    {
        $v = trim($value);
        if ($v === '')          return 'Description is required.';
        if (strlen($v) < 10)   return 'Description must be at least 10 characters.';
        if (strlen($v) > 1000) return 'Description cannot exceed 1000 characters.';
        return 'ok';
    }

    // ── Admin Login ───────────────────────────────────────────────────────────

    public static function adminLogin(string $username, string $password): string
    {
        if (trim($username) === '' || trim($password) === '')
            return 'Username and password are required.';
        return 'ok';
    }
}
