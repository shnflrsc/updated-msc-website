<?php

/**
 * Student Model
 * Handle all student-related database operations
 */

require_once __DIR__ . '/../config/database.php';

class Student
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Create a new student
     */
    public function create($data)
    {
        try {
            // Check if username or email already exists
            $checkStmt = $this->db->prepare("SELECT id FROM students WHERE username = :username OR email = :email");
            $checkStmt->execute([
                'username' => $data['username'],
                'email' => $data['email']
            ]);

            if ($checkStmt->fetch()) {
                throw new Exception("Username or email already exists");
            }

            // Hash password
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            // Insert student
            $sql = "INSERT INTO students (
                username, email, password, first_name, middle_name, last_name, name_suffix,
                birthdate, gender, student_no, year_level, college, program,
                section, address, phone, facebook_link, role, is_active, password_updated
            ) VALUES (
                :username, :email, :password, :first_name, :middle_name, :last_name, :name_suffix,
                :birthdate, :gender, :student_no, :year_level, :college, :program,
                :section, :address, :phone, :facebook_link, :role, :is_active, 0
            )";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $hashedPassword,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'name_suffix' => $data['name_suffix'],
                'birthdate' => $data['birthdate'],
                'gender' => $data['gender'],
                'student_no' => $data['student_no'],
                'year_level' => $data['year_level'],
                'college' => $data['college'],
                'program' => $data['program'],
                'section' => $data['section'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'facebook_link' => $data['facebook_link'],
                'role' => $data['role'] ?? 'member',
                'is_active' => true
            ]);

            $userId = $this->db->lastInsertId();

            // Generate MSC ID
            $mscId = $this->generateMscId($data['role'] ?? 'member');

            // Update student with MSC ID
            $updateStmt = $this->db->prepare("UPDATE students SET msc_id = :msc_id WHERE id = :id");
            $updateStmt->execute(['msc_id' => $mscId, 'id' => $userId]);

            return $this->findById($userId);
        } catch (Exception $e) {
            throw new Exception("Failed to create student: " . $e->getMessage());
        }
    }

    public function markPasswordUpdated($id)
    {
        try {
            $stmt = $this->db->prepare("UPDATE students SET password_updated = 1 WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Failed to mark password updated: " . $e->getMessage());
        }
    }

    /**
     * Find student by ID
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Find student by username
     */
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    /**
     * Find student by email
     */
    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Update student profile: [ORIGINAL CODE]
     */
    /*
    public function updateProfile($id, $data)
    {
        try {
            $sql = "UPDATE students SET 
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                name_suffix = :name_suffix,
                birthdate = :birthdate,
                gender = :gender,
                student_no = :student_no,
                year_level = :year_level,
                college = :college,
                program = :program,
                section = :section,
                address = :address,
                phone = :phone,
                facebook_link = :facebook_link,
                profile_image_path = :profile_image_path
                WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'id' => $id,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'name_suffix' => $data['name_suffix'],
                'birthdate' => $data['birthdate'],
                'gender' => $data['gender'],
                'student_no' => $data['student_no'],
                'year_level' => $data['year_level'],
                'college' => $data['college'],
                'program' => $data['program'],
                'section' => $data['section'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'facebook_link' => $data['facebook_link'],
                'profile_image_path' => $data['profile_image_path'] ?? null
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to update profile: " . $e->getMessage());
        }
    }
        */

    /* Update Student Profile: [Allow partial updates]
    */
    public function updateProfile($id, $data)
    {
        try {
            $fields = [
                "msc_id",
                "student_no",
                "last_name",
                "first_name",
                "middle_name",
                "name_suffix",
                "college",
                "program",
                "year_level",
                "section",
                "phone",
                "email",
                "bulsu_email",
                "facebook_link",
                "address",
                "birthdate",
                "age",
                "gender",
                "guardian_name",
                "relationship",
                "guardian_phone",
                "guardian_address",
                'profile_image_path'
            ];

            $setParts = [];
            $params = ['id' => $id];

            foreach ($fields as $field) {
                if (array_key_exists($field, $data)) {
                    $setParts[] = "$field = :$field";
                    $params[$field] = $data[$field] === "" ? null : $data[$field]; // convert empty strings to NULL
                }
            }

            if (empty($setParts)) {
                throw new Exception("No data provided for update.");
            }

            $sql = "UPDATE students SET " . implode(", ", $setParts) . " WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (Exception $e) {
            throw new Exception("Failed to update profile: " . $e->getMessage());
        }
    }


    /**
     * Change password
     */
    public function changePassword($id, $newPassword)
    {
        try {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE students SET password = :password, password_updated = 1 WHERE id = :id");
            return $stmt->execute(['password' => $hashedPassword, 'id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Failed to change password: " . $e->getMessage());
        }
    }

    /**
     * Verify password
     */
    public function verifyPassword($hashedPassword, $password)
    {
        return password_verify($password, $hashedPassword);
    }

    /**
     * Get all students with pagination
     */
    public function getAll($page = 1, $limit = 20, $role = null)
    {
        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM students";
        $params = [];

        if ($role) {
            $sql .= " WHERE role = :role";
            $params['role'] = $role;
        }

        $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

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
     * Generate MSC ID
     */
    private function generateMscId($role)
    {
        // Get school year code
        $syStmt = $this->db->prepare("SELECT value FROM settings WHERE key_name = 'school_year_code'");
        $syStmt->execute();
        $schoolYearCode = $syStmt->fetchColumn() ?: '2526';

        if ($role === 'officer') {
            // Count officers for this school year
            $countStmt = $this->db->prepare("SELECT COUNT(*) FROM students WHERE role = 'officer' AND msc_id LIKE CONCAT('MSC', :sy, 'EB-%')");
            $countStmt->execute(['sy' => $schoolYearCode]);
            $officerNumber = $countStmt->fetchColumn() + 1;
            return sprintf("MSC%sEB-%03d", $schoolYearCode, $officerNumber);
        } else {
            // Count members
            $countStmt = $this->db->prepare("SELECT COUNT(*) FROM students WHERE role = 'member'");
            $countStmt->execute();
            $memberNumber = $countStmt->fetchColumn() + 1;
            return sprintf("MSC-%04d", $memberNumber);
        }
    }

    /**
     * Toggle student active status
     */
    public function toggleActive($id)
    {
        try {
            $stmt = $this->db->prepare("UPDATE students SET is_active = NOT is_active WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Failed to toggle active status: " . $e->getMessage());
        }
    }

    /*
     * COUNT: All Students
    */
    public function countAll()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM students");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /*
     * CHART: Students by College
    */
    public function countByCollege()
    {
        $stmt = $this->db->prepare("SELECT college, COUNT(*) AS total FROM students WHERE `role` = 'member' GROUP BY college");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
     * CHART: Students by Year Level
    */
    public function countByYearLevel()
    {
        $stmt = $this->db->prepare("SELECT year_level, COUNT(*) AS total FROM students WHERE `role` = 'member' GROUP BY year_level");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete student
     */
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM students WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception("Failed to delete student: " . $e->getMessage());
        }
    }

    /**
     * Get membership status of a student by ID
     */
    public function getMembershipStatus($id)
    {
        $stmt = $this->db->prepare("
        SELECT 
            id, is_active,
            CASE 
                WHEN is_active = 1 THEN 'Active'
                ELSE 'Inactive'
            END AS status
        FROM students
        WHERE id = :id
        LIMIT 1
    ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * COUNT: All Student (Members)
    */
    public function countMembers()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM students WHERE `role` = 'member'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * TESTING: Get Student details by msc_id
     */
    public function getByMscIds($mscIds)
    {
        if (empty($mscIds)) {
            return [];
        }

        // Create placeholders like ?, ?, ? for IN()
        $placeholders = implode(',', array_fill(0, count($mscIds), '?'));

        $sql = "SELECT 
                id, 
                msc_id, 
                student_no, 
                first_name, 
                last_name, 
                year_level, 
                program, 
                college 
            FROM students 
            WHERE msc_id IN ($placeholders)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($mscIds);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* NEW METHOD: Get Participant's details (Guest, Member)
    */
    public function getParticipantsByMscIds($mscIds)
    {
        if (empty($mscIds)) {
            return [];
        }

        $placeholders = implode(',', array_fill(0, count($mscIds), '?'));

        $sql = "
        (
            SELECT 
                'member' AS participant_type,
                msc_id,
                first_name,
                last_name,
                program,
                college,
                year_level,
                id AS student_id
            FROM students
            WHERE msc_id IN ($placeholders)
        )
        UNION ALL
        (
            SELECT 
                participant_type,
                qr_code AS msc_id,
                first_name,
                last_name,
                program,
                college,
                year_level,
                NULL AS student_id
            FROM event_registrations
            WHERE qr_code IN ($placeholders)
        )
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_merge($mscIds, $mscIds));

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changePasswordByStudentNo($student_no, $newPassword)
    {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE students SET password = :password, password_updated = 1 WHERE student_no = :student_no");
        return $stmt->execute([':password' => $hashed, ':student_no' => $student_no]);
    }

    public function findByStudentNo($student_no)
    {
        $stmt = $this->db->prepare("SELECT * FROM students WHERE student_no = :student_no LIMIT 1");
        $stmt->execute([':student_no' => $student_no]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get the next MSC ID (for members only)
     */
    public function getNextMscId()
    {
        try {
            // Get school year code from settings table
            $syStmt = $this->db->prepare("SELECT value FROM settings WHERE key_name = 'school_year_code'");
            $syStmt->execute();
            $currentCode = $syStmt->fetchColumn() ?: '2526';

            // Query last MSC ID for this school year
            $stmt = $this->db->prepare("
            SELECT msc_id 
            FROM students 
            WHERE msc_id LIKE :pattern 
            ORDER BY msc_id DESC 
            LIMIT 1
        ");

            $stmt->execute(['pattern' => "MSC{$currentCode}-%"]);
            $last = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$last) {
                $nextNumber = 1;
            } else {
                // Get last 3 digits
                $lastNum = intval(substr($last['msc_id'], -3));
                $nextNumber = $lastNum + 1;
            }

            // Format new MSC ID
            $nextMscId = "MSC{$currentCode}-" . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            return $nextMscId;
        } catch (Exception $e) {
            throw new Exception("Failed to generate next MSC ID: " . $e->getMessage());
        }
    }
}
