using System;

namespace ClassLibrary
{
    /// <summary>
    /// Represents a college event. Validation is enforced in each property setter.
    /// </summary>
    public class Event
    {
        private int    _eventId;
        private string _eventName;
        private string _location;
        private DateTime _eventDate;
        private string _eventTime;
        private string _description;

        // ── PROPERTIES ──────────────────────────────────────────────────────────

        public int EventId
        {
            get { return _eventId; }
            set { _eventId = value; }
        }

        /// <summary>Min 3 chars, max 100 chars, required.</summary>
        public string EventName
        {
            get { return _eventName; }
            set
            {
                if (string.IsNullOrWhiteSpace(value))
                    throw new ArgumentException("Event name is required.");
                if (value.Trim().Length < 3)
                    throw new ArgumentException("Event name must be at least 3 characters.");
                if (value.Trim().Length > 100)
                    throw new ArgumentException("Event name cannot exceed 100 characters.");
                _eventName = value.Trim();
            }
        }

        /// <summary>Required, max 150 chars.</summary>
        public string Location
        {
            get { return _location; }
            set
            {
                if (string.IsNullOrWhiteSpace(value))
                    throw new ArgumentException("Location is required.");
                if (value.Trim().Length > 150)
                    throw new ArgumentException("Location cannot exceed 150 characters.");
                _location = value.Trim();
            }
        }

        /// <summary>Must not be in the past.</summary>
        public DateTime EventDate
        {
            get { return _eventDate; }
            set
            {
                if (value.Date < DateTime.Today)
                    throw new ArgumentException("Event date cannot be in the past.");
                _eventDate = value;
            }
        }

        /// <summary>Required (HH:mm format).</summary>
        public string EventTime
        {
            get { return _eventTime; }
            set
            {
                if (string.IsNullOrWhiteSpace(value))
                    throw new ArgumentException("Event time is required.");
                _eventTime = value.Trim();
            }
        }

        /// <summary>Min 10 chars, max 1000 chars, required.</summary>
        public string Description
        {
            get { return _description; }
            set
            {
                if (string.IsNullOrWhiteSpace(value))
                    throw new ArgumentException("Description is required.");
                if (value.Trim().Length < 10)
                    throw new ArgumentException("Description must be at least 10 characters.");
                if (value.Trim().Length > 1000)
                    throw new ArgumentException("Description cannot exceed 1000 characters.");
                _description = value.Trim();
            }
        }

        // ── VALIDATE ────────────────────────────────────────────────────────────

        /// <summary>
        /// Returns true only when all required fields are set and within bounds.
        /// </summary>
        public bool Validate()
        {
            return !string.IsNullOrEmpty(_eventName)
                && !string.IsNullOrEmpty(_location)
                && !string.IsNullOrEmpty(_eventTime)
                && !string.IsNullOrEmpty(_description)
                && _eventDate.Date >= DateTime.Today;
        }
    }
}
