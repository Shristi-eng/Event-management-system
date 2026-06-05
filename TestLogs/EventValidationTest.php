<?php

require_once __DIR__ . '/Validator.php';
require_once __DIR__ . '/TestCase.php';

/**
 * EventValidationTest
 *
 * JUnit-style boundary and validation tests for the Admin Dashboard
 * validation rules (Event class properties + Admin login).
 *
 * Naming convention: test<Property>_<Condition>
 * Each test method uses $this->assertEquals() / $this->assertNotEquals()
 * to assert the expected outcome, identical to JUnit assertions.
 */
class EventValidationTest extends TestCase
{
    // ══════════════════════════════════════════════════════════════════════════
    //  EventName  (min 3, max 100, required)
    // ══════════════════════════════════════════════════════════════════════════

    public function testEventName_ExtremeMin_EmptyString()
    {
        $result = Validator::eventName('');
        $this->assertEquals('Event name is required.', $result);
    }

    public function testEventName_BelowMin_OneChar()
    {
        $result = Validator::eventName('A');
        $this->assertEquals('Event name must be at least 3 characters.', $result);
    }

    public function testEventName_BelowMin_TwoChars()
    {
        // Min-1: one character below the minimum boundary
        $result = Validator::eventName('AB');
        $this->assertEquals('Event name must be at least 3 characters.', $result);
    }

    public function testEventName_AtMin_ThreeChars()
    {
        // Min boundary — must be accepted
        $result = Validator::eventName('ABC');
        $this->assertEquals('ok', $result);
    }

    public function testEventName_AboveMin_FourChars()
    {
        $result = Validator::eventName('ABCD');
        $this->assertEquals('ok', $result);
    }

    public function testEventName_Mid_TypicalValue()
    {
        $result = Validator::eventName('Hackathon 2026');
        $this->assertEquals('ok', $result);
    }

    public function testEventName_BelowMax_NinetyNineChars()
    {
        $result = Validator::eventName(str_repeat('A', 99));
        $this->assertEquals('ok', $result);
    }

    public function testEventName_AtMax_HundredChars()
    {
        // Max boundary — must be accepted
        $result = Validator::eventName(str_repeat('A', 100));
        $this->assertEquals('ok', $result);
    }

    public function testEventName_AboveMax_HundredOneChars()
    {
        // Max+1: one character above the maximum boundary
        $result = Validator::eventName(str_repeat('A', 101));
        $this->assertEquals('Event name cannot exceed 100 characters.', $result);
    }

    public function testEventName_ExtremeMax_TwoHundredChars()
    {
        $result = Validator::eventName(str_repeat('A', 200));
        $this->assertEquals('Event name cannot exceed 100 characters.', $result);
    }

