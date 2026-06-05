<?php

/**
 * Minimal JUnit-compatible TestCase base class.
 * Mirrors the API of PHPUnit\Framework\TestCase so tests are
 * compatible with real PHPUnit if installed.
 */
class TestCase
{
    public array $results = [];

    // ── Assertions ────────────────────────────────────────────────────────────

    public function assertEquals($expected, $actual, string $msg = ''): void
    {
        $pass = ($expected === $actual);
        $this->record($pass, 'assertEquals',
            $pass ? '' : "Expected: " . var_export($expected, true)
                      . "\n  Actual:   " . var_export($actual, true)
                      . ($msg ? "\n  Message:  $msg" : ''));
    }

    public function assertNotEquals($expected, $actual, string $msg = ''): void
    {
        $pass = ($expected !== $actual);
        $this->record($pass, 'assertNotEquals',
            $pass ? '' : "Expected values to differ but both were: " . var_export($actual, true)
                      . ($msg ? "\n  Message: $msg" : ''));
    }

    public function assertTrue($condition, string $msg = ''): void
    {
        $this->record((bool)$condition, 'assertTrue',
            $condition ? '' : "Expected TRUE but got FALSE" . ($msg ? " – $msg" : ''));
    }

    public function assertFalse($condition, string $msg = ''): void
    {
        $this->record(!(bool)$condition, 'assertFalse',
            !$condition ? '' : "Expected FALSE but got TRUE" . ($msg ? " – $msg" : ''));
    }

    public function assertContains(string $needle, string $haystack, string $msg = ''): void
    {
        $pass = str_contains($haystack, $needle);
        $this->record($pass, 'assertContains',
            $pass ? '' : "Expected string to contain: $needle" . ($msg ? " – $msg" : ''));
    }

    // ── Internal ──────────────────────────────────────────────────────────────

    private function record(bool $pass, string $assertion, string $detail): void
    {
        // Called from the test method — capture the caller test name
        $trace    = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        $testName = $trace[2]['function'] ?? 'unknown';
        $this->results[] = [
            'test'      => $testName,
            'assertion' => $assertion,
            'passed'    => $pass,
            'detail'    => $detail,
        ];
    }

    // ── Runner ────────────────────────────────────────────────────────────────

    /**
     * Discover and run all public methods starting with "test".
     */
    public function run(): array
    {
        $methods = array_filter(
            get_class_methods($this),
            fn($m) => str_starts_with($m, 'test')
        );
        sort($methods);

        foreach ($methods as $method) {
            $this->$method();
        }

        return $this->results;
    }
}
