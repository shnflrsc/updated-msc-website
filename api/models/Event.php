<?php

/**
 * Event Model
 * Handle all event-related database operations
 */

require_once __DIR__ . '/../config/database.php';

class Event
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Create a new event
     */
    public function create($data)
    {
        try {
            $sql = "INSERT INTO events (
                event_name, event_date, event_time_start, event_time_end,
                location, event_type, registration_required, event_status,
                description, event_image_url, event_batch_image, event_restriction
            ) VALUES (
                :event_name, :event_date, :event_time_start, :event_time_end,
                :location, :event_type, :registration_required, :event_status,
                :description, :event_image_url, :event_batch_image, :event_restriction
            )";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'event_name' => $data['event_name'],
                'event_date' => $data['event_date'],
                'event_time_start' => $data['event_time_start'],
                'event_time_end' => $data['event_time_end'],
                'location' => $data['location'],
                'event_type' => $data['event_type'],
                'registration_required' => $data['registration_required'] ?? false,
                'event_status' => $data['event_status'] ?? 'upcoming',
                'description' => $data['description'],
                'event_image_url' => $data['event_image_url'] ?? null,
                'event_batch_image' => $data['event_batch_image'] ?? null,
                'event_restriction' => $data['event_restriction'] ?? 'public'
            ]);

            return $this->findById($this->db->lastInsertId());
        } catch (Exception $e) {
            throw new Exception("Failed to create event: " . $e->getMessage());
        }
    }

    /**
     * Find event by ID
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE event_id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get all events with pagination and filters
     */
    public function getAll($page = 1, $limit = 20, $filters = [])
    {
        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM events WHERE 1=1";
        $params = [];

        // Apply filters
        if (isset($filters['status'])) {
            $sql .= " AND event_status = :status";
            $params['status'] = $filters['status'];
        }

        if (isset($filters['type'])) {
            $sql .= " AND event_type = :type";
            $params['type'] = $filters['type'];
        }

        if (isset($filters['restriction'])) {
            $sql .= " AND event_restriction = :restriction";
            $params['restriction'] = $filters['restriction'];
        }

        if (isset($filters['date_from'])) {
            $sql .= " AND event_date >= :date_from";
            $params['date_from'] = $filters['date_from'];
        }

        if (isset($filters['date_to'])) {
            $sql .= " AND event_date <= :date_to";
            $params['date_to'] = $filters['date_to'];
        }

        $sql .= " ORDER BY event_date ASC, event_time_start ASC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Update event
     */
    /*
    public function update($id, $data)
    {
        try {
            $sql = "UPDATE events SET 
                event_name = :event_name,
                event_date = :event_date,
                event_time_start = :event_time_start,
                event_time_end = :event_time_end,
                location = :location,
                event_type = :event_type,
                registration_required = :registration_required,
                event_status = :event_status,
                description = :description,
                event_image_url = :event_image_url,
                event_batch_image = :event_batch_image,
                event_restriction = :event_restriction,
                updated_at = CURRENT_TIMESTAMP
                WHERE event_id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'event_name' => $data['event_name'],
                'event_date' => $data['event_date'],
                'event_time_start' => $data['event_time_start'],
                'event_time_end' => $data['event_time_end'],
                'location' => $data['location'],
                'event_type' => $data['event_type'],
                'registration_required' => $data['registration_required'] ?? false,
                'event_status' => $data['event_status'],
                'description' => $data['description'],
                'event_image_url' => $data['event_image_url'],
                'event_batch_image' => $data['event_batch_image'],
                'event_restriction' => $data['event_restriction']
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to update event: " . $e->getMessage());
        }
    }
    */

    /**
     * Update Event [Allow partial updates]
     */
    public function update($id, $data)
    {
        try {
            $fields = [
                'event_name',
                'event_date',
                'event_time_start',
                'event_time_end',
                'location',
                'event_type',
                'registration_required',
                'event_status',
                'description',
                'event_image_url',
                'event_batch_image',
                'event_restriction'
            ];

            $setParts = [];
            $params = ['id' => $id];

            foreach ($fields as $field) {
                if (array_key_exists($field, $data)) {
                    $setParts[] = "$field = :$field";
                    // Convert empty strings to null for optional fields
                    $params[$field] = $data[$field] === "" ? null : $data[$field];
                }
            }

            if (empty($setParts)) {
                throw new Exception("No data provided for update.");
            }

            $sql = "UPDATE events SET " . implode(", ", $setParts) . ", updated_at = CURRENT_TIMESTAMP WHERE event_id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (Exception $e) {
            throw new Exception("Failed to update event: " . $e->getMessage());
        }
    }


    public function updateStatus($id, $status)
    {
        try {
            $sql = "UPDATE events 
                SET event_status = :event_status,
                    updated_at = CURRENT_TIMESTAMP
                WHERE event_id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'event_status' => $status,
                'id' => $id
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to update event: " . $e->getMessage());
        }
    }

    /*
     * Cancel event
    */
    public function cancelEvent($id)
    {
        try {
            $stmt = $this->db->prepare("UPDATE events SET `event_status` = 'canceled' WHERE event_id = :id");
            //UPDATE events SET `event_status` = 'canceled' WHERE event_id = 63
            return $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Failed to delete event: " . $e->getMessage());
        }
    }

    /**
     * Delete event
     */
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM events WHERE event_id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Failed to delete event: " . $e->getMessage());
        }
    }

     /*
    public function getUpcoming($limit = 10) //Default: 10
    {
        $sql = "SELECT * FROM events 
                WHERE event_status = 'upcoming' 
                AND event_date >= CURDATE()
                ORDER BY event_date ASC, event_time_start ASC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    */

    /**
     * GET: ALL Events
     */
    public function getEvents($limit = null){
        $sql = "SELECT * FROM events 
            ORDER BY event_date ASC, event_time_start ASC";

        if ($limit !== null) {
            $sql .= " LIMIT :limit";
        }

        $stmt = $this->db->prepare($sql);

        if ($limit !== null) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * GET: Upcoming events
     */
    public function getUpcoming($limit = null){
        $sql = "SELECT * FROM events 
            WHERE event_status = 'upcoming' 
            AND event_date >= CURDATE()
            ORDER BY event_date ASC, event_time_start ASC";

        if ($limit !== null) {
            $sql .= " LIMIT :limit";
        }

        $stmt = $this->db->prepare($sql);

        if ($limit !== null) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get upcoming events: for Admin Dashoard
     */
    public function getUpcomingPreview($limit = 3)
    {
        $sql = "SELECT * FROM events 
                WHERE event_status = 'upcoming' 
                AND event_date >= CURDATE()
                ORDER BY event_date ASC, event_time_start ASC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get upcoming events: for Member's view
     */
    public function getUpcomingPreview2($limit = 4)
    {
        $sql = "SELECT * FROM events 
                WHERE event_status = 'upcoming' 
                AND event_date >= CURDATE()
                ORDER BY event_date ASC, event_time_start ASC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get upcoming events: for student calendar
     */
    public function getUpcomingEventsCalendar($limit = null)
    {
        $sql = "SELECT * FROM events 
            WHERE event_status = 'upcoming' 
            AND event_date >= CURDATE()
            ORDER BY event_date ASC, event_time_start ASC";

        if ($limit !== null) {
            $sql .= " LIMIT :limit";
        }

        $stmt = $this->db->prepare($sql);

        if ($limit !== null) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get canceled events
     */
    public function getCanceled($limit = 10) //Default: 10
    {
        $sql = "SELECT * FROM events 
                WHERE event_status = 'canceled' 
                AND event_date >= CURDATE()
                ORDER BY event_date ASC, event_time_start ASC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get past/completed events
     */
    public function getPast($limit = 10) //Default: 10
    {
        $sql = "SELECT * FROM events 
                WHERE event_status = 'completed' 
                AND event_date < CURDATE()
                ORDER BY event_date ASC, event_time_start ASC 
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Get events for calendar
     */
    public function getCalendarEvents($startDate, $endDate)
    {
        $sql = "SELECT event_id, event_name, event_date, event_time_start, event_time_end, event_status,
                       event_type, event_status, location, description
                FROM events 
                WHERE event_date BETWEEN :start_date AND :end_date
                AND event_status = 'upcoming'
                ORDER BY event_date ASC, event_time_start ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        return $stmt->fetchAll();
    }

    /**
     * Get university calendar events 
     */
    public function getUnivCalendarEvents($startDate, $endDate)
    {
        $sql = "SELECT calendar_id, event_name, event_date, event_type, school_year
                FROM university_calendar
                WHERE event_date BETWEEN :start_date AND :end_date
                ORDER BY event_date ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'start_date' => $startDate,
            'end_date'   => $endDate
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Register student for event
     */
    public function registerStudent($eventId, $studentId)
    {
        try {
            // Check if event exists and allows registration
            $event = $this->findById($eventId);
            if (!$event || !$event['registration_required']) {
                throw new Exception("Event does not require registration or does not exist");
            }

            // Check if already registered
            $checkStmt = $this->db->prepare("SELECT id FROM event_registrations WHERE event_id = :event_id AND student_id = :student_id");
            $checkStmt->execute(['event_id' => $eventId, 'student_id' => $studentId]);

            if ($checkStmt->fetch()) {
                throw new Exception("Already registered for this event");
            }

            // Register student
            $stmt = $this->db->prepare("INSERT INTO event_registrations (event_id, student_id) VALUES (:event_id, :student_id)");
            $result = $stmt->execute(['event_id' => $eventId, 'student_id' => $studentId]);

            if ($result) {
                // Update attendants count
                $updateStmt = $this->db->prepare("UPDATE events SET attendants = attendants + 1 WHERE event_id = :event_id");
                $updateStmt->execute(['event_id' => $eventId]);
            }

            return $result;
        } catch (Exception $e) {
            throw new Exception("Failed to register for event: " . $e->getMessage());
        }
    }

    /**
     * Get event registrations
     */
    public function getRegistrations($eventId)
    {
        $sql = "SELECT er.*, s.first_name, s.last_name, s.msc_id, s.email, s.student_no
                FROM event_registrations er
                JOIN students s ON er.student_id = s.id
                WHERE er.event_id = :event_id
                ORDER BY er.registration_date ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['event_id' => $eventId]);

        return $stmt->fetchAll();
    }

    /**
     * Update attendance status
     */
    public function updateAttendanceStatus($eventId, $studentId, $status)
    {
        try {
            $stmt = $this->db->prepare("UPDATE event_registrations SET attendance_status = :status WHERE event_id = :event_id AND student_id = :student_id");
            return $stmt->execute([
                'status' => $status,
                'event_id' => $eventId,
                'student_id' => $studentId
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to update attendance status: " . $e->getMessage());
        }
    }

    /**
     * Get: Registered Events by a Student (on Dashboard)
     */
    public function getEventsByStudent($studentId)
    {
        $sql = "SELECT e.event_id, e.event_name, e.event_date, e.event_time_start, e.location, e.description, e.event_status, e.event_batch_image, er.attendance_status
            FROM event_registrations er
            JOIN events e ON er.event_id = e.event_id
            WHERE er.student_id = :student_id
            AND e.event_status = 'upcoming'
            ORDER BY e.event_date DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['student_id' => $studentId]);

        return $stmt->fetchAll();
    }

    /**
     * GET: Attended Events by a Student (on Event Badges)
     */
    public function getAttendedEventsByStudent($studentId)
    {
        $sql = "SELECT e.event_id, e.event_name, e.event_date, e.event_time_start, e.location, e.event_batch_image, er.attendance_status
            FROM event_registrations er
            JOIN events e ON er.event_id = e.event_id
            WHERE er.student_id = :student_id
            AND er.attendance_status = 'attended'
            ORDER BY e.event_date DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['student_id' => $studentId]);

        return $stmt->fetchAll();
    }

    /**
     * COUNT: All Events
     */
    public function countAll()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM events");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * COUNT: Attended & Pre-Registered events (student) 
     */
    public function getStudentEventStats($studentId)
    {
        $stmt = $this->db->prepare("SELECT
        SUM(CASE 
            WHEN er.attendance_status = 'registered' 
                AND e.event_date >= CURDATE() 
            THEN 1 ELSE 0 END) AS registered_count,
        SUM(CASE 
            WHEN er.attendance_status = 'attended' 
            THEN 1 ELSE 0 END) AS attended_count
        FROM event_registrations er
        JOIN events e ON er.event_id = e.event_id
        WHERE er.student_id = :studentId
        ");

        $stmt->execute([':studentId' => $studentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: ['registered_count' => 0, 'attended_count' => 0];
    }


    /**
     * COUNT: Events (Upcoming)
     */
    public function countUpcomingEvents()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM events WHERE `event_status` = 'upcoming'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * GET: Event Status counts 
     */
    public function getStatusCounts()
    {
        $stmt = $this->db->prepare("
        SELECT event_status, COUNT(*) AS total
        FROM events
        GROUP BY event_status
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * GET: Events per Month
     */
    public function getEventsPerMonth()
    {
        $sql = "SELECT MONTH(event_date) AS month, COUNT(*) AS total
            FROM events
            GROUP BY month
            ORDER BY month ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