    public function testEventName_SpacesOnly_TreatedAsEmpty()
    {
        $result = Validator::eventName('   ');
        $this->assertEquals('Event name is required.', $result);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  Location  (max 150, required)
    // ══════════════════════════════════════════════════════════════════════════

    public function testLocation_ExtremeMin_EmptyString()
    {
        $result = Validator::location('');
        $this->assertEquals('Location is required.', $result);
    }

    public function testLocation_AtMin_OneChar()
    {
        // Min boundary — any non-empty value is valid
        $result = Validator::location('A');
        $this->assertEquals('ok', $result);
    }

    public function testLocation_Mid_TypicalValue()
    {
        $result = Validator::location('Room S112');
        $this->assertEquals('ok', $result);
    }

    public function testLocation_BelowMax_HundredFortyNineChars()
    {
        $result = Validator::location(str_repeat('L', 149));
        $this->assertEquals('ok', $result);
    }

    public function testLocation_AtMax_HundredFiftyChars()
    {
        // Max boundary — must be accepted
        $result = Validator::location(str_repeat('L', 150));
        $this->assertEquals('ok', $result);
    }

    public function testLocation_AboveMax_HundredFiftyOneChars()
    {
        // Max+1 boundary — must be rejected
        $result = Validator::location(str_repeat('L', 151));
        $this->assertEquals('Location cannot exceed 150 characters.', $result);
    }

    public function testLocation_ExtremeMax_ThreeHundredChars()
    {
        $result = Validator::location(str_repeat('L', 300));
        $this->assertEquals('Location cannot exceed 150 characters.', $result);
    }

    public function testLocation_SpacesOnly_TreatedAsEmpty()
    {
        $result = Validator::location('   ');
        $this->assertEquals('Location is required.', $result);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  EventDate  (must not be in the past, required)
    // ══════════════════════════════════════════════════════════════════════════

    public function testEventDate_Empty_IsRequired()
    {
        $result = Validator::eventDate('');
        $this->assertEquals('Event date is required.', $result);
    }

    public function testEventDate_Yesterday_IsRejected()
    {
        // Min-1: one day before today — must be rejected
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $result = Validator::eventDate($yesterday);
        $this->assertEquals('Event date cannot be in the past.', $result);
    }

    public function testEventDate_Today_IsAccepted()
    {
        // Min boundary — today must be accepted
        $result = Validator::eventDate(date('Y-m-d'));
        $this->assertEquals('ok', $result);
    }

    public function testEventDate_Tomorrow_IsAccepted()
    {
        $result = Validator::eventDate(date('Y-m-d', strtotime('+1 day')));
        $this->assertEquals('ok', $result);
    }

    public function testEventDate_FutureSixMonths_IsAccepted()
    {
        $result = Validator::eventDate(date('Y-m-d', strtotime('+180 days')));
        $this->assertEquals('ok', $result);
    }

    public function testEventDate_FarFuture_IsAccepted()
    {
        $result = Validator::eventDate('2035-01-01');
        $this->assertEquals('ok', $result);
    }

    public function testEventDate_InvalidString_IsRejected()
    {
        // Non-date string — PHP string comparison treats 'not-a-date' < today
        $result = Validator::eventDate('not-a-date');
        $this->assertNotEquals('ok', $result);
    }

    public function testEventDate_LeapDay_IsAccepted()
    {
        $result = Validator::eventDate('2028-02-29');
        $this->assertEquals('ok', $result);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  EventTime  (required)
    // ══════════════════════════════════════════════════════════════════════════

    public function testEventTime_Empty_IsRequired()
    {
        $result = Validator::eventTime('');
        $this->assertEquals('Event time is required.', $result);
    }

    public function testEventTime_SpacesOnly_IsRequired()
    {
        $result = Validator::eventTime('   ');
        $this->assertEquals('Event time is required.', $result);
    }

    public function testEventTime_Midnight_IsAccepted()
    {
        $result = Validator::eventTime('00:00');
        $this->assertEquals('ok', $result);
    }

    public function testEventTime_MidDay_IsAccepted()
    {
        $result = Validator::eventTime('14:30');
        $this->assertEquals('ok', $result);
    }

    public function testEventTime_EndOfDay_IsAccepted()
    {
        $result = Validator::eventTime('23:59');
        $this->assertEquals('ok', $result);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  Description  (min 10, max 1000, required)
    // ══════════════════════════════════════════════════════════════════════════

    public function testDescription_ExtremeMin_EmptyString()
    {
        $result = Validator::description('');
        $this->assertEquals('Description is required.', $result);
    }

    public function testDescription_BelowMin_NineChars()
    {
        // Min-1: one character below the minimum boundary
        $result = Validator::description('123456789');
        $this->assertEquals('Description must be at least 10 characters.', $result);
    }

    public function testDescription_AtMin_TenChars()
    {
        // Min boundary — must be accepted
        $result = Validator::description('1234567890');
        $this->assertEquals('ok', $result);
    }

    public function testDescription_AboveMin_ElevenChars()
    {
        $result = Validator::description('12345678901');
        $this->assertEquals('ok', $result);
    }

    public function testDescription_Mid_TypicalValue()
    {
        $result = Validator::description('Annual coding competition for students.');
        $this->assertEquals('ok', $result);
    }

    public function testDescription_BelowMax_NineNineNineChars()
    {
        $result = Validator::description(str_repeat('D', 999));
        $this->assertEquals('ok', $result);
    }

    public function testDescription_AtMax_ThousandChars()
    {
        // Max boundary — must be accepted
        $result = Validator::description(str_repeat('D', 1000));
        $this->assertEquals('ok', $result);
    }

    public function testDescription_AboveMax_ThousandOneChars()
    {
        // Max+1: one character above the maximum boundary
        $result = Validator::description(str_repeat('D', 1001));
        $this->assertEquals('Description cannot exceed 1000 characters.', $result);
    }

    public function testDescription_ExtremeMax_TwoThousandChars()
    {
        $result = Validator::description(str_repeat('D', 2000));
        $this->assertEquals('Description cannot exceed 1000 characters.', $result);
    }

    public function testDescription_SpacesOnly_TreatedAsEmpty()
    {
        $result = Validator::description('   ');
        $this->assertEquals('Description is required.', $result);
    }

    // ══════════════════════════════════════════════════════════════════════════
    //  Admin Login  (both fields required)
    // ══════════════════════════════════════════════════════════════════════════

    public function testAdminLogin_BothEmpty_IsRejected()
    {
        $result = Validator::adminLogin('', '');
        $this->assertEquals('Username and password are required.', $result);
    }

    public function testAdminLogin_EmptyUsername_IsRejected()
    {
        $result = Validator::adminLogin('', 'pass123');
        $this->assertEquals('Username and password are required.', $result);
    }

    public function testAdminLogin_EmptyPassword_IsRejected()
    {
        $result = Validator::adminLogin('admin', '');
        $this->assertEquals('Username and password are required.', $result);
    }

    public function testAdminLogin_SpacesOnlyUsername_IsRejected()
    {
        $result = Validator::adminLogin('   ', 'pass123');
        $this->assertEquals('Username and password are required.', $result);
    }

    public function testAdminLogin_SpacesOnlyPassword_IsRejected()
    {
        $result = Validator::adminLogin('admin', '   ');
        $this->assertEquals('Username and password are required.', $result);
    }

    public function testAdminLogin_BothProvided_PassesValidation()
    {
        // Credentials pass field validation (DB check is separate)
        $result = Validator::adminLogin('admin', 'password123');
        $this->assertEquals('ok', $result);
    }
}
