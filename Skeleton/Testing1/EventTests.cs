using System;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using ClassLibrary;

namespace Testing1
{
    /// <summary>
    /// Boundary and validation tests for the Event class (middle layer).
    /// Tests the Validate() method and property setters for each field.
    /// </summary>
    [TestClass]
    public class EventTests
    {
        // ════════════════════════════════════════════════════════
        //  EventName — min 3, max 100, required
        // ════════════════════════════════════════════════════════

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void EventName_Empty_ThrowsException()
        {
            var ev = new Event();
            ev.EventName = "";  // empty → invalid
        }

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void EventName_OneChar_ThrowsException()
        {
            var ev = new Event();
            ev.EventName = "A";  // 1 char, below min
        }

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void EventName_TwoChars_ThrowsException()
        {
            var ev = new Event();
            ev.EventName = "AB";  // 2 chars, 1 below min boundary
        }

        [TestMethod]
        public void EventName_ThreeChars_IsValid()
        {
            var ev = new Event();
            ev.EventName = "ABC";  // exactly at min boundary
            Assert.AreEqual("ABC", ev.EventName);
        }

        [TestMethod]
        public void EventName_FiftyChars_IsValid()
        {
            var ev = new Event();
            string name = new string('A', 50);
            ev.EventName = name;  // mid-range valid
            Assert.AreEqual(name, ev.EventName);
        }

        [TestMethod]
        public void EventName_HundredChars_IsValid()
        {
            var ev = new Event();
            string name = new string('A', 100);
            ev.EventName = name;  // exactly at max boundary
            Assert.AreEqual(name, ev.EventName);
        }

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void EventName_HundredOneChars_ThrowsException()
        {
            var ev = new Event();
            ev.EventName = new string('A', 101);  // 1 above max boundary
        }

        // ════════════════════════════════════════════════════════
        //  Location — max 150, required
        // ════════════════════════════════════════════════════════

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void Location_Empty_ThrowsException()
        {
            var ev = new Event();
            ev.Location = "";
        }

        [TestMethod]
        public void Location_ValidShort_IsValid()
        {
            var ev = new Event();
            ev.Location = "Room S112";
            Assert.AreEqual("Room S112", ev.Location);
        }

        [TestMethod]
        public void Location_HundredFiftyChars_IsValid()
        {
            var ev = new Event();
            string loc = new string('L', 150);
            ev.Location = loc;  // exactly at max boundary
            Assert.AreEqual(loc, ev.Location);
        }

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void Location_HundredFiftyOneChars_ThrowsException()
        {
            var ev = new Event();
            ev.Location = new string('L', 151);  // 1 above max boundary
        }

        // ════════════════════════════════════════════════════════
        //  EventDate — must not be in the past
        // ════════════════════════════════════════════════════════

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void EventDate_Yesterday_ThrowsException()
        {
            var ev = new Event();
            ev.EventDate = DateTime.Today.AddDays(-1);  // past date
        }

        [TestMethod]
        public void EventDate_Today_IsValid()
        {
            var ev = new Event();
            ev.EventDate = DateTime.Today;
            Assert.AreEqual(DateTime.Today, ev.EventDate);
        }

        [TestMethod]
        public void EventDate_FutureDate_IsValid()
        {
            var ev = new Event();
            ev.EventDate = DateTime.Today.AddDays(30);
            Assert.AreEqual(DateTime.Today.AddDays(30), ev.EventDate);
        }

        // ════════════════════════════════════════════════════════
        //  EventTime — required
        // ════════════════════════════════════════════════════════

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void EventTime_Empty_ThrowsException()
        {
            var ev = new Event();
            ev.EventTime = "";
        }

        [TestMethod]
        public void EventTime_ValidTime_IsValid()
        {
            var ev = new Event();
            ev.EventTime = "14:30";
            Assert.AreEqual("14:30", ev.EventTime);
        }

        // ════════════════════════════════════════════════════════
        //  Description — min 10, max 1000, required
        // ════════════════════════════════════════════════════════

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void Description_Empty_ThrowsException()
        {
            var ev = new Event();
            ev.Description = "";
        }

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void Description_NineChars_ThrowsException()
        {
            var ev = new Event();
            ev.Description = "Short!!!";  // 8 chars — changed to ensure < 10
        }

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void Description_ExactlyNineChars_ThrowsException()
        {
            var ev = new Event();
            ev.Description = "123456789";  // 9 chars, 1 below min boundary
        }

        [TestMethod]
        public void Description_TenChars_IsValid()
        {
            var ev = new Event();
            ev.Description = "1234567890";  // exactly at min boundary
            Assert.AreEqual("1234567890", ev.Description);
        }

        [TestMethod]
        public void Description_FiveHundredChars_IsValid()
        {
            var ev = new Event();
            string desc = new string('D', 500);
            ev.Description = desc;  // mid-range valid
            Assert.AreEqual(desc, ev.Description);
        }

        [TestMethod]
        public void Description_ThousandChars_IsValid()
        {
            var ev = new Event();
            string desc = new string('D', 1000);
            ev.Description = desc;  // exactly at max boundary
            Assert.AreEqual(desc, ev.Description);
        }

        [TestMethod]
        [ExpectedException(typeof(ArgumentException))]
        public void Description_ThousandOneChars_ThrowsException()
        {
            var ev = new Event();
            ev.Description = new string('D', 1001);  // 1 above max boundary
        }

        // ════════════════════════════════════════════════════════
        //  Validate() — whole object
        // ════════════════════════════════════════════════════════

        [TestMethod]
        public void Validate_AllValidFields_ReturnsTrue()
        {
            var ev = new Event();
            ev.EventName   = "Hackathon 2026";
            ev.Location    = "Room S112";
            ev.EventDate   = DateTime.Today.AddDays(7);
            ev.EventTime   = "10:00";
            ev.Description = "Annual coding competition for students.";
            Assert.IsTrue(ev.Validate());
        }

        [TestMethod]
        public void Validate_MissingName_ReturnsFalse()
        {
            // Validate() returns false when a required field is unset
            var ev = new Event();
            // EventName not set → _eventName is null → Validate() returns false
            Assert.IsFalse(ev.Validate());
        }
    }
}
